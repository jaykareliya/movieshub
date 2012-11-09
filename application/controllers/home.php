<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

		
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->model('Mmovie','movie');
		$this->load->model('Mmovietype','movietype');
		$this->load->model('Mactor','actor');
		$this->load->model('Muser','user');
		$this->load->library('ion_auth');$this->load->library('pagination');
		session_start();
	}
	public function common_function()
	{

		$auto_complete =  $this->movie->get_auto_complete();
		$data['auto_count'] = $auto_complete['result_count'];
		$data['auto_array'] = $auto_complete['result_array'];
		return $data;
	}
	
	public function index()
	{
		
		$data = array();
		$data = $this->common_function();
		if($this->ion_auth->logged_in())
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			
			
		}
		else
		{
			$data['Email']="";
			$data['user']="";
			$data['id']="";
			
		}
		$data["news"]=$this->user->get_news();
		$data["title"]="Movie Mania Free Movie ,video etc..";
		$data["Movie_movie"]=$this->movie->get_all_movie();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["see_all_detail"]=$this->movie->see_all(0,4);
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
		$data["news_seeall_count"]=$this->user->news_seeall_count();
		
		

		$this->load->view("home",$data);

		
	}

	public function contact()
	{	
		
		$data = array();
		$data = $this->common_function();
		$data["title"]="Contact Us";
		if($this->ion_auth->logged_in())
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			$data['phone']=$this->ion_auth->get_user()->phone;
		}
		else
		{
			$data['Email']="";
			$data['user']="";
			$data['id']="";
			$data['phone']="";
		}
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		$this->load->view("contact",$data);
	}

	public function contact_send()
	{
		
		$contact_name = $this->input->post('contact_name');
		$contact_email = $this->input->post('contact_email');
		$contact_phone = $this->input->post('contact_phone');
		$contact_msg = $this->input->post('contact_msg');
		
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => '465',
			'smtp_user' => 'hardpatel58@gmail.com',
			'smtp_pass' => 'pinatech123'	
						);
		$message = "<h6>Hello".$contact_name."</h6><br><br><p>We will get back to you within 6 working days.</p><br><br>Thankyou<br>Hardik";

		$this->load->library('email');

		$this->email->set_newline("\r\n");
		
		$this->email->from('hardpatel58@gmail.com','Hardik Patel');
		$this->email->to($contact_email);		
		$this->email->subject('Contact Confirmation');		
		$this->email->message($message);
		
				
		if($this->email->send())
		{
			echo 'Your email was sent, fool.';
		}
		
		else
		{
			show_error($this->email->print_debugger());
		}
	}

	public function news()
	{
		
		$data = array();
		$data = $this->common_function();
		$data["news"]=$this->user->get_news();
		$data["title"]="News";
		if($this->ion_auth->logged_in())
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
		}
		else
		{
			$data['Email']="";
			$data['user']="";
			$data['id']="";
			
		}

		$record_per_page = isset($_GET["records"])?$_GET["records"]:20;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 20;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 20;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->user->news_seeall_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/see_all/?";
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

		$data["Movie_movie"]=$this->movie->get_all_movie();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["news_detail"]=$this->user->news_detail_see_all($pageNumber,$record_per_page);
		$data["news_seeall_count"]=$this->user->news_seeall_count();


		$data["see_all_detail"]=$this->movie->see_all($pageNumber,$record_per_page);

		$this->load->view("news",$data);
	}
 
	public function news_see_all()
	{

		$data = array();
		$data = $this->common_function();
		$data["Movie_movie"]=$this->movie->get_all_movie();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["news_detail"]=$this->user->news_detail_see_all();
		

		$data["see_all_detail"]=$this->movie->see_all();
		$this->load->view("news",$data);
	}
	
}