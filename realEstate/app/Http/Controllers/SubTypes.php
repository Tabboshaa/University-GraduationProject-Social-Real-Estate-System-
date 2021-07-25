<?php

namespace App\Http\Controllers;

use App\Main_Type;
use App\Sub_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class SubTypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
        $main_types = Main_Type::all();
        return view('website.backend.database pages.Sub_Type', ['main_type' => $main_types]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    //    function of drop downlist
    public function find()
    {
try{
        $sub_type = Sub_Type::all()->where('Main_Type_Id', '=', request('id'));

        return  response()->json($sub_type);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }}
    // //    function getSubTypeById: AJAX
    public function getSubTypeById($id)
    {
        try{
        $subtype = Sub_Type::all()->find($id);
        //return dd($subtype) ;
        return response()->json($subtype);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    //  function  EDIT: AJAX

    public function editSubType()
    {
        DB::beginTransaction();

        try {

            $subtype = Sub_Type::all()->find(request('id'));
            $subtype->Sub_Type_Name = request('SupTypeName');
//            $subtype->Main_Type_Id = request('MainTypeId');
            $subtype->save();

            DB::commit();
            return back()->with('info', 'Type Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already exist');
            }
            return back()->withError($e->getMessage())->withInput();
        }
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
            $Sub_Type = Sub_Type::create([
                'Sub_Type_Name' => request('Sub_Type_Name'),
                'Main_Type_Id' => request('Main_Type_Name')
            ]);
            DB::commit();
            return back()->with('success', 'Type Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Type Already Exists !!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
        return $this->index();
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
        try{
        $sub_show = DB::table('sub__types')->join('main__types', 'sub__types.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->select('sub__types.*', 'main__types.Main_Type_Name')->paginate(10);
        //DB join b3ml add l column el main type name le table el subtype w bb3to 3sha azhr el main type name
        //fe table el show sub tye
        $main_types = Main_Type::paginate(10);
        return view('website.backend.database pages.Sub_Types_Show', ['S1' => $sub_show, 'main_type' => $main_types]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($id)
    {

        DB::beginTransaction();

        try {

            $subtype = Sub_Type::all()->find($id);
            $subtype->Main_Type_Id = request('MainTypeName');
            $subtype->Sub_Type_Name = request('SubTypeName');
            $subtype->save();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Duplicated data');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        if (request()->has('id')) {
            DB::beginTransaction();

            try {
                Sub_Type::destroy($request->id);
                DB::commit();
                return redirect()->route('subtype_show')->with('success', 'Type Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError($e->getMessage())->withInput();
                return redirect()->route('subtype_show')->with('error', 'Type cannot be deleted');
            }
        } else return redirect()->route('subtype_show')->with('warning', 'No type was chosen to be deleted.. !!');
    }
}
