@extends('website.backend.database pages.Add_City')
@section('table')
<form method="Post" action="{{ url('/delete_City?_method=delete') }}" enctype="multipart/form-data">
    @csrf
<table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            <th>City ID</th>
            <th>Country ID</th>
            <th>State ID</th>
            <th>City Name</th>
            <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <input type="submit" value="Delete Selected" class="btn btn-secondary"></th>
            <th>Edit</th>

            <script>
                document.getElementById('selectAll').onclick = function() {
                    var checkboxes = document.getElementsByName('id[]'); //get all check boxes with name delete
                    for (var checkbox of checkboxes) { //for loop to set all checkboxes to checked
                        checkbox.checked = this.checked;
                    }
                }
<<<<<<< HEAD
        </script>
    </tr>
</thead>
<tbody>
    @foreach($city as $city)
    <form method="Post" action="{{ url('/delete_City/'.$city->City_Id) }}" enctype="multipart/form-data">
    @csrf
    <tr>
        <td> {{$city->Country_Name}}</td>
        <td> {{$city->State_Name}}</td>
        <td> {{$city->City_Name}}</td>
        <td><input type="checkbox" name="id[]" value="{{$city->City_Id}}"></td>
        <td><a href="javascript:void(0)" onclick="setCityIdName('{{$city->City_Id}}','{{$city->City_Name}}')"><i class="fa fa-edit"></i></a></td>
    </tr>
    @endforeach

    <td><input type="submit" value="Delete Selected"></td>
    </form>
</tbody>
=======
            </script>
        </tr>
    </thead>
    <tbody>
        @foreach($city as $city)
            <tr>
                <td> {{$city->City_Id}} </td>
                <td> {{$city->Country_Id}}</td>
                <td> {{$city->State_Id}}</td>
                <td> {{$city->City_Name}}</td>
                <td><input type="checkbox" name="id[]" value="{{$city->City_Id}}"></td>
                <td><a href="javascript:void(0)" onclick="setCityIdName('{{$city->City_Id}}','{{$city->City_Name}}')"><i class="fa fa-edit"></i></a></td>
            </tr>
            @endforeach
    </tbody>
>>>>>>> 6481ba95387376bb5304f93a95adec7ea8101ec2
</table>
</form>

<div class="modal fade" id="EditCityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit State Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditCityForm">

                    @csrf
                    <input type="hidden" name="id" id="id">


                    <div class="form-group">
                        <label for="City_Name">State Name</label>
                        <input type="text" name="City_Name" id="CityName" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setCityIdName(id, name) {

        // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty 
        $("#id").val(id);
        $("#CityName").val(name);
        $("#EditCityModal").modal("toggle");
    }

    // awl ma bados submit button in EditCountryForm will go to  $('#EditCountryForm').submit(function (){}) and start sending the new name to country controller and save it .
    $('#EditCityForm').submit(function() {

        var id = $("#id").val();
        //byb3t el value el gdeda
        var CityName = $("#CityName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('City.edit')}}",
            Type: "PUT",
            data: {
                id: id,
                CityName: CityName,
                _token: _token
            },
            success: function(response) {
                console.log('Shaimaa Es7a m3aia mtnamshe')
                console.log(response);
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                $("#EditCityModal").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error 7azen');
            }

        });



    })
</script>

@endsection