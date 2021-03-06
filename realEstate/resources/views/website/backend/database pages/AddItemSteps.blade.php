@extends('website.backend.layouts.main')
@section('content')
 <script type="text/javascript">
        $(document).ready(function() {


            $(document).on('change', '#CountrySelect', function() {

                var country_id = $(this).val();
                //  console.log(MainType_id);

                var FormTag = $(this).parent().parent().parent();
                var op = " ";
                $.ajax({
                    type: 'get',
                    url: "{{ url('/D4') }}",
                    data: {
                        'id': country_id
                    },
                    success: function(data) {
                        //console.log('success');

                        op += '<option value="0" selected disabled>Select State</option>';

                        Object.values(data).forEach(val => {
                            //   console.log(val);

                            op += '<option value="' + val['State_Id'] + '">' + val['State_Name'] + '</option>';
                        });



                        FormTag.find('#StateSelect').html(" ");
                        FormTag.find('#StateSelect').append(op);
                    },
                    error: function() {
                        //  console.log('error');
                    }
                });
            });

            $(document).on('change', '#StateSelect', function() {

                var state_id = $(this).val();
                //  console.log(MainType_id);
                var FormTag = $(this).parent().parent().parent();
                var opp = " ";

                $.ajax({
                    type: 'get',
                    url: "{{ url('/D5') }}",
                    data: {
                        'id': state_id
                    },
                    success: function(data) {
                        //console.log('success');
                        opp += '<option value="0" selected disabled>Select City</option>';

                        Object.values(data).forEach(val => {
                            //   console.log(val);

                            opp += '<option value="' + val['City_Id'] + '">' + val['City_Name'] + '</option>';
                        });

                        FormTag.find('#CitySelect').html(" ");
                        FormTag.find('#CitySelect').append(opp);
                    },
                    error: function() {
                        //  console.log('error');
                    }
                });
            });

            $(document).on('change', '#CitySelect', function() {

                var city_id = $(this).val();
                //  console.log(MainType_id);
                var FormTag = $(this).parent().parent().parent();
                var oppp = " ";

                $.ajax({
                    type: 'get',
                    url: "{{ url('/D6') }}",
                    data: {
                        'id': city_id
                    },
                    success: function(data) {
                        //console.log('success');
                        oppp += '<option value="0" selected disabled>Select Region</option>';

                        Object.values(data).forEach(val => {
                            //   console.log(val);

                            oppp += '<option value="' + val['Region_Id'] + '">' + val['Region_Name'] + '</option>';
                        });

                        FormTag.find('#RegionSelect').html(" ");
                        FormTag.find('#RegionSelect').append(oppp);
                    },
                    error: function() {
                        //  console.log('error');
                    }
                });
            });

            $(document).on('change', '#RegionSelect', function() {

                var region_id = $(this).val();
                //  console.log(MainType_id);
                var FormTag = $(this).parent().parent().parent();
                var opppp = " ";

                $.ajax({
                    type: 'get',
                    url: "{{ url('/D7') }}",
                    data: {
                        'id': region_id
                    },
                    success: function(data) {
                        //console.log('success');
                        opppp += '<option value="0" selected disabled>Select Street</option>';

                        Object.values(data).forEach(val => {
                            console.log(val);

                            opppp += '<option value="' + val['Street_Id'] + '">' + val['Street_Name'] + '</option>';
                        });

                        FormTag.find('#StreetSelect').html(" ");
                        FormTag.find('#StreetSelect').append(opppp);
                    },
                    error: function() {
                        //  console.log('error');
                    }
                });
            });

        });
