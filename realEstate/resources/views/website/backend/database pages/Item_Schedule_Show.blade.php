@extends('website.backend.database pages.Item_Schedule')
@section('table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<div class="x_title">
    <h2>Schedule</h2>

    <div class="clearfix"></div>

    <form method="Post" action="{{url('/delete_schedule?_method=delete')}}" enctype="multipart/form-data">
        @csrf
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
        <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
            <thead>
                <tr>
                    <th>
                        <h2 style="margin-right:150px; padding-bottom: 5px;">Start date</h2>
                    </th>
                    <th>
                        <h2 style="margin-right:150px; padding-bottom: 5px;">End date</h2>
                    </th>
                    <th>
                        <h2 style="margin-right:150px; padding-bottom: 5px;">Price Per Night</h2>
                    </th>
                    <th>
                        <h2 style="margin-right:50px;padding-bottom: 5px;">Edit</h2>
                    </th>
                    <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <button class="btn"><i class="fa fa-trash" style="margin-right:200px;"></i></th>

                    <!-- Java Script for select all function -->
                    <script>
                        document.getElementById('selectAll').onclick = function() {
                            var checkboxes = document.getElementsByName('schedule[]'); //get all check boxes with name delete
                            for (var checkbox of checkboxes) { //for loop to set all checkboxes to checked
                                checkbox.checked = this.checked;
                            }
                        }
                    </script>
                </tr>
            </thead>
            <tbody>
                <!-- EL FOREARCH HNA-->
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{$schedule->Start_Date}}</td>
                    <td>{{$schedule->End_Date}}</td>
                    <td>{{$schedule->Price_Per_Night}}</td>
                    <td><a href="javascript:void(0)" onclick="setSchedule('{{$schedule->schedule_Id}}','{{$schedule->Start_Date}}','{{$schedule->End_Date}}','{{$schedule->Price_Per_Night}}')"><i class="fa fa-edit"> </i></a></td>
                    <td><input type="checkbox" name="schedule[]" value="{{$schedule->schedule_Id}}" id="schedule"></td>
                </tr>

                @endforeach
                <!-- END OF FOREACH -->
            </tbody>
        </table>
    </form>

    <div class="modal fade" id="EditScheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Main type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="EditScheduleForm">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="start" class=" col-form-label text-md-right" style="font-size: 12pt">
                                {{ __('Start Date:') }}
                            </label>

                            <input style="border-radius: 3pt" type="date" class="form-control @error('arrival') is-invalid @enderror" id="start_edit" value="{{ old('arrival') }}" required autocomplete="arrival" autofocus>

                        </div>
                        <div class="form-group">
                            <label for="start" class="col-form-label text-md-right" style="font-size: 12pt">
                                {{ __('Departure Date:') }}
                            </label>

                            <input style="border-radius: 3pt" type="date" class="form-control @error('departure') is-invalid @enderror" id="end_edit" value="{{ old('departure') }}" required autocomplete="departure">

                        </div>
                        <div class="form-group">
                            <label for="start" class="col-form-label text-md-right" style="font-size: 12pt">
                                {{ __('Price:') }}
                            </label>

                            <input style="border-radius: 3pt" type="text" class="form-control @error('Price') is-invalid @enderror" id="price_edit" value="{{ old('Price') }}" required autocomplete="Price">

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

        function setSchedule(id, start, end, price) {
            $("#id").val(id);
            $("#start_edit").val(start);
            $("#end_edit").val(end);
            $("#price_edit").val(price);
            console.log(start);
            $("#EditScheduleModal").modal("toggle");
        }

        $('#EditScheduleForm').submit(function() {

            var id = $("#id").val();
            var StartDate = $("#start_edit").val();
            var EndDate = $("#end_edit").val();
            var Price = $("#price_edit").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{route('schedule.update')}}",
                Type: "PUT",
                data: {
                    id: id,
                    StartDate: StartDate,
                    EndDate: EndDate,
                    Price: Price,
                    _token: _token
                },
                success: function() {
                    console.log('Success');
                    $("#EditMainTypeModal").modal("toggle");
                },
                error: function() {
                    console.log('Error');
                }

            });
        })
    </script>

    @endsection