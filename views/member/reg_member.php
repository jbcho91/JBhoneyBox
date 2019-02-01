<main>
<h2>Create New Account</h2>
<br>
    <?php echo validation_errors(); ?>
	<table align = "center">
	<form action="/member/reg_member" method="post">
	<tr>
	<td>ID :</td><td> <input type="text" id="LOGIN_ID" name="LOGIN_ID" value="<?php echo set_value('LOGIN_ID'); ?>" placeholder="ID"></td>
	</tr>
	<tr>
	<td>Password :</td><td> <input type="password" id="PASSWORD" name="PASSWORD" value="<?php echo set_value('PASSOWRD'); ?>" placeholder="********"></td>
	</tr>
	<tr>	
	<td>Verify-Password :</td><td> <input type="password" id="re_password" name="re_password" value="<?php echo set_value('re_password'); ?>" placeholder="********"></td>
	</tr>
	<tr>
	<td> Name :</td><td><input type="text" id ="USER_NAME" name="USER_NAME" value="<?php echo set_value('USER_NAME'); ?>"placeholder="name"></td>
	</tr>
	<tr>
	<td> Email :</td><td><input type="text" id="USER_EMAIL" name="USER_EMAIL" value="<?php echo set_value('USER_EMAIL'); ?>" placeholder="abcd@abcd.com"></td>
	</tr>
	<tr>
	<td>Admin permission :</td><td><input type="checkbox" id="AD" name="AD" value="1" <?php echo set_checkbox('AD');?>></td>
	</tr>
	<tr>
	<td>Read permission :</td><td><input type="checkbox" id="RD" name="RD" value="1" <?php echo set_checkbox('RD');?>></td>
	</tr>
	<tr>
	<td>Write/Delete permission :</td><td><input type="checkbox" id="WD" name="WD" value=1 <?php echo set_checkbox('WD');?>></td>
	</tr>
	</table>
	<br>
	<button type="submit" class="btn btn-default">Join</button>
        </form>
</main>
