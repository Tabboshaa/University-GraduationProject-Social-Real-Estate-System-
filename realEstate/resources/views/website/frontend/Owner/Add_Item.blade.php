@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/ItemAddressStyle.css')}}" rel="stylesheet" type="text/css" />

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

    @include('website.backend.layouts.flashmessage')
    
    <form id="AddItemForm" method="post" action="{{ url('/addItem') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="header">ADD ITEM LOCATION</h3>
        <div class="locationForm" >
                <label for="phone_number"> Country<span>*</span>
                </label>
                <div class="placeform">
                    <select id="CountrySelect" name="Country" value="{{ old('Country') }}">
                        <option value="0" selected disabled>Select Country</option>
                        <!--  For loop  -->
                        {{-- @foreach($counrty as $counrty)
                            <option value="{{$counrty->Country_Id}}">{{$counrty->Country_Name}}</option>
                        @endforeach --}}
                    </select>
                </div>
                    <!-- End loop -->
                <label for="phone_number">State<span >*</span>
                </label>
                <div class="placeform">
                    <select id="StateSelect"  name="State" value="{{ old('State') }}"></select>
                </div>
                <label  for="phone_number"> City<span >*</span>
                </label>
                <div class="placeform">
                    <select id="CitySelect"  name="City" value="{{ old('City') }}"></select>
                </div>
                <label for="phone_number"> Region<span >*</span>
                </label>
                <div class="placeform">
                    <select id="RegionSelect"name="Region" value="{{ old('Region') }}"></select>
                </div>
                    <label for="phone_number"> Street<span >*</span>
                </label>
                <div class="placeform">
                    <select id="StreetSelect" name="Street" value="{{ old('Street') }}"></select>
                </div>
        </div>
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <!-- Circles which indicates the steps of the form: -->
        
            <span class="step"></span>
            <span class="step"></span>

    </form>
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
            // A loop that checks every input field in the current tab:
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
@endsection