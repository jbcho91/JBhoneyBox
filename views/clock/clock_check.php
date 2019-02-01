<main>
<h3><?php echo $this->session->userdata('USER_NAME');?>'s Clock Today </h3>
<table class="table table-striped" style="text-align:center">
<tr>
</tr>
<tr>
<?php foreach($memclks as $memclk) :?>
<td>Clock In</td><td><?=$memclk->CLK_IN?></td>
</tr>
<tr>
<td>Clock Out</td><td><?=$memclk->CLK_OUT?></td>
</tr>
<?php endforeach ?>
<table align = center>
<tr><td>
<form action="/clock/clkin_add" method="post">
<button type="submit" class="btn btn-primary btn-lg" id=clk_in>Clock In</button></td><td>
</form>
<form action="/clock/clkout_add" method="post">
<button type="submit" class="btn btn-primary btn-lg" id=clk_out>Clock Out</button></td>
</form>
</tr>
</table>
</main>

