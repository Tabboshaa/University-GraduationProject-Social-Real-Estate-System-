<div class="modal fade" id="BeOwnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Need more information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/'.Auth::id())}}">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label style="font-size: 12pt">First Name</label>
                        <input type="text" style="border-radius: 3pt" name="First" class="form-control">

                    </div>

                    <div class="form-group">
                        <label style="font-size: 12pt">Middle Name</label>
                        <input type="text" style="border-radius: 3pt" name="Middle" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Last Name</label>
                        <input type="text" style="border-radius: 3pt" name="Last" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Phone Number</label>
                        <input type="text" style="border-radius: 3pt" name="Phone" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">National ID</label>
                        <input type="text" style="border-radius: 3pt" name="National" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Continue</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditCommentForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="edit_Comment" style="font-size: 12pt">Edit Comment</label>
                        <input type="text" style="border-radius: 3pt" name="edit_Comment" id="editComment" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditPostForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="edit_Post" style="font-size: 12pt">Edit Post</label>
                        <input type="text" style="border-radius: 3pt" name="edit_Post" id="editPost" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
    </div>

    </td>
    </tr>

    {{-- Input for comment --}}
    <tr>
        <td colspan="2">
            <input type="text" class="coment" id="CommentForPost{{$post->Post_Id}}" name="comment" placeholder="Write a comment...">
        </td>
        <td class="arrowStyleL">
            <a href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');"><i class="fas fa-arrow-right arrowStyle"></i></a>
        </td>
    </tr>

    {{-- Loop for comments --}}
    @if( isset($comments[$post->Post_Id]))
    @foreach($comments[$post->Post_Id] as $comment)
    {{-- Comment --}}
    <tr>
        <td colspan="3">
            <div class="commentt">
                <a class="Usr_name" href="">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}} </a><br>
                {{ $comment->Comment }}<br>
                <?php
                $end = \Carbon\Carbon::parse($comment->updated_at); ?>
                {{ $end->diffForHumans($today) }}
                <a id="viewReplies{{$comment->Comment_Id}}" href="javascript:void(0)" onclick="view('{{$comment->Comment_Id}}')">View Replies</a>
                <a href="javascript:void(0)" onclick="writeReplay('{{ $comment->Comment_Id}}')"> reply</a>

                @if($User_Id== $comment->User_Id )
                <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"> Delete</a>
                <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"> Edit</a>
                @endif
            </div>

        </td>
    </tr>

    {{-- Replies --}}
    <tr id="Replies{{$comment->Comment_Id}}"></tr>
    <div>
        {{-- Input for reply --}}
        <tr name="writeReplay{{$comment->Comment_Id}}" style="display: none;">

            <td colspan="2">
                <input type="text" class="replyyy" id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder=" Write a reply...">
            </td>
            <td class="arrowStyleL">
                <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');"><i class="fas fa-arrow-right arrowStyle"></i></a>
            </td>
        </tr>


    </div>

    @endforeach
    @endif
    </tbody>
    </table>
</div>