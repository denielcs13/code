<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function get_detail($tbl_name,$col_name,$col_val){  
		$this->db->select('*'); 
		$this->db->from($tbl_name);
        $this->db->where($col_name,$col_val);

		//$this->db->limit(0, 50);
		return $this->db->get()->row();

	}
	public function getall($tbl_name,$col_name='',$col_val=''){
		$this->db->select('*'); 
		$this->db->from($tbl_name);
		if($col_name!="" && $col_val!=""){
		$this->db->where($col_name,$col_val);
		}
		//$this->db->limit(0, 50);
		return $this->db->get()->result();

	}
	public function numrows_total($table)
    {
        	if(isset($_GET['sname']) || isset($_GET['decade'])){
				if($_GET['sname']!=""){
				$this->db->like('song_name', $_GET['sname']);}
				if($_GET['decade']!=""){
					$this->db->like('category', $_GET['decade']);
				}
					
			}
        $upadte=$this->db->get($table)->num_rows();
        return $upadte;
    }
	
	public function get_dropdown($tbl_name,$opt_val,$opt_txt,$where=null){
		$this->db->select('*'); 
		$this->db->from($tbl_name);
		$whr=' 1=1';
		if($where!=""){
		$whr=$whr.' and '.$where;
		$this->db->where($where);
		}
		$result= $this->db->get()->result();
		$option=array();
		$option['']="Select here";
		foreach($result as $row){
			$option[$row->$opt_val]=$row->$opt_txt;
		}
		return $option;

	}
	
	
	public function Save($tbl_name,$data)
	{
	
	   $this->db->insert($tbl_name,$data);
	  return $this->db->insert_id();
		
		
	}	
	
	public function Update($tbl_name,$data,$col_name='',$col_val='')
	{
		
	  $this->db->where($col_name,$col_val);
	  return $this->db->update($tbl_name,$data);
		
		
	}
	
	public function Delete($tbl_name,$col_name='',$col_val='')
	{
	 if($col_val!="" && $col_name!=""){
	  $this->db->where($col_name,$col_val);
	  return $this->db->delete($tbl_name);
	 }
	 else{
		 return false;
	 }
	}
	
	public function Delete1($tbl_name,$col_name='',$col_val='',$col_name1='',$col_val1='')
	{
	 if($col_val!="" && $col_name!="" && $col_name1!="" && $col_val1!=""){
	  $this->db->where($col_name,$col_val);
	  $this->db->where($col_name1,$col_val1);
	  return $this->db->delete($tbl_name);
	 }
	 else{
		 return false;
	 }
	}
	
	public function get_where_row($tbl_name,$where){  
		$this->db->select('*'); 
		$this->db->from($tbl_name);
        $whr=' 1=1';
		if($where!=""){
		$whr=$whr.' and '.$where;
		$this->db->where($where);
		}
		return $this->db->get()->row();

	}
	
	public function get_chk_game($tbl_name,$val){  
		if($val!=""){
		$this->db->select('*'); 
		$this->db->from($tbl_name);
        $this->db->where('game_code',$val);
	    return $this->db->get()->row();
		}
		else{ return false;}

	}
	public function get_where_row_latest($tbl_name,$where){  
		$this->db->select('*'); 
		$this->db->from($tbl_name);
        $whr=' 1=1';
		if($where!=""){
		$whr=$whr.' and '.$where;
		$this->db->where($where);
		}
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->row();

	}
	public function get_where_result($tbl_name,$where){  
		$this->db->select('*'); 
		$this->db->from($tbl_name);
        $whr=' 1=1';
		if($where!=""){
		$whr=$whr.' and '.$where;
		$this->db->where($where);
		}
		return $this->db->get()->result();

	}
public function get_result_latest($tbl_name,$where=''){  
		$this->db->select('*'); 
		$this->db->from($tbl_name);
        $whr=' 1=1';
		if($where!=""){
		$whr=$whr.' and '.$where;
		$this->db->where($where);
		}
		$this->db->order_by("id", "desc");
		return $this->db->get()->result();

	}
	
	public function get_random($tbl_name){  
		$this->db->select('*'); 
		$this->db->from($tbl_name);
		$this->db->limit('1');
		$this->db->order_by('id','random');
		return $this->db->get()->row();

	}
	public function get_next_song($tbl_name,$game_code){  
		
		
		$song_arr=array();
		
		$qry=$this->db->query("select active_song from tbl_game where game_code=".$game_code.""); 
		$results=$qry->result();
		foreach($results as $result){
			$song_arr[]=$result->active_song;
		}
		$this->db->reset_query();
		
		$this->db->select('*'); 
		$this->db->from($tbl_name);
		$this->db->limit('1');
		$this->db->where_not_in('id',$song_arr);
		
		$this->db->order_by('id','random');
		return $this->db->get()->row();

	}
	
	public function get_random_25($tbl_name){  
	$qry=$this->db->query("(select * from ".$tbl_name." where category=50 order by  RAND() limit 5) union (select * from ".$tbl_name." where category=60 order by RAND() limit 5) union (select * from ".$tbl_name." where category=70 order by RAND() limit 5) union (select * from ".$tbl_name." where category=80 order by RAND() limit 5) union (select * from ".$tbl_name." where category=90 order by RAND() limit 5)");

		return $qry->result();

	}
	
	
	public function get_song_list($limit="",$offset="")
    {
        $this->db->select('*');
		if(isset($_GET['sname']) || isset($_GET['decade'])){
			if($_GET['sname']!=""){
			$this->db->like('song_name', $_GET['sname']);}
			if($_GET['decade']!=""){
				$this->db->like('category', $_GET['decade']);
			}
				
		}
        $this->db->from('tbl_songs');
        $this->db->order_by('id','DESC');
        if($limit)
        {
        $this->db->limit($limit, $offset);
        }
        $data=$this->db->get()->result();
        return $data;
    }
	
	public function get_user_list($limit="",$offset="")
    {
        $this->db->select('*');
		if(isset($_GET['uname']) && $_GET['uname']!=""){
			
			$this->db->like('username', $_GET['uname']);
				
		}
        $this->db->from('user');
        $this->db->order_by('id','DESC');
        if($limit)
        {
        $this->db->limit($limit, $offset);
        }
        $data=$this->db->get()->result();
        return $data;
    }
	
	/* my new model for fetching the song by id */
	public function get_selected_columns($table,$columns = array(),$where = array(),$records="single",$obj=false)
	{
        if(count($where) > 0){
			$this->db->where($where);
        }
		if(!empty($columns)){
			$this->db->select(implode(',', $columns));
		}
        $query = $this->db->get($table);
        		
        if($records=="single"){
			if($obj){
				$result = $query->row();
			}else{
				$result = $query->row_array();
			}
            
        } else {
			if($obj){
				$result = $query->result();
			}else{
				$result = $query->result_array();
			}
        }	
        return $result;
   }
	

}
?>