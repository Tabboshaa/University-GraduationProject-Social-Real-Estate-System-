@extends('website.backend.database pages.Sub_Type')
@section('table')

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Sub types</h2>

    <div class="clearfix"></div>
</div>
        <form method="Post" action="{{ url('/delete_sub_type?_method=delete') }}" enctype="multipart/form-data">
            @csrf
            <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                    <tr>
                        <th>Main Type ID</th>
                        <th>Sub Type Name</th>
                        <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <input type="submit" value="Delete Selected" class="btn btn-secondary"> </th>
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
                    @foreach($sub_type as $sub_type)


                    <tr>
                        <td>{{$sub_type->Main_Type_Name}}</td>
                        <td>{{$sub_type->Sub_Type_Name}}</td>
                        <td><input type="checkbox" name="id[]" value="{{$sub_type->Sub_Type_Id}}"></td>

                        <td><a href="javascript:void(0)" onclick="setSupTypeIdName('{{$sub_type->Sub_Type_Id}}','{{$sub_type->Sub_Type_Name}}')"><i class="fa fa-edit"></i></a></td>
                    </tr>

                    @endforeach

        <!-- END OF FOREACH -->

        </tbody>
        </table>
        </form>
 
<!-- Modal -->
<div class="modal fade" id="EditSubTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div>
                        <label for="MainTypeNameEdit" style="font-size: 12pt" >Main Type</label>
                        <select id="MainTypeNameEdit" style="border-radius: 3pt" class="form-control" name="MainTypeNameEdit">
                            <!--  For loop  -->
                            @foreach($main_type as $main)
                            <option value="{{$main->Main_Type_Id}}">{{$main->Main_Type_Name}}</option>
                            @endforeach
                            <!-- End loop -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="SubTypeName" style="font-size: 12pt" >Sub Type</label>
                        <input type="text" style="border-radius: 3pt" name="SubTypeName" id="SubTypeName" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setSupTypeIdName(id, name) {

        $("#id").val(id);
        $("#SubTypeName").val(name);
        $("#EditSubTypeModal").modal("toggle");
    }
    $('#EditSubTypeForm').submit(function() {

        var id = $("#id").val();
        var MainTypeid = $("#MainTypeNameEdit").val();
        var SupTypeName = $("#SubTypeName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('suptype.update')}}",
            Type: "PUT",
            data: {
                id: id,
                MainTypeid: MainTypeid,
                SupTypeName: SupTypeName,
                _token: _token
            },
            success: function(response) {
                console.log('Success');
                $("#EditSubTypeModal").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
    })
</script>
@endsection