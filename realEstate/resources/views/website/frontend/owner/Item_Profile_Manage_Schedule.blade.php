@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')
@include('website.backend.layouts.flashmessage')


<div class="row">
    <div class="col-xl-12">
        <form method="Post" action="{{url('/delete_schedule?_method=delete')}}" enctype="multipart/form-data">
            @csrf
            <div class="row ms-10 mb-10">
                <a class="d-none d-lg-block bg-white p-3 mb-3 ms-3 z-index-1 rounded-3 text-black font-xsss fw-700 ls-3 w-auto" href="javascript:void(0)" onclick="createSchedule('{{$item_id}}')">
                    Add Schedule <i class="fa fa-plus-square"></i>
                </a>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                    <p class="fw-700 lh-3 font-xss"> Select all <input type="checkbox" id="selectAll" name="selectAll"><button class="btn"><i class="feather-trash"></i></button>
                    </p>
                </span>
                <script>
                    document.getElementById('selectAll').onclick = function() {
                        var checkboxes = document.getElementsByName('schedule[]'); //get all check boxes with name delete
                        for (var checkbox of checkboxes) { //for loop to set all checkboxes to checked
                            checkbox.checked = this.checked;
                        }
                    }
                </script>

                @foreach($schedules as $schedule)
                <div class="col-lg-4 col-md-6 pe-2 ps-2" style="display:table;">
                    <div class="card p-0 bg-white w-100 hover-card border-0 shadow-xss rounded-xxl border-0 mb-3 overflow-hidden ">

                        <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                            <p class="fw-700 lh-3 font-xss">
                                Select <input type="checkbox" name="schedule[]" value="{{$schedule->schedule_Id}}" id="schedule"> <a href="javascript:void(0)" onclick="setSchedule('{{$schedule->schedule_Id}}','{{$schedule->Start_Date}}','{{$schedule->End_Date}}','{{$schedule->Price_Per_Night}}')"><i class="feather-edit"> </i></a>
                            </p>
                        </span>

                        <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                            <p class="fw-700 lh-3 font-xss">Start date : {{$schedule->Start_Date}}
                            </p>
                        </span>

                        <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                            <p class="fw-700 lh-3 font-xss">End date : {{$schedule->End_Date}}
                            </p>
                        </span>

                        <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                            <p class="fw-700 lh-3 font-xss">Price per night : {{$schedule->Price_Per_Night}}
                            </p>
                        </span>


                    </div>
                </div>
                @endforeach

        </form>
    </div>
    <div class="clearfix"></div>
</div>
</div>
</div>
</div>
<div class="addbtn1">
    <!-- <a href="javascript:void(0)" onclick="goreserve('{{$item_id}}');" id="gobutton" style=" margin-top:90px; margin-left:50px">edit Schdule</a> -->
</div>
</div>


<script>

function createSchedule(item_id)
{

    $("#idNewSchedule").val(item_id);
    $("#CreateScheduleModal").modal("toggle");

}

function submitSchedule() {
    $("#CreateSchedule").change(function () {
        var startDate = document.getElementById("arrival").value;
        var endDate = document.getElementById("departure").value;

        if ((Date.parse(endDate) <= Date.parse(startDate))) {

            $('#Schedulealert').html("End date must be after start date");
            $('#SchedulealertParent').removeClass().addClass("alert alert-danger alert-block");
        } else {

            $('#CreateSchedule').submit(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var id = $("#idNewSchedule").val();
                console.log(id);
                var arrival = $("#arrival").val();
                var departure = $("#departure").val();
                var price = $("#price").val();
                var _token = $("input[name=_token]").val();

                $.ajax({
                    url: "{{route('Add_Schedule')}}",
                    Type: "POST",
                    data: {
                        id: id,
                        arrival: arrival,
                        departure: departure,
                        price: price,
                        _token: _token
                    },
                    success: function (response) {

                        $('#Schedulealert').html(response["message"]);
                        $('#SchedulealertParent').removeClass().addClass(response["class"]);
                    },
                    error: function () {
                        console.log('Error');
                    }

                });
            });
        }

    });
}





    function setSchedule(schedule_id, start, end, price) {

        $("#id").val(schedule_id);
        $("#StartDate").val(start);
        $("#EndDate").val(end);
        $("#Price").val(price);
        $("#EditScheduleModal").modal("toggle");


    }
    $("#EditSchedule").change(function() {
var startDate = document.getElementById("StartDate").value;
var endDate = document.getElementById("EndDate").value;

if ((Date.parse(endDate) <= Date.parse(startDate))) {

    alert('End date must be start date');

}
});
    $('#EditSchedule').submit(function() {

        var id = $("#id").val();
        var StartDate = $("#StartDate").val();
        var EndDate = $("#EndDate").val();
        var Price = $("#Price").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('schedule.update')}}",
            Type: "PUT",
            data: {
                id: id,
                StartDate: StartDate,
                EndDate: EndDate,
                Price: Price,
                _token: _token
            },
            success: function(response) {
                console.log(response);
                location.href = response;
            },
            error: function() {
                console.log('Error');
            }

        });
    });
