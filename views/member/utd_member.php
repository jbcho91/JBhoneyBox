<main>
<h2>Update & Delete Member</h2>
<table border = 1px width=500 height = 100 align = center >
<tr>
<td>ID</td><td>Email</td><td>Name</td>
</tr>
<?php foreach($members as $member) :?>
<tr>
<td><a href ="/member/update_?utdid=<?=$member->LOGIN_ID?>" onclick="window.open(this.href, '_blanck', 'width=400, height=500'); return false"><?=$member->LOGIN_ID?></a></td>
<td><?=$member->USER_EMAIL?></td><td><?=$member->USER_NAME?></td>
</tr>
<?php endforeach ?>
</table>
</main>
