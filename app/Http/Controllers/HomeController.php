<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ
     */
    public function index()
    {
        return view('frontend.home');
    }

    public function gioiThieu()
    {
        return view('frontend.pages.gioi-thieu');
    }

    public function lienHe()
    {
        return view('frontend.pages.lien-he');
    }
}