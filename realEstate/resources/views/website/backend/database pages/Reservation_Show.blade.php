@extends('website.backend.layouts.main')
@section('content')
<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                </div>
                <link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

                <link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

                <div class="x_title">
                    <h2>Operations</h2>

                    <div class="clearfix"></div>
                </div>

                <div class="row">
                    @include('website.backend.layouts.flashmessage')
                    <div class="col-sm-12">
                        @foreach($item->operations as $operations => $reservation)
                        <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                        #{{$reservation['Operation_Id']}}
                            <thead>

                                <tr>
                                    <th>
                                        <h2 style="margin-right:10px;padding-bottom: 5px;">Customer</h2>
                                    </th>

                                    @if( isset($reservation->operationdetails) )

                                    @foreach($reservation->operationdetails as $reservation_detail)
                                    <th>
                                        <h2 style="margin-right:10px;padding-bottom: 5px;">{{$reservation_detail->detailname['Operation_Detail_Name']}}</h2>
                                    </th>
                                    @endforeach
                                    @endif
                                    <th>
                                    <h2 style="margin-right:10px;padding-bottom: 5px;">Delete</th>
                                    <!-- Java Script for select all function -->

                                </tr>
                            </thead>
                            <tbody>
                                <!-- EL FOREARCH HNA -->

                                <tr>

                                    <td><a href="{{url('/view_User/'.$reservation['User_Id'])}}">{{$reservation->user['First_Name']}} {{$reservation->user['Middle_Name']}} {{$reservation->user['Last_Name']}}</a></td>
                                    @if( isset($reservation->operationdetails) )
                                    @foreach($reservation->operationdetails as $reservation_detail)
                                    <td class="box">{{$reservation_detail['Operation_Detail_Value']}}</td>
                                    @endforeach
                                    @endif
                                    <td> <a href="{{url('/operation_delete/'.$reservation['Operation_Id'])}}"><i class="fa fa-trash-o"></i>
                                    </td>
                                </tr>

                                <!-- END OF FOREACH -->
                            </tbody>
                        </table>
                        @endforeach

                    </div>
                </div>
                <div class="modal fade" id="EditPropertyDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Property Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="EditSubTypeForm">
                                    @csrf
                                    <input type="hidden" name="id" id="id">

                                    <div class="form-group">
                                        <label for="PropertyDetailName" style="font-size: 12pt">Detail </label>
                                        <input type="text" style="border-radius: 3pt" name="PropertyDetailName" id="PropertyDetailName" class="form-control">
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

                    function setPropertyDetailIdName(id, name) {

                        $("#id").val(id);
                        $("#PropertyDetailName").val(name);
                        $("#EditPropertyDetailModal").modal("toggle");
                    }
                    $('#EditSubTypeForm').submit(function() {

                        var id = $("#id").val();
                        // var MainTypeid=$("#MainTypeNameEdit").val();
                        var PropertyDetailName = $("#PropertyDetailName").val();
                        var _token = $("input[name=_token]").val();

                        $.ajax({
                            url: "{{route('propertyDetail.update')}}",
                            Type: "PUT",
                            data: {
                                id: id,
                                // MainTypeid:MainTypeid,
                                PropertyDetailName: PropertyDetailName,
                                _token: _token
                            },
                            success: function() {
                                console.log('Success');
                                // $('#sid'+response.id + 'td:nth-child(1)').text(response.PropertyDetailName);
                                $("#EditPropertyDetailModal").modal("toggle");
                                // $("#EditPropertyDetailModal")[0].reset();
                            },
                            error: function() {
                                console.log('Error');
                            }

                        });
                    })
                </script>

                <div class="row">
                </div>
            </div>

        </div>

        @endsection
