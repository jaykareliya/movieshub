<?php
class Actor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mactor');
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
		

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to bind actor which admin wants to update @ admin side
 	/// Returns     :: all Actor details fetched from dataase


	function bind_Actor()
	{
	 
		 $this->load->model('mactor');
		  $actor = $this->mactor->bind_actor();
		
		  echo '<select name="ddlActor" id="ddlActor" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($actor as $actors)
		  {
		   echo '<option value="'.$actors->Actor_Id.'">'.$actors->Actor_Name.'</option>';
		  }
		  
		  echo '</select>';
	
	}

 	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to Get All actor1 to bind the records @ admin side

 	/// Returns     :: all actor's name fetched from database


	function manage_actor()
	{

		$this->load->library('pagination');
		
		
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
		$total_number_of_rows = $this->mactor->fill_actor_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Actor/manage_actor?";
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
		
		$data['fill_actor_table'] = $this->mactor->fill_actor_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Actors";
		$data["dash_board"] = "Manage Actors";
		$data["main_content"] = "admin_manage_actor.php";
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
 	/// Description :: This function is used to Set Default value for add new actor @ admin side
 
 	/// Returns     :: set default value for adding new actor


		function new_actor()
	{
		
			$data = $this->assign_value_to_data();
			$actor_id = $this->input->get('Actor_id');
		
		if(!$actor_id)
		{
			$data["title"] = "New Actor";
			$data['dash_board'] = "New Actor";
		}
		else
		{
			$data['Actor_details'] = $this->mactor->fill_actor_details($actor_id);
			$data["title"] = "Update Actor";
			$data['dash_board'] = "Update Actor";
		}
		
		$data["main_content"] = "admin_new_Actor.php";
		$this->load->view("admin.php",$data);
		
		
	}



	function save_ACtor()
	{
		if($this->mactor->save_new_Actor()==TRUE)
			$this->session->set_flashdata("success","Actor saved successfully");
		else
			$this->session->set_flashdata("error","Actor already exists");
		redirect('/Actor/manage_actor','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to delete the Actor @ admin side
 	/// Returns     :: retrun message wheather Actor is deleted or not


	function delete_Actor()
	{
			$ret_message=$this->mactor->delete_actor();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Actor deleted successfully");
		else
			$this->session->set_flashdata("error","This Actor can not deleted. Associated child element exists.");
			
		redirect('/actor/manage_actor','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to update already existed Actor @ admin side
 	/// Returns     :: wheather Actor is updated or not realated message



	function update_ACtor()
	{
			if($this->mactor->update_Actor()==TRUE)
			$this->session->set_flashdata("success","Actor saved successfully");
			else
			$this->session->set_flashdata("error","Actor already exists");
			redirect('/Actor/manage_actor','refresh');
	
		
	}
}