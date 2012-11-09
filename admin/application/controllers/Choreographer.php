<?php
class Choreographer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mChoreographer');
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

	public function manage_Choreographer()
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
		$this->manage_Choreographer1();
	}

	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to bind Choreographer which admin wants to update @ admin side
 	/// Returns     :: all Choreographer details fetched from dataase

	
	function bind_Choreographer()
	{

	 
		 $this->load->model('mChoreographer');
		  $Choreographer = $this->mChoreographer->bind_Choreographer();
		
		  echo '<select name="ddlChoreographer" id="ddlChoreographer" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($Choreographer as $Choreographers)
		  {
		   echo '<option value="'.$Choreographers->Choreographer_Id.'">'.$Choreographers->Choreographer_Name.'</option>';
		  }
		  
		  echo '</select>';
	
	}
	function manage_Choreographer1()
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
		$total_number_of_rows = $this->mChoreographer->fill_Choreographer_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Choreographer/manage_Choreographer?";
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
		
		$data['fill_Choreographer_table'] = $this->mChoreographer->fill_Choreographer_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Choreographer";
		$data["dash_board"] = "Manage Choreographer";
		$data["main_content"] = "admin_manage_Choreographer.php";
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
 	/// Description :: This function is used to Set Default value for add new Choreographer @ admin side
 
 	/// Returns     :: set default value for adding new Choreographer

		function new_Choreographer()
	{
		$data = $this->assign_value_to_data();
		$Choreographer_id = $this->input->get('Choreographer_id');
		
		if(!$Choreographer_id)
		{
			$data["title"] = "New Choreographer";
			$data['dash_board'] = "New Choreographer";
		}
		else
		{
			$data['Choreographer_details'] = $this->mChoreographer->fill_Choreographer_details($Choreographer_id);
			
			$data["title"] = "Update Choreographer";
			$data['dash_board'] = "Update Choreographer";
		}
		
		$data["main_content"] = "admin_new_Choreographer.php";
		$this->load->view("admin.php",$data);
	}





	function save_Choreographer()
	{
		if($this->mChoreographer->save_new_Choreographer()==TRUE)
			$this->session->set_flashdata("success","Choreographer saved successfully");
		else
			$this->session->set_flashdata("error","Choreographer already exists");
		redirect('/Choreographer/manage_Choreographer','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to delete the Choreographer @ admin side
 	/// Returns     :: retrun message wheather Choreographer is deleted or not




	function delete_Choreographer()
	{
			$ret_message=$this->mChoreographer->delete_Choreographer();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Choreographer deleted successfully");
		else
			$this->session->set_flashdata("error","This Choreographer can not deleted. Associated child element exists.");
			
		redirect('/Choreographer/manage_Choreographer','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to update already existed Choreographer @ admin side
 	/// Returns     :: wheather Choreographer is updated or not realated message


	function update_Choreographer()
	{
		if($this->mChoreographer->update_Choreographer()==TRUE)
			$this->session->set_flashdata("success","Choreographer saved successfully");
		else
			$this->session->set_flashdata("error","Producer already exists");
		redirect('/Choreographer/manage_Choreographer','refresh');
	}
}