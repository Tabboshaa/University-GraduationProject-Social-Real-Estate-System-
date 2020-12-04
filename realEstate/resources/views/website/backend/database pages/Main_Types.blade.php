@extends('website.backend.layouts.main')
@section('content')
<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            <form method="POST" action="{{ url('/add_main_type') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="Main Type Name" class="col-md-2 col-form-label text-md-right">{{ __('Main Type Name') }}</label>

                    <div class="col-md-2">
                        <input id="Main Type Name" type="text" class="form-control @error('Main Type Name') is-invalid @enderror" name="Main_Type_Name" value="{{ old('Main Type Name') }}" required autocomplete="Main Type Name" autofocus>

                        @error('Main Type Name')
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
                        <a href="{{ url('/main_types_show') }}" class="btn btn-primary"> {{ __('Show') }}</a>
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