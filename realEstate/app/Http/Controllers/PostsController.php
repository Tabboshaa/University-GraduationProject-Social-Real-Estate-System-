<?php

namespace App\Http\Controllers;

use App\attachment;
use App\Item;
use App\post_attachment;
use App\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'item_id' => $id,
            'posts' => $posts,
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
    public function create($id = null)
    {
        //
        if ($id != null) {
            $item = Item::all()->find($id);
            $user_id = $item->User_Id;
        } else $user_id = Auth::id();

        DB::beginTransaction();
        try {
            $post = posts::create([
                'Item_Id' => $id,
                'User_Id' => $user_id,
                'Post_Title' => ' ',
                'Post_Content' => request('Post_Content'),
            ]);

            if ($files = request()->file('images')) {
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $file->storeAs('/profile gallery', $filename, 'public');

                    $attachment = attachment::create(['File_Path' => $filename]);

                    $post_attachment = post_attachment::create([
                        'Post_Id' => $post->Post_Id,
                        'Attachment_Id' =>  $attachment->Attachment_Id,
                        'Item_Id' => $id
                    ]);
                }
            }


            DB::commit();
            return back()->with('success', 'Post Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
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
    public static function postCreatedBy($id)
    {
        //
        return $user = posts::all()->where('Post_Id', '=', $id)->first()->User_Id;
        return $user;
    }

    public static function userPosts($id)
    {
        //
        $posts = posts::all()->where('User_Id', '=', $id)->sortByDesc('updated_at');

        return $posts;
    }

    public function DestroyPost(Request $request, $id = null)
    {

        DB::beginTransaction();      
        try {
            posts::destroy($request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Post Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Comment cannot be deleted');
        }
    }
    public function editPost()
    {

        DB::beginTransaction();
        try {

            $post = posts::all()->find(request('id'));
            $post->Post_Content = request('edit_Post');
            $post->save();

            DB::commit();
            return back()->with('info', 'post Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing item');
            }
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
        DB::beginTransaction();

        try {
            posts::destroy($id);
            DB::commit();
            return  redirect()->back()->with('success', 'Post Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
            return redirect()->back()->with('error', 'Post cannot be deleted');
        }
    }

    public static function getItemPosts($item_id)
    {
        //
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.User_Id')
            ->join('items', 'items.Item_Id', '=', 'posts.Item_Id')
            ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'posts.User_Id')
            ->LeftJoin('cover__pages', 'cover__pages.Item_Id', '=', 'posts.Item_Id')
            ->where('posts.Item_Id', '=', $item_id)
            ->select('posts.*','users.First_Name', 'users.Middle_Name', 'users.Last_Name','items.Item_Name','cover__pages.path')
            ->orderBy('updated_at', 'DESC')
            ->get();



        // $user =User::select('First_Name','Middle_Name','Last_Name')->where('id', '=', )->get();

        return $posts;
    }
}
