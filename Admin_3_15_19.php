<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	function __construct(){
		
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library(array('session'));
		$this->load->library('pagination');
		ini_set('upload_max_filesize','100M');
		
	}
	
	
	
	public function index()
	{
		if($this->session->userdata('admin_id')){
			redirect(base_url('dashboard'));
		}
		else{
		
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('uname', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');		
				if($this->form_validation->run())
				{
					
					$uname=trim($_POST['uname']);
					$password=md5(trim($_POST['password']));
					$whr="username='".$uname."' and password='".$password."'";
					$dtl=$this->main_model->get_where_row('user',$whr);
					if($dtl){
						$userlogindata = array( 
											'admin_id' => $dtl->id
											);						
						$this->session->set_userdata($userlogindata);
						redirect(base_url('dashboard'));
					}else{
						$this->session->set_flashdata('msg', 'Sorry your username and password did not match');
						
						
					}
				}
			}
			
			$data['error']='';	
			$this->load->view('login',$data);
		
		
		}
	}
	
	public function add_song(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('decade', 'Decade', 'required');
				$this->form_validation->set_rules('song_name', 'Song title', 'required');		
				$this->form_validation->set_rules('artist', 'Artist', 'required');		
	
				if($this->form_validation->run())
				{
					$decade=trim($_POST['decade']);
					$song_name=trim($_POST['song_name']);	
					$artist=trim($_POST['artist']);	
						
					$config['upload_path']          = './uploads/songs/'.$decade.'/';
					$config['max_size'] = '500000';
					$config['allowed_types'] = 'mov|mp3|m4a|aac|au|ac3|flac|ogg|wma|wav|ra|rpm|rm|ram|aifc|aiff|mp3|mp2|mpga|midi|mid';
					$config['overwrite'] = false; 
					$this->load->library('upload', $config);

					if($this->upload->do_upload('file'))
					{   
						$data = $this->upload->data();
						
					//	print_r($data);
						$dt=array('song_name'=>$song_name,
						'category'=>$decade,
						'song_audio'=>'uploads/songs/'.$decade.'/'.$data['file_name'],
						'artist'=>$artist
						);
						
						$this->main_model->Save('tbl_songs',$dt);
						$this->session->set_flashdata('msg','Song saved successfully');
						redirect(base_url('songlist'));
					
						
						   
					}
					else
					{ 	$error = array('error' => $this->upload->display_errors());
						$this->load->view('add-song', $error);
					}
			
				}
				else{$this->load->view('add-song');}
			
			}
			else{
					$this->load->view('add-song');
			}
		}
	}
	
	
	public function edit_song($id){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			$data['song_detail']=$this->main_model->get_detail('tbl_songs','id',$id);
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('decade', 'Decade', 'required');
				$this->form_validation->set_rules('song_name', 'Song title', 'required');		
				$this->form_validation->set_rules('artist', 'Artist', 'required');		
	
				if($this->form_validation->run())
				{
					$decade=trim($_POST['decade']);
					$song_name=trim($_POST['song_name']);	
					$artist=trim($_POST['artist']);	
						
					$config['upload_path']          = './uploads/songs/'.$decade.'/';
					$config['max_size'] = '500000';
					$config['allowed_types'] = 'mov|mp3|m4a|aac|au|ac3|flac|ogg|wma|wav|ra|rpm|rm|ram|aifc|aiff|mp3|mp2|mpga|midi|mid';
					$config['overwrite'] = false; 
					$this->load->library('upload', $config);
					if (empty($_FILES['file']['name'])) {
						$dt=array('song_name'=>$song_name,
						'category'=>$decade,
						'artist'=>$artist
						);
						
						$this->main_model->Update('tbl_songs',$dt,'id',$id);
						$this->session->set_flashdata('msg','Song updated successfully');
						redirect(base_url('songlist'));
					
					}
					else{
					if($this->upload->do_upload('file'))
					{   
						$data = $this->upload->data();
						
					//	print_r($data);
						$dt=array('song_name'=>$song_name,
						'category'=>$decade,
						'song_audio'=>'uploads/songs/'.$decade.'/'.$data['file_name'],
						'artist'=>$artist
						);
						
						$this->main_model->Update('tbl_songs',$dt,'id',$id);
						$this->session->set_flashdata('msg','Song updated successfully');
						redirect(base_url('songlist'));
					
						
						   
					}
					
				   else
					{ 	$data['error'] = $this->upload->display_errors();
						$this->load->view('edit-song', $data);
					}
					}
				}
				else{$this->load->view('edit-song',$data);}
			
			}
			
			
			
			
			else{
					$this->load->view('edit-song',$data);
			}
		}
	}
	
	
	
	public function dashboard(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			
			$res=$this->db->query("select count(id) as 'ct' from tbl_songs");
			$row=$res->row();
			$data['song_count']=$row->ct;
			$res=$this->db->query("select count(id) as 'ct1' from tbl_psw");
			$row=$res->row();
			$data['psw_count']=$row->ct1;
			$this->load->view('dashboard',$data);
			
		}
	}
	
	
	public function password(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('decade', 'Decade', 'required');
				$this->form_validation->set_rules('song_name', 'Song title', 'required');		
				$this->form_validation->set_rules('artist', 'Artist', 'required');		
				//$this->form_validation->set_rules('file', 'Song audio', 'required');		
				if($this->form_validation->run())
				{
					$decade=trim($_POST['decade']);
					$song_name=trim($_POST['song_name']);	
					$artist=trim($_POST['artist']);	
						
					$config['upload_path']          = './uploads/songs/'.$decade.'/';
					$config['max_size'] = '500000';
					$config['allowed_types'] = 'mp3|mov|MP3';
					$config['overwrite'] = false; 
					$this->load->library('upload', $config);

					if($this->upload->do_upload('file'))
					{   
						$data = $this->upload->data();
						
					//	print_r($data);
						$dt=array('song_name'=>$song_name,
						'category'=>$decade,
						'song_audio'=>'uploads/songs/'.$decade.'/'.$data['file_name'],
						'artist'=>$artist
						);
						
						$this->main_model->Save('tbl_songs',$dt);
						$this->session->set_flashdata('msg','Song saved successfully');
						redirect(base_url('songlist'));
					
						
						   
					}
					else
					{ 	$error = array('error' => $this->upload->display_errors());
						$this->load->view('dashboard', $error);
					}
			
				}
				else{$this->load->view('dashboard');}
			
			}
			else{
					$this->load->view('dashboard');
			}
		}
	}
	
	
	public function songlist()
	{
        $countrow=$this->main_model->numrows_total('tbl_songs');
        $data=$this->pagination1('songlist',$countrow,20,2);
		$data['songlists'] = $this->main_model->get_song_list($data["limit"], $data['offset']);
        $data['page']="songlist";
		$data['error']='';
		$this->load->view('songlist',$data);

				
		
	}
	
	public function delete_psw($id)
	{
		if($this->main_model->delete('tbl_psw','id',$id)){
		$this->session->set_flashdata('msg','Password deleted successfully');
		}
		redirect(base_url('listpsw'));
	}
	public function delete_song($id)
	{
		if($this->main_model->delete('tbl_songs','id',$id)){
		$this->session->set_flashdata('msg','Song deleted successfully');
		}
		redirect(base_url('songlist'));
	}
	public function psw(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('location', 'Location', 'required');
				if($this->form_validation->run())
				{
						$psw=base64_encode(trim($_POST['password']));
						$location=trim($_POST['location']);
						$dt=array('psw'=>$psw,'location'=>$location);
						
						$this->main_model->Save('tbl_psw',$dt);
						$this->session->set_flashdata('msg','Password saved successfully');
						redirect(base_url('listpsw'));
				}
				else
				{ 	
					$this->load->view('password');
				}
			
				}
			else{$this->load->view('password');}
			
			}
			
		
	}
	
	public function edit_psw($id){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			$data['psw_detail']=$this->main_model->get_detail('tbl_psw','id',$id);
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('location', 'Location', 'required');
						
	
				if($this->form_validation->run())
				{
						$psw=base64_encode(trim($_POST['password']));
						$location=trim($_POST['location']);
						
						$dt=array('psw'=>$psw,'location'=>$location);
						
						$this->main_model->Update('tbl_psw',$dt,'id',$id);
						$this->session->set_flashdata('msg','Location updated successfully');
						redirect(base_url('listpsw'));
				}
				else{
					$this->load->view('edit-psw',$data);
					}
			
			}
			else{
					$this->load->view('edit-psw',$data);
			}
		}
	}
	
	
	public function listpsw()
	{
		$data['pswlists']=$this->main_model->getall('tbl_psw');
		$data['error']='';
		$this->load->view('listpsw',$data);

				
		
	}
	
	
	public function logout() 
	{		
		$data = new stdClass();			
		session_destroy();
		redirect(base_url());
		
	}

	
	public function pagination1($basepath,$total_row,$no_of_page,$uri_setment)
    {
        $config['base_url'] = base_url($basepath);
        //$basepath =admin/plan/
        $config['total_rows'] = $total_row;
        $config['per_page'] =$no_of_page;
		$config['use_page_numbers'] = TRUE;
        //no_of_page=10
        $config['uri_segment'] = $uri_setment;
        //$uri_setment=3
        $data['total_rows'] = $config['total_rows'];
        if (isset($_GET)) {
           $config['enable_query_string'] = TRUE;
           $config['suffix'] =  '?' .http_build_query($_GET, '', "&");
           $config['first_url'] = $config["base_url"] . $config['suffix'];
       }
       $this->pagination->initialize($config);
        $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
       $data['page_no'] = $page;
       $last_record_per_page = $config["per_page"] + ($data['page_no']);
       if ($data['total_rows'] < $last_record_per_page) {
           $last_record_per_page = $data['total_rows'];
       }
       $data["last_record_per_page"] = $last_record_per_page;
       $data["links"] = $this->pagination->create_links();
       $data['limit']=$config["per_page"];
       if (isset($page) && is_numeric($page))
                    {
                      if($page >1)
                      {
                      $data['offset'] = ($page-1) * $config['per_page'];
                      }
                      else
                      {
                          $data['offset']=0;
                      }
                    }
                    else
                    {
                      $data['offset'] = 0;
                    }
       return $data;
    }
	
	public function add_admin(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
				
				
				if($this->form_validation->run())
				{
					$username=trim($_POST['username']);
					$password=trim($_POST['password']);	
					
					  
						$dt=array('username'=>$username,
						'password'=>md5($password)
						);
						
						$this->main_model->Save('user',$dt);
						$this->session->set_flashdata('msg','Admin created successfully');
						redirect(base_url('adminlist'));
					
				
				}
				else{$this->load->view('add-admin');}
			
			}
			else{
					$this->load->view('add-admin');
			}
		}
	}
	
	public function edit_admin($id){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			$data['admin_detail']=$this->main_model->get_detail('user','id',$id);
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('old_password', 'Old Password', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
						
	
				if($this->form_validation->run())
				{
					$old_password=md5(trim($_POST['old_password']));
				    $whr="id='".$id."' and password='".$old_password."'";
					$dtl1=$this->main_model->get_where_row('user',$whr);
					if($dtl1){
						
						$username=trim($_POST['username']);
						$password=trim($_POST['password']);	
					
						$dt=array('username'=>$username,
						'password'=>md5($password)
						);
						
						$this->main_model->Update('user',$dt,'id',$id);
						$this->session->set_flashdata('msg','Admin updated successfully');
						redirect(base_url('adminlist'));
					   }else{
						$this->session->set_flashdata('msg', 'Old password is incorrect.Please try again!');
						redirect(base_url('edit-admin/'.$id));
					}
				}
				else{
					$this->load->view('edit-admin',$data);
					}
			
			}
			else{
					$this->load->view('edit-admin',$data);
			}
		}
	}
	
	public function adminlist()
	{
        $countrow=$this->main_model->numrows_total('user');
        $data=$this->pagination1('adminlist/',$countrow,20,2);
		$data['userlists'] = $this->main_model->get_user_list($data["limit"], $data['offset']);
        $data['page']="adminlist";
		$data['error']='';
		$this->load->view('adminlist',$data);

				
		
	}
	
	public function delete_admin($id)
	{
		if($this->main_model->delete('user','id',$id)){
		$this->session->set_flashdata('msg','Admin deleted successfully');
		}
		redirect(base_url('adminlist'));
	}
	
	
	public function change_password(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			$data['admin_detail']='';
			
			
			if(isset($_POST['submit'])){
					
				$this->form_validation->set_rules('old_password', 'Old Password', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
						
	
				if($this->form_validation->run())
				{
					$password=md5(trim($_POST['old_password']));
				    $whr="id='".$this->session->userdata('admin_id')."' and password='".$password."'";
					$dtl=$this->main_model->get_where_row('user',$whr);
					if($dtl){
						
						$dt=array('password'=>md5($password));
						
						$this->main_model->Update('user',$dt,'id',$this->session->userdata('admin_id'));
						$this->session->set_flashdata('msg','Password updated successfully');
						
					}else{
						$this->session->set_flashdata('msg', 'Old password is incorrect.Please try again');
						
					}
					redirect(base_url('change-password'));
					
				}
				else{
					$this->load->view('change-password');
					}
			
			}
			else{
					$this->load->view('change-password');
			}
		}
	}
	
	public function get_song_by_id(){
		
                $id=$_POST['id'] ;
                $result = array();
                if(!empty($id)){                
                $result['song_info'] = $this->main_model->get_selected_columns('tbl_songs',array('song_audio'),array('id='=>$id),'multiple',$obj=true);
		        $result['success'] = true;                
              
		echo json_encode($result);die;
	}
	}
	
	
	
}
