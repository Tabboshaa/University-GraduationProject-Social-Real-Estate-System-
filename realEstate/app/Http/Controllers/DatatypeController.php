<?php

namespace App\Http\Controllers;

use App\Datatype;
use Illuminate\Http\Request;

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
        //
        request()->validate([
            
            'Data_Type_Name' => ['required', 'string','max:225',"regex:'([A-Z][a-z]\s[A-Z][a-z])|([A-Z][a-z]*)'"] 
        ]);
        try {
            $Data_Type = Datatype::create([
                'datatype' => request('Data_Type_Name')
            ]);
            return back()->with('success', 'Item Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $data_types = Datatype::all();
        return view('website/backend.database pages.Data_Type_Show', ['data_types' => $data_types]);
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
        $data_type = Datatype::all()->find(request('id'));
        $data_type->datatype = request('DataTypeName');
        $data_type->save();

        return response()->jason($data_type);
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

        Datatype::destroy(request('id'));

        return redirect()->route('data_type_show');
    }
}
