<?php
class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mproduct');
		$this->load->model('madmin');
	}
	
	public function assign_value_to_data()
	{
		$data = array
		(
		
		);
		
		
		return $data;
	}
	function manage_product()
	{
		
		if(!($_GET))
		{
			$this->session->set_userdata('alpha',"");
			$this->session->set_userdata('newdata','');
			$this->session->set_userdata('catId',"");
			
		}
		else
		{
			if(array_key_exists("alpha", $_GET)) 
			if($_GET["alpha"] == "ALL")
			{
				$this->session->set_userdata('alpha',"");
				$this->session->set_userdata('newdata','');
				$this->session->set_userdata('catId',"");
				
			}
		}
		
		$this->manage_product1();
	}

	function get_duplicate_record()
	{
		 $this->load->model('madmin');
		  $rec = $this->madmin->chk_dupli();
		  echo $rec;
	}
	/// Created by  :: Yash Shah
	/// Description :: It will manage product
	function manage_product1()
	{
		$this->load->model('mcategory');
		
		$this->load->library('pagination');
		
		$data = $this->assign_value_to_data();
		
		// code added for search
		$alpha = $this->getAlpha();
		
		//Extra code for searching
		$keyword = "";
		if($this->input->post('txtKeyword'))
		{
			$keyword = $this->input->post('txtKeyword');
			$alpha = $keyword;
		}
		//upto here
		
		$cat_id = isset($_GET["category"])?$_GET["category"]:0;
		
		if(isset($_GET["category"]))
			$this->session->set_userdata("catId",$_GET["category"]);
		else
			$cat_id = 0;
		
		if($this->session->userdata('catId') == "")
			$cat_id = 0;
		else
			$cat_id = $this->session->userdata('catId');
			
		
		// upto here
		
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
			
		$total_number_of_rows = $this->mproduct->fill_product_table($alpha,$cat_id,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		
		
		$config['base_url'] =  base_url()."/index.php/product/manage_product?";
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
		
		$data['bind_category'] = $this->mcategory->bind_dropdown_category();
		$data['ddlCategorySelected'] = $cat_id;
		
		
		$data['fill_product_table'] = $this->mproduct->fill_product_table_condition($pageNumber,$record_per_page,$alpha,$cat_id,$keyword);

		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data['title'] = "Manage Product";
		$data['dash_board'] = "Manage Product";
		$data['main_content'] = "admin_manage_product.php";
		
		$this->load->view("admin.php",$data);
	}
	function bind_state()
	 {
	 	
		 $this->load->model('mstate');
		  $State = $this->mstate->bind_dropdown_State($this->input->get('country'));
		  
		  echo '<select name="ddlState" id="ddlState" onchange="getCity(this.value)" class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		
		  foreach($State as $Sates)
		  {
		  	
		   echo '<option value="'.$Sates->State_id.'">'.$Sates->State_name.'</option>';
		  }
		  
		  echo '</select>';
	 }
	 function bind_city()
	 {
	 	
		 $this->load->model('mcity');
		  $City = $this->mcity->bind_dropdown_City($this->input->get('state'));
		  
		  echo '<select name="ddlCity" id="ddlCity"  class="ddlSelection required">';
		  echo '<option value="">Select</option>';
		
		  foreach($City as $cities)
		  {
		  	
		   echo '<option value="'.$cities->City_id.'">'.$cities->City_name.'</option>';
		  }
		  
		  echo '</select>';
	 }
	/// Created by  :: Yash Shah
	/// Description :: It will redirect the page to new/edit product
	function new_product()
	{
		$this->load->model('mcategory');
		$this->load->model('mcountry');
		$this->load->model('mstate');
		$this->load->model('mcity');
		
		$data = $this->assign_value_to_data();
		$data["bind_category"] = $this->mcategory->bind_dropdown_category();
		$data["bind_country"] = $this->mcountry->bind_dropdown_Country();
		
		//$categoryId = $this->input->post('categoryId');
		$product_id = $this->input->get('id');
		$category_id = "";
		$country = "";
		$state = "";
		$city = "";
		if(!$product_id)
		{
			$data["title"] = "New Product";
			$data['dash_board'] = "New Product";
			$data["country"]="0";
			$data["state"]="0";
			$data["City"]="0";

		}
		else
		{
			$data['product_details'] = $this->mproduct->fill_product_details($product_id);
			
			$data["title"] = "Update Product";
			$data['dash_board'] = "Update Product";
			$category_id = $data['product_details'][0]->Category_id;
			$country = $data['product_details'][0]->Country_id;
		}
		
		$data["bind_state"] = $this->mstate->bind_dropdown_State1($country);
		$state = $data['product_details'][0]->State_id;
		$data["bind_city"] = $this->mcity->bind_dropdown_city1($state);
		$City = $data['product_details'][0]->City_id;

		$data["main_content"] = "admin_new_product.php";
		$this->load->view("admin.php",$data);
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will save product details and redirect the page to admin_manage_product
	function save_product()
	{ 
		if($this->mproduct->save_new_product()==TRUE)
			$this->session->set_flashdata("success","Product saved successfully");
		else
			$this->session->set_flashdata("error","Product already exists");
		redirect('/product/manage_product','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will update product details and redirect the page to admin_manage_product
	function update_product()
	{
		
	
		if($this->mproduct->update_product()==TRUE)
			$this->session->set_flashdata("success","Product updated successfully");
		else
			$this->session->set_flashdata("error","Product already exists");
		redirect('/product/manage_product','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will delete product and redirect the page to admin_manage_product
	function delete_product()
	{
		$ret_message = $this->mproduct->delete_product();
		print $ret_message;
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Product deleted successfully");
		else
			$this->session->set_flashdata("error","This product can not deleted. Associated child element exists.");
		redirect('/product/manage_product','refresh');
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
	function delete_image()
	 {
	 
		 $this->load->model('mproduct');
		  $result = $this->mproduct->delete_product_image();
		  echo $result;
		 
	 }
	 function check_image_size()
	{
		 $tmpName = $this->input->get('image');
			
	list($width, $height, $type, $attr) = getimagesize($tmpName);
	
	if($width<265 || $height<265)
	{
	
		return false;
	}
	else
	{
	
		return true;
	}
	 	
	 }
}
?>