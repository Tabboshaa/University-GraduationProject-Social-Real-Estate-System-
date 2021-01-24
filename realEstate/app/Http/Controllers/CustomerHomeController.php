<?php

namespace App\Http\Controllers;

use App\Cover_Page;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class CustomerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
     $state= StateController::getStates();
     return view("website.frontend.customer.CustomerHome",['states'=>$state]);
        // return view('');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemProfile($id)
    {
        //

            $state= StateController::getStates();
            $posts=PostsController::getItemPosts($id);

            $item=DB::table('items')
            ->join('users', 'users.id', '=', 'items.User_Id')
            ->select('items.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->where('Item_Id','=',$id)->first();

            $cover=Cover_Page::all()->where('Item_Id','=',$id)->first();

            $post_images=DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id','=',$id)
            ->get()
            ->groupBy('Post_Id');

            return view('website\frontend\customer\Item_Profile_Posts',['states'=>$state,'posts'=>$posts,'item'=>$item,'cover'=>$cover,'post_images'=>$post_images]);
        }

    public function itemDetails($id)
    {
        //

        $state= StateController::getStates();

        $item=DB::table('items')
        ->join('users', 'users.id', '=', 'items.User_Id')
        ->select('items.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->where('Item_Id','=',$id)->first();

        $cover=Cover_Page::all()->where('Item_Id','=',$id)->first();
        //schedule and location



        return view('website\frontend\customer\Item_Profile_Details',['states'=>$state,'item'=>$item,'cover'=>$cover]);
    }

    public function itemProfileGallery($id)
    {
        //

        $state= StateController::getStates();

        $item=DB::table('items')
        ->join('users', 'users.id', '=', 'items.User_Id')
        ->select('items.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->where('Item_Id','=',$id)->first();

        $gallery=DB::table('post_attachments')
        ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
        ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
        ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id','=',$id)->paginate(8);

        $cover=Cover_Page::all()->where('Item_Id','=',$id)->first();

        return view('website\frontend\customer\Item_Profile_Gallery',['states'=>$state,'item'=>$item,'cover'=>$cover,'gallery'=>$gallery]);
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
    }

    public function findItemInState()
    {
            $state_id= StateController::findstatebyname(request('search'));

           $items=DB::table('streets')
           ->rightJoin('items', 'streets.Street_Id', '=', 'items.Street_Id')
           ->where('State_Id','=',$state_id)->select('items.*')
           ->get();

           return $items;

    }
}
