<?php

class home extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('penghuni_model');
	}

	public function index(){
		$data['penghunis'] = $this->penghuni_model->get_all_penghuni();
		$this->load->view('home_view', $data); 
	}
	public function penghuni_add(){
		$data = array(
			'Id_penghuni' => $this->input->post('idpenghuni'),
			'Nama_penghuni' => $this->input->post('namapenghuni'),
			'Asal_penghuni' => $this->input->post('asalpenghuni'),
			'ttl' => $this->input->post('ttl'),
			'umur' => $this->input->post('umur'),
			'no_hp' => $this->input->post('nohp'),
			);

		$insert = $this->penghuni_model->penghuni_add($data);
		echo json_encode(array("status" => true));
	} 
	public function ajax_edit($id){
		$data = $this->penghuni_model->get_by_id($id);
		echo json_encode($data);
	}

	public function penghuni_update(){
		$data = array(
			'Id_penghuni' => $this->input->post('idpenghuni'),
			'Nama_penghuni' => $this->input->post('namapenghuni'),
			'Asal_penghuni' => $this->input->post('asalpenghuni'),
			'ttl' => $this->input->post('ttl'),
			'umur' => $this->input->post('umur'),
			'no_hp' => $this->input->post('nohp'),
			);
		$this->penghuni_model->penghuni_update(array('Id_penghuni'=> $this->input->post('idpenghuni')), $data);

		echo json_encode(array("status" => TRUE));
	}

	public function penghuni_delete($id){
		$this->penghuni_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}