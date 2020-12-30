@extends('website.backend.layouts.main')
@section('content')
<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_state') }}" enctype="multipart/form-data">
                @csrf
                <!-- Select Country -->
                <div class="form-group row">
                    <label for="country_name" class="col-md-2 col-form-label text-md-right">{{ __('Country Name ') }}</label>

                    <div class="col-md-2">
                        <select id="country_name" class="form-control @error('country_name') is-invalid @enderror" name="country_name" value="{{ old('country_name') }}" required autocomplete="country_name">
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
                    <label for="State Name" class="col-md-2 col-form-label text-md-right">{{ __('State Name :') }}</label>
                    <div class="col-md-2">
                        <input id="State_Name" type="text" class="form-control @error('State_Name') is-invalid @enderror" name="State_Name" value="{{ old('State Name') }}" required autocomplete="State Name" autofocus>

                        @error('State_Name')
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
                        <a href="{{ url('/show_state') }}" class="btn btn-primary">{{ __('Show') }}</a>
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