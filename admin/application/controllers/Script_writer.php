<?php
class Script_writer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mScript_writer');
		$this->load->model('madmin');
		$this->login_auth();
	}
	public function login_auth()
	{
		$flag = $this->ion_auth->logged_in();
		if($flag!=TRUE)
		{
			$this->session->set_flashdata("error","Must login to see this page");
			redirect('','refresh');
		}
	}

	public function manage_Script_writer()
	{


		if(!($_GET))
		{
			$this->session->set_userdata('alpha',"");
			$this->session->set_userdata('newdata','');
			
		}
		else
		{
			if(array_key_exists("alpha", $_GET)) 
			if($_GET["alpha"] == "ALL")
			{
				$this->session->set_userdata('alpha',"");
				$this->session->set_userdata('newdata','');
			}
		}
		$this->manage_Script_writer1();
	}

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}
	function bind_Script_writer()
{
	 $this->load->model('mScript_writer');
		  $Script_writer = $this->mScript_writer->bind_Script_writer();
		
		  echo '<select name="ddlScript_writer" id="ddlScript_writer" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($Script_writer as $Script_writers)
		  {
		   echo '<option value="'.$Script_writers->Script_Writer_Id.'">'.$Script_writers->Script_Writer_Name.'</option>';
		  }
		  
		  echo '</select>';
}
	function manage_Script_writer1()
	{
		$this->load->library('pagination');		
		
		$alpha = $this->getAlpha();
		
		//Extra code for searching
		$keyword = "";
		if($this->input->post('txtKeyword'))
		{
			$keyword = $this->input->post('txtKeyword');
			$alpha = $keyword;
		}
		//upto here
	
		$data = $this->assign_value_to_data();
		$record_per_page = isset($_GET["records"])?$_GET["records"]:10;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 10;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 10;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->mScript_writer->fill_Script_writer_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Script_writer/manage_Script_writer?";
		$config['total_rows'] = $total_number_of_rows;
		$config['per_page'] = $record_per_page;
		$config['page_query_string'] = TRUE;
		
		$config['num_links'] = 1;
		$config['num_tag_open'] = '<div id="page-info">';
		$config['num_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<div id="page-info">';
		$config['cur_tag_close'] = '</div>';
		$config['prev_tag_open'] = '<div id="page-info">';
		$config['next_tag_open'] = '<div id="page-info">';
		$config['prev_tag_close'] = '</div>';
		$config['next_tag_close'] = '</div>';
		$config['first_tag_open'] = '<div id="page-info">';
		$config['last_tag_open'] = '<div id="page-info">';
		$config['first_tag_close'] = '</div>';
		$config['last_tag_close'] = '</div>';
		$config['first_link'] = '<img src="'.base_url().'images/table/paging_far_left.gif" />';
		$config['prev_link'] = '<img src="'.base_url().'images/table/paging_far_left.gif" />';
		$config['next_link'] = '<img src="'.base_url().'images/table/paging_far_right.gif" />';
		$config['last_link'] = '<img src="'.base_url().'images/table/paging_far_right.gif" />';
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['fill_Script_writer_table'] = $this->mScript_writer->fill_Script_writer_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Script Writer";
		$data["dash_board"] = "Manage Script Writer";
		$data["main_content"] = "admin_manage_Script_writer.php";
		$this->load->view("admin.php",$data);
	}
		function getAlpha()
	{
		$alpha = $this->input->get('alpha');
		if($alpha == "" || $alpha == NULL)
			$alpha = $this->session->userdata('alpha');
		else
			$this->session->set_userdata('alpha',$alpha);
		
		return $alpha;	
	}
		function new_Script_writer()
	{
		$data = $this->assign_value_to_data();
		$Script_writer_id = $this->input->get('Script_writer_id');
		
		if(!$Script_writer_id)
		{
			$data["title"] = "New Script Writer";
			$data['dash_board'] = "New Script Writer";
		}
		else
		{
			$data['Script_writer_details'] = $this->mScript_writer->fill_Script_writer_details($Script_writer_id);
			
			$data["title"] = "Update Script Writer";
			$data['dash_board'] = "Update Script Writer";
		}
		
		$data["main_content"] = "admin_new_Script_writer.php";
		$this->load->view("admin.php",$data);
	}
	function save_Script_writer()
	{
		if($this->mScript_writer->save_new_Script_writer()==TRUE)
			$this->session->set_flashdata("success","Script Writer saved successfully");
		else
			$this->session->set_flashdata("error","Script Writer already exists");
		redirect('/Script_writer/manage_Script_writer','refresh');
	}
	function delete_Script_writer()
	{
			$ret_message=$this->mScript_writer->delete_Script_writer();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Script Writer deleted successfully");
		else
			$this->session->set_flashdata("error","This Script Writer can not deleted. Associated child element exists.");
			
		redirect('/Script_writer/manage_Script_writer','refresh');
	}
	function update_Script_writer()
	{
		if($this->mScript_writer->update_Script_writer()==TRUE)
			$this->session->set_flashdata("success","Script Writer saved successfully");
		else
			$this->session->set_flashdata("error","Producer already exists");
		redirect('/Script_writer/manage_Script_writer','refresh');
	}
}