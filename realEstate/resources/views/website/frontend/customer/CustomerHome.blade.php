@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />

<div id="content-wrapper">
    <div class="container-fluid">
<div class="rowe
">
    <!-- <img src="Images/h3.jpg" class="background"> -->
    <div class="sreachdiv">
        <div class="shosho">
            <form method="get" action="{{url('search_by_placedate')}}">
                @csrf
                <i class="fa fa-search icn " aria-hidden="true"></i>
                <input type="text" name="state" id="srch"placeholder="Search for item by state....">
        
                <div class="bd">
                    <div class="col-md-6 col-sm-6 ">
                        <label> <h4>Arrival Date</h4> </label>
                        <input id="bdy1" name="arrivaldate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                        <script>
                            function timeFunctionLong(input)
                            {
                                setTimeout(function()
                                {
                                    input.type = 'text';
                                }, 60000);
                            }
                        </script>
                    </div>

                    <div class="col-md-6 col-sm-6 ">
                        <label> <h4>Departure Date</h4> </label>
                        <input id="bdy2" name="departuredate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                        <script>
                            function timeFunctionLong(input)
                            {
                                setTimeout(function()
                                {
                                input.type = 'text';
                                }, 60000);
                            }
                        </script>
                    </div>
                </div>
            
                <div class="searchbtn">
                    <input id="btun3" type="submit" value="Search">
                </div>
            </form>
        </div>
    </div>
    
    <div>
        
        
    </div>
   
</div>
</div>
</div>

@endsection