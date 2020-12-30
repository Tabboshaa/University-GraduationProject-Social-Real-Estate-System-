@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript">

$(document).ready(function (){

        // on change new action will happen when user select new country depending on 'select id' "#country_name"
        $(document).on('change','#country_name',function(){

            // creating new variable to save id of select tag in it by 'this' which points to 'select id' #country_name
            var country_id=$(this).val();// .val() will be in it the optaion that user selected
          //  console.log(MainType_id);

            //will save form in formtag variable to make all this changes happen on this form
            //and be able to reach any select tag in this form
            var FormTag= $(this).parent().parent().parent();//first div, second div , form
            var op=" ";
            $.ajax({
                type:'get', // will get data from database
                url:"{{ url('/D1') }}", // will go to route of method find in statecontroller to get the data we need from the State Model
                data:{'id':country_id}, // will send the country_id to the controller
                success:function(data){ // this data is the data wich returned from the controller
                    //console.log('success');

                    // default option but can't be selected
                    op+='<option value="0" selected disabled>Select State</option>';

                    //will get value value in for each from the object data and put it on option tag in op value
                    Object.values(data).forEach(val => {
                     //   console.log(val);

                        // will save all values in op variable
                        op+='<option value="'+val['State_Id']+'">'+val['State_Name']+'</option>';
                    });

                    FormTag.find('#State_Name').html(" ");

                    // will append op in select tag which id is '#State_Name'
                    FormTag.find('#State_Name').append(op);
                },
                error:function(){
                    console.log('error');
                }
            });
        });

    });

</script>

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_city') }}" enctype="multipart/form-data">
                @csrf

                <!-- Select Country -->
                <div class="form-group row">
                    <label for="country_name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Country :') }}
                    </label>

                    <div class="col-md-2">
                        <select id="country_name" style="border-radius: 3pt" class="form-control @error('country_name') is-invalid @enderror" name="Country_Name" value="{{ old('country_namee') }}" required autocomplete="country_name">
                        <option value="0" selected disabled>Select Country</option>   
                        @foreach($country as $country)
                            <option value="{{$country->Country_Id}}">{{$country->Country_Name}}</option>
                            @endforeach
                        </select>

                        @error('country_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Select State -->
                <div class="form-group row">
                    <label for="State Name" style="font-size: 12pt" class="col-md-2 col-form-label text-md-right">
                        {{ __('State :') }}
                    </label>

                    <div class="col-md-2">
                        <select id="State_Name" style="border-radius: 3pt" class="form-control @error('State Name') is-invalid @enderror" name="State_Name" value="{{ old('State_Name') }}" required autocomplete="State_Name">

                        </select>

                        @error('State Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <!-- Add New City -->
                <div class="form-group row">
                    <label for=" City Name" style="font-size: 12pt" class="col-md-2 col-form-label text-md-right">
                        {{ __('City :') }}
                    </label>
                    <div class="col-md-2">
                        <input id="City_Name" style="border-radius: 3pt" type="text" class="form-control @error('City Name') is-invalid @enderror" name="City_Name" value="{{ old('City Name') }}" required autocomplete="City Name" autofocus>

                        @error('City Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" id="btun1"class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                        <button id="btun2"  class="btn btn-primary">
                            <a href="{{url('/show_city')}}" class="link2" >{{ __('Show') }}</a>
                        </button>
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
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
