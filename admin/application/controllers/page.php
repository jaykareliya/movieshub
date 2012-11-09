<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ion_auth_model');
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

	public function SetStyle()
	{
		
		$data = array(
                   'title' => "Admin Panel",
				   'user_name' => "Admin",
               );
		return $data;
	}
	
	public function assign_value_to_data()
	{
		$this->load->model('madmin');
		$data = array
		(
			"company_name"=>"Ramigifts",
			"user_name"=>"Admin",
		);
		
		$data['all_pages'] = '';
		return $data;
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will manage admin pages
	function manage_options()
	{
		$this->load->model('madmin');
		$page_id = $this->uri->segment(3);
		$current_page = $this->madmin->get_page($page_id);
		$data = $this->assign_value_to_data();
		$data["title"] = "Pages";
		$data["fill_admin_pages"] = $this->madmin->fill_admin_pages();
		$data["main_content"] = "admin_manage_options.php";
		$data["ddlPages"] = $this->madmin->bind_dropdown_pages();
		$data['dash_board'] = $current_page->title;
		$data['current_page'] = $current_page;

		$this->load->view("admin.php",$data);
	}
	function manage_faq()
	{
		if(!($_GET))
		{
			$this->session->set_userdata('newdata','');
		}
		
		
		$this->manage_faq1();
	}
	/// Created by  :: Yash Shah
	/// Description :: It will manage admin FAQ
	function manage_faq1()
	{
		$this->load->library('pagination');
		$this->load->model('madmin');
		
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
		
		$total_number_of_rows = $this->madmin->fill_faq_table();
		
		$config['base_url'] =  base_url()."index.php/page/manage_faq?";
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
		$data['fill_faq_table'] = $this->madmin->fill_faq_table_condition($pageNumber,$record_per_page);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data['title'] = "Manage FAQ";
		$data['dash_board'] = "Manage FAQ";
		$data["main_content"] = "admin_manage_faq.php";
		$this->load->view("admin.php",$data);
	}
	function manage_user()
	{
		if($this->ion_auth->logged_in())
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
		
		
		$this->manage_user1();
	}
	else
	{
		$this->session->set_flashdata("error","Must login to see this page");
		redirect('','refresh');
		
	}
	}
	/// Created by  :: Yash Shah
	/// Description :: It will manage users
	function manage_user1()
	{
		$this->load->model('muser');
		$this->load->library('pagination');
		
		$data = $this->assign_value_to_data();
		$alpha = $this->getAlpha();
		
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
		
		$total_number_of_rows = $this->muser->get_users($alpha);
		
		$config['base_url'] =  base_url()."index.php/page/manage_user?";
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
		$data['fill_user_table'] = $this->muser->fill_user_table_condition($pageNumber,$record_per_page,$alpha);
				
		$data['title'] = "Manage User";
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data['dash_board'] = "Manage User";
		$data["main_content"] = "admin_manage_user.php";
		$this->load->view("admin.php",$data);
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will manage admin profile
	function manage_profile()
	{
		$this->load->model('mprofile');
		
		$data = $this->assign_value_to_data();
		$data['title'] = "Manage Profile";
		$data['dash_board'] = "Manage Profile";
		$data['main_content'] = "admin_profile.php";
		$data['admin_profile'] = $this->mprofile->get_profile();
		$this->load->view("admin.php",$data);
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will manage orders
	function manage_order()
	{
		
		
		
		if($this->input->post('txtStartDate'))
		{
			$this->session->set_userdata('start_date',$this->input->post('txtStartDate'));
			$this->session->set_userdata('end_date',$this->input->post('txtEndDate'));
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		
		if($this->session->userdata('start_date'))
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		else
		{
			$start_date = date('d-m-Y');
			$end_date = date('d-m-Y');
		}
		
		
		$this->load->model('morder');
		$this->load->library('pagination');
		
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
		$total_number_of_rows = $this->morder->fill_order_table($start_date,$end_date,0);
		
		
		$config['base_url'] = base_url()."index.php/page/manage_order?";
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
		
		$data = $this->assign_value_to_data();
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['title'] = "Manage Order";
		$data['dash_board'] = "Manage Order";
		$data['main_content'] = "manage_order.php";
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;

		$data['fill_order_table'] = $this->morder->get_orders($start_date,$end_date,$pageNumber,$record_per_page,0);
		$data["start_date"] =$start_date;
		
		
		$data["end_date"] =$end_date;
		
		$data["action"]="manage_order";
		$this->load->view("admin.php",$data);
	}
	
	function manage_completed_order()
	{
		
		
		
		if($this->input->post('txtStartDate'))
		{
			$this->session->set_userdata('start_date',$this->input->post('txtStartDate'));
			$this->session->set_userdata('end_date',$this->input->post('txtEndDate'));
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		
		if($this->session->userdata('start_date'))
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		else
		{
			$start_date = date('d-m-Y');
			$end_date = date('d-m-Y');
		}
		
		
		$this->load->model('morder');
		$this->load->library('pagination');
		
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
		$total_number_of_rows = $this->morder->fill_order_table($start_date,$end_date,1);
		
		
		$config['base_url'] = base_url()."index.php/page/manage_order?records=".$record_per_page;
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
		
		$data = $this->assign_value_to_data();
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = "Manage Order";
		$data['dash_board'] = "Manage Order";
		$data['main_content'] = "manage_order.php";
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data['fill_order_table'] = $this->morder->get_orders($start_date,$end_date,$pageNumber,$record_per_page,1);
		$data["start_date"] =$start_date;
		
		
		$data["end_date"] =$end_date;
		
		$data["action"]="manage_completed_order";
		$this->load->view("admin.php",$data);
	}
	
	function manage_decalin_order()
	{
		$this->load->model('morder');
		$this->load->library('pagination');
		
		if($this->input->post('txtStartDate'))
		{
			$this->session->set_userdata('start_date',$this->input->post('txtStartDate'));
			$this->session->set_userdata('end_date',$this->input->post('txtEndDate'));
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		
		if($this->session->userdata('start_date'))
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		else
		{
			$start_date = date('d-m-Y');
			$end_date = date('d-m-Y');
		}
		
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
		$total_number_of_rows = $this->morder->fill_order_table($start_date,$end_date,2);
		
		
		$config['base_url'] = base_url()."index.php/page/manage_order?records=".$record_per_page;
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
		
		$data = $this->assign_value_to_data();
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = "Manage Order";
		$data['dash_board'] = "Manage Order";
		$data['main_content'] = "manage_order.php";
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data['fill_order_table'] = $this->morder->get_orders($start_date,$end_date,$pageNumber,$record_per_page,2);
		$data["start_date"] =$start_date;
		
		
		$data["end_date"] =$end_date;
		
		$data["action"]="manage_decalin_order";
		$this->load->view("admin.php",$data);
	}
	
	/// End of manage functions
	
	/// Created by  :: Hardik Dave
	/// Description :: This function is used to Set Home Page value @ admin side
 
	/// Returns     :: Set Value for Home page
	public function Homepage()
	{

		$data = $this->SetStyle(); 
		$data['main_content'] = "AdminHomePage.php";
		$data['title'] = "Admin Panel";
		$data['Page']= "Home Page";
		$this->load->view('admin.php',$data);
	}
	
	function get_city()
	{
		$data=$this->New_Shipment();
		$this->load->model('mcity');
		$data['getcity'] = $this->mcity->getCity();
	}
	
	
	public function change_password()
	{
			$data = $this->assign_value_to_data();
			$data['title'] = "Change Password";
			$data['dash_board']="Change Password";
			
			$data['Page']= "Password";
			$data['main_content']='change_password';
		
		if($this->input->post('newpass') && $this->input->post('retype_newpass'))
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$email =$this->ion_auth->get_user()->email;
			$oldpass = $this->input->post('oldpass');
			$newpass = $this->input->post('newpass');

			$flag=$this->ion_auth->change_password($email, $oldpass, $newpass);
			if($flag==TRUE)
				$this->session->set_flashdata("success","Password changed successfully");
			else
				$this->session->set_flashdata("error","Password not matched");
				
			redirect('page/change_passwordview','refresh');
				
			
		}
		else 
		{
				$this->load->view('admin.php',$data);		  
		}
		
		

		
	}

	public function change_passwordview()
	{
		$data = $this->assign_value_to_data();
		$data['title'] = "Change Password";
		$data['dash_board']="Change Password";
		$data['Page']= "Password";
		$data['main_content']='change_password';
		$this->load->view('admin.php',$data);

	}
	

   
	
	
	/// Created by  :: Yash Shah
	/// Description :: It will redirect the page to new/edit FAQ
	function new_faq()
	{
		$this->load->model('madmin');
		
		$data = $this->assign_value_to_data();
		$faq_id = $this->input->get('id');

		if(!$faq_id)
		{
			$data["title"] = "New FAQ";
			$data['dash_board'] = "New FAQ";
		}
		else
		{
			$data['faq_details'] = $this->madmin->fill_faq_details($faq_id);
			$data["title"] = "Update FAQ";
			$data['dash_board'] = "Update FAQ";
		}

		$data["main_content"] = "admin_new_faq.php";
		$this->load->view("admin.php",$data);
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will update user details and redirect the page to admin_manage_user
	function edit_user()
	{
		$this->load->model('muser');
		$data = $this->assign_value_to_data();
		$data['title'] = "Update user";
		$data['dash_board'] = "Update user information";
		$data['user_details'] = $this->muser->fill_user_details();
		$data["main_content"] = "admin_update_user.php";
		$this->load->view("admin.php",$data);
	}
	
	/// End of new functions
	
	
	/// Created by  :: Yash Shah
	/// Description :: It will save FAQ details and redirect the page to admin_manage_faq
	function save_faq()
	{    
		$this->load->model('madmin');
		if($this->madmin->save_new_faq()==TRUE)
		 	$this->session->set_flashdata("success","FAQ saved successfully");
		else
			$this->session->set_flashdata("error","FAQ already exists");
		redirect('/page/manage_faq','refresh');
	}
	
	/// End of save functions
	
	
	/// Created by  :: Yash Shah
	/// Description :: It will update admin pages details and redirect the page to admin_manage_options
	function update_admin()
	{
		$this->load->model('madmin');
		$this->madmin->update_pages();
		$this->session->set_flashdata("success","Content saved successfully");
		redirect('/page/manage_options/'.$this->uri->segment(3).'','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will update FAQ details and redirect the page to admin_manage_faq
	function update_faq()
	{
		$this->load->model('madmin');
		$this->madmin->update_faq();
		$this->session->set_flashdata("success","FAQ saved successfully");
		redirect('/page/manage_faq','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will update user details and redirect the page to admin_manage_user
	function update_user()
	{
		$this->load->model('muser');
		//$this->muser->update_user();
		$this->session->set_flashdata("success","User updated successfully");
		redirect('/page/manage_user','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will update admin details and redirect the page to manage_category
	function update_profile()
	{
		$this->load->model('mprofile');
		$this->mprofile->update_profile();
		$this->session->set_flashdata("success","Profile updated successfully");
		redirect('/page/manage_profile','refresh');
	}
	
	// End of update functions
	
	/// Created by  :: Yash Shah
	/// Description :: It will delete FAQ and redirect the page to admin_manage_faq
	function delete_faq()
	{
		$this->load->model('madmin');
		$this->madmin->delete_faq();
		$this->session->set_flashdata("success","FAQ deleted successfully");
		redirect('/page/manage_faq','refresh');
	}
	
	function delete_user()
	{
		$this->load->model('muser');
		if($this->muser->delete_user())
		{
			$this->session->set_flashdata('success','User deleted successfully.');
			redirect('page/manage_user','refresh');
		}
		else
		{
			$this->session->set_flashdata('error','unable to delete user. Please try again.');
			redirect('page/manage_user','refresh');
		}
	} 
	
	
	function logout()
	{
		$this->ion_auth->logout();
		$this->session->sess_destroy();
		redirect(base_url());
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
	
	function get_duplicate_record()
	{
		 $this->load->model('madmindetail');
		  $rec = $this->madmindetail->chk_dupli();
		  echo $rec;
	}
	function pages()
	{
	$this->load->model('admindetail');
		  $rows = $this->admindetail->bind_page();
	foreach($rows as $row)
		  {
				echo'<textarea rows="12" name="txtAdminPages" id="txtAdminPages" class="ckeditor">'.$row->description.'</textarea> ';}
			echo'<script type="text/javascript">CKEDITOR.replace( "txtAdminPages",{
					skin :"office2003",height:"100", width:"800"
				} );
				</script>';
		
	
	}
	function find_city()
	{
		$this->load->model('mcity');
		$rows = $this->mcity->bind_city();
	
		echo '<select name="ddlcity" id="ddlcity" class="ddlSelection required">
				<option value="">Select</option>';
		foreach($rows as $row)
		{
			echo '<option value='.$row->id.'>'.$row->name.'</option>';
		}
		echo'</select>';
	}
	
	function new_order()
	{
		$data = $this->assign_value_to_data();
		$order_id = $this->input->get('id');
		
		$this->load->model('morder');
		$data['order_details'] = $this->morder->fill_order_details($order_id);
		$data['fill_order_items'] = $this->morder->fill_order_items($order_id);
		$data['ddl_status'] = array("0"=>"Pending","1"=>"Confirm","2"=>"Declain");
		$data["title"] = "Update Order";
		$data['dash_board'] = "Update Order";
		
		
		$data["main_content"] = "admin_new_order.php";
		$this->load->view("admin.php",$data);
	}
	
	function complete_order()
	{
		$this->load->model('morder');
		$id = $this->input->post('txtOrderId');
		$this->morder->update_order($id,1);
		
		$this->session->set_flashdata('success','Order updated successfully');
		redirect('page/manage_order','refresh');
	}
	
	function reject_order()
	{
		$this->load->model('morder');
		$id = $this->input->post('txtOrderId');
		$this->morder->update_order($id,2);
		
		$this->session->set_flashdata('success','Order rejected successfully');
		redirect('page/manage_order','refresh');
	}
	
	function customise_order()
	{
	
		$this->load->model("M_cust_order");
		
		if($this->input->post('txtStartDate'))
		{
			$this->session->set_userdata('start_date',$this->input->post('txtStartDate'));
			$this->session->set_userdata('end_date',$this->input->post('txtEndDate'));
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		
		if($this->session->userdata('start_date'))
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
		}
		else
		{
			$start_date = date('d-m-Y');
			$end_date = date('d-m-Y');
		}
		
		
		$this->load->model('morder');
		$this->load->library('pagination');
		
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
		$total_number_of_rows = $this->M_cust_order->fill_order_table();
		
		
		$config['base_url'] = base_url()."index.php/page/customise_order?";
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
		
		$data = $this->assign_value_to_data();
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['title'] = "Customise Order";
		$data['dash_board'] = "Customise Order";
		$data['main_content'] = "customise_order.php";
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		
		$data['fill_cutomise_table'] = $this->M_cust_order->get_orders($pageNumber,$record_per_page);
		
		
		$data["action"]="customise_order";
		$this->load->view("admin.php",$data);
	}
}
?>
