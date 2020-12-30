@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

    <div class="right_col" role="main">
        <div class="title_right">
            <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
                <form method="POST" action="{{ url('/add_data_type') }}" enctype="multipart/form-data">
                @csrf
                <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label for="Data_Type_Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                            {{ __('Data Type :') }}
                        </label>

                        <div class="col-md-2">
                            <input id="Data_Type_Name"  style="border-radius: 3pt"type="text" class="form-control @error('Data Type Name') is-invalid @enderror" name="Data_Type_Name" value="{{ old('Data_Type_Name') }}" required autocomplete="Data_Type_Name" autofocus>
                            @error('Data Type Name')
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
                                <a href="{{url('/data_types_show')}}" class="link2" >{{ __('Show') }}</a>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
                <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                </div>
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
</div>

@endsection
