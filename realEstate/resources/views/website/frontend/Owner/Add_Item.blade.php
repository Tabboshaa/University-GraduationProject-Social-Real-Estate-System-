@extends('website.frontend.layouts.main')
@section('profile')
@include('website.backend.layouts.flashmessage')

<script src="/js/map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCUywuD0K3ICLer31HgVIJ-Uhi_Suj2jA&libraries=places&callback=initialize"></script>
<link rel="stylesheet" href="/css/map.css">

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


<div style="margin-left:135px;"class="col-xl-12">
    <div class="card w-1`00 border-0 bg-white shadow-xs p-0 mb-4">
        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
            <a href="default-settings.html" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
            <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">  Adding Item Step 1</h4>
        </div>
        <div class="card-body p-lg-5 p-4 w-100 border-0 mb-0">

            <form method="Post" action="{{ url('/OwnerAddItem') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 mb-0">
                        <div class="form-group">
                            <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload">
                                <h6>Item Name</h6>
                            </label>
                            <input type="text" style="width: 865px;" class="form-control" name="Item_Name" id="Item_Name"  placeholder="Name the Item">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-0" style="margin-right:0px;">
                            <div class="form-group" >
                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload">
                                    <h6>Country</h6>
                                </label>
                                <select id="CountrySelect"style="width: 865px;" class="date-picker form-control" name="Country" value="{{ old('Country') }}">
                                    <option value="0" selected disabled>Select Country</option>
                                    <!--  For loop  -->
                                    @foreach($country as $c)
                                    <option value="{{$c->Country_Id}}">{{$c->Country_Name}}</option>
                                    @endforeach
                                </select>
                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload">
                                    <h6>State</h6>
                                </label>
                                <select id="StateSelect"style="width: 865px;" class="date-picker form-control" name="State" value="{{ old('State') }}"></select>

                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload">
                                    <h6>City</h6>
                                </label>
                                <select id="CitySelect"style="width: 865px;" class="date-picker form-control" name="CitySelect" value="{{ old('City') }}"></select>
                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload">
                                    <h6>Region</h6>
                                </label>
                                <select id="RegionSelect"style="width: 865px;" class="date-picker form-control" name="Region" value="{{ old('Region') }}"></select>

                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload">
                                    <h6>Street</h6>
                                </label>
                                <select id="StreetSelect" style="width: 865px;"class="date-picker form-control" name="StreetSelect" value="{{ old('Street') }}"></select> <br><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="">Address: <input id="map-search" class="controls" type="text" placeholder="Search Box" ></label><br>
                                <label for="">City <input type="text" name="City" class="reg-input-city" placeholder="City"></label>
                                <label for="">Street <input type="text" name="Street" class="reg-input-street" placeholder="Street"></label>
                                
                                <input type="text" style="margin-top:15px;margin-left:10px;"name="latitude" class="latitude">
                                <input type="text" style="margin-top:15px;margin-left:10px;"name="longitude" class="longitude">
                            </div>
                            
                        </div>
                        <div class="col-lg-6 mb-3">
                        <div id="map-canvas"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right mb-0 mt-2 ps-0" style="margin-right:50px;">
                        <input type="submit" value="Next " style="margin-right:70px;"class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

