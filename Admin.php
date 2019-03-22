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
		//$this->load->library('pagination');
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
					//$whr="user_login='".$uname."'";
					$whr="email='".$uname."' and password='".$password."'";
					$dtl=$this->main_model->get_where_row('wp_ci_users',$whr);
					
					if($dtl){
						$userlogindata = array( 
											'admin_id' => $dtl->id
											);						
						$this->session->set_userdata($userlogindata);
						redirect(base_url('dashboard'));
					}else{
						$this->session->set_flashdata('msg', 'Incorrect username or password');
						
						
					}
				}
			}
			
			$data['error']='';	
			$this->load->view('login',$data);
		
		
		}
	}

	public function dashboard(){
		
		if(!$this->session->userdata('admin_id')){
			redirect(base_url());
		}
		else{
			
			
			 $data['page_title']="dashboard title";
			$this->load->view('dashboard',$data);
			
		}
	}

	public function logout() 
	{		
		$data = new stdClass();			
		session_destroy();
		redirect(base_url());
		
	}


	// import product data

	public function import_product_data() {
       
		$data['page'] = 'dashboard';
        $this->load->library('Excel');
        $arr['error'] = '';    //initialize image upload error array to empty
   
             
               $files = $this->getDirContents('/xampp/htdocs/ciwshop/assets/uploads');//here folder name where your folders and it's csvfile;
 


foreach($files as $file){
 $file_path =$file;
$foldername =  explode(DIRECTORY_SEPARATOR,$file);
//var_dump($foldername);die;
$table_prefix=$foldername[6];
                //$file_path = FCPATH . 'assets/uploads/01/Edu-14.6.18.csv' ;
                  
                $my_data = array();
                $header_array = Array
                    ('ID','Type', 'SKU', 'Name', 'Published', 'In stock?', 'Stock', 'Sale price','Ptype
');
                $count = 0;
                $compare = '';
                $arr_max_id = $this->main_model->get_max_id('wp_posts');
                
                $insert_id = $arr_max_id['id'] + 1;
//read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file_path);
// Get Highest Column
                $highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn(); // e.g. "EL"
// Get Highest Row
                $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();  // e.g. 5
                $highestColumm++;
                for ($row = 1; $row < $highestRow + 1; $row++) {
                    $dataset = array();
                    for ($column = 'A'; $column != $highestColumm; $column++) {
                        $dataset[] = $objPHPExcel->setActiveSheetIndex(0)->getCell($column . $row)->getValue();
                    }
                    $datasets[] = $dataset;
                }


			        $metakeyvalue=array('_sku','_regular_price','_sale_price','_stock','_stock_status');
				$errorEmp = 0;
				$errorFrDt = 0;
				$errorToDt = 0;
				$join_dbi="";
                                $string="";
                foreach ($datasets as $csv_array) {
                    if ($count > 0) {
		$product = $this->main_model->get_selected_columns('wp_'.$table_prefix.'_postmeta',array('post_id'),array('meta_key'=>'_sku','meta_value'=>$csv_array[2]),'single',$obj_form=true);
                        if (!empty($product)) {
                           foreach ($metakeyvalue as $metaval ) 
                               { 
                               //sale_price start
                              if($metaval=='_sale_price')
                              {
                                $metasale_price = $this->main_model->get_selected_columns('wp_'.$table_prefix.'_postmeta',array('meta_value'),array('meta_key'=>'_sale_price','post_id'=>$product->post_id),'single',$obj_form=true);
                                if (!empty($metasale_price)) {
                                    
                                    $my_data2= array(
                                    'meta_value' => (!empty($csv_array[8])) ? $csv_array[8] : '',


                                );

                                $this->db->update('wp_'.$table_prefix.'_postmeta',$my_data2,array('post_id'=>$product->post_id,'meta_key'=>'_sale_price'));
                                }
                                else
                                    {
                                    $my_data1= array(                               
                                    'post_id' => $product->post_id,                              
                                    'meta_key' => '_sale_price',
                                    'meta_value' => (!empty($csv_array[8])) ? $csv_array[8] : '',


                                );

                                 $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data1);
                                   }
                               
                                }
                                //end of sale_price
                             //_regular_price start   
                              else if($metaval=='_regular_price')
                              {
                                $metasale_price = $this->main_model->get_selected_columns('wp_'.$table_prefix.'_postmeta',array('meta_value'),array('meta_key'=>'_regular_price','post_id'=>$product->post_id),'single',$obj_form=true);
                                if (!empty($metasale_price)) {
                                    
                                    $my_data11= array(
                                    'meta_value' => (!empty($csv_array[9])) ? $csv_array[9] : '',


                                );
                                $this->db->update('wp_'.$table_prefix.'_postmeta',$my_data11,array('post_id'=>$product->post_id,'meta_key'=>'_regular_price'));
                                }
                                else
                                    {
                                    $my_data12= array(                               
                                    'post_id' => $product->post_id,                              
                                    'meta_key' => '_regular_price',
                                    'meta_value' => (!empty($csv_array[9])) ? $csv_array[9] : '',


                                );

                                 $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data12);
                                   }
                               
                                }
                                 //end _regular_price  
                                //_stock   
                              else if($metaval=='_stock')
                              {
                                $metasale_price = $this->main_model->get_selected_columns('wp_'.$table_prefix.'_postmeta',array('meta_value'),array('meta_key'=>'_stock','post_id'=>$product->post_id),'single',$obj_form=true);
                                if (!empty($metasale_price)) {
                                    
                                    $my_data13= array(
                                    'meta_value' => (!empty($csv_array[6])) ? $csv_array[6] : '',


                                );
                                //$this->db->update('wp_postmeta',$my_data11,array('post_id'=>$product->post_id,'meta_key'=>'_regular_price'));
                                
                                $this->db->update('wp_'.$table_prefix.'_postmeta',$my_data13,array('post_id'=>$product->post_id,'meta_key'=>'_stock'));
                                }
                                else
                                    {
                                    $my_data1= array(                               
                                    'post_id' => $product->post_id,                              
                                    'meta_key' => '_stock',
                                    'meta_value' => (!empty($csv_array[6])) ? $csv_array[6] : '',


                                );

                                 $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data1);
                                   }
                               
                                }
                                 //end _regular_price 
                           }

                        }else{

			$manager = $this->main_model->get_selected_columns('wp_'.$table_prefix.'_postmeta',array('post_id'),array('post_id'=>$arr_max_id['id']),'single',$obj_form=true);
				if(!empty($csv_array[3])){			
                                $string = strtolower($csv_array[3]);
                                //Make alphanumeric (removes all other characters)
                                $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
                                //Clean up multiple dashes or whitespaces
                                $string = preg_replace("/[\s-]+/", " ", $string);
                                //Convert whitespaces and underscore to dash
                                $string = preg_replace("/[\s_]/", "-", $string);
                                
                                
                                }				
                            $my_data = array(                               
                                'post_author' => 1,                                
                                'post_title' => (!empty($csv_array[3])) ? ($csv_array[3]) : '',
                                'post_status' => (!empty($csv_array[4])) ? $csv_array[4] : '',
                                'post_type' => (!empty($csv_array[10])) ? $csv_array[10] : '',
                                'post_name' => $string,
                                
                                
                            );

                            $this->db->insert('wp_'.$table_prefix.'_posts', $my_data);
                             $lastid=$this->db->insert_id();
                             if($lastid!=''){ 

                              foreach ($metakeyvalue as $metaval ) {
                                   	
                                  if($metaval=='_sku'){
                             			    $my_data1= array(                               
                                'post_id' => $lastid,                              
                                'meta_key' => '_sku',
                                'meta_value' => (!empty($csv_array[2])) ? $csv_array[2] : '',
                                
                                
                            );

                             $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data1);

                             		}
                                        elseif($metaval=='_sale_price'){
                             			    $my_data2= array(                               
                                'post_id' => $lastid,                              
                                'meta_key' => '_sale_price',
                                'meta_value' => (!empty($csv_array[8])) ? $csv_array[8] : '',
                                
                                
                            );

                             $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data2);

                             		}
                                        elseif($metaval=='_regular_price'){
                             			    $my_data3= array(                               
                                'post_id' => $lastid,                              
                                'meta_key' => '_regular_price',
                                'meta_value' => (!empty($csv_array[9])) ? $csv_array[9] : '',
                                
                                
                            );

                             $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data3);

                             		}elseif($metaval=='_stock'){
                             			    $my_data4= array(                               
                                'post_id' => $lastid,                              
                                'meta_key' => '_stock',
                                'meta_value' => (!empty($csv_array[6])) ? $csv_array[6] : '',
                                
                                
                            );

                             $this->db->insert('wp_'.$table_prefix.'_postmeta', $my_data4);

                             		}
                                        
                             	}

                             }

                           
                        }
                        
                     $insert_id++;
                    } else {
                        $compare = array_diff($csv_array, $header_array);
                        if (count($compare) > 0) {
                            $this->session->set_flashdata('message','<p class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> We need proper format to upload. Please check your format before uploading!</p>');
                            
                        }
                    }
                    $count++;
                }
}
               
		$err_msg = '';
				
                if (!empty($my_data)) {                   
                    $this->session->set_flashdata('message', '<p class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> Staffs Data Imported Successfully'.$err_msg.'!</p>');
                   
                } else {
                    $this->session->set_flashdata('message', '<p class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> The file uploaded successfully'.$err_msg.'!</p>');
					
                  
                }
          
       
		$data['title'] = 'product uploaded';
		$this->load->view('impsuccess',$data);
    }
    
    
    public function getDirContents($dir, &$results = array()){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            $this->getDirContents($path, $results);
            
        }
    }

    return $results;
}

}