<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'page_title' => trans('Pengaturan'),
            'page_title2' => trans('Pengaturan Aplikasi'),
            'breadcrumb' => trans('Pengaturan'),
            'active' => '',
        ]);
    }
}
