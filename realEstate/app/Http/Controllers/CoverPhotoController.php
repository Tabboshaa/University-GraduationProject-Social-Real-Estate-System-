<?php

namespace App\Http\Controllers;

use App\CoverPhoto;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CoverPhotoController extends Controller
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
    
        if ($files = request()->file('CoverPhoto')) {
            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');
            
            try {
                $coverPhoto = CoverPhoto::create([
                    'User_Id' => Auth::id(),
                    'Cover_Photo' => $filename
                ]);
              
            
                return back();
            } catch (\Exception $e) {
              $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'Already Exist !!');
                }
                return back();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        if ($files = request()->file('CoverPhoto')) {


            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');

            DB::beginTransaction();
            try {
                $coverPhoto = CoverPhoto::all()->where('User_Id', '=', Auth::id(),)->first();
                //hy7ot el name el gded f column el country name
                $coverPhoto->Cover_Photo = $filename;
                $coverPhoto->save();
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

    /**
     * Display the specified resource.
     *
     * @param  \App\CoverPhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(CoverPhoto $coverPhoto)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoverPhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    //badeeh el user id w bygbly el cover photo bta3too
    public static function getPhoto($id)
    {
        //
        try {
            $photo = CoverPhoto::all()->where('User_Id', '=', $id)->first();
            return $photo;
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
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
        if ($files = request()->file('CoverPhoto')) {


            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');


            DB::beginTransaction();
            try {

                $coverPhoto = CoverPhoto::all()->find(request('Photo_Id'));
                //hy7ot el name el gded f column el country name
                $coverPhoto->Cover_Photo = $filename;
                $coverPhoto->save();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoverPhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $path)
    {

        $myFile = 'storage/cover page/' . $path;
        DB::beginTransaction();
        
        try {
            if (File::exists($myFile)) {
                File::delete($myFile);
            }
            coverPhoto::destroy($id);
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

}