</script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    /*label  {*/
    /*    display: inline-block;*/
    /*    padding: 5px;*/
    /*    background: red;*/
    /*}*/


    .one_day {
        border: 2px solid transparent;
        border-radius: 50%;
        color: black;
        font-size: 12px;
        font-weight: 700;
        width: 40%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background-color: #7e66ec;
        border-color: #fefefe;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgb(0 0 0 / 10%);
        box-shadow: 0px 2px 2px rgb(0 0 0 / 10%);
        color: #fff;
    }

    .calendar-table__item {
        border: 2px solid transparent;
        border-radius: 50%;
        color: #424588;
        font-size: 12px;
        font-weight: 700;
        width: 40%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;

    }

    .calendar-table__item_isdisable {
        border: 2px solid transparent;
        border-radius: 50%;
        color: #424588;
        font-size: 12px;
        font-weight: 700;
        width: 40%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;

        background-color: #dbd6d0;
        border-color: #dbd6d0;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        color: #fff;
        pointer-events: none;
    }


    .calendar-table__item:hover {
        background: #7e66ec;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        transition: 0.2s all ease-in;
    }

    .calendar-table__item_Start {
        border: 2px solid transparent;
        border-radius: 50%;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        width: 40%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #7e66ec;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        transition: 0.2s all ease-in;
        border-radius: 50% 50% 0 0;
    }

    .calendar-table__item_Rang {
        border: 2px solid transparent;
        border-radius: 50%;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        width: 40%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #7e66ec;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        transition: 0.2s all ease-in;
        border-radius: 0;
        border-width: 0 2px;
    }


    .calendar-table__item_End {
        border: 2px solid transparent;
        border-radius: 50%;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        width: 40%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #7e66ec;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        transition: 0.2s all ease-in;
        border-radius: 0 0 50% 50%;
    }

    calendar-table__item_isDisabled {
        border-color: #fefefe;
        background-color: #f2f6f8;
        color: #fff;
        opacity: 0.25;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgb(0 0 0 / 10%);
        box-shadow: 0px 2px 2px rgb(0 0 0 / 10%);
    }



    /* hover Form table  */
    .nav.side-menu>li>a:hover {
        color: red !important;
    }

    .nav.side-menu>li>a:hover,
    .nav>li>a:focus {
        text-decoration: none;
        background: transparent;
    }

    .nav.child_menu {
        display: none;
    }

    .nav.child_menu li:hover,
    .nav.child_menu li.active {
        background-color: rgba(255, 255, 255, 0.06);
    }

    .nav.child_menu li {
        padding-left: 36px;
    }

    .nav-md ul.nav.child_menu li:before {
        background: #425668;
        bottom: auto;
        content: "";
        height: 8px;
        left: 23px;
        margin-top: 15px;
        position: absolute;
        right: auto;
        width: 8px;
        z-index: 1;
        border-radius: 50%;
    }

    .nav-md ul.nav.child_menu li:after {
        border-left: 1px solid #425668;
        bottom: 0;
        content: "";
        left: 27px;
        position: absolute;
        top: 0;
    }

    .nav-md ul.nav.child_menu li:last-child::after {
        bottom: 50%;
    }

    /* form table*/
    .nav.side-menu>li>a,
    .nav.child_menu>li>a {
        color: black;
        font-weight: 500;
    }

    .nav.child_menu li li:hover,
    .nav.child_menu li li.active {
        background: none;
    }

    /* hover country state */
    .nav.child_menu li li a:hover,
    .nav.child_menu li li a.active {
        color: red;
    }

    .nav.side-menu>li.current-page,



    .nav.side-menu>li.active>a {
        text-shadow: rgba(0, 0, 0, 0.25) 0 -1px 0;
        background: -webkit-gradient(linear, left top, left bottom, from(#334556), to(#2C4257)), #2A3F54;
        background: linear-gradient(#334556, #2C4257), #2A3F54;
        -webkit-box-shadow: rgba(0, 0, 0, 0.25) 0 1px 0, inset rgba(255, 255, 255, 0.16) 0 1px 0;
        box-shadow: rgba(0, 0, 0, 0.25) 0 1px 0, inset rgba(255, 255, 255, 0.16) 0 1px 0;
    }

    .nav.child_menu>li>a {
        color: black;
        font-size: 12px;
        padding: 9px;
    }

    /*...............................*/


    .main_menu_side {
        padding: 0;
    }

    .menu_section {
        margin-bottom: 35px;
    }

    .nav-sm .nav.side-menu li a {
        text-align: center !important;
        font-weight: 400;
        font-size: 10px;
        padding: 10px 5px;
    }

    .nav-sm .nav.child_menu li.active,
    .nav-sm .nav.side-menu li.active-sm {
        border-right: 5px solid #1ABB9C;
    }

    @media print {
        .hidden-print {
            display: none !important
        }
    }

    /*........................*/

    .nav-sm .menu_section h3 {
        display: none;
    }

    .nav-sm .menu_section {
        margin: 0;
    }

    .menu_section {
        margin-bottom: 35px;
    }

    .menu_section h3 {
        padding-left: 23px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: bold;
        font-size: 11px;
        margin-bottom: 0;
        margin-top: 0;
        text-shadow: 1px 1px #000;
    }

    .menu_section>ul {
        margin-top: 10px;
        display: block;
    }

    .nav-sm .nav.side-menu li a {
        text-align: center !important;
        font-weight: 400;
        font-size: 10px;
        padding: 10px 5px;
    }

    .nav-sm .nav.child_menu li.active,
    .nav-sm .nav.side-menu li.active-sm {
        border-right: 5px solid #1ABB9C;
    }

    .nav-sm ul.nav.child_menu ul,
    .nav-sm .nav.side-menu li.active-sm ul ul {
        position: static;
        width: 200px;
        background: none;
    }

    .nav-sm>.nav.side-menu>li.active-sm>a {
        color: #1ABB9C !important;
    }

    .nav-sm .nav.side-menu li a i.toggle-up {
        display: none !important;
    }

    .nav-sm .nav.side-menu li a i {
        font-size: 25px !important;
        text-align: center;
        width: 100% !important;
        margin-bottom: 5px;
    }

    .nav-sm ul.nav.child_menu {
        left: 100%;
        position: absolute;
        top: 0;
        width: 210px;
        z-index: 4000;
        background: #3E5367;
        display: none;
    }

    .nav-sm ul.nav.child_menu li {
        padding: 0 10px;
    }

    .nav-sm ul.nav.child_menu li a {
        text-align: left !important;
    }

    .nav.side-menu>li {
        position: relative;
        display: block;
        cursor: pointer;
    }

    .nav.side-menu>li>a {
        margin-bottom: 6px;
    }

    .main-container-wrapper {
        background-color: #f8fafa;
        min-width: 320px;
        min-height: 568px;
        max-width: 414px;
        overflow-y: auto;
    }

    @media (min-width: 415px) {
        .main-container-wrapper {
            -moz-box-shadow: 0px 32px 47px rgba(32, 23, 23, 0.09);
            -webkit-box-shadow: 0px 32px 47px rgba(32, 23, 23, 0.09);
            box-shadow: 0px 32px 47px rgba(32, 23, 23, 0.09);
            margin: 24px auto;
        }
    }

    header {
        background-color: #fff;
        display: flex;
        height: 58px;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
    }

    .header__btn {
        background-color: #86d8c9;
        border: 2px solid #fff;
        border-radius: 50%;
        -moz-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        height: 80px;
        padding-top: 18px;
        position: absolute;
        top: -25px;
        width: 80px;
    }

    .header__btn:hover,
    .header__btn:focus {
        background: #67cebb;
        transition: all 0.3s ease-in;
        outline: none;
    }

    .header__btn .icon {
        display: inline-block;
    }

    .header__btn--left {
        left: -25px;
        padding-left: 38px;
        text-align: left;
    }

    .header__btn--right {
        padding-right: 32px;
        right: -25px;
        text-align: right;
    }

    .calendar-container {
        background-color: #fff;
        padding: 16px;
        margin-bottom: 24px;
    }

    .calendar-container__header {
        display: flex;
        justify-content: space-between;
    }

    .calendar-container__btn {
        background: transparent;
        border: 0;
        cursor: pointer;
        font-size: 16px;
        outline: none;
        color: #e9e8e8;
    }

    .calendar-container__btn:hover,
    .calendar-container__btn:focus {
        color: #9faab7;
        transition: all 0.3s ease-in;
    }

    .calendar-container__title {
        color: #222741;
        font-size: 20px;
        font-weight: 700;
    }

    .calendar-table {
        margin-top: 12px;
        width: 100%;
    }




    .calendar-table__row {
        display: flex;
        justify-content: center;
    }

    .calendar-table__header {
        border-bottom: 2px solid #f2f6f8;
        margin-bottom: 4px;
    }

    .calendar-table_header .calendar-table_col {
        display: inline-block;
        color: #99a4ae;
        font-size: 12px;
        font-weight: 700;
        padding: 12px 3px;
        text-align: center;
        text-transform: uppercase;
        width: 40px;
        height: 38px;
    }

    @media (min-width: 360px) {
        .calendar-table_header .calendar-table_col {
            width: 46px;
        }
    }

    @media (min-width: 410px) {
        .calendar-table_header .calendar-table_col {
            width: 54px;
        }
    }

    .calendar-table_body .calendar-table_col {
        width: 40px;
        height: 42px;
        padding-bottom: 2px;
    }

    @media (min-width: 360px) {
        .calendar-table_body .calendar-table_col {
            width: 46px;
            height: 48px;
        }
    }

    @media (min-width: 410px) {
        .calendar-table_body .calendar-table_col {
            width: 54px;
            height: 56px;
        }
    }

    .calendar-table_today .calendar-table_item {
        border-color: #fefefe;
        background-color: #f2f6f8;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .calendar-table_event .calendar-table_item {
        background-color: #7e66ec;
        border-color: #fefefe;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        color: #fff;
    }

    .calendar-table__event--long {
        overflow-x: hidden;
    }

    .calendar-table_event--long .calendar-table_item {
        border-radius: 0;
        border-width: 0 2px;
    }

    .calendar-table_event--start .calendar-table_item {
        border-left: 2px solid #fff;
        border-radius: 50% 50% 0 0;
    }

    .calendar-table_event--start.calendar-tablecol:last-child .calendar-table_item {
        border-width: 2px;
    }

    .calendar-table_event--end .calendar-table_item {
        border-right: 2px solid #fff;
        border-radius: 0 0 50% 50%;
    }

    .calendar-table_event--end.calendar-tablecol:first-child .calendar-table_item {
        border-width: 2px;
    }

    .calendar-table_inactive .calendar-table_item {
        color: #fff;
        cursor: default;
    }

    .calendar-table_inactive .calendar-table_item:hover {
        background: transparent;
        box-shadow: none;
    }

    .calendar-table_inactive.calendar-tableevent .calendar-table_item {
        color: #fff;
        opacity: 0.25;
    }

    .calendar-table_inactive.calendar-tableevent .calendar-table_item:hover {
        background: #7e66ec;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .events-container {
        padding: 0 15px;
    }

    .events__title {
        color: #bec1ca;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .events__tag {
        background: #7e66ec;
        border: 2px solid #fefefe;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        color: #fff;
        font-size: 10px;
        font-weight: 600;
        width: 60px;
        margin-left: 16px;
        padding: 5px 2px;
        text-align: center;
    }

    .events__tag--highlighted {
        background: #fdca40;
    }

    .events__item {
        background: #fff;
        border-left: 8px solid #86d8c9;
        border-radius: 2px;
        -moz-box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.05);
        -webkit-box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.05);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.05);
        padding: 15px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .events__item--left {
        width: calc(100% - 76px);
    }

    .events__name {
        font-size: 12px;
        font-weight: 700;
        color: #222741;
        display: block;
        margin-bottom: 6px;
    }

    .events__date {
        font-size: 12px;
        color: #9faab7;
        display: inline-block;
    }
</style>
@endsection
