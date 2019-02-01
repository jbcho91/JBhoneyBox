<main>
<h2><?php echo $this->session->userdata('USER_NAME');?>'s Timecard</h2>

<script>
  $(document).ready(function(){
            $('#pickeddate').datepicker({
                   onSelect : function (dateText, inst) {
                                     $(this).parent('form').submit(); // <-- SUBMIT
                                       }}).datepicker("option", "dateFormat", "yy-mm-dd");
  });

</script>

<form id="frmDate" action="/clock/sw_date" method="POST">
Date : <input id = "pickeddate" name="pickeddate" type="text" />
</form>
<br>
<div class="table-responsive">
<table class="table table-striped" style="border: solid;">
<thead>
<tr>
<th>Week</th><th>In/Out1</th><th>In/Out2</th><th>In/Out3</th><th>Hour</th><th>OverTime</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$dateadd=0;
$clkhour=0;
foreach($weekclks as $weekclk) :
	if($weekclk->WEEKNUM == 1)
        {
		if($dateadd<1){
?>              
	                <td>Mon, <?=$weekclk->CLK_DATE?> </td>

<?php		} ?>

<td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>

<?php 	
		$to_time = strtotime($weekclk->CLKOUT);
		$from_time = strtotime($weekclk->CLKIN);
		$clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);
		$dateadd=$dateadd+1;
	}
endforeach; 

if($dateadd>0 && 3>$dateadd){
	$arr_monadd = 3-$dateadd;
	for( $num=0 ; $num<$arr_monadd ; $num++){
?>
		<td>-</td>
<?php	}
	$clkovertime = $clkhour-8;
	if($clkovertime <= 0){
		$clkovertime=0.00;
	}

	if($clkhour <= 0){
		$clkhour=0.00;
		
	}
?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }

if($dateadd==0){?>

	<td>Mon</td>
<?php	for( $num=0; $num<5; $num++){?>
	<td>-</td>
<?php
	}
}
?>
</tr>
<tr>
<?php	
$dateadd=0; 
$clkhour=0;
foreach($weekclks as $weekclk) :
	if($weekclk->WEEKNUM == 2)
	{
		if($dateadd<1){
?>
			<td>Tue, <?=$weekclk->CLK_DATE?></td>


<?php	}?>
<td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>
<?php	
                $to_time = strtotime($weekclk->CLKOUT);
                $from_time = strtotime($weekclk->CLKIN);
                if($weekclk->CLKOUT==NULL){
                        $to_time=0;
                        $from_time=0;
                }

                $clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);

		$dateadd=$dateadd+1;
	}
	
endforeach;

if($dateadd>0 && 3>$dateadd){
        $arr_monadd = 3-$dateadd;
        for( $num=0 ; $num<$arr_monadd ; $num++){
?>
                <td>-</td>
<?php   }
        $clkovertime = $clkhour-8;
        if($clkovertime <= 0){
                $clkovertime=0.00;
        }

        if($clkhour <= 0){
                $clkhour=0.00;

        }
?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }

if($dateadd ==0){?>
        <td>Tue</td>
<?php   for( $num=0; $num<5; $num++){?>
        <td>-</td>
	
<?php
	}	
}
?>
</tr>

<tr>
<?php
$dateadd=0;
$clkhour=0;
foreach($weekclks as $weekclk) :
        if($weekclk->WEEKNUM == 3)
        {
                if($dateadd<1){
?>
                        <td>Wed, <?=$weekclk->CLK_DATE?> </td>

<?php           } ?>

                <td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>

<?php
                $to_time = strtotime($weekclk->CLKOUT);
                $from_time = strtotime($weekclk->CLKIN);
                if($weekclk->CLKOUT==NULL){
			$to_time=0;
			$from_time=0;
                }

                $clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);

                $dateadd=$dateadd+1;
        }
endforeach;

if($dateadd>0 && 3>$dateadd){
        $arr_monadd = 3-$dateadd;
        for( $num=0 ; $num<$arr_monadd ; $num++){
?>
                <td>-</td>
<?php   }
        $clkovertime = $clkhour-8;

        if($clkovertime <= 0){
                $clkovertime=0.00;
	}
        if($clkhour <= 0){
                $clkhour=0.00;

        }

?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }



if($dateadd==0){?>

        <td>Wed</td>
<?php   for( $num=0; $num<5; $num++){?>
        <td>-</td>
<?php
        }
}
?>
</tr>

<tr>
<?php
$dateadd=0;
$clkhour=0;
foreach($weekclks as $weekclk) :
        if($weekclk->WEEKNUM == 4)
        {
                if($dateadd<1){
?>
                        <td>Thu, <?=$weekclk->CLK_DATE?> </td>

<?php           } ?>

                <td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>


<?php
                $to_time = strtotime($weekclk->CLKOUT);
                $from_time = strtotime($weekclk->CLKIN);
                if($weekclk->CLKOUT==NULL){
                        $to_time=0;
                        $from_time=0;
                }

                $clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);

                $dateadd=$dateadd+1;
        }
