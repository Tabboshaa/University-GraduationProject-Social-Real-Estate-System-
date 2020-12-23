@extends('website.backend.layouts.main')
@section('content')
    <div class="right_col" role="main">
        <div class="title_right">
    
            <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
                <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                    <div class="row">
                        @yield('Item_Main_Type_table')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    

@endsection
