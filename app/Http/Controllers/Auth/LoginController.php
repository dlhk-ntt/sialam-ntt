<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function index() {
        Cache::rememberForever('app', function () {
            return DB::table('app_infos')->select(['name','code','logo','moodle_token_expired'])->first();
        });
        return view('auth.login', [
            'page_title' => 'Masuk',
            // 'simple_footer' => true,
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required',
        ]);
        $credentials['password'] = 'L@nd4cC3sS' . $credentials['password'];
        $attempt = Auth::attempt($credentials);
        if ($attempt) {
            $request->session()->regenerate();
            // $request->session()->forget('url.intended'); <- disabled, in order to enable auto-redirect to intended page after login
            UserLog::create(['user_id' => Auth::user()->id]);
            return redirect()->intended('/proposals');
        }
        return back()->with('loginError', 'Gagal Masuk');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logout', 'yes');
    }
}
