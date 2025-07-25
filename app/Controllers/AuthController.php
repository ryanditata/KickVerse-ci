<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $user;

    public function __construct()
    {
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
                $input    = $this->request->getVar('username');
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
                            'isLoggedIn' => true,
                        ]);
                        return redirect()->to(base_url('/'));
                    } else {
                        return redirect()->back()->withInput()->with('failed', 'Kombinasi Username/Email dan Password salah');
                    }
                } else {
                    return redirect()->back()->withInput()->with('failed', 'Username atau Email tidak ditemukan');
                }
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        return view('v_login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('v_register');
    }

    public function process_register()
    {
        $rules = [
            'username'         => 'required|is_unique[user.username]',
            'email'            => 'required|valid_email|is_unique[user.email]',
            'phone'            => 'required',
            'password'         => 'required|min_length[7]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->user->save([
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => 'guest',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
        return redirect()->to('/login');
    }
}