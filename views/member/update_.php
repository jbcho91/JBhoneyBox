<!doctype html>
<html>
<head>
<title>Update <?=$_GET['utdid']?> User </title>
<h1><?=$_GET['utdid']?>'s Update/Delete</h1>
<style>
	ol{
		list-style : none;
	}
</style>	
</head>
<body>

<form action="/member/utd_permission" method="post">
<ol>
<li>ID : <input type="text_box" id="LOGIN_ID" name="LOGIN_ID" value=<?=$_GET['utdid']?> readonly>
<?php foreach($utdmem as $utdmems) : ?>
<li>Admin permission : yes<input type="radio" id="AD" name="AD" value=1 <?php if($utdmems->AD==1){?>checked<?php }?>> no<input type="radio" id="AD" name="AD" value=0 <?php if($utdmems->AD!=1){?>checked <?php }?> ></li>

<li>Read permission : yes<input type="radio" id="RD" name="RD" value=1 <?php if($utdmems->RD==1){?> checked <?php }?>> no<input type="radio" id="RD" name="RD" value=0 <?php if($utdmems->RD!=1){?>checked<?php }?>></li>
<li>Write/Delete permission : yes<input type="radio" id="WD" name="WD" value=1 <?php if($utdmems->WD==1){?> checked <?php }?>> no<input type="radio" id="WD" name="WD" value=0 <?php if($utdmems->WD!=1){?> checked<?php } ?>></li>
<li><input type="submit" value="Updated">
</form>
<?php endforeach?>
</li>
</ol>
<ol>
<button onclick="location.href='/member/delete_?utdid=<?=$_GET['utdid']?>'">Delete</button>
</ol>
