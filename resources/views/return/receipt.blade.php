<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<title>Receipt</title>

	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="css/dompdf/bootstrap.min.css">
</head>
<body>
	<div class="main">
		<?php 
			$today = Carbon\Carbon::now()->format('d/m/Y');

			$duration = $arr['duration'] ? 7 : 1;
		?>
		<div class="heading">
			
			<div class="heading" id="yma">
				<h1>LIBRARY</h1>
				<p><h4>Ramthar Veng Presbyterian Kohhran</h4></p>
			</div>
			<?php  
			 $day = $arr['day']; 
			 $rate = $arr['rate_per_day'];
			?> 
			<div class="heading" id="particulars">
				<b>Receipt No:</b> {{ $arr['id'] }}<br>
				<b>Date:</b> {{ $today }}<br>
				<b>Member Id:</b><br>{{ $arr['memId'] }}<br>
				<b>Book Title:</b><br> {{ $arr['book'] }}
			</div>

		</div>


		<div class="title">
			<br><h3>RECEIPT</h3>
		</div>

		<div class="content">

			<div class="content" id="slno">
				<p><b>#</b></p>
				<p>1</p>
				<p> &nbsp; </p>
			</div>
			<div class="content" id="part">
				<p><b>Particulars</b></p>
				<p>Late Fee in favour of<br> {{ $arr['member'] }}</p>
				<p> &nbsp; </p>
			</div>


			<?php 
					
					function test($f) {
					    // echo "f = $f\n";
					    //echo getIntCount($f);
					    echo getDecCount($f);
					    // echo "\n";
					}

					function getIntCount($f) {
					    if ($f === 0) {
					        return 1;
					    } elseif ($f < 0) {
					        return getIntCount(-$f);
					    } else {
					        return floor(log10(floor($f))) + 1;
					    }
					}

					function getDecCount($f) {
					    $num = 0;
					    while (true) {
					        if ((string)$f === (string)round($f)) {
					            break;
					        }
					        if (is_infinite($f)) {
					            break;
					        }

					        $f *= 10;
					        $num++;
					    }
					    return $num;
					}
				?>


			<div class="content" id="rate">
				<p><b>Per Weeks rate </b></p>
				<?php $nos = intval($day/7, 0); $no = round($day/7, 1); $length = strlen((string)$nos); ?>
				<p>{{intval($day/7, 0)}} w / {{substr($no, $length+1)}} D @Rs {{ $rate }} </p><br>

				@if($arr['amount'] != $day/$duration * $rate)
				<p><b>Discount</b></p>
				@endif

				<p><b>Total</b></p>
			</div>
			<div class="content" id="total">
				
				
				<p><b>Amount</b></p>
				<p>{{ $arr['amount'] }}</p><br>
				@if($arr['amount'] != $day/$duration * $rate)
					@php $tot = ($day/$duration * $rate) - $arr['amount']; @endphp
				<p>- <b>{{$tot}}</b></p>
				<p><b>Rs {{ $arr['amount'] }}/-</b><br></p>
				@else
				<p><b>Rs {{ $day/$duration * $rate }}/-</b><br></p>
				@endif
			</div>
			<div class="title" id="footers">

				<p>(This is a computer generated
				receipt which you can check
				transaction later using your Receipt No.)</p>
			</div>
			

		</div>
	</div>

</body>
</html>

<style type="text/css">
	
*{
	margin: 0px;
	padding: 0px;
}

html,body{
        height: 942px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }

.main{
	width: 80%;
	margin-top: 15px;
	margin-left: 15px; 
	border: solid;
	padding: 10px;
}

.heading{
	width: 100%;
	display: inline-block;
}

#yma{
	width:57%;
	padding-top: 20px;
	float: left;
}

#yma span{
	font-size: 16px;
	font-weight: bold;
	padding-left: 5px;
}

#particulars{
	width: 40%;
	float:left;
	text-align: right;
	padding-top: 5px;
	padding-right: 5px;
}

.title{
	font-family: Arial;
	text-align: center;
	font-style: italic;
	padding-bottom: 10px;
}

.content{
	display: inline-block;
	width: 100%;
	font-size: 16px;
	text-align: center;
	padding-bottom: 20px;
}

#footers{
	
	text-align: center;
}

#slno{
	float: left;
	width: 5%;
}

#part{
	float: left;
	width: 37%;
	text-align: center;
}


#rate{
	float: left;
	width: 36%;
	text-align: right;
}

#total{
	float: left;
	width: 22%;
	text-align: right;
}
</style>
