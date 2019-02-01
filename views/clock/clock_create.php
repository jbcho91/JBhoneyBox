<!doctype>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Create Clock </title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
	$( "#salutation" ).selectmenu();
});

$( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
  } );
  </script>
</head>
<body>
<h2>Create New Clock</h2>
<form action="/clock/make_clk" method="post">
<table align="center">
<tr>
<td><label for="USER_NAME">Select a Name : </label></td>
<td>	<select name="USER_NAME" id="USER_NAME">
	<option disabled selected>Please pick one</option>
<?php 
	foreach($creates as $create){ ?>
		<option><?=$create->USER_NAME?></option>
<?php 
	}
?>  
	</select>
</td>
</tr>
<tr>
<td>Select a Date : </td>
<td><input type="text" id="datepicker" name="datepicker"></td>
</tr>
<tr>
<td>Clock IN</td><td> <input type="text" id="CLK_IN" name="CLK_IN" placeholder="12:00"></td>
</tr>
<tr>
<td>Clock Out</td><td> <input type="text" id="clk_out" name="clk_out" placeholder="18:00"></td>
</tr>
</table>
<br>
<div align="center">
<button type="submit" class="btn btn-default">Create</button>
</div>
</form>
</body>
</html>
