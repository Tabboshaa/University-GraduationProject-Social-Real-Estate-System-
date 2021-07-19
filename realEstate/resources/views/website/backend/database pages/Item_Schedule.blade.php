@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_item_schedule/'.$item_id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="arrival" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Start Date:') }}
                    </label>

                    <div class="col-md-2">

                        <input style="border-radius: 3pt" type="date" class="form-control @error('arrival') is-invalid @enderror" name="arrival" value="{{ old('arrival') }}" required autocomplete="arrival" autofocus>

                        @error('arrival')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="departure" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Departure Date:') }}
                    </label>

                    <div class="col-md-2">
                        <input style="border-radius: 3pt" type="date" class="form-control @error('departure') is-invalid @enderror" name="departure" value="{{ old('departure') }}" required autocomplete="departure">

                        @error('departure')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Price" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Price Per Night:') }}
                    </label>

                    <div class="col-md-2">

                        <input style="border-radius: 3pt" type="text" class="form-control @error('Price') is-invalid @enderror" name="price" value="{{ old('Price') }}" required autocomplete="Price">
                        @error('Price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" id="btun1" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                        <button id="btun2" class="btn btn-primary">
                            <a href="{{url('/show_item_schedule/'.$item_id)}}" class="link2">{{ __('Show') }}</a>
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