<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        //
        try{
        $notification = Notification::all()->where('To_User_Id', '=', Auth::id())->where('Viewed', '=', 0)->sortByDesc('created_at');

        return $notification;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($From_id, $To_id, $notification)
    {
        //
        DB::beginTransaction();
        try {
            Notification::create([
                'To_User_Id' => $To_id,
                'From_User_Id' => $From_id,
                'Notification' => $notification,
                'Viewed' => 0
            ]);
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
    }

    public static function createRedirect($From_id, $To_id, $notification, $redirect_to)
    {
        //
        DB::beginTransaction();
        try {
            if ($To_id != $From_id) { //check if user is not sent a notification to himself
                Notification::create([
                    'To_User_Id' => $To_id,
                    'From_User_Id' => $From_id,
                    'Notification' => $notification,
                    'Redirect_To' => $redirect_to,
                    'Viewed' => 0
                ]);
            }
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function viewNotification()
    {
        //
        
        DB::beginTransaction();
        
        try {
            $notification = Notification::all()->find(request('notification_id'));
            $notification->Viewed = 1;
            $notification->save();
            
            DB::commit();
            return back()->with('success', 'Notification Created Successfully');
        } catch (\Exception $e) {
        DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
            return back()->with('error', 'Error creating Notification !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        try{
        $notification =  DB::table('notifications')
            ->join('users', 'users.id', '=', 'notifications.From_User_Id')
            ->select('notifications.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'users.id')
            ->get()
            ->sortBy('created_at')
            ->reverse();
        return view('website.frontend.customer.Notification', ['notifications' => $notification]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
