<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account extends CI_Controller {

	function __construct(){
		parent::__construct();
		$company_setting =  $this->model->getData('company_setting',array());
        $glob['company'] = $company_setting;
        $categories = $this->model->getData('category',array());
        foreach ($categories as $key => $category) {
        	$sub_categories = $this->model->getData('subcategory',array('category_id'=>$category['category_id']));
        	foreach ($sub_categories as $key1 => $subcategory) {
        		$child_categories = $this->model->getData('childcategory',array('category_id'=>$category['category_id'],'sub_category_id'=>$subcategory['sub_category_id']));
        		$sub_categories[$key1]['child_categories'] = $child_categories;
        	}
        	$categories[$key]['sub_categories'] = $sub_categories;
        }
        $glob['categories'] = $categories;
         $strQry = "SELECT * FROM top_banner ORDER BY bottom_id DESC";
        $top_list = $this->model->getSqlData($strQry)[0];

        $glob['top_banner'] = $top_list;
        $this->load->vars($glob);
        date_default_timezone_set('Asia/Kolkata');
	}

	protected function no_cache(){
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != TRUE){ return FALSE; }
		return TRUE;
	}

	function logout() {
		$this->session->set_userdata(array('is_logged_in' => FALSE));
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function my_account($has_logged_in='1'){ 
        //$this->output->cache(60);
		$data['has_logged_in'] = $has_logged_in;
		$data['main_content']='home/my-account';
		$data['total_cart_item']=$this->model->CountWhereRecord('cart',array('session_id'=>$this->session->userdata('session_id')));
		$this->load->view('includes/template',$data);
	}
	

	function check_login_status(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != TRUE){ 
			$data['status'] = '0'; 
			$data['msg'] = 'login status failed';
		}else{
			$data['status'] = '1'; 
			$data['msg'] = 'login status success';
		}
		echo json_encode($data);
	}

	function view_my_cart(){
		$data['item_in_cart'] = $this->model->getData('cart',array('session_id'=>$this->session->userdata('session_id')));
		$data['body_class'] = 'product-page';
		$data['main_content']='product/view-my-cart';
		$this->load->view('includes/template',$data);
	}

	function proceed_to_checkout(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != TRUE){ 
			$this->my_account('0');
		}else{
			
			$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
		      // setting up captcha config
		      $vals = array(
		             'word' => $random_number,
		             'img_path' => './captcha/',
		             'img_url' => base_url().'captcha/',
		             'img_width' => 140,
		             'img_height' => 32,
		             'expiration' => 7200
		            );
		      $data['captcha'] = create_captcha($vals);
		      $this->session->set_userdata('captchaWord',$data['captcha']['word']);

			$data['my_address'] = $this->model->getDataOrderBy('user_addresses',array('user_id'=>$this->session->userdata('user_id')),'added_on','desc');
			foreach ($data['my_address'] as $key => $value) {
				$data['my_address'][$key]['state_name'] = $this->model->getValue('states','state_name',array('state_code'=>$value['state_code']));
			}
			$data['states'] =$this->model->getAllData('states');
			$item_in_cart = $this->model->getData('cart',array('session_id'=>$this->session->userdata('session_id')));
			$cgst = 0;
			$sgst = 0;
			$igst = 0;
			$data['gst_type'] = '';
			$user_id = $this->session->userdata('user_id');

			foreach($item_in_cart as $key => $item){
				$product = $this->model->getData('product',array('product_id'=>$item['product_id']))[0];
				$category_id = $this->model->getValue('product','category_id',array('product_id'=>$item['product_id']));
				$sub_category_id = $this->model->getValue('product','sub_category_id',array('product_id'=>$item['product_id']));
				$gst_setting = $this->model->getData('gst_setting',array('category_id'=>$category_id,'sub_category_id'=>$sub_category_id));
				if(!empty($gst_setting)){

					$data['gst_type'] = $gst_setting[0]['gst_type'];
					$cgst += $item['unit_total']*($gst_setting[0]['CGST']/100);
					$sgst += $item['unit_total']*($gst_setting[0]['SGST']/100);
					$igst += $item['unit_total']*($gst_setting[0]['IGST']/100);
				}
				else{
					$gst_setting = $this->model->getData('gst_setting');
					$data['gst_type'] = $gst_setting[0]['gst_type'];
				}
			}
			$data['cgst'] = $cgst;
			$data['sgst'] = $sgst;
			$data['igst'] = $igst;
			$data['state_code'] = $this->model->getValue('company_setting','state_code',array('comp_sett_id'=>'1'));
			$data['item_in_cart'] = $item_in_cart;

			$data['state_list'] =$this->model->getAllData('state_master');
			$data['body_class'] = 'product-page';

			$data['main_content']='product/proceed_to_checkout';
			
			$this->load->view('includes/template',$data);
		}
	}

	function edit_user_adress(){
		$jsonObj = $_POST['jsonObj'];       
        $json_entity = json_decode($jsonObj,true); 
        $array_data = $json_entity['userdata'];

        if(isset($array_data) && !empty($array_data)){
        	if($this->session->userdata('user_id')>0){
        		$address_id = $array_data['address_id'];
        		$address_data = $this->model->getData('user_addresses',array('user_id'=>$this->session->userdata('user_id'),'address_id'=>$address_id));

        		if(isset($address_data) && !empty($address_data)){
        			$this->model->updateData('user_addresses',$array_data,array('address_id'=>$address_id));
	        		$data['status'] = '1';
        			$data['msg'] = 'Address has been updated successfully.';
        		}else{
        			$data['status'] = '0';
        			$data['msg'] = 'Invalid Address found.';
        		}
        		
        	}else{
        		$data['status'] = '0';
        		$data['msg'] = 'Your session has been expired. Please refresh the page.';
        	}
        }else{
        	$data['status'] = '0';
        	$data['msg'] = 'Required parameters are missing.';
        }
        echo json_encode($data);
	}

	function add_more_address(){
		$jsonObj = $_POST['jsonObj'];       
        $json_entity = json_decode($jsonObj,true); 
        $array_data = $json_entity['userdata'];

        if(isset($array_data) && !empty($array_data)){
        	if($this->session->userdata('user_id')>0){
        		$final_array = array_merge($array_data,array('added_on'=>date('Y-m-d H:i:s'),'user_id'=>$this->session->userdata('user_id')));
        		$address_ids = $this->model->insertData('user_addresses',$final_array);
        		$data['address_id'] = $address_ids;
        		$data['status'] = '1';
        		$data['msg'] = 'New Address has been added successfully.';
        	}else{
        		$data['status'] = '0';
        		$data['msg'] = 'Your session has been expired. Please refresh the page.';
        	}
        }else{
        	$data['status'] = '0';
        	$data['msg'] = 'Required parameters are missing.';
        }
        echo json_encode($data);
	}

	function user_more_address(){
		$data['my_address'] = $this->model->getDataOrderBy('user_addresses',array('user_id'=>$this->session->userdata('user_id')),'added_on','desc');
		$this->load->view('home/user_more_address',$data);
	}

	function get_user_added_address(){
		$address_id = $this->model->get_post('address_id');
		$data['my_address'] = $this->model->getData('user_addresses',array('address_id'=>$address_id,'user_id'=>$this->session->userdata('user_id')));
		$this->load->view('home/user_addresses_ajax',$data);
	}

	function validate_captch(){
		$jsonObj = $_POST['jsonObj'];       
        $json_entity = json_decode($jsonObj,true); 
        $array_data = $json_entity['account'];

		$captcha_code = $array_data['captcha_code'];
		if($captcha_code!=''){
			$word = $this->session->userdata('captchaWord'); 
		    if(strcmp(strtoupper($captcha_code),strtoupper($word)) == 0){
		      	echo  '1';
		    }else{
		    	echo  '0';
		    }
		}else{
		 		echo  '0';
		}
	}

	function check_pincode(){
		$jsonObj = $_POST['jsonObj'];       
        $json_entity = json_decode($jsonObj,true); 
        $array_data = $json_entity['account'];

		$pincode = $array_data['pincode'];
		if($pincode!=''){
			
			$pin_data = $this->model->getData('pincode_list',array('pincode'=>$pincode,'status'=>'1'));

		    if(isset($pin_data) && !empty($pin_data)){
		      	echo  '1';
		    }else{
		    	echo  '0';
		    }
		}else{
		 		echo  '0';
		}
	}

	
/*End of Controller*/
}