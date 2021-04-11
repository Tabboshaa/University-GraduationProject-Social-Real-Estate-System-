@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_operation_type') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="Operation_Type_Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Operation Type :') }}
                    </label>

                    <div class="col-md-2">
                        <input id="Operation_Name" name="Operation_Type_Name" style="border-radius: 3pt" type="text" class="form-control @error('Main_Type_Name') is-invalid @enderror" name="Main_Type_Name" value="{{ old('Main_Type_Name') }}" required autocomplete="Main_Type_Name" autofocus>

                        @error('Operation_Type_Name')
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
                            <a href="{{url('/operation_types_show')}}" class="link2" >{{ __('Show') }}</a>
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
