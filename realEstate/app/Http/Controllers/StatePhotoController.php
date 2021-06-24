<?php

namespace App\Http\Controllers;

use App\State_photo;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\attachment;
class StatePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries=Country::all();
        $state=State::all();
    
        return view('website\backend.database pages.StatePhoto', ['country' => $countries,'state' => $state]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        //
       
        
        if ($files = request()->file('filename')) {

            $filename = $files->getClientOriginalName();
            $files->storeAs('/StatePhotos', $filename, 'public');

            $attachment=attachment::create(['File_Path' => $filename]);
            

            // }
            try {
             
               $statePhoto=State_Photo::create([
                'Attachment_Id'=>$attachment->Attachment_Id,
                'State_Id'=>request('State_Id')
               ]); 
               return back()->with('success', 'Photo Uploaded Successfully');
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
     * @param  \App\state_photo  $state_photo
     * @return \Illuminate\Http\Response
     */
    public function show(state_photo $state_photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\state_photo  $state_photo
     * @return \Illuminate\Http\Response
     */
    public function edit(state_photo $state_photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\state_photo  $state_photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, state_photo $state_photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\state_photo  $state_photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(state_photo $state_photo)
    {
        //
    }
}
