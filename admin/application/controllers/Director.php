<?php
class Director extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdirector');
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


	public function manage_Director()
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
		$this->manage_director1();
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to bind Director which admin wants to update @ admin side
 	/// Returns     :: all Director details fetched from dataase


function bind_Director()
{
	 $this->load->model('mDirector');
		  $actor = $this->mDirector->bind_Director();
		
		  echo '<select name="ddlDirector" id="ddlDirector" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($actor as $actors)
		  {
		   echo '<option value="'.$actors->Director_id.'">'.$actors->Director_Name.'</option>';
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

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to Get All Director1 to bind the records @ admin side

 	/// Returns     :: all actor's name fetched from database


	function manage_director1()
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
		$total_number_of_rows = $this->mdirector->fill_director_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Director/manage_director?";
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
		
		$data['fill_director_table'] = $this->mdirector->fill_director_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Directors";
		$data["dash_board"] = "Manage Directors";
		$data["main_content"] = "admin_manage_director.php";
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
 	/// Description :: This function is used to Set Default value for add new director @ admin side

 	/// Returns     :: set default value for adding new director


		function new_director()
	{
		$data = $this->assign_value_to_data();
		$director_id = $this->input->get('Director_id');
		
		if(!$director_id)
		{
			$data["title"] = "New Director";
			$data['dash_board'] = "New Director";
		}
		else
		{
			$data['Director_details'] = $this->mdirector->fill_director_details($director_id);
			$data["title"] = "Update Director";
			$data['dash_board'] = "Update Director";
		}
		
		$data["main_content"] = "admin_new_Director.php";
		$this->load->view("admin.php",$data);
	}
	function save_Director()
	{
		if($this->mdirector->save_new_Director()==TRUE)
			$this->session->set_flashdata("success","Director saved successfully");
		else
			$this->session->set_flashdata("error","Director already exists");
		redirect('/Director/manage_Director','refresh');
	}


	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to delete the banner @ admin side
 	/// Returns     :: retrun message wheather banner is deleted or not

	function delete_director()
	{
			$ret_message=$this->mdirector->delete_director();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","director deleted successfully");
		else
			$this->session->set_flashdata("error","This Director can not deleted. Associated child element exists.");
			
		redirect('/director/manage_director','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to update already existed director @ admin side
 	/// Returns     :: wheather director is updated or not realated message

	function update_director()
	{
		if($this->mdirector->update_director()==TRUE)
			$this->session->set_flashdata("success","Director saved successfully");
		else
			$this->session->set_flashdata("error","Director already exists");
		redirect('/director/manage_director','refresh');
	}
}