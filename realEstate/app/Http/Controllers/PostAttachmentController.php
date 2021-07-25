<?php

namespace App\Http\Controllers;

use App\attachment;
use App\post_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostAttachmentController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post_attachment  $post_attachment
     * @return \Illuminate\Http\Response
     */
    public function show(post_attachment $post_attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post_attachment  $post_attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(post_attachment $post_attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post_attachment  $post_attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post_attachment $post_attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post_attachment  $post_attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(post_attachment $post_attachment)
    {
        //
    }
  public function  deleteImgFromGallery()
  {
    
    if (request()->has('id')) {
        DB::beginTransaction();        
        try{
            attachment::destroy(request('id'));
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
        }else{
            return null;
        }   
  }


}
