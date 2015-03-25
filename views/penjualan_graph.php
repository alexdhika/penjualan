        <script type="text/javascript">
            swfobject.embedSWF(
              "<? echo base_url(); ?>assets/swf/open-flash-chart.swf", "test_chart",
              "<?= $chart_width ?>", "<?= $chart_height ?>",
              "9.0.0", "expressInstall.swf",
              {"data-file":"<?= urlencode($data_url) ?>"},{"wmode" : "transparent"}
            );
        </script>
  		<center><div id="test_chart">&nbsp;</div>
		<br><br>
		<a style="color:#000000;font-weight:bold;">Total</a>
		&nbsp;
		<a style="color:#0055AD;font-weight:bold;">Ducas</a>
		&nbsp;
		<a style="color:#D67A84;font-weight:bold;">Dukos</a>
		&nbsp;
		<a style="color:#291C16;font-weight:bold;">Civeto</a>
		&nbsp;
		<a style="color:#640189;font-weight:bold;">Mesra</a>
		&nbsp;
		<a style="color:#007E1E;font-weight:bold;">Mikes</a>
		&nbsp;
		<a style="color:#5E0F13;font-weight:bold;">Laba</a>
		</center>

<?php
//include_once 'ofc-library/open_flash_chart_object.php';
//open_flash_chart_object( 450, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/open-flash-chart/gallery-data-13.php' );
?>

    </body>
</html>
