	<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

		
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->model('Mmovie','movie');
		$this->load->model('Mmovietype','movietype');
		$this->load->model('Mactor','actor');
		$this->load->model('Muser','user');
		$this->load->library('ion_auth');
		$this->load->library('session');
		
		session_start();
	}
	



	public function index()
	{
		$data = array();
			$data = $this->common_function();
		$data["title"]="Movie Mania Free Movie ,video etc..";
			$data["title"]="Movie Mania Free Movie ,video etc..";
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
			$data["Movie_movie"]=$this->movie->get_all_movie();
			$data["Movie_movietype"]=$this->movietype->get_movietype();
			$data["most_comment_movie"]=$this->movie->most_comment();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["actor_birthday"]=$this->actor->get_actor_birthday();
			$data["see_all_detail"]=$this->movie->see_all($pageNumber,$record_per_page);
		$this->load->view("home",$data);
	}

	public function common_function()
	{

		$auto_complete =  $this->movie->get_auto_complete();
		$data['auto_count'] = $auto_complete['result_count'];
		$data['auto_array'] = $auto_complete['result_array'];
		return $data;
	}

	public function register()
	{

		$data = array();
			$data = $this->common_function();
		if($this->ion_auth->logged_in())
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			redirect('home','refresh');
			
		}
		else
		{
			$data['Email']="";
			$data['user']="";
			$data['id']="";
		}
			$data["title"]="Register your account Here...";
			$data["Movie_movietype"]=$this->movietype->get_movietype();
			$data["most_comment_movie"]=$this->movie->most_comment();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		
		$this->load->view("register",$data);

	}

	public function login()
	{

		$data = array();
		$data = $this->common_function();
		if($this->ion_auth->logged_in())
		{
			redirect('home','refresh');
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
		$data['message']='';
		$data["title"]="Login Here...";
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		$this->load->view("login",$data);

	}

	public function user_details($id)
	{
		unset($data);
		$data = array();
		$data = $this->common_function();

		if($this->ion_auth->logged_in())
		{
			$query = $this->user->get_user_details();
			
			$data['id']=$query['id'];
			$data['user']=$query['username'];
			$data['first_name']=$query['first_name'];
			$data['last_name']=$query['Last_Name'];
			$data['gender']=$query['gender'];
			$data['dob']=$query['date_of_birth'];
			$data['image']=$query['user_image'];
			$data['country']=$query['country'];
			$data['postal']=$query['zip'];
			$data['Email']=$query['email'];
			$data['phone']=$query['phone'];

		}
		else
		{
			$data['Email']="";
			$data['user']="";
			$data['id']="";
			redirect('home','refresh');
		}
			$data["title"]="User Details";
			$data["Movie_movietype"]=$this->movietype->get_movietype();
			$data["most_comment_movie"]=$this->movie->most_comment();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		
		$this->load->view("profile",$data);

	}

 
	public function update_user_details($id)
	{
		
		$data['id']=$this->ion_auth->get_user()->id;
		if($this->user->update_user_details($id))
			{
				$this->session->set_flashdata("success","User Detail Updated.");
			}	
			else
			{
				$this->session->set_flashdata("error","Error in Updating User Detail");
			}			
			redirect('/user/user_details/'.$data['id'],'refresh');
	}

	public function forgetpassword()
	{
		$data = array();
			$data = $this->common_function();
			if($this->ion_auth->logged_in())
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			redirect('home','refresh');
			
		}
		else
		{
			
			$data['Email']="";
			$data['user']="";
			$data['id']="";
		}
		$data['title']="forget password..";
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
			$data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		$this->load->view("forgetpassword",$data);
	}
	
	public function changepassword()
	{
		$data = array();
		$data = $this->common_function();
		if($this->ion_auth->logged_in())
		{
			$data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			$email =$this->ion_auth->get_user()->email;
			$oldpass = $this->input->post('oldpassword');
			$newpass = $this->input->post('newpassword');

			$flag=$this->ion_auth->change_password($email, $oldpass, $newpass);
			if($flag==TRUE)
				$this->session->set_flashdata("success","Password changed successfully");
			else
				$this->session->set_flashdata("error","Password not matched");
			redirect('/user/changepasswordview','refresh');
		}
		else
		{
			$data['Email']="";
			$data['user']="";
			$data['id']="";
			
		}
		$data['title']="Change Password";
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		

		
	}

	public function changepasswordview()
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
			$data['user']="";
			$data['Email']="";
			$data['id']="";
			redirect('home','refresh');
			
		}
		$data['title']="Change Password";
		$data["Movie_movietype"]=$this->movietype->get_movietype();
		$data["most_comment_movie"]=$this->movie->most_comment();
		$data["mostcomment_count"]=$this->movie->most_comment_count();
		$data["home_seeall_count"]=$this->user->home_seeall_count();
		$data["actor_birthday"]=$this->actor->get_actor_birthday();
		$this->load->view("changepassword",$data);
	}

	public function create_user()
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
			$username = '';
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$gender =$this->input->post('gender');
			$country = $this->input->post('country');
			$txtDOB = $this->input->post('txtDOB');
			$postal=$this->input->post('postal');
			$phone=$this->input->post('phone');
	
			
			$this->load->library('ion_auth');

			$password = $this->input->post('password1');
			
			$email = $this->input->post('email');

			
		$username = $first_name." ".$last_name;		
		$password = $password;		
		$additional_data = array(
							
								);
		$group_name = 'members';
		$this->ion_auth->register($username, $password, $email, $additional_data, $group_name);
		$this->user->update_user_detail();

		$this->session->set_flashdata("success","Successfully Registration Done");
		redirect('user/register', 'refresh');
		
	}

	function logout()
	{	
		$data = $this->common_function();
		$this->ion_auth->logout();
		redirect("/", 'refresh');
	}

	function check_login()
	{
			
		$data = $this->common_function();
		
		$email = $this->input->post('email');
		$password = $this->input->post('password1');
	
		
		if($this->ion_auth->login($email, $password))
		{ //if login successful
			$this->data['message']= $this->ion_auth->messages();
			if($this->ion_auth->logged_in())
		{
			$this->data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			
		}
		else
		{
			$this->data['Email']="";
			$data['user']="";
			$data['id']="";
		}
			$this->data["title"]="Movie Mania Free Movie ,video etc..";
			$this->data["Movie_movie"]=$this->movie->get_all_movie();
			$this->data["Movie_movietype"]=$this->movietype->get_movietype();
			$this->data["most_comment_movie"]=$this->movie->most_comment();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["mostcomment_count"]=$this->movie->most_comment_count();
			$data["home_seeall_count"]=$this->user->home_seeall_count();
			$this->data["actor_birthday"]=$this->actor->get_actor_birthday();
		
		
			redirect('home', 'refresh');
		
		}	
		else
		{ 
				$this->data = $this->common_function();
		if($this->ion_auth->logged_in())
		{
			$this->data['Email']=$this->ion_auth->get_user()->email;
			$data['user']=$this->ion_auth->get_user()->username;
			$data['id']=$this->ion_auth->get_user()->id;
			
		}
		else
		{
			$this->data['Email']="";
			$data['user']="";
			$data['id']="";
		}
		$this->data['message']='';
		$this->data["title"]="Login Here...";
		$this->data["Movie_movietype"]=$this->movietype->get_movietype();
		$this->data["most_comment_movie"]=$this->movie->most_comment();
		$this->data["mostcomment_count"]=$this->movie->most_comment_count();
		$this->data["home_seeall_count"]=$this->user->home_seeall_count();
		$this->data["actor_birthday"]=$this->actor->get_actor_birthday();
			$this->data['message']= $this->ion_auth->errors();

			$this->load->view('login', $this->data);
		}	

	}	

	function sendnew_comment()
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
			$Movie_id = $_GET['Movie_id'];
		$message = $_GET['message'];
		 $this->user->insert_comment($Movie_id,$message);

		
		$query_str = 'select t1.* from (SELECT u.*,mc.movie_comment_id as movie_comment_id,mc.Comment,mc.time,TIMESTAMPDIFF(MINUTE, `time`, NOW()) as min,TIMESTAMPDIFF(SECOND, `time`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `time`, NOW()) as day,
			TIMESTAMPDIFF(HOUR, `time`, NOW()) as hr from movie_comment mc left join movie m on (m.movie_id = mc.movie_id) left join users u on (u.id = mc.user_id) where mc.movie_id = '.$Movie_id .'
		)t1
		order by t1.time desc';
		
		$query = $this->db->query($query_str);
		
			$movie_comment= $query->result();
			  	echo "<h4><b><u>Comments</u></b></h4>";
                         if(count($movie_comment) > 0)
                         {
                         foreach($movie_comment as $commnet)
                        {
                            echo "<div style='float:left; width:100%; padding-top:10px;width: 100%;'>";
                            if($commnet->user_image)
                                {
                                    echo"<div style='float:left;'><img style='height:38px;width:42px;' src='".base_url()."images/user/small/".$commnet->user_image."' alt='' /></div>";
                                }
                                else
                                {
                                     echo "<div style='float:left;'><img style='height:38px;width:42px;' src='".base_url()."images/default_image.jpg' alt='' /></div>";
                                }
                            echo"<div style='float:left;'><span style='float:left; padding-right:5px; padding-left:5px;'>".$commnet->first_name." ".$commnet->Last_Name."</span> &nbsp; &nbsp;";
                        if($commnet->hr > 24)
                            echo "&nbsp; &nbsp; <span style='float:left;'>".($commnet->time)." </span>";
                        elseif($commnet->min > 0 && $commnet->hr < 24)
                            echo " &nbsp; &nbsp; <span style='float:left;'>".$commnet->min." minutes ".substr($commnet->sec-(60 * $commnet->min),0,2)." Seconds ago</span>";
                        elseif($commnet->hr > 0 && $commnet->hr < 24)
                            echo " &nbsp; &nbsp; <span style='float:left;'>".$commnet->hr." Hours ".substr($commnet->min-(60 * $commnet->hr),0,2)." minutes ".substr($commnet->sec-(60 * 60 * $commnet->hr),0,2)." Seconds ago</span>";
                        else
                            echo "&nbsp; &nbsp; <span style='float:left;'>".($commnet->sec)." Seconds ago</span>";
                            echo'</div> <br />
                            <span>'.$commnet->Comment.'</span>
                        </div> <br />';
                        }
                       
                        }
                        else
                            {
                                echo "&nbsp;";
                            }
                            echo '</div>';
                           
	}




	function sendnew_review()
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
			
		$Movie_id = $_GET['Movie_id'];
		$message = $_GET['message'];

		$this->user->insert_review($Movie_id,$message);

		
		$query_str = 'select t1.* from (SELECT u.first_name,u.last_name,u.user_image,mr.Movie_Review_Id as Movie_Review_Id,mr.Review_Type as Review_Type,mr.Review_Desc as Review_Desc,mr.Review_Time as Time,TIMESTAMPDIFF(MINUTE, `Review_Time`, NOW()) as min,TIMESTAMPDIFF(SECOND, `Review_Time`, NOW()) as sec ,TIMESTAMPDIFF(DAY, `Review_Time`, NOW()) as day, TIMESTAMPDIFF(HOUR, `Review_Time`, NOW()) as hr from movie_review mr left join movie m on (m.movie_id = mr.Movie_Id) left join users u on (u.id = mr.user_id) where mr.Movie_Id = '.$Movie_id.' )t1 order by t1.time desc';
		

		$query = $this->db->query($query_str);
		$movie_review= $query->result();
		

			  	echo "<h4><b><u>Review</u></b></h4>";
                         if(count($movie_review) > 0)
                         {
                         foreach($movie_review as $review)
                        {
                            echo "<div style='float:left; width:100%; padding-top:10px;width: 100%;'>";
                            if($review->user_image)
                                {
                                    echo"<div style='float:left;'><img style='height:38px;width:42px;' src='".base_url()."images/user/small/".$review->user_image."' alt='' /></div>";
                                }
                                else
                                {
                                     echo "<div style='float:left;'><img style='height:38px;width:42px;' src='".base_url()."images/default_image.jpg' alt='' /></div>";
                                }
                            echo"<div style='float:left;'><span style='float:left; padding-right:5px; padding-left:5px;'>".$review->first_name." ".$review->last_name."</span> &nbsp; &nbsp;";
                        if($review->hr > 24)
                            echo "&nbsp; &nbsp; <span style='float:left;'>".($review->Time)." </span>";
                        elseif($review->min > 0 && $review->hr < 24)
                            echo " &nbsp; &nbsp; <span style='float:left;'>".$review->min." minutes ".substr($review->sec-(60 * $review->min),0,2)." Seconds ago</span>";
                        elseif($review->hr > 0 && $review->hr < 24)
                            echo " &nbsp; &nbsp; <span style='float:left;'>".$review->hr." Hours ".substr($review->min-(60 * $review->hr),0,2)." minutes ".substr($review->sec-(60 * 60 * $review->hr),0,2)." Seconds ago</span>";
                        else
                            echo "&nbsp; &nbsp; <span style='float:left;'>".($review->sec)." Seconds ago</span>";
                            echo'</div> <br />
                            <span>'.$review->Review_Desc.'</span>
                        </div> <br />';
                        }
                       
                        }
                        else
                            {
                                echo "&nbsp;";
                            }
                            echo '</div>';
                           
	}
}