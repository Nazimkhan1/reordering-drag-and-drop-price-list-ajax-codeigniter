<?php
class Admin_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	public function add($data,$table)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	public function get_prices($where)
	{
		$this->db->select("p.*");
        $this->db->from('model_price_master as p');
		$this->db->where($where);
		$this->db->order_by('p.position_order','ASC'); 	
        $result = $this->db->get()->result_array();
		return $result;
	}
	 public function model_approval_status($id,$value,$table)
	{
		$data['is_verified']= $value;
		$this->db->where('id', $id);  
		$this->db->update($table,$data);
		return true;
	}
	public function get_seo_row($page_url)
	{
		$this->db->select("s.id,s.page_title,s.meta_title,s.meta_description,s.meta_keyword");
        $this->db->from('seos as s');
		$this->db->where(array('page_url'=>$page_url));
        $result = $this->db->get()->row();
		return $result;
		
		
	}
	public function check_role_access_not_used($user_id,$inArr)
	{
		$this->db->select("ram.id");
        $this->db->from('role_access_manage as ram');
		$this->db->where_in('ram.menu_id',$inArr);
		$this->db->where(array('ram.uid'=>$user_id));
        $result = $this->db->get()->result_array();
		return $result;
	}
	public function check_role_access($user_id,$inArr)
	{
		$this->db->select("um.id");
        $this->db->from('admin_user_menus as um');
		$this->db->where_in('um.menu_id',$inArr);
		$this->db->where(array('um.user_id'=>$user_id,'um.status'=>1));
        $result = $this->db->get()->result_array();
		return $result;
	}
	public function check_already_exist($table,$user_id,$pincode)
	{
		$this->db->select("id");
        $this->db->from($table);
		$this->db->where(array('user_id'=>$user_id,'pincode'=>$pincode,'status!='=>3));
        $result = $this->db->get()->row();
		if(isset($result) && !empty($result))
		{
			return true;
		}
		else{
			return false;
		}
		
	}
	
	public function update_post_counter($model_id)
	{
		
		$this->db->set('views', 'views+1', FALSE);        
		$where = array('id' =>$model_id);
		$this->db->where($where);
		$this->db->update('models');
		
	}
	public function save_post_visit($data)
	{
		    $this->db->insert('model_visitors',$data);
			return $this->db->insert_id();
	}
	public function check_post_visit($ip,$model_id)
	{
		$this->db->select("pv.id");
        $this->db->from('model_visitors as pv');
		$this->db->where(array('pv.model_id'=>$model_id,'pv.visit_ip_address'=>$ip));
        $result = $this->db->get()->row();
		if(isset($result) && !empty($result))
		{
			return 1;
		}
		else{
			return 0;
		}
		
	}
	
	
	public function get_products_details($prod_id)
	{
		$this->db->select("p.id,p.category_id,p.subcategory_id,p.subsubcategory_id,p.brand_id,p.product_type,p.product_name,p.product_image,p.opt_image_1,p.opt_image_2,p.opt_image_3,p.base_price,
		p.selling_price,p.shipping_cost,p.tax_price,p.product_unit,p.product_tag,p.discount_percent,product_detail,p.status,c.category_name,sc.subcategory_name");
		$this->db->from("products as p");
		$this->db->join('categories as c','c.id=p.category_id','INNER');
		$this->db->join('sub_categories as sc','sc.id=p.subcategory_id','INNER');
		$this->db->join('sub_sub_categories as ssc','ssc.id=p.subsubcategory_id','INNER');
		$this->db->where(array('p.id'=>$prod_id)); 
		$this->db->order_by('p.id','DESC'); 		
		$result = $this->db->get()->row();
		return $result;
	}
	
	public function get_permitted_menus($user_id)
	{
		$this->db->select("am.id,am.menu_name,aum.user_id");
		$this->db->from("admin_menus as am");
		$this->db->join('admin_user_menus as aum','aum.menu_id=am.id','INNER');
		$this->db->where(array('aum.user_id'=>$user_id)); 
		$this->db->order_by('am.id','ASC'); 		
		$result = $this->db->get()->result();
		return $result;
	}
	
	
	
	
	public function check_already_assigned($table,$user_id,$lead_id,$status)
	{
		$this->db->select("id");
        $this->db->from($table);
		$this->db->where(array('lead_id'=>$lead_id,'status'=>$status));
        $result = $this->db->get()->row();
		if(isset($result) && !empty($result))
		{
			return true;
		}
		else{
			return false;
		}
		
	}
	public function check_old_user_password($email,$password)
	{
		$this->db->select("u.username");
        $this->db->from('users as u');
		$this->db->where(array('u.user_email'=>$email,'u.password'=>sha1($password)));
        $result = $this->db->get()->row();
		if(isset($result) && !empty($result))
		{
			return true;
		}
		else{
			return false;
		}
		
	}
	public function leads()
	{
		$this->db->select("*");
        $this->db->from('leads');
        $this->db->order_by('id','DESC');
		$result = $this->db->get()->result();
		return $result;
	}
	public function closed_not_sold_leads()
	{
		$this->db->select("l.*");
        $this->db->from('leads as l');
		$this->db->join('user_action_leads as a','a.lead_id=l.id','INNER');
		$this->db->where(array('l.status'=>6,'a.reason'=>2,'a.purchase_policy'=>2));
        $this->db->order_by('l.id','DESC');
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function users_pincodes()
	{
		$this->db->select("ap.pincode,a.user_name,ap.id,ap.status,ap.created_on");
        $this->db->from('user_map_pincodes as ap');
        $this->db->join('users as a','a.id=ap.user_id','INNER');
		$this->db->where(array('ap.status!='=>3));
        $this->db->order_by('a.user_name','DESC');
		$result = $this->db->get()->result();
		return $result;
	}
	public function update_user_id($data,$id)
	{
	
		$this->db->where('id', $id);  
		$this->db->update('admins',$data);
		return true;
	}
    public function status_by_id($id,$value,$table)
	{
		$data['user_status']= $value;
		$this->db->where('id', $id);  
		$this->db->update($table,$data);
		return true;
	}
	
	public function get_user_by_id($id)
	{
		$this->db->select("*");
        $this->db->from('admins');
		$this->db->where('id',$id);
        $result = $this->db->get()->row();
		return $result;
	}
	public function users()
	{
		$this->db->select("*");
        $this->db->from('users');
		$this->db->where('user_type','vendor');
        $result = $this->db->get()->result();
		return $result;
	}
	public function new_users()
	{
		$this->db->select("*");
        $this->db->from('users');
		$this->db->where(array('user_status'=>0,'user_type'=>'vendor'));
		$this->db->order_by('id','DESC');
        $result = $this->db->get()->result();
		return $result;
	}
	
	public function approved_users()
	{
		$this->db->select("*");
        $this->db->from('users');
		$this->db->where(array('user_status'=>1,'user_type'=>'vendor'));
		$this->db->order_by('id','DESC');
        $result = $this->db->get()->result();
		return $result;
	}
	public function users_refers()
	{
		$this->db->select("r.id,r.refer_name,r.refer_relation,r.refer_mobile_no,r.refer_mobile_no_other,r.refer_email_id,r.created_on,r.status,a.user_name,a.user_email");
        $this->db->from('refers as r');
		$this->db->join('users as a','a.id=r.refered_by','LEFT');
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function delete_user_by_id($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('users');
		return true;
	}
	public function status_user_by_id($id,$value)
	{       
		$data['user_status']= $value;
		$this->db->where('id', $id);  
		$this->db->update('users',$data);
		return true;
	}
	
	public function get_category_by_id($id)
	{
		$this->db->select("c.category_name");
        $this->db->from('categories as c');
		$this->db->where('id',$id);
        $result = $this->db->get()->row();
		return $result;
	}
	public function get_page_url($url)
	{
		$this->db->select("*");
        $this->db->from('seos');
		$this->db->where('page_url',$url);
        $result = $this->db->get()->row();
		return $result;
	}
	public function update_profile($data,$id)
	{
	
		$this->db->where('id', $id);  
		$this->db->update('users',$data);
		return true;
	}
	
	public function get_user_list()
	{
		$this->db->select("*");
		$this->db->from("users");
		$result=$this->db->get()->result();
		return $result;
	}
	
	public function save_attempts($data)
	{
		    $this->db->insert('login_attempts',$data);
			return $this->db->insert_id();
	}
	
	 public function update_new_password($id,$data)
	{
	  $this->db->where(array('id'=>$id));
	  $this->db->update('admins',$data);
	  return true;
	}
	
	public function check_old_password($user_id,$pass)
	{
		$haspass = hash('sha512',$pass);
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where(array('id'=>$user_id));
		$this->db->limit(1);
		$query = $this->db->get()->result();
		if(isset($query) && !empty($query)){
		$password = $query[0]->user_password;
			if ($haspass == $password) {
			return true;
			} else {
				return false;
			}
		}
		else{
			return false;
		}		
	}
	
	
	public function get_user_row($id)
	{
		$this->db->select("*");
		$this->db->from("admins");
		$this->db->where('id', $id);  
		$result =$this->db->get()->row();
		return $result;
	}	
	
	
	
	
	public function call_procedureRow($procedure, $parameter = array()) {
		$param         = $this->userfunction->paramiter($parameter);
		$query         = $this->db->query("call $procedure($param)", $parameter);

		$close         = $this->db->close();
		 
		//exit();
		return $result = $query->row();
	}
	public function userdata($array) {
		$recorddata = array(
			'admin_id'  => $array[0]->ad_id,
			'username'  => $array[0]->username,
			'validated' => true);
		$this->session->set_userdata($recorddata);

		main_menu('menuaccess');
	}
	public function get_reply_list($requester_id)
	{
		$this->db->select('rf.id as rf_id,rf.department_id as dept_id,rf.requester_id as req_id,rf.forwarder_id as fwd_id,rf.reply_message,uq.username,uq.ticket_no,td.HOD,td.Name,td.Abbreviations,td.email_id,rf.query_status');
		$this->db->from('reply_forwards as rf');
		$this->db->join('user_queries as uq','uq.id=rf.requester_id','LEFT');
		$this->db->join('technicaldepartments as td','td.id=rf.forwarder_id','LEFT');
		$this->db->where(array('rf.requester_id'=>$requester_id,'rf.query_status'=>1));
		$result = $this->db->get()->result();
		return $result;
		
	}
	public function get_reply_list_back($requester_id)
	{
		$this->db->select('rf.id as rf_id,rf.department_id as dept_id,rf.requester_id as req_id,rf.forwarder_id as fwd_id,rf.reply_message,uq.username,uq.ticket_no,td.HOD,td.Name,td.Abbreviations,td.email_id');
		$this->db->from('reply_forwards as rf');
		$this->db->join('user_queries as uq','uq.id=rf.requester_id','LEFT');
		$this->db->join('technicaldepartments as td','td.id=rf.forwarder_id','LEFT');
		$this->db->where(array('rf.requester_id'=>$requester_id,'rf.query_status'=>1));
		$result = $this->db->get()->result();
		return $result;
		
	}

} //  end class 



?>
