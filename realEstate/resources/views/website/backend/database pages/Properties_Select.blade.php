@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href="{{asset('css/CategoriesDesign.css')}}" rel="stylesheet" type="text/css" />
        <div class="x_title">

            <h2>Add Item</h2>
            <div class="clearfix"></div>

        </div>
<form method="Get" action="{{url('/ShowItem/'.$item_id)}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        @foreach($property as $p)

        <div class="col-sm-3" id="done">
            <table id="datatable" class="table table-striped  dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                    <th>
                        <h6>
                            <a class="one" href="javascript:void(0)" id="details" onclick="AddDetail('{{$p->Property_Id}}','{{$p->Property_Name}}')">
                                {{ __($p->Property_Name) }}
                            </a>
                        </h6>
                    </th>
                </thead>

                <tbody>

                    <tr>
                        <td>
                            <a class="two" href="javascript:void(0)" onclick="AddDetail('{{$p->Property_Id}}','{{$p->Property_Name}}')">
                                Add More <i class="fa fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
        <br>
    </div>
    <input type="hidden" value="{{$item_id}}" id="item_id">
    <div class="row">
        <div class="col-sm-4" id="done">
            <div class="g">
                <button type="submit">Done</button>
            <div>
        </div>
        </div>
    </div>
    </div>
</form>


{{-- ----------------------------------------------------------------------------------------------------- --}}

<div class="modal fade" id="EditMainTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="data_form">
                    @csrf

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function AddDetail(id, name) {

        $("#exampleModalLabel").html(name);
        var Form = '';
        $.ajax({
            url: "{{route('propertyDetail.find')}}",
            Type: "PUT",
            data: {
                id: id
            },
            success: function(data) {
                console.log('success');
                $("#EditMainTypeModal").modal("toggle");

                Object.values(data).forEach(val => {

                    Form += ' <div class="form-group row"> ' +
                        '<label for="' + val['Property_Detail_Id'] + '" class="col-md-2 col-form-label text-md-right">' + val['Detail_Name'] + '</label>' +
                        '<div class="col-md-5">' +
                        '<input type="' + val['datatype'] + '" id="' + val['Property_Detail_Id'] + '" name="DetailItem[]" class="form-control" required autocomplete="DetailName">' +
                        '</div>' +
                        '</div>';
                });
                if (Form == '')
                    Form = 'No Property Details';
                else
                    Form += ' <div class="form-group row mb-0">' +
                    '<div class="col-md-2 offset-md-2">' +
                    ' <button type="submit" class="btn btn-primary">' +
                    ' {{ __("Add") }}';
                '</button>';


                $('#data_form').html(Form);
                // var FormTag= document.getElementById('data_form').innerHTML()=Form;
            },
            error: function() {
                console.log('Error');
            }

        });

    }

    $('#data_form').submit(function() {
        var data = [];
        var item_id= $("#item_id").val();
        //3iza ageeb kol el inputs b get element by name
        //w b3deen 3iza 27ot el inputs value&id f array
        $('input[name="DetailItem[]"]').each(function() {
            data.push({
                id: this.id,
                value: this.value,
            });
        });
        var _token = $("input[name=_token]").val();
        //w b3den 3iza 2b3t el array le el controller
        $.ajax({
            type: "post",
            url: "{{ route('details_submit')}}",
            data: {
                data: data,
                item_id: item_id,
                _token: _token
            },
            success: function() {
                //hna 3iza anady 3la created succefully
                console.log('Success');
            },
            error: function() {
                // hna anady 3la not created w kdaho
                console.log('Error');
            }
        });

    });
</script>
@endsection
