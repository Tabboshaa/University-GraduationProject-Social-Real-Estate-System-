@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
<form method="Post" action="{{url('/submit_properties')}}" enctype="multipart/form-data">
                        @csrf
<table>
    @foreach($property as $p)
    <div class="row">
    <tr>
        <td>
        <label for="Sub_Type_Property" class="col-md-2 col-form-label text-md-right">{{ __($p->Property_Name) }}</label>
        </td>
        <td>
        <div class="col-md-2">
            <input id="Sub_Type_Property" type="checkbox"  name="property[]" value="{{$p->Property_Id}}"/>

<!-- class="form @error('Sub_Type_Property') is-invalid @enderror"
            @error('Sub_Type_Property')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror -->
        </div>
        </td>
    </tr>
    </div>
    @endforeach
    </table>
<button type="submit" class="btn btn-primary">
                            {{ __('Next') }}
</button>
</form>
@endsection