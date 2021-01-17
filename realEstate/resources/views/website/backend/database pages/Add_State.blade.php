@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_state') }}" enctype="multipart/form-data">
                @csrf
                <!-- Select Country -->
                <div class="form-group row">
                    <label for="country_name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Country :') }}
                    </label>

                    <div class="col-md-2">
                        <select id="country_name" style="border-radius: 3pt" class="form-control @error('country_name') is-invalid @enderror" name="country_name" value="{{ old('country_name') }}" required autocomplete="country_name">
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
                <!-- Add New State -->
                <div class="form-group row">
                    <label for="State Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('State :') }}
                    </label>
                    <div class="col-md-2">
                        <input id="State_Name" type="text" style="border-radius: 3pt"class="form-control @error('State Name') is-invalid @enderror" name="State_Name" value="{{ old('State Name') }}" required autocomplete="State Name" autofocus>

                        @error('State_Name')
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
                        </form>
                        <button id="btun2"  class="btn btn-primary">
                            <a href="{{url('/show_state')}}" class="link2" >{{ __('Show') }}</a>
                        </button>
                    </div>
                </div>
           
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