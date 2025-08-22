<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompleteProposal;
use Illuminate\Support\Facades\Auth;

class CompleteProposalController extends Controller
{
    public function index() {
        $data0 = CompleteProposal::orderBy('completed', 'desc')->select(['id','shpfile_src'])->get();
        $data = [];
        $fields = ['complete_proposals.id','user_id','skemaps','completed','process_to_moodle','nmprov','nmkab','nmkec','nmdesa'];
        foreach ($data0 as $d0) {
            $d1 = CompleteProposal::join($d0->shpfile_src, 'complete_proposals.idd', $d0->shpfile_src . '.idd')
                ->where('complete_proposals.id', $d0->id)->select($fields)->first();
            array_push($data, $d1);
        }
        return view('admin.completeproposal', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Pengajuan PS yang Sudah Selesai',
            'breadcrumb' => 'Pengaturan',
            'active' => 'proposal',
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id) {
        $updated['process_to_moodle'] = true;
        $updated['modified_by'] = Auth::user()->username;
        CompleteProposal::find($id)->update($updated);
        return redirect('/admin/proposal')->with('successMsg', 'Berhasil mengubah status pengajuan PS');
    }
}
