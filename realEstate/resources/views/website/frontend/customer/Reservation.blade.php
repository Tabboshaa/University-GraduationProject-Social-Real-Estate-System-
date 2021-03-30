@extends('website.frontend.layouts.main')
@section('content')
<link href="{{asset('css/FrontEndCSS/paymentDesign.css')}}" rel="stylesheet" type="text/css" />
<div id="content-wrapper">
    <div class="container-fluid">
        
        <div>
            <p >Number of days:</p>
            <p>Total price:</p>
            <h2>Credit Card Information</h2>
            <form method="POST" action="{{ url('/reserve') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="paid_amount" value="1000">
            <table style="width:100%">
            <th style="width:25%;"></th><th style="width:25%;"></th><th style="width:25%;"></th><th style="width:25%;"></th>
                    <tr>
          <td>  <label>Card holder name:</label></td>
         <td colspan="2">   <input type="text" id="card-name" name="card-name"></td>
</tr>
            <tr>
           <td> <label>Credit Card Number</label></td>
           <td colspan="2">  <input type="text" id="card-num" name="card-num"></td>
            </tr>
            <tr>
           <td > <label>Expiry date:</label></td>
        <td>    <input type="text" id="card-exp" name="card-exp" placeholder="MM / YY" maxlength="7"></td><td></td> <td></td>
</tr>
<tr>
    <td >    <label>Cvv number:</label></td>
           <td> <input type="text" id="card-cvv" name="card-cvv"></td><td></td> <td></td>
</tr>
<tr>
          <td>  <label>security code</label></td>
           <td> <input type="password" id="card-pass" name="card-pass"></td><td></td> <td></td>
</table>
<div class="center">
            <input type="submit" name="Pay" class="btnpayment">
</div>
            </form>
        </div>
     </div>
</div>
@endsection