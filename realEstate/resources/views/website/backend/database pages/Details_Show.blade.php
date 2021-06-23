@extends('website.backend.database pages.Details')
@section('Details_table')
<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<!--  -->

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
        function setDetailIdName(id,name){

                $("#id").val(id);
                $("#DetailName").val(name);
                $("#EditDetailModal").modal("toggle");
        }
        $('#EditDetailForm').submit(function (){

            var id=$("#id").val();
            // var MainTypeid=$("#MainTypeNameEdit").val();
            var DetailName=$("#DetailName").val();
            var _token= $("input[name=_token]").val();
            
            $.ajax({
                url:"{{route('Detail.update')}}",
                Type:"PUT",
                data:{
                    id:id,
                    // MainTypeid:MainTypeid,
                    DetailName:DetailName,
                     _token:_token
                },
                success:function (){
                    console.log('Success');
                    $("#EditDetailModal").modal("toggle");
                    // $("#EditDetailModal")[0].reset();
                },
                error:function ()
                {
                    console.log('Error');
                }

            });
        })
    </script>

@endsection
