<?
foreach ($penjualan as $row){
	$id = $row->id;
	$nama = $row->nama;
	$tanggal = date('d-m-Y',strtotime($row->tanggal));
	$uraian = $row->uraian;
	$status = $row->status;
	$catatan_status = $row->catatan_status;
}

?>
<center>
<br>
<?echo form_open('penjualan/save_status');?>
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
			<td class="td-kecil">Status</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil">
				<select name="status">
					<option <? echo ($status==0?'SELECTED':''); ?> value="0">Normal</option>
					<option <? echo ($status==1?'SELECTED':''); ?> value="1">Belum Transfer ke Supplier</option>
					<option <? echo ($status==2?'SELECTED':''); ?> value="2">Batal/Refund</option>
					<option <? echo ($status==3?'SELECTED':''); ?> value="3">Bermasalah</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td-kecil">Catatan Status</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><textarea name="catatan_status" cols="50" rows="5"><? echo $catatan_status; ?></textarea></td>
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
