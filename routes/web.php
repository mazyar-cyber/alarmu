<?php

use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use IPPanel\Client;
use IPPanel\Errors\Error;
use IPPanel\Errors\HttpException;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::middleware('smsVerify')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard.index');
        });
        Route::middleware('isAdmin')->group(function () {
            Route::resource('users', UserController::class);
            Route::delete('deleteSelectedUsers', [UserController::class, 'deleteSelected'])->name('users.selectedDel');
        });
    });


    Route::get('sendSms', [MainController::class, 'sendSms']);
    Route::post('checkCodeForSMSVerify', [MainController::class, 'store']);
});

// Route::get('dashboard', function () {
//     return view('admin.dashboard.index');
// })->middleware('auth','smsVerify');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', function () {
    Auth::logout();
    return redirect()->back();
});

Route::get('testSMS', function () {
    $api_key = env('SMS_API_KEY');
    $client = new Client($api_key);

    $patternValues = [
        "code" => "9562621",
    ];

    $bulkID = $client->sendPattern(
        "gwvzqwo0n1y7dy1",    // pattern code
        "+983000505",      // originator
        "989931173016",  // recipient
        $patternValues,  // pattern values
    );


    //  $bulkID = $client->send(
    //     "+983000505",          // originator
    //     ["989931173016"],    // recipients
    //     "your code is: 545455454" // message
    // );

    // return $message = $client->get_message($bulkID);
});
