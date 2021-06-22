@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_opDetail') }}" enctype="multipart/form-data">
                @csrf
               
                <div class="form-group row">
                    <label for="country_name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Operation Name:') }}
                    </label>

                    <div class="col-md-2">
                        <select id="operation_Name" style="border-radius: 3pt" class="form-control @error('operation_Name') is-invalid @enderror" name="operation_Name" value="{{ old('operation_Name') }}" required autocomplete="operation_Name">
                            <option value="0" selected disabled>Select Operation Name:</option>

                            @foreach($Operation__types as $Operation__types)
                            <option value="{{$Operation__types->Operation_Type_Id}}">{{$Operation__types->Operation_Name}}</option>
                            @endforeach
                        </select>

                        @error('operation_Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- Add New State -->
                <div class="form-group row">
                    <label for="State Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Operation Detail :') }}
                    </label>
                    <div class="col-md-2">
                        <input id="Operation_Detail" type="text" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital"  style="border-radius: 3pt"class="form-control @error('Operation_Detail') is-invalid @enderror" name="Operation_Detail" value="{{ old('Operation_Detail') }}" required autocomplete="Operation_Detail" autofocus>

                        @error('Operation_Detail')
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
                        
                            <a href="{{url('/show_detailop')}}" class="btn btn-primary" >{{ __('Show') }}</a>
                       
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