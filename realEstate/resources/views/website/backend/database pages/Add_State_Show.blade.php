@extends('website.backend.database pages.Add_State')
@section('table')

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All States</h2>

    <div class="clearfix"></div>
</div>

<form method="Post" action="{{ url('/delete_State?_method=delete') }}" enctype="multipart/form-data">
@csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
<table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

    <thead>
        <tr>
        <th><h2 style="margin-right:155px; padding-bottom: 5px;">Country Name</h2></th>
                        <th ><h2 style="margin-right:155px;padding-bottom: 5px;">State Name</h2></th>
                        <th ><h2 style="margin-right:200px;padding-bottom: 5px;">Edit</h2></th>
                  <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn"onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="margin-right:160px;"></i></th>
                   
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
        @if( count($state1) != 0)
        @foreach($state1 as $state)
        <tr>
            <td> {{$state->Country_Name}}</td>
            <td>{{$state->State_Name}}</td>
            <td><a href="javascript:void(0)" onclick="setStateIdName('{{$state->State_Id}}','{{$state->State_Name}}')"><i class="fa fa-edit"></i></a></td>
            <td><input type="checkbox" name="id[]" value="{{$state->State_Id}}"></td>

            <!-- On clicking edit icon will go to setCountryIdName in-->

        </tr>
        @endforeach
        @else
        <tr><td colspan="4"><h4 style="color:gray;">There is no data.</h4></td></tr>
        @endif
    </tbody>
</table>
    {!! $state1->render() !!}
</form>

<div class="modal fade" id="EditStateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit State Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditStateForm">

                    @csrf
                 <input type="hidden" name="id" id="id">


                    <div class="form-group">
                        <label for="State_Name" style="font-size: 12pt">State </label>
                        <input type="text"  style="border-radius: 3pt"  name="State_Name" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" id="StateName" class="form-control" required>
                    </div>

                    <button  type="submit" id="btun3" class="btn btn-success">Edit</button>
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
            td = tr[i].getElementsByTagName("td")[1];
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
        function setStateIdName(id,name){

                // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty
                $("#id").val(id);
                $("#StateName").val(name);
                $("#EditStateModal").modal("toggle");
        }

    // awl ma bados submit button in EditCountryForm will go to  $('#EditCountryForm').submit(function (){}) and start sending the new name to country controller and save it .
        $('#EditStateForm').submit(function (){

            var id=$("#id").val();
            //byb3t el value el gdeda
            var StateName=$("#StateName").val();
            var _token= $("input[name=_token]").val();

            $.ajax({
                url:"{{route('State.edit')}}",
                Type:"PUT",
                data:{
                    id:id,
                    StateName:StateName,
                     _token:_token
                },
                success:function (){
                    console.log('Success');
                       // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                        $("#EditStateModal").modal("toggle");
                    // $("#EditSubTypeModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });



        })
    </script>

@endsection
