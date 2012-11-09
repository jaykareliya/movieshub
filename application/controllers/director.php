<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Director extends CI_Controller {

		
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->model('Mdirector','director');
		$this->load->model('Mmovie','movie');
		$this->load->model('Mmovietype','movietype');
		$this->load->model('Mactor','actor');

		session_start();
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

	public function director_name()
	{
		
		$director_id=$this->uri->segment(3);
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
		$data["title"]="Kabir Khan's Movie, Photo,video,news,upcoming movies....";
		$data["director_detail"]=$this->director->get_director_detail($director_id);
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["director_movie"]=$this->movie->get_director_movie($director_id);
		$data["director_movie_count"]=$this->director->director_movie_count($director_id);
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		$this->load->view("director_name",$data);	
	}
	
	public function director_allmovie()
	{	
		$data = $this->common_function();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["director"]=$this->director->director();

		$this->load->view("director_name",$data);
	}
	
}