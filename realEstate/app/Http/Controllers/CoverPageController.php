<?php

namespace App\Http\Controllers;

use App\Cover_Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
    public function create($id)
    {
        //
        if ($files = request()->file('CoverPhoto')) {

            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');
           
            try {
            $coverPage = Cover_Page::create([
                'path' =>  $filename,
                'Item_Id' => $id,
            ]);
            return back();
            }catch (\Illuminate\Database\QueryException $e) {
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
    public function edit($id)
    {
        //
        if ($files = request()->file('CoverPhoto')) {


            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');

            // }
            try {
               
                $coverPage = Cover_Page::all()->find($id);
                //hy7ot el name el gded f column el country name
                $coverPage->path = $filename;
                $coverPage->save();
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Cover_Page  $cover_Page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $path)
    {

        $myFile = 'storage/cover page/' . $path;

        if (File::exists($myFile)) {
            File::delete($myFile);
        }
        try {
            Cover_Page::destroy($id);
            return back();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
    }
}
