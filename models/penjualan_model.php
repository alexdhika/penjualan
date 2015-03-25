<?
	class Penjualan_model extends CI_Model {

		function __construct()
		{
		    parent::__construct();
		}

		function save(){
			$data = array( 
				'id_pbk' => $this->input->post('nama'),
				'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'uraian' => $this->input->post('uraian'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_penerima' => $this->input->post('nama_penerima'),
				'alamat_penerima' => $this->input->post('alamat_penerima'),
				'notelp_penerima' => $this->input->post('notelp_penerima'),
				'id_web' => $this->input->post('website'),
				'harga_beli' => $this->input->post('harga_beli'),
				'biaya' => $this->input->post('biaya'),
				'harga_jual' => $this->input->post('harga_jual'),
				'id_supplier' => $this->input->post('supplier'),
				'bank' => $this->input->post('bank'),
				);
			$id = $this->input->post('id');
			if (!empty($id)){
				$this->db->where('id', $id);
				$this->db->update('penjualan', $data); 
			} else {
				return $this->db->insert('penjualan', $data);
			}
		}

		function save_status(){
			$data = array( 
				'status' => $this->input->post('status'),
				'catatan_status' => $this->input->post('catatan_status'),
				);
			$id = $this->input->post('id');

			$this->db->where('id', $id);
			$this->db->update('penjualan', $data); 
		}

		function save_kualitas(){
			$data = array( 
				'kualitas_transaksi' => $this->input->post('kualitas')
				);
			$id = $this->input->post('id');

			$this->db->where('id', $id);
			$this->db->update('penjualan', $data); 
		}

		function save_ref(){
			$data = array( 
				'ref' => $this->input->post('ref'),
				'ref_ket' => $this->input->post('ref_ket')
				);
			$id = $this->input->post('id');

			$this->db->where('id', $id);
			$this->db->update('penjualan', $data); 
		}

		function save_resi(){
			$data = array( 
				'ekspedisi' => $this->input->post('ekspedisi'),
				'no_resi' => $this->input->post('no_resi'),
				);
			$id = $this->input->post('id');

			$this->db->where('id', $id);
			$this->db->update('penjualan', $data); 
		}

		function edit($id){
			$query = $this->db->query("select j.*,p.ID,p.Name as nama,p.Address as alamat from penjualan j, pbk p where j.id_pbk=p.ID and j.id=" .$id);
			return $query->result();
		}

		function getDetail($id){
			$query = $this->db->query("select j.*,p.ID,p.Name as nama,p.Address as alamat,p.Number as nomer,j.status as status,j.catatan_status as catatan_status from penjualan j, pbk p where j.id_pbk=p.ID and j.id=" .$id);
			return $query->result();
		}

		function get_total_search($q){
			$jumlah = $this->browse('',$q,true);
			return $jumlah;
		}

		function browse($page,$q,$total){
			$q = $this->db->escape_like_str($q);

			if (empty($q)){
				$tgl1 = $this->input->get('tgl1');
				$tgl2 = $this->input->get('tgl2');
				$tgl1 = (empty($tgl1)?'1-' . date('m-Y'):$tgl1);
				$tgl2 = (empty($tgl2)?date('d-m-Y'):$tgl2);
				$tgl1 = date('Y-m-d',strtotime($tgl1));
				$tgl2 = date('Y-m-d',strtotime($tgl2));

				$website = $this->input->get('web');
				$bank = $this->input->get('bank');
				$website = implode(',',$website);
				if (!empty($website)){
					$filter_website = " and j.id_web in (" .$website. ") ";
				}

				if (!empty($bank)){
					$filter_bank = " and j.bank = " . $bank;
				}

				$sql2 = "where j.tanggal between '" .$tgl1. "' and '" .$tgl2. "' " .$filter_website. " " . $filter_bank ;
				$sql3 = " and j.deleted!=1 order by j.tanggal,j.id";
			} else {
				$nStart = ($page-1) * 50;
				$sql2 = "where p.Name like '%" .$q. "%' or p.Address like '%" .$q. "%' 
					or p.Number like '%" .$q. "%' or j.catatan_status like '%" .$q. "%' 
					or j.uraian like '%" .$q. "%' or j.keterangan like '%" .$q. "%' 
					or j.nama_penerima like '%" .$q. "%' or j.alamat_penerima like '%" .$q. "%' 
					or j.notelp_penerima like '%" .$q. "%' ";
				if (empty($page)){ // untuk menghitung total //
					$sql3 = " and j.deleted!=1 order by j.tanggal desc ,j.id";
				} else {
					$sql3 = " and j.deleted!=1 order by j.tanggal desc ,j.id limit " .$nStart. ",50";
				}
			}

			$sql1 = "select j.*,p.Name as nama,p.Address as alamat,p.Number as nomer,j.status as status,j.catatan_status as catatan_status,
				j.bank as penjualan_bank, rk.ID as id_bank,rk.bank,rk.warna,rk.norek_cantik,rk.atas_nama from penjualan j 
				left join pbk p on j.id_pbk=p.ID 
				left join bank_rekening rk on j.bank = rk.ID ";


			
			$sql = $sql1 . $sql2 . $sql3;
			
			$query = $this->db->query($sql);

			if ($total){
				return $query->num_rows();
			} else {
				return $query->result();
			}
		}

		function get_penjualan_customer_care($tgl,$ke){
			$sql = "select k.Panggilan as panggilan,k.Number as nomer,k.Name as nama,j.id as id_penjualan,j.uraian,j.id_web,w.web 
				from penjualan j left join pbk k on j.id_pbk=k.ID
				left join website w on j.id_web=w.ID
				where j.tanggal='" .$tgl. "' and j.status=0 and j.customer_care_sms < " .$ke;
			$query = $this->db->query($sql);
			return $query->result();
		}

		function generate(){
			$cek = $this->input->get('cek');
			$cek = implode(',',$cek);
			$sql = "select j.*,p.Name as nama,p.Address as alamat,p.Number as nomer,w.singkatan,s.bNumber from penjualan j 
				left join pbk p on j.id_pbk=p.ID 
				left join website w on j.id_web = w.ID
				left join sms_center s on w.id_sms_center = s.ID
				where j.id in (" .$cek. ") and j.deleted!=1 order by j.id ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_resi($id){
			$sql = "select j.*,p.ID,p.Name as nama,p.Number as nomer, p.Address as alamat, w.id_sms_center from penjualan j 
			left join pbk p on j.id_pbk=p.ID 
			left join website w on j.id_web=w.ID 
			where j.id=" .$id;
			$query = $this->db->query($sql);
			return $query->result();
		}

		function upd_resi($id){
			$query = $this->db->query("update penjualan set kirim_resi=1 where id=" .$id);
			return $query->result();
		}

		function graph($tgl1,$tgl2){
			$sql = "select tanggal,(sum(harga_jual) - sum(biaya) - sum(harga_beli)) as laba,(sum(harga_jual)) as max, sum(if(website='www.duniacasio.com',harga_jual,0)) as ducas, sum(if(website='www.duniakosmetik.com',harga_jual,0)) as dukos, sum(if(website='www.mesinraya.com',harga_jual,0)) as mesra, sum(if(website='www.civeto.com',harga_jual,0)) as civeto, sum(if(website='www.mitrakesehatan.com',harga_jual,0)) as mikes from penjualan where tanggal between '" .$tgl1. "' and '" .$tgl2. "' and deleted!=1 group by tanggal order by tanggal";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_total_omset($m,$y){
			if (empty($m)){
				$m =  date('m');
			}

			if (empty($y)){
				$y =  date('Y');
			}


			$sql = "select sum(harga_jual) as omset from penjualan where month(tanggal) = '" .$m. "' and year(tanggal)='" .$y. "' and status=0";
			$query = $this->db->query($sql);
			$data = $query->result();
			foreach($data as $row){
				$omset = $row->omset;
			}
			return $omset;
		}
	}
?>
