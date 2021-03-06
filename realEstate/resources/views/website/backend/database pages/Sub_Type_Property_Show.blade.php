@extends('website.backend.database pages.Sub_Type_Property')
@section('Property_Details_table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Properties</h2>

    <div class="clearfix"></div>
</div>

    <div class="row">
        <div class="col-sm-12">
            <form method="Post" action="{{ url('/delete_sub_type_property?_method=delete') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
            <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                <tr>
               <tr>
                        <th><h2 style="margin-right:60px; padding-bottom: 5px;">Main Type</h2></th>
                        <th ><h2 style="margin-right:60px;padding-bottom: 5px;">Sub Type Name</h2></th>
                        <th ><h2 style="margin-right:60px;padding-bottom: 5px;">Sub Type Property</h2></th>
                        <th ><h2 style="margin-right:60px;padding-bottom: 5px;">Edit</h2></th>
                    <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="margin-right:60px;"></i></button></th>

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
                @if( count($P1) != 0)
                @foreach($P1 as $property)
                    <tr>
                        <td>{{$property->Main_Type_Name}}</td>
                        <td>{{$property->Sub_Type_Name}}</td>
                        <td>{{$property->Property_Name}}</td>
                        <td><a href="javascript:void(0)" onclick="setSubTypePropertyIdName('{{$property->Property_Id}}','{{$property->Property_Name}}')"><i class="fa fa-edit"> Edit</i></a></td>
                        <td><input type="checkbox" name="id[]" value="{{$property->Property_Id}}"></td>
                 </tr>
                @endforeach
                @else
                <tr><td colspan="5"><h4 style="color:gray;">There is no data.</h4></td></tr>
                @endif
                <!-- END OF FOREACH -->

            </tbody>
        </table>
        {!! $P1->render() !!}
    </form>
        </div>
    </div>
    <div class="modal fade" id="EditSubTypePropertyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Type Property</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditSubTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="SubTypePropertyName" style="font-size: 12pt" >Property</label>
                        <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital"  name="SubTypePropertyName" id="SubTypePropertyName" class="form-control" required>
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
            td = tr[i].getElementsByTagName("td")[2];
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
        function setSubTypePropertyIdName(id,name){

                $("#id").val(id);
                $("#SubTypePropertyName").val(name);
                $("#EditSubTypePropertyModal").modal("toggle");
        }
        $('#EditSubTypeForm').submit(function (){

            var id=$("#id").val();
            // var MainTypeid=$("#MainTypeNameEdit").val();
            var SubTypePropertyName=$("#SubTypePropertyName").val();
            var _token= $("input[name=_token]").val();

            $.ajax({
                url:"{{route('subTypeProperty.update')}}",
                Type:"PUT",
                data:{
                    id:id,
                    // MainTypeid:MainTypeid,
                    SubTypePropertyName:SubTypePropertyName,
                     _token:_token
                },
                success:function (){
                    console.log('Success');
                    $("#EditSubTypePropertyModal").modal("toggle");
                    // $("#EditSubTypePropertyModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });
        })
    </script>
@endsection
