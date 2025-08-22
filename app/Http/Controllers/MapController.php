<?php

namespace App\Http\Controllers;

use App\Models\ShpFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    public function land_access() {
        return view('map.land_access', [
            // 'page_title' => 'Peta Akses Lahan',
            // 'breadcrumb' => 'Peta Akses Lahan',
            // 'title_on_header' => true,
            'page_title' => 'Beranda',
            'breadcrumb' => 'Beranda',
            'title_on_header' => false,
            'active' => 'map',
        ]);
    }

    public function land_access_plus() {
        Cache::rememberForever('app', function () {
            return DB::table('app_infos')->select(['name','code','logo','moodle_token_expired'])->first();
        });
        return view('map.land_access_plus', [
            'page_title' => 'Beranda',
            'breadcrumb' => 'Beranda',
            'title_on_header' => false,
            'active' => 'map',
        ]);
    }

    public function landaccess_iframe(Request $request) {
        $shp = $request->input('shp');
        if ($shp) $map = ShpFile::where('table_name', base64_decode($shp))->first();
        else $map = ShpFile::where(['is_shown' => 'yes'])->first();
        // return view('map.iframe_landaccess', [ 'map' => $map, ]);
        return view('map.iframe_landaccess2', [ 'map' => $map, ]);
    }

    public function landaccess_iframe_plus() {
        return view('map.iframe_landaccess_plus');
    }
}
