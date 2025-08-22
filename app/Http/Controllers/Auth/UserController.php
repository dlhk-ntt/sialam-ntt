<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\MoodleController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /** Non-login Functions */
    public function pubpassword() {
        return view('admin.user.pubpassword', [
            'page_title' => 'Ubah Password Pengguna',
        ]);
    }

    public function pubcheckuser(Request $request) {
        $user = User::where(['username' => $request->username, 'phone_no' => $request->phone_no])
                ->select('id', 'name', 'username')
                ->first();
        return response()->json(['data' => $user]);
    }

    public function pubupdatepassword(Request $request) {
        $id = $request->id;
        $rules = [ 'password' => 'required|confirmed|min:5|max:255' ];
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt('L@nd4cC3sS' . $validatedData['password']);
        $validatedData['modified_by'] = (Auth::user() ? Auth::user()->username : 'publicuser');
        User::find($id)->update($validatedData);
        return true;
    }

    /** User Functions */
    public function show() {
        $data = User::find(Auth::user()->id);
        return view('auth.userdetail', [
            'page_title' => 'Detail Pengguna',
            'page_title2' => '<span class="icraf-green">Detail</span> <span class="icraf-orange">Pengguna</span>',
            'breadcrumb' => 'Pengguna|Detail Pengguna',
            'data' => $data,
            'active' => 'user',
            'title_on_header' => true,
        ]);
    }

    public function useredit() {
        $data = User::find(Auth::user()->id);
        return view('auth.useredit', [
            'page_title' => 'Ubah Detail Pengguna',
            'page_title2' => '<span class="icraf-green">Ubah</span> <span class="icraf-orange">Detail Pengguna</span>',
            'breadcrumb' => 'Pengguna|Detail Pengguna|Ubah Detail Pengguna',
            'data' => $data,
            'title_on_header' => true,
        ]);
    }

    public function userupdate(Request $request) {
        $id = Auth::user()->id;
        $rules = [
            'name' => 'required|max:255',
            'phone_no' => 'required|numeric',
            'email' => 'required|email:dns|unique:users,email,' . $id,
        ];
        $validatedData = $request->validate($rules);
        $validatedData['lastname'] = $request->lastname;
        $validatedData['provinsi'] = $request->provinsi;
        $validatedData['kabkota'] = $request->kabkota;
        $validatedData['kecamatan'] = $request->kecamatan;
        $validatedData['desa'] = $request->desa;
        $validatedData['modified_by'] = Auth::user()->username;
        User::find($id)->update($validatedData);
        return redirect('/user')->with('successMsg', 'Berhasil mengubah detail pengguna');
    }

    public function userpassword() {
        return view('auth.userpassword', [
            'page_title' => 'Ubah Password Pengguna',
            'page_title2' => '<span class="icraf-green">Ubah</span> <span class="icraf-orange">Password Pengguna</span>',
            'breadcrumb' => 'Pengguna|Detail Pengguna|Ubah Password Pengguna',
            'title_on_header' => true,
        ]);
    }

    public function userupdatepass(Request $request) {
        $id = Auth::user()->id;
        $rules = [ 'password' => 'required|confirmed|min:5|max:255' ];
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt('L@nd4cC3sS' . $validatedData['password']);
        $validatedData['modified_by'] = Auth::user()->username;
        User::find($id)->update($validatedData);
        return redirect('/user')->with('successMsg', 'Berhasil mengubah password pengguna');
    }

    /** Admin Functions */
    public function index() {
        $data = User::orderBy('id')->get();
        return view('admin.user.index', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Manajemen Pengguna',
            'breadcrumb' => 'Pengaturan',
            'active' => 'user',
            'data' => $data,
        ]);
    }

    public function detail($id) {
        $phone = str_replace(' ', '_', 'No. Telepon');
        $email = str_replace(' ', '_', 'Email');
        $data = User::where('id', $id)->select('phone_no AS ' . $phone, 'email AS ' . $email)->first();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function add() {
        return view('admin.user.add', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Tambah Pengguna',
            'breadcrumb' => 'Pengaturan',
            'active' => 'user'
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'username' => 'unique:users|required|max:255|lowercase',
            'name' => 'required|max:255',
            'phone_no' => 'required|numeric',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed|min:5|max:255'
        ];
        $validatedData = $request->validate($rules);
        $validatedData['lastname'] = $request->lastname;
        $validatedData['password'] = bcrypt('L@nd4cC3sS' . $validatedData['password']);
        $validatedData['role'] = $request->role;
        $validatedData['created_by'] = Auth::user()->username;
        $validatedData['modified_by'] = Auth::user()->username;
        $id = User::create($validatedData)->id;
        if ($request->role == 'moodle_user') {
            $mdl = new MoodleController();
            $mdl->registerUser($id, $validatedData);
        }
        return redirect('/admin/user')->with('successMsg', 'Berhasil menambahkan pengguna');
    }

    public function edit($id) {
        return view('admin.user.edit', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Ubah Pengguna',
            'breadcrumb' => 'Pengaturan',
            'data' => User::find($id),
            'active' => 'user'
        ]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|max:255',
            'phone_no' => 'required|numeric',
            'email' => 'required|email:dns|unique:users,email,' . $id,
        ];
        $validatedData = $request->validate($rules);
        $validatedData['lastname'] = $request->lastname;
        $validatedData['role'] = $request->role;
        $validatedData['modified_by'] = Auth::user()->username;
        User::find($id)->update($validatedData);
        return redirect('/admin/user')->with('successMsg', 'Berhasil mengubah pengguna');
    }

    public function password($id) {
        return view('admin.user.password', [
            'page_title' => 'Pengaturan',
            'page_title2' => 'Edit Password',
            'breadcrumb' => 'Pengaturan',
            'data' => User::find($id),
            'active' => 'user'
        ]);
    }

    public function updatepassword(Request $request, $id) {
        $rules = [ 'password' => 'required|confirmed|min:5|max:255' ];
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt('L@nd4cC3sS' . $validatedData['password']);
        $validatedData['modified_by'] = Auth::user()->username;
        User::find($id)->update($validatedData);
        return redirect('/admin/user')->with('successMsg', 'Berhasil mengubah password pengguna');
    }

    public function destroy($id) {
        User::destroy($id);
        return redirect('/admin/user')->with('successMsg', 'Berhasil menghapus pengguna');
    }
}
