<!doctype>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/public/style/jbpage.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<title><?=$_GET['id_clk']?>. Clock</title>
</head>
<body>
<?php foreach($pick_clk as $pick_clks){
?>
<h2>Clock Update & Approved</h2>
	<form action="/clock/clk_change" method="post">
	<table>
	<tr>
	<td>DATE :</td><td> <input type="text" id="CLK_DATE" name="CLK_DATE" value=<?=$pick_clks->CLK_DATE?> readonly></td>
	</tr>
	<tr>
	<td> NAME : </td><td> <input type="text" value= <?=$pick_clks->USER_NAME?> readonly></td>
	</tr>
	<tr>
	<td>CLK ID :</td><td><input type="text_box" id="CLK_ID" name="CLK_ID" value=<?=$pick_clks->CLK_ID?> readonly></td>
	</tr>
	<tr>
	<td>Clock-In : </td><td><input type="text" id="CLK_IN" name="CLK_IN" value=<?=$pick_clks->CLK_IN?>></td> 
	</tr>
	<tr>
	<td>Clock-Out : </td><td><input type="text" id="CLK_OUT" name="CLK_OUT" value=<?=$pick_clks->CLK_OUT?>></td>
	</tr>
        <tr>
        <td>Pay : </td><td><input type="text" id="PAYING" name="PAYING" value=14.25></td>
        </tr>
	<tr>
	<td>Approved : </td><td><input type="checkbox" id="Approved" name="Approved" value=1> </td>
	</tr>
	<tr>
	<td><input type="submit" value="Clock Update"></td>
	</tr>
	</table>
	</form>
<?php
}
?>
	<button type="button" class="btn btn-danger" onclick="location.href='/clock/delete_?id_clk=<?=$_GET['id_clk']?>'">Delete Clock
</button>
</body>
</html>
