@extends('website.frontend.layouts.main')
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
                        <input type="text" class="form-control" name="state placeholder=" placeholder="Search for item by state....">
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
                    <a href="" onclick="javascript:this.form.submit();" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Search</a>
                </div>
        </form>
    </div>
</div>



@endsection