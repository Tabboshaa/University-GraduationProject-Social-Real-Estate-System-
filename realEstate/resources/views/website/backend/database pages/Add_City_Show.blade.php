@extends('website.backend.database pages.Add_City')
@section('table')
    <link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />
<form method="Post" action="{{ url('/delete_City?_method=delete') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
            <th><h2 style="margin-right:90px; padding-bottom: 5px;">Country Name</h2></th>
                        <th ><h2 style="margin-right:90px;padding-bottom: 5px;">State Name</h2></th>
                        <th ><h2 style="margin-right:90px;padding-bottom: 5px;">City Name</h2></th>
                        <th ><h2 style="margin-right:90px;padding-bottom: 5px;">Edit</h2></th>
                  <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn"><i class="fa fa-trash" style="margin-right:90px;"></i></th>
                        

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
            @foreach($cityy as $city)
            <tr>
                <td> {{$city->Country_Name}}</td>
                <td> {{$city->State_Name}}</td>
                <td> {{$city->City_Name}}</td>
               
                <td><a href="javascript:void(0)" onclick="setCityIdName('{{$city->City_Id}}','{{$city->City_Name}}')"><i class="fa fa-edit"></i></a></td>
                <td><input type="checkbox" name="id[]" value="{{$city->City_Id}}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
   {!! $cityy->render() !!}
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
            success: function() {
                console.log('Success')
                $("#EditCityModal").modal("toggle");
            },
            error: function() {
                console.log('Error');
            }

        });



    })
</script>

@endsection
