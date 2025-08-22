<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AppInfoController extends Controller
{
    public function show() {
        $data = AppInfo::find(1);
        return view('admin.appinfo', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Info Aplikasi',
            'breadcrumb' => 'Pengaturan',
            'active' => 'appinfo',
            'data' => $data,
        ]);
    }

    public function update(Request $request) {
        $rules = [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];
        $destinationPathLogo = 'img';
        $destinationPathGuide = 'file/guide';
        $validatedData = $request->validate($rules);
        $validatedData['phone'] = $request->phone;
        $validatedData['whatsapp'] = $request->whatsapp;
        $validatedData['email'] = $request->email;
        $validatedData['facebook'] = $request->facebook;
        $validatedData['twitter'] = $request->twitter;
        $validatedData['instagram'] = $request->instagram;
        $validatedData['youtube'] = $request->youtube;
        $validatedData['tiktok'] = $request->tiktok;
        $validatedData['modified_by'] = Auth::user()->username;
        $filelogo = $request->file('logo');
        if ($filelogo) {
            $filelogo->move($destinationPathLogo, $filelogo->getClientOriginalName());
            $validatedData['logo'] = $filelogo->getClientOriginalName();
        } else if ($request->cur_logo == '')
            $validatedData['logo'] = '';
        else $validatedData['logo'] = $request->cur_logo;
        $filemp4 = $request->file('guide_mp4');
        if ($filemp4) {
            $filemp4->move($destinationPathGuide, $filemp4->getClientOriginalName());
            $validatedData['guide_mp4'] = $filemp4->getClientOriginalName();
        } else if ($request->cur_guide_mp4 == '')
            $validatedData['guide_mp4'] = '';
        else $validatedData['guide_mp4'] = $request->cur_guide_mp4;
        $filepdf = $request->file('guide_pdf');
        if ($filepdf) {
            $filepdf->move($destinationPathGuide, $filepdf->getClientOriginalName());
            $validatedData['guide_pdf'] = $filepdf->getClientOriginalName();
        } else if ($request->cur_guide_pdf == '')
            $validatedData['guide_pdf'] = '';
        else $validatedData['guide_pdf'] = $request->cur_guide_pdf;
        // dd($validatedData);
        AppInfo::find(1)->update($validatedData);
        Cache::pull('app');
        Cache::rememberForever('app', function () {
            return DB::table('app_infos')->select(['name','code','logo','moodle_token_expired'])->first();
        });
        return redirect('/admin/appinfo')->with('successMsg', trans('Berhasil mengubah info aplikasi'));
    }

    public function show_moodle() {
        $data = AppInfo::find(1);
        return view('admin.linkmoodle', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Integrasi Moodle LMS',
            'breadcrumb' => 'Pengaturan',
            'active' => 'linkmoodle',
            'data' => $data,
        ]);
    }

    public function update_moodle(Request $request) {
        $validatedData['moodle_url'] = $request->moodle_url;
        $validatedData['moodle_token'] = $request->moodle_token;
        $validatedData['moodle_token_expired'] = $request->moodle_token_expired;
        $validatedData['modified_by'] = Auth::user()->username;
        AppInfo::find(1)->update($validatedData);
        Cache::pull('app');
        Cache::rememberForever('app', function () {
            return DB::table('app_infos')->select(['name','code','logo','moodle_token_expired'])->first();
        });
        return redirect('/admin/linkmoodle')->with('successMsg', trans('Berhasil mengubah info Moodle LMS'));
    }
}
