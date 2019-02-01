<main>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="/clock/clk_mgr">Today Reports</a></li>
  <li role="presentation"><a href="/clock/clk_weekmgr">Update & Approval</a></li>
  <li role="presentation"><a href="/clock/clk_pay">Payroll</a></li>
</ul>
<ol>
<?php date_default_timezone_set("America/Los_Angeles");?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load("current", {packages:["timeline"]});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var container = document.getElementById('today_timetable');
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
			foreach($allclks as $allclk) : 
				if($allclk->CLKOUTGP == NULL){ $allclk->CLKOUTGP = date("H,i",time());}?>
					[ '<?=$allclk->USER_NAME?>', '<?=$allclk->USER_NAME?>', new Date(0,0,0,<?=$allclk->CLKINGP?>,0), new Date(0,0,0,<?=$allclk->CLKOUTGP?>,0) ],
<?php							
			endforeach;
	
			foreach($allmembers as $allmember){
				$IDext = 0;

				foreach($allclks as $allclk){
					if($allmember->USER_NAME == $allclk->USER_NAME){
						$IDext=$IDext+1;	
					}
				}

				if($IDext==0){?>
					['<?=$allmember->USER_NAME?>', '<?=$allmember->USER_NAME?>', new Date(0,0,0,8,0,0), new Date(0,0,0,8,0,0)],
<?php				}
			}
						
?>
		]);
	
		var options = {
		      timeline: { colorByRowLabel: true },
			            backgroundColor: '#ffd'};
			        chart.draw(dataTable, options);
			      }

</script>
<div align=center>
<table>
<tr>
<td>
<h2>Today's Timecard<h2>
<div id="today_timetable" style="height: rem; width: 700px; align=center"></div>
<script type="text/javascript">
	google.charts.load("current", {packages:["corechart"]});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {

		var data = google.visualization.arrayToDataTable([
		['Employee name', 'Clock'],
		['Sauronithoides (narrow-clawed lizard)', 08:03],
		['Seismosaurus (tremor lizard)', 09:03,
		['Spinosaurus (spiny lizard)', 08:20],
		['Velociraptor (swift robber)', 10:30]]);

        var options = {
          title: 'Today Lateness',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</td>
</tr>
<tr>
<td>
<h2>Today's attendee</h2>
<table class="table table-striped" style="test-align:center;">
<tbody>
<?php foreach($allmembers as $allmember){
$temp=0;
	foreach($allclks as $allclk){
		if($temp===0){
			if(($allmember->USER_NAME)===($allclk->USER_NAME)){
				$temp=$temp+1;
?>			
				<tr><td><?=$allmember->USER_NAME?></td></tr>

<?php			}
		}
	}
      }
?>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</main>

