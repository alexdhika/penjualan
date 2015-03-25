<?
foreach ($penjualan as $row){
	$id = $row->id;
	$nama = $row->nama;
	$tanggal = date('d-m-Y',strtotime($row->tanggal));
	$uraian = $row->uraian;
	$ref = $row->ref;
	$ref_ket = $row->ref_ket;
}

$a_ref = 
	array (
		array('0','None'),
		array('1','Search Engine (Google, Bing, Yahoo'),
		array('2','Website'),
		array('3','Iklan Gratis'),
		array('4','Web Partner (Review, Komentar)'),
		array('5','Sosial Media (FB, Twitter, BBM)'),
		array('6','Referensi dari orang sekitar (Teman, Saudara Dll)'),
		array('7','Pelanggan Lama'),
		array('8','Sapaan Otomatis Dari Customer Service')
	)
?>
<center>
<br>
<?echo form_open('penjualan/save_ref');?>
	<table border="0" width=600>
		<tr>
			<td class="td-head" colspan="3">Index Kualitas Transaksi</td>
		</tr>
		<tr>
			<td class="td-kecil">Nama Konsumen</td>
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
			<td class="td-kecil" colspan="3">
				<table width="100%" cellspacing="5">
				<?php
					for ($i=0;$i<count($a_ref);$i++){
						$val = $a_ref[$i][0];
						$text = $a_ref[$i][1];
						$ch = ($ref==$val?' checked ':'');
						echo '<tr>
							<td><input type="radio" name="ref" value="' .$val. '" id="' .$val. '" ' .$ch. '></td>
							<td><label for="' .$val. '">' .$text. ' (<b>' .$val. '</b>)</label></td>
						</tr>';
					}
				?>
				</table>

			</td>
		</tr>
		<tr>
			<td class="td-kecil">Keterangan</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><textarea cols="50" rows="7" name="ref_ket"><? echo $ref_ket; ?></textarea></td>
		</tr>
		<tr>
			<td class="td-kecil" colspan="3" style="text-align:center;"><input type="submit" value="Simpan"></td>
		</tr>

	</table>
<?
	if (!empty($id)){
		echo '<input type="hidden" name="id" value="' .$id. '">';
	}
?>
<? echo form_close(); ?>
</center>
<br><br><br><br><br>
