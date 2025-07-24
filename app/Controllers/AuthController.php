<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController {
    
    protected $user;
    
    function __construct() {
        helper('form');
        $this->user = new UserModel();
    }

    public function login()
    {
    if ($this->request->getPost()) {
        $rules = [
            'username' => 'required|min_length[4]',
            'password' => 'required|min_length[7]|numeric',
        ];

        if ($this->validate($rules)) {
            $input = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user
                ->where('username', $input)
                ->orWhere('email', $input)
                ->first();

            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'username'   => $dataUser['username'],
                        'email'      => $dataUser['email'],
                        'phone'      => $dataUser['phone'],
                        'role'       => $dataUser['role'],
                        'isLoggedIn' => true
                    ]);
                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('failed', 'Kombinasi Username/Email dan Password salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username atau Email tidak ditemukan');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back();
        }
    }

    return view('v_login');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('login');
    }
}