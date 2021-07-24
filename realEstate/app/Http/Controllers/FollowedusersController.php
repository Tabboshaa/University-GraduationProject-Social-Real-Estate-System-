<?php

namespace App\Http\Controllers;

use App\followedusers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $followed = followedusers::create([
                'following_user' => $id,
                'user_id' => Auth::id()
            ]);
            $to_user = $id;
            NotificationController::createRedirect(Auth::id(), $to_user, 'Started following you', '/view_User/' . Auth::id());
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Detail');
            }
        }
    }

    public static function UnfollowUser($id)
    {
        $followed = followedusers::all()->where('user_id', '=', Auth::id())->where('following_user', '=', $id)->first();
        DB::beginTransaction();
        try {
            followedusers::destroy($followed->id);
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
            return redirect()->back()->with('error', 'Detail cannot be deleted');
        }
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
