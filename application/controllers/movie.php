<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Movie extends CI_Controller {		

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->model('Mactor','actor');
		$this->load->model('Mspecial_appereance');
		
		$this->load->model('Mdirector','director');
		$this->load->model('Mproducer','producer');
		$this->load->model('Msinger','singer');
		$this->load->model('Muser','user');
		$this->load->model('Mlyrics','lyrics');
		$this->load->model('Mchoreographer','choreographer');
		$this->load->model('Mscript_writer','script_writer');
		$this->load->model('Mmovie','movie');
		$this->load->model('Mmovietype','movietype');
		$this->load->library('ion_auth');
		$this->load->library('pagination');		

		
	}

	public function movie_search()
 	{
   		  $movie_name = $this->input->post("txtSearch");
   
		  $data = $this->common_function();
		  $data["most_comment_movie"]=$this->movie->most_comment();
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

		  $record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows =$this->movie->movie_search_count($movie_name);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		
		$config['base_url'] = base_url()."index.php/movie/movietype_see_all/".$type_id."?";
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


		  $data["Movie_movietype"]=$this->movietype->get_movietype();
		  $data["movie"]=$this->movie->movie_search($movie_name);
		  $data["actor_birthday"]=$this->actor->get_actor_birthday();
		  $data["mostcomment_count"]=$this->movie->most_comment_count();
		  $data["title"]="Movie In Theater";
		  $this->load->view("see_all",$data); 
 	}
	public function index()
	{
		$data = array();
		$data["title"]="Movie Mania Free Movie ,video etc..";
		$this->load->view("home",$data);
	}

		public function common_function()
	{

		$auto_complete =  $this->movie->get_auto_complete();
		$data['auto_count'] = $auto_complete['result_count'];
		$data['auto_array'] = $auto_complete['result_array'];
		return $data;
	}


	public function rating()
	{
		$data = $this->common_function();
		$this->movie->get_rating($this->ion_auth->get_user()->id);
	}

	public function movie_review()
	{
		$movie_id = $this->uri->segment(3);
		$cnt = $this->movie->in_theater_check();
		
		if($cnt > 3)
		{
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
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

		$record_per_page = isset($_GET["records"])?$_GET["records"]:4;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 4;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 4;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows =$this->user->movie_review_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 4;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/movie_review/".$movie_id."/?"; 
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

		$data['movie_review']=$this->user->movie_review($pageNumber,$record_per_page);
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["movie_review_count"]=$this->user->movie_review_count();
		$data["title"]="";
		$this->load->view("review",$data);
		}
	  else
		echo "No of Records not Found";
	}

	public function critic_review()
	{
		$movie_id = $this->uri->segment(3);
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
		$data['critic_review']=$this->user->critic_review();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["title"]="";
		$this->load->view("critic_review",$data);
	  }

	public function movie_name()
	{
		
		$movie_id = $this->uri->segment(3);
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

		$data["Movie_actor"] = $this->actor->get_actor($movie_id);
		$data["Movie_director"] = $this->director->get_director($movie_id);
		$data["Movie_special_appereance"] = $this->Mspecial_appereance->get_special_appereance($movie_id);
		$data["Movie_producer"]=$this->producer->get_producer($movie_id);
		$data["Movie_singer"]=$this->singer->get_singer($movie_id);
		$data["Movie_lyrics"]=$this->lyrics->get_lyrics($movie_id);
		$data["Movie_script_writer"]=$this->script_writer->get_script_writer($movie_id);
		$data["Movie_choreographer"]=$this->choreographer->get_choreographer($movie_id);
		$data["Movie_movie"]=$this->movie->get_movie($movie_id);
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["Movie_movietype_detail"]=$this->movietype->get_movietype_detail($movie_id);
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data['movie_comment'] = $this->user->movie_comment();
		$data['movie_review']=$this->user->movie_review_see_all();
		$data["Movie_review_count"]=$this->user->movie_review_count();
		$data["critic_review_count"]=$this->user->critic_review_count();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["title"]="critic-review";
		$this->load->view("movie_name",$data);

	}

	public function movie_intheater()

	{		
			$movie_id = $this->uri->segment(3);
				$data = $this->common_function();
			$data["most_comment_movie"]=$this->movie->most_comment();
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
			$data["Movie_movietype"]=$this->movietype->get_movietype();
			$data["movie_intheater"]=$this->movie->movie_in_theater();
			$data["movie_intheater_count"]=$this->movie->movie_in_theater_count();
			$data["actor_birthday"]=$this->actor->get_actor_birthday();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["title"]="Movie In Theater";
			$this->load->view("movie_intheater",$data);	

	}

	public function movie_intheater_see_all()
	{
		$cnt = $this->movie->in_theater_check();
		echo $cnt;
		if($cnt > 3)
		{
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
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


		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows =$this->movie->movie_in_theater_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/movie_intheater_see_all?";
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


		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["movie"]=$this->movie->movie_in_theater_see_all($pageNumber,$record_per_page);
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["title"]="Movie In Theater";
		$this->load->view("see_all",$data);	
	}
	else
		echo "No of Records not Found";
	}




	public function movie_commingsoon()
	{
		$data = $this->common_function();
			$data["most_comment_movie"]=$this->movie->most_comment();
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
			$data["Movie_movietype"]=$this->movietype->get_movietype();
			$data["movie_commingsoon"]=$this->movie->commingsoon();
			$data["movie_commingsoon_count"]=$this->movie->commingsoon_count();
			$data["actor_birthday"]=$this->actor->get_actor_birthday();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["title"]="Movie Realese In Future.....";
			$this->load->view("movie_commingsoon",$data);	

	}

	public function commingsoon_see_all()
	{
		$cnt = $this->movie->commingsoon_check();
		echo $cnt;
		if($cnt > 3)

		{
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
		
		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows =$this->movie->commingsoon_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/movie_intheater_see_all?";
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


		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->movie->commingsoon_see_all($pageNumber,$record_per_page);
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["title"]="Movie Realese In Future.....";
		$this->load->view("see_all",$data);	
	}
	else
		echo "No of Records not Found";
}


	public function movietype()
	{
		$data = $this->common_function();
		$movie_type_id= $this->uri->segment(3);
		$data["Movie_movietype"]=$this->movietype->get_movietype();
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
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["movietype"]=$this->movietype->movie_type();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movietype_trailer_cnt"]=$this->movietype->movie_type_trailer_count($movie_type_id);
		$data["movietype_trailer"]=$this->movietype->movie_type_trailer($movie_type_id);
		$data["title"]="comedey......";
		$this->load->view('movietype_name',$data);
	}


	public function movietype_see_all()
	{
		$cnt = $this->movietype->movie_type_check();
		
		if($cnt > 3)
		{
		$type_id = $this->uri->segment(3);
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

		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movietype->fill_movie_type($type_id);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/movietype_see_all/".$type_id."?";
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


		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->movietype->movie_type_see_all($pageNumber,$record_per_page,$type_id);

		$data["title"]="SEE ALL..";
		$this->load->view('see_all',$data);
	}
	else
		echo "No of Records not Found";
	}


	public function most_comment()
	{

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

		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["title"]="most Commented..";
		$this->load->view('mostcomment',$data);
	}

	public function most_comment_see_all()
	{

		$cnt=$this->movie->visible_seeall();
		if($cnt > 3)
		{
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
		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->most_comment_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/most_comment_see_all/?";
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


		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
			$data["movie"]=$this->movie->most_comment_see_all($pageNumber,$record_per_page);
		$data["title"]="most Commented..";
		$this->load->view('see_all',$data);
}
else
{
	echo "No of Records Not Found";
}
	}


	public function top_rated()
	{
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
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["top_rated"]=$this->movie->top_rated();
		$data["toprated_count"]=$this->movie->top_rated_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["title"]="TOP RATED.";
		$this->load->view('toprated',$data);
	}

	public function top_rated_see_all()
	{

		$cnt=$this->movie->visible_seeall();
		if($cnt > 3)
		{
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


			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->top_rated_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/top_rated_see_all/?";
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



		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["toprated_count"]=$this->movie->top_rated_count();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["movie"]=$this->movie->top_rated_see_all($pageNumber,$record_per_page);
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["title"]="TOP RATED.";
		$this->load->view('see_all',$data);
	}
	else
		echo "No of Records not Found";
}



	public function latest_movie()
	{
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
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
		$data["latest_movie_see_all"]=$this->movie->latest_movie_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["latest_movie"]=$this->movie->get_latest_movie();
		$data["latest_movie_count"]=$this->movie->latest_movie_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["title"]="LATEST MOVIES..";
		$this->load->view('latestmovie',$data);
	}

	public function latest_movie_see_all()
	{	
		$cnt=$this->movie->visible_seeall();
		if($cnt > 3)
		{
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
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


			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->latest_movie_count();
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/latest_movie_see_all/?";
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


		
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["latest_movie"]=$this->movie->get_latest_movie();
		$data["latest_movie_count"]=$this->movie->latest_movie_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["movie"]=$this->movie->get_latest_movie_see_all($pageNumber,$record_per_page);
		$data["title"]="LATEST MOVIES..";
		$this->load->view('see_all',$data);
	}
	else
		echo "No of Records Not Found";
	}


	public function see_all_detail()
	{
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
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
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["see_all_detail"]=$this->movie->see_all();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["title"]="SEE ALL..";
		$this->load->view('home',$data);
	}


	public function see_all()
	{
		$cnt=$this->movie->visible_seeall();
		if($cnt > 3)
		{
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();

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


			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->latest_movie_count();
		
		
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

		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["movie"]=$this->movie->see_all($pageNumber,$record_per_page);
		$data["title"]="SEE ALL..";
		$this->load->view('see_all',$data);
		}
		else
			echo "No of Records Not Found";
	}


	


	public function director_see_all()
	{
		$data = $this->common_function();
		$director_id = $this->uri->segment(3);
		
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
		

			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->director_movie_count($director_id);
		
		
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

		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->director->director_see_all($director_id,$pageNumber,$record_per_page);
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["title"]="..";
		$this->load->view('see_all',$data);
	}

	public function producer_see_all()
	{
		$data = $this->common_function();
		$producer_id = $this->uri->segment(3);
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


			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->producer_movie_count($producer_id);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/producer_see_all/?";
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

		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->producer->producer_see_all($producer_id,$pageNumber,$record_per_page);
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["title"]=".producer's all movies.";
		$this->load->view('see_all',$data);
	}

	public function actor_see_all()
	{
		$data = $this->common_function();
		$actor_id = $this->uri->segment(3);
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


			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->actor_movie_count($actor_id);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/actor_see_all/?";
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



		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["movie"]=$this->actor->actor_see_all($actor_id,$pageNumber,$record_per_page);
		$data["title"]=".actor's all movies.";
		$this->load->view('see_all',$data);
	}

	public function singer_see_all()
	{
		$data = $this->common_function();
		$singer_id = $this->uri->segment(3);
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


		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->singer_movie_count($singer_id);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/singer_see_all/?";
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


		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["movie"]=$this->singer->singer_see_all($singer_id,$pageNumber,$record_per_page);
		$data["title"]=".singer's all movies.";
		$this->load->view('see_all',$data);
	}


	public function script_writer_see_all()
	{
		
		$script_writer_id = $this->uri->segment(3);
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



		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->script_writer_movie_count($script_writer_id);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/script_writer_see_all/?";
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


		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->script_writer->script_writer_see_all($script_writer_id,$pageNumber,$record_per_page);
		$data["title"]=".script_writer's all movies.";
		$this->load->view('see_all',$data);
	}

	public function lyrics_see_all()
	{
		$data = $this->common_function();
		$lyrics_id = $this->uri->segment(3);
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

			$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->lyrics_movie_count($lyrics_id);
		
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/lyrics_see_all/?";
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



		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->lyrics->lyrics_see_all($lyrics_id,$pageNumber,$record_per_page);
		$data["title"]="Lyrics's all movies.";
		$this->load->view('see_all',$data);
	}

	public function choreographer_see_all()
	{
		$data = $this->common_function();
		$choreographer_id = $this->uri->segment(3);
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

		$record_per_page = isset($_GET["records"])?$_GET["records"]:15;
		
		if(isset($_GET["records"]))
			$this->session->set_userdata("newdata",$_GET["records"]);
		else
			$record_per_page = 15;
		
		if($this->session->userdata('newdata') == "")
			$record_per_page = 15;
		else
			$record_per_page = $this->session->userdata('newdata');
		
		$pageNumber = isset($_GET["per_page"])?$_GET["per_page"]:0;
		if($pageNumber=="")
			$pageNumber=0;
		$total_number_of_rows = $this->movie->choreographer_movie_count($choreographer_id);
		
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		

		$config['base_url'] = base_url()."index.php/movie/choreographer_see_all/?";
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



		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$data["movie"]=$this->choreographer->choreographer_see_all($choreographer_id,$pageNumber,$record_per_page);
		$data["title"]=".choreographer's all movies.";
		$this->load->view('see_all',$data);
	}
}