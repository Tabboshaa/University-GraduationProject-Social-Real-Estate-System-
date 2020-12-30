@extends('website.backend.database pages.Data_Type')
@section('table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Data Types</h2>

    <div class="clearfix"></div>
</div>

<form method="Post" action="{{ url('/delete_data_types?_method=delete') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
<table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
           
        <th><h2 style="margin-right:200px; padding-bottom: 5px;">Data Type Name</h2></th>
                        <th ><h2 style="margin-right:250px;padding-bottom: 5px;">Edit</h2></th>
                  <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn"><i class="fa fa-trash" style="margin-right:200px;"></i></th>
                     
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
        @foreach($data_typess as $data_types)
     
        <tr>
            <td>{{$data_types->datatype}}</td>
            
                         <input type="hidden" name="_method" value="DELETE">
                        <td><a href="javascript:void(0)" onclick="setDataTypeIdName('{{$data_types->id}}','{{$data_types->datatype}}')"><i class="fa fa-edit"> Edit</i></a></td>
                        <td><input type="checkbox" name="id[]" value="{{$data_types->id}}"></td>
                    </tr>
                @endforeach
                <!-- END OF FOREACH -->
            </tbody>
        </table>
        {!! $data_typess->render() !!}
        </form>
<!-- Modal -->
<div class="modal fade" id="EditDataTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditDataTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="DataTypeName" style="font-size: 12pt">Data Type</label>
                        <input type="text" style="border-radius: 3pt" name="DataTypeName" id="DataTypeName" class="form-control">
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
        function setDataTypeIdName(id,name){

                $("#id").val(id);
                $("#DataTypeName").val(name);
                $("#EditDataTypeModal").modal("toggle");
        }
        $('#EditDataTypeForm').submit(function (){

            var id=$("#id").val();
            var DataTypeName=$("#DataTypeName").val();
            var _token= $("input[name=_token]").val();
            
            $.ajax({
                url:"{{route('usertype.update')}}",
                Type:"PUT",
                data:{
                    id:id,
                    DataTypeName:DataTypeName,
                     _token:_token
                },
                success:function (){
                    console.log('Success');
                    $("#EditDataTypeModal").modal("toggle");
                    // $("#EditDataTypeModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });
        })
    </script>
@endsection
