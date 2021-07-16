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
                <h5 class="modal-title" id="exampleModalLabel">Create New Scheduale</h5>
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
</div>
{{--Edit Item Location--}}

<div class="modal fade" id="EditLocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>