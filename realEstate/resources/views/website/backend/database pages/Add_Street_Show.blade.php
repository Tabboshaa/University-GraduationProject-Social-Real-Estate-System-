@extends('website.backend.database pages.Add_Street')
@section('table')

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Streets</h2>

    <div class="clearfix"></div>
</div>

<form method="Post" action="{{ url('/delete_Street?_method=delete')}}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
    <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
            
                        <th ><h2 style="margin-right:30px;padding-bottom: 5px;">Country Name</h2></th>
                        <th ><h2 style="margin-right:30px;padding-bottom: 5px;">State Name</h2></th>
                        
                        <th> <h2 style="margin-right:30px;padding-bottom: 5px;">City Name</th>
                        <th> <h2 style="margin-right:30px;padding-bottom: 5px;">Region Name </th>
                        <th><h2 style="margin-right:30px; padding-bottom: 5px;">Street Name</h2></th>
                        <th ><h2 style="margin-right:30px;padding-bottom: 5px;">Edit</h2></th>
                        <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" style="margin-right:30px;"></i></th>
                       
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
            @if( count($street1) != 0)
            @foreach($street1 as $street)
            <tr>
            <td>{{$street->Country_Name}}</td>
            <td>{{$street->State_Name}}</td>
            <td>{{$street->City_Name}}</td>
            <td>{{$street->Region_Name}}</td>
            <td>{{$street->Street_Name}}</td>
                
                <td><a href="javascript:void(0)" onclick="setStreetIdName('{{$street->Street_Id}}','{{$street->Street_Name}}')"><i class="fa fa-edit"></i></a></td>
                <td><input type="checkbox" name="id[]" value="{{$street->Street_Id}}"></td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="7"><h4 style="color:gray;">There is no data.</h4></td></tr>
            @endif
            <!-- END OF FOREACH -->
        </tbody>
    </table>
    {!! $street1->render() !!}
</form>

<div class="modal fade" id="EditStreetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Street Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditStreetForm">

                    @csrf
                    <input type="hidden" name="id" id="id">


                    <div class="form-group">
                        <label for="Street_Name" style="font-size: 12pt">Street</label>
                        <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" name="Street_Name" id="StreetName" class="form-control" required       >
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
