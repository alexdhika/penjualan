<script>
	$(function() {
		$( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy', autoSize: true, disabled: true, showOtherMonths: true, selectOtherMonths: true });
		$( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy', autoSize: true, disabled: true, showOtherMonths: true, selectOtherMonths: true });
	});
</script>
<? echo form_open('penjualan/browse', array('method' => 'get'));?>
<?
	$tgl1 = $this->input->get('tgl1');
	$tgl2 = $this->input->get('tgl2');
	$tgl1 = (empty($tgl1)?'1-' . date('m-Y'):$tgl1);
	$tgl2 = (empty($tgl2)?date('d-m-Y'):$tgl2);
	$tgl1 = date('d-m-Y',strtotime($tgl1));
	$tgl2 = date('d-m-Y',strtotime($tgl2));
	$tim = $this->input->get('tim');
	$web = $this->input->get('web');
?>
<center style="margin-top:5px;margin-bottom:5px;">
<h1>PENJUALAN</h1>

<?php
	$start_id_tim = 0;
	$current_id_tim = 0;
	echo '<table style="margin-bottom:5px;">';
	foreach ($all_web as $row){
		if ($row->id_tim != $current_id_tim){
			if ($current_id_tim != $start_id_tim){
				echo '</tr>';
			}
			$i = 0;
			$awal_seleksi = 'w' . $row->id_tim . 't' ;
			// TIM //
			$val_tim = array_search($row->nama_tim,$tim);
			if ($val_tim === false){
				$c_val = '';
			} else {
				$c_val = 'checked';
			}

			echo '<tr class="' .(empty($c_val)?'tr-normal':'tr-checked'). '" id="tr' .$row->nama_tim. '">';
			echo '<td class="td-head" style="text-align:left;">
				<input type="checkbox" id="' .$row->nama_tim. '" value="' .$row->nama_tim. '" name="tim[]" 
				onchange="
					warna(this.checked,\'tr' .$row->nama_tim. '\',\'td-normal\');
					seleksi(this.checked,10,\'' .$awal_seleksi. '\');"
					' .$c_val. '>';
			echo '<label style="cursor:pointer;font-weight:bold;color:white;" for = "' .$row->nama_tim. '">' .$row->nama_tim. '</label></td>';
		}
		$current_id_tim = $row->id_tim;
		$i += 1;
		$id_cek = 'w' . $row->id_tim . 't' . $i ;
		// WEB //
		$val_web = array_search($row->ID,$web);
		if ($val_web === false){
			$c_val = '';
		} else {
			$c_val = 'checked';
		}
		echo '<td class="td-kecil"><input type="checkbox" name="web[]" id="' .$id_cek.  '" value="' .$row->ID. '" onchange="" ' .$c_val. '>';
		echo '<label style="cursor:pointer" for = "' .$id_cek. '">' .$row->web. '</label></td>';
	}
	echo '</tr></table>';
	$i = 0;
?>
Tanggal : <input id="datepicker1" name="tgl1" value="<? echo $tgl1; ?>"> sd <input id="datepicker2" name="tgl2" value="<? echo $tgl2; ?>">
<input type="submit" value="Filter">
<?php

?>
</center>
<? echo form_close(); ?>
