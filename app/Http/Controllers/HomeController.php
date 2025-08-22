<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ShpFile;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index($param) {
        Cache::rememberForever('app', function () {
            return DB::table('app_infos')->select(['name','code','logo','moodle_token_expired'])->first();
        });
        try{
            $param2 = explode('_', base64_decode($param));
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                return view('steps.0-introduction', [
                    'active' => 'intro',
                    'page_title' => 'Pengantar',
                    'urlparam' => $param,
                    'proposal' => $proposal,
                    'modal_ps' => true,
                ]);
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function proposallist() {
        $data0 = Proposal::where('user_id', Auth::user()->id)->orderBy('proposals.created_at', 'desc')
        ->select(['id','shpfile_src'])->get();
        $data = [];
        $fields = ['proposals.id','user_id','proposals.idd','shpfile_src','step1_skemaps','result_skemaps','status','nmprov','nmkab','nmkec','nmdesa', 'proposals.created_at'];
        foreach ($data0 as $d0) {
            $d1 = Proposal::join($d0->shpfile_src, 'proposals.idd', $d0->shpfile_src . '.idd')
                ->where('proposals.id', $d0->id)->select($fields)->first();
            array_push($data, $d1);
        }
        return view('steps.0-proposals', [
            'data' => $data,
            'page_title' => 'Daftar Pengajuan Perhutanan Sosial',
            'page_title2' => '<span class="icraf-green">Daftar Pengajuan</span> <span class="icraf-orange">Perhutanan Sosial</span>',
            'title_on_header' => true,
            'active' => 'proposal',
            'modal_ps' => true,
        ]);
    }

    public function cancelproposal($param) {
        try {
            $param2 = explode('_', base64_decode($param));
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                $updatedData['status'] = 'cancelled';
                $updatedData['modified_by'] = Auth::user()->username;
                Proposal::where('id', $proposal->id)->update($updatedData);
                return redirect('/proposals')->with('successMsg', 'Berhasil membatalkan Pengajuan Perhutanan Sosial');
            } else {
                return redirect()->back()->with('errorMsg', 'Aksi tidak dapat dilakukan');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('errorMsg', 'Aksi tidak dapat dilakukan');
        }
    }
}
