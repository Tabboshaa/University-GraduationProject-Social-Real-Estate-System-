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
        try{
        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->paginate(10)
            ->where('items.Item_Id', '=', $id)
            ->get();
        }
        catch(\Exception $e){
            return back()->withError($e->getMessage())->withInput();
        }
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
        DB::beginTransaction();
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

            DB::commit();
            return back()->with('success', 'Image Added Successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Error  while Adding image !!');
        } catch (\Exception $e) {
            DB::rollBack();
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
            return attachment::all()->where('Attachment_Id', '=', $id)->first();
        } catch (\Exception $e) {
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
    public static function getPostAttachments($item_id)
    {
        //
        try{
        $post_attachment = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $item_id)
            ->get()
            ->groupBy('Post_Id');
        return $post_attachment;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }


}

    //function btgeeb attatchment bta3 post
    public static function getAttachmentsOfPosts($post_id)
    {
        //
        try{
        $post_attachment = DB::table('post_attachments')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('post_attachments.Post_Id', '=', $post_id)
            ->get();
        return $post_attachment;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public static function getAttachmentsOfuser($id)
    {
        //
        try{
        $post_attachment = DB::table('post_attachments')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->join('posts', 'posts.Post_Id', '=', 'post_attachments.Post_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('posts.User_Id', '=', $id)
            ->paginate(4);
        return $post_attachment;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
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
        DB::beginTransaction();

        try {
            attachment::destroy($id);
            DB::commit();
            return  redirect()->back()->with('success', 'Attachment Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Attachment cannot be deleted');
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
