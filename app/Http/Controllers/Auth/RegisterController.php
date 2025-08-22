<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\MoodleController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register', [
            'page_title' => 'Mendaftarkan Pengguna Baru',
        ]);
    }

    public function store(Request $request) {
        $mdl = new MoodleController();
        $rules = [
            'username' => 'unique:users|required|max:255|alpha_dash|lowercase',
            'name' => 'required|max:255',
            'phone_no' => 'required|numeric|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed|min:5|max:255'
        ];
        $validatedData = $request->validate($rules);
        $validatedData['lastname'] = $request->lastname;
        $validatedData['password'] = bcrypt('L@nd4cC3sS' . $validatedData['password']);
        $validatedData['role'] = 'moodle_user';
        $validatedData['via_moodle'] = 'yes';
        $validatedData['created_by'] = 'system';
        $validatedData['modified_by'] = 'system';
        $id = User::create($validatedData)->id;
        $mdl->registerUser($id, $validatedData);
        return redirect('/login')->with('registerSuccess', 'Pendaftaran pengguna berhasil. Silakan masuk');
    }

    public function regadmin() {
        if (!User::cntSuperAdmin()) {
            return view('auth.regadmin', [
                'page_title' => 'Mendaftarkan Super Admin'
            ]);
        } else return redirect('/');
    }

    public function storeadmin(Request $request) {
        $rules = [
            'username' => 'unique:users|required|max:255|alpha_dash',
            'name' => 'required|max:255',
            'phone_no' => 'required|numeric|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed|min:5|max:255'
        ];
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt('L@nd4cC3sS' . $validatedData['password']);
        $validatedData['role'] = 'superadmin';
        $validatedData['via_moodle'] = 'no';
        $validatedData['created_by'] = 'system';
        $validatedData['modified_by'] = 'system';
        User::create($validatedData);
        return redirect('/login')->with('registerSuccess', 'Pendaftaran admin berhasil. Silakan masuk');
    }
}
