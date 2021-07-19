<?php
class Ajax_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	
	public function check_old_password($user_id,$pass)
	{
		$haspass = hash('sha512',$pass);
		$this->db->select('id,password');
		$this->db->from('users');
		$this->db->where(array('id'=>$user_id));
		$this->db->limit(1);
		$query = $this->db->get()->result();
		if(isset($query) && !empty($query)){
		$password = $query[0]->password;
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
	
	

} //  end class 



?>
