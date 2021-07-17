@extends('website.frontend.layouts.main')
<div class="modal bottom fade" style="overflow-y: scroll;" id="BeOwnerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Continue Your Registration</h5>
                        <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/'.Auth::id())}}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            @if(! Auth::user()->First_Name)
                                <div class="form-group">
                                    <label style="font-size: 12pt">First Name</label>
                                    <input type="text" style="border-radius: 3pt" name="First" class="form-control">
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!Auth::user()->Middle_Name)
                                <div class="form-group">
                                    <label style="font-size: 12pt">Middle Name</label>
                                    <input type="text" style="border-radius: 3pt" name="Middle" class="form-control">
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!Auth::user()->Last_Name)
                                <div class="form-group">
                                    <label style="font-size: 12pt">Last Name</label>
                                    <input type="text" style="border-radius: 3pt" name="Last" class="form-control">
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!$phone)
                                <div class="form-group">
                                    <label style="font-size: 12pt">Phone Number</label>
                                    <input type="text" style="border-radius: 3pt" name="Phone" class="form-control">
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!Auth::user()->National_ID)
                                <div class="form-group">
                                    <label style="font-size: 12pt">National ID</label>
                                    <input type="text" style="border-radius: 3pt" name="National" class="form-control">
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            <input type="hidden"  id="check" name="check" value="BeOwner">
                            @if($checkIfOwner)
                                <div class="form-group"><a href="javascript:void(0)" onclick="check();" class="btn btn-info" > Save Information</a></div>
                            @else
                                <div class="form-group"><a href="javascript:void(0)" onclick="check();" class="btn btn-info" > Just Save Information! Or</a></div>
                                <button type="submit" id="btun3" class="btn btn-success">Be Owner to Manage Your Properties!</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('profile')
<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />

<div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
        <a href="default-settings.html" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Find a Place to Stay</h4>
    </div>
    <div class="card-body p-lg-5 p-4 w-100 border-0 mb-0">

        <form method="get" action="{{url('search_by_placedate')}}">
            @csrf
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <i class="fa fa-search icn " aria-hidden="true"></i>
                        <input type="text" class="form-control" name="state" placeholder="Search for item by state....">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="form-group">
                        <label class="mont-font fw-600 font-xsss">
                            <h4>Arrival Date</h4>
                        </label>
                        <input id="bdy1" name="arrivaldate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                    </div>
                </div>
                <script>
                    function timeFunctionLong(input) {
                        setTimeout(function() {
                            input.type = 'text';
                        }, 60000);
                    }
                </script>


                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label class="mont-font fw-600 font-xsss">

                                <h4>Departure Date</h4>
                            </label>
                            <input id="bdy2" name="departuredate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                        </div>
                    </div>
                </div>
                <script>
                    function timeFunctionLong(input) {
                        setTimeout(function() {
                            input.type = 'text';
                        }, 60000);
                    }
                </script>

                <div class="col-lg-12 mb-0 mt-2 ps-0">
                    <input type="submit" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block" value="Search">
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var username=$('#userid').val();
    var $show=$('#show').val();
    var theButtonJustIsClicked=0;
    console.log(username);
      if($show=='true'){
        $(window).on('load', function() {
            $('#BeOwnerModal').modal('show');
        });
      }

    function check(){
        $('#check').val('just');
        $('#BeOwnerForm').submit();

    }
</script>

@endsection
