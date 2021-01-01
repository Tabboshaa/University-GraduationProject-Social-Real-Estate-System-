@extends('website.backend.database pages.Details')
@section('Details_table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Details and it's values</h2>

    <div class="clearfix"></div>
</div>

<div class="row">
    <div class="col-sm-12">
        <form method="Post" action="{{ url('/delete_detail?_method=delete') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
            <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Property Detail ID</th>
                    <th>Sub Type ID</th>
                    <th>Main Type ID</th>
                    <th>Property ID</th>
                    <th>Detail Value</th>
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
                @foreach($detail as $detail)
                    <tr>
                        <td>{{$detail->Detail_Id}}</td>
                        <td>{{$detail->Property_Detail_Id}}</td>
                        <td>{{$detail->Sub_Type_Id}}</td>
                        <td>{{$detail->Main_Type_Id}}</td>
                        <td>{{$detail->Property_Id}}</td>
                        <td>{{$detail->DetailValue}}</td>
                        <td><input type="checkbox" name="id[]" value="{{$detail->Detail_Id}}"></td>
                        <td><a href="javascript:void(0)" onclick="setDetailIdName('{{$detail->Detail_Id}}','{{$detail->DetailValue}}')"><i class="fa fa-edit"></i></a></td>
                 </tr>
                @endforeach
                <!-- END OF FOREACH -->
            </tbody>
        </table>
    </form>
    </div>
    </div>
    <div class="modal fade" id="EditDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail value</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditDetailForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
          
                    <div class="form-group">
                        <label for="DetailName" style="font-size: 12pt" >Detail Value</label>
                        <input type="text" style="border-radius: 3pt"name="DetailName" id="DetailName" class="form-control">
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
        function setDetailIdName(id,name){

                $("#id").val(id);
                $("#DetailName").val(name);
                $("#EditDetailModal").modal("toggle");
        }
        $('#EditDetailForm').submit(function (){

            var id=$("#id").val();
            // var MainTypeid=$("#MainTypeNameEdit").val();
            var DetailName=$("#DetailName").val();
            var _token= $("input[name=_token]").val();
            
            $.ajax({
                url:"{{route('Detail.update')}}",
                Type:"PUT",
                data:{
                    id:id,
                    // MainTypeid:MainTypeid,
                    DetailName:DetailName,
                     _token:_token
                },
                success:function (){
                    console.log('Success');
                    $("#EditDetailModal").modal("toggle");
                    // $("#EditDetailModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });
        })
    </script>

@endsection
