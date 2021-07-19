<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
	
		$this->load->model("Common");
	}

	
    public function reorder_price_list()
	{
		
		$position = $this->input->post('position');
		$i=1;
		foreach($position as $k=>$v){
			
			$where = array('id'=>$v);
			$update_data['position_order'] = $i;
			 $this->Common->Update($table='model_price_master',$update_data,$where);
			$i++;
		}
		echo 1; 
	}
	
	
}
