<?php

namespace App\Http\Controllers;

use App\Cover_Page;
use Illuminate\Http\Request;

class CoverPageController extends Controller
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
     * @param  \App\Cover_Page  $cover_Page
     * @return \Illuminate\Http\Response
     */
    public function show(Cover_Page $cover_Page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cover_Page  $cover_Page
     * @return \Illuminate\Http\Response
     */
    public static function getCoverPhotoOfItem($id)
    {
        //
        return  Cover_Page::all()->where('Item_Id', '=', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cover_Page  $cover_Page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cover_Page $cover_Page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cover_Page  $cover_Page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cover_Page $cover_Page)
    {
        //
    }
}
