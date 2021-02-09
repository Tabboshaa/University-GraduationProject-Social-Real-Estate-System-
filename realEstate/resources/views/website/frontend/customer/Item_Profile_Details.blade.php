@extends('website.frontend.customer.Item_Profile')
@section('profile_Content')
<div class="row">
    <div class="col-md-7">
        <div class=" locatins">
            <div class="heading">
                <img src="{{asset('FrontEnd/images/banner/icon.html')}}" alt="">
                <h3>
                    Description
                </h3>
            </div>
            <div class="sub-heading">
                Description of item.
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="locatins heading">
            <img src="images/banner/icon1.html" alt="">
            <h3>
                Location
            </h3>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="box-left">
        <div class="rightboxs">
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">

                    <ul class="nav side-menu">

                        <li> <a><span class="fa fa-chevron-down"></span>1-January</a>


                        </li>
                        <li> <a><span class="fa fa-chevron-down"></span>2-February </a>

                        </li>

                        <li> <a><span class="fa fa-chevron-down"></span>3-March </a>
                            @if(isset($schedule["03"]))
                                <ul class="nav child_menu">
                                    @foreach($schedule["03"] as $schedule => $test)

                                        <?php
                                        $SartDateDay=\Carbon\Carbon::parse($test["Start_Date"])->format('d');
                                        $EndDateDay=\Carbon\Carbon::parse($test["End_Date"])->format('d');
                                        ?>
                                        <li><a> <span class="fa fa-chevron-down"></span> {{$SartDateDay+1-1}}->{{$EndDateDay+1-1}} </a>
                                            <ul class="nav child_menu">
                                                @for($i=$SartDateDay-1+1;$i<=$EndDateDay;$i++)
                                                    <li><a href=""> {{$i}}</a></li>
                                                @endfor

                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif


                        </li>
                        <li> <a><span class="fa fa-chevron-down"></span>4-April </a>


                            @if(isset($schedule["04"]))
                                <ul class="nav child_menu">
                                    @foreach($schedule["04"] as $schedule => $test)

                                        <?php
                                        $SartDateDay=\Carbon\Carbon::parse($test["Start_Date"])->format('d');
                                        $EndDateDay=\Carbon\Carbon::parse($test["End_Date"])->format('d');
                                        ?>
                                        <li><a> <span class="fa fa-chevron-down"></span> {{$SartDateDay+1-1}}->{{$EndDateDay+1-1}} </a>
                                            <ul class="nav child_menu">
                                                @for($i=$SartDateDay-1+1;$i<=$EndDateDay;$i++)
                                                    <li><a href=""> {{$i}}</a></li>
                                                @endfor

                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </li>
                        <li> <a><span class="fa fa-chevron-down"></span>5-May </a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>6-June </a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>7-July </a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>8-August </a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>9-September</a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>10-October </a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>11-November</a></li>
                        <li> <a><span class="fa fa-chevron-down"></span>12-December</a></li>


                    </ul>
                </div>

            </div>

        </div>
    </div>

</div>

