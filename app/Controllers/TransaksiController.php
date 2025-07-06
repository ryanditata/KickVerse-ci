<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class TransaksiController extends BaseController
{
    public function index()
    {
        return view('v_keranjang');
    }

}