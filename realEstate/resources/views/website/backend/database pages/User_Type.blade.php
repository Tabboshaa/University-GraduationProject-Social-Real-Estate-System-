@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

    <div class="right_col" role="main">
        <div class="title_right">
            <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
                <form method="POST" action="{{ url('/add_user_type') }}" enctype="multipart/form-data">
                @csrf
                <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label for="User_Type_Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                            {{ __('User Type :') }}
                        </label>

                        <div class="col-md-2">
                            <input id="User_Type_Name"style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" type="text" class="form-control @error('User_Type_Name') is-invalid @enderror" name="User_Type_Name" value="{{ old('User_Type_Name') }}" required autocomplete="User_Type_Name" autofocus>
                            @error('User_Type_Name')
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
                          
                                <a href="{{url('/user_types_show')}}" class="btn btn-primary" >{{ __('Show') }}</a>
                            
                        </div>
                    </div>
              
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
