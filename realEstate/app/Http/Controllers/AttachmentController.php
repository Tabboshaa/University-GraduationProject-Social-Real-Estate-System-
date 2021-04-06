<?php

namespace App\Http\Controllers;

use App\attachment;
use App\post_attachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')
            ->where('items.Item_Id', '=', $id)
            ->get();


        return view('website\backend\database pages\Item_Gallery', ['gallery' => $gallery, 'item_id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        try {

            if ($files = request()->file('images')) {
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $file->storeAs('/profile gallery', $filename, 'public');

                    $attachment = attachment::create(['File_Path' => $filename]);

                    $post_attachment = post_attachment::create([
                        'Post_Id' => null,
                        'Attachment_Id' =>  $attachment->Attachment_Id,
                        'Item_Id' => $id
                    ]);
                }
            }
            return back()->with('success', 'Attachment Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Error creating Attachment !!');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getAttachment($id)
    {
        //
        try {
            return attachment::all()->where('Attachment_Id', '=', $id)->first()->File_Path;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getPostAttachments($item_id)
    {
        //
        $post_attachment = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $item_id)
            ->get()
            ->groupBy('Post_Id');
        return $post_attachment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            attachment::destroy($id);
            return  redirect()->back()->with('success', 'Attachment Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->back()->with('error', 'Attachment cannot be deleted');
        }
    }
}