</script>
    <!-- <script src="{{ asset('js/location.js')}}"></script> -->
    <link href="{{asset('css/Form.css')}}" rel="stylesheet" type="text/css" />

    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add item steps</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            @include('website.backend.layouts.flashmessage')
                            <form id="AddItemForm" method="post" action="{{ url('/addItem') }}" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="tab">
                                <h4>Search for item owner by Email:</h4>
                                    <div class="item form-group">
                                        <a href="javascript:void(0)" id="SearchA" onclick="searchForEmail()" class="btn btn-info" role="button">Search </a>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="search" id="Search" name="Search" required="required" class="form-control">
                                            <input type="hidden" id="userIdHiddenInput" name="userIdHiddenInput" required>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <table id="result" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                            
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="tab">
                                    <h5 style="text-align:center;">item name</h5>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Item Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="Item_Name" name="item_Name" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <h5 style="text-align:center;">item location</h5>


                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number"> Country<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select id="CountrySelect" class="form-control " name="Country" value="{{ old('Country') }}">
                                                <option value="0" selected disabled>Select Country</option>
                                                <!--  For loop  -->
                                                @foreach($counrty as $counrty)
                                                    <option value="{{$counrty->Country_Id}}">{{$counrty->Country_Name}}</option>
                                                @endforeach
                                            </select>
                                            <!-- End loop -->
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number">State<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select id="StateSelect" class="form-control " name="State" value="{{ old('State') }}"></select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number"> City<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select id="CitySelect" class="form-control " name="City" value="{{ old('City') }}"></select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number"> Region<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select id="RegionSelect" class="form-control " name="Region" value="{{ old('Region') }}"></select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number"> Street<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select id="StreetSelect" class="form-control " name="Street" value="{{ old('Street') }}"></select>
                                        </div>
                                    </div>
                                </div>
                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>

                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align:center;margin-top:40px;">
                                    <span class="step"></span>
                                    <span class="step"></span>

                                </div>

                            </form>
                            <script>
                                function searchForEmail() {

                                    var email = $("#Search").val();
                                    var _token = $("input[name=_token]").val();
                                    $.ajax({
                                        type: 'post',
                                        url: "{{ route('search') }}",
                                        data: {
                                            email: email,
                                            _token: _token
                                        },
                                        success: function(data) {
                                            var result=""
                                            Object.values(data).forEach(val => {
                                                result+='<tr><td>' + val['email'] + '</td> <td> <input type="checkbox" name="userid" value="' + val['User_ID'] + '" onclick="onlyOne(this)"> </td> </tr>';
                                            });
                                            if(result=="")
                                            {
                                                $("#result").html("<tr class='table-danger'><td> Sorry, There is no user with this email !</td></tr>");
                                            }else
                                                $("#result").html(result);
                                            console.log(data);
                                        },
                                        error: function() {
                                            $("#result").html('There is no User with this Email!!');
                                        }
                                    });

                                }

                                function onlyOne(checkbox) {
                                    var checkboxes = document.getElementsByName('userid')
                                    checkboxes.forEach((item) => {
                                        if (item !== checkbox) item.checked = false
                                    })
                                    $("#userIdHiddenInput").val(checkbox.value);
                                    document.getElementById("nextBtn").style.display = "inline";
                                }
                            </script>

                            <script>
                                var currentTab = 0; // Current tab is set to be the first tab (0)
                                showTab(currentTab); // Display the current tab

                                function showTab(n) {
                                    // This function will display the specified tab of the form ...
                                    var x = document.getElementsByClassName("tab");
                                    x[n].style.display = "block";
                                    // ... and fix the Previous/Next buttons:
                                    if (n == 0) {
                                        document.getElementById("prevBtn").style.display = "none";
                                        document.getElementById("nextBtn").style.display = "none";


                                    } else {
                                        document.getElementById("prevBtn").style.display = "inline";
                                    }
                                    if (n == (x.length - 1)) {
                                        document.getElementById("nextBtn").innerHTML = "continue";
                                    } else {
                                        document.getElementById("nextBtn").innerHTML = "Next";
                                    }
                                    // ... and run a function that displays the correct step indicator:
                                    fixStepIndicator(n);
                                }

                                function nextPrev(n) {
                                    // This function will figure out which tab to display
                                    var x = document.getElementsByClassName("tab");
                                    // Exit the function if any field in the current tab is invalid:
                                    if (n == 1 && !validateForm()) return false;
                                    // Hide the current tab:
                                    x[currentTab].style.display = "none";
                                    // Increase or decrease the current tab by 1:
                                    currentTab = currentTab + n;
                                    // if you have reached the end of the form... :
                                    if (currentTab >= x.length) {
                                        //...the form gets submitted:
                                        document.getElementById("AddItemForm").submit();
                                        return false;
                                    }
                                    // Otherwise, display the correct tab:
                                    showTab(currentTab);
                                }

                                function validateForm() {
                                    // This function deals with validation of the form fields
                                    var x, y, i, valid = true;
                                    x = document.getElementsByClassName("tab");
                                    y = x[currentTab].getElementsByTagName("input");
                                    // A loop cthat checks every input field in the current tab:
                                    for (i = 0; i < y.length; i++) {
                                        // If a field is empty...
                                        if (y[i].value == "") {
                                            // add an "invalid" class to the field:
                                            y[i].className += " invalid";
                                            // and set the current valid status to false:
                                            valid = false;
                                        }
                                    }
                                    // If the valid status is true, mark the step as finished and valid:
                                    if (valid) {
                                        document.getElementsByClassName("step")[currentTab].className += " finish";
                                    }
                                    return valid; // return the valid status
                                }

                                function fixStepIndicator(n) {
                                    // This function removes the "active" class of all steps...
                                    var i, x = document.getElementsByClassName("step");
                                    for (i = 0; i < x.length; i++) {
                                        x[i].className = x[i].className.replace(" active", "");
                                    }
                                    //... and adds the "active" class to the current step:
                                    x[n].className += " active";
                                }

                                $('#AddItemForm').on('keyup keypress', function(e) {
                                    var keyCode = e.keyCode || e.which;
                                    if (keyCode === 13) {
                                        e.preventDefault();
                                        return false;
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
