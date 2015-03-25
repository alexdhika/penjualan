<?

foreach ($penjualan as $row){
	$id = $row->id;
	$id_pbk = $row->id_pbk;
	$nama = $row->nama;
	$tanggal = date('d-m-Y',strtotime($row->tanggal));
	$alamat = $row->alamat;
	$uraian = $row->uraian;
	$keterangan = $row->keterangan;
	$nama_penerima = $row->nama_penerima;
	$alamat_penerima = $row->alamat_penerima;
	$notelp_penerima = $row->notelp_penerima;
	$id_web = $row->id_web;
	$website = $row->website;
	$ekspedisi = $row->ekspedisi;
	$no_resi = $row->no_resi;
	$harga_beli = $row->harga_beli;
	$biaya = $row->biaya;
	$harga_jual = $row->harga_jual;
	$id_supplier = $row->id_supplier;
	$kirim_resi = $row->kirim_resi;
	$bank = $row->bank;
}

foreach ($pbk_init as $row){
	$id_pbk = $row->ID;
	$nama = $row->Name;
	$alamat = $row->Address;
}

if ($kirim_resi){
	return;
}
?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#nama_pembeli").tokenInput("<?php echo site_url('penjualan/getphonebook');?>", {
			hintText:"Type name from your contacts",
			tokenLimit:1,
			noResultsText:"No results",
			searchingText: "Searching...",
			<?php
				// untuk edit //
				if (!empty($id) || !empty($pbk_init)){
					echo "prePopulate: [ 
					{name:'" .addslashes($nama). " : " .addslashes($alamat). "', id:'" .$id_pbk. "'}
					],";
				}
			?>
			method: "GET",
			minChars : 4,
		        classes: {
		            tokenList: "token-input-list-facebook",
		            token: "token-input-token-facebook",
		            tokenDelete: "token-input-delete-token-facebook",
		            selectedToken: "token-input-selected-token-facebook",
		            highlightedToken: "token-input-highlighted-token-facebook",
		            dropdown: "token-input-dropdown-facebook",
		            dropdownItem: "token-input-dropdown-item-facebook",
		            dropdownItem2: "token-input-dropdown-item2-facebook",
		            selectedDropdownItem: "token-input-selected-dropdown-item-facebook",
		            inputToken: "token-input-input-token-facebook"
		        }

		    });
	});
</script>
<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy', autoSize: true, disabled: true });
	});
</script>
<center>
<br>
<?php echo validation_errors(); ?>
<?php //echo $this->form_validation->error_string; ?>
<?echo form_open('penjualan/save');?>
	<table border="0" width=700>
		<tr>
			<td class="td-head" colspan="3">Form Penjualan</td>
		</tr>
		<tr>
			<td class="td-kecil">Nama Pembeli</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="nama" id="nama_pembeli"></td>
		</tr>
		<tr>
			<td class="td-kecil">Tanggal</td>
			<td class="td-kecil">:</td>
			<?
				if (!empty($id)){
					echo '<td class="td-kecil"><input id="datepicker" name="tanggal" value="' .$tanggal. '"></td>';
				} else {
					echo '<td class="td-kecil"><input id="datepicker" name="tanggal" value="' .date('d-m-Y'). '"></td>';
				}
			?>
		</tr>
		<tr>
			<td class="td-kecil">Uraian</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="uraian" value="<? echo $uraian; ?>" size="70px"></td>
		</tr>
		<tr>
			<td class="td-kecil">Keterangan</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="keterangan" value="<? echo $keterangan; ?>" size="70px"></td>
		</tr>
		<tr bgcolor="#FFF9CD">
			<td class="td-kecil" colspan="3">Catatan : Kosongkan "Nama Penerima", "Alamat Penerima" dan "No Telp Penerima" jika penerima sama seperti data di phonebook </td>
		</tr>
		<tr bgcolor="#FFF9CD">
			<td class="td-kecil">Nama Penerima</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="nama_penerima" value="<? echo $nama_penerima; ?>" size="70px"></td>
		</tr>
		<tr bgcolor="#FFF9CD">
			<td class="td-kecil">Alamat Penerima</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="alamat_penerima" value="<? echo $alamat_penerima; ?>" size="70px"></td>
		</tr>
		<tr bgcolor="#FFF9CD">
			<td class="td-kecil">No Telp Penerima</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="notelp_penerima" value="<? echo $notelp_penerima; ?>" size="70px"></td>
		</tr>
		<tr>
			<td class="td-kecil">Website</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil">
				<select name="website">
					<?php
						foreach ($all_web as $row){
							echo '<option ' .($id_web==$row->ID?'SELECTED':''). ' value="' .$row->ID. '">' .$row->web. '</option>';
						}
					?>
				</select>
			</td>
		</tr>
<!--
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
				</select>
			</td>
		</tr>
		<tr>
			<td class="td-kecil">No. Resi</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="no_resi" value="<? echo $no_resi; ?>"></td>
		</tr>
-->
		<tr>
			<td class="td-kecil">Harga Beli</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="harga_beli" class="angka" value="<? echo $harga_beli; ?>"></td>
		</tr>
		<tr>
			<td class="td-kecil">Biaya</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="biaya" class="angka" value="<? echo $biaya; ?>"></td>
		</tr>
		<tr>
			<td class="td-kecil">Harga Jual / TT</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><input name="harga_jual" class="angka" value="<? echo $harga_jual; ?>"> / 
				<select name="bank">
					<option <? echo ($bank==0?'SELECTED':''); ?> value="-1">Tunai</option>
					<?php
						foreach ($list_bank as $row){
							echo '<option ' .($bank==$row->ID?'SELECTED':''). ' value="' .$row->ID. '">' .$row->bank . ' (' .$row->norek_cantik .') : '. $row->atas_nama . '</option>';
						}
					?>
                                        <option <? echo ($bank==100?'SELECTED':''); ?> value="100">Transaksi Di Supplier</option>


				</select>
			</td>
		</tr>
		<tr>
			<td class="td-kecil">Supplier</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><select name="supplier">
				<?
					foreach ($supplier as $row){
						echo '<option '.($id_supplier==$row->ID?'SELECTED':''). ' value="' .$row->ID. '">' .$row->Name. '</option>';
					}
				?>
				</select>
			</td>
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

<br>
<br>
<br>
