	<h1>World Time</h1>
	<p class="lead">
	<ul style="list-style : none;">

        <li>
        LA : <?php
                date_default_timezone_set("America/Los_Angeles");
                echo(date("Y/m/d H:i",time()));
                ?>
        </li>
        <li>
        Seoul : <?php
                date_default_timezone_set("Asia/Seoul");
                echo(date("Y/m/d H:i",time()));
                ?>
        </li>
        <li>
        NY : <?php
                date_default_timezone_set("America/New_York");
                echo(date("Y/m/d H:i",time()));
                ?>
        </li>
        </ul>

	</p>
