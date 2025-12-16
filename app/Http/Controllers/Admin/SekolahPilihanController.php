<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SekolahPilihanController extends Controller
{
    public function index() {
        return view('admin.dataMaster.sekolahPilihan');
    }
}
