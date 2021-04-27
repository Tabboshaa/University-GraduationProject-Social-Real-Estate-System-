<?php

namespace App\Http\Controllers;

use App\CoverPhoto;
use App\attachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



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
        $attachment = attachment::create(['File_Path' => $filename]);

        // }
        try {
            $coverPhoto = CoverPhoto::create([
                'User_Id'=> Auth::id(),
                'Cover_Photo'=>$attachment->Attachment_Id
            ]);
            return back();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
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
         $attachment_id =CoverPhoto::all()->where('User_Id', '=', $id)->first()->Cover_Photo;
            return AttachmentController::getAttachment($attachment_id);

        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoverPhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoverPhoto $coverPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoverPhoto  $coverPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null,$File_Path=null)
    {
        $myFile = 'storage/cover page/'.$File_Path;
         Storage::disk('cover page')->delete($myFile);

       
        
       // File::delete($myFile);
        //return $myFile;
        

    }

    public static function sendCoverPhotoToProfile($id)
    {
        //
        try {
            $coverPhoto=CoverPhoto::all()->where('User_Id', '=', $id)->first();
            // $attachment_id =CoverPhoto::all()->where('User_Id', '=', $id)->first()->Cover_Photo;
            $File_Path=AttachmentController::getAttachment($coverPhoto->Cover_Photo);
            return ['Photo_Id'=>$coverPhoto->Photo_Id,'File_Path'=>$File_Path];

        } catch (Exception $e) {
            return null;
        }
    }
}
