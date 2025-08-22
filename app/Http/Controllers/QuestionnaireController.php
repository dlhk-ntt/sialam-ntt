<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\MoodleController;
use Exception;
use App\Models\ShpFile;
use App\Models\Proposal;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use App\Models\CompleteProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function show_questionnaire($param) {
        try{
            $param2 = explode('_', base64_decode($param));
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                $region = DB::table($proposal->shpfile_src)->where('idd', $proposal->idd)->select(['nmprov','nmkab','nmkec','nmdesa','skema_ps'])->first();
                $skemapss = explode('-', $proposal->step1_skemaps);
                $question_where = [];
                foreach ($skemapss as $k => $v) {
                    if ($v == 'HA') $question_where['is_HA'] = true;
                    else if ($v == 'HD') $question_where['is_HD'] = true;
                    else if ($v == 'HKm') $question_where['is_HKm'] = true;
                    else if ($v == 'HTR') $question_where['is_HTR'] = true;
                    else if ($v == 'KK') $question_where['is_KK'] = true;
                }
                // $questions = Question::where('status', 'active')->where($first_cond)->orWhere($question_where)->toSql();
                $questions = Question::where(function($query) use ($question_where) {
                    $query->orWhere($question_where);
                })->where('status', 'active')->orderBy('order')->get();
                return view('steps.2-questionnaire', [
                    'page_title' => 'Kuesioner',
                    'active' => 'step-2',
                    'proposal' => $proposal,
                    'region' => $region,
                    'skema_ps' => $skemapss,
                    'questions' => $questions,
                    'urlparam' => $param,
                    'modal_ps' => true,
                ]);
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function assess_questionnaire(Request $request) {
        try{
            $proposal_id = $request->proposal_id;
            $param = base64_decode($request->param);
            $paramm = json_decode($param);
            $skema_ps = explode(',', $request->skema_ps);
            $score_ps = [];
            $points = [];
            $cnt_answers = [];
            $skemaps_rekom = [];
            foreach ($skema_ps as $s) {
                $score = 0;
                $point = [];
                $answers = QuestionAnswer::join('questions', 'question_answers.question_id', 'questions.id')->where(['skema_ps' => $s, 'status' => 'active'])->orderBy('code')->get();
                foreach ($answers as $a) {
                    $code = $a->question->code;
                    if ($a->exp_answer == $paramm->$code) {
                        $score++;
                        array_push($point, $code);
                    }
                }
                if ($s != 'HA') {
                    // workaround for question 1 & 2 (interchangeable) and question 7 & 8 (interchangeable)
                    if ((isset($paramm->A) && isset($paramm->B)) && $paramm->A == $paramm->B) $score--;
                    if ((isset($paramm->G) && isset($paramm->H)) && $paramm->G == $paramm->H) $score--;
                    $cnt_answer = count($answers) - 2;
                    if ($s == 'HD') { // workaround for question 5 & 15 (answer yes or no yields 1 point)
                        $cnt_answer -= 2;
                    } else if ($s == 'HKm') { // workaround for question 5, 13 & 15 (answer yes or no yields 1 point)
                        $cnt_answer -= 3;
                    } else if ($s == 'KK') { // workaround for question 5, 13, 14 & 15 (answer yes or no yields 1 point)
                        $cnt_answer -= 4;
                    }
                } else $cnt_answer = count($answers);
                $points[$s] = $point;
                $score_ps[$s] = $score;
                $cnt_answers[$s] = $cnt_answer;
                if ($score == $cnt_answer) array_push($skemaps_rekom, $s);
            }
            if (count($skemaps_rekom)) $skemaps_rekom = implode(', ', $skemaps_rekom);
                else $skemaps_rekom = '-';
            $updatedData['step2_answers'] = $param;
            $updatedData['step2_skemaps'] = str_replace(', ', '-', $skemaps_rekom);
            $updatedData['step2_scoreskemaps'] = json_encode($score_ps);
            $updatedData['modified_by'] = Auth::user()->username;
            Proposal::find($proposal_id)->update($updatedData);
            $result = [$skemaps_rekom, $score_ps, $cnt_answers, $points];
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function finalize_questionnaire(Request $request) {
        $proposal_id = $request->proposal_id;
        $proposal = Proposal::find($proposal_id);
        $updatedData['step2_completed'] = now();
        $updatedData['modified_by'] = Auth::user()->username;
        if (count(explode('-', $proposal['step2_skemaps'])) == 1) {
            $updatedData['result_skemaps'] = $proposal->step2_skemaps;
            $updatedData['result_completed'] = now();
            $updatedData['status'] = 'completed';
        }
        Proposal::find($proposal_id)->update($updatedData);
        if (count(explode('-', $proposal['step2_skemaps'])) == 1) {
            $cmpltd['user_id'] = Auth::user()->id;
            $cmpltd['shpfile_src'] = $proposal->shpfile_src;
            $cmpltd['idd'] = $proposal->idd;
            $cmpltd['skemaps'] = $proposal->step2_skemaps;
            $cmpltd['completed'] = now();
            $cmpltd['process_to_moodle'] = false;
            $cmpltd['created_by'] = Auth::user()->username;
            $cmpltd['modified_by'] = Auth::user()->username;
            CompleteProposal::create($cmpltd);
            if (Auth::user()->role == 'moodle_user') {
                $mdl = new MoodleController();
                $mdl->enrollUserToCourse(Auth::user()->id, $proposal->step2_skemaps);
            }
            return 'result';
        } else {
            return 'step-3';
        }
    }
}
