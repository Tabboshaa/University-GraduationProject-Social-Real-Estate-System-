@extends('website.backend.layouts.main')
@section('content')
<script type="text/javascript">

    $(document).ready(function (){

        $(document).on('change','#MainTypeName',function(){

            var MainType_id=$(this).val();
            console.log(MainType_id);
            var FormTag= $(this).parent().parent().parent(); //first div, second div , form
            var op=" ";
            $.ajax({
                type:'get',
                url:"{{ url('/findSub')}}",
                data:{'id':MainType_id},
                success:function(data){
                    console.log('success');

                    op+='<option value="0" selected disabled>Select Sub Type</option>';
                    Object.values(data).forEach(val => {
                        console.log(val);
                        op+='<option value="'+val['Sub_Type_Id']+'">'+val['Sub_Type_Name']+'</option>';
                    });
                    FormTag.find('#SubTypeProperty').html("");
                    FormTag.find('#SubTypeName').html("");
                    FormTag.find('#SubTypeName').append(op);
                },
                error:function(){
                    console.log('error');
                }
            });
        });
        $(document).on('change','#SubTypeName',function(){

var SupType_id=$(this).val();
console.log(SupType_id);
var FormTag= $(this).parent().parent().parent(); //first div, second div , form
var op=" ";
$.ajax({
    type:'get',
    url:"{{ url('/findProperty')}}",
    data:{'id':SupType_id},
    success:function(data){
        console.log('success');

        op+='<option value="0" selected disabled>Select Property Name</option>';
        Object.values(data).forEach(val => {
            console.log(val);
            op+='<option value="'+val['Property_Id']+'">'+val['Property_Name']+'</option>';
        });

        FormTag.find('#SubTypeProperty').html("");
        FormTag.find('#SubTypeProperty').append(op);
    },
    error:function(){
        console.log('error');
    }
});
});
// 
$(document).on('change','#SubTypeProperty',function(){

var SupTypeProperty_id=$(this).val();
console.log(SupTypeProperty_id);
var FormTag= $(this).parent().parent().parent(); //first div, second div , form
var op=" ";
$.ajax({
    type:'get',
    url:"{{ url('/findPropertyDetail')}}",
    data:{'id':SupTypeProperty_id},
    success:function(data){
        console.log('success');

        op+='<option value="0" selected disabled>Select Detail</option>';
        Object.values(data).forEach(val => {
            console.log(val);
            op+='<option value="'+val['Property_Detail_Id']+'">'+val['Detail_Name']+'</option>';
        });

        FormTag.find('#PropertyDetail').html("");
        FormTag.find('#PropertyDetail').append(op);
    },
    error:function(){
        console.log('error');
    }
});
});

    });
    $(document).ready(function (){

       
    });


</script>
    <div class="right_col" role="main">
        <div class="title_right">
            <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
                <form method="POST" action="{{ url('/add_Details') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Item -->
                    <div class="form-group row">
                        <label for="Item" class="col-md-2 col-form-label text-md-right">{{ __('Item') }}</label>

                        <div class="col-md-2">
                            <select id="Item" class="form-control @error('Item') is-invalid @enderror" name="Item" value="{{ old('Item') }}" required autocomplete="Item">
                                <!--  For loop  -->
                                
                                @foreach($item as $item)
                                    <option value="{{$item->Item_Id}}">{{$item->Item_Id}}</option>
                            @endforeach
                            <!-- End loop -->
                            </select>
                            @error('Item')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Main Type -->
                    <div class="form-group row">
                        <label for="Main Type Name" class="col-md-2 col-form-label text-md-right">{{ __('Main Type Name') }}</label>

                        <div class="col-md-2">
                            <select id="MainTypeName" class="form-control @error('Main Type Name') is-invalid @enderror" name="Main_Type_Name" value="{{ old('Main Type Name') }}" required autocomplete="Main Type Name">
                                <!--  For loop  -->
                                <option value="0" selected disabled>Select Main Type</option>
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
                        <label for="Sub Type Name" class="col-md-2 col-form-label text-md-right">{{ __('Sub Type Name') }}</label>

                        <div class="col-md-2">
                            <select id="SubTypeName" class="form-control @error('Sub Type Name') is-invalid @enderror" name="Sub_Type_Name" value="{{ old('Sub Type Name') }}" required autocomplete="Sub Type Name">
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
                        <label for="Sub_Type_Property" class="col-md-2 col-form-label text-md-right">{{ __('Sub Type Property') }}</label>

                        <div class="col-md-2">
                            <select id="SubTypeProperty" class="form-control @error('Sub_Type_Property') is-invalid @enderror" name="Sub_Type_Property" value="{{ old('Sub_Type_Property') }}" required autocomplete="Sub_Type_Property">
                                <!--  For loop  -->
                                <!-- <option value="0" selected disabled>Select Property Name</option> -->
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
                        <label for="PropertyDetail" class="col-md-2 col-form-label text-md-right">{{ __('Property Detail') }}</label>

                        <div class="col-md-2">
                            <select id="PropertyDetail" class="form-control @error('Propety_Detail') is-invalid @enderror" name="Propety_Detail" value="{{ old('Propety_Detail') }}" required autocomplete="Propety_Detail">
                                <!--  For loop  -->
                                <!-- <option value="0" selected disabled>Select Property Name</option> -->
                            <!-- End loop -->
                            </select>
                            @error('Propety_Detail')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="DetailValue" class="col-md-2 col-form-label text-md-right">{{ __('Detail Value') }}</label>

                        <div class="col-md-2">
                            <input id="DetailValue" type="text" class="form-control @error('DetailValue') is-invalid @enderror" name="DetailValue" value="{{ old('DetailValue') }}" required autocomplete="DetailValue" autofocus>

                            @error('DetailValue')
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
                            <a href="{{ url('/Details_show') }}" class="btn btn-primary"> {{ __('Show') }}</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="x_panel">
                <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                    <div class="row">
                    </div>
                    @yield('Details_table')

                    <div class="row">
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection
