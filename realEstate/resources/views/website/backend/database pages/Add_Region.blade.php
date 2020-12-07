@extends('website.backend.layouts.main')
@section('content')

<script type="text/javascript">
    $(document).ready(function() {


        $(document).on('change', '#Country_Name', function() {

            var country_id = $(this).val();
            //  console.log(MainType_id);

            var FormTag = $(this).parent().parent().parent();
            var op = " ";
            $.ajax({
                type: 'get',
                url: "{{ url('/D2') }}",
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



                    FormTag.find('#State_Name').html(" ");
                    FormTag.find('#City_Name').html(" ");
                    FormTag.find('#State_Name').append(op);
                },
                error: function() {
                    //  console.log('error');
                }
            });
        });

        $(document).on('change', '#State_Name', function() {

            var state_id = $(this).val();
            //  console.log(MainType_id);
            var FormTag = $(this).parent().parent().parent();
            var opp = " ";

            $.ajax({
                type: 'get',
                url: "{{ url('/D3') }}",
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


                    FormTag.find('#City_Name').append(opp);
                },
                error: function() {
                    //  console.log('error');
                }
            });
        });

    });
</script>
<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_region') }}" enctype="multipart/form-data">
                @csrf
                <!-- Add Country-->
                <div class="form-group row">
                    <label for="Country Name" class="col-md-2 col-form-label text-md-right">{{ __('Country Name') }}</label>

                    <div class="col-md-2">
                        <select id="Country_Name" class="form-control @error('Country Name') is-invalid @enderror" name="Country_Name" value="{{ old('Country Name') }}" required autocomplete="Country Name">
                            <option value="0" selected disabled>Select Country</option>
                            <!--  For loop  -->
                            @foreach($counrty as $country)
                            <option value="{{$country->Country_Id}}">{{$country->Country_Name}}</option>
                            @endforeach
                            <!-- End loop -->
                        </select>
                        @error('Country Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- Add State-->
                <div class="form-group row">
                    <label for="State Name" class="col-md-2 col-form-label text-md-right">{{ __('State Name') }}</label>

                    <div class="col-md-2">
                        <select id="State_Name" class="form-control @error('State Name') is-invalid @enderror" name="State_Name" value="{{ old('State Name') }}" required autocomplete="State Name">

                        </select>
                        @error('State Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- Add City-->
                <div class="form-group row">
                    <label for="City Name" class="col-md-2 col-form-label text-md-right">{{ __('City Name') }}</label>

                    <div class="col-md-2">
                        <select id="City_Name" class="form-control @error('City Name') is-invalid @enderror" name="City_Name" value="{{ old('City Name') }}" required autocomplete="City Name">

                        </select>
                        @error('City Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- Add New Region -->
                <div class="form-group row">
                    <label for="Region Name" class="col-md-2 col-form-label text-md-right">{{ __('Region Name :') }}</label>
                    <div class="col-md-2">
                        <input id="Region Name" type="text" class="form-control @error('Region Name') is-invalid @enderror" name="Region_Name" value="{{ old('Region Name') }}" required autocomplete="Region Name" autofocus>

                        @error('Region Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                        <a href="{{url('/show_region')}}" class="btn btn-primary">{{ __('Show') }}</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection