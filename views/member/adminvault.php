<main>
<h2>Member List</h2>
<table border = 1px width=500 height = 100 align = center>
<tr>
<td>ID</td><td>Email</td><td>NAME</td>
<tr>
<?php foreach($members as $member) :?>
</tr>
<tr>
<td><?=$member->LOGIN_ID?></td><td><?=$member->USER_EMAIL?></td><td><?=$member->USER_NAME?></td>
</tr>
<?php endforeach ?>
</table>
</main>


