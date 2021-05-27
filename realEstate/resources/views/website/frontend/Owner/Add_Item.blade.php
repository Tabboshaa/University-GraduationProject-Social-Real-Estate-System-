@extends('website.frontend.layouts.main')
@section('content')
@include('website.backend.layouts.flashmessage')

<link href="{{asset('css/ItemAddressStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/Form.css')}}" rel="stylesheet" type="text/css" />

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
    <div class="right_col" role="main" style="margin-left:200px;margin-top: 50px;">
        <form id="AddItemForm" method="post" action="{{ url('/OwnerAddItem') }}" enctype="multipart/form-data">
            @csrf
            <h3>ADD ITEM LOCATION</h3>
            <label> Item Name :</label>
            <input type="text" name="Item_Name" id="Item_Name">








            
            
                    <label for="phone_number" > Country<span>*</span></label>
                    <div class="placeform">
                        <select id="CountrySelect" name="Country" value="{{ old('Country') }}">
                            <option value="0" selected disabled>Select Country</option>
                            <!--  For loop  -->
                                @foreach($country as $c)
                                    <option value="{{$c->Country_Id}}">{{$c->Country_Name}}</option>
                                @endforeach 
                        </select>
                    </div>
                            <!-- End loop --> 
                    <label for="phone_number">State<span >*</span></label>
                    <div class="placeform">
                        <select id="StateSelect"  name="State" value="{{ old('State') }}" ></select>
                    </div>
                    <label  for="phone_number"> City<span >*</span></label>
                    <div class="placeform">
                        <select id="CitySelect"  name="City" value="{{ old('City') }}"></select>
                    </div>
                    <label for="phone_number"> Region<span >*</span></label>
                    <div class="placeform">
                        <select id="RegionSelect"name="Region" value="{{ old('Region') }}"></select>
                    </div>
                    <label for="phone_number"> Street<span >*</span></label>
                    <div class="placeform">
                        <select id="StreetSelect" name="Street" value="{{ old('Street') }}"></select>
                    </div>
            
            <button type="submit" id="btun1" style="margin-top:20px;">Next</button>
        </form>
    </div>
@endsection