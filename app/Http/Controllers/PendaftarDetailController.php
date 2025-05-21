<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftarDetailController extends Controller
{
    public function index()
    {
        return view('Admin.adm_pendaftardetail');
    }
}
