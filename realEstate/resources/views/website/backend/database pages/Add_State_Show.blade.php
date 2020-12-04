@extends('website.backend.database pages.Add_State')
@section('table')
<table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

    <thead>
        <tr>
            <th>Country ID</th>
            <th>State ID</th>
            <th>State Name</th>
            <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <a href="#/trash"></a></th>
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
        @foreach($state as $state)
        <form method="Post" action="{{ url('/delete_State/'.$state->State_Id) }}" enctype="multipart/form-data">
        @csrf
        <tr>
            <td> {{$state->Country_Name}}</td>
            <td> {{$state->State_Name}}</td>
            <td><input type="checkbox" name="id[]" value="{{$state->State_Id}}"></td>
            
            <!-- On clicking edit icon will go to setCountryIdName in-->
            <td><a href="javascript:void(0)" onclick="setStateIdName('{{$state->State_Id}}','{{$state->State_Name}}')"><i class="fa fa-edit"></i></a></td>
        
        </tr>
        @endforeach
        
        <td><input type="submit" value="Delete Selected"></td>
        </form>
    </tbody>
</table>

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
                        <label for="State_Name" >State Name</label>
                        <input type="text" name="State_Name" id="StateName" class="form-control">
                    </div>

                    <button  type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
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
                success:function (response){
                    console.log('Shaimaa Es7a m3aia mtnamshe')
                    console.log(response);
                       // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                        $("#EditStateModal").modal("toggle");
                    // $("#EditSubTypeModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error 7azen');
                }

            });



        })
    </script>

@endsection