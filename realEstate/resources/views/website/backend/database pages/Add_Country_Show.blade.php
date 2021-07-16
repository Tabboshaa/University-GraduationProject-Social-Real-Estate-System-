@extends('website.backend.database pages.Add_Country')
@section('table')

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Countries</h2>

    <div class="clearfix"></div>
</div>

<form method="Post" action="{{ url('/delete_Country?_method=delete') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
<table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            <th style="margin-right:50px; padding-bottom: 5px;"><h2>Country Name</h2></th>
            <th ><h2 style="margin-right:60px;padding-bottom: 5px;">Edit</h2></th>
            <th>Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" style="margin-right:50px;" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></button></th>
            
            <script>
                //will select all row with id -> id[]
                document.getElementById('selectAll').onclick = function() {
                    var checkboxes = document.getElementsByName('id[]'); //get all check boxes with name delete
                    for (var checkbox of checkboxes) { //for loop to set all checkboxe 24 1 decs to checked
                        checkbox.checked = this.checked;
                    }
                }
            </script>
        </tr>
    </thead>
    <tbody>
        @foreach($C11 as $C1)
            <tr>
                <td> {{$C1->Country_Name}}</td>
                <td><a href="javascript:void(0)" onclick="setCountryIdName('{{$C1->Country_Id}}','{{$C1->Country_Name}}')" ><i id="edit" class="fa fa-edit"></i></a></td>
                <td><input type="checkbox" name="id[]" value="{{$C1->Country_Id}}"></td>

                <!-- On clicking edit icon will go to setCountryIdName in-->
            </tr>
            @endforeach
    </tbody>
</table>
    {!! $C11->render() !!}
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
                        <label for="CountryName" style="font-size: 12pt">Country</label>
                        <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" name="Country_Name" id="Country_Name" class="form-control"required>
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
            td = tr[i].getElementsByTagName("td")[0];
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
            success: function() {
                console.log('Success');
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                $("#EditCountryModal").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });



    })
</script>
@endsection
