<?php

use App\Http\Controllers\Admin\AppInfoController;
use App\Http\Controllers\AHPController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CompleteProposalController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ShpFileController;
use App\Http\Controllers\StaticPagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** Main Page */
// Route::get('/', function () {
//     return view('welcome');
// });

/** Login, Register, Logout */
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/regadmin', [RegisterController::class, 'regadmin'])->middleware('guest');
Route::post('/regadmin', [RegisterController::class, 'storeadmin']);

/***********************
|     Public Pages     |
***********************/
/** SHP File */
Route::controller(ShpFileController::class)->group(function() {
    Route::get('/shpfile/load/{id}', 'loadshp');
    Route::get('/shpfile/load/{id}/{param}', 'loadshp');
    Route::get('/shpfile/load2/{id}/{param}', 'loadshp2');
    Route::get('/shpfile/load3/{id}/{param}', 'loadshpregion');
    Route::get('/shpfile/field/{table}', 'getfields');
    Route::get('/shpfile/fieldvalue/{table}/{field}', 'getfieldvalue');
    Route::get('/shpfile/ones/{id}', 'previewone');
});
/** Land Access */
Route::controller(MapController::class)->group(function() {
    // Route::get('/', 'land_access');
    Route::get('/', 'land_access_plus');
    // Route::get('/land-access', 'land_access');
    Route::get('/land-access', 'land_access_plus');
    Route::get('/land-access/iframe', 'landaccess_iframe');
    Route::get('/land-access/iframe-plus', 'landaccess_iframe_plus');
});
/** Static Pages */
Route::controller(StaticPagesController::class)->group(function() {
    Route::get('/about', 'about');
    Route::get('/guides/{type}', 'guides');
});
/** Change password */
Route::controller(UserController::class)->group(function() {
    Route::get('/chgpassword', 'pubpassword');
    Route::post('/chkuser', 'pubcheckuser');
    Route::post('/updpassword', 'pubupdatepassword');
});

/**************************
|     User-only Pages     |
***************************/
Route::middleware('auth')->group(function() {
    /** Landing Page */
    // Route::get('/', [HomeController::class, 'proposallist']);
    Route::get('/home', [HomeController::class, 'proposallist'])->name('home');
    Route::get('/proposals', [HomeController::class, 'proposallist']);
    Route::put('/proposals/cancel/{param}', [HomeController::class, 'cancelproposal']);
    Route::get('/introduction/{param}', [HomeController::class, 'index']);

    /** User */
    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'show');
        Route::get('/user/edit', 'useredit');
        Route::put('/user/update', 'userupdate');
        Route::get('/user/password', 'userpassword');
        Route::put('/user/updatepass', 'userupdatepass');
    });
    /** Land Info (Step 1) */
    Route::controller(RegionController::class)->group(function() {
        Route::get('/step-1/{param}', 'show_region');
        // Route::get('/region/{param}', 'check_proposal');
        // Route::post('/region/change', 'change_region');
        Route::get('/region/{param}', 'insert_proposal');
    });
    /** Questionnaire (Step 2) */
    Route::controller(QuestionnaireController::class)->group(function() {
        Route::get('/step-2/{param}', 'show_questionnaire');
        Route::post('/questionnaire/assess', 'assess_questionnaire');
        Route::post('/questionnaire/finalize', 'finalize_questionnaire');
    });
    /** AHP (Step 3) */
    Route::controller(AHPController::class)->group(function() {
        Route::get('/step-3/{param}', 'show_ahp');
        Route::post('/ahp/do', 'do_ahp');
        Route::post('/ahp/finalize', 'finalize_ahp');
    });
    /** Result */
    Route::controller(ResultController::class)->group(function() {
        Route::get('/result/{param}', 'show_result');
        Route::post('/result/finalize', 'finalize_skemaps');
        Route::get('/result/pdf/{param}', 'genpdf');
        Route::get('/result/map/{param}', 'regionmap');
        Route::post('/result/genmap', 'genregionmap');
        });
    /** Export Region Map */
    Route::get('/shpfile/one/{id}', [ShpFileController::class, 'previewone']);
});

/**********************
|     Admin Pages     |
**********************/
Route::middleware(['auth','admin'])->group(function() {
    Route::get('/admin', [HomeAdminController::class, 'index']);
    /** App Info */
    Route::controller(AppInfoController::class)->group(function() {
        Route::get('/admin/appinfo', 'show');
        Route::put('/admin/appinfo', 'update');
        Route::get('/admin/linkmoodle', 'show_moodle');
        Route::put('/admin/linkmoodle', 'update_moodle');
    });
    /** User */
    Route::controller(UserController::class)->group(function() {
        Route::get('/admin/user', 'index');
        Route::get('/admin/user/{id}/detail', 'detail');
        Route::get('/admin/user/add', 'add');
        Route::post('/admin/user/store', 'store');
        Route::get('/admin/user/{id}', 'edit');
        Route::put('/admin/user/{id}', 'update');
        Route::get('/admin/user/pass/{id}', 'password');
        Route::put('/admin/user/pass/{id}', 'updatepassword');
        Route::delete('/admin/user/{id}', 'destroy');
    });
    /** SHP File */
    Route::controller(ShpFileController::class)->group(function() {
        Route::get('/admin/shpfile', 'index');
        Route::get('/admin/shpfile/{id}/detail', 'detail');
        Route::get('/admin/shpfile/{id}/preview', 'preview');
        Route::get('/admin/shpfile/{id}/one', 'previewone');
        Route::get('/admin/shpfile/{id}/downloadone', 'downloadone');
        Route::get('/admin/shpfile/add', 'add');
        Route::post('/admin/shpfile/store', 'store');
        Route::post('/admin/shpfile/storezip', 'storezip');
        Route::get('/admin/shpfile/merge', 'merge');
        Route::post('/admin/shpfile/domerge', 'domerge');
        Route::get('/admin/shpfile/{id}', 'edit');
        Route::put('/admin/shpfile/{id}', 'update');
        Route::delete('/admin/shpfile/{id}', 'destroy');
    });
    /** Completed Proposals */
    Route::controller(CompleteProposalController::class)->group(function() {
        Route::get('/admin/proposal', 'index');
        Route::put('/admin/proposal/{id}', 'update');
    });
});
