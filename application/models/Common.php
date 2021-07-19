<?php
class Common extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	
	public function SelectResult($select,$from,$where)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		$this->db->order_by('id','DESC');
		$result= $this->db->get()->result();
		return $result;
	}
	public function SelectResultArray($select,$from,$where)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		$this->db->order_by('id','DESC');
		$result= $this->db->get()->result_array();
		return $result;
	}
	public function SelectResultWithPagination($select,$from,$where,$start_range,$end_range)
	{
		    $this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$this->db->order_by('id','ASC');
			$this->db->limit($end_range,$start_range);
			$result= $this->db->get()->result_array();
			return $result;
	}
	public function XssProtection($input)  
	{ 
			$input1 = strtolower($input);
			$input1 = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($input));
			$input1 = htmlentities($input1, ENT_QUOTES, "UTF-8");
			
			$str="(select*from(select(sleep(20)))a),ahref,js,php,html,json,txt,jpg,png,gif,zip,str,script,xss,alert,onreadystatechange,onerror,embed,<svg>,onload,onmouseover,onmouseove,marquee onstart,<var>,<h1>,/**/'1'='1,/**/,'1'='1,/**/1=1))--,javascript,src=javascript,xmp,ascript:alert,xss.js,rocks,background,style,lowsrc,livescript,document.cookie,exploitation,seeksegmenttime(),onunload(),onundo(),ontrackchange(),ontimeerror(),onsubmit(),onsyncrestored(),onstorage(),onstop(),onstart(),onselectstart(),onselectionchange(),fscommand(),onabort(),onactivate(),onafterprint(),onafterupdate(),onbeforeactivate(),onbeforecopy(),onbeforecut(),onbeforeprint(),onblur(),onchange(),onclick(),oncopy(),onhelp(),onlosecapture(),onload(),onmouseup(),onmouseover(),onoffline(),ononline(),onpaste(),onrepeat(),onresizestart(),onresizeend(),onresize(),onselect(),onselectionchange(),onselectstart(),onstart(),onstop(),onstorage(),ontimeerror(),onunload(),maliciouscode,eval,href,header,param,onbeforepaste(),',==,drop,%,select,*,<script>,</script>";
			
			$arr=explode(",",$str);
			
			$input_data=explode(" ",$input1);
			
			//spam serach 
			$x = false;
			foreach($input_data as $v){
				
				if(in_array(trim($v),$arr))
				{
					$x = true;
					$input='';
				 
				  session_destroy();
				  redirect(base_url().'web/login');
					break;
				}
			}
			
			if($x==false)
			{
				 $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($input));
				$t = htmlentities($t, ENT_QUOTES, "UTF-8");
				return $t;
				exit();
			}
			
		
	}
	
	
	
	public function SelectResultCategories($select,$from,$where)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		$this->db->order_by('id','ASC');
		$result= $this->db->get()->result();
		return $result;
	}
	
	public function SelectOrderByResult($select,$from,$where)
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		$this->db->order_by('id','ASC');
		$result= $this->db->get()->result();
		return $result;
	}
	
		public function GetCount($select,$from,$where)
		{
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$count = $this->db->count_all_results();
			if(isset($count) && !empty($count))
			{
				return $count;
			}else{
				return 0;
			}
		}
		public function SelectRowArray($select,$from,$where)
		{
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$result= $this->db->get()->row_array();
			return $result;
		}
		public function SelectRow($select,$from,$where)
		{
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$result= $this->db->get()->row();
			return $result;
		}
		public function DeleteRow($from,$where)
		{
			$this->db->where($where);  
			$this->db->delete($from);
			//echo $this->db->last_query(); exit;
			return true;
		}
		
		public function StatusRow($from,$where,$fields)
		{
			$this->db->where($where);  
			$this->db->update($from,$fields);
			return true;
		}
		public function new_order_current_date($select,$from,$where)
		{
			
			$date = new DateTime("now");
            $curr_date = $date->format('Y-m-d ');
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$this->db->where('DATE(created_on)',$curr_date);
			$this->db->order_by('id','DESC');
			$result= $this->db->get()->result();
			return $result;
		}
			function Insert($table,$data){
		  
				
				
				if($table == ""){
		  
					return "Table not specified";
		  
				}
				if(empty($data) || (!is_array($data)) || (sizeof($data) < 1)){
					return "No data is available to be processed";
				}
				
				$result = $this->db->insert($table,$data);  
				
				if($result){
				  
					return  $this->db->insert_id();  
				}else{
				  
					return $result;	  
				  
				} 
		}
 public function validateToken($table,$where)
 {
	$this->db->select('cm_ua_id');
	$this->db->from($table);
	$this->db->where($where);
	$result= $this->db->get()->row();
	if(isset($result) && !empty($result)) return  1;  else  return 0; 
 }		 
