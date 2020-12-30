@extends('website.backend.database pages.Property_Details')
@section('Property_Details_table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-sm-12">
        <form method="Post" action="{{ url('/delete_property_detail?_method=delete') }}" enctype="multipart/form-data">
            @csrf
            
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                    <tr>
                    <tr>
                        <th><h2 style="margin-right:10px; padding-bottom: 5px;">Main Type ID</h2></th>
                        <th ><h2 style="margin-right:10px;padding-bottom: 5px;">Sub Type Name</h2></th>
                        <th ><h2 style="margin-right:10px;padding-bottom: 5px;">Sub Type Property</h2></th>
                        
                        <th> <h2 style="margin-right:10px;padding-bottom: 5px;">Property Detail Name</th>
                        <th> <h2 style="margin-right:10px;padding-bottom: 5px;">Data Type</th>
                        <th ><h2 style="margin-right:10px;padding-bottom: 5px;">Edit</h2></th>
                        <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn"><i class="fa fa-trash" style="margin-right:10px;"></i></th>
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
                    @foreach($property as $property_detail)
                    <tr>
                        <td>{{$property_detail->Main_Type_Name}}</td>
                        <td>{{$property_detail->Sub_Type_Name}}</td>
                        <td>{{$property_detail->Property_Name}}</td>
                        <td>{{$property_detail->Detail_Name}}</td>
                        <td>{{$property_detail->datatype}}</td>
                        
                        <td><a href="javascript:void(0)" onclick="setPropertyDetailIdName('{{$property_detail->Property_Detail_Id}}','{{$property_detail->Detail_Name}}')"><i class="fa fa-edit"> Edit</i></a></td>
                        <td><input type="checkbox" name="id[]" value="{{$property_detail->Property_Detail_Id}}"></td>
                    </tr>
                    @endforeach
                    <!-- END OF FOREACH -->
                </tbody>
            </table>
            {!! $property->render() !!}
        </form>
    </div>
</div>
<div class="modal fade" id="EditPropertyDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="PropertyDetailName">Detail Name</label>
                        <input type="text" name="PropertyDetailName" id="PropertyDetailName" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Edit</button>
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
            td = tr[i].getElementsByTagName("td")[3];
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
    function setPropertyDetailIdName(id, name) {

        $("#id").val(id);
        $("#PropertyDetailName").val(name);
        $("#EditPropertyDetailModal").modal("toggle");
    }
    $('#EditSubTypeForm').submit(function() {

        var id = $("#id").val();
        // var MainTypeid=$("#MainTypeNameEdit").val();
        var PropertyDetailName = $("#PropertyDetailName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('propertyDetail.update')}}",
            Type: "PUT",
            data: {
                id: id,
                // MainTypeid:MainTypeid,
                PropertyDetailName: PropertyDetailName,
                _token: _token
            },
            success: function() {
                console.log('Success');
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.PropertyDetailName);
                $("#EditPropertyDetailModal").modal("toggle");
                // $("#EditPropertyDetailModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
    })
</script>

@endsection