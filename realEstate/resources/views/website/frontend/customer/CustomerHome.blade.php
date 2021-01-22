@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<div class="rowe">
    
        <img src="Images/h3.jpg" class="background">
  

    <div class="sreachdiv">
    <div class="shosho">
        <form>
        <i class="fa fa-search " style ="padding-top: 5pt;padding-left: 15pt;padding-bottom: 5pt; padding-right: 5pt; background-color:rgb(255, 255, 255);"aria-hidden="true"></i>
        <input type="text" name="search" style="font-size:18px;:rgb(255, 255, 255);width: 900px;  
        height: 30px;border:0px; padding-left: 30pt;"placeholder="Enter a keyword....">
        </form>
    </div>

    <div class="bd">
    <div class="col-md-6 col-sm-6 ">
        <input id="birthday" style="border-bottom-left-radius: 10pt;
        border-bottom-right-radius: 10pt;" name="birthdate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
        <script>
            function timeFunctionLong(input) {
                setTimeout(function() {
                    input.type = 'text';
                }, 60000);
            }
        </script>
    </div>

    <div class="col-md-6 col-sm-6 ">
        <input id="birthday" style="border-bottom-left-radius: 10pt;
        border-bottom-right-radius: 10pt;" name="birthdate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
        <script>
            function timeFunctionLong(input) {
                setTimeout(function() {
                    input.type = 'text';
                }, 60000);
            }
        </script>
    </div>
    </div>
    <div class="searchbtn">
        <button id="btun3" type="submit"> Search</button>
    </div>
</div>
</div>	
@endsection