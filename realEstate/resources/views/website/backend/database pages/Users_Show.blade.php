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
                                        <th>Phone Number</th>
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
                                        
                                        <td> {{$users->First_Name}} {{$users->Middle_Name}} {{$users->Last_Name}} <a href="javascript:void(0)" onclick="setUserNameIdName('{{$users->id}}','{{$users->First_Name}}' , '{{$users->Middle_Name}}' , '{{$users->Last_Name}}')" ><i class="fa fa-edit"></i></a></td>
                                        <td> {{$users->email}} <a href="javascript:void(0)" ><i class="fa fa-edit" onclick="setUserEmailIdName('{{$users->Email_Id}}','{{$users->email}}')"></i></a></td>
                                        <td> {{$users->phone_number}} <a href="javascript:void(0)"><i class="fa fa-edit" onclick="setUserPhoneNumberIdName('{{$users->PhoneNumber_Id}}','{{$users->phone_number}}')"></i></a></td>
                                        <td><input type="checkbox" name="id[]" value="{{$users->User_ID}}"></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                        @endif

                        <!-- form of editing user name -->
                        <div class="modal fade" id="EditUserNameModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User Name</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="EditUserNameForm">
                                            @csrf

                                            <input type="hidden" name="id" id="editnameid">
                                            <div class="form-group">
                                                <label for="UserFirstName">First Name</label>
                                                <input type="text" name="User_First_Name" id="User_First_Name" class="form-control">
                                            
                                                <label for="UserMiddleName">Middle Name</label>
                                                <input type="text" name="User_Middle_Name" id="User_Middle_Name" class="form-control">
                                            
                                                <label for="UserLastName">Last Name</label>
                                                <input type="text" name="User_Last_Name" id="User_Last_Name" class="form-control">
                                            
                                            </div>
                                            
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- form of editing user email -->
                        <div class="modal fade" id="EditUserEmailModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User Email:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="EditUserEmailForm">
                                            @csrf

                                            <input type="hidden" name="id" id="editemailid">
                                            <div class="form-group">
                                                <label for="UserEmail">User Email</label>
                                                <input type="text" name="User_Email" id="User_Email" class="form-control">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <!-- form of editing user phone number -->
                        <div class="modal fade" id="EditUserPhoneNumberModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User PhoneNumber</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="EditUserPhoneNumberForm">
                                            @csrf

                                            <input type="hidden" name="id" id="editphonenumberid">
                                            <div class="form-group">
                                                <label for="UserPhoneNumber">User PhoneNumber</label>
                                                <input type="text" name="User_PhoneNumber" id="User_PhoneNumber" class="form-control">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        function setUserNameIdName(id, First_Name , Middle_Name , Last_Name ) {
            
            $("#editnameid").val(id);
            $("#User_First_Name").val(First_Name);
            $("#User_Middle_Name").val(Middle_Name);
            $("#User_Last_Name").val(Last_Name);
            $("#EditUserNameModel").modal("toggle");
        }

        function setUserEmailIdName(id, email) {
            $("#editemailid").val(id);
            $("#User_Email").val(email);
            $("#EditUserEmailModel").modal("toggle");
        }

        function setUserPhoneNumberIdName(id, phonenumber) {
            $("#editphonenumberid").val(id);
            $("#User_PhoneNumber").val(phonenumber);
            $("#EditUserPhoneNumberModel").modal("toggle");
        }

    // Submit New User Name
    $('#EditUserNameForm').submit(function() {

        var id = $("#editnameid").val();
        var UserFirstName = $("#User_First_Name").val();
        var UserMiddleName = $("#User_Middle_Name").val();
        var UserLastName = $("#User_Last_Name").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('UserName.update')}}",
            Type: "PUT",
            data: {
                id: id,
                UserFirstName: UserFirstName,
                UserMiddleName: UserMiddleName,
                UserLastName: UserLastName,
                _token: _token
            },
            success: function(response) {
                console.log('Sucess');
                $("#EditUserNameModel").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
    })

    // Submit New User Name
    $('#EditUserEmailForm').submit(function() {

        var id = $("#editemailid").val();
        var email= $("#User_Email").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('UserEmail.update')}}",
            Type: "PUT",
            data: {
                id:id,
                email:email,
                _token: _token
            },
            success: function() {
                console.log('Success');
                $("#EditUserEmailModel").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
    })

         $('#EditUserPhoneNumberForm').submit(function() {

        var id = $("#editphonenumberid").val();
        //byb3t el value el gdeda
        var phonenumber = $("#User_PhoneNumber").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('UserPhoneNumber.update')}}",
            Type: "PUT",
            data: {
                id: id,
                phonenumber: phonenumber,
                _token: _token
            },
            success: function(response) {
                console.log('Sucess');
                $("#EditUserPhoneNumberModel").modal("toggle");
                // $("#EditSubTypeModal")[0].reset();
            },
            error: function() {
                console.log('Error');
            }

        });
        })
</script>

@endsection
