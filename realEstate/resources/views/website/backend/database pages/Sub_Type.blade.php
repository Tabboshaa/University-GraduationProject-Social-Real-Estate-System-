@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_sub_type') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="Main Type Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Main Type :') }}
                    </label>

                    <div class="col-md-2">
                        <select id="MainTypeName" style="border-radius: 3pt" class="form-control @error('Main Type Name') is-invalid @enderror" name="Main_Type_Name" value="{{ old('Main Type Name') }}" required autocomplete="Main Type Name">

                            <option value="0" selected disabled>Select Main Type</option>

                            <!--  For loop  -->
                            @foreach($main_type as $main_type)
                            <option value="{{$main_type->Main_Type_Id}}">{{$main_type->Main_Type_Name}}</option>
                            @endforeach
                            <!-- End loop -->
                            {{-- if (var !=null)
                                         roo7 l java script ($("#mydropdownlist").val("thevalue");)        --}}
                        </select>
                        @error('Main Type Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Sub Type Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Sub Type :') }}
                    </label>

                    <div class="col-md-2">
                        <input id="Sub Type Name"  style="border-radius: 3pt" type="text" class="form-control @error('Sub_Type_Name') is-invalid @enderror" name="Sub_Type_Name" value="{{ old('Sub Type Name') }}" required autocomplete="Sub Type Name" autofocus>

                        @error('Sub_Type_Name')
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
                            <a href="{{url('/sub_types_show')}}" class="link2" >{{ __('Show') }}</a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                    @yield('table')
                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
