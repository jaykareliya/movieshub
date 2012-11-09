<?php
class Movie_Script_Writer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mMovie_Script_Writer');$this->load->model('MMovie');$this->load->model('MScript_Writer');
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
	public function manage_Movie_Script_Writer()
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
		$this->manage_Movie_Script_Writer1();
	}

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}
	function manage_Movie_Script_Writer1()
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
		$total_number_of_rows = $this->mMovie_Script_Writer->fill_Movie_Script_Writer_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Movie_Script_Writer/manage_Movie_Script_Writer?";
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
		
		$data['fill_Movie_Script_Writer_table'] = $this->mMovie_Script_Writer->fill_Movie_Script_Writer_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Movie Script Writers";
		$data["dash_board"] = "Manage Movie Script Writers";
		$data["main_content"] = "admin_manage_Movie_Script_Writer.php";
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
		function new_Movie_Script_Writer()
	{
		$data = $this->assign_value_to_data();
		$Movie_Script_Writer_id = $this->input->get('Movie_Script_Writer_id');
		$movie=$this->MMovie->getAllMovies();
		$Script_Writer=$this->MScript_Writer->getAllScript_Writers();

		if(!$Movie_Script_Writer_id)
		{
			$data["title"] = "New Movie Script Writer";
			$data['dash_board'] = "New Movie Script Writer";
			$data["bind_Movie"]=$movie;
			$data["bind_Script_Writer"]=$Script_Writer;
		}
		else
		{
			$data['Movie_Script_Writer_details'] = $this->mMovie_Script_Writer->fill_Movie_Script_Writer_details($Movie_Script_Writer_id);
			$data["title"] = "Update Movie Script Writer";
			$Script_Writer=$this->MScript_Writer->getScript_Writers();
			$data["bind_Movie"]=$movie;
			$data["bind_Script_Writer"]=$Script_Writer;
			$data['dash_board'] = "Update Movie Script_Writer";
		}
		
		$data["main_content"] = "admin_new_Movie_Script_Writer.php";
		$this->load->view("admin.php",$data);
	}
	function save_Movie_Script_Writer()
	{
		if($this->mMovie_Script_Writer->save_new_Movie_Script_Writer()==TRUE)
			$this->session->set_flashdata("success","Movie Script Writer saved successfully");
		else
			$this->session->set_flashdata("error","Movie Script Writer already exists");
		redirect('/Movie_Script_Writer/manage_Movie_Script_Writer','refresh');
	}
	function delete_Movie_Script_Writer()
	{
			$ret_message=$this->mMovie_Script_Writer->delete_Movie_Script_Writer();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Movie Script Writer deleted successfully");
		else
			$this->session->set_flashdata("error","This Movie Script Writer can not deleted. Associated child element exists.");
			
		redirect('/Movie_Script_Writer/manage_Movie_Script_Writer','refresh');
	}
	function update_Movie_Script_Writer()
	{
		if($this->mMovie_Script_Writer->update_Movie_Script_Writer()==TRUE)
			$this->session->set_flashdata("success","Movie Script Writer saved successfully");
		else
			$this->session->set_flashdata("error","Movie Script Writer already exists");
		redirect('/Movie_Script_Writer/manage_Movie_Script_Writer','refresh');
	}
}