<!doctype>
<html>
<head>
<title>Delete <?=$_GET['utdid']?> User </title>

</head>
<body>
<h2 align =center> Really delete <?=$_GET['utdid']?> User ? </h2>
<table align =center>
<tr>
<td>
<button onclick="location.href='/member/del_user?utdid=<?=$_GET['utdid']?>'">Delete</button>
</td>
<td>
<input type="button" value="BACK" onClick="history.go(-1)">
</td>
</tr>
</table>
</body>
</html>


