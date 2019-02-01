<main>
<?php
date_default_timezone_set("America/Los_Angeles");

for($i=0;$i<6;$i++)
{
	$paynum[$i]['total']=0.00;
	$paynum[$i]['max_pay']=0.00;
	$paynum[$i]['min_pay']=0.00;
}
foreach($allpays as $pay){
	for($i=0;$i<6;$i++){
		if($pay->CLK_MON == date("Y/m",strtotime("-$i months"))){
			$paynum[$i]['total']=$paynum[$i]['total']+$pay->PAY;
			
			if($paynum[$i]['max_pay']<$pay->PAY){
				$paynum[$i]['max_pay']=$pay->PAY;
			}

			if($paynum[$i]['min_pay']==0){
				$paynum[$i]['min_pay']=$pay->PAY;
			}else{
				if($paynum[$i]['min_pay']>$pay->PAY){
					$paynum[$i]['min_pay']=$pay->PAY;
				}
			}
		}	
	}
};
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);
function drawVisualization() {
	// Some raw data (not necessarily accurate)
	var data = google.visualization.arrayToDataTable([		                       
		['Month', 'Total Pay', 'MinPay', 'MaxPay', 'Average Pay'],
<?php		for($temp=5;$temp>-1;$temp--){
?>
		['<?=date("Y/m",strtotime("-$temp months")); ?>' ,  <?=$paynum[$temp]['total']?>,      <?=$paynum[$temp]['min_pay']?>,         <?=$paynum[$temp]['max_pay']?>,        <?=($paynum[$temp]['min_pay']+$paynum[$temp]['max_pay'])/2 ?>],
<?php	}
?>
	]);
		    
	var options = {
		title : 'Monthly total payroll during recent 6 month',
			vAxis: {title: 'Total Pays'},
			hAxis: {title: 'Month'},
			seriesType: 'bars',
			series: {3: {type: 'line'}}
	};
		    

	var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));

	chart.draw(data, options);

}

$(function(){
        $( "#salutation" ).selectmenu();
});

$( function() {
	var dateFormat = "yy-mm-dd",

		from = $( "#from" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "+w",
			changeMonth: true,
			numberOfMonths: 3
		})

		.on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
		}),

		to = $( "#to" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "+w",
			changeMonth: true,
			numberOfMonths: 3
		})

		.on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
	        });
	       
		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}
				 
			return date;
		}
	        } );


</script>

<ul class="nav nav-tabs">
  <li role="presentation"><a href="/clock/clk_mgr">Today Reports</a></li>
  <li role="presentation"><a href="/clock/clk_weekmgr">Update & Approval</a></li>
  <li role="presentation" class="active"><a href="/clock/clk_pay">Payroll</a></li>
</ul>
<ol>
<div>
<h2>Payroll</h2>
<form id="clk_pay" action="/clock/sw_pay" method="POST">
<div align=left>
<table>
<tr>
<td>
<h4>Search Pay</h4>
</td>
</tr>
<tr>
<td>
<label for="date">1)Date:</label>
<input type="text" id="from" name="from">
<label for="from to">~</label>
<input type="text" id="to" name="to">
</td>
</tr>
<tr>
<td>
<label for="USER_NAME">2)Select a Name : </label>
    <select name="USER_NAME" id="USER_NAME">
        <option disabled selected> pick name</option>
<?php
        foreach($memlists as $memlist){ ?>
		                <option><?=$memlist->USER_NAME?></option>
<?php
		        }
?>
	</select>
</td>
</tr>
<tr>
<td>
<button type="submit" class="btn btn-primary">Search</button>
</td>
</tr>
</table>
</div>
</form>
<br>
<div class="table-responsive">
	<table class="table table-striped">
	<thead>
	<tr>
	<th>Date</th>	
	<th>Name</th>
        <th>Hour</th>
        <th>Over Time</th>
        <th>Pay</th>
        </tr>
        </thead>

	<tbody>
<?php	foreach($paylists as $pay) : ?>
	<tr>
	<td><?=$pay->CLK_DATE?></td>
	<td><?=$pay->USER_NAME?></td>
	<td><?=$pay->CLK_TOTAL?></td>
	<td><?=$pay->CLK_OVERTIME?></td>
	<td><?=$pay->PAY?></td>
	</tr>
<?php	endforeach;	?>
	</tbody>
	<tfoot>
	<tr>
	<th colspan="5"><?=$pagination;?></th>
	</tr>
	</tfoot>
        </table>
</div>
<table>
<tr>
<td>
<div class="table-responsive" align=center><div id="chart_div" style="width: 900px; height: 500px;"></div>
</div>
</td>
<td>
</td>
</tr>
</table>
</div>
</main>

