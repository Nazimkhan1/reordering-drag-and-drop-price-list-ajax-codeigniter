<?php

class LanguageHook {
	
	function loadLanguage()
	{
		
		$CI = & get_instance();
		$CI->load->library("session");
		 $login_type = $CI->session->userdata('login_type');
		 //echo $login_type; exit;
       //echo "Loading cache....."; 
	   /* if($login_type=='admin')
	   {
		   return true;
	   }
	   elseif($login_type=='vendor')
	   {
		   return true;
	   } */
	}
}


