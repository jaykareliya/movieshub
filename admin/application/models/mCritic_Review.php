<?php
class mCritic_Review extends CI_Model
{
    function fill_Creview_table1($alpha,$keyword)
    {
		//$Q = $this->db->get('category');
		if($alpha == "ALL")
			$alpha = "";
			
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';
		}
		

		$Q = $this->db->query('SELECT
    `critic_review`.`Creview_Id`
    , `movie`.`Movie_Name`
    , `critic_review`.`Creview_Title`
    , `critic_review`.`Creview_Desc`
    , `critic_review`.`Creview_Time`
FROM
    `movie`
    INNER JOIN `critic_review` 
        ON (`movie`.`Movie_Id` = `critic_review`.`Movie_Id`) WHERE (critic_review.Creview_Title LIKE "'.$alpha.'%" AND critic_review.Creview_Title LIKE "'.$keyword.'%")');
		
		return $Q->num_rows();
   	}
   

    function fill_Creview_table_condition($start_row,$limit,$alpha,$keyword)
    {
		if($alpha == "ALL")
			$alpha = "";
		if($alpha == "0-9")
		{
			$alpha = '0%" OR Movie_name LIKE "1%" OR Movie_name LIKE "2%" OR Movie_name LIKE "3%" OR Movie_name LIKE "4%" OR Movie_name LIKE "5%" OR Movie_name LIKE "6%" OR Movie_name LIKE "7%" OR Movie_name LIKE "8%" OR Movie_name LIKE "9';

		}	
		$Q = $this->db->query('SELECT
    `critic_review`.`Creview_Id`
    , `movie`.`Movie_Name`
    , `critic_review`.`Creview_Title`
    , `critic_review`.`Creview_Desc`
    , `critic_review`.`Creview_Time`
FROM
    `movie`
    INNER JOIN `critic_review` 
        ON (`movie`.`Movie_Id` = `critic_review`.`Movie_Id`) WHERE (critic_review.Creview_Title LIKE "'.$alpha.'%" AND critic_review.Creview_Title LIKE "'.$keyword.'%") LIMIT '.$start_row.','.$limit);
			
		/*$query_str = 'SELECT * FROM Movie right join Movie_actor on (movie_actor.Movie_Id = Movie.Movie_Id) left join Actor on (actor.actor_id = movie_actor.actor_id) WHERE (movie.Movie_name LIKE "'.$alpha.'%" AND movie.Movie_name LIKE "'.$keyword.'%")  LIMIT '.$start_row.','.$limit;
	    $Q = $this->db->query($query_str);*/
	    return $Q->result();
   	}
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to get all the records in category table
	/// Returns     :: All records in category table
    function fill_Creview_details($Creview_Id)
    {
		$this->db->where('Creview_Id',$Creview_Id);
			
   		$Q = $this->db->get('critic_review');

		if($Q->num_rows()>0)
		{
			
			return $Q->result();
		
		}
		else
		{
			return NULL;

		}
    }
   
    /// Created by  :: Yash Shah
	/// Description :: This function is used to save new category
	/// Returns     :: TRUE/FALSE;
    function save_new_creview()
    {
   		
			
			$d = array(
				'Movie_id'=>$this->input->post('ddlMovie'),
				'Creview_Title'=>$this->input->post('txt_review_title'),
				'Creview_Desc'=>$this->input->post('txt_review_Description'),
				'Creview_Time'=>$this->input->post('txt_review_date')
					);
			
			$this->db->insert('critic_review',$d);

			return TRUE;
		
   }
   
    
    function update_creview()
    {
   		$Creview_Id = $this->input->get('Creview_Id');
   	
			$d = array(
				'Movie_id'=>$this->input->post('ddlMovie'),
				'Creview_Title'=>$this->input->post('txt_review_title'),
				'Creview_Desc'=>$this->input->post('txt_review_Description'),
				'Creview_Time'=>$this->input->post('txt_review_date')
					);

			$this->db->where('Creview_Id',$Creview_Id);
			$this->db->update('critic_review',$d);
			
			
		
		
			
			//header('location: http://www.ramigift.com/index.php/page/manage_category');
			return TRUE;
		
		
   }
   
  
    function delete_creview()
    {
   		$Creview_Id = $this->input->get('Creview_Id');
		
		
			
		
			$this->db->where('Creview_Id',$Creview_Id);
			$Q = $this->db->get('critic_review');
			if($Q->num_rows()>0)
			{
			
				$this->db->where('Creview_Id',$Creview_Id);
				$this->db->delete('critic_review');
			}
			return TRUE;
			exit();
		
    }
   
}
?>
