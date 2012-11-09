<?php
class Category1 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		
		$this->load->model('madmin');
		
	}
	
	public function assign_value_to_data()
	{
		$data = array
		(
			
		);
		
		return $data;
	}
	function manage_category()
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
		$this->manage_category1();
	}
	/// Created by  :: Yash Shah
	/// Description :: It will manage category
	function manage_category1()
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
		$total_number_of_rows = $this->mcategory->fill_category_table($alpha,$keyword);
		
		//Extra code for searching
		if($this->input->post('txtKeyword'))
		{
			$record_per_page = 500;
			$data['visible'] = FALSE;
		}
		else
			$data["visible"] = TRUE;
		//upto here
		$config['base_url'] = base_url()."index.php/category/manage_category?";
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
		
		$data['fill_category_table'] = $this->mcategory->fill_category_table_condition($pageNumber,$record_per_page,$alpha,$keyword);
		$data['ddlRows'] = array("10"=>"10 Records","20"=>"20 Records","30"=>"30 Records","50"=>"50 Records");
		$data['ddlSelected'] = $record_per_page;
		$data["title"] = "Manage Category";
		$data["dash_board"] = "Manage Category";
		$data["main_content"] = "admin_manage_category.php";
		$this->load->view("admin.php",$data);
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will redirect the page to new/edit category
	function new_category()
	{
		$data = $this->assign_value_to_data();
		$category_id = $this->input->get('id');
		
		if(!$category_id)
		{
			$data["title"] = "New Category";
			$data['dash_board'] = "New Category";
		}
		else
		{
			$data['category_details'] = $this->mcategory->fill_category_details($category_id);
			$data["title"] = "Update Category";
			$data['dash_board'] = "Update Category";
		}
		
		$data["main_content"] = "admin_new_category.php";
		$this->load->view("admin.php",$data);
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will save category details and redirect the page to manage_category
	function save_category()
	{
		if($this->mcategory->save_new_category()==TRUE)
			$this->session->set_flashdata("success","Category saved successfully");
		else
			$this->session->set_flashdata("error","Category already exists");
		redirect('/category/manage_category','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will update category details and redirect the page to manage_category
	function update_category()
	{
		if($this->mcategory->update_category()==TRUE)
			$this->session->set_flashdata("success","Category updated successfully");
		else
			$this->session->set_flashdata("error","Category already exists");
		redirect('/category/manage_category','refresh');
	}
	
	/// Created by  :: Yash Shah
	/// Description :: It will delete category and redirect the page to manage_category
	function delete_category()
	{
		$ret_message=$this->mcategory->delete_category();
		
		if($ret_message == TRUE)
			$this->session->set_flashdata("success","Category deleted successfully");
		else
			$this->session->set_flashdata("error","This Category can not deleted. Associated child element exists.");
			
		redirect('/category/manage_category','refresh');
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
	function save_video()
	{
		    if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
            unset($config);
            $date = date("ymd");
            $configVideo['upload_path'] = './images';
            $configVideo['max_size'] = '10240';
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp3';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $date.$_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;

            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            if (!$this->upload->do_upload('video')) {
                echo $this->upload->display_errors();
            } else {
                $videoDetails = $this->upload->data();
                echo "Successfully Uploaded";
            }
        }
	}	
}
?>