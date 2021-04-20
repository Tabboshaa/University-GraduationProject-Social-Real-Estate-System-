<?php

namespace App\Http\Controllers;

use App\CoverPhoto;
use App\ProfilePhoto;
use App\attachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Artisan;

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
            $attachment_id = ProfilePhoto::all()->where('User_Id', '=', $id)->first()->Profile_Picture;
            return AttachmentController::getAttachment($attachment_id);
        } catch (Exception $e) {
            return null;
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
        Artisan::call('storage:link');
        if ($files = request()->file('ProfilePhoto')) {

            // foreach ($files as $file) {

            $filename = $files->getClientOriginalName();
            $files->storeAs('/coverpage', $filename, 'public');

            $attachment = attachment::create(['File_Path' => $filename]);

            // }
            try {

                $ProfilePhoto  = ProfilePhoto::create([
                    'User_Id' => Auth::id(),
                    'Profile_Picture' => $attachment->Attachment_Id
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
    public function store(Request $request)
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
    public function edit(CoverPhoto $coverPhoto)
    {
        //
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
    public function destroy(CoverPhoto $coverPhoto)
    {
        //
    }
}
