@extends('website.frontend.layouts.main')
<div class="modal fade" id="EditMainTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="data_form_details">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@section('profile')
<div class="col-xl-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                <a href="default-settings.html" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2"> Adding Item Step 3</h4>
            </div>
        </div>
        <form method="Get" action="{{url('/ShowItem/'.$item_id)}}" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-4 col-md-6">
                <div class="card w-100 bg-white border-0 mt-4">
                    <div class="card w-100 border-0 shadow-none p-4 rounded-xxl mb-3" style="background-color: #e5f6ff;">
                        <div class="card-body d-flex p-0">
                            <i class="btn-round-lg d-inline-block me-3 bg-primary-gradiant feather-home font-md text-white"></i>
                            <h4 class="text-primary font-xl fw-700">{{$sub_type}} <span class="fw-500 mt-0 d-block text-grey-500 font-xssss">Add Your Item</span></h4>
                        </div>
                        @foreach($property as $p)
                        <ul class="mt-3">
                            <li class="mt-1 mb-1">
                                <a href="javascript:void(0)" id="details" onclick="AddDetail('{{$p->Property_Id}}','{{$p->Property_Name}}')" class=" theme-dark-bg p-2 w-80 border-0 rounded-3 text-dark text-grey-500 text-left fw-600 font-xsss align-items-center"><span class="btn-round-xss ms-2 bg-primary me-3"></span> {{ __($p->Property_Name) }}
                                    <a href="javascript:void(0)" id="details" onclick="AddDetail('{{$p->Property_Id}}','{{$p->Property_Name}}')" class="float-right btn-round-sm bg-primary-gradiant " data-bs-toggle="modal" data-bs-target="#Modaltodo"><i class="feather-plus font-xss text-white"></i></a>
                                </a>
                            </li>
                            <br>
                        </ul>
                        @endforeach
                        <input type="hidden" value="{{$item_id}}" id="item_id">
                        <button type="submit" style="margin-left: 60px;" class="bg-current text-center text-white font-xsss fw-600 p-3 w100 rounded-3 d-inline-block">Done</button>

                    </div>
                </div>
            </div>
        </form>
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
                            '<div class="col-md-5">';

                        if (val['datatype'] == "checkbox") {
                            if (val['DetailValue'] == "yes") {
                                Form += '<input type="' + val['datatype'] + '" id="' + val['Property_Detail_Id'] + '" name="DetailItem[]"  class="form-check-input" checked>' +
                                    '</div>' +
                                    '</div>';
                            } else {
                                Form += '<input type="' + val['datatype'] + '" id="' + val['Property_Detail_Id'] + '" name="DetailItem[]"  class="form-check-input" >' +
                                    '</div>' +
                                    '</div>';
                            }
                        } else {
                            Form += '<input type="' + val['datatype'] + '" id="' + val['Property_Detail_Id'] + '" name="DetailItem[]"  class="form-control" >' +
                                '</div>' +
                                '</div>';
                        }

                });
                if (Form == '')
                    Form = 'No Property Details';
                else
                    Form += ' <div class="form-group row mb-0">' +
                    '<div class="col-md-2 offset-md-2">' +
                    ' <button type="submit" class="btn btn-primary">' +
                    ' {{ __("Add") }}';
                '</button>';


                $('#data_form_details').html(Form);
                // var FormTag= document.getElementById('data_form').innerHTML()=Form;
            },
            error: function() {
                console.log('Error');
            }

        });

    }

    $('#data_form').submit(function() {
        var data = [];
        var item_id = $("#item_id").val();
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
            success: function(msg) {
                //hna 3iza anady 3la created succefully
                console.log(msg);
            },
            error: function() {
                // hna anady 3la not created w kdaho
                console.log('Error');
            }
        });

    });
</script>

@endsection