<script>
	$(function() {
		$( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy', autoSize: true, disabled: true, showOtherMonths: true, selectOtherMonths: true });
		$( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy', autoSize: true, disabled: true, showOtherMonths: true, selectOtherMonths: true });
	});
</script>
<? echo form_open('penjualan/graph', array('method' => 'get'));?>
<?
	$tgl1 = $this->input->get('tgl1');
	$tgl2 = $this->input->get('tgl2');
	$tgl1 = (empty($tgl1)?'1-' . date('m-Y'):$tgl1);
	$tgl2 = (empty($tgl2)?date('d-m-Y'):$tgl2);
	$tgl1 = date('d-m-Y',strtotime($tgl1));
	$tgl2 = date('d-m-Y',strtotime($tgl2));
	$website = $this->input->get('website');
?>
<center style="margin-top:5px;margin-bottom:5px;">
<h1>GRAFIK PENJUALAN</h1>
	Tanggal : <input id="datepicker1" name="tgl1" value="<? echo $tgl1; ?>"> sd <input id="datepicker2" name="tgl2" value="<? echo $tgl2; ?>">
				<input type="submit" value="Filter">
</center>
<? echo form_close(); ?>