function send_sms($number,$body)
{
    $ID = '1234567890abcdef1234567890abcdef12';
    $token = '1234567890abcdef1234567890abcdef';
    $service = 'AB1234567890abcdef1234567890abcdef';
    $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $ID . '/Messages.json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

    curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD,$ID . ':' . $token);

    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        'To=' . rawurlencode('+' . $number) .
        '&MessagingServiceSid=' . $service .
        //'&From=' . rawurlencode('+18885550000') .
        '&Body=' . rawurlencode($body));

    $resp = curl_exec($ch);
    curl_close($ch);
    return json_decode($resp,true);
}
  
		public function InsertArray($table,$data){
	
			if(empty($table) ||  empty($data) || (!is_array($data)) || (sizeof($data) < 1)){
		
				return 'check parameters';
			}
			else{
				
		
				$sql_query= $this->db->insert_batch($table ,$data);
				if($sql_query){
			
					return true;
				}
				else{
			
					return false;
				}
			}
		}
  
		function Update($table,$data,$where){
			
			if($table == ""){
				return "Table not specified";
			}
			if(empty($data) || (!is_array($data)) || (sizeof($data) < 1)){
				return "No data is available to be processed";
			}
			if(empty($where) || (!is_array($where)) || (sizeof($where) < 1)){
				return "No condition specified";
			}
	
			foreach($where as $key=>$val){
		
				$this->db->where($key, $val);	
		
			}	
			return $this->db->update($table, $data);
	 
		}
  
    
		public function FetchSingleRow($table, $field, $id){
		
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($field, $id);
			$query=$this->db->get();
			$result=$query->row_array();
			return $result;
		}
		
			public function FetchAllRow($table){
		
			
			
			$this->consumer_db->select('*');
			$query=$this->consumer_db->get($table);
			//return $query->result();
			return $query->result_array();
		}
	
		public function FetchAllRowById($table, $field, $id){
		
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($field, $id);
			$query=$this->db->get();
			$result=$query->result();
			return $result;
		}
	
	    public function ResultPagination($select,$from,$where,$page,$segment)
	    {
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$this->db->limit($page,$segment);
			$result = $this->db->get()->result();
			return $result;
	   }
		public function GetCount_old($table,$where)
		{
			$this->db->select('id');
			$this->db->where($where);
			$query=$this->db->get($table);
			return $query->num_rows();
		}
	
		public function GetLastRow($table)
		{
			
			
			$this->db->select('*');
			$query=$this->db->get($table);
			$query->last_row();
			
		}
		
		public function IndianDate($dt)
		{
			return date("d-m-Y", strtotime($dt));
		}
		
		
	public function delete_row_by_id($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('events');
		return true;
	}
	public function delete_by_row($table,$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
		return true;
	}
		
		public function getTableCount($select,$table,$where)
		{
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($where);
			$count = $this->db->count_all_results();
			
			if ($count > 0)
			{
				return $count;
			}
			else
			{
				return false;
			}
		}
		
		public function getAllData($table,$field, $id)
		{
		
			
			
			$this->db->select('*');
			$this->db->where($field, $id);
			$query=$this->db->get($table);
			
			return $query->result_array();
		}
	
	

} //  end class 



?>
