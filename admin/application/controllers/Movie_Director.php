<?php
class Movie_Director extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mMovie_Director');$this->load->model('MMovie');$this->load->model('MDirector');
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
	public function manage_Movie_Director()
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
		$this->manage_Movie_Director1();
	}

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}
	function manage_Movie_Director1()
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
		$total_number_of_rows = $this->mMovie_Director->fill_Movie_Director_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Movie_Director/manage_Movie_Director?";
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
		
		$data['fill_Movie_Director_table'] = $this->mMovie_Director->fill_Movie_Director_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Movie Directors";
		$data["dash_board"] = "Manage Movie Directors";
		$data["main_content"] = "admin_manage_Movie_Director.php";
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
		function new_Movie_Director()
	{
		$data = $this->assign_value_to_data();
		$Movie_Director_id = $this->input->get('Movie_Director_id');
		$movie=$this->MMovie->getAllMovies();
		$Director=$this->MDirector->getAllDirectors();

		if(!$Movie_Director_id)
		{
			$data["title"] = "New Movie Director";
			$data['dash_board'] = "New Movie Director";
			$data["bind_Movie"]=$movie;
			$data["bind_Director"]=$Director;
		}
		else
		{
			$data['Movie_Director_details'] = $this->mMovie_Director->fill_Movie_Director_details($Movie_Director_id);
			$data["title"] = "Update Movie Director";
			$Director=$this->MDirector->getDirectors();
			$data["bind_Movie"]=$movie;
			$data["bind_Director"]=$Director;
			$data['dash_board'] = "Update Movie Director";
		}
		
		$data["main_content"] = "admin_new_Movie_Director.php";
		$this->load->view("admin.php",$data);
	}
	function save_Movie_Director()
	{
		if($this->mMovie_Director->save_new_Movie_Director()==TRUE)
			$this->session->set_flashdata("success","Movie Director saved successfully");
		else
			$this->session->set_flashdata("error","Movie Director already exists");
		redirect('/Movie_Director/manage_Movie_Director','refresh');
	}
	function delete_Movie_Director()
	{
			$ret_message=$this->mMovie_Director->delete_Movie_Director();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Movie Director deleted successfully");
		else
			$this->session->set_flashdata("error","This Movie Director can not deleted. Associated child element exists.");
			
		redirect('/Movie_Director/manage_Movie_Director','refresh');
	}
	function update_Movie_Director()
	{
		if($this->mMovie_Director->update_Movie_Director()==TRUE)
			$this->session->set_flashdata("success","Movie Director saved successfully");
		else
			$this->session->set_flashdata("error","Movie Director already exists");
		redirect('/Movie_Director/manage_Movie_Director','refresh');
	}
}