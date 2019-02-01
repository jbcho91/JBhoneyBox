</div>
</div>
<footer>
<nav class="navbar navbar-inverse navbar-fixed-bottom">
<div class="container">
<div class="navbar-header">
</div>
<table>
<tr>
<td style="font color=white">
<?php if($this->session->userdata('is_login')){
	$USER_NAME = $this->session->userdata('USER_NAME');
	echo "<font color=#FCFCFC>";
	echo "UserName : ".$USER_NAME;
	echo "</font>";
	
?>	
</td>
</tr>
<tr>
<td>
<a href="/member/logout">Log_out
</td>
<?php
	}else{
		$this->load->helper('url');
		redirect('/');	
	}
?>
</tr>
</table>
</div>
</nav>
</footer>
</div>
</body>
</html>
