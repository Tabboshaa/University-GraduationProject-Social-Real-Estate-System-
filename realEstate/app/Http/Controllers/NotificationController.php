<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($id)
    {
        //
        return  Notification::all()
            ->where('User_Id', '=', $id)
            ->where('Viewed', '=', 0)
            ->sortBy('created_at')
            ->reverse();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($id, $notification)
    {
        //
        try {
            Notification::created([
                'User_Id' => $id,
                'Notification' => $notification
            ]);
            return back()->with('success', 'Notification Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Error creating Notification !!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function viewNotification($id)
    {
        //
        try {
            $notification=Notification::all()->find($id);
            $notification->Viewed=1;
            $notification->save();

            return back()->with('success', 'Notification Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Error creating Notification !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
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
