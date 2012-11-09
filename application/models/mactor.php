<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mactor extends CI_Model
{


	public function get_actor($movie_id)
	{
		$query ="SELECT a.Actor_Name,a.Actor_Id FROM `movie` AS m LEFT JOIN movie_actor AS ma ON ( m.movie_id = ma.movie_id ) LEFT JOIN actor a ON ( a.actor_id = ma.actor_id )WHERE m.movie_id = ". $movie_id;
		$q = $this->db->query($query);

		return $q->result();
	}


	
	public function get_actor_detail($actor_id)
	{
		$query="SELECT * FROM actor WHERE actor_id =".$actor_id;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	public function get_actor_birthday()
	{
		$query="SELECT Actor_Id as Id,Actor_DOB as DOB, if(DATE_FORMAT(Actor_Death_Date , '%d/%m/%Y') = NULL,
DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), actor_dob)), '%Y')+0,
CONCAT
(DATE_FORMAT(Actor_Dob ,'%Y') ,' - ',DATE_FORMAT(Actor_Death_Date ,'%Y')))AS age,Actor_Name as Name,Concat('http://www.moviehub.com/images/actor/small/',Actor_Avatar) as Avatar,Concat('http://www.moviehub.com/index.php/actor/actor_name/',Actor_id) as page_link FROM `actor`WHERE DATE_FORMAT( actor_dob, '%d/%m' ) = DATE_FORMAT( now( ) , '%d/%m' ) union 
		

		SELECT Director_Id as Id,Director_DOB as DOB,if(DATE_FORMAT(Director_Death_Date , '%d/%m/%Y') = '00/00/0000',
DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), Director_DOB)), '%Y')+0,
CONCAT
<<<<<<< HEAD
(DATE_FORMAT(Director_DOB ,'%Y') ,' - ',DATE_FORMAT(Director_Death_Date ,'%Y')))AS age,Director_Name as Name,Concat('http://www.moviehub.com/images/director/small/',Director_Avatar) as Avatar,Concat('http://www.moviehub.com/index.php/director/director_name/',Director_id) as page_link FROM `director`WHERE DATE_FORMAT( Director_dob, '%d/%m' ) = DATE_FORMAT( now( ) , '%d/%m' )union 
=======
(DATE_FORMAT(Director_DOB ,'%Y') ,' - ',DATE_FORMAT(Director_Death_Date ,'%Y')))AS age,Director_Name as Name,Concat('http://www.moviehub.com/images/director/small/',Director_Avatar) as Avatar,Concat('http://www.moviehub.com/index.php/director/director_name/',Director_Id) as page_link FROM `director`WHERE DATE_FORMAT( Director_dob, '%d/%m' ) = DATE_FORMAT( now( ) , '%d/%m' )union 
>>>>>>> change in mactor
		
		SELECT Producer_Id as Id,Producer_DOB as DOB,if(DATE_FORMAT(Producer_Death_Date , '%d/%m/%Y') = '00/00/0000',
DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), Producer_DOB)), '%Y')+0,
CONCAT
(DATE_FORMAT(Producer_DOB ,'%Y') ,' - ',DATE_FORMAT(Producer_Death_Date ,'%Y')))AS age,Producer_Name as Name,Concat('http://www.moviehub.com/images/producer/small/',Producer_Avatar) as Avatar,Concat('http://www.moviehub.com/index.php/producer/producer_name/',Producer_Id) as page_link FROM `producer`WHERE DATE_FORMAT( Producer_dob, '%d/%m' ) = DATE_FORMAT( now( ) , '%d/%m' )Union 
		SELECT Singer_Id as Id,Singer_DOB as DOB,if(DATE_FORMAT(Singer_Death_Date , '%d/%m/%Y') = '00/00/0000',
DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), Singer_DOB)), '%Y')+0,
CONCAT
(DATE_FORMAT(Singer_DOB ,'%Y') ,' - ',DATE_FORMAT(Singer_Death_Date ,'%Y')))AS age,Singer_Name as Name,Concat('http://www.moviehub.com/images/singer/small/',Singer_Avatar) as Avatar,Concat('http://www.moviehub.com/index.php/singer/Singer_name/',Singer_Id) as page_link FROM `singer`WHERE DATE_FORMAT( Singer_dob, '%d/%m' ) = DATE_FORMAT( now( ) , '%d/%m' ) ";
		$q =$this->db->query($query);
		
		return $q->result();
	}


	
	public function actor_see_all($type_id,$start_row,$limit)
	{

		$query="SELECT count( movie_comment.movie_comment_id ) AS cnt,m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating FROM movie_actor AS ma LEFT JOIN movie AS m ON(m.movie_id = ma.movie_id) 
LEFT JOIN `movie_comment` ON ( m.movie_id = movie_comment.movie_id )
WHERE ma.Actor_Id=".$type_id." group by m.Movie_Id,m.Movie_Name,m.Movie_Image,m.Movie_Rating limit ".$start_row." ,".$limit;
		$q =$this->db->query($query);
		
		return $q->result();
	}


	
	public function actors_movie_count($actor_id)
	{
		$Q = $this->db->query("SELECT count(*) as cnt FROM `movie` AS m LEFT JOIN movie_actor AS ma ON ( m.movie_id = ma.movie_id ) LEFT JOIN actor a ON ( a.actor_id = ma.actor_id ) WHERE a.actor_id = ". $actor_id );

			
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