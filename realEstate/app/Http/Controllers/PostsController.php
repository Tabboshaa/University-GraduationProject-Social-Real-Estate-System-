<?php

namespace App\Http\Controllers;

use App\attachment;
use App\Item;
use App\posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $posts = PostsController::getItemPosts($id);
        $comments = CommentsController::getPostComments($id);
        $replies = CommentsController::getPostreplies($id);
        $post_images = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)
            ->get()
            ->groupBy('Post_Id');

        return view('website.backend.database pages.Item_Posts', [
            'item_id' => $id, 'posts' => $posts,
            'post_images' => $post_images,
            'comments' => $comments,
            'replies' => $replies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $item = Item::all()->find($id);

        try {
            posts::create([
                'Item_Id' => $id,
                'User_Id' => $item->User_Id,
                'Post_Title' => request('Post_Title'),
                'Post_Content' => request('Post_Content'),
            ]);

            if($files=request()->file('images')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $attachment[] = [
                        'File_Path'=>$name,
                    ];

                }
                 attachment::insert($attachment);
                
            }


            return back()->with('success', 'Post Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Error creating Post !!');
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
    public function destroy($id)
    {
        //
         try {
         posts::destroy($id);
         return  redirect()->back()->with('success', 'Post Deleted Successfully');
     }catch (\Illuminate\Database\QueryException $e){

         return redirect()->back()->with('error', 'Post cannot be deleted');

     }

    }

    public static function getItemPosts($item_id)
    {
        //
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.User_Id')
            ->where('posts.Item_Id', '=', $item_id)
            ->select('posts.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')
            ->paginate(10);



        // $user =User::select('First_Name','Middle_Name','Last_Name')->where('id', '=', )->get();

        return $posts;
    }
}
