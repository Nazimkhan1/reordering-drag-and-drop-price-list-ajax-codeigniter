<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 
	 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('book_model');
        $this->load->model('Petshop_model');
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}
	function addUser()
	{
		$dataList=$this->Petshop_model->get_all_record();
		//print_r($dataList);exit;
		foreach($dataList as $value)
		{
			//echo '<pre>';
			//print_r($value);
			//echo '</pre>';
			$user_id = $value->id;
			$str='nld0000'.$user_id;
			$save['user_name']=$str;
			$dataList=$this->Petshop_model->update_record($save,$user_id);
		} exit;
	}
	
}
