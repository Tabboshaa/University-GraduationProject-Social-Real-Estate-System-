@extends('website.backend.layouts.main')
@section('content')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

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
                @include('website.backend.layouts.flashmessage')
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        @foreach($user_typess as $user_types)
                        <li class="nav-item">
                            <a class="nav-link" id="usertypes-tab"  href="javascript:void(0)" onclick="showUsers('{{$user_types->User_Type_ID}}')" role="tab" aria-controls="usertypes" aria-selected="true">{{$user_types->Type_Name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @if(count($users) == 0)
                            <p> There is no data to show </p>
                        @endif    
                        

                        <form method="Post" action="{{ url('/delete_user/?_method=delete') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                            <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th >Select all <input type="checkbox" id="selectAll" name="selectAll">  <button class="btn" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="margin-right:90px;"></i></th>
                                        
                        
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
                                <tbody id="Table">
                                    
                                </tbody>
                            </table>
                        
                        </form>
                     

                        <!-- form of editing user name -->
                        <div class="modal fade" id="EditUserNameModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Change User Name</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="EditUserNameForm">
                                            @csrf

                                            <input type="hidden" name="id" id="editnameid">
                                            <div class="form-group">
                                                <label for="UserFirstName" style="font-size: 12pt" >First Name</label>
                                                <input type="text"  style="border-radius: 3pt"name="User_First_Name" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" id="User_First_Name" class="form-control">
                                            
                                                <label for="UserMiddleName" style="font-size: 12pt" >Middle Name</label>
                                                <input type="text" style="border-radius: 3pt" name="User_Middle_Name" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" id="User_Middle_Name" class="form-control">
                                            
                                                <label for="UserLastName" style="font-size: 12pt" >Last Name</label>
                                                <input type="text" style="border-radius: 3pt" name="User_Last_Name" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" id="User_Last_Name" class="form-control">
                                            
                                            </div>
                                            
                                            <button type="submit" id="btun3" class="btn btn-success">Edit</button>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Change Email:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="EditUserEmailForm">
                                            @csrf

                                            <input type="hidden" name="id" id="editemailid">
                                            <div class="form-group">
                                                <label for="UserEmail" style="font-size: 12pt" >Email</label>
                                                <input type="text" style="border-radius: 3pt"  name="User_Email" id="User_Email" class="form-control">
                                            </div>
                                            
                                            <button type="submit"  id="btun3" class="btn btn-success">Edit</button>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Change PhoneNumber</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="EditUserPhoneNumberForm">
                                            @csrf

                                            <input type="hidden" name="id" id="editphonenumberid">
                                            <div class="form-group">
                                                <label for="UserPhoneNumber" style="font-size: 12pt" >PhoneNumber</label>
                                                <input type="text" style="border-radius: 3pt" name="User_PhoneNumber" id="User_PhoneNumber" class="form-control">
                                            </div>
                                            
                                            <button type="submit" id="btun3" class="btn btn-success">Edit</button>
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

    

    function showUsers(id) {


var Table = '';
$.ajax({
    url: "{{route('users_show')}}",
    Type: "get",
    data: {
        id: id
    },
    success: function(data) {
        console.log(data);

        Object.values(data).forEach(val => {
            
            Table += 
            '<tr>'+
            '<td>'+val['First_Name']+' '+ val['Middle_Name'] +' '+val['Last_Name'] +' '+'<a href="javascript:void(0)" onclick="setUserNameIdName('+val['First_Name']+','+val['Middle_Name']+' , '+val['Last_Name']+')">'+'<i class="fa fa-edit">'+'</i>'+'</a>'+'</td>' +
            '<td>'+val['email']+'<a href="javascript:void(0)" >'+'<i class="fa fa-edit" onclick="setUserEmailIdName('+val['Email_Id']+','+val['email']+')">'+'</i>'+'</a>'+'</td>'+
            '<td>'+val['phone_number']+'<a href="javascript:void(0)">'+'<i class="fa fa-edit" onclick="setUserPhoneNumberIdName('+val['PhoneNumber_Id']+','+val['phone_number']+')">'+'</i>'+'</a>'+'</td>'+
            '<td>'+'<input type="checkbox" name="id[]"'+ val['User_ID']+'">'+'</td>'+
            '</tr>';
        });
        if (Table == '')
        Table = 'No Property Details';
        else
        Table += ' <div class="form-group row mb-0">' +
            '<div class="col-md-2 offset-md-2">' +
            ' <button type="submit" class="btn btn-primary">' +
            ' {{ __("Add") }}';
        '</button>';


        $('#Table').html(Table);
        // var FormTag= document.getElementById('data_form').innerHTML()=Form;
    },
    error: function() {
        console.log('Error');
    }

});

}
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
