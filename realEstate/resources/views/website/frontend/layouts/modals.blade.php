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

<!-- <div class="modal fade" id="EditCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

