@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />
<script>
    function searchForItems() {

        var item_id = $("#Item").val();
        var flag=false;
        $("#submitbtn").prop("disabled", true);
        $("#next_button").html('');

        $('option[name="items_options"]').each(function() {
            if (item_id == this.value) {
                flag=true;
                $("#next_button").html('Item Found');
                $("#submitbtn").removeAttr("disabled");
                    return true;
            }
        });
        if(!flag)
        $("#next_button").html('Item not Found');
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
                    {{ __('Item') }}
                </label>

                <div class="col-md-2">
                    <input type="search" id="Item" list="items" class="form-control @error('Item') is-invalid @enderror" name="Item" value="{{ old('Item') }}" required autocomplete="Item">
                    <!--  For loop  -->
                 <datalist id="items">
                        @foreach($item as $item)
                        <option value="{{$item->Item_Id}}" name="items_options">{{$item->Item_Id}}</option>
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
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="searchForItems()">
                        {{ __('Search') }}
                    </a>
                    <div id="next_button" >
                    
                    </div>

                    <button  class="btn btn-primary" type="submit" disabled id="submitbtn">
                        {{ __('See Item') }}
                    </button>
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