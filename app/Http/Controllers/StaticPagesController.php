<?php

namespace App\Http\Controllers;

use App\Models\AppInfo;
use Illuminate\Support\Facades\Cache;

class StaticPagesController extends Controller
{
    public function about() {
        $data = AppInfo::find(1);
        return view('about', [
            'page_title' => trans('Tentang').' '.Cache::get('app')->code,
            'breadcrumb' => trans('Tentang').'|'.trans('Tentang').' '.Cache::get('app')->code,
            'data' => $data,
        ]);
    }

    public function guides($type) {
        $data = AppInfo::find(1);
        return view('guides', [
            'data' => $data,
            'type' => $type,
        ]);
    }

}
