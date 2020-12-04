@extends('website.backend.database pages.User_Type')
@section('table')
<table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            <th>User Type ID</th>
            <th>User Type Name</th>
            <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <a href="#/trash">  </a></th>
            <th></th>
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
        <form method="Post" action="{{ url('/delete_user_type/'.$user_type->User_Type_ID) }}" enctype="multipart/form-data">
                        @csrf
        <tr>
            <td>{{$user_type->User_Type_ID}}</td>
            <td>{{$user_type->Type_Name}}</td>
            <td><input type="checkbox" name="id[]" value="{{$user_type->User_Type_ID}}"></td>
                         <input type="hidden" name="_method" value="DELETE">
                        <td><a href="javascript:void(0)" onclick="setUserTypeIdName('{{$user_type->User_Type_ID}}','{{$user_type->Type_Name}}')"><i class="fa fa-edit"> Edit</i></a></td>

                    </tr>
                @endforeach
                <!-- END OF FOREACH -->
                <td><input type="submit" value="Delete Selected"></td>
                </form>
    </tbody>
</table>
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
                        <label for="UserTypeName" >User Type Name</label>
                        <input type="text" name="UserTypeName" id="UserTypeName" class="form-control">
                    </div>
                    <button  type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

    <script>
        function setUserTypeIdName(id,name){

                $("#id").val(id);
                $("#UserTypeName").val(name);
                $("#EditUserTypeModal").modal("toggle");
        }
        $('#EditUserTypeForm').submit(function (){

            var id=$("#id").val();
            var UserTypeName=$("#UserTypeName").val();
            var _token= $("input[name=_token]").val();
            
            $.ajax({
                url:"{{route('usertype.update')}}",
                Type:"PUT",
                data:{
                    id:id,
                    UserTypeName:UserTypeName,
                     _token:_token
                },
                success:function (response){
                    console.log('Success')
                    console.log(response);
                    $('#sid'+response.id + 'td:nth-child(1)').text(response.UserTypeName);
                    $("#EditUserTypeModal").modal("toggle");
                    // $("#EditUserTypeModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });
        })
    </script>
@endsection
