<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
<h1>{{ $details['title'] }}</h1>
<p>{{ $details['body'] }}<a href="http://127.0.0.1:8000/"><b>{{$details['Link']}}</b></a></p>

<div class="col-md-3 col-sm-6  ">
    <div class="pricing">
        <div class="title">
            <h2>Your Receipt</h2>
        </div>
        <div class="x_content">
            <div class="">
                <div class="pricing_features">
                    <ul class="list-unstyled text-left">
                        <li> <strong> Item Name :</strong> {{ $item_name }}</li>
                        <li> <strong>Arrival Date :</strong> {{ $start_date }}</li>
                        <li> <strong> Departure Date:</strong> {{ $end_date }}</li>
                        <li> <strong>Total Number Of Days :</strong>{{ $numberOfDays }}</li>
                        <li> <strong>Price Per Night :</strong>{{ $price_per_night }}</li>
                        <li> <strong>Total Cost :</strong> {{ $totalCost }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<p>Thank you</p>
</body>
</html>
