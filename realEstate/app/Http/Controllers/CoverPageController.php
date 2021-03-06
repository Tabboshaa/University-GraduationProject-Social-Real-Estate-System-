<?php

namespace App\Http\Controllers;

use App\Cover_Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        if ($files = request()->file('CoverPage')) {

            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');

            try {
                Cover_Page::create([
                    'path' =>  $filename,
                    'Item_Id' => $id,
                ]);
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
        try{
        return  Cover_Page::all()->where('Item_Id', '=', $id)->first();
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cover_Page  $cover_Page
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {

        try {
            if ($files = request()->file('CoverPageUpdate')) {


                $filename = $files->getClientOriginalName();
                $files->storeAs('/cover page', $filename, 'public');

            $filename = $files->getClientOriginalName();
            $files->storeAs('/cover page', $filename, 'public');

            // }
            
                $coverPage = Cover_Page::all()->find($id);
                //hy7ot el name el gded f column el country name
                $coverPage->path = $filename;
                $coverPage->save();

                return redirect()->back();
        
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
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
        DB::beginTransaction();

        try {
            if (File::exists($myFile)) {
                File::delete($myFile);
            }
            Cover_Page::destroy($id);
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
