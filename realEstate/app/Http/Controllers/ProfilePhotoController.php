<?php

namespace App\Http\Controllers;

use App\CoverPhoto;
use App\ProfilePhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProfilePhotoController extends Controller
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

    //badeeh el id bta3 el user w bygbly el profile photo bta3tooo
    public static function getPhoto($id)
    {
        //
        try {
            $photo = ProfilePhoto::all()->where('User_Id', '=', $id)->first();
            return $photo;
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if ($files = request()->file('ProfilePhoto')) {

            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');


            DB::beginTransaction();
            try {
                
                $ProfilePhoto  = ProfilePhoto::create([
                    'User_Id' => Auth::id(),
                    'Profile_Picture' => $filename
                ]);
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'Already Exist !!');
                }else{return $e->getMessage();}
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfilePhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(CoverPhoto $coverPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfilePhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        if ($files = request()->file('ProfilePhoto')) {


            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');


            DB::beginTransaction();
            
            try {
                $profilePhoto = ProfilePhoto::all()->where('User_Id', '=', Auth::id(),)->first();
                //hy7ot el name el gded f column el country name
                $profilePhoto->Profile_Picture =$filename;
                $profilePhoto->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'Already Exist !!');
                }else{ return $e->getMessage();}
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoverPhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
        if ($files = request()->file('ProfilePhoto')) {


            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');


            DB::beginTransaction();
            
            try {
                
                $profilePhoto = ProfilePhoto::all()->find(request('Photo_Id'));
                //hy7ot el name el gded f column el country name
                $profilePhoto->Profile_Picture = $filename;
                $profilePhoto->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'Already Exist !!');
                }
                return back()->withError($e->getMessage())->withInput();
            }
        }
    }


    public function destroy($id=null, $path=null)
    {

        return $path;
        $myFile = 'storage/cover page/' . $path;

        if (File::exists($myFile)) {
            File::delete($myFile);
        }
        try {
            ProfilePhoto::destroy($id);
            return back();
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
