<!DOCTYPE html>
<html>
<head>
	<title>403 Forbidden</title>
	<link rel="shortcut icon" href="../images/tec.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<meta name="description" content="">
	<meta name="author" content="Fernando Manuel Avila Cataño">
	<meta name="theme-color" content="##FFFFFF">
	<meta name="msapplication-navbutton-color" content="##FFFFFF">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	<link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
	<link href="../css/paginaerror.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<!-- Error Page -->
	<div class="error">
		<div class="container-floud">
			<div class="col-xs-12 ground-color text-center">
				<div class="container-error-404">
					<div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
					<div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
					<div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
					<div class="msg">OH!<span class="triangle"></span></div>
				</div>
				<h2 class="h1">Lo siento, 403 Forbidden</h2>
				<center>
					<img  class="img-fluid" src="../images/escudo_itt_grande.png" height="150" width="150">
				</center>
			</div>
		</div>
	</div>
	<!-- Error Page -->

</body>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
function randomNum()
{
	"use strict";
	return Math.floor(Math.random() * 9)+1;
}
var loop1,loop2,loop3,time=30, i=0, number, selector3 = document.querySelector('.thirdDigit'), selector2 = document.querySelector('.secondDigit'),
selector1 = document.querySelector('.firstDigit');
loop3 = setInterval(function()
{
	"use strict";
	if(i > 40)
	{
		clearInterval(loop3);
		selector3.textContent = 4;
	}else
	{
		selector3.textContent = randomNum();
		i++;
	}
}, time);
loop2 = setInterval(function()
{
	"use strict";
	if(i > 80)
	{
		clearInterval(loop2);
		selector2.textContent = 0;
	}else
	{
		selector2.textContent = randomNum();
		i++;
	}
}, time);
loop1 = setInterval(function()
{
	"use strict";
	if(i > 100)
	{
		clearInterval(loop1);
		selector1.textContent = 3;
	}else
	{
		selector1.textContent = randomNum();
		i++;
	}
}, time);
</script>
</html>
