{{--<div class="modal fade" id="BeOwnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{-- <div class="modal-dialog">--}}
{{-- <div class="modal-content">--}}
{{-- <div class="modal-header">--}}
{{-- <h5 class="modal-title" id="exampleModalLabel">Need more information</h5>--}}
{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{-- <span aria-hidden="true">&times;</span>--}}
{{-- </button>--}}
{{-- </div>--}}
{{-- <div class="modal-body">--}}
{{-- @if($checkIfOwner)--}}
{{-- <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/'.Auth::id())}}">--}}
{{-- @csrf--}}
{{-- <input type="hidden" name="id" id="id">--}}
{{-- @if(!Auth::user()->First_Name)--}}
{{-- <div class="form-group">--}}
{{-- <label style="font-size: 12pt">First Name</label>--}}
{{-- <input type="text" style="border-radius: 3pt" name="First" class="form-control">--}}
{{-- <input type="hidden" value="true" id="show">--}}
{{-- </div>--}}
{{-- @endif--}}
{{-- @if(!Auth::user()->Middle_Name)--}}
{{-- <div class="form-group">--}}
{{-- <label style="font-size: 12pt">Middle Name</label>--}}
{{-- <input type="text" style="border-radius: 3pt" name="Middle" class="form-control">--}}
{{-- <input type="hidden" value="true" id="show">--}}
{{-- </div>--}}
{{-- @endif--}}
{{-- @if(!Auth::user()->Last_Name)--}}
{{-- <div class="form-group">--}}
{{-- <label style="font-size: 12pt">Last Name</label>--}}
{{-- <input type="text" style="border-radius: 3pt" name="Last" class="form-control">--}}
{{-- <input type="hidden" value="true" id="show">--}}
{{-- </div>--}}
{{-- @endif--}}
{{-- @if(!$phone)--}}
{{-- <div class="form-group">--}}
{{-- <label style="font-size: 12pt">Phone Number</label>--}}
{{-- <input type="text" style="border-radius: 3pt" name="Phone" class="form-control">--}}
{{-- <input type="hidden" value="true" id="show">--}}
{{-- </div>--}}
{{-- @endif--}}
{{-- @if(!Auth::user()->National_ID)--}}
{{-- <div class="form-group">--}}
{{-- <label style="font-size: 12pt">National ID</label>--}}
{{-- <input type="text" style="border-radius: 3pt" name="National" class="form-control">--}}
{{-- <input type="hidden" value="true" id="show">--}}
{{-- </div>--}}
{{-- @endif--}}
{{-- <input type="hidden"  id="check" name="check" value="BeOwner">--}}
{{-- @if($checkIfOwner)--}}
{{-- <div class="form-group"><a href="javascript:void(0)" onclick="check();" class="btn btn-info" > Save Information</a></div>--}}
{{-- @else--}}
{{-- <div class="form-group"><a href="javascript:void(0)" onclick="check();" class="btn btn-info" > Just Save Information! Or</a></div>--}}
{{-- <button type="submit" id="btun3" class="btn btn-success">Be Owner to Manage Your Properties!</button>--}}
{{-- @endif--}}
{{-- </form>--}}
{{-- @else--}}
{{-- @endif--}}

{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
<!--BeOwnerLightModal!-->
<div class="modal fade" id="BeOwnerLightModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Try Owner Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/'.Auth::id())}}">
                    @csrf

                    <label class="link-info">
                        <h3>You are Ready Now To Be Owner!</h3>
                    </label>

                    <input type="hidden" name="allDone" value="yes">

                    <button type="submit" id="btun3" class="btn btn-success">CLick Now And try Owner experience</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal bottom fade" style="overflow-y: scroll;" id="ReceipteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Receipte</h2>
                        <form id="reserveForm" action="{{route('paypalCall')}}" method="post">
                            @CSRF
                            <div id="resetdiv">
                            </div>
                            <div class="form-group mb-1">
                                <input type="submit" value="Pay" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditMainTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="item_id">
                <form method="post" action="{{ route('details.edit')}}" id="data_form_edit">
                    @csrf

                </form>

            </div>
        </div>
    </div>
</div>


{{-- Create Scheduale --}}
<div class="modal fade" id="CreateScheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="CreateSchedule" method="get">
                    @csrf
                    <input type="hidden" name="id" id="idNewSchedule">
                    <div id="SchedulealertParent">
                        <strong id="Schedulealert"></strong>
                    </div>

                    <div class="form-group">
                        <label style="font-size: 12pt">Start Date</label>
                        <input id="arrival" type="date" style="border-radius: 3pt" name="StartDate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">End Date</label>
                        <input id="departure" type="date" style="border-radius: 3pt" name="EndDate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Price Per Night</label>
                        <input id="price" type="text" style="border-radius: 3pt" name="Price" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Continue</button>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Edit SchedualeModal --}}
<div class="modal fade" id="EditScheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Need more information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditSchedule" method="Post" action="{{url('')}}">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label style="font-size: 12pt">Start Date</label>
                        <input id="StartDate" type="date" style="border-radius: 3pt" name="StartDate" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">End Date</label>
                        <input id="EndDate" type="date" style="border-radius: 3pt" name="EndDate" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Price Per Night</label>
                        <input id="Price" type="text" style="border-radius: 3pt" name="Price" class="form-control">

                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Continue</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Model -->
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
        <div class="modal-content" style="background: transparent; border: 0px;">
            <div class="modal-body">
                <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3 mt-3">
                    <form id="EditPostForm" method="post" action="{{url('/edit_post_user')}}" id="editform" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-0">
                            <a class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Edit Post</a>
                        </div>
                        <div class="card-body p-0 mt-3 position-relative">
                            <textarea id="editPost" name="edit_Post" style="padding-left:50pt;" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xss text-black-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10" placeholder="What's on your mind?" required></textarea>
                       <input type="hidden" id="posteditid" name="posteditid">
                        </div>
                        <div class="card-body d-flex p-2 mt-0">
                            <label for="uploadImages" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4 pt-2"><i class="font-md text-success feather-image me-2"></i><span class="d-none-xs">Add Photo</span></label>
                            <input type="file" style="display:none;" id="uploadImages" name="images[]" accept="image/*" placeholder="upload Images" multiple>
                            <a href="javascript:void(0)" onclick="document.getElementById('EditPostForm').submit();" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i class="font-md text-success feather-check-circle me-2"></i><span class="d-none-xs">Edit Post</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Edit Item Location--}}

{{--<div class="modal fade" id="EditLocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{-- <div class="modal-dialog">--}}
{{-- <div class="modal-content">--}}
{{-- <div class="modal-header">--}}
{{-- <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>--}}
{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{-- <span aria-hidden="true">&times;</span>--}}
{{-- </button>--}}
{{-- </div>--}}
{{-- <div class="modal-body">--}}
{{-- <form id="EditPostForm">--}}
{{-- @csrf--}}
{{-- <input type="hidden" name="id" id="id">--}}
{{-- <div class="form-group">--}}
{{-- <label for="edit_Post" style="font-size: 12pt">Edit Post</label>--}}
{{-- <input type="text" style="border-radius: 3pt" name="edit_Post" id="editPost" class="form-control">--}}
{{-- </div>--}}
{{-- <button type="submit" id="btun3" class="btn btn-success">Edit</button>--}}
{{-- </form>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}

<script>

</script>