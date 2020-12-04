@extends('website.backend.database pages.Main_Types')
@section('table')

<form method="Post" action="{{url('/delete_main_type?_method=delete')}}" enctype="multipart/form-data">
                        @csrf
<table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            
            <th>Type Name</th>
            <th>Select all <input type="checkbox" id="selectAll" name="selectAll">  <input type="submit" value="Delete Selected" class="btn btn-secondary"></th>
            <th></th>
            <!-- Java Script for select all function -->
                <script>
                    document.getElementById('selectAll').onclick = function() {
                        var checkboxes = document.getElementsByName('mainType'); //get all check boxes with name delete
                        for (var checkbox of checkboxes) { //for loop to set all checkboxes to checked
                            checkbox.checked = this.checked;
                        }
                    }
                </script>
        </tr>
    </thead>
    <tbody>
        <!-- EL FOREARCH HNA -->


        @foreach($main_type as $main_type)

        <tr>
            <td>{{$main_type->Main_Type_Name}}</td>
            <td><input type="checkbox" name="mainType[]" value="{{$main_type->Main_Type_Id}}"></td>
             
         <td><a href="javascript:void(0)" onclick="setMainTypeIdName('{{$main_type->Main_Type_Id}}','{{$main_type->Main_Type_Name}}')"><i class="fa fa-edit"> Edit</i></a></td>
                </tr>

                @endforeach

                       
                <!-- END OF FOREACH -->
    </tbody>
</table>
</form>

<div class="modal fade" id="EditMainTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditSubTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
          
                    <div class="form-group">
                        <label for="MainTypeName" >Main Type Name</label>
                        <input type="text" name="MainTypeName" id="MainTypeName" class="form-control">
                        
                    </div>
                    <button  type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

    <script>
        function setMainTypeIdName(id,name){

                $("#id").val(id);
                $("#MainTypeName").val(name);
                $("#EditMainTypeModal").modal("toggle");
        }
        $('#EditSubTypeForm').submit(function (){

            var id=$("#id").val();
            var MainTypeName=$("#MainTypeName").val();
            var _token= $("input[name=_token]").val();
            
            $.ajax({
                url:"{{route('Maintype.update')}}",
                Type:"PUT",
                data:{
                    id:id,
                    // MainTypeid:MainTypeid,
                    MainTypeName:MainTypeName,
                     _token:_token
                },
                success:function (response){
                    console.log('Success')
                    console.log(response);
                    // $('#sid'+response.id + 'td:nth-child(1)').text(response.MainTypeName);
                    $("#EditMainTypeModal").modal("toggle");
                    // $("#EditMainTypeModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });
        })
    </script>

@endsection
