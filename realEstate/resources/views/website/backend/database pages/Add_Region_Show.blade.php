@extends('website.backend.database pages.Add_Region')
@section('table')

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<div class="x_title">
    <h2>All Regions</h2>

    <div class="clearfix"></div>
</div>

<form method="Post" action="{{ url('/delete_Region?_method=delete')}}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
    <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
            <th><h2 style="margin-right:50px; padding-bottom: 5px;">Country Name</h2></th>
                        <th ><h2 style="margin-right:50px;padding-bottom: 5px;">State Name</h2></th>
                        <th ><h2 style="margin-right:50px;padding-bottom: 5px;">City Name</h2></th>
                        
                        <th> <h2 style="margin-right:50px;padding-bottom: 5px;">Region Name</th>

                        <th ><h2 style="margin-right:60px;padding-bottom: 5px;">Edit</h2></th>
                        <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="margin-right:50px;"></i></th>
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
            @if( count($region1) != 0)
            @foreach($region1 as $region)
            <tr>
            <td>{{$region->Country_Name}}</td>
            <td>{{$region->State_Name}}</td>
            <td>{{$region->City_Name}}</td>
            <td>{{$region->Region_Name}}</td>
               
                <td><a href="javascript:void(0)" onclick="setRegionIdName('{{$region->Region_Id}}','{{$region->Region_Name}}')"><i class="fa fa-edit"></i></a></td>
                <td><input type="checkbox" name="id[]" value="{{$region->Region_Id}}"></td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="6"><h4 style="color:gray;">There is no data.</h4></td></tr>
            @endif
            <!-- END OF FOREACH -->
        </tbody>
    </table>
    {!! $region1->render() !!}
</form>

<div class="modal fade" id="EditRegionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Region Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditRegionForm">

                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="Region_Name" style="font-size: 12pt">Region :</label>
                        <input type="text" style="border-radius: 3pt" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" name="Region_Name" id="RegionName" class="form-control" required>
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
            success: function() {
                console.log('Success');
                // $('#sid'+response.id + 'td:nth-child(1)').text(response.SupTypeName);
                $("#EditRegionModal").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });



    })
</script>

@endsection
