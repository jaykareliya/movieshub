<?php
class Lyrics extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mLyrics');
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
	


	public function manage_Lyrics()
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
		$this->manage_Lyrics1();
	}


	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to bind Lyrics which admin wants to update @ admin side
 	/// Returns     :: all Lyrics details fetched from dataase

function bind_Lyrics()
{
	 $this->load->model('mLyrics');
		  $actor = $this->mLyrics->bind_Lyrics();
		
		  echo '<select name="ddlLyrics" id="ddlLyrics" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		  
		  foreach($actor as $actors)
		  {
		   echo '<option value="'.$actors->Lyrics_Id.'">'.$actors->Lyrics_Name.'</option>';
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
 	/// Description :: This function is used to Get All Lyrics to bind the records @ admin side
 
 	/// Returns     :: all Lyrics fetched from database


	function manage_Lyrics1()
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
		$total_number_of_rows = $this->mLyrics->fill_Lyrics_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/Lyrics/manage_Lyrics?";
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
		
		$data['fill_Lyrics_table'] = $this->mLyrics->fill_Lyrics_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Lyrics";
		$data["dash_board"] = "Manage Lyrics";
		$data["main_content"] = "admin_manage_Lyrics.php";
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
 	/// Description :: This function is used to Set Default value for add new Lyrics @ admin side
 
 	/// Returns     :: set default value for adding new Lyrics

		function new_Lyrics()
	{
		$data = $this->assign_value_to_data();
		$Lyrics_id = $this->input->get('Lyrics_id');
		
		if(!$Lyrics_id)
		{
			$data["title"] = "New Lyrics";
			$data['dash_board'] = "New Lyrics";
		}
		else
		{
			$data['Lyrics_details'] = $this->mLyrics->fill_Lyrics_details($Lyrics_id);
			
			$data["title"] = "Update Lyrics";
			$data['dash_board'] = "Update Lyrics";
		}
		
		$data["main_content"] = "admin_new_Lyrics.php";
		$this->load->view("admin.php",$data);
	}


	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to save the Lyrics @ admin side
 	/// Returns     :: retrun message wheather Lyrics is save or not

	function save_Lyrics()
	{
		if($this->mLyrics->save_new_Lyrics()==TRUE)
			$this->session->set_flashdata("success","Lyrics saved successfully");
		else
			$this->session->set_flashdata("error","Lyrics already exists");
		redirect('/Lyrics/manage_Lyrics','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to delete the Lyrics @ admin side
 	/// Returns     :: retrun message wheather Lyrics is deleted or not

	function delete_Lyrics()
	{
			$ret_message=$this->mLyrics->delete_Lyrics();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Lyrics deleted successfully");
		else
			$this->session->set_flashdata("error","This Lyrics can not deleted. Associated child element exists.");
			
		redirect('/Lyrics/manage_Lyrics','refresh');
	}

	/// Created by  :: Hardik Dave
 	/// Description :: This function is used to update already existed Lyrics @ admin side
 	/// Returns     :: wheather Lyrics is updated or not realated message



	function update_Lyrics()
	{
		if($this->mLyrics->update_Lyrics()==TRUE)
			$this->session->set_flashdata("success","Lyrics saved successfully");
		else
			$this->session->set_flashdata("error","Producer already exists");
		redirect('/Lyrics/manage_Lyrics','refresh');
	}
}