<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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

    public function tinTuc()
    {
        // Trong thực tế sẽ query Database bảng TinTuc, ở đây ta load view tĩnh
        return view('frontend.pages.tin-tuc');
    }

    public function chiTietTin($id)
    {
        return view('frontend.pages.chi-tiet-tin', compact('id'));
    }
}