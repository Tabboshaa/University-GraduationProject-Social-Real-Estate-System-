<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cover_Page;
use App\Item;
use Illuminate\Support\Facades\DB;
class OwnerController extends Controller
{
    //
    public function index()
    {  
        $User_Id = Auth::id();
      
        $item = DB::table('items')
        ->join('cover__pages','items.Item_Id','cover__pages.Item_Id')
        ->select('items.*','cover__pages.path')
        ->where('items.User_ID','=',$User_Id )
        ->get();
        return view('website.FrontEnd.Owner.Show_Item', ['items' => $item]);
    }
    public function create()
    {
        

    }
    public function show()
    {

    }

}
