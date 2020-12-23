@extends('website.backend.database pages.Add_Country')
@section('table')
<form method="Post" action="{{ url('/delete_Country?_method=delete') }}" enctype="multipart/form-data">
    @csrf
<table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
        <tr>
                        <th><h2 style="margin-right:200px; padding-bottom: 5px;">Country Name</h2></th>
                        <th ><h2 style="margin-right:250px;padding-bottom: 5px;">Edit</h2></th>
                  <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn"><i class="fa fa-trash" style="margin-right:200px;"></i></th>
                      
          
            <script>
                //will select all row with id -> id[]
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
        @foreach($C1 as $C1)
            <tr>
                <td> {{$C1->Country_Name}}</td>
                

                <!-- On clicking edit icon will go to setCountryIdName in-->
                <td><a href="javascript:void(0)" onclick="setCountryIdName('{{$C1->Country_Id}}','{{$C1->Country_Name}}')"><i class="fa fa-edit"></i></a></td>
            
            <td><input type="checkbox" name="id[]" value="{{$C1->Country_Id}}"></td></tr>
            @endforeach
    </tbody>
</table>
</form>

<!-- form of editing country -->
<div class="modal fade" id="EditCountryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Country Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditCountryForm">

                    @csrf
                    <input type="hidden" name="id" id="id">


                    <div class="form-group">
                        <label for="CountryName">Country Name</label>
                        <input type="text" name="Country_Name" id="Country_Name" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setCountryIdName(id, name) {

        // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty 
        $("#id").val(id);
        $("#Country_Name").val(name);
        $("#EditCountryModal").modal("toggle");
    }

    // awl ma bados submit button in EditCountryForm will go to  $('#EditCountryForm').submit(function (){}) and start sending the new name to country controller and save it .
    $('#EditCountryForm').submit(function() {

        var id = $("#id").val();
        //byb3t el value el gdeda
        var CountryName = $("#Country_Name").val();
        var _token = $("input[name=_token]").val();
        

        $.ajax({
            url: "{{route('Country.edit')}}",
            Type: "PUT",
            data: {
                id: id,
                CountryName: CountryName,
                _token: _token
               
            },
            
            success: function(response) {
               
                console.log('Shaimaa Es7a m3aia mtnamshe')
                console.log(response);
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                $("#EditCountryModal").modal("toggle");
                alert("updated Succesfully");
                // $("#EditSubTypeModal")[0].reset();
                
            },
            error: function() {
                console.log('Error 7azen');
            }
           
        });



    })
</script>
@endsection