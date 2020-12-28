@extends('website.backend.database pages.Add_Street')
@section('table')
    <link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />
<form method="Post" action="{{ url('/delete_Street?_method=delete')}}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
                <th>Country Name</th>
                <th>State Name</th>
                <th>City Name</th>
                <th>Region Name</th>
                <th>Street Name</th>
                <th>Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" style="margin-left: 450px;"><i class="fa fa-trash"></i></th>
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
            @foreach($street1 as $street)
            <tr>
            <td>{{$street->Country_Name}}</td>
            <td>{{$street->State_Name}}</td>
            <td>{{$street->City_Name}}</td>
            <td>{{$street->Region_Name}}</td>
            <td>{{$street->Street_Name}}</td>
                <td><input type="checkbox" name="id[]" value="{{$street->Street_Id}}"></td>
                <td><a href="javascript:void(0)" onclick="setStreetIdName('{{$street->Street_Id}}','{{$street->Street_Name}}')"><i class="fa fa-edit"></i></a></td>
            </tr>
            @endforeach
            <!-- END OF FOREACH -->
        </tbody>
    </table>
    {!! $street1->render() !!}
</form>

<div class="modal fade" id="EditStreetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit State Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditStreetForm">

                    @csrf
                    <input type="hidden" name="id" id="id">


                    <div class="form-group">
                        <label for="Street_Name">State Name</label>
                        <input type="text" name="Street_Name" id="StreetName" class="form-control">
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
            td = tr[i].getElementsByTagName("td")[4];
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
    function setStreetIdName(id, name) {

        // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty
        $("#id").val(id);
        $("#StreetName").val(name);
        $("#EditStreetModal").modal("toggle");
    }

    // awl ma bados submit button in EditCountryForm will go to  $('#EditCountryForm').submit(function (){}) and start sending the new name to country controller and save it .
    $('#EditStreetForm').submit(function() {

        var id = $("#id").val();
        //byb3t el value el gdeda
        var StreetName = $("#StreetName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('Street.edit')}}",
            Type: "PUT",
            data: {
                id: id,
                StreetName: StreetName,
                _token: _token
            },
            success: function() {
                console.log('Success');
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                $("#EditStreetModal").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });



    })
</script>


@endsection
