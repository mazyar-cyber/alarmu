<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use IPPanel\Client;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        if ($request->code != Auth::user()->sentCode) {
            \Illuminate\Support\Facades\Session::flash('code-is-false', "اعتبار سنجی  انجام نشد");
            throw \Illuminate\Validation\ValidationException::withMessages(['code' => 'کد وارد شده با کد ارسال شده مطابقت ندارد']);
        } else {
            $model = User::find(Auth::id());
            $model->phoneNumber_verified = Carbon::now();
            $model->save();
            \Illuminate\Support\Facades\Session::flash('verify-successful', "اعتبار سنجی با موفقیت انجام شد");
            Session::forget('code-is-false');
            return redirect()->to('/dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendSms()
    {
        $user = Auth::user();
        $api_key = env('SMS_API_KEY');
        $client = new Client($api_key);
        $code = rand(100000, 200000);
        $patternValues = [
            "code" => "$code",
        ];

        if (!Session::has('code-is-false')) {
            // return 'session exist!';
            $bulkID = $client->sendPattern(
                "gwvzqwo0n1y7dy1",    // pattern code
                "+983000505",      // originator
                "$user->phoneNumber",  // recipient
                $patternValues,  // pattern values
            );

            $message = $client->getMessage($bulkID);
            if ($message->status != 'active') {
                return $message->status;
            }

            $model = User::find(Auth::id());
            $model->sentCode = $code;
            $model->save();
        }
        // return 'test';

        return view('admin.sms.sendCode');
    }
}
