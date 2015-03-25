<?
foreach ($penjualan as $row){
	$id = $row->id;
	$nama = $row->nama;
	$tanggal = date('d-m-Y',strtotime($row->tanggal));
	$uraian = $row->uraian;
	$ekspedisi = $row->ekspedisi;
	$no_resi = $row->no_resi;
	$kirim_resi = $row->kirim_resi;
}

if ($kirim_resi){
	return;
}
?>
<center>
<br>
<?echo form_open('penjualan/save_resi');?>
	<table border="0" width=600>
		<tr>
			<td class="td-head" colspan="3">Status Penjualan</td>
		</tr>
		<tr>
			<td class="td-kecil">Nama Pembeli</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><? echo $nama; ?></td>
		</tr>
		<tr>
			<td class="td-kecil">Tanggal</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><? echo $tanggal; ?></td>
		</tr>
		<tr>
			<td class="td-kecil">Uraian</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><? echo $uraian; ?></td>
		</tr>
		<tr>
			<td class="td-kecil">Ekspedisi</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil">
				<select name="ekspedisi">
					<option <? echo ($ekspedisi=='COD'?'SELECTED':''); ?> value="COD">COD</option>
					<option <? echo ($ekspedisi=='JNE'?'SELECTED':''); ?> value="JNE">JNE</option>
					<option <? echo ($ekspedisi=='Tiki'?'SELECTED':''); ?> value="Tiki">Tiki</option>
					<option <? echo ($ekspedisi=='POS Indonesia'?'SELECTED':''); ?> value="POS Indonesia">POS Indonesia</option>
					<option <? echo ($ekspedisi=='Pandu Logistcs'?'SELECTED':''); ?> value="Pandu Logistcs">Pandu Logistcs</option>
					<option <? echo ($ekspedisi=='Wahana'?'SELECTED':''); ?> value="Wahana">Wahana</option>
					<option <? echo ($ekspedisi=='PCP'?'SELECTED':''); ?> value="PCP">PCP</option>
					<option <? echo ($ekspedisi=='FedEx'?'SELECTED':''); ?> value="FedEx">FedEx</option>
					<option <? echo ($ekspedisi=='Pahala Kencana'?'SELECTED':''); ?> value="Pahala Kencana">Pahala Kencana</option>
                                        <option <? echo ($ekspedisi=='Dakota'?'SELECTED':''); ?> value="Dakota">Dakota</option>
                                        <option <? echo ($ekspedisi=='BSA'?'SELECTED':''); ?> value="BSA">BSA</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td-kecil">No. Resi</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="no_resi" size="50px" value="<? echo $no_resi; ?>"></td>
		</tr>
		<tr>
			<td class="td-kecil">&nbsp;</td>
			<td class="td-kecil">&nbsp;</td>
			<td class="td-kecil"><input type="submit" value="Simpan"></td>
		</tr>

	</table>
<?
	if (!empty($id)){
		echo '<input type="hidden" name="id" value="' .$id. '">';
	}
?>
<? echo form_close(); ?>
</center>
