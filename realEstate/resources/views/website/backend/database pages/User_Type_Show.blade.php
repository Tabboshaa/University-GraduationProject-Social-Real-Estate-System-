@extends('website.backend.database pages.User_Type')
@section('table')

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All User Types</h2>

    <div class="clearfix"></div>
</div>

<form method="Post" action="{{ url('/delete_user_type?_method=delete') }}" enctype="multipart/form-data">
    @csrf
    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
                <th>User Type ID</th>
                <th>User Type Name</th>
                <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <input type="submit" value="Delete Selected" class="btn btn-secondary"></th>
                <th>Edit</th>
                <!-- Java Script for select all function -->
                <script>
                    document.getElementById('selectAll').onclick = function() {
                        var checkboxes = document.getElementsByName('id[]'); //get all check boxes with name delete
                        for (var checkbox of checkboxes) { //for loop to set all checkboxes to checked
                            checkbox.checked = this.checked;
                        }
                    }
                </script>
            </tr>
        </thead>
        <tbody>
            <!-- EL FOREARCH HNA -->
            @foreach($user_type as $user_type)
            <tr>
                <td>{{$user_type->User_Type_ID}}</td>
                <td>{{$user_type->Type_Name}}</td>
                <td><input type="checkbox" name="id[]" value="{{$user_type->User_Type_ID}}"></td>
                <td><a href="javascript:void(0)" onclick="setUserTypeIdName('{{$user_type->User_Type_ID}}','{{$user_type->Type_Name}}')"><i class="fa fa-edit"></i></a></td>
            </tr>
            @endforeach
            <!-- END OF FOREACH -->
        </tbody>
    </table>
</form>
<!-- Modal -->
<div class="modal fade" id="EditUserTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditUserTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="UserTypeName"  style="font-size: 12pt">User Type</label>
                        <input type="text" style="border-radius: 3pt" name="UserTypeName" id="UserTypeName" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setUserTypeIdName(id, name) {

        $("#id").val(id);
        $("#UserTypeName").val(name);
        $("#EditUserTypeModal").modal("toggle");
    }
    $('#EditUserTypeForm').submit(function() {

        var id = $("#id").val();
        var UserTypeName = $("#UserTypeName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('usertype.edite')}}",
            Type: "PUT",
            data: {
                id: id,
                UserTypeName: UserTypeName,
                _token: _token
            },
            success: function() {
                console.log('Success');
                $("#EditUserTypeModal").modal("toggle");
                // $("#EditUserTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
    })
</script>
@endsection