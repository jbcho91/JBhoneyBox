<main>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="/clock/clk_mgr">Today Reports</a></li>
  <li role="presentation" class="active"><a href="/clock/clk_weekmgr">Update & Approval</a></li>
  <li role="presentation"><a href="/clock/clk_pay">Payroll</a></li>
</ul>
<h2>Clock Update & Approval</h2>
<script>
$(document).ready(function(){
	              $('#pickeddate').datepicker({
		                         onSelect : function (dateText, inst) {
						                                      $(this).parent('form').submit(); // <-- SUBMIT
										                                             }}).datepicker("option", "dateFormat", "yy-mm-dd");
					   });
</script>
<?php date_default_timezone_set("America/Los_Angeles");?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        google.charts.load("current", {packages:["timeline"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

		var container = document.getElementById('day_timetable');
		var chart = new google.visualization.Timeline(container);
		var dataTable = new google.visualization.DataTable();
		dataTable.addColumn({ type: 'string', id: 'Name' });
		dataTable.addColumn({ type: 'string', id: 'User' });
		dataTable.addColumn({ type: 'date', id: 'Start' });
		dataTable.addColumn({ type: 'date', id: 'End' });
		dataTable.addRows([
			[ '[User List]', 'Regular Time', new Date(0,0,0,9,0,0), new Date(0,0,0,12,0,0)],
			[ '[User List]', 'Regular Time', new Date(0,0,0,13,0,0), new Date(0,0,0,18,0,0)],
<?php
			foreach($allmgrclks as $allclk) :
				if($allclk->CLKOUTGP == NULL){ $allclk->CLKOUTGP = date("H,i",time());}?>
					     [ '<?=$allclk->USER_NAME?>', '<?=$allclk->USER_NAME?>', new Date(0,0,0,<?=$allclk->CLKINGP?>,0), new Date(0,0,0,<?=$allclk->CLKOUTGP?>,0) ],
<?php
                        endforeach;
	
			foreach($allmembers as $allmember){

				$IDext = 0;

	                	foreach($allmgrclks as $allclk){
					if($allmember->USER_NAME == $allclk->USER_NAME){
						$IDext=$IDext+1;
					}
				}

				if($IDext==0){?>
					['<?=$allmember->USER_NAME?>', '<?=$allmember->USER_NAME?>', new Date(0,0,0,8,0,0), new Date(0,0,0,8,0,0)],
<?php                   	}
                  	}

?>
                ]);


		var options = {

		timeline: { colorByRowLabel: true },
		backgroundColor: '#ffd'};
		chart.draw(dataTable, options);
	
      }

</script>
<script type="text/javascript">
	google.charts.load("current", {packages:["calendar"]});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var dataTable = new google.visualization.DataTable();
		dataTable.addColumn({ type: 'date', id: 'Date' });
		dataTable.addColumn({ type: 'number', id: 'Exist' });
		dataTable.addRows([
<?php 
			foreach($clkdates as $clkdate){

?>
				[ new Date('<?=$clkdate->YEAR_DATE?>'), 1],
<?php
				}
?>
		]);
												  
		var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

		var options = {

			height: 300,
		};

		chart.draw(dataTable, options);
	   }
</script>
<div class="table-responsive">
<div align=center>
<div id="calendar_basic" style="width: 800px; height: 200px;"></div>
</div>

<br>
<br>

<div align=center >
<table>
<tr>
<td>
<button onclick="window.open('/clock/clk_create', '_blanket','width=400, height=500'); return false" class="btn btn-success">Create Clock </button>
		<table class="table table-striped" style="border:solid">
		<thead>
                <tr>
                  <th>Name</th>
                  <th>Clock In - Out</th>
		  <th>Hour</th>
		  <th>Approved</th>
                </tr>
		</thead>
		<tbody>
                <tr>
<?php		foreach($allmgrclks as $loopclk){	
			$to_time = strtotime($loopclk->CLK_OUT);
			$from_time = strtotime($loopclk->CLK_IN);
			$clkhour = round(abs($to_time - $from_time)/3600,2);
			if($loopclk->CLK_OUT == null){
				$clkhour=0.00;
			}
?>			
			<td><?=$loopclk->USER_NAME?></td><td><?=$loopclk->CLK_IN?> - <?=$loopclk->CLK_OUT?></td><td><?=$clkhour?></td>
<?php				
			if($loopclk->APPROVED != NULL){ ?>
				<td>Approved</td>
<?php			}else{
?>
				<td><a href ="/clock/clk_utd?id_clk=<?=$loopclk->CLK_ID?>" onclick="window.open(this.href, '_blanket', 'width=400, height=500'); return false">No, Click Here</a></td>
<?php			} ?>
                </tr>
<?php		}
			
?>		</tbody>
		</table>
</td>
<td>
<div align=center>
<form id="frmDate" action="/clock/sw_weekmgr" method="POST">
Date : <input id = "pickeddate" name="pickeddate" type="text" />
</form>
</div>
<div id="day_timetable" style="height:rem; width:700px;"></div>
</td>
</tr>
</table>
</div>
</main>
