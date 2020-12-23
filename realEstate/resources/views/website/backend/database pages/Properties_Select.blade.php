@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

<link href="{{asset('css/CategoriesDesign.css')}}" rel="stylesheet" type="text/css" />

<form method="Post" action="{{url('/')}}" enctype="multipart/form-data">
    @csrf
    @foreach($images as $image)
        @foreach($property as $p)
        
            <div class="col-sm-3">
                
                <table id="cateagories">
                    <body>
                        
                        <tr>
                            <td>
                                
                                <a href="javascript:void(0)" id="details" onclick="AddDetail('{{$p->Property_Id}}','{{$p->Property_Name}}')"> 
                                   
                                    <img  src="{{ asset('Images/' . $image->getFilename()) }}" id="PropertyImage">
                                   
                                    <label for="Sub_Type_Property" class="col-md-2 col-form-label text-md-right">{{ __($p->Property_Name) }}</label> 
                                </a>
                                
                            </td>
                          
                        </tr>
                        
                    </body>
                </table>
                

            </div>
        @endforeach
        @endforeach

        <tr>
        <!-- send item id to be shown in show item page -->
            <td>
                <button type="submit" class="btn btn-primary">
                    {{ __('Next') }}
                </button>

            </td>
        </tr>

</form>

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

window.onload = choosePic;

var myPix = new Array("images/1.jpeg","images/2.jpeg","images/3.jpeg","images/4.jpeg","images/5.jpeg","images/6.jpeg");

function choosePic() {

     var randomNum = Math.floor(Math.random() * myPix.length);
     document.getElementById("PropertyImage").src = myPix[randomNum];
}

    function AddDetail(id, name) {

        $("#exampleModalLabel").html(name); 
        var Form='' ; 
        $.ajax({ 
            url: "{{route('propertyDetail.find')}}" , 
            Type: "PUT" , 
            data: { id: id }, 
            success: 
            function(data) 
            { 
                console.log('success'); 
                $("#EditMainTypeModal").modal("toggle"); 
                
                 Object.values(data).forEach(val=> {

                    Form += ' <div class="form-group row"> ' +
                        '<label for="' + val['Property_Detail_Id'] + '" class="col-md-2 col-form-label text-md-right">' + val['Detail_Name'] + '</label>' +
                        '<div class="col-md-5">' +
                            '<input type="' + val['datatype'] + '" id="' + val['Property_Detail_Id'] + '" name="DetailItem[]" class="form-control" required autocomplete="DetailName">' +
                            '</div>'+
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

    $('#data_form').submit(function (){
                            var data=[];

                            //3iza ageeb kol el inputs b get element by name
                            //w b3deen 3iza 27ot el inputs value&id f array
                            $('input[name="DetailItem[]"]').each(function() {
                            data.push({id: this.id, value: this.value});
                            });
                            var _token= $("input[name=_token]").val();
                            //w b3den 3iza 2b3t el array le el controller
                            $.ajax({
                            type: "post",
                            url: "{{ route('details_submit')}}",
                            data: {
                            data: data,
                            _token:_token
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