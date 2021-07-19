@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />
<script>


        function changesearch() {

var name = $("#Item").val();
var _token = $("input[name=_token]").val();
$.ajax({
    type: 'post',
    url: "{{ route('itemnamesearch') }}",
    data: {
        name: name,
        _token: _token
    },
    success: function(data) {
        var result="";
        console.log(data);
        console.log(name);
        Object.values(data).forEach(val => {
            console.log(val['Item_Name']);

            result+='<tr><td><a href="/ShowItem/'+val['Item_Id']+'"> Item name: '+val['Item_Name']+'</a> </td></tr>';
        });
        if(result=="")
        {
            $("#result").html("<tr class='table-danger'><td> Sorry, There is no items with this name !</td></tr>");
        }else
            $("#result").html(result);
        console.log(data);
    },
    error: function() {
        $("#result").html('There is no Items!!');
    }
});

}
</script>

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <!-- Item -->
            <form method="Get" action="{{url('/ShowItem')}}" enctype="multipart/form-data">
             @csrf

            <div class="form-group row">
                <label for="Item" class="col-md-2 col-form-label text-md-right">
                    {{ __('Search for Item Name:') }}
                </label>
                <div class="col-md-2">
                    <input type="search" id="Item" list="items" class="form-control @error('Item') is-invalid @enderror" name="Item" value="{{ old('Item') }}" required autocomplete="Item" onchange="changesearch()">
                    <!--  For loop  -->
                    <div id="next_button" ></div>
                 <datalist id="items">
                        @foreach($item as $item)
                        <option value="{{$item->Id}}" name="items_options">{{$item->Item_Name}}</option>
                        @endforeach
                    </datalist>
                    <!-- End loop -->
                    </select>
                    @error('Item')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-2 offset-md-2">
                    <!-- <a href="javascript:void(0)" class="btn btn-primary" onclick="searchForItems()">
                        {{ __('Search') }}
                    </a> -->
            
                    <button  class="btn btn-primary" type="submit" disabled id="submitbtn">
                        {{ __('Search for Item') }}
                    </button>
                </div>
            </div>
            </form>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row" id="items_table">
                    <table id="result" class="table table-striped table-bordered dataTable no-footer">
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

@endsection