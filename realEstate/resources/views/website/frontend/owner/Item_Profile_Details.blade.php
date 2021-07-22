@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')
<link rel="stylesheet" href="/css/map.css">

<div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-block p-4">
            <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Choose your Vacation time now!</a>
            <div class="row">
                <span class="font-xsssss fw-700 ps-3 pe-3 lh-32 text-uppercase rounded-3 ls-2 alert-info d-inline-block text-info"> <a href="javascript:void(0)" onclick="goreserve('{{$item_id}}');" id="gobutton" style="display: none;text-align: center;"> All done?</a></span>
            </div>
        </div>
        {{--FOR EACH TO PRINT YEARS--}}
        @foreach($schedule as $year => $schedulesInYear)

        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
            <div class="bg-gold-gradiant me-2 p-3 rounded-xxl w125">

                <a href="javascript:void(0)" id="" onclick="$('#div{{$year}}').slideToggle();">
                    <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span class="ls-1 d-block font-xsss text-white fw-600 text-center">{{$year}}</span></h4>
                </a>
            </div>
        </div>
        <?php $temp = ''; ?>
        <div id="div{{$year}}">
            @foreach($schedulesInYear as $month => $schedules)
            {{-- END...FOR EACH TO PRINT YEARS--}}
            <?php $dateObj   = DateTime::createFromFormat('!m', $month);
            $month = $dateObj->format('F'); // name of month
            ?>
            <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                <div class="bg-skype me-2 p-3 rounded-xxl w125">
                    <a href="javascript:void(0)" id="" onclick="$('#ul{{$year}}{{$month}}').slideToggle();">
                        <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span class="ls-1 d-block font-xsss text-white fw-600 text-center">{{$month}}</span></h4>
                    </a>
                </div>

                <h4 class="fw-700 text-grey-900 font-xssss mt-2">
                    <ul id="ul{{$year}}{{$month}}" style="display: none;">
                        @foreach($schedules as $date)
                        <?php
                        $day = \Carbon\Carbon::parse($date["date"])->format('d');
                        $day = $day + 1 - 1;
                        $SID = $date["schedule_Id"];
                        $ID = $date["date"];
                        ?>
                        <!-- {{-- @foreach ($period as $date) --}} -->
                        <li>
                            <div> <span id="{{$ID}}" name="{{$SID}}" class="calendar-table__item" href="javascript:void(0)" onclick="test('{{$ID}}','{{$SID}}')" style="color: #0C0C0C">{{$day}}</span></div>
                        </li>
                        <!-- {{-- @endforeach --}} -->
                        @endforeach
                    </ul>
                </h4>
            </div>

            @endforeach
        </div>
        @endforeach

    </div>
</div>

