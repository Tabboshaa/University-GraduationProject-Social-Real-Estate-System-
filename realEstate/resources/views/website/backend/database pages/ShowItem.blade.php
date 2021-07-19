@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

<link href="{{asset('css/ShowItem.css')}}" rel="stylesheet" type="text/css" />


<div class="ItemPanel">

    <a href="{{url('/Item')}}"><i style="padding-left:35px" class="fa fa-plus"></i>
        <p><small>Create another item</small></p>
    </a>
    <a href="{{url('/Details')}}" class="space"><i style="padding-left:40px" class="fa fa-search"></i>
        <p><small>search for another item</small></p>
    </a>


    <a href="{{url('/reservations/'.$item_id)}}"><i style="padding-left:21px" class="fa fa-tasks"></i>
        <p><small>Reservations</small></p>
    </a>
    @if(!empty($subtypeid))
    <a href="{{url('/property_select/'.$item_id.'/'.$subtypeid.'')}}"><i style="padding-left:13px" class="fa fa-plus-square-o"></i>
        <p><small>Details</small></p>
    </a>
    @else
    <a href="{{url('/addItemSteps/'.$item_id)}}"><i style="padding-left:13px" class="fa fa-plus-square-o"></i>
        <p><small>Details</small></p>
    </a>
    @endif
    <a href="{{url('/item_schedule/'.$item_id)}}"><i style="padding-left:15px" class="fa fa-calendar"></i>
        <p><small>Schedule</small></p>
    </a>
    <a href="{{url('/item_posts/'.$item_id)}}"><i style="padding-left:14px" class="fa fa-pencil"></i>
        <p><small>Posts</small></p>
    </a>
    <a href="{{url('/item_reviews/'.$item_id)}}"><i style="padding-left:14px" class="fa fa-comments-o"></i>
        <p><small>Reviews</small></p>
    </a>
    <a href="{{url('/item_gallery/'.$item_id)}}"><i style="padding-left:14px" class="fa fa-image"></i>
        <p><small>Gallery</small></p>
    </a>
    <a href="{{url('/item_delete/'.$item_id)}}" onclick="return confirm('Are you sure you want to delete?')"><i style="padding-left:14px" class="fa fa-trash-o"></i>
        <p><small>Delete</small></p>
    </a>
</div>


<div class="C">

    <h2>{{$item->Item_Name}} </h2>

</div>

<table id="datatable" class="table  pro  dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            <td class="th1">User</td>
            <td class="td1">
                Name : {{$user->First_Name}} {{$user->Middle_Name}} {{$user->Last_Name}}
                <br>Email :{{$email}} <a href="{{ url('/edit_item_user/'.$item_id) }}"><i class="fa fa-edit"> Edit</i></a>
                <br>Phone Number :{{$phone_number}}
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="th1">Location</th>
            <td class="td1">{{$Location->Country_Name}},{{$Location->State_Name}},{{$Location->City_Name}},{{$Location->Region_Name}},{{$Location->Street_Name}}
                <a href="{{ url('/edit_item_location/'.$item_id) }}"><i class="fa fa-edit"> Edit</i>
            </td>
        </tr>

        <tr>
            <form method="Post" action="{{ url('/delete_detail_item?_method=delete') }}" enctype="multipart/form-data">
                @csrf
                <table class="table pro2 table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

                    @foreach ($details as $property => $detail)
                    <tr>
                        <td class="th2">
                            <h4>{{$property}} detail</h4>
                        </td>
                        <th class="th2">value</th>
                        <th class="th2">Select all <input type="checkbox" id="selectAll" name="selectAll"> </a> <button class="btn" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" style="margin-right:155px;"></i></th>
                        <th class="th2">Edit</th>
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

                    <!-- {{$i=0}} -->
                    @foreach($detail as $diff => $detailValue)
                    <!-- {{$i+=1}} -->
                    <tr class="ha">
                        <td colspan="5">
                            <h6> {{$property}} {{$i}}</h6>
                        </td>
                    </tr>
                    @foreach($detailValue as $detailValue)
                    <tr class="ha">
                        <td>
                            <h6>{{$detailValue->Detail_Name}}</h6>
                        </td>
                        <td>
                            <h6>{{$detailValue->DetailValue}}</h6>
                        </td>
                        <td><input type="checkbox" name="id[]" value="{{$detailValue->Detail_Id}}"></td>
                        <td><a href="javascript:void(0)" onclick="setDetailIdName('{{$item_id}}','{{$detailValue->Detail_Id}}','{{$detailValue->DetailValue}}','{{$detailValue->Detail_Name}}')"><i class="fa fa-edit"></i></a></td>

                    </tr>

                    @endforeach @endforeach


                    @endforeach
                </table>
            </form>
        </tr>
    </tbody>
</table>

<div class="modal fade" id="EditDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">  
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditDetailForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="Item" id="item">

                    <div class="form-group">
                        <label for="DetailName" style="font-size: 12pt" id="detailnamelabel"></label>
                        <input type="text" style="border-radius: 3pt" name="DetailName" id="DetailName" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success" id="btun5">Edit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function setDetailIdName(item,id,val,name) {

        $("#id").val(id);
        $("#item").val(item);
        $("#DetailName").val(val);
        $("#detailnamelabel").html(name);
        $("#EditDetailModal").modal("toggle");
    }

    $('#EditDetailForm').submit(function() {

        var id = $("#id").val();
        var item = $("#item").val();
        // var MainTypeid=$("#MainTypeNameEdit").val();
        var DetailName = $("#DetailName").val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('Detail.update')}}",
            Type: "PUT",
            data: {
                id: id,
                Item: item,
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