endforeach;

if($dateadd>0 && 3>$dateadd){
        $arr_monadd = 3-$dateadd;
	for( $num=0 ; $num<$arr_monadd ; $num++){?>

                <td>-</td>
<?php   }

        $clkovertime = $clkhour-8;

        if($clkovertime <= 0){
                $clkovertime=0.00;
        }
        if($clkhour <= 0){
                $clkhour=0.00;

        }

?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }


if($dateadd==0){?>

        <td>Thu</td>
<?php   for( $num=0; $num<5; $num++){?>
        <td>-</td>
<?php
        }
}
?>
</tr>

<tr>
<?php
$dateadd=0;
$clkhour=0;
foreach($weekclks as $weekclk) :
        if($weekclk->WEEKNUM == 5)
        {
                if($dateadd<1){
?>
                        <td>Fri, <?=$weekclk->CLK_DATE?> </td>

<?php           } ?>

                <td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>


<?php
                $to_time = strtotime($weekclk->CLKOUT);
                $from_time = strtotime($weekclk->CLKIN);
                if($weekclk->CLKOUT==NULL){
                        $to_time=0;
                        $from_time=0;
                }

                $clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);

                $dateadd=$dateadd+1;
        }
endforeach;

if($dateadd>0 && 3>$dateadd){
        $arr_monadd = 3-$dateadd;
        for( $num=0 ; $num<$arr_monadd ; $num++){
?>
                <td>-</td>
<?php   }

        $clkovertime = $clkhour-8;

        if($clkovertime <= 0){
                $clkovertime=0.00;
        }
        if($clkhour <= 0){
                $clkhour=0.00;

        }

?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }

if($dateadd==0){?>

        <td>Fri</td>
<?php   for( $num=0; $num<5; $num++){?>
        <td>-</td>
<?php
        }
}
?>
</tr>

<tr>
<?php
$dateadd=0;
$clkhour=0;
foreach($weekclks as $weekclk) :
        if($weekclk->WEEKNUM == 6)
        {
                if($dateadd<1){
?>
                        <td>Sat, <?=$weekclk->CLK_DATE?> </td>

<?php           } ?>

                <td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>


<?php
                $to_time = strtotime($weekclk->CLKOUT);
                $from_time = strtotime($weekclk->CLKIN);
                if($weekclk->CLKOUT==NULL){
                        $to_time=0;
                        $from_time=0;
                }

                $clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);


                $dateadd=$dateadd+1;
        }
endforeach;

if($dateadd>0 && 3>$dateadd){
        $arr_monadd = 3-$dateadd;
        for( $num=0 ; $num<$arr_monadd ; $num++){
?>
                <td>-</td>
<?php   }


        $clkovertime = $clkhour-8;

        if($clkovertime <= 0){
                $clkovertime=0.00;
        }
        if($clkhour <= 0){
                $clkhour=0.00;

        }

?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }

if($dateadd==0){?>

        <td>Sat</td>
<?php   for( $num=0; $num<5; $num++){?>
        <td>-</td>
<?php
        }
}
?>
</tr>

<tr>
<?php
$dateadd=0;
$clkhour=0;
foreach($weekclks as $weekclk) :
        if($weekclk->WEEKNUM == 0)
        {
                if($dateadd<1){
?>
                        <td>Sun, <?=$weekclk->CLK_DATE?> </td>

<?php           } ?>

                <td><?=$weekclk->CLKIN?> - <?=$weekclk->CLKOUT?></td>


<?php
                $to_time = strtotime($weekclk->CLKOUT);
                $from_time = strtotime($weekclk->CLKIN);
                if($weekclk->CLKOUT==NULL){
                         $to_time=0;
                         $from_time=0;
                 }

                $clkhour = $clkhour + round(abs($to_time - $from_time)/3600,2);



                $dateadd=$dateadd+1;
        }
endforeach;

if($dateadd>0 && 3>$dateadd){
        $arr_monadd = 3-$dateadd;
        for( $num=0 ; $num<$arr_monadd ; $num++){
?>
                <td>-</td>
<?php   }


        $clkovertime = $clkhour-8;

        if($clkovertime <= 0){
                $clkovertime=0.00;
        }
        if($clkhour <= 0){
                $clkhour=0.00;

        }

?><td><?=$clkhour?></td><td><?=$clkovertime?></td>
<?php }


if($dateadd==0){?>

        <td>Sun</td>
<?php   for( $num=0; $num<5; $num++){?>
        <td>-</td>
<?php
        }
}
?>
</tr>
</tbody>
</table>
</div>
</main>