<div class=" col-xl-8 col-xxl-9 col-lg-8">
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            <h3>
                Description
            </h3>
        </div>
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">

                @if(!empty($subtype))
                <a href="{{url('/OwnerSelectDetails/'.$item_id.'/'.$subtype)}}">
                    <h6>Add A new Detail <i style="padding-left:14px" class="fa fa-plus"></i></h6>
                </a>
                @else
                <a href="{{url('/OwnerSelectSubType/'.$item_id)}}">
                    <h6>Add A new Detail <i style="padding-left:14px" class="fa fa-plus"></i></h6>
                </a>
                @endif


                @foreach ($details as $Property_Name => $Property_Id_Array)
                @foreach ($Property_Id_Array as $Property_Id => $Property_diff_Array)

            <ul>
                <li><a href="javascript:void(0)" id="moreprop{{$Property_Id}}" onclick="$('#property{{$Property_Id}}').slideToggle(function(){$('#moreprop{{$Property_Id}}').html($('#property{{$Property_Id}}').is(':visible')?'Hide {{$Property_Name}}':'{{$Property_Name}}');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">{{$Property_Name}}</a>
                <form id="imageform" method="post" action="" enctype="multipart/form-data">
                    <!-- {{$i=0}} -->
                    <ul id="property{{$Property_Id}}" style="display: none;">
                        @foreach ($Property_diff_Array as $Property_diff => $detailValue)
                        <!-- {{$i+=1}} -->
                        <li id="lidiff{{$Property_diff}}">

                                @csrf
                                <a href="javascript:void(0)" id="more{{$Property_diff}}" onclick="$('#diff{{$Property_diff}}').slideToggle(function(){$('#more{{$Property_diff}}').html($('#diff{{$Property_diff}}').is(':visible')?'Hide {{$Property_Name}} {{$i}}':'{{$Property_Name}} {{$i}}');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">{{$Property_Name}} {{$i}}</span></a>
                                <a href="javascript:void(0)" onclick="AddDetail('{{$item_id}}','{{$Property_Id}}','{{$Property_Name}}','{{$Property_diff}}')"><i style="padding-left:14px" class="feather-edit"></i></a>
                                <a href="javascript:void(0)" onclick="DeleteDetail('{{$Property_diff}}')"><i style="padding-left:14px" class="feather-trash-2"></i></a>

                                <label for="uploadImages{{$Property_diff}}"><i class="text-primary feather-image ps-3"></i></label>
                                <input type="file" style="display:none;" id="uploadImages{{$Property_diff}}" name="eee[]" accept="image/*" multiple onchange="formImage('{{$item_id}}','{{$Property_Id}}','{{$Property_diff}}')" >


                            <!-- sha8ala hena -->
                            <ul id="diff{{$Property_diff}}" style="display: none;">
                                @if(count($detailValue) !=0 )
                                @foreach ($detailValue as $detail)
                                @if($detail->datatype=='text')
                                <li>{{$detail->Detail_Name}} : {{$detail->DetailValue}} </li>
                                @elseif($detail->datatype=='checkbox')
                                @if($detail->DetailValue=='yes')
                                <li>{{$detail->Detail_Name}} : <i class="feather-check-circle"></i></li>
                                @else
                                <li>{{$detail->Detail_Name}} : <i class="feather-x-circle"></i></li>
                                @endif
                                @elseif($detail->datatype=='file')
                                <div id="detailimage{{$detail->Detail_Id}}" class="col-6 mb-2 pe-1">
                                <a href="javascript:void(0)" onclick="DeleteDetailImage('{{$detail->Detail_Id}}')"><i style="padding-left:14px" class="feather-trash-2"></i></a>
                                <a href="{{asset('storage/profile gallery/'.$detail->DetailValue)}}" data-lightbox="roadtrip"> <img src="{{asset('storage/profile gallery/'.$detail->DetailValue)}}" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                @endif
                                @endforeach
                                @else
                                <li> no data for this {{$Property_Name}} yet </li>
                                @endif
                            </ul>

                        </li>
                        @endforeach
                    </ul>
                </form>
                </li>

            </ul>
            @endforeach
            @endforeach


            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <h3>
            Location <a href="javascript:void(0)" onclick="EditLoaction();"><i class="feather-edit text-grey-500 me-3 font-sm"></i></a>
        </h3>
        <div class="card-body p-0 d-flex">

            <div class="clearfix">
                <form action="{{url('EditItemMap/'.$item->Item_Id)}}" method="POST">
                    @CSRF
                    <div id="edit" style="display: none;"><label for="">Location:<input id="map-search" class="form-control" type="text" placeholder="Search Box" size="30"></label><button type="submit" class="btn btn-primary">Edit</button><br></div>
                    <input type="text" name="lat" class="latitude">
                    <input type="text" name="lang" class="longitude">
                    <input type="hidden" id="lat" value="{{$item->address_latitude}}">
                    <input type="hidden" id="lang" value="{{$item->address_longitude}}">
                    <div id="map-canvas"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    var s = 0;
    var start;
    var end;
    var start_date;
    var end_Date;
    var start_id;
    var End_id;
    var schedule;

    function EditLoaction() {
        document.getElementById('edit').style.display = 'block';
    }

    function test(day, schedule_Id) {
        var date2;
        var clicked = document.getElementById(day);
        var clicked_id = clicked.getAttribute('id');
        var schedule_Id2;
        var disable;

        // if(clicked_id==start_id){clicked.className="calendar-table__item"; s=0; start_id=null; start=nu }// reset all days if s=0 or 1 or
        // else if(clicked_id==End_id){clicked.className="calendar-table__item"; s=1;}

        if (s == 0) {
            clicked.className = 'calendar-table__item_Start';
            s = 1;
            start = clicked;
            start_id = clicked.getAttribute('id');
            start_date = new Date(start_id);

            disable = document.getElementsByClassName("calendar-table__item");
            // console.log(disable.length); //44

            $('.calendar-table__item').each(function() {
                var $this = $(this);
                // console.log($this);
                schedule_Id2 = $this[0].getAttribute("name");
                date2 = new Date($this[0].getAttribute("id"));

                if (schedule_Id2 != schedule_Id) {
                    $this.removeClass('calendar-table__item').addClass('calendar-table__item_isdisable');
                }
                if (date2 < start_date) {
                    $this.removeClass('calendar-table__item').addClass('calendar-table__item_isdisable');
                }
            });
        } else if (s == 1) {

            clicked.className = 'calendar-table__item_End';
            end = clicked;
            End_id = end.getAttribute('id');
            end_Date = new Date(End_id);
            s = 2;
            if (End_id == start_id) {
                end.className = 'one_day';
            }

            $('.calendar-table__item').each(function() {
                var $this = $(this);
                date2 = new Date($this[0].getAttribute("id"));
                if (date2 > start_date && date2 < end_Date) {
                    // console.log($this);
                    $this.removeClass('calendar-table__item').addClass('calendar-table__item_Rang');

                }
            });
            // $("#gobutton").style.display = "none";
            schedule = schedule_Id;
            console.log(schedule);
            document.getElementById("gobutton").style.display = "inline";

        } else {
            end.className = 'calendar-table__item';
            start.className = 'calendar-table__item';
            $('.calendar-table__item_Rang').each(function() {
                var $this = $(this);
                $this.removeClass('calendar-table__item_Rang ').addClass('calendar-table__item');
            });
            $('.calendar-table__item_isdisable').each(function() {
                var $this = $(this);
                $this.removeClass('calendar-table__item_isdisable ').addClass('calendar-table__item');
            });
            s = 0;
            schedule = null;
            document.getElementById("gobutton").style.display = "none";
        }

    }

    function goreserve(item_id) {
        console.log(start_id);
        console.log(End_id);
        console.log(schedule);

        $.ajax({
            url: "{{route('calculate.days')}}",
            Type: "get",
            data: {
                start: start_id,
                end: End_id,
                schedule_Id: schedule,

            },
            success: function(data) {
                console.log(data);
                // return (['totalPrice'=>$totalPric>$start_date,"end_date"=>$end_date]);

                location.href = "/Payment/" + item_id + "/" + data['totalDays'] + "/" + data['totalPrice'] + "/" + data['price_per_night'] + "/" + data['start_date'] + "/" + data['end_date'];
            },
            error: function(data) {

                console.log(data['totalDays']);
            }

        });

    }


    function DeleteDetailImage(id) {
        $.ajax({
            url: "{{route('delete.detail')}}",
            Type: "PUT",
            data: {
                id: id,
            },
            success: function(data) {
                $("#detailimage" + id).remove();
            },
            error: function() {}

        });

    }

    function DeleteDetail(diff) {
        $.ajax({
            url: "{{route('delete.details')}}",
            Type: "PUT",
            data: {
                diff: diff,
            },
            success: function(data) {
                $("#lidiff" + diff).remove();
            },
            error: function() {}

        });

    }

    function AddDetail(item_id, id, name, diff) {
        $("#item_id").val(item_id);
        $("#exampleModalLabel").html(name);
        var Form = '';
        $.ajax({
            url: "{{route('Details.find')}}",
            Type: "PUT",
            data: {
                id: id,
                diff: diff
            },
            success: function(data) {
                console.log(data);

                var properties = data['properties'];
                var details = data['details'];

                $("#EditMainTypeModal").modal("toggle");
                Object.values(properties).forEach(val => {
                    var detail = details[val['Property_Detail_Id']];
                    if (detail != undefined) {
                        // console.log('found');
                        console.log(detail[0]['datatype']);


                        if (detail[0]['datatype'] == "file") {

                        } else {
                            Form += '@csrf <div class="form-group row"> ' +
                                '<label for="' + detail[0]['Detail_Id'] + '" class="col-md-2 col-form-label text-md-right">' + detail[0]['Detail_Name'] + '</label>' +
                                '<div class="col-md-5">';
                        }


                        if (detail[0]['datatype'] == "file") {
                        }
                        else if (detail[0]['datatype']  == "checkbox") {
                            if (detail[0]['DetailValue'] == "yes") {
                                Form += '<input type="' + detail[0]['datatype'] + '" id="' + detail[0]['Detail_Id'] + '" name="DetailItem[]" value="' + detail[0]['DetailValue'] + '" class="form-check-input" checked>' +
                                    '</div>' +
                                    '</div>';
                            } else {
                                Form += '<input type="' + detail[0]['datatype'] + '" id="' + detail[0]['Detail_Id'] + '" name="DetailItem[]" value="' + detail[0]['DetailValue'] + '" class="form-check-input" >' +
                                    '</div>' +
                                    '</div>';
                            }
                        }
                        else {
                            Form += '<input type="' + detail[0]['datatype'] + '" id="' + detail[0]['Detail_Id'] + '" name="DetailItem[]" value="' + detail[0]['DetailValue'] + '" class="form-control" >' +
                                '</div>' +
                                '</div>';
                        }



                    } else {
                        if (val['datatype'] == "file") {

                        } else {
                            Form += '@csrf <div class="form-group row"> ' +
                                '<label for="new" class="col-md-2 col-form-label text-md-right">' + val['Detail_Name'] + '</label>' +
                                '<div class="col-md-5">'
                                '</div>' +
                                '</div>';
                        }


                        if (val['datatype'] == "file") {
                        }
                        else if (val['datatype']  == "checkbox") {

                                Form += '<input type="' + val['datatype'] + '"  name="DetailItem[]"  class="form-check-input" >' +
                                    '</div>' +
                                    '</div>';

                        }
                        else {
                            Form += '<input type="' + val['datatype'] + '" name="DetailItem[]" class="form-control" >' +
                                '</div>' +
                                '</div>';
                        }

                    }
                });
                Form += '<input type="hidden" id="diff" value="' + diff + '">' +
                '</div>' +
                    '</div>';

                if (Form == '')
                    Form = 'No Property Details';
                else
                    Form += ' <div class="form-group row mb-0">' +
                    '<div class="col-md-2 offset-md-2">' +
                    ' <button type="submit" class="btn btn-primary">' +
                    ' {{ __("Edit") }}';
                '</button>';


                $('#data_form_edit').html(Form);
                Object.values(data).forEach(val => {
                    $('#' + val['Property_Detail_Id']).val($('#PID' + val['Property_Detail_Id']).val());
                });

            },
            error: function() {
                console.log('Error');
            }

        });
    }

    $('#data_form_edit').submit(function() {

        var fd = new FormData();
        console.log(fd);
        var data = [];
        var item_id = $("#item_id").val();
        var diff = $("#diff").val();

        //3iza ageeb kol el inputs b get element by name
        //w b3deen 3iza 27ot el inputs value&id f array
        $('input[name="DetailItem[]"]').each(function() {

            data.push({
                id: this.id,
                value: this.value,
                type: this.type,
                diff: diff,
            });
        });
        var _token = $("input[name=_token]").val();
        //w b3den 3iza 2b3t el array le el controller
        $.ajax({
            type: "post",
            url: "{{ route('details.edit')}}",
            data: {
                data: fd,
                item_id: item_id,
                _token: '{{csrf_token()}}'
            },
            contentType: false,
            processData: false,
            success: function(s) {
                //hna 3iza anady 3la created succefully
                console.log(s);
            },
            error: function(s) {
                // hna anady 3la not created w kdaho
                console.log(s)
                console.log('Error');
            }
        });

    });

    function formImage(item_id, property_id, diff){

        var action="/addImageForAProperty/"+item_id+"/"+property_id+"/"+diff;

        $('#imageform').attr('action',action).submit();
    }
</script>

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


<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCUywuD0K3ICLer31HgVIJ-Uhi_Suj2jA&libraries=places&callback=initialize"></script>
@endsection
