<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama Jeep Wukirsari.
     */
    public function index(): View
    {
        return view('pages.home');
    }
}
