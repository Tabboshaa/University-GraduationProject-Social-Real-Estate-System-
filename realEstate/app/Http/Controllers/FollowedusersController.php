<?php

namespace App\Http\Controllers;

use App\followedusers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowedusersController extends Controller
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

    public static function FollowedUser($id)
    {
        $followed = followedusers::create([
            'following_user' => $id,
            'user_id' => Auth::id()
        ]);
        $followed->save();

        $to_user = $id;
        NotificationController::createRedirect(Auth::id(), $to_user, Auth::user()->First_Name.' '.Auth::user()->Middle_Name.' '.Auth::user()->Last_Name.' Started following you', '/view_User/' . Auth::id());
        return back();
    }
    public static function UnfollowUser($id)
    {
        $followed = followedusers::all()->where('user_id', '=', Auth::id())->where('following_user', '=', $id)->first();

        followedusers::destroy($followed->id);
        return back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function checkFollow($id)
    {
        //
        $followed = followedusers::all()->where('user_id', '=', Auth::id())->where('following_user', '=', $id)->first();
       
        if ($followed != null) {
            return true;
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\followedusers  $followedusers
     * @return \Illuminate\Http\Response
     */
    public function show(followedusers $followedusers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\followedusers  $followedusers
     * @return \Illuminate\Http\Response
     */
    public function edit(followedusers $followedusers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\followedusers  $followedusers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, followedusers $followedusers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\followedusers  $followedusers
     * @return \Illuminate\Http\Response
     */
    public function destroy(followedusers $followedusers)
    {
        //
    }
}
