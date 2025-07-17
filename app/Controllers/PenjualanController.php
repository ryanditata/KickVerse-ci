<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

class PenjualanController extends BaseController
{
    public function index()
    {
        return view('v_penjualan');
    }
}