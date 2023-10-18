<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', function () {
    return redirect()->route('emart_home');
});

// Route::prefix('check')->group(function () {
//     Route::get('/another-check', function () {
//         return view('check')->name('another_check');
//     });

// });

Route::get('home', [EmartController::class, 'Home'])->name('emart_home');
Route::get('login', [EmartController::class, 'Login'])->name('emart_login');
Route::post('user-login', [EmartController::class, 'UserLogin'])->name('emart_userLogin');
Route::get('signup', [EmartController::class, 'Signup'])->name('emart_signup');
Route::post('save-account', [EmartController::class, 'SaveAcount'])->name('emart_saveAcount');
Route::post('logout', [EmartController::class, 'Logout'])->name('emart_logout');

Route::get('/another-check', [EmartController::class, 'Check'])->name('another_check');
Route::post('save-category', [EmartController::class, 'MasterSaveCategory'])->name('emart_saveCategory');
Route::post('save-item', [EmartController::class, 'MasterSaveItem'])->name('emart_saveItem'); 

Route::post('/save_product_image', [EmartController::class, 'Upload'])->name('emart_upload_image');