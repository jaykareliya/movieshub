<?php
class Critic_Review extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mCritic_Review');$this->load->model('MMovie');
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
	
	public function manage_Creview()
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
		$this->manage_Creview1();
	}

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to Get All Movie_Actor1 to bind the records @ admin side
 
 	/// Returns     :: all Movie_Actor1 fetched from database


	function manage_Creview1()
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
		$total_number_of_rows = $this->mCritic_Review->fill_Creview_table1($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Critic_Review/manage_Creview?";
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
		
		$data['fill_Creview_table'] = $this->mCritic_Review->fill_Creview_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Critic Review";
		$data["dash_board"] = "Manage Critic Review";
		$data["main_content"] = "admin_manage_Critic_Review.php";
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

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to Set Default value for add new Movie_Actor @ admin side
 
 	/// Returns     :: set default value for adding new Movie_Actor


		function new_creview()
	{
		$data = array();
		$Creview_Id = $this->input->get('Creview_Id');
		$movie=$this->MMovie->getAllMovies();
		

		if(!$Creview_Id)
		{
			$data["title"] = "New Critic Review";
			$data['dash_board'] = "New Critic Review";
			$data["bind_Movie"]=$movie;
			
		}
		else
		{
			$data['Creview_details'] = $this->mCritic_Review->fill_Creview_details($Creview_Id);
			$data["title"] = "Update Critic Review";
		
			$data["bind_Movie"]=$movie;
			$data['dash_board'] = "Update Critic Review";
		}
		
		$data["main_content"] = "admin_new_critic_review.php";
		$this->load->view("admin.php",$data);
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to save Movie_Actor @ admin side
 
 	/// Returns     :: retrun message wheather banner is save or not


	function save_Creview()
	{
		if($this->mCritic_Review->save_new_creview()==TRUE)
			$this->session->set_flashdata("success","Critic Review saved successfully");
		else
			$this->session->set_flashdata("error","Critic Review already exists");
		redirect('/Critic_Review/manage_Creview','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to delete the Movie_Actor @ admin side
 	/// Returns     :: retrun message wheather Movie_Actor  is deleted or not


	function delete_Creview()
	{
			$ret_message=$this->mCritic_Review->delete_creview();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Critic Review deleted successfully");
		else
			$this->session->set_flashdata("error","This Critic Review can not deleted. Associated child element exists.");
			
		redirect('/Critic_Review/manage_Creview','refresh');
	}
	function update_Creview()
	{
		if($this->mCritic_Review->update_creview()==TRUE)
			$this->session->set_flashdata("success","Critic Review saved successfully");
		else
			$this->session->set_flashdata("error","Critic Review already exists");
		redirect('/Critic_Review/manage_Creview','refresh');
	}
}