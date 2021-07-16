@extends('website.backend.database pages.operationTypes')
@section('table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<div class="x_title">
    <h2>All Operation types</h2>

    <div class="clearfix"></div>
</div>
<form method="Post" action="{{url('/delete_operation_type?_method=delete')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
<table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
    <tr>
                        <th><h2 style="margin-right:200px; padding-bottom: 5px;">Operation Type ID</h2></th>
                       
                        <th ><h2 style="margin-right:250px;padding-bottom: 5px;">Edit</h2></th>
                  <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="margin-right:200px;"></i></th>
                      
            <!-- Java Script for select all function -->
                <script>
                    document.getElementById('selectAll').onclick = function() {
                        var checkboxes = document.getElementsByName('operationType[]'); //get all check boxes with name delete
                        for (var checkbox of checkboxes) { //for loop to set all checkboxes to checked
                            checkbox.checked = this.checked;
                        }
                    }
                </script>
        </tr>
    </thead>
    <tbody>
        <!-- EL FOREARCH HNA-->
        @foreach($operation_types as $operation_type)

        <tr>
            <td>{{$operation_type->Operation_Name}}</td>
            <td><a href="javascript:void(0)" onclick="setOperationType('{{$operation_type->Operation_Type_Id}}','{{$operation_type->Operation_Name}}')"><i class="fa fa-edit"> </i></a></td>
            <td><input type="checkbox" name="operationType[]" value="{{$operation_type->Operation_Type_Id}}" id="OperationType"></td>
            <!-- <td><a href="javascript:void(0)" onclick="addSubType()" ><i class="fa fa-add"> Add </i></a></td> -->
        </tr>

                @endforeach


                <!-- END OF FOREACH -->
    </tbody>
</table>

</form>

<div class="modal fade" id="EditOpertionTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Operation type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditOperationTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="operationTypeName" style="font-size: 12pt" >Operation Type</label>
                        <input type="text" style="border-radius: 3pt" name="OperationTypeName" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" id="OperationTypeName" class="form-control" required>

                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

    <script>
     function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("datatable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
        function setOperationType(id,name){

                $("#id").val(id);
                $("#OperationTypeName").val(name);
                $("#EditOpertionTypeModal").modal("toggle");
        }
        $('#EditOperationTypeForm').submit(function() {

var id = $("#id").val();
//byb3t el value el gdeda
var OperationTypeName = $("#OperationTypeName").val();
var _token = $("input[name=_token]").val();

$.ajax({
    url: "{{route('operationType.update')}}",
    Type: "PUT",
    data: {
        id: id,
        OperationTypeName: OperationTypeName,
        _token: _token
    },
    success: function() {
        console.log('Success')
        $("#EditOperationTypeModal").modal("toggle");
    },
    error: function() {
        console.log('Error');
    }

});



})
       
    </script>

@endsection
