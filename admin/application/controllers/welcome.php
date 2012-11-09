<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}

	

  function index()
  {    
 
	//$data['title'] = "Welcome to Claudia's Kids";
	//$data['navlist'] = $this->MCats->getCategoriesNav();
	//$data['mainf'] = $this->MProducts->getMainFeature();
	//$skip = $data['mainf']['id'];
	//$data['sidef'] = $this->MProducts->getRandomProducts(3,$skip);

				$data['title'] = "Login";
				$data['company_name']="moviehub";
				$data['Page']= "Login Page";

			
				//$data['innovative_message']="Welcome admin. You can Add Flavour here. ".
				$data['dash_board']= "Admin Login";
				$data['main_content'] = "login.php";
				$data['Page']= "Admin Login";
				$data['main'] = 'adminlogin';
				
				$this->load->view('adminlogin.php',$data);
	/**
	 * Addition for captcha
	 */
	
	//$captcha_result = '';
	//$data['cap_img'] = $this -> _make_captcha();
	/**
	 * End of captcha
	 */
    
	$this->load->vars($data);
	
   }

  
  
  /**
   * End of captcha
   */
}//end controller class

?>