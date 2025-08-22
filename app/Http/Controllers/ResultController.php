<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\MoodleController;
use PDF;
use Exception;
use App\Models\User;
use App\Models\ShpFile;
use App\Models\Proposal;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\CompleteProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function show_result($param) {
        try{
            $param2 = explode('_', base64_decode($param));
            // dd($param2);
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                if (!$proposal->step2_completed && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) {
                    return redirect('/step-2/' . $param)->with('errorMsg', 'Anda belum menyelesaikan Langkah 2. Silakan selesaikan Langkah 2 terlebih dahulu.');
                } else if (!$proposal->step3_completed && !(strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == 1) && !$proposal->step2_completed && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) {
                    return redirect('/step-3/' . $param)->with('errorMsg', 'Anda belum menyelesaikan Langkah 3. Silakan selesaikan Langkah 3 terlebih dahulu.');
                } else {
                    $question_where = [];
                    foreach (explode('-', $proposal->step1_skemaps) as $k => $v) {
                        if ($v == 'HA') $question_where['is_HA'] = true;
                        else if ($v == 'HD') $question_where['is_HD'] = true;
                        else if ($v == 'HKm') $question_where['is_HKm'] = true;
                        else if ($v == 'HTR') $question_where['is_HTR'] = true;
                        else if ($v == 'KK') $question_where['is_KK'] = true;
                    }
                    $region = DB::table($proposal->shpfile_src)->where('idd', $proposal->idd)->select(['idd','nmprov','nmkab','nmkec','nmdesa','skema_ps'])->first();
                    $questions = Question::where(function($query) use ($question_where) {
                        $query->orWhere($question_where);
                    })->where('status', 'active')->orderBy('order')->get();
                    return view('steps.4-result', [
                        'page_title' => 'Ringkasan Hasil',
                        'active' => 'result',
                        'proposal' => $proposal,
                        'region' => $region,
                        'urlparam' => $param,
                        'questions' => $questions,
                    ]);
                }
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function finalize_skemaps(Request $request) {
        $proposal_id = $request->proposal_id;
        $updatedData['result_skemaps'] = $request->skema_ps;
        $updatedData['result_completed'] = now();
        $updatedData['status'] = 'completed';
        $updatedData['modified_by'] = Auth::user()->username;
        Proposal::find($proposal_id)->update($updatedData);
        $proposal = Proposal::find($proposal_id);
        $cmpltd['user_id'] = Auth::user()->id;
        $cmpltd['shpfile_src'] = $proposal->shpfile_src;
        $cmpltd['idd'] = $proposal->idd;
        $cmpltd['skemaps'] = $request->skema_ps;
        $cmpltd['completed'] = now();
        $cmpltd['process_to_moodle'] = false;
        $cmpltd['created_by'] = Auth::user()->username;
        $cmpltd['modified_by'] = Auth::user()->username;
        CompleteProposal::create($cmpltd);
        if (Auth::user()->role == 'moodle_user') {
            $mdl = new MoodleController();
            $mdl->enrollUserToCourse(Auth::user()->id, $request->skema_ps);
        }
        return 'result';
    }

    public function genpdf($param) {
        try{
            // sleep(15);
            // set_time_limit(100);
            $param2 = explode('_', base64_decode($param));
            $proposal = Proposal::where(['user_id' => $param2[1], 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                if (!$proposal->step2_completed && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) {
                    return redirect('/step-2/' . $param)->with('errorMsg', 'Anda belum menyelesaikan Langkah 2. Silakan selesaikan Langkah 2 terlebih dahulu.');
                } else if (!$proposal->step3_completed && !(strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == 1) && !$proposal->step2_completed && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) {
                    return redirect('/step-3/' . $param)->with('errorMsg', 'Anda belum menyelesaikan Langkah 3. Silakan selesaikan Langkah 3 terlebih dahulu.');
                } else {
                    $map = ShpFile::where('table_name', $proposal->shpfile_src)->select('id')->first();
                    $user = User::find($param2[1], ['username', 'name', 'email', 'phone_no', 'provinsi', 'kabkota', 'kecamatan', 'desa']);
                    $question_where = [];
                    foreach (explode('-', $proposal->step1_skemaps) as $k => $v) {
                        if ($v == 'HA') $question_where['is_HA'] = true;
                        else if ($v == 'HD') $question_where['is_HD'] = true;
                        else if ($v == 'HKm') $question_where['is_HKm'] = true;
                        else if ($v == 'HTR') $question_where['is_HTR'] = true;
                        else if ($v == 'KK') $question_where['is_KK'] = true;
                    }
                    $region = DB::table($proposal->shpfile_src)->where('idd', $proposal->idd)->select(['idd','nmprov','nmkab','nmkec','nmdesa','skema_ps'])->first();
                    $questions = Question::where(function($query) use ($question_where) {
                        $query->orWhere($question_where);
                    })->where('status', 'active')->orderBy('order')->get();

                    // return view('steps.4-result_pdf', [
                    //     'user' => $user,
                    //     'map' => $map,
                    //     'page_title' => 'Ringkasan Hasil',
                    //     'active' => 'result',
                    //     'proposal' => $proposal,
                    //     'region' => $region,
                    //     'urlparam' => $param,
                    //     'questions' => $questions,
                    //     // 'regionmap' => $regionmap,
                    // ]);

                    $pdf = PDF::loadView('steps.4-result_pdf', [
                        'user' => $user,
                        'map' => $map,
                        'page_title' => 'Ringkasan Hasil',
                        'active' => 'result',
                        'proposal' => $proposal,
                        'region' => $region,
                        'urlparam' => $param,
                        'questions' => $questions,
                    ]);
                    return $pdf->download('export-skema-ps.pdf');
                }
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function regionmap(Request $request) {
        $shp_id = $request->i;
        $shp_name = $request->s;
        $idd = $request->d;
        if (($shp_id && $idd) || ($shp_name && $idd)) {
            $shp_name = base64_decode($shp_name);
            if ($shp_name) {
                $shp = ShpFile::where('table_name', $shp_name)->first();
                $map = $shp->id;
            } else if ($shp_id) {
                $map = $shp_id;
            }
            return view('steps.4-regionmap', [
                'map' => $map,
                'idd' => $idd
            ]);
        }
    }

    public function genregionmap(Request $request) {
        $img = $request->img;
        $img = substr($img, strpos($img, ',')+1);
        $folder = public_path() . '/map/' . $request->folder;
        $filename = $request->file . '.png';
        if (!is_dir($folder)) mkdir($folder, 0755, true);
        $success = file_put_contents($folder . '/' . $filename, base64_decode($img));
        if ($success) return true;
            else return false;
    }
}
