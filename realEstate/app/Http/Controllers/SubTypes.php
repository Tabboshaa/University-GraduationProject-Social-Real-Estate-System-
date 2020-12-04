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
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Sub_Type',['main_type'=>$main_types]);
    }
//    function of drop downlist
    public function find(){

        $sub_type=Sub_Type::all()->where('Main_Type_Id','=',request('id'));

        return  response()->json($sub_type);


    }
    // //    function getSubTypeById: AJAX
    public function getSubTypeById($id)
    {
        $subtype= Sub_Type::all()->find($id);
        //return dd($subtype) ;
        return response()->json($subtype);
    }
    //  function  EDIT: AJAX

    public function editSubType()
    {
        
        $subtype= Sub_Type::all()->find(request('id'));
        $subtype->Main_Type_Id=request('MainTypeid');
        $subtype->Sub_Type_Name=request('SupTypeName');
        $subtype->save();

        return response()->json($subtype);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Sub_Type = Sub_Type::create([
            'Sub_Type_Name' => request('Sub_Type_Name'),
            'Main_Type_Id' => request('Main_Type_Name')
        ]);
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
        $sub_show=DB::table('sub__types')->join('main__types', 'sub__types.Main_Type_Id', '=', 'main__types.Main_Type_Id')
        ->select('sub__types.*', 'main__types.Main_Type_Name')->get();
       //DB join b3ml add l column el main type name le table el subtype w bb3to 3sha azhr el main type name 
       //fe table el show sub tye
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Sub_Types_Show',['sub_type'=>$sub_show,'main_type'=>$main_types]);
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
       //return dd(request()->all());
        $sub_types=Sub_Type::all();
        $main_types=Main_Type::all();
        $subtype= Sub_Type::all()->find($id);
        $subtype->Main_Type_Id=request('MainTypeName');
        $subtype->Sub_Type_Name=request('SubTypeName');


        $subtype->save();
        return redirect()->back();

        //return view('website.backend.database pages.Sub_Types_Show',['sub_type'=>$sub_types,'main_type'=>$main_types]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Sub_Type::destroy($request->id);
        return redirect()->route('subtype_show');

    }
}
