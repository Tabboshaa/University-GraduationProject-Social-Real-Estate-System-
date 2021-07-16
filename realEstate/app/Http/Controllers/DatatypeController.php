<?php

namespace App\Http\Controllers;

use App\Datatype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatatypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('website/backend.database pages.Data_Type');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        DB::beginTransaction();
        try {
            $Data_Type = Datatype::create([
                'datatype' => request('Data_Type_Name')
            ]);
            DB::commit();
            return back()->with('success', 'Datatype Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Datatype Already Exist !!');
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
        $data_types = Datatype::paginate(10);
        return view('website/backend.database pages.Data_Type_Show', ['data_typess' => $data_types]);
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
            
            $data_type = Datatype::all()->find(request('id'));
            $data_type->datatype = request('DataTypeName');
            $data_type->save();
            
            DB::commit();
            return back()->with('info', 'Datatype Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Datatype');
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
    public function destroy()
    {
        //
        if (request()->has('id')) {

            DB::beginTransaction();
            try {
                Datatype::destroy(request('id'));
                DB::commit();        
                return  redirect()->route('data_type_show')->with('success', 'Datatype Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return redirect()->route('data_type_show')->with('error', 'Datatype cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('data_type_show')->with('warning', 'No Datatype was chosen to be deleted.. !!');
    }
}
