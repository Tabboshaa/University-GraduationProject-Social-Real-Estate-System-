<?php

namespace App\Http\Controllers;

use App\Main_Type;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class MainTypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('website.backend.database pages.Main_Types');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        try {
            $Main_Type = Main_Type::create([
                'Main_Type_Name' => request('Main_Type_Name'),
            ]);
            return back()->with('success', 'Main Type Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
            return back()->withError($e->getMessage())->withInput();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $main_types = Main_Type::paginate(10);
        return view('website.backend.database pages.Main_Types_Show', ['main_type1' => $main_types]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        DB::beginTransaction();
        
        try {
            $main_types = Main_Type::all()->find(request('id'));
            $main_types->Main_Type_Name = request('MainTypeName');
            $main_types->save();
            
            DB::commit();
            return back()->with('info', 'Main type Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Main Type');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (request()->has('mainType')) {
            DB::beginTransaction();
            
            try {
                Main_Type::destroy($request->mainType);
                DB::commit();
                return redirect()->route('main_types_show')->with('success', 'Main type Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return redirect()->route('main_types_show')->with('error', 'Main type cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('main_types_show')->with('warning', 'No type was chosen to be deleted.. !!');
    }
}
