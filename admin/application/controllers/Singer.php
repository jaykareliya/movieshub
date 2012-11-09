<?php
class Singer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('msinger');
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

	public function manage_Singer()
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
		$this->manage_Singer1();
	}
function bind_Singer()
{
	 $this->load->model('mSinger');
		  $actor = $this->mSinger->bind_Singer();
		
		  echo '<select name="ddlSinger" id="ddlSinger" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($actor as $actors)
		  {
		   echo '<option value="'.$actors->Singer_Id.'">'.$actors->Singer_Name.'</option>';
		  }
		  
		  echo '</select>';
}
	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}
	function manage_Singer1()
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
		$total_number_of_rows = $this->msinger->fill_singer_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Singer/manage_Singer?";
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
		
		$data['fill_Singer_table'] = $this->msinger->fill_Singer_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Singer";
		$data["dash_board"] = "Manage Singer";
		$data["main_content"] = "admin_manage_singer.php";
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
		function new_singer()
	{
		$data = $this->assign_value_to_data();
		$singer_id = $this->input->get('Singer_id');
		
		if(!$singer_id)
		{
			$data["title"] = "New Singer";
			$data['dash_board'] = "New Singer";
		}
		else
		{
			$data['Singer_details'] = $this->msinger->fill_singer_details($singer_id);
			
			$data["title"] = "Update Singer";
			$data['dash_board'] = "Update Singer";
		}
		
		$data["main_content"] = "admin_new_Singer.php";
		$this->load->view("admin.php",$data);
	}
	function save_Singer()
	{
		if($this->msinger->save_new_singer()==TRUE)
			$this->session->set_flashdata("success","singer saved successfully");
		else
			$this->session->set_flashdata("error","Singer already exists");
		redirect('/Singer/manage_Singer','refresh');
	}
	function delete_Singer()
	{
			$ret_message=$this->msinger->delete_singer();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Singer deleted successfully");
		else
			$this->session->set_flashdata("error","This Singer can not deleted. Associated child element exists.");
			
		redirect('/Singer/manage_Singer','refresh');
	}
	function update_Singer()
	{
		if($this->msinger->update_singer()==TRUE)
			$this->session->set_flashdata("success","Singer saved successfully");
		else
			$this->session->set_flashdata("error","Producer already exists");
		redirect('/singer/manage_Singer','refresh');
	}
}