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
        $user = Auth::user();
    
        // $item = DB::table('items')
        // ->join('cover__pages','items.Item_Id','cover__pages.Item_Id')
        // ->select('items.*','cover__pages.path')
        // ->where('items.User_ID','=',$User_Id )
        // ->get();

        $items = $user->items;
        return view('website.FrontEnd.Owner.Show_Item', ['items' => $items]);
    }
    public function create()
    {
        

    }
    public function show()
    {

    }
    public function getReservations(){
        $user = Auth::user();
        $items = $user->items;
// dd($items[0]->operations[0]->Operation_Id);
 return view('website.FrontEnd.Owner.Show_Reservations', ['items' => $items]);
    }

}
