@extends('website.backend.database pages.Add_Region')
@section('table')
<form method="Post" action="{{ url('/delete_Region?_method=delete')}}" enctype="multipart/form-data">
    @csrf
    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
                <th>Country Name</th>
                <th>State Name</th>
                <th>City Name</th>
                <th>Region Name</th>
                <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <button class="btn" style="margin-left: 550px;"><i class="fa fa-trash"></i></th>
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
            @foreach($region as $region)
            <tr>
            <td>{{$region->Country_Name}}</td>
            <td>{{$region->State_Name}}</td>
            <td>{{$region->City_Name}}</td>
            <td>{{$region->Region_Name}}</td>
                <td><input type="checkbox" name="id[]" value="{{$region->Region_Id}}"></td>
                <td><a href="javascript:void(0)" onclick="setRegionIdName('{{$region->Region_Id}}','{{$region->Region_Name}}')"><i class="fa fa-edit"></i></a></td>
            </tr>
            @endforeach
            <!-- END OF FOREACH -->
        </tbody>
    </table>
</form>

<div class="modal fade" id="EditRegionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit State Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditRegionForm">

                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="Region_Name">State Name</label>
                        <input type="text" name="Region_Name" id="RegionName" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setRegionIdName(id, name) {

        // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty 
        $("#id").val(id);
        $("#RegionName").val(name);
        $("#EditRegionModal").modal("toggle");
    }

    // awl ma bados submit button in EditCountryForm will go to  $('#EditCountryForm').submit(function (){}) and start sending the new name to country controller and save it .
    $('#EditRegionForm').submit(function() {

        var id = $("#id").val();
        //byb3t el value el gdeda
        var RegionName = $("#RegionName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('Region.edit')}}",
            Type: "PUT",
            data: {
                id: id,
                RegionName: RegionName,
                _token: _token
            },
            success: function(response) {
                console.log('Shaimaa Es7a m3aia mtnamshe')
                console.log(response);
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                $("#EditRegionModal").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error 7azen');
            }

        });



    })
</script>

@endsection