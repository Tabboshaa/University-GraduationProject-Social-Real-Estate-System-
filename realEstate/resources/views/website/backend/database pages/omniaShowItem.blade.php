@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

<table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            <th>User</th>
            <td>{{$user->First_Name}} {{$user->Middle_Name}} {{$user->Last_Name}} <br> {{$email->email}} <br> {{$phone_number->phone_number}}</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Location</th>
            <td>{{$Location->Country_Name}},{{$Location->State_Name}},{{$Location->City_Name}},{{$Location->Region_Name}},{{$Location->Street_Name}}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center">Details</td>
        </tr>
        <tr>
            <form method="Post" action="{{ url('/delete_detail_item?_method=delete') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

                    @foreach ($details as $property => $detail)
                    <tr>
                        <td>
                            <h4>{{$property}}</h4>
                        </td>
                        <th></th>
                        <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> </a> <input type="submit" value="Delete Selected" class="btn btn-secondary"></th>
                        <th></th>
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

                    @foreach($detail as $detailValue)
                    <tr>
                        <td>
                            <h6>{{$detailValue->Detail_Name}}</h6>
                        </td>
                        <td>
                            <h6>{{$detailValue->DetailValue}}</h6>
                        </td>
                        <td><input type="checkbox" name="id[]" value="{{$detailValue->Detail_Id}}"></td>
                        <td><a href="javascript:void(0)" onclick="setDetailIdName('{{$detailValue->Detail_Id}}','{{$detailValue->DetailValue}}')"><i class="fa fa-edit"> Edit</i></a></td>

                    </tr>

                    @endforeach


                    @endforeach
                </table>
        </tr>
    </tbody>
</table>

</form>

@if(!empty($subtypeid))
<a href="{{url('/property_select/'.$item_id.'/'.$subtypeid.'')}}" class="btn btn-info"> Add More Details</a>
@else 
<a href="{{url('/addItemSteps/'.$item_id)}}" class="btn btn-info"> Add Details of item</a>

@endif
<a href="{{url('/Details')}}" class="btn btn-info">Search for an Item</a>
<a href="{{url('/Item')}}" class="btn btn-info"> Create Another Item</a>
<form method="Post" action="{{ url('/DelteItem/'.$item_id.'?_method=delete') }}" enctype="multipart/form-data">
                @csrf
<button type="submit" class="btn btn-danger"> Delete Item</button>
</form>
<div class="modal fade" id="EditDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditDetailForm">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="DetailName">Detail Value</label>
                        <input type="text" name="DetailName" id="DetailName" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setDetailIdName(id, name) {

        $("#id").val(id);
        $("#DetailName").val(name);
        $("#EditDetailModal").modal("toggle");
    }

    $('#EditDetailForm').submit(function() {

        var id = $("#id").val();
        // var MainTypeid=$("#MainTypeNameEdit").val();
        var DetailName = $("#DetailName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('Detail.update')}}",
            Type: "PUT",
            data: {
                id: id,
                // MainTypeid:MainTypeid,
                DetailName: DetailName,
                _token: _token
            },
            success: function() {
                console.log('Success');
                $("#EditDetailModal").modal("toggle");
                // $("#EditDetailModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
    })
</script>
@endsection