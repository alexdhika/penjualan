<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('my_view');
		$this->load->helper('my_date');
	}

	function index(){
		redirect('penjualan/browse');
	}

	function form($id=0,$id_pbk)
	{
		get_ref();
		$this->form_validation->set_rules('uraian', 'uraian', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->model('supplier/Supplier_model');
			$this->load->model('Penjualan_model');
			$this->load->model('bank/Bank_model');

			$data['include_css'] = jquery_css_core() . '<link rel="stylesheet" href="' .base_url(). 'assets/css/token-input-facebook.css" type="text/css" />';

			$data['include_js'] = jquery_js_core() . 
				'<script src="' .base_url(). 'assets/js/jquery.tokeninput.js"></script>';

			$data['title'] = 'Input Penjualan';
			$data['supplier'] = $this->Supplier_model->browse();
			$data['all_web'] = $this->Pengguna_model->getAllWebsite_SortWeb();
			$this->load->view('main/header.php',$data);

			if (!empty($id_pbk)){
				$this->load->model('kontak/Kontak_model');
				$data['pbk_init'] = $this->Kontak_model->get_kontak($id_pbk);
			}

			if (empty($id)){
				$data['list_bank'] = $this->Bank_model->get_list_bank();
				$this->load->view('penjualan/penjualan_form.php',$data);	
			} else {
				$data['list_bank'] = $this->Bank_model->get_list_bank();
				$data['penjualan'] = $this->Penjualan_model->edit($id);
				$this->load->view('penjualan/penjualan_form.php',$data);
			}
			$this->load->view('footer',$data);
		} else {
			redir_ref();
			//redirect('penjualan/browse');
		}
	}

	function save($id=0)
	{
		$rules = array(
			array(
			     'field'   => 'nama', 
			     'label'   => 'Nama', 
			     'rules'   => 'required'
			  ),
			array(
			     'field'   => 'harga_jual', 
			     'label'   => 'Harga Jual', 
			     'rules'   => 'required'
			  ),
			array(
			     'field'   => 'uraian', 
			     'label'   => 'Uraian', 
			     'rules'   => 'required'
			  )
			);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('penjualan/penjualan_form.php');
		} else {
			$this->load->model('Penjualan_model');

			$this->Penjualan_model->save();
			redir_ref();
		}
	}

	function browse(){
		$this->load->model('Penjualan_model');
                $this->load->model('kontak/Kontak_model');

		$data['include_css'] = jquery_css_core();
		$data['include_js'] = jquery_js_core();

		$data['title'] = 'Browse Penjualan';
		$this->load->view('main/header.php',$data);
		$data['all_web'] = $this->Pengguna_model->getAllWebsite();
		$this->load->view('penjualan/penjualan_filter',$data);
		$data['penjualan'] = $this->Penjualan_model->browse();
		
		$data['jml_pbk_new'] = $this->Kontak_model->get_new_kontak();
		$this->load->view('penjualan/penjualan_browse',$data);
		$this->load->view('footer',$data);
	}


	function edit_status($id)
	{
		if (empty($id)){
			return;
		}

		get_ref();
		$this->load->model('Penjualan_model');

		$data['title'] = 'Edit Status Penjualan';
		$this->load->view('main/header.php',$data);

		$data['penjualan'] = $this->Penjualan_model->edit($id);
		$this->load->view('penjualan/edit_status.php',$data);

		$this->load->view('footer',$data);
	}

	function edit_kualitas($id)
	{
		if (empty($id)){
			return;
		}

		get_ref();
		$this->load->model('Penjualan_model');

		$data['title'] = 'Kualitas Transaksi';
		$this->load->view('main/header.php',$data);

		$data['penjualan'] = $this->Penjualan_model->edit($id);
		$this->load->view('penjualan/edit_kualitas.php',$data);

		$this->load->view('footer',$data);
	}

	function edit_ref($id)
	{
		if (empty($id)){
			return;
		}

		get_ref();
		$this->load->model('Penjualan_model');

		$data['title'] = 'Referensi Transaksi';
		$this->load->view('main/header.php',$data);

		$data['penjualan'] = $this->Penjualan_model->edit($id);
		$this->load->view('penjualan/edit_ref.php',$data);

		$this->load->view('footer',$data);
	}

	function save_status()
	{
		$this->load->model('Penjualan_model');
		$this->Penjualan_model->save_status();
		redir_ref();
	}

	function save_kualitas()
	{
		$this->load->model('Penjualan_model');
		$this->Penjualan_model->save_kualitas();
		redir_ref();
	}

	function save_ref()
	{
		$this->load->model('Penjualan_model');
		$this->Penjualan_model->save_ref();
		redir_ref();
	}

	function edit_resi($id)
	{
		if (empty($id)){
			return;
		}

		get_ref();
		$this->load->model('Penjualan_model');

		$data['title'] = 'Edit Resi Pengiriman';
		$this->load->view('main/header.php',$data);

		$data['penjualan'] = $this->Penjualan_model->edit($id);
		$this->load->view('penjualan/edit_resi.php',$data);

		$this->load->view('footer',$data);
	}

	function save_resi()
	{
		$this->load->model('Penjualan_model');
		$this->Penjualan_model->save_resi();
		redir_ref();
	}

	function getphonebook()
	{
		$this->load->model('Penjualan_model');
		$q = addslashes($this->input->get('q', TRUE));
		if (isset($q) && strlen($q) > 0){
			$sql = "select ID as id, CONCAT_WS(' : ',Name,Address) as name from pbk where Name like '%".$q."%' or Address like '%".$q."%' order by Name ";
			$query = $this->Penjualan_model->db->query($sql);
			echo json_encode($query->result());
		}
	}

	function kirim_resi($id_penjualan){
		get_ref();
		$this->load->model('Penjualan_model');
		$penjualan_resi = $this->Penjualan_model->get_resi($id_penjualan);
		foreach ($penjualan_resi as $row){
			$no_hp = $row->nomer;
			$msg = 'Bapak/Ibu ' .ucwords($row->nama). ' Yth, berikut no resi pengiriman ' .strtoupper($row->uraian). ' melalui ' .$row->ekspedisi. ' : ' .$row->no_resi. '. Terimakasih';
			$no_resi = $row->no_resi;
			$ekspedisi = $row->ekspedisi;
			$web = $row->website;
			$id_web = $row->id_web;
			$id_sms_center = $row->id_sms_center;
		}


		if ($id_web == '1'){
			// arlojikita //
			//$no_hp = '+6285358582012';
			$id_sms_center = 4;
		}

		if ($ekspedisi != 'COD'){
			if (!empty($no_resi) && strlen($no_resi) >=4 ){
				if (!empty($id_sms_center)){
					$this->load->model('service/Service_model');
					$this->load->model('Penjualan_model');

					$this->Service_model->outboxSave($no_hp,$msg,$id_sms_center);
					$this->Penjualan_model->db->query("update penjualan set kirim_resi=1 where id=" .$id_penjualan);
				}
			}
		}
		redir_ref();

	}

	function detail($id){
		$this->load->model('Penjualan_model');
		$data['title'] = 'Detail Penjualan';
		$this->load->view('main/header.php',$data);
		$data['penjualan'] = $this->Penjualan_model->getDetail($id);
		$this->load->view('penjualan/penjualan_detail.php',$data);
		$this->load->view('footer',$data);
	}

	function search($q){
		// pagging //
		$posisi = $this->input->get('pg');
		if (empty($posisi)){
			$posisi = 1;
		}


		$this->load->model('Penjualan_model');
		$data['include_css'] = jquery_css_core();
		$data['include_js'] = jquery_js_core();

		$data['title'] = 'Search Penjualan';
		$q = urldecode($q);
		$data['q'] = $q;
		$data['posisi'] = $posisi;
		$data['smode'] = '3';
		$this->load->view('main/header.php',$data);
		$total_penjualan = $this->Penjualan_model->get_total_search($q);
		$total_halaman = ceil($total_penjualan/50);
		$data['total_halaman'] = $total_halaman;
		$data['penjualan'] = $this->Penjualan_model->browse($posisi,$q);
		$this->load->view('penjualan/penjualan_browse',$data);
		$this->load->view('footer',$data);
	}

	function generate(){
		get_ref();
		$cek = $this->input->get('cek');
		if (empty($cek)){
			redir_ref();
		}
		$this->load->model('Penjualan_model');
		$data['title'] = 'Generate Proses dan Rincian';
		$this->load->view('main/header.php',$data);
		$data['generate'] = $this->Penjualan_model->generate();
		$this->load->view('penjualan/generate_proses_rincian',$data);
		$this->load->view('footer',$data);
	}

	function graph(){
		$a_tgl = ambil_tanggal();
		$tgl1 = $a_tgl[0];
		$tgl2 = $a_tgl[1];

		$data['title'] = 'Browse Penjualan';

		$data['include_css'] = jquery_css_core();
		$data['include_js'] = jquery_js_core() .
			'<script type="text/javascript" src="' .base_url(). 'assets/js/swfobject.js"></script>';

		$this->load->view('main/header.php',$data);
		$this->load->view('penjualan/penjualan_graph_filter');
		
		// clean chart type and build view variables
		$chart_type = strtolower(trim('line'));
		$data = array(
		                'chart_height'  => 400,
		                'chart_width'   => '80%',
		                'data_url'      => site_url('penjualan/graph_data/' .$tgl1.'/'.$tgl2),
		                'page_title'    => ucwords('OFC2 Plugin - '
		                                            . 'line'
		                                            . ' chart'),
		                'links'         => $links
		             );
	    
		$this->load->view('penjualan/penjualan_graph', $data);
		$this->load->view('footer',$data);
	}

	function graph_data($tgl1,$tgl2){
		$this->load->model('Penjualan_model');
		$data['penjualan'] = $this->Penjualan_model->graph($tgl1,$tgl2);

		$this->load->helper('ofc2');

		$data_1 = array();
		$data_2 = array();
		$data_3 = array();
		$data_4 = array();
			$x_labels = array();
			$max = 0;

		foreach ($data['penjualan'] as $row){
		    		$data_1[] = $row->ducas*1;
				$data_2[] = $row->dukos*1;
				$data_3[] = $row->civeto*1;
				$data_4[] = $row->max*1;
				$data_5[] = $row->mesra*1;
				$data_6[] = $row->laba*1;
				$data_7[] = $row->mikes*1;
				$x_labels[] = (date('N',strtotime($row->tanggal))>=6?'(':'') . date('d',strtotime($row->tanggal)) . (date('N',strtotime($row->tanggal))>=6?')':'');
				if ($max < $row->max){
					$max = $row->max;
				}
			}
			//print_r($x_label);
		$title = new title('&nbsp;');

			// ducas 
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#0055AD');

		$line_1 = new line();
		$line_1->set_default_dot_style($d);
		$line_1->set_values( $data_1 );
		$line_1->set_width( 1 );
		$line_1->set_colour( '#0055AD' );

			// dukos 
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#D67A84');

		$line_2 = new line();
		$line_2->set_values( $data_2 );
		$line_2->set_default_dot_style($d);
		$line_2->set_width( 1 );
		$line_2->set_colour( '#D67A84' );

			// civeto
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#291C16');

		$line_3 = new line();
		$line_3->set_values( $data_3 );
		$line_3->set_default_dot_style($d);
		$line_3->set_width( 1 );
		$line_3->set_colour( '#291C16' );

			// total
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#000000');

		$line_4 = new line();
		$line_4->set_values( $data_4 );
		$line_4->set_default_dot_style($d);
		$line_4->set_width( 2 );
		$line_4->set_colour( '#000000' );

			// mesra
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#640189');

		$line_5 = new line();
		$line_5->set_values( $data_5 );
		$line_5->set_default_dot_style($d);
		$line_5->set_width( 1 );
		$line_5->set_colour( '#640189' );

			// laba
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#5E0F13');

		$line_6 = new line();
		$line_6->set_values( $data_6 );
		$line_6->set_default_dot_style($d);
		$line_6->set_width( 2 );
		$line_6->set_colour( '#5E0F13' );

			// mikes
		$d = new hollow_dot();
		$d->size(4)->halo_size(2)->colour('#007E1E');

		$line_7 = new line();
		$line_7->set_values( $data_7 );
		$line_7->set_default_dot_style($d);
		$line_7->set_width( 1 );
		$line_7->set_colour( '#007E1E' );

		// ==================================================== //
			$max = ceil($max/1000000)*1000000;
		$y = new y_axis();
		$y->set_range( 0, $max, 20 );
			$x = new x_axis();
			$x->set_labels_from_array($x_labels);

		$chart = new open_flash_chart();
		$chart->set_title( $title );
		$chart->add_element( $line_1 );
		$chart->add_element( $line_2 );
		$chart->add_element( $line_3 );
		$chart->add_element( $line_4 );
		$chart->add_element( $line_5 );
		$chart->add_element( $line_6 );
		$chart->add_element( $line_7 );
		$chart->set_y_axis( $y );
		$chart->set_x_axis( $x );

		echo $chart->toPrettyString();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
