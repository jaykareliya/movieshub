<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mscript_writer extends CI_Model
{
	public function get_script_writer($movie_id)

	{
		$query ="SELECT s.Script_Writer_Name,s.Script_Writer_Id FROM movie_script_writer AS ms LEFT JOIN Script_writer AS s ON (ms.script_writer_id = s.script_writer_id) LEFT JOIN movie AS m ON (m.movie_id =ms.movie_id) WHERE m.movie_id =" .$movie_id;
		$q=$this->db->query($query);

		return $q->result();

	}


	public function get_script_writer_detail($script_writer_id)
	{
		$query="SELECT * FROM script_writer WHERE script_writer_id =".$script_writer_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function script_writer_see_all($script_writer_id,$start_row,$limit)
	{
		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating 
		FROM movie_script_writer AS ms LEFT JOIN movie AS m ON(m.movie_id = ms.movie_id) 
		LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )
		WHERE ms.script_writer_id=".$script_writer_id." 
		group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating 
		limit ".$start_row." ,".$limit;

		$q =$this->db->query($query);
		
		return $q->result();
	}
	 

	 public function script_writer_count($script_writer_id)
	 {
	 	$Q = $this->db->query("SELECT count(*) as cnt FROM movie_script_writer AS ms LEFT JOIN Script_writer AS s ON (ms.script_writer_id = s.script_writer_id) LEFT JOIN movie AS m ON (m.movie_id =ms.movie_id) WHERE s.script_writer_id =" .$script_writer_id);

			
  		$cnt="";
     	if ($Q->num_rows() > 0)
  		{
       		foreach ($Q->result_array() as $row)
   			{
         		$cnt = $row['cnt'];
       		}
     	}
    	

		return $cnt;
	 }

}
?>