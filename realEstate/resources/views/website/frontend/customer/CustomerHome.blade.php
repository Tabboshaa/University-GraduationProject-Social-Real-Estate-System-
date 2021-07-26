@extends('website.frontend.layouts.main')
<div class="modal bottom fade" style="overflow-y: scroll;" id="BeOwnerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Continue Your Registration</h5>
                        <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/')}}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            @if(! Auth::user()->First_Name)
                                <div class="form-group">
                                    <label style="font-size: 12pt">First Name</label>
                                    <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First letter must be capital" name="First" class="form-control" required>
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!Auth::user()->Middle_Name)
                                <div class="form-group">
                                    <label style="font-size: 12pt">Middle Name</label>
                                    <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First letter must be capital" name="Middle" class="form-control" required>
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!Auth::user()->Last_Name)
                                <div class="form-group">
                                    <label style="font-size: 12pt">Last Name</label>
                                    <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First letter must be capital" name="Last" class="form-control" required>
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif
                            @if(!$phone)
                                <div class="form-group">
                                    <label style="font-size: 12pt">Phone Number</label>
                                    <input type="text" style="border-radius: 3pt" pattern="^01[0-2]\d{8}$" title="01---------" name="Phone" class="form-control"required>
                                    <input type="hidden" value="true" id="show">
                                    <input type="hidden"  id="Just" name="Just" value="">
                                </div>
                            @endif
                            @if(!Auth::user()->National_ID)
                                <div class="form-group">
                                    <label style="font-size: 12pt">National ID</label>
                                    <input type="text" style="border-radius: 3pt" pattern="(2|3)[0-9][1-9][0-1][1-9][0-3][1-9](01|02|03|04|11|12|13|14|15|16|17|18|19|21|22|23|24|25|26|27|28|29|31|32|33|34|35|88)\d\d\d\d\d" title="Enters the id in national id" name="National" class="form-control" required>
                                    <input type="hidden" value="true" id="show">
                                </div>
                            @endif

                                <div class="form-group"><a href="javascript:void(0)" class="btn btn-info" onclick="just();" > Just Save Information! Or</a></div>
                                <button type="submit" id="btun3" class="btn btn-success">Be Owner to Manage Your Properties!</button>
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

<div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4" >
    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">

        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Find a Place to Stay</h4>
    </div>
    <div class="card-body p-lg-5 p-4 w-100 border-0 mb-0">

        <form method="get" action="{{url('search_by_placedate')}}">
            @csrf
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <h3>State <i class="fa fa-search" style="font-size: 0.73em;"aria-hidden="true"></i></h3>
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
                <div class="col-lg-6 mb-3">
                    <div class="form-group">
                        <label class="mont-font fw-600 font-xsss">

                            <h4>Departure Date</h4>
                        </label>
                        <input id="bdy2" name="departuredate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                    </div>
                </div>
                <script>
                    function timeFunctionLong(input) {
                        setTimeout(function() {
                            input.type = 'text';
                        }, 60000);
                    }
                </script>

                <script>
                    function timeFunctionLong(input) {
                        setTimeout(function() {
                            input.type = 'text';
                        }, 60000);
                    }
                </script>
            </div>
                <div  style="margin-left: 350px;">
                    <input type="submit" class="bg-current text-center text-white font-xsss fw-700 p-3 w175 rounded-3 d-inline-block" value="Search">
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var username=$('#userid').val();
    var $show=$('#show').val(); //if show type = true so there is missed data so show moodel
    console.log(username);
      if($show=='true'){
        $(window).on('load', function() {
            $('#BeOwnerModal').modal('show');
        });
      }

    // function check(){
    //     if (IsValid){

    //     $('#BeOwnerForm').submit();
    // }
    // else{
    //
    // }
    //
    // }
    function just(){
        $('#Just').val('just Save info');
        $('#BeOwnerForm').submit();
    }
</script>

@endsection
