<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Input extends CI_Input
{
	public function __construct()
    {
        parent::__construct();
    }
    
	public function save_query($query_array)
	{
		$CI =& get_instance();
		$qarray = http_build_query($query_array);
		$CI->db->limit(1);
		$q = $CI->db->get_where('search', array('query_string' => $qarray));
		if($q->num_rows() > 0)
		return $q->row()->id;
		
		$CI->db->insert('search', array('query_string' => $qarray));
		
		return $CI->db->insert_id();
	}
 
	public function load_query($query_id)
	{
		$CI=& get_instance();
		
		$rows = $CI->db->get_where('search', array('id' => $query_id))->result();
		if(isset($rows[0])) {
			parse_str($rows[0]->query_string, $_GET);
		}
		else
		{
			//show 404 if query_id not in db
			if($query_id <> 0)
			show_404();
		}
 	}
}