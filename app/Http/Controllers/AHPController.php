<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ShpFile;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AHPController extends Controller
{
    public function show_ahp($param) {
        try{
            $param2 = explode('_', base64_decode($param));
            $proposal = Proposal::where(['user_id' => Auth::user()->id, 'id' => $param2[0], 'idd' => $param2[2]])->first();
            if ($proposal) {
                if (!$proposal->step2_completed && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) {
                    return redirect('/step-2/' . $param)->with('errorMsg', 'Anda belum menyelesaikan Langkah 2. Silakan selesaikan Langkah 2 terlebih dahulu.');
                } else {
                    $region = DB::table($proposal->shpfile_src)->where('idd', $proposal->idd)->select(['nmprov','nmkab','nmkec','nmdesa','skema_ps'])->first();
                    return view('steps.3-ahp', [
                        'page_title' => 'Analytic Hierarchy Process',
                        'active' => 'step-3',
                        'proposal' => $proposal,
                        'region' => $region,
                        'urlparam' => $param,
                        'modal_ps' => true,
                    ]);
                }
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function do_ahp(Request $request) {
        try {
            $lst_alternative = explode('-', $request->alternative);
            $lst_criteria = json_decode($request->criteria);
            $weight_criteria = json_decode($request->weight_criteria);
            $weight_alternative = json_decode($request->weight_alternative);

            // initialize
            $max_epoch = 10;
            $min_delta = 0.0001;
            $cnt_criteria = count($lst_criteria);
            $cnt_alternative = count($lst_alternative);
            $matrix_sq = [];
            $arrnormsum_matrixsq = [];
            $weight_criteria_goal_final = [];
            $weight_alternative_criteria_final = [];
            $global_weight_alternative_goal_final = [];
            $sorted_alternative = [];
            $RI = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59];
            $consistency_criteria = [];
            $consistency_criteria_2 = 0;
            $CR_criteria = 0;
            $CR_alternatives = [];
            $isConsistent = true;

            // calculate weight of criterias
            for ($iter = 0; $iter < $max_epoch; $iter++) {
                if ($iter > 0) $old_arrnormsum_matrixsq = $arrnormsum_matrixsq;
                $arrsum_matrixsq = [];
                $arrnormsum_matrixsq = [];
                $delta_arrnormsum_matrixsq = [];
                if ($iter == 0) $matrix = $weight_criteria;
                    else $matrix = $matrix_sq;
                for ($i = 0; $i<$cnt_criteria; $i++) {
                    for ($j = 0; $j<$cnt_criteria; $j++) {
                        $matrix_sq[$i][$j] = 0;
                        for ($k = 0; $k<$cnt_criteria; $k++) {
                            $matrix_sq[$i][$j] += round($matrix[$i][$k] * $matrix[$k][$j], 5);
                        }
                    }
                }
                for ($i = 0; $i<$cnt_criteria; $i++) {
                    $arrsum_matrixsq[$i] = array_sum($matrix_sq[$i]);
                }
                $sum_matrixsq = array_sum($arrsum_matrixsq);
                foreach ($arrsum_matrixsq as $a) {
                    array_push($arrnormsum_matrixsq, round($a/$sum_matrixsq, 5));
                }
                if ($iter > 0) {
                    for ($i=0; $i<count($arrnormsum_matrixsq); $i++) {
                        $delta_arrnormsum_matrixsq[$i] = abs($arrnormsum_matrixsq[$i] - $old_arrnormsum_matrixsq[$i]);
                    }
                    $below_delta = 0;
                    foreach ($delta_arrnormsum_matrixsq as $d) {
                        if ($d < $min_delta) $below_delta++;
                    }
                    if ($below_delta == count($delta_arrnormsum_matrixsq)) break;
                }
            }
            $weight_criteria_goal_final = $arrnormsum_matrixsq;

            // calculate weight of alternatives
            foreach ($weight_alternative as $wa) {
                $matrix_sq = [];
                $arrnormsum_matrixsq = [];
                for ($iter = 0; $iter < $max_epoch; $iter++) {
                    if ($iter > 0) $old_arrnormsum_matrixsq = $arrnormsum_matrixsq;
                    $arrsum_matrixsq = [];
                    $arrnormsum_matrixsq = [];
                    $delta_arrnormsum_matrixsq = [];
                    if ($iter == 0) $matrix = $wa;
                        else $matrix = $matrix_sq;
                    for ($i = 0; $i<$cnt_alternative; $i++) {
                        for ($j = 0; $j<$cnt_alternative; $j++) {
                            $matrix_sq[$i][$j] = 0;
                            for ($k = 0; $k<$cnt_alternative; $k++) {
                                $matrix_sq[$i][$j] += round($matrix[$i][$k] * $matrix[$k][$j], 5);
                            }
                        }
                    }
                    for ($i = 0; $i<$cnt_alternative; $i++) {
                        $arrsum_matrixsq[$i] = array_sum($matrix_sq[$i]);
                    }
                    $sum_matrixsq = array_sum($arrsum_matrixsq);
                    foreach ($arrsum_matrixsq as $a) {
                        array_push($arrnormsum_matrixsq, round($a/$sum_matrixsq, 5));
                    }
                    if ($iter > 0) {
                        for ($i=0; $i<count($arrnormsum_matrixsq); $i++) {
                            $delta_arrnormsum_matrixsq[$i] = abs($arrnormsum_matrixsq[$i] - $old_arrnormsum_matrixsq[$i]);
                        }
                        $below_delta = 0;
                        foreach ($delta_arrnormsum_matrixsq as $d) {
                            if ($d < $min_delta) $below_delta++;
                        }
                        if ($below_delta == count($delta_arrnormsum_matrixsq)) break;
                    }
                }
                array_push($weight_alternative_criteria_final, $arrnormsum_matrixsq);
            }

            // calculate global weight
            for ($i = 0; $i < $cnt_alternative; $i++) {
                $global_weight_alternative_goal_final[$i] = 0;
                for ($j = 0; $j < $cnt_criteria; $j++) {
                    $global_weight_alternative_goal_final[$i] += round($weight_criteria_goal_final[$j] * $weight_alternative_criteria_final[$j][$i], 5);
                }
            }
            arsort($global_weight_alternative_goal_final);
            foreach ($global_weight_alternative_goal_final as $k => $v) {
                $arr = [];
                $arr['alternative'] = $lst_alternative[$k];
                $arr['weight'] = round($v, 5);
                array_push($sorted_alternative, $arr);
            }

            // calculate for consistency
            // criteria
            if ($cnt_criteria > 2) {
                for ($i = 0; $i < $cnt_criteria; $i++) {
                    $consistency_criteria[$i] = 0;
                    for ($j = 0; $j < $cnt_criteria; $j++) {
                        $consistency_criteria[$i] += round($weight_criteria[$i][$j] * $weight_criteria_goal_final[$j], 5);
                    }
                }
                for ($i = 0; $i < $cnt_criteria; $i++) {
                    $consistency_criteria_2 += round($consistency_criteria[$i]/$weight_criteria_goal_final[$i], 5);
                }
                $consistency_criteria_2 = round($consistency_criteria_2/count($weight_criteria_goal_final), 5);
                $CI_criteria = round(($consistency_criteria_2 - count($weight_criteria_goal_final))/(count($weight_criteria_goal_final) - 1), 5);
                $CR_criteria = round($CI_criteria/$RI[count($weight_criteria_goal_final)], 5);
                if ($CR_criteria > 0.1) $isConsistent = false;
            }
            // alternative
            if ($cnt_alternative > 2) {
                for ($k = 0; $k < $cnt_criteria; $k++) {
                    $matrix = $weight_alternative[$k];
                    $weight = $weight_alternative_criteria_final[$k];
                    $consistency_criteria = [];
                    $consistency_criteria_2 = 0;
                    for ($i = 0; $i < $cnt_alternative; $i++) {
                        $consistency_criteria[$i] = 0;
                        for ($j = 0; $j < $cnt_alternative; $j++) {
                            $consistency_criteria[$i] += round($matrix[$i][$j] * $weight[$j], 5);
                        }
                    }
                    for ($i = 0; $i < $cnt_alternative; $i++) {
                        $consistency_criteria_2 += round($consistency_criteria[$i]/$weight[$i], 5);
                    }
                    $consistency_criteria_2 = round($consistency_criteria_2/count($weight), 5);
                    $CI_alternative = round(($consistency_criteria_2 - count($weight))/(count($weight) - 1), 5);
                    $CR_alternative = round($CI_alternative/$RI[count($weight)], 5);
                    array_push($CR_alternatives, $CR_alternative);
                    if ($CR_alternative > 0.1) $isConsistent = false;
                }
            }

            // save to DB
            $updatedData['step3_ahpobjective'] = $request->objective;
            $updatedData['step3_ahpcriteria'] = implode(',', $lst_criteria);
            $updatedData['step3_ahpcomparison'] = json_encode($weight_criteria);
            $updatedData['step3_ahpweight'] = json_encode($weight_alternative);
            $updatedData['step3_ahpweightcriteriagoal'] = json_encode($weight_criteria_goal_final);
            $updatedData['step3_ahpweightalternativecriteria'] = json_encode($weight_alternative_criteria_final);
            $updatedData['step3_skemaps'] = json_encode($sorted_alternative);
            $updatedData['step3_ahpCRcriteria'] = $CR_criteria;
            $updatedData['step3_ahpCRalternative'] = json_encode($CR_alternatives);
            $updatedData['step3_ahpisconsistent'] = $isConsistent;
            $updatedData['modified_by'] = Auth::user()->username;
            Proposal::find($request->proposal_id)->update($updatedData);
            $result = [$sorted_alternative, $CR_criteria, $CR_alternatives, $isConsistent];
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function finalize_ahp(Request $request) {
        $proposal_id = $request->proposal_id;
        $updatedData['step3_completed'] = now();
        $updatedData['modified_by'] = Auth::user()->username;
        Proposal::find($proposal_id)->update($updatedData);
        return 'result';
    }
}