<style>

    .main_menu_side {
        padding: 0; }
    .menu_section {
        margin-bottom: 35px; }
    .nav-sm .nav.side-menu li a {
        text-align: center !important;
        font-weight: 400;
        font-size: 10px;
        padding: 10px 5px; }
    .nav-sm .nav.child_menu li.active,
    .nav-sm .nav.side-menu li.active-sm {
        border-right: 5px solid #1ABB9C; }
    @media print{.hidden-print{display:none!important}}
    /*........................*/

    .nav-sm .menu_section h3 {
        display: none; }
    .nav-sm .menu_section {
        margin: 0; }

    .menu_section {
        margin-bottom: 35px; }

    .menu_section h3 {
        padding-left: 23px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: bold;
        font-size: 11px;
        margin-bottom: 0;
        margin-top: 0;
        text-shadow: 1px 1px #000; }

    .menu_section > ul {
        margin-top: 10px;
        display: block; }
    .nav-sm .nav.side-menu li a {
        text-align: center !important;
        font-weight: 400;
        font-size: 10px;
        padding: 10px 5px; }

    .nav-sm .nav.child_menu li.active,
    .nav-sm .nav.side-menu li.active-sm {
        border-right: 5px solid #1ABB9C; }

    .nav-sm ul.nav.child_menu ul,
    .nav-sm .nav.side-menu li.active-sm ul ul {
        position: static;
        width: 200px;
        background: none; }

    .nav-sm > .nav.side-menu > li.active-sm > a {
        color: #1ABB9C !important; }

    .nav-sm .nav.side-menu li a i.toggle-up {
        display: none !important; }

    .nav-sm .nav.side-menu li a i {
        font-size: 25px !important;
        text-align: center;
        width: 100% !important;
        margin-bottom: 5px; }

    .nav-sm ul.nav.child_menu {
        left: 100%;
        position: absolute;
        top: 0;
        width: 210px;
        z-index: 4000;
        background: #3E5367;
        display: none; }

    .nav-sm ul.nav.child_menu li {
        padding: 0 10px; }

    .nav-sm ul.nav.child_menu li a {
        text-align: left !important; }

    .nav.side-menu > li {
        position: relative;
        display: block;
        cursor: pointer; }

    .nav.side-menu > li > a {
        margin-bottom: 6px; }

    /* hover Form table  */
    .nav.side-menu > li > a:hover {
        color: red  !important; }

    .nav.side-menu > li > a:hover, .nav > li > a:focus {
        text-decoration: none;
        background: transparent; }

    .nav.child_menu {
        display: none; }

    .nav.child_menu li:hover,
    .nav.child_menu li.active {
        background-color: rgba(255, 255, 255, 0.06); }

    .nav.child_menu li {
        padding-left: 36px; }

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
        border-radius: 50%; }

    .nav-md ul.nav.child_menu li:after {
        border-left: 1px solid #425668;
        bottom: 0;
        content: "";
        left: 27px;
        position: absolute;
        top: 0; }

    .nav-md ul.nav.child_menu li:last-child::after {
        bottom: 50%; }
    /* form table*/
    .nav.side-menu > li > a, .nav.child_menu > li > a {
        color: black;
        font-weight: 500; }

    .nav.child_menu li li:hover,
    .nav.child_menu li li.active {
        background: none; }
    /* hover country state */
    .nav.child_menu li li a:hover,
    .nav.child_menu li li a.active {
        color: red; }
    .nav.side-menu > li.current-page, .nav.side-menu > li.active {
        border-right: 5px solid #1ABB9C; }


    .nav.side-menu > li.active > a {
        text-shadow: rgba(0, 0, 0, 0.25) 0 -1px 0;
        background: -webkit-gradient(linear, left top, left bottom, from(#334556), to(#2C4257)), #2A3F54;
        background: linear-gradient(#334556, #2C4257), #2A3F54;
        -webkit-box-shadow: rgba(0, 0, 0, 0.25) 0 1px 0, inset rgba(255, 255, 255, 0.16) 0 1px 0;
        box-shadow: rgba(0, 0, 0, 0.25) 0 1px 0, inset rgba(255, 255, 255, 0.16) 0 1px 0; }

    .nav.child_menu > li > a {
        color: black;
        font-size: 12px;
        padding: 9px; }

    /*...............................*/

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

    .calendar-table__item {
        border: 2px solid transparent;
        border-radius: 50%;
        color: #424588;
        font-size: 12px;
        font-weight: 700;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .calendar-table__item:hover {
        background: #f8fafa;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        transition: 0.2s all ease-in;
    }

    .calendar-table__row {
        display: flex;
        justify-content: center;
    }

    .calendar-table__header {
        border-bottom: 2px solid #f2f6f8;
        margin-bottom: 4px;
    }

    .calendar-table__header .calendar-table__col {
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
        .calendar-table__header .calendar-table__col {
            width: 46px;
        }
    }

    @media (min-width: 410px) {
        .calendar-table__header .calendar-table__col {
            width: 54px;
        }
    }

    .calendar-table__body .calendar-table__col {
        width: 40px;
        height: 42px;
        padding-bottom: 2px;
    }

    @media (min-width: 360px) {
        .calendar-table__body .calendar-table__col {
            width: 46px;
            height: 48px;
        }
    }

    @media (min-width: 410px) {
        .calendar-table__body .calendar-table__col {
            width: 54px;
            height: 56px;
        }
    }

    .calendar-table__today .calendar-table__item {
        border-color: #fefefe;
        background-color: #f2f6f8;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .calendar-table__event .calendar-table__item {
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

    .calendar-table__event--long .calendar-table__item {
        border-radius: 0;
        border-width: 2px 0;
    }

    .calendar-table__event--start .calendar-table__item {
        border-left: 2px solid #fff;
        border-radius: 50% 0 0 50%;
    }

    .calendar-table__event--start.calendar-table__col:last-child .calendar-table__item {
        border-width: 2px;
    }

    .calendar-table__event--end .calendar-table__item {
        border-right: 2px solid #fff;
        border-radius: 0 50% 50% 0;
    }

    .calendar-table__event--end.calendar-table__col:first-child .calendar-table__item {
        border-width: 2px;
    }

    .calendar-table__inactive .calendar-table__item {
        color: #fff;
        cursor: default;
    }

    .calendar-table__inactive .calendar-table__item:hover {
        background: transparent;
        box-shadow: none;
    }

    .calendar-table__inactive.calendar-table__event .calendar-table__item {
        color: #fff;
        opacity: 0.25;
    }

    .calendar-table__inactive.calendar-table__event .calendar-table__item:hover {
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
