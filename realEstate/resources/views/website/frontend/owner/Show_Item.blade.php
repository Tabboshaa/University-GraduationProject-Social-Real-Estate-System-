@extends('website.frontend.layouts.main')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
               
                            @if(!empty($items))
                            @foreach($items as $item)
                            
            <div class="row">
	                <div class="filterDiv Places">
                        <div class=" mylisting">
                            
                            <div class="col-md-3 col-xs-12 ">
                                <div class="box">
                                    <div class="box-img">
                                        <img class="background" src="{{asset('storage/cover page/'.$item->path)}}" alt="" style="height:100pt; width:100pt;">
                                    </div>
                                    <div class="box-heading2" >
                                        <h1>{{$item->Item_Name}}</h1>
                                    </div>
                                </div>
                            </div>

</div>
</div>
</div>
</div>

                            @endforeach
                            @endif
             

        </div>
    </div>
</div>
@endsection
       