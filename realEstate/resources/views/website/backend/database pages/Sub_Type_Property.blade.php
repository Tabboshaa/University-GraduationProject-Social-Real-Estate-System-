@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '#MainTypeName', function() {


            var MainType_id = $(this).val();
            console.log(MainType_id);
            var FormTag = $(this).parent().parent().parent(); //first div, second div , form
            var op = " ";
            $.ajax({
                type: 'get',
                url: "{{ url('/findSub') }}",
                data: {
                    'id': MainType_id
                },
                success: function(data) {
                    console.log('success');

                    op += '<option value="0" selected disabled>Select Sub Type</option>';
                    Object.values(data).forEach(val => {
                        console.log(val);
                        op += '<option value="' + val['Sub_Type_Id'] + '">' + val['Sub_Type_Name'] + '</option>';
                    });

                    FormTag.find('#SubTypeName').html("");
                    FormTag.find('#SubTypeProperty').html("");
                    FormTag.find('#SubTypeName').append(op);
                },
                error: function() {
                    console.log('error');
                }
            });
        });

    });
</script>
<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
        @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_sub_type_property') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="Main Type Name" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Main Type :') }}
                    </label>

                    <div class="col-md-2">
                        <select id="MainTypeName" style="border-radius: 3pt"  class="form-control @error('Main Type Name') is-invalid @enderror" name="Main_Type_Name" value="{{ old('Main Type Name') }}" required autocomplete="Main Type Name">

                            <option value="0" selected disabled>Select Main Type</option>
                            <!--  For loop  -->
                            @foreach($main_type as $main_type)
                            <option value="{{$main_type->Main_Type_Id}}">{{$main_type->Main_Type_Name}}</option>
                            @endforeach
                            <!-- End loop -->
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
                        <select id="SubTypeName" style="border-radius: 3pt"  class="form-control @error('Sub Type Name') is-invalid @enderror" name="Sub_Type_Name" value="{{ old('Sub Type Name') }}" required autocomplete="Sub Type Name">
                            <!--  For loop  -->

                            <!-- End loop -->
                        </select>
                        @error('Sub Type Name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Sub_Type_Property" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Sub Type Property :') }}
                    </label>

                    <div class="col-md-2">
                        <input id="Sub_Type_Property" style="border-radius: 3pt" pattern="(^([A-Z][a-z]+)?$)" title="First Letter must be Capital"   type="text" class="form-control @error('Sub_Type_Property') is-invalid @enderror" name="Sub_Type_Property" value="{{ old('Sub_Type_Property') }}" required pattern="[A-Z][a-z]+" title="Start with capital letter " autocomplete="Sub_Type_Property" autofocus>

                        @error('Sub_Type_Property')
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
            
                <a href="{{url('/sub_type_property_show')}}" class="btn btn-primary" >{{ __('Show') }}</a>
            
                </div>
                </div>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                </div>
                @yield('Property_Details_table')

                <div class="row">
                </div>
            </div>
        </div>

    </div>
</div>
</div>

@endsection
