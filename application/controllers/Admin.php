<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->model("Admin_model");
		$this->load->model("Common");
		
	}
	

	
	
	public function model_price_list()
	{
		 if ($this->session->userdata('user_id')!=''){
               $user_id = $this->session->userdata('user_id');
		    }
			
			$data['heading'] ='Price Master';
          
            $select ='*'; $from='model_price_master'; $where = array('status!='=>3);
            //$data['model_prices'] = $this->Common->SelectResultArray($select,$from,$where);
            $data['model_prices'] = $this->Admin_model->get_prices($where);
			//p($data['model_prices']); exit;
			
			$this->load->view('admin/helpers/header_view',$data);
		    $this->load->view('admin/price/model_master_price_list',$data);
		    $this->load->view('admin/helpers/footer_view');
	}
	
	public function add_price()
	{
        $data['heading']='Add Price';
		$table ='model_price_master';
		
		
		if($this->input->post('price'))
		{
				$this->form_validation->set_rules('model_price', 'Category Name', 'required',array('required'=>'This field is required'));
				$this->form_validation->set_error_delimiters('<div style="margin-top:2px; color:red; font-size:12px;">', '</div>');
				$this->form_validation->set_message('required', ' %s required');
				if ($this->form_validation->run() == FALSE)
				{
					    $this->load->view('admin/helpers/header_view',$data);
						$this->load->view('admin/price/price_add_view',$data);
						$this->load->view('admin/helpers/footer_view');
				}
				else{
					    
						$save['price']= $this->input->post('model_price');
						$savedata = $this->security->xss_clean($save);
						$checked = $this->checking_price_added($save['price']);
						if($checked==0)
						{
							$result = $this->Admin_model->add($savedata,$table); //saving....
						    $this->session->set_flashdata('message',"Price added successfully");
							$redirect_url = base_url('admin/model_prices');
							redirect($redirect_url);
						} else {
							$this->session->set_flashdata('error',"Price already defined");
							$redirect_url = base_url('admin/add_price');
						    redirect($redirect_url);
						}
						
		        }
	    }else{
		
			$this->load->view('admin/helpers/header_view',$data);
			$this->load->view('admin/price/price_add_view',$data);
			$this->load->view('admin/helpers/footer_view');
		}
	}
	 private function checking_price_added($price)
	 {
		 $select ='*'; $from='model_price_master'; $where = array('price'=>$price);
		 $prices = $this->Common->SelectRow($select,$from,$where); 
		 if(isset($prices) && !empty($prices))
		 {
			 return 1;
		 } else {
			 return 0;
		 }
	 }
	

	public function edit_price($id)
	{
		$data['heading']='Update Price';
		$table ='model_price_master';
		
		if($this->input->post('priceUp'))
		{
				$this->form_validation->set_rules('model_price', 'Price Name', 'required',array('required'=>'This field is required'));
				
				$this->form_validation->set_error_delimiters('<div style="margin-top:2px; color:red; font-size:12px;">', '</div>');
				$this->form_validation->set_message('required', ' %s required');
				if ($this->form_validation->run() == FALSE)
				{
					    $data['user_row'] = $this->Admin_model->get_user_by_id($user_id);
						$select ='*'; $from='model_price_master'; $where = array('id'=>$id);
		                $data['priceRow'] = $this->Common->SelectRow($select,$from,$where); 
						$this->load->view('admin/helpers/header_view',$data);
						$this->load->view('admin/price/price_edit_view',$data);
						$this->load->view('admin/helpers/footer_view');
				}
				else{
					
					$save['price']= $this->input->post('model_price');
					
					$savedata = $this->security->xss_clean($save);
					$checked = $this->checking_price_added($save['price']);
					if($checked==0){
						$where = array('id'=>$id);
						$result = $this->Common->Update($table,$savedata,$where); //saving....
						
						$this->session->set_flashdata('message',"Price updated successfully");
						$redirect_url = base_url('admin/model_prices');
						redirect($redirect_url);
					}else{
						$this->session->set_flashdata('error',"Price already defined");
					    $redirect_url = base_url('admin/edit_price/'.$id);
					    redirect($redirect_url);
					}
		        }
	    } else {
			
			$select ='*'; $from='model_price_master'; $where = array('id'=>$id);
			$data['priceRow'] = $this->Common->SelectRow($select,$from,$where); 
			$this->load->view('admin/helpers/header_view',$data);
			$this->load->view('admin/price/price_edit_view',$data);
			$this->load->view('admin/helpers/footer_view');
		}
	}
	
    public function status_price($id,$name)
	{
		$table='model_price_master';
		if($name==1)
		{
			$value = 0;
			$status_name='deactivated';
		}
		else
		{
			$value = 1;
			$status_name='activated';
		}
		$data['status'] = $value;
		$where = array('id'=>$id);
		$result = $this->Common->Update($table,$data,$where); //saving....
		$this->session->set_flashdata('message', 'Price '.$status_name.' successfully.');
		$redirect_url = base_url('admin/model_prices');
		redirect($redirect_url);
	}
	
	
	
	
	public function delete_price($id)
	{
		 $table='model_price_master';
		 $where = array('id'=>$id);
		 $this->Common->delete_by_row($table,$where);
		
		 $this->session->set_flashdata('message', 'Price deleted successfully.');
		 $redirect_url = base_url('admin/model_prices');
		 redirect($redirect_url);
	}
	

}
