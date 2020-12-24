@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

@include('website\backend\database pages\Test1')
<input list="browsers" name="browser">
  <datalist id="browsers">
    <option value="Internet Explorer">
    <option value="Firefox">
    <option value="Chrome">
    <option value="Opera">
    <option value="Safari">
  </datalist>
            @endsection