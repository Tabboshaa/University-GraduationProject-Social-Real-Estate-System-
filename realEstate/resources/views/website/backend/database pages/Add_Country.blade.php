@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

    <div class="right_col" role="main">
        <div class="title_right">
            <div class="x_panel">
                
            @include('website.backend.layouts.flashmessage')
                <form method="POST" action="{{ url('/add_country') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Add New Country -->
                    <div class="form-group row">
                        <label for="country_name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                            {{ __('Country :') }}
                        </label>
                            <div class="col-md-2">
                                <input   type="text" id="country_name" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" style="border-radius: 3pt" class="form-control @error('country_name') is-invalid @enderror" name="country_name" value="{{ old('country_name') }}" required autocomplete="country_name" autofocus>

                                    @error('country_name')
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
                            

                                <a href="{{url('/show_country')}}" class="btn btn-primary" >{{ __('Show') }}</a>
                            
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

@endsection