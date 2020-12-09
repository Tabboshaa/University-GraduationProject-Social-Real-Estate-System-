@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
<div class="row">
    <div class="col-sm-22">
        <div id="smartwizard">
            <ul class="nav">
                @foreach($property as $propertySteplink)
                <li class="nav-item">
                    <a class="btn btn-primary" onclick="showDetails('{{$propertySteplink->Property_Id}}')">
                        {{$propertySteplink->Property_Name}}
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="x_panel">
                <form method="POST" action="{{ url('') }}" enctype="multipart/form-data" >
                    @csrf
                   <div id="data_form">  </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-2 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

    function showDetails(property_Id) {
        var Form = " ";
        $.ajax({
            type: 'get',
            url: "{{ url('/findDetailsForForm')}}",
            data: {
                'id': property_Id
            },
            success: function(data) {
                console.log('success');

                Object.values(data).forEach(val => {
                    console.log(val);
                    Form += ' <div class="form-group row">' +
                        '<label for="'+ val['Property_Detail_Id']+'" class="col-md-2 col-form-label text-md-right">'+val['Detail_Name']+'</label>' +
                        '<div class="col-md-2">' +
                        '<input type="'+ val['datatype']+'" name="'+ val['Property_Detail_Id']+'"  required autocomplete="Detail_Name">' +
                        '</div>';
                });
               
               var FormTag= document.getElementById('data_form');
                FormTag.append(Form);
            },
            error: function() {
                console.log('error');
            }
        });
    }
</script>
@endsection