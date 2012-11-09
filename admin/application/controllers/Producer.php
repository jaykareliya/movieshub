<?php
class Producer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mproducer');
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

	public function manage_Producer()
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
		$this->manage_Producer1();
	}

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}
	function bind_Producer()
	{
		 $this->load->model('mProducer');
		  $Producer = $this->mProducer->bind_Producer();
		
		  echo '<select name="ddlProducer" id="ddlProducer" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($Producer as $Producers)
		  {
		   echo '<option value="'.$Producers->Producer_Id.'">'.$Producers->Producer_Name.'</option>';
		  }
		  
		  echo '</select>';
	}
	function manage_Producer1()
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
		$total_number_of_rows = $this->mproducer->fill_producer_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Producer/manage_Producer?";
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
		
		$data['fill_Producer_table'] = $this->mproducer->fill_Producer_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Producers";
		$data["dash_board"] = "Manage Producers";
		$data["main_content"] = "admin_manage_Producer.php";
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
		function new_Producer()
	{
		$data = $this->assign_value_to_data();
		$Producer_id = $this->input->get('Producer_id');
		
		if(!$Producer_id)
		{
			$data["title"] = "New Producer";
			$data['dash_board'] = "New Producer";
		}
		else
		{
			$data['Producer_details'] = $this->mproducer->fill_Producer_details($Producer_id);
			$data["title"] = "Update Producer";
			$data['dash_board'] = "Update Producer";
		}
		
		$data["main_content"] = "admin_new_Producer.php";
		$this->load->view("admin.php",$data);
	}
	function save_Producer()
	{
		if($this->mproducer->save_new_producer()==TRUE)
			$this->session->set_flashdata("success","Producer saved successfully");
		else
			$this->session->set_flashdata("error","Producer already exists");
		redirect('/Producer/manage_Producer','refresh');
	}
	function delete_Producer()
	{
			$ret_message=$this->mproducer->delete_Producer();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Producer deleted successfully");
		else
			$this->session->set_flashdata("error","This Producer can not deleted. Associated child element exists.");
			
		redirect('/Producer/manage_Producer','refresh');
	}
	function update_Producer()
	{
		if($this->mproducer->update_Producer()==TRUE)
			$this->session->set_flashdata("success","Producer saved successfully");
		else
			$this->session->set_flashdata("error","Producer already exists");
		redirect('/Producer/manage_Producer','refresh');
	}
}