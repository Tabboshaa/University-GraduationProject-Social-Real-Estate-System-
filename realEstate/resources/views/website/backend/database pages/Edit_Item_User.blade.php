@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />
<script>
    function searchForEmail() {

        var email = $("#Search").val();
        var _token = $("input[name=_token]").val();
        $.ajax({
            type: 'post',
            url: "{{ route('search') }}",
            data: {
                email: email,
                _token: _token
            },
            success: function(data) {
                Object.values(data).forEach(val => {
                    $("#result").html('<tr><td>' + val['email'] + '</td> <td> <input type="checkbox" name="userid" value="' + val['User_ID'] + '" onclick="onlyOne(this)"> </td> </tr>');
                });
            },
            error: function() {
                $("#result").html('There is no User with this Email!!');
            }
        });

    }

    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('userid')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
        $("#userIdHiddenInput").val(checkbox.value);
    }
</script>

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/edit_item_user2/'.$item_id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="item_id" value="{{$item_id}}">


                <div class="item form-group">
                    <a href="javascript:void(0)" id="SearchA" onclick="searchForEmail()" class="btn btn-info" role="button">Search </a>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="search" id="Search" name="Search" required="required" class="form-control">
                        <input type="hidden" id="userIdHiddenInput" name="userIdHiddenInput">
                    </div>
                </div>
                <div class="item form-group">
                    <table id="result" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

                    </table>
                </div>

                <button type="submit" id="EUbtn" class="btn btn-success">Edit</button>
            </form>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection