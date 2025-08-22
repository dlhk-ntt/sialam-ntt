<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\MoodleController;
use App\Models\CompleteProposal;
use Exception;
use App\Models\ShpFile;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    public function show_region($param) {
        try {
            $param2 = explode('_', base64_decode($param));
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                $region = DB::table($proposal->shpfile_src)->where('idd', $proposal->idd)->select(['idd', 'nmprov','nmkab','nmkec','nmdesa','skema_ps'])->first();
                return view('steps.1-region', [
                    'page_title' => 'Kuesioner',
                    'active' => 'step-1',
                    'region' => $region,
                    'proposal' => $proposal,
                    'urlparam' => $param,
                ]);
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function check_proposal($param) {
        $param = base64_decode($param);
        $shp = ShpFile::where('is_regional', 'yes')->first();
        $new_region = DB::table($shp->table_name)->where('idd', $param)->first();
        $proposal = Proposal::where(['user_id' => Auth::user()->id, 'status' => 'onprocess'])->selectRaw('count(id) as cnt')->first();
        if ($proposal['cnt']) {
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'status' => 'onprocess'])->select('idd')->first();
            $old_region = DB::table($shp->table_name)->where('idd', $proposal->idd)->first();
            return view('steps.1-confirm_region', [
                'page_title' => 'Konfirmasi Daerah',
                'active' => 'step-1',
                'old_region' => $old_region,
                'new_region' => $new_region,
            ]);
        } else {
            $skemapss = explode('-', $new_region->skema_ps);
            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['shpfile_src'] = $shp->table_name;
            $validatedData['idd'] = $param;
            $validatedData['step1_skemaps'] = $new_region->skema_ps;
            $validatedData['step1_completed'] = now();
            $validatedData['status'] = 'onprocess';
            $validatedData['created_by'] = Auth::user()->username;
            $validatedData['modified_by'] = Auth::user()->username;
            if (count($skemapss) == 1) {
                $validatedData['result_skemaps'] = $new_region->skema_ps;
                $validatedData['result_completed'] = now();
                $validatedData['status'] = 'completed';
            }
            Proposal::create($validatedData);
            if (count($skemapss) == 1) {
                return redirect('/result');
            } else {
                return redirect('/step-2');
            }
        }
    }

    public function change_region(Request $request) {
        try {
            $idd = explode('_', $request->param)[1];
            $updatedData['status'] = 'cancelled';
            $updatedData['modified_by'] = Auth::user()->username;
            Proposal::where(['user_id' => Auth::user()->id, 'status' => 'onprocess'])->update($updatedData);
            $shp = ShpFile::where('is_regional', 'yes')->first();
            $new_region = DB::table($shp->table_name)->where('idd', $idd)->first();
            $skemapss = explode('-', $new_region->skema_ps);
            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['shpfile_src'] = $shp->table_name;
            $validatedData['idd'] = $idd;
            $validatedData['step1_skemaps'] = $new_region->skema_ps;
            $validatedData['step1_completed'] = now();
            $validatedData['status'] = 'onprocess';
            $validatedData['created_by'] = Auth::user()->username;
            $validatedData['modified_by'] = Auth::user()->username;
            if (count($skemapss) == 1) {
                $validatedData['result_skemaps'] = $new_region->skema_ps;
                $validatedData['result_completed'] = now();
                $validatedData['status'] = 'completed';
            }
            Proposal::create($validatedData);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function insert_proposal($param) {
        $completed = CompleteProposal::where('user_id', Auth::user()->id)->selectRaw('count(id) as cnt')->first();
        if ($completed['cnt']) {
            return redirect('/proposals')->with('errorMsg', 'Anda sudah pernah menyelesaikan proses memilih skema Perhutanan Sosial. Daerah yang baru saja dipilih tidak akan diproses lebih lanjut.');
        } else{
            $param = base64_decode($param);
            $shp = ShpFile::where('is_regional', 'yes')->first();
            $new_region = DB::table($shp->table_name)->where('idd', $param)->first();
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'idd' => $param])->selectRaw('count(id) as cnt')->first();
            if (!$proposal['cnt']) {
                $skemapss = explode('-', $new_region->skema_ps);
                $validatedData['user_id'] = Auth::user()->id;
                $validatedData['shpfile_src'] = $shp->table_name;
                $validatedData['idd'] = $param;
                $validatedData['step1_skemaps'] = $new_region->skema_ps;
                $validatedData['step1_completed'] = now();
                $validatedData['status'] = 'onprocess';
                $validatedData['created_by'] = Auth::user()->username;
                $validatedData['modified_by'] = Auth::user()->username;
                if (count($skemapss) == 1) {
                    $validatedData['result_skemaps'] = $new_region->skema_ps;
                    $validatedData['result_completed'] = now();
                    $validatedData['status'] = 'completed';
                }
                Proposal::create($validatedData);
                if (count($skemapss) == 1) {
                    $cmpltd['user_id'] = Auth::user()->id;
                    $cmpltd['shpfile_src'] = $shp->table_name;
                    $cmpltd['idd'] = $param;
                    $cmpltd['skemaps'] = $new_region->skema_ps;
                    $cmpltd['completed'] = now();
                    $cmpltd['process_to_moodle'] = false;
                    $cmpltd['created_by'] = Auth::user()->username;
                    $cmpltd['modified_by'] = Auth::user()->username;
                    CompleteProposal::create($cmpltd);
                    if (Auth::user()->role == 'moodle_user') {
                        $mdl = new MoodleController();
                        $mdl->enrollUserToCourse(Auth::user()->id, $new_region->skema_ps);
                    }
                }
            }
            return redirect('/proposals');
        }
    }
}
