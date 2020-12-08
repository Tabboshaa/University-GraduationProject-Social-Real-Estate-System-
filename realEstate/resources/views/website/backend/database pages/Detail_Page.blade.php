@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')>
<script>
   
</script>
<div class="row">
    <div class="col-sm-22">
        <div id="smartwizard">
            <ul class="nav">
                @foreach($property as $propertySteplink)
                <li>
                    <a class="nav-link" href="#step-{{$propertySteplink->Property_Id}}">
                        {{$propertySteplink->Property_Name}}
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content">
            @foreach($property as $propertyStep)
                <div id="step-{{$propertyStep->Property_Id}}" class="tab-pane" role="tabpanel">
                @foreach($details as $detail)
                @if($detail->Property_Id === $propertyStep->Property_Id)
                   {{$detail->Detail_Name}}
                    @endif
                @endforeach
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection