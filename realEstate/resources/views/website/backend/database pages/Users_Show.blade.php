@extends('website.backend.layouts.main')
@section('content')

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            <div class="x_title">
                <h2> Users </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                
                <div class="clearfix"></div>
                
                <div class="x_content">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        @foreach($user_types as $user_types)
                        <li class="nav-item">
                            <a class="nav-link" id="usertypes-tab"  href="{{url('/TypeOfUser/'.$user_types->User_Type_ID)}}" role="tab" aria-controls="usertypes" aria-selected="true">{{$user_types->Type_Name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @if(count($users) == 0)
                            <p> There is no data to show </p>
                        @else

                        <form method="Post" action="{{ url('/delete_user/?_method=delete') }}" enctype="multipart/form-data">
                            @csrf
                            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone_Number</th>
                                        <th>Select all <input type="checkbox" id="selectAll" name="selectAll"> <input type="submit" value="Delete Selected" class="btn btn-secondary"></th>
                                        
                        
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
                                    @foreach($users as $users)
                                    <tr>
                                        <td> {{$users->First_Name}} {{$users->Middle_Name}} {{$users->Last_Name}}</td>
                                        <td> {{$users->email}}</td>
                                        <td> {{$users->phone_number}}</td>
                                        <td><input type="checkbox" name="id[]" value="{{$users->User_ID}}"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
