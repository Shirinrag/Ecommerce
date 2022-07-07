<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/config_paytm.php");
require_once(APPPATH."libraries/encdec_paytm.php");
class home extends CI_Controller {

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
        // $strBrandQry = "SELECT * FROM brands ORDER BY brand_name ASC";
        // $top_brand_list = $this->model->getSqlData($strBrandQry);
        // $glob['top_brand'] = $top_brand_list;
        //echo '<pre>'; print_r($glob['top_brand']); exit;
        
        $this->load->vars($glob);
        date_default_timezone_set('Asia/Kolkata');
	}
	
	function index()
	{		
		
		$data['body_class'] = 'home';
		 
        //vegetables list : 17
        $strQry = "SELECT * FROM product WHERE listed_in_super_deal='0' AND stock_status='1' AND status='1' ORDER BY  product_id DESC LIMIT 0,25 ";
        $data['product_list'] = $this->model->getSqlData($strQry);

        //echo '<pre>';print_r($data['product_list']);exit;

        $data['banner_list'] = $this->model->getData('bottom_banner',array('status'=>'1'));

        $data['child_banner_list'] = $this->model->getData('child_banner',array('status'=>'1'));

        $supder_deal_products = $this->model->getData('product',array('listed_in_super_deal'=>'1','status'=>'1'));
	    foreach ($supder_deal_products as $key => $value) {
	        if(empty($value['pack_size'])) {
	            $value['pack_size'] = "1";
	        }
	        $pack_sizes = explode(',', $value['pack_size']);
	        $prices = explode(',', $value['price']);
	        $unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

	        $pack_sizes2 = [];
	        foreach ($pack_sizes as $key1 => $value1) {
	            if(isset($prices[$key1])){
	                $pack_sizes2[] = array(
	                    'pack_size'=> $value1,
	                    'price'=> $prices[$key1]
	                );
	            }
	        }
	        $supder_deal_products[$key]['pack_sizes']= $pack_sizes2;
	        $supder_deal_products[$key]['unit_name']= $unit_name;
	    }
	    $data['supder_deal_products'] = $supder_deal_products;

	    $trending_products = $this->model->getData('product',array('listed_in_trending'=>'1','status'=>'1'));
	    foreach ($trending_products as $key => $value) {
	        if(empty($value['pack_size'])) {
	            $value['pack_size'] = "1";
	        }
	        $pack_sizes = explode(',', $value['pack_size']);
	        $prices = explode(',', $value['price']);
	        $unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

	        $pack_sizes2 = [];
	        foreach ($pack_sizes as $key1 => $value1) {
	            if(isset($prices[$key1])){
	                $pack_sizes2[] = array(
	                    'pack_size'=> $value1,
	                    'price'=> $prices[$key1]
	                );
	            }
	        }
	        $trending_products[$key]['pack_sizes']= $pack_sizes2;
	        $trending_products[$key]['unit_name']= $unit_name;
	    }
	    $data['trending_products'] = $trending_products;

	    //$trend_product = array_chunk($data['trending_products'],3,true); 

	    //echo '<pre>'; print_r($trend_product); exit;
        //$data['breadcrumbs'] = '<a href="https://healthxp.in">Home</a>';
		$data['main_content']='home/index';
		$this->load->view('includes/template',$data);
	}
	function bulk_page(){
		$data['main_content']='home/bulk.php';
		$this->load->view('includes/template',$data);
	}
	function reviews(){
		$data['videos'] = $this->model->getData('videos',array('status'=>'1'));
		$data['main_content']='home/reviews.php';
		$this->load->view('includes/template',$data);
	}


	function search_pagination_content(){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$item_per_page = filter_var($_POST["offset"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	 
		//throw HTTP error if page number is not valid
		if(!is_numeric($page_number)){
		    header('HTTP/1.1 500 Invalid page number!');
		    exit();
		}

		$offset = (($page_number-1) * $item_per_page);
		$strQry = "SELECT * FROM product WHERE listed_in_super_deal='0' AND status='1' LIMIT  ".$offset.' , '.$item_per_page;
		//$product_data =  $this->model->getDataLimit('product',array('listed_in_super_deal'=>'0','status'=>'1'),$offset,'6');
		$data['get_fresh_product'] =  $this->model->getSqlData($strQry);
		$this->load->view('product/search_pagination_content',$data);
	}

	function delivery_information(){
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/delivery-information';
		$this->load->view('includes/template',$data);
	}

	function start_paytm_txn(){
		$session_id = $this->session->userdata('session_id');
		$txn_code = $this->input->get_post('txn_code');
		if($session_id!=""){
			$order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM cart WHERE session_id="'.$session_id.'"');
			$total_amount = $order_data[0]['total'];
			if($total_amount>0){

				$user_id = $this->session->userdata('user_id');
				$user_data = $this->model->getData('user',array('user_id'=>$user_id));

				$deliver_address = $this->input->get_post('deliver_address');
				$delivery_date = $this->input->get_post('delivery_date');
				$delivery_time = $this->input->get_post('delivery_time');
				$order_id = $this->input->get_post('order_id');

				$discounted_amount = $this->input->get_post('discounted_amount');

				$data['amount'] = $total_amount;
				$data['firstname'] = $user_data[0]['full_name'];
				$data['email'] = $user_data[0]['email_address'];
				$data['phone'] = $user_data[0]['mobile_number'];
				$data['txn_code'] = $txn_code;

				$txn_id = 'WH'.$order_id;
				$data['txnid'] = $txn_id;

				$txn_array=array(
					'user_id'=>$user_id,
					'address_id'=>$deliver_address,
					'txn_id'=>$txn_id,
					'del_date'=> date('Y-m-d',strtotime($delivery_date)),
					'del_time'=>$delivery_time,
					'discounted_amount'=>$discounted_amount,
					'amount'=>$total_amount,
					'offer_code'=>$txn_code,
					'session_id'=>$session_id,
					'status'=>'0',
				);

				$txn_order_data = $this->model->getData('online_txn_data',array('txn_id'=>$txn_id));
				//print_array($txn_order_data);

				//check if already txn id is exist
				if(isset($txn_order_data) && empty($txn_order_data)){
					$this->model->insertData('online_txn_data',$txn_array);
				}

				$delivery_charges = ($total_amount<100) ? '20' : '00';
				$total_final_amt = ($total_amount-$discounted_amount)+$delivery_charges;

				$paybalamount = $total_final_amt;

				$total_final_amt = $paybalamount;
				$paydata['MID'] = PAYTM_MERCHANT_MID;
				$paydata['ORDER_ID'] = $txn_id;
				$paydata['CUST_ID']  = $user_data[0]['user_id'];
				$paydata['INDUSTRY_TYPE_ID']  = 'RETIAL';
				$paydata['CHANNEL_ID']  = 'WEB';
				$paydata['TXN_AMOUNT'] = $total_final_amt;
				$paydata['WEBSITE']  = 'WEBSTAGING';
				$paydata['CALLBACK_URL']  = base_url().'home/PaytmResponse';
				$paydata['MSISDN']  = "8424862606";
				$paydata['EMAIL']  = $user_data[0]['email_address'];
				$paydata['VERIFIED_BY']  = "EMAIL";
				$paydata['IS_USER_VERIFIED']  = "YES";
				$paydata['CHECKSUMHASH'] = getChecksumFromArray($paydata,PAYTM_MERCHANT_KEY);

				//echo '<pre>'; print_r($paydata); exit;
				$this->load->view('payment/start_paytm_txn',$paydata);

				//update total amount for online transaction
			}else{
				$this->failure_txn("Your cart is empty. Please add some product to your cart");	
			}
		}else{
			$this->failure_txn("Your session has been expired. For online order, Please refresh the page, do Login In/ Sign Up.");
		}
	}

	

	function PaytmResponse()
	{
		$paytmChecksum = "";
		$data = array();
		$isValidChecksum = "FALSE";

		$data = $_POST;
		
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($data, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


		if($isValidChecksum == "TRUE") {
			echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				echo "<b>Transaction status is success</b>" . "<br/>";
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.
			}
			else {
				echo "<b>Transaction status is failure</b>" . "<br/>";
			}

			if (isset($_POST) && count($_POST)>0 )
			{ 
				foreach($_POST as $paramName => $paramValue) {
						echo "<br/>" . $paramName . " = " . $paramValue;
				}
			}
			

		}
		else {
			echo "<b>Checksum mismatched.</b>";
			//Process transaction as suspicious.
		}
	}

	function return_policy(){
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/return-policy';
		$this->load->view('includes/template',$data);
	}
	
	function privacy_policy(){
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/privacy-policy';
		$this->load->view('includes/template',$data);
	}

	function terms_condition(){
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/terms-condition';
		$this->load->view('includes/template',$data);
	}
	

	function about_us(){
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/about-us';
		$this->load->view('includes/template',$data);
	}

	function contact_us(){
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/contact-us';
		$this->load->view('includes/template',$data);	
	}

	function validate_old_password(){
		
		$user_id = $this->session->userdata('user_id');
		//$old_passord = '123456';
		$old_passord = $_POST['opasswrd'];
		
		//print_r($old_passord);
		//print_r($user_id);exit;
		$user_password = $this->model->getData('user', array('user_id' => $user_id,'password'=>md5($old_passord)));
		//echo '<pre>'; print_r($user_password); exit;
        if (isset($user_password) && !empty($user_password)) {
        	$data['status'] = '1';
        	$data['msg'] = "Old Password Match.";
        	
        }else{
          	$data['status'] = '0';
          	$data['msg'] = "incorrect Password.";
          	
        }
        echo json_encode($data);
	}


	function check_offer($value=''){
		$jsonObj = $_POST['jsonObj'];
        $jsonData = json_decode($jsonObj, true);
        $jsonEntity = $jsonData['account'];

        $offer_code = $jsonEntity['offer_code'];
        $offer_data = $this->model->getData('offer_master', array('offer_name' => strtolower($offer_code)));
        if ($offer_data) {// 1: Exist; 0:Not Exist
            echo "1";
        } else {
            echo "0";
        }
	}

	function check_email_address(){
		$jsonObj = $_POST['jsonObj'];
        $jsonData = json_decode($jsonObj, true);
        $jsonEntity = $jsonData['account'];

        $user_mailaadress = $jsonEntity['emailaddress'];
        $emaildata = $this->model->getData('user', array('email_address' => $user_mailaadress));
        if ($emaildata) {// 1: Exist; 0:Not Exist
            echo "1";
        } else {
            echo "0";
        }
	}

	function forgot_password(){
		$data['main_content']='home/forgot_password';
		$data['total_cart_item']=$this->model->CountWhereRecord('cart',array('session_id'=>$this->session->userdata('session_id')));
		$this->load->view('includes/template',$data);
	}

	function reset_my_password(){
		$jsonObj = $_POST['jsonObj'];       
        $form_data = json_decode($jsonObj,true); 
        $form_entity = $form_data['FormData'];

        if(isset($form_entity) && !empty($form_entity)){
        	$email_address = $form_entity['email_address'];
        	$user_data = $this->model->getData('user',array('email_address'=>$email_address));
        	if(isset($user_data) && !empty($user_data)){
        		$user_id = $user_data[0]['user_id'];
        		$this->send_forgot_pasword_activation_link($user_id,$email_address);

        		$fp_data = $this->model->getData('forgot_password',array('user_id'=>$user_id,'email_address'=>trim($email_address)));
        		if(isset($fp_data) && empty($fp_data)){ //no need to insert the record
					$this->model->insertData('forgot_password',array('user_id'=>$user_id,'email_address'=>$email_address,'requested_on'=>date('Y-m-d H:i:s')));
        		}

        		$data['status'] = '1';
        		$data['msg'] = 'Yuss! Reset instructions have been mailed to '.$email_address.'. Be sure to check your Junk/Spam folder, if you do not see an email from us in your inbox within a few minutes. ';
        	}else{
        		$data['status'] = '0';
        		$data['msg'] = 'Oopss. It seems that your email address is not registered with us. Please register your account with us.';
        	}
        }else{	
        	$data['status'] = '0';
        	$data['msg'] = 'Invalid form data send.';
        }
        echo json_encode($data);
	}

	function send_forgot_pasword_activation_link($usr_id,$email_address){
		$to      = $email_address;
		$ip_address = $this->input->ip_address();
		
		$href_link = base_url()."home/password_recovery?usrid=".$usr_id."&hash=".base64_encode($email_address);

		$subject = 'Reset your Password';
		$message = "A request to reset password was received from your DirectFarm.in Account - ".$email_address." from the IP - ".$ip_address." .<br>";
		$message .= '<br><a href='.$href_link.'>Use this link to reset your password and login.</a>';
		$message .= '<br><br><b>Note:</b> This link is valid for 1 hour from the time it was sent to you and can be used to change your password only once.';
		
		$message .= '<br><br>Regards,<br>';
		$message .= 'DirectFarm Team<br>';
		$message .= '<a href="http://www.directfarm.in">DirectFarm.in<br>';

		$company_setting = $this->model->getData('company_setting')[0];
		sendEmail($company_setting['email'],$email_address,$subject,$message);

		// $headers = 'From: DirectFarm.in <support@directfarm.in>' . "\r\n" .
		//     		'Reply-To: support@directfarm.in' . "\r\n" .
		//     		"MIME-Version: 1.0\r\n".
		// 			"Content-Type: text/html; charset=ISO-8859-1\r\n";
		// 			'X-Mailer: PHP/';

		// $retval = mail($to, $subject, $message, $headers);
	}

	function password_recovery(){
		$usr_id = $this->input->get_post('usrid');
		$email_address = base64_decode($this->input->get_post('hash'));

		$data['usr_id'] = $usr_id;
		$data['email_address'] = $email_address;

		$data['fp_data'] = $this->model->getData('forgot_password',array('user_id'=>$usr_id,'email_address'=>trim($email_address)));
		// echo '<pre>'; print_r($data['fp_data']); exit;
		
		$data['main_content']='home/password_recovery';
		$this->load->view('includes/template',$data);
	}

	function change_user_password(){
		$jsonObj = $_POST['jsonObj'];       
        $form_data = json_decode($jsonObj,true); 
        $form_entity = $form_data['FormData'];

        if(isset($form_entity) && !empty($form_entity)){
        	$fp_id = $form_entity['fp_id'];
			$email_address = $form_entity['email_address'];
			$user_id = $form_entity['user_id'];
			$confirm_password = $form_entity['confirm_password'];

			$fp_data = $this->model->getData('forgot_password',array('fp_id'=>$fp_id));
			if(isset($fp_data) && !empty($fp_data)){
				$user_data = $this->model->updateData('user',array('password'=>md5($confirm_password)),array('email_address'=>$email_address,'user_id'=>$user_id));
				$this->model->deleteData('forgot_password',array('fp_id'=>$fp_id));

				$this->send_email_on_changed_password($email_address);

				$data['status'] = '1';
	        	$data['msg'] = 'Yuss. your password has been changed successfully. <a href="http://directfarm.in/account/my_account">Click here</a> to login';
			}else{
				$data['status'] = '0';
	        	$data['msg'] = 'Opss. your session has been expired.';
			}
        }else{
        	$data['status'] = '0';
        	$data['msg'] = 'Opss.. Something went wrong while changing your password.';
        }

		echo json_encode($data);
	}

	function send_email_on_changed_password($email_address){
		$to = $email_address;
		$ip_address = $this->input->ip_address();
		$subject = 'Your Account Password has been changed successfully';
		
		$message = "The password for your DirectFarm.in Account - ".$email_address." has been successfully changed.<br>";
		$message .= "This request was received from ".$ip_address." . If you have not authorized this request, please contact us immediately using the information below.";

		$message .= '<br><br><i>Direct Support</i><br>';
		$message .= 'Phone : + 91 90299 21216<br>';
		$message .= 'Email Address:support@directfarm.in<br>';
		
		$message .= '<br><br>Regards,<br>';
		$message .= 'DirectFarm Team<br>';
		$message .= '<a href="http://www.directfarm.in">DirectFarm.in<br>';

		// $headers = 'From: DirectFarm.in <support@directfarm.in>' . "\r\n" .
		//     		'Reply-To: support@directfarm.in' . "\r\n" .
		//     		"MIME-Version: 1.0\r\n".
		// 			"Content-Type: text/html; charset=ISO-8859-1\r\n";
		// 			'X-Mailer: PHP/';

		// $retval = mail($to, $subject, $message, $headers);
		$company_setting = $this->model->getData('company_setting')[0];
		sendEmail($company_setting['email'],$email_address,$subject,$message);
	}

	function SendContactUsEmail(){
		$jsonObj = $_POST['jsonObj'];       
        $contact_us_array = json_decode($jsonObj,true); 
        $contact_us_entity = $contact_us_array['FormData'];

        if(isset($contact_us_entity) && !empty($contact_us_entity)){
	        $to      = 'arvind.prajapati20@gmail.com,sachin.godage@microlan.in,lalit.prajapati@microlan.in';
			$subject = 'DirectFarm.in Contact Us From '.$contact_us_entity['name'];
			$message = "Hi,<br><br>";
			
			$message .= 'New user has contacted <br><br>';
			$message .= 'Name:'.   $contact_us_entity['name'] .'<br><br>';
			$message .= 'Contact Number :'.  $contact_us_entity['contact_number'] .'<br><br>';
			$message .= 'Email Address :'.$contact_us_entity['email'] .'<br><br>';
			$message .= 'Subject:'.   $contact_us_entity['subject'] .'<br><br>';
			$message .= 'Message :'.  $contact_us_entity['message'] .'<br><br>';
			
			$message .= 'Thank You! <br>';
			$message .= 'DirectFarm.in<br>';

			$headers = 'From: DirectFarm.in <support@directfarm.in>' . "\r\n" .
			    		'Reply-To: support@directfarm.in' . "\r\n" .
			    		"MIME-Version: 1.0\r\n".
						"Content-Type: text/html; charset=ISO-8859-1\r\n";
						'X-Mailer: PHP/';

			$retval = mail($to, $subject, $message, $headers);
			$data['status'] = '1';
			$data['msg'] = 'Thank you contacting us. we will be in touch with you shortly.';
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Opss. Something went wrong while sending the message.';
		}
		echo json_encode($data);
	}


	function account_registeration(){
		// $jsonObj = $_POST['jsonObj'];       
		// $user_object = json_decode($jsonObj,true); 
		$user_data = $_POST;
		$password = $user_data['password'];
		$email_address = $user_data['email_address'];
		$mobile_number = $user_data['mobile_number'];

		$final_user_data = array_merge($user_data,array('password'=>md5($password),'registration_date' => date('Y-m-d H:i:s')));
		
		$profile_email = $this->model->getData('user',array('email_address' =>$email_address));
		$profile_mobile_number = $this->model->getData('user',array('mobile_number' =>$mobile_number));
		$session_otp_code = $this->session->userdata('otp_code');

		if(md5($user_data['otp_code']) == $session_otp_code){
			if(isset($profile_email) && empty($profile_email)){
				if(isset($profile_mobile_number) && empty($profile_mobile_number)){
					$user_id = $this->model->insertData('user',$final_user_data);
					//$this->verificationLink($user_id);
					$data['status'] = '1';
					$data['msg'] = "Congratulations!. Your account has been registered with us.";
				}else{
					$data['status'] = '0';
					$data['msg'] = "Mobile number is already registered with us.";
				}
			}else{
				$data['status'] = '0';
				$data['msg'] = "Email address is already registered with us. Please enter other email address.";
			}
		}
		else{
			$data['status'] = '2';
			$data['msg'] = "Otp you entered is incorrect";
		}
		echo json_encode($data);
	}

	function verifyRegistrationOtp(){
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$otp_code = get_random_number(4);
		$email_message = $otp_code." is your One Time Password(OTP) to verify your mobile no or email at www.marcos.in";
		$company_setting = $this->model->getData('company_setting')[0];
		$subject = 'Verify Otp';
		sendEmail($company_setting['email'],$email,$subject,$email_message);
		sendSMS($mobile,$email_message);

		$this->session->set_userdata(array('otp_code'=>md5($otp_code)));
	}

	function validate_login(){
		$jsonObj = $_POST['jsonObj'];
        $jsonData = json_decode($jsonObj, true);
        $jsonEntity = $jsonData['login'];

        $email_address = $jsonEntity['email_address'];
        $password = $jsonEntity['password'];

        $user_data = $this->model->getData('user', array('email_address' => $email_address,'password'=>md5($password)));
        if (isset($user_data) && !empty($user_data)) {// 1: Exist; 0:Not Exist
            
            /*if($user_data[0]['is_email_verified']=='0'){
            	$data['status'] = '0';
            	$data['msg'] = 'Your have not verified your email address. Please check your email inbox.';
            }else{*/

	            $newdata = array(
	               	'user_id' => $user_data[0]['user_id'],
	               	'email_address'   => $user_data[0]['email_address'],
	               	'full_name' => $user_data[0]['full_name'],
	                'is_logged_in' => TRUE
	            );
	                
				$this->session->set_userdata($newdata);

				if($user_data[0]['is_email_verified']=='0'){
            		$data['status'] = '1';
            		$data['msg'] = 'You have logged in successfully, as still your email address verification is pending. Please check your email inbox/spam and verify your email address.';
            	}else{
					$data['status'] = '1';
					$data['msg'] = 'You have logged in successfully.';
				}
			//}
        }else{
          	$data['status'] = '0';
          	$data['msg'] = 'Email address or password you entered is incorrect. Please try again.';
        }
        echo json_encode($data);
	}


	function verificationLink($user_id=''){
		if($user_id!=''){
			$user_detail = $this->model->getData('user',array('user_id' => $user_id));
			$username = $user_detail[0]['full_name'];
			$useremail = $user_detail[0]['email_address'];

			$link = base_url().'home/verifyLink?user_id='.base64_encode($useremail);

			$subject = 'Confirm your directfarm account, '.$username;

			$emailer = 'emailer/email_confirmation.html';
			$verify_mail = file_get_contents($emailer);
			$verify_mail = str_replace('@_Username_@', $username, $verify_mail);
			$verify_mail = str_replace('@_email_@', $useremail, $verify_mail);
			$verify_mail = str_replace('@_Verify_Account_@', $link, $verify_mail);
			
			$headers = 'From: directfarm <support@directfarm.in>' . "\r\n" .
			    		'Reply-To: support@directfarm.in' . "\r\n" .
			    		"MIME-Version: 1.0\r\n".
						"Content-Type: text/html; charset=ISO-8859-1\r\n";
						'X-Mailer: PHP/';

			mail($useremail, $subject, $verify_mail, $headers);
		}
	}

	function verifyLink($user_id=''){
		$email_id = $this->input->get_post('user_id');
		$user_detail = $this->model->getData('user',array('email_address' => base64_decode($email_id)));
		if(isset($user_detail) && !empty($user_detail)){
			$v_link = $this->model->updateData('user',array('is_email_verified' => '1'),array('email_address'=>base64_decode($email_id)));
			$data['msg'] = '1';
			$data['email_address'] = base64_decode($email_id);
		}else{
			$data['msg'] = '0';
		}
		$this->load->view('home/email-confirmation',$data);
	}

	function signout(){
		echo $session_id = $this->session->userdata('session_id');

        $this->session->set_userdata(array('is_logged_in' => FALSE));
        $this->session->sess_destroy();

        $this->session->set_userdata(array('session_id' => $session_id));
        //print_array($this->session->all_userdata());
        redirect(base_url());
	}

	function order_confirmation_via_wallet_payment(){
		$jsonObj = $_POST['jsonObj'];
        $jsonData = json_decode($jsonObj, true);
        $jsonEntity = $jsonData['cart'];
        $data = array();

        if(isset($jsonEntity) && !empty($jsonEntity)){
        	$deliver_address = $jsonEntity['deliver_address'];
        	$payment_method = $jsonEntity['payment_method'];
        	$offer_code = $jsonEntity['promo_code'];

        	$delivery_date = $jsonEntity['delivery_date'];
        	$delivery_time = $jsonEntity['delivery_time'];
        	$discounted_amount = $jsonEntity['discounted_amount'];
        	$sgst = $jsonEntity['sgst'];
        	$cgst = $jsonEntity['cgst'];
        	$igst = $jsonEntity['igst'];

        	$is_logged_in = $this->session->userdata('is_logged_in');
	        if(!isset($is_logged_in) || $is_logged_in != TRUE){ 
	        	$data['status'] = 0;
        		$data['msg'] = 'Your must login to place your order.';
	       
	        }else{

	        	if($payment_method=='wallet'){

		        	$user_id = $this->session->userdata('user_id');
	        		$session_id = $this->session->userdata('session_id');
		        	if(isset($session_id) && $session_id!=''){

		        		$user_data = $this->model->getData('user',array('user_id'=>$user_id));
		        		if(isset($user_data) && !empty($user_data)){

			        		$cart_item =$this->model->getData('cart',array('session_id'=>$session_id));
			        		$total_amount = $this->model->getSqlData("SELECT SUM(unit_total) AS Total FROM cart WHERE session_id='".$session_id."'");
			        		if(isset($cart_item) && !empty($cart_item)){
			        			$orderNo = 'DF'.date('Ymd').time();

			        			$delivery_charges = ($total_amount[0]['Total']<100) ? '20' : '00';
								
			        			$order_data = array(
			        				'user_id'=>$user_id,
			        				'order_number'=>$orderNo,
			        				'delivery_charges'=>$delivery_charges,
			        				'total_amount'=>$total_amount[0]['Total'],
			        				'after_discounted_amount'=>$total_amount[0]['Total'],
			        				'payment_method'=>$payment_method,
			        				'address_id'=>$deliver_address,
			        				'user_expected_order_date'=>date('Y-m-d',strtotime($delivery_date)),
			        				'user_expected_order_time_slot'=>$delivery_time,
			        				'order_date_time'=>date('Y-m-d H:i:s'),
			        				'offer_code'=>$offer_code,
			        				'discounted_amount'=>$discounted_amount,
			        				'sgst'=>$sgst,
			        				'cgst'=>$cgst,
			        				'igst'=>$igst
			        			);
			        			$order_id = $this->model->insertData('order_data',$order_data);

			        			foreach ($cart_item as $key => $value) {
			        				$array_cart_item=array(
			        					'user_id'=>$user_id,
			        					'order_id'=>$order_id,
			        					'order_number'=>$orderNo,
			        					'product_id'=>$value['product_id'],
			        					'qty'=>$value['qty'],
			        					'price'=>$value['price'],
			        					'unit_total'=>$value['unit_total'],
			        				);
			        				$this->model->insertData('order_data_details',$array_cart_item);
			        			}

			        			$txn_no  = generateRandomString();
			        			$wallet_array = array(
	                                'txn_no'=>$txn_no,
	                                'user_id'=>$user_id,
	                                'offer_code'=>$offer_code,
	                                'order_number'=>$orderNo,
	                                'wallet_amount'=>$total_amount[0]['Total'],
	                                'date'=>date('Y-m-d'),
	                                'txn_type'=>'2',//debit-gaya
	                            );
	                            //print_array($wallet_array);
	                            $this->model->insertData('wallet_txn',$wallet_array);

			        			$this->send_order_confirmation_mail($order_id,$deliver_address);
			        			$this->sms_order_confirmation_to_user($order_id,$user_data[0]['mobile_number'],$user_data[0]['full_name']);
			        			$this->sms_order_confirmation_to_admin($order_id,'9029921216',$user_data[0]['full_name']);

			        			$data['status'] = 1;
			        			$data['msg'] = 'Your order has been placed successfully. Your order no is: '.$orderNo;

			        			$this->model->deleteData('cart',array('session_id'=>$session_id));

			        		}else{
			        			$data['status'] = 0;
			        			$data['msg'] = 'Your cart is empty.';
			        		}
			        	}else{
			        		$data['status'] = 0;
		        			$data['msg'] = 'We are not recognizing you. Please login again';	
			        	}
		        	}else{
		        		$data['status'] = 0;
		        		$data['msg'] = 'Session has been expired. Please login again';
		        	}
	        	}else{
	        		$data['status'] = 0;
	        		$data['msg'] = 'Your order can not be processed. It is only valid ofr wallet payment.';
	        	}
	        }
        }
        echo json_encode($data);
	}

	

	function order_confirmation(){
		$jsonObj = $_POST['jsonObj'];
        $jsonData = json_decode($jsonObj, true);
        $jsonEntity = $jsonData['cart'];
        $data = array();

        if(isset($jsonEntity) && !empty($jsonEntity)){
        	$deliver_address = $jsonEntity['deliver_address'];
        	$payment_method = $jsonEntity['payment_method'];

        	$delivery_date = date('Y-m-d');
        	$delivery_time = date('Y-m-d');

        	$promo_code = $jsonEntity['promo_code'];
        	$discounted_amount = $jsonEntity['discounted_amount'];
        	$sgst = $jsonEntity['sgst'];
        	$cgst = $jsonEntity['cgst'];
        	$igst = $jsonEntity['igst'];

        	$is_logged_in = $this->session->userdata('is_logged_in');
	        if(!isset($is_logged_in) || $is_logged_in != TRUE){ 
	        	$data['status'] = 0;
        		$data['msg'] = 'Your must login to place your order.';
	       
	        }else{
	        	$user_id = $this->session->userdata('user_id');
        		$session_id = $this->session->userdata('session_id');
	        	if(isset($session_id) && $session_id!=''){

	        		$user_data = $this->model->getData('user',array('user_id'=>$user_id));
	        		if(isset($user_data) && !empty($user_data)){

		        		$cart_item =$this->model->getData('cart',array('session_id'=>$session_id));
		        		$total_amount = $this->model->getSqlData("SELECT SUM(unit_total) AS Total FROM cart WHERE session_id='".$session_id."'");
		        		if(isset($cart_item) && !empty($cart_item)){
		        			$orderNo = 'DF'.date('Ymd').time();

		        			$delivery_charges = ($total_amount[0]['Total']<100) ? '20' : '00';

		        			$order_data = array(
		        				'user_id'=>$user_id,
		        				'order_number'=>$orderNo,
		        				'delivery_charges'=>$delivery_charges,
		        				'total_amount'=>$total_amount[0]['Total'],
		        				'after_discounted_amount'=>$total_amount[0]['Total'],
		        				'payment_method'=>$payment_method,
		        				'address_id'=>$deliver_address,
		        				'user_expected_order_date'=>date('Y-m-d',strtotime($delivery_date)),
		        				'user_expected_order_time_slot'=>$delivery_time,
		        				'order_date_time'=>date('Y-m-d H:i:s'),
		        				'offer_code'=>$promo_code,
		        				'discounted_amount'=>$discounted_amount,
		        				'sgst'=>$sgst,
		        				'cgst'=>$cgst,
		        				'igst'=>$igst
		        			);
		        			$order_id = $this->model->insertData('order_data',$order_data);

		        			foreach ($cart_item as $key => $value) {
		        				$array_cart_item=array(
		        					'user_id'=>$user_id,
		        					'order_id'=>$order_id,
		        					'order_number'=>$orderNo,
		        					'product_id'=>$value['product_id'],
		        					'pack_size'=>$value['pack_size'],
		        					'qty'=>$value['qty'],
		        					'price'=>$value['price'],
		        					'unit_total'=>$value['unit_total'],
		        				);
		        				$this->model->insertData('order_data_details',$array_cart_item);

		        				$stock_item_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
					            if(isset($stock_item_data) && !empty($stock_item_data)){
					                $stock_qty = $stock_item_data[0]['stock_qty']-$value['qty'];
					                $this->model->updateData('product',array('stock_qty'=>$stock_qty),array('product_id'=>$value['product_id']));
					                $this->model->updateData('stock_master',array('stock_qty'=>$stock_qty),array('stock_id'=>$stock_item_data[0]['stock_id']));
					            }
		        			}

		        			$this->send_order_confirmation_mail($order_id,$deliver_address);
		        			$this->sms_order_confirmation_to_user($order_id,$user_data[0]['mobile_number'],$user_data[0]['full_name']);
		        			$this->sms_order_confirmation_to_admin($order_id,'9029921216',$user_data[0]['full_name']);

		        			$data['status'] = 1;
		        			$data['msg'] = 'Your order has been placed successfully. Your order no is: '.$orderNo;

		        			$this->model->deleteData('cart',array('session_id'=>$session_id));

		        		}else{
		        			$data['status'] = 0;
		        			$data['msg'] = 'Your cart is empty.';
		        		}
		        	}else{
		        		$data['status'] = 0;
	        			$data['msg'] = 'We are not recognizing you. Please login again';	
		        	}
	        	}else{
	        		$data['status'] = 0;
	        		$data['msg'] = 'Session has been expired. Please login again';
	        	}
	        }
        }
        echo json_encode($data);
	}

	function sms_order_confirmation_to_user($order_id,$mobile_no,$customer_name)
    {
        if($order_id!=""){
            $order_data = $this->model->getData('order_data',array('order_id'=>$order_id));
            if(isset($order_data) && !empty($order_data)){
                $order_no = $order_data[0]['order_number'];
                $total_amount = $order_data[0]['total_amount'];
              
                $text_message = "Dear ". $customer_name. ". Thank you for shopping with us, We have received your order no ".$order_no.". We will process your order at your chosen date and time. Your total billed amount is Rs. ".$total_amount.". Stay Healthy, directfarm.in";

                $smssubject = urlencode($text_message);
                $url = "http://web.insignsms.com/api/sendsms?username=directfarm&password=directfarm&senderid=DTFARM&message=".$smssubject."&numbers=".$mobile_no."&dndrefund=1";
                /*$url = "http://sms2biz.microlan.in/sendSMS?username=dtfarm&message=".$smssubject."&sendername=DTFARM&smstype=TRANS&numbers=".$mobile_no."&apikey=510ba168-561a-4afc-8925-eeb3e8aa9b59";*/

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                $output = curl_exec($ch);
                $info = curl_getinfo($ch);
                curl_close($ch);
            }
        }
    }

    function sms_order_confirmation_to_admin($order_id,$mobile_no,$customer_name)
    {
        if($order_id!=""){
            $order_data = $this->model->getData('order_data',array('order_id'=>$order_id));
            if(isset($order_data) && !empty($order_data)){
                $order_no = $order_data[0]['order_number'];
                $total_amount = $order_data[0]['total_amount'];
              
                $text_message = "Dear Admin, We have received new order no ".$order_no." from WEBSITE with total billed amount Rs. ".$total_amount." from ".$customer_name.". Plz check mail.";

                $smssubject = urlencode($text_message);
                $url = "http://web.insignsms.com/api/sendsms?username=directfarm&password=directfarm&senderid=DTFARM&message=".$smssubject."&numbers=".$mobile_no."&dndrefund=1";
                /*$url = "http://sms2biz.microlan.in/sendSMS?username=dtfarm&message=".$smssubject."&sendername=DTFARM&smstype=TRANS&numbers=".$mobile_no."&apikey=510ba168-561a-4afc-8925-eeb3e8aa9b59";*/

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                $output = curl_exec($ch);
                $info = curl_getinfo($ch);
                curl_close($ch);
            }
        }
    }


	function myorder(){
		$user_id = $this->session->userdata('logged_user_id');
		if(isset($user_id) && $user_id!=''){
			$strQry = "SELECT * FROM km_order_details WHERE user_id='".$user_id."' ORDER BY order_date_time DESC";
			$data['order_summary'] = $this->model->getSqlData($strQry);
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
			$data['msg'] = 'you must login to check your order summary.';
		}
		$data['is_hide_cat'] = 'yes';
		$data['main_content']='home/myorder';
		$this->load->view('includes/template',$data);
	}

	function subscribe_user(){
		$jsonObj = $_POST['jsonObj'];       
		$user_object = json_decode($jsonObj,true); 
		$user_data = $user_object['FormData'];

		$email_address = $user_data['email_address'];
		$final_user_data = array_merge($user_data,array('added_on' => date('Y-m-d H:i:s')));
		$profile_email = $this->model->getData('user_subscription',array('email_address' =>$email_address));
		//echo json_encode($profile_email);exit;
		if(isset($profile_email) && empty($profile_email)){
			$user_id = $this->model->insertData('user_subscription',$final_user_data);
			$data['status'] = '1';
			$data['msg'] = "Thank you for your email subscription.";
		}else{
			$data['status'] = '0';
			$data['msg'] = "Email address is already subscribed with us. Please provide other email address.";
		}
		echo json_encode($data);
	}

	function send_order_confirmation_mail($order_id,$deliver_address){
		if($order_id!='' && $deliver_address!=''){

			$order_data = $this->model->getData('order_data',array('order_id'=>$order_id));
			if(isset($order_data) && !empty($order_data)){

				$del_data = $this->model->getData('user_addresses',array('address_id'=>$deliver_address));
				$shipping_address=  $del_data[0]['full_name'].'<br>'.$del_data[0]['mobile_number'].'<br>'.$del_data[0]['address1'].'<br>'.$del_data[0]['address2'].'<br>'.$del_data[0]['landmark_nearest_area'].'<br>'.$del_data[0]['town_city'].'<br>'.$del_data[0]['pincode'].'<br>';

				$user_data = $this->model->getData('user',array('user_id'=>$order_data[0]['user_id']));
				$to_email_address = $user_data[0]['email_address'];
				$user_name =  $user_data[0]['full_name'];
				$order_number = $order_data[0]['order_number'];
				$user_expec_received_by_date=($order_data[0]['user_expected_order_date']!='') ? date('d-m-Y',strtotime($order_data[0]['user_expected_order_date'])) : '' ;
				$user_expec_received_by_time = $order_data[0]['user_expected_order_time_slot'];

				$total_amount =  upto2Decimal($order_data[0]['total_amount']); 
				$discounted_amount =  upto2Decimal($order_data[0]['discounted_amount']);
				$del_charges= upto2Decimal($order_data[0]['delivery_charges']);

				$payable_amount= upto2Decimal(($total_amount - $discounted_amount) + $del_charges);
				$offer_code= ($order_data[0]['offer_code']!='') ? strtoupper($order_data[0]['offer_code']) : 'NA';

				$payment_mode = $order_data[0]['payment_method'];

				$item_in_cart = '';
				$order_details = $this->model->getData('order_data_details',array('order_id'=>$order_id));
				if(isset($order_details) && !empty($order_details)){
					foreach ($order_details as $key => $value) {
						$product_details = $this->model->getData('product',array('product_id'=>$value['product_id']));
						$unit_data = $this->model->getData('product_unit',array('unit_id'=>$product_details[0]['unit_id']));

						$exact_qty = gram_to_kg($product_details[0]['unit_id'],$value['qty']);
						$p_unit = (isset($unit_data) && !empty($unit_data)) ?  strtolower($unit_data[0]['abbrivation']) : '';

						$item_in_cart.='<tr ><td style="padding: 5px 0px;">'.++$key.'</td><td>'.$product_details[0]['product_name'].'</td><td>'.$exact_qty.'</td><td>'.$p_unit.'</td>
							<td align="right">'.upto2Decimal($value['price']).'</td><td align="right">'.upto2Decimal($value['unit_total']).'</td></tr>';
					}
				}
				

				$subject = 'Your DirectFarm.in Order #'.$order_number;
				$emailer = 'emailer/order_confirmation.html';
				$mail_content = file_get_contents($emailer);

				$mail_content = str_replace('@_user_name_@', $user_name, $mail_content);
				$mail_content = str_replace('@_order_number_@', $order_number, $mail_content);
				
				$mail_content = str_replace('@_total_amount_@', $total_amount, $mail_content);
				$mail_content = str_replace('@_shipping_address_@', $shipping_address, $mail_content);
				$mail_content = str_replace('@_item_in_cart_@', $item_in_cart, $mail_content);

				$mail_content = str_replace('@_order_received_by_date_@', $user_expec_received_by_date, $mail_content);
				$mail_content = str_replace('@_order_received_by_time_@', $user_expec_received_by_time, $mail_content);

				
				$mail_content = str_replace('@_discounted_AMT_@', $discounted_amount, $mail_content);

				$mail_content = str_replace('@_del_charges_@', $del_charges, $mail_content);
				$mail_content = str_replace('@_payable_amount_@', $payable_amount, $mail_content);
				$mail_content = str_replace('@_offer_code_@', $offer_code, $mail_content);

				$mail_content = str_replace('@_payment_mode_@', $payment_mode, $mail_content);
				
											
				$headers = 'From: DirectFarm <myorder@directfarm.in>' . "\r\n" .
							'Cc: myorder@directfarm.in,arvind.prajapati20@gmail.com,lalit.prajapati@microlan.in,sachin.godage@microlan.in,ajay.choudhary@microlan.in' . "\r\n" .
				    		'Reply-To: myorder@directfarm.in' . "\r\n" .
				    		"MIME-Version: 1.0\r\n".
							"Content-Type: text/html; charset=ISO-8859-1\r\n";
							'X-Mailer: PHP/';

				mail($to_email_address, $subject, $mail_content, $headers);
			}
		}
	}

	function validate_offer_code(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['account'];

        $user_id = $this->session->userdata('user_id');
        if($user_id>0){
	        if(isset($array_entity) && !empty($array_entity)){
	            $user_data = $this->model->getData('user',array('user_id'=>$user_id));
	            $mobile_number = $user_data[0]['mobile_number'];

	            $session_id = $this->session->userdata('session_id');
	            $offer_code = trim($array_entity['offer_code']);

	            if($mobile_number!=''){
	            
		            $strSql = "SELECT * FROM offer_master WHERE offer_name='".$offer_code."' AND status='1' AND to_date>='".date('Y-m-d')."'";
		            $offer_data =$this->model->getSqlData($strSql);
		            if(isset($offer_data) && !empty($offer_data)){

		                $on_first_order_only = $offer_data[0]['on_first_order_only'];
		                $org_id = $offer_data[0]['org_id'];
		                $nos_of_uses = $offer_data[0]['nos_of_uses'];
		                $offer_type = $offer_data[0]['offer_type'];
		                $offer_amount = $offer_data[0]['offer_amount'];
		                $min_amount_purchase = $offer_data[0]['min_amount_purchase'];
		                $offer_category = $offer_data[0]['offer_category'];

		                $total_offer_used = $this->model->CountWhereRecord('order_data',array('offer_code'=>$offer_code));
		                $has_offer_limit_exceed = '0';
		                if($nos_of_uses>0){
		                    if($nos_of_uses<=$total_offer_used){
		                        $has_offer_limit_exceed = '1';
		                    }
		                }    

		                $is_first_order_applicable = '0';
		                if($on_first_order_only=='1'){
		                    $strSql = "SELECT u.user_id, u.mobile_number, od.* FROM user u, order_data od WHERE od.user_id= u.user_id AND u.mobile_number='".$mobile_number."'";
		                    $user_order_data = $this->model->getSqlData($strSql);
		                    // has user applicable for this offer
		                    if(isset($user_order_data) && !empty($user_order_data)){
		                        $is_first_order_applicable = '1';
		                    }else{
		                        $is_first_order_applicable = '0';
		                    }
		                }

		                if($has_offer_limit_exceed=="0"){
		                    if($is_first_order_applicable=='0'){
		                        //check cart total item
		                        $product_category = array();
		                        $cat_total_amount = ''; $dif_amt = '';
		                        if($offer_category!=""){

		                            $order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM cart WHERE session_id="'.$session_id.'"');
		                            $total_amount = $order_data[0]['total'];

		                            $strSql = "SELECT sum(co.unit_total) as total FROM product p, cart co
		                                       WHERE co.product_id = p.product_id AND co.session_id='".$session_id."' AND p.category_id IN(".$offer_category.")";
		                            $order_data = $this->model->getSqlData($strSql);
		                            $cat_total_amount = $order_data[0]['total']; 

		                            $dif_amt = $total_amount-$cat_total_amount;

		                            $product_category = array();
		                            $ofr_cat = explode(',', $offer_category); 
		                            foreach ($ofr_cat as $ofr_key=>$ofr_value){
		                                $cat_data = $this->model->getData('category',array('category_id'=>$ofr_value));
		                                array_push($product_category, $cat_data[0]['category_name']);
		                            }
		                            $category_p_name = implode(',', $product_category);

		                        }else{
		                            $order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM cart WHERE session_id="'.$session_id.'"');
		                            $total_amount = $order_data[0]['total'];
		                        }

		                        if($total_amount>0){
		                            // check if category based offer
		                            if($cat_total_amount>0){

		                            	 //check offer minimum amount
		                                if($total_amount>=$min_amount_purchase){
		                                	if($cat_total_amount<$min_amount_purchase){
		                                		$data['status'] = '0';
		                                		$data['msg'] = 'This is category based offer, minimum amount should be Rs. '.$min_amount_purchase.", You category total is Rs. ".$total_amount.". (".$category_p_name.")";
		                                	}else{
			                                    $disc_amount = '0';
			                                    if($offer_type=='1'){ //off percentage amount from total bill
			                                        $disc_amount = round((($total_amount*$offer_amount)/100),2);
			                                        $disc_amount = $total_amount-$disc_amount;
			                                    }else if($offer_type=='2'){ //off amount from total amount
			                                        $disc_amount = round(($total_amount-$offer_amount),2);
			                                    }else if($offer_type=='3'){ //send amount in cash wallet
			                                        $disc_amount = round(($total_amount-$offer_amount),2);
			                                    }

			                                    $data['discounted_amount'] = $total_amount-$disc_amount; 
			                                    $data['total_discounted_amount'] = $disc_amount;

			                                    $data['status'] = '1';
			                                    $data['msg'] = 'Valid coupon code. '.$cat_total_amount;
			                                }

		                                }else{
		                                    $data['status'] = '0';
		                                    if($offer_category!=""){
		                                        $data['msg'] = 'This is category based offer, minimum amount should be Rs. '.$min_amount_purchase.", Your category total is Rs. ".$total_amount.". (".$category_p_name.")";
		                                    }else{
		                                        $data['msg'] = 'To Avail this offer, min billed amt should be Rs. '.$min_amount_purchase;
		                                    }
		                                }
			                           
		                            }else{
		                            	
		                                if($cat_total_amount>=$min_amount_purchase){
		                                    $disc_amount = '0';
		                                    if($offer_type=='1'){ //off percentage amount from total bill
		                                        $disc_amount = round((($cat_total_amount*$offer_amount)/100),2);
		                                        $disc_amount = $cat_total_amount-$disc_amount;
		                                    }else if($offer_type=='2'){ //off amount from total amount
		                                        $disc_amount = round(($cat_total_amount-$offer_amount),2);
		                                    }else if($offer_type=='3'){ //send amount in cash wallet
		                                        $disc_amount = round(($cat_total_amount-$offer_amount),2);
		                                    }

		                                    $data['discounted_amount'] = $cat_total_amount-$disc_amount; 
		                                    $data['total_discounted_amount'] = $disc_amount+$dif_amt;

		                                    $data['status'] = '1';
		                                    $data['msg'] = 'Valid coupon code.';
		                                }else{
		                                    $data['status'] = '0';
		                                    if($offer_category!=""){
		                                        $data['msg'] = 'This is category based offer, minimum amount should be Rs. '.$min_amount_purchase.", Your category total is Rs. ".$cat_total_amount.". (".$category_p_name.")";
		                                    }else{
		                                        $data['msg'] = 'To Avail this offer, min billed amt should be Rs. '.$min_amount_purchase;
		                                    }
		                                }			                               

		                            }
		                        }else{
		                            $data['status'] = '0';
		                            $data['msg'] = 'Cart is empty. Please add some product to the cart.';
		                        }
		                    }else{
		                        $data['status'] = '0';
		                        $data['msg'] = 'The Offer is valid for first order only.';    
		                    }
		                }else{
		                    $data['status'] = '0';
		                    $data['msg'] = 'Offer limit has been reached.';    
		                }
		            }else{
		                $data['status'] = '0';
		                $data['msg'] = 'Invalid offer code is entered.';    
		            }
		        }else{
		        	$data['status'] = '0';
	        		$data['msg'] = 'In order to avail the benefits of this promotional / voucher / offer code, please update your monile number';
		        }
	        }else{
	            $data['status'] = '0';
	            $data['msg'] = 'Invalid offer code.';
	        }
	    }else{
	    	$data['status'] = '0';
	        $data['msg'] = 'In order to avail the benefits of this promotional / voucher / offer code, please Login/Sign Up';
	    }
        echo json_encode($data);
    }


    function start_txn(){
		$session_id = $this->session->userdata('session_id');
		$txn_code = $this->input->get_post('txn_code');
		if($session_id!=""){
			$order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM cart WHERE session_id="'.$session_id.'"');
			$total_amount = $order_data[0]['total'];
			if($total_amount>0){

				$user_id = $this->session->userdata('user_id');
				$user_data = $this->model->getData('user',array('user_id'=>$user_id));

				$deliver_address = $this->input->get_post('deliver_address');
				$delivery_date = $this->input->get_post('delivery_date');
				$delivery_time = $this->input->get_post('delivery_time');
				$order_id = $this->input->get_post('order_id');

				$discounted_amount = $this->input->get_post('discounted_amount');

				$data['amount'] = $total_amount;
				$data['firstname'] = $user_data[0]['full_name'];
				$data['email'] = $user_data[0]['email_address'];
				$data['phone'] = $user_data[0]['mobile_number'];
				$data['txn_code'] = $txn_code;

				$txn_id = 'DF'.$order_id;
				$data['txnid'] = $txn_id;

				$txn_array=array(
					'user_id'=>$user_id,
					'address_id'=>$deliver_address,
					'txn_id'=>$txn_id,
					'del_date'=> date('Y-m-d',strtotime($delivery_date)),
					'del_time'=>$delivery_time,
					'discounted_amount'=>$discounted_amount,
					'amount'=>$total_amount,
					'offer_code'=>$txn_code,
					'session_id'=>$session_id,
					'status'=>'0',
				);

				$txn_order_data = $this->model->getData('online_txn_data',array('txn_id'=>$txn_id));
				//print_array($txn_order_data);

				//check if already txn id is exist
				if(isset($txn_order_data) && empty($txn_order_data)){
					$this->model->insertData('online_txn_data',$txn_array);
				}

				//update total amount for online transaction
				$delivery_charges = ($total_amount<100) ? '20' : '00';
				$total_final_amt = ($total_amount-$discounted_amount)+$delivery_charges;

				$data['amount'] = $total_final_amt;

				$this->load->view('payment/start_txn',$data);

			}else{
				$this->failure_txn("Your cart is empty. Please add some product to your cart");	
			}
		}else{
			$this->failure_txn("Your session has been expired. For online order, Please refresh the page, do Login In/ Sign Up.");
		}
	}

	function success_txn($msg=""){
		$session_id = $this->session->userdata('session_id');
		$cart_item =$this->model->getData('cart',array('session_id'=>$session_id));

		$status= isset($_POST["status"]) ? $_POST['status']: '' ;

		//print_array($_POST);

		if($status=='success' && isset($cart_item) && !empty($cart_item)){

	        $firstname=$_POST["firstname"];
	        $amount=$_POST["amount"];
	        $txnid=$_POST["txnid"];
	        $posted_hash=$_POST["hash"];
	        $key=$_POST["key"];
	        $productinfo=$_POST["productinfo"];
	        $email=$_POST["email"];
	        $salt="GY6xzQZBfM";
	        if(isset($_POST["additionalCharges"])) {
	            $additionalCharges=$_POST["additionalCharges"];
	            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	        } else {	  
	            $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	        }

	        $hash = hash("sha512", $retHashSeq);
	        if ($hash == $posted_hash) {

	        	$net_amount_debit = $_POST['net_amount_debit'];
	        	$txnid = $_POST['txnid'];
	        	
	        	$this->model->updateData('online_txn_data',array('status'=>$status,'txn_data'=>json_encode($_POST)),array('txn_id'=>$session_id));
	        	$txn_data = $this->model->getData('online_txn_data',array('txn_id' => $txnid));

	        	$user_id = $txn_data[0]['user_id'];
	        	$address_id = $txn_data[0]['address_id'];
	        	$delivery_date = date('Y-m-d',strtotime($txn_data[0]['del_date']));
	        	$delivery_time = $txn_data[0]['del_time'];
	        	$offer_code = $txn_data[0]['offer_code'];
	        	$discounted_amount = $txn_data[0]['discounted_amount'];

	        	$user_data = $this->model->getData('user',array('user_id'=>$user_id));
	        	$mobile_number = $user_data[0]['mobile_number'];

        		$total_amount = $this->model->getSqlData("SELECT SUM(unit_total) AS Total FROM cart WHERE session_id='".$session_id."'");

        		if(isset($cart_item) && !empty($cart_item)){
        			$orderNo = $txnid;

        			$delivery_charges = ($total_amount[0]['Total']<100) ? '20' : '00';
					

        			$order_data = array(
        				'user_id'=>$user_id,
        				'payment_method'=>'NETBANKING',
        				'address_id'=>$address_id,
        				'user_expected_order_date'=>$delivery_date,
        				'user_expected_order_time_slot'=>$delivery_time,
        				'offer_code'=>$offer_code,
        				'discounted_amount'=>$discounted_amount,
        				'order_number'=>$orderNo,
        				'total_amount'=>$total_amount[0]['Total'],
        				'after_discounted_amount'=>$total_amount[0]['Total'],
        				'delivery_charges'=>$delivery_charges,
                        'order_date_time'=>date('Y-m-d H:i:s'),
        			);
        			$order_id = $this->model->insertData('order_data',$order_data);

        			foreach ($cart_item as $key => $value) {
        				$array_cart_item=array(
        					'user_id'=>$user_id,
        					'order_id'=>$order_id,
        					'order_number'=>$orderNo,
        					'product_id'=>$value['product_id'],
        					'qty'=>$value['qty'],
        					'price'=>$value['price'],
        					'unit_total'=>$value['unit_total'],
        				);
        				$this->model->insertData('order_data_details',$array_cart_item);
        				//Minus product qty from stock master
                        $stock_item_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id']));
                        if(isset($stock_item_data) && !empty($stock_item_data)){
                            $stock_qty = $stock_item_data[0]['stock_qty']-$value['qty'];
                            $this->model->updateData('stock_master',array('stock_qty'=>$stock_qty),array('stock_id'=>$stock_item_data[0]['stock_id']));
                        }
        			}

        			/*OFFER MANAGEMENT*/
        			if($offer_code!="" && $mobile_number!=""){
	                    $offer_data = $this->model->getData('offer_master', array('offer_name' => $offer_code));
	                    $offer_type = '';
	                    if(isset($offer_data) && !empty($offer_data)){
	                        $offer_type = $offer_data[0]['offer_type'];
	                    }
	                    $offer_cart_item = $this->apply_offer_code($offer_code,$mobile_number);
	                    $order_offer_data = json_decode($offer_cart_item,true);
	                    if(isset($order_offer_data) && !empty($order_offer_data)){
	                     	$discount_amount =  $order_offer_data['discounted_amount'];
	                                        
		                    if($discount_amount>0 && $offer_code!=""){ //&& $offer_type=='3'
		                        $txn_no  = generateRandomString();
		                        $wallet_array = array(
		                            'txn_no'=>$txn_no,
		                            'user_id'=>$user_id,
		                            'offer_code'=>$offer_code,
		                            'order_number'=>$orderNo,
		                            'wallet_amount'=>$discount_amount,
		                            'date'=>date('Y-m-d'),
		                            'txn_type'=>'1',//credit-aaya
		                        );

		                        $this->model->insertData('wallet_txn',$wallet_array);
		                        $total_wallet_balance = $this->wallet_balance($user_id);
		                        $this->model->updateData('user',array('wallet_balance'=>$total_wallet_balance),array('user_id'=>$user_id));
		                        /*Wallet balance update complete*/
		                    }
	                	}
	               	}
                    /*OFFER MANAGEMENT*/

        			$this->send_order_confirmation_mail($order_id,$txn_data[0]['address_id']);
        			$this->sms_order_confirmation_to_user($order_id,$mobile_number,$user_data[0]['full_name']);
        			$this->sms_order_confirmation_to_admin($order_id,'9029921216',$user_data[0]['full_name']);
        			
        			/*$data['status'] = 1;
        			$data['msg'] = 'Your order has been placed successfully. Your order no is: '.$orderNo;*/

        			$this->model->deleteData('cart',array('session_id'=>$session_id));
	        	}

	        	$data['status'] = $status;
				$data['txnid'] = $txnid;
				$data['amount'] = $amount;

	        	$data['msg'] = $msg; 
				$data['main_content']='payment/success_txn';
				$this->load->view('includes/template',$data);
	        }else{
        		$this->failure_txn("Invalid Transaction details. Please try again");
	        }
        }else{
        	$this->failure_txn("Invalid Transaction. Please try again");
        }
	}


    function wallet_balance($user_id=''){
        //calculate user's wallet amount and update it
        $str_debit = "SELECT SUM(wallet_amount) as debit_total FROM wallet_txn WHERE status='1' AND txn_type='2' AND user_id='".$user_id."'";
        $debit_data = $this->model->getSqlData($str_debit);
        $debit_total = (isset($debit_data) && !empty($debit_data)) ? $debit_data[0]['debit_total'] : '0';

        $str_credit = "SELECT SUM(wallet_amount) as credit_total FROM wallet_txn WHERE status='1' AND txn_type='1' AND user_id='".$user_id."'";
        $credit_data = $this->model->getSqlData($str_credit);
        $credit_total = (isset($credit_data) && !empty($credit_data)) ? $credit_data[0]['credit_total'] : '0';

        $total_wallet_balance = $credit_total-$debit_total;
        return $total_wallet_balance;
    }

	function apply_offer_code($offer_code="",$mobile_number=""){
        
        if($offer_code!="" && $mobile_number!=""){
                        
            $session_id = $this->session->userdata('session_id');
            $strSql = "SELECT * FROM offer_master WHERE offer_name='".$offer_code."' AND status='1' AND to_date>='".date('Y-m-d')."'";
            $offer_data =$this->model->getSqlData($strSql);
            if(isset($offer_data) && !empty($offer_data)){

                $on_first_order_only = $offer_data[0]['on_first_order_only'];
                $org_id = $offer_data[0]['org_id'];
                $nos_of_uses = $offer_data[0]['nos_of_uses'];
                $offer_type = $offer_data[0]['offer_type'];
                $offer_amount = $offer_data[0]['offer_amount'];
                $min_amount_purchase = $offer_data[0]['min_amount_purchase'];
                $offer_category = $offer_data[0]['offer_category'];               

                $total_offer_used = $this->model->CountWhereRecord('order_data',array('offer_code'=>$offer_code));
                $has_offer_limit_exceed = '0';
                if($nos_of_uses>0){
                    if($nos_of_uses<=$total_offer_used){
                        $has_offer_limit_exceed = '1';
                    }
                }    

                $is_first_order_applicable = '0';
                if($on_first_order_only=='1'){
                    $strSql = "SELECT u.user_id, u.mobile_number, od.* FROM user u, order_data od WHERE od.user_id= u.user_id AND u.mobile_number='".$mobile_number."'";
                    $user_order_data = $this->model->getSqlData($strSql);
                    // has user applicable for this offer
                    if(isset($user_order_data) && !empty($user_order_data)){
                        $is_first_order_applicable = '1';
                    }else{
                        $is_first_order_applicable = '0';
                    }
                }

                if($has_offer_limit_exceed==0){
                    if($is_first_order_applicable=='0'){
                        //check cart total item
                        $product_category = array();
                        $cat_total_amount = ''; $dif_amt = '';
                        if($offer_category!=""){

                            $order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM cart WHERE session_id="'.$session_id.'"');
                            $total_amount = $order_data[0]['total'];

                            $strSql = "SELECT sum(co.unit_total) as total FROM product p, cart co
                                       WHERE co.product_id = p.product_id AND co.session_id='".$session_id."' AND p.category_id IN(".$offer_category.")";
                            $order_data = $this->model->getSqlData($strSql);
                            $cat_total_amount = $order_data[0]['total'];

                            $dif_amt = $total_amount-$cat_total_amount;

                            $product_category = array();
                            $ofr_cat = explode(',', $offer_category); 
                            foreach ($ofr_cat as $ofr_key=>$ofr_value){
                                $cat_data = $this->model->getData('category',array('category_id'=>$ofr_value));
                                array_push($product_category, $cat_data[0]['category_name']);
                            }
                            $category_p_name = implode(',', $product_category);

                        }else{
                            $order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM cart WHERE session_id="'.$session_id.'"');
                            $total_amount = $order_data[0]['total'];
                        }

                        if($total_amount>0){
                            // check if category based offer
                            if($cat_total_amount!=""){
                                if($cat_total_amount>=$min_amount_purchase){
                                    $disc_amount = '0';
                                    if($offer_type=='1'){ //off percentage amount from total bill
                                        $disc_amount = round((($cat_total_amount*$offer_amount)/100),2);
                                        $disc_amount = $cat_total_amount-$disc_amount;
                                    }else if($offer_type=='2'){ //off amount from total amount
                                        $disc_amount = round(($cat_total_amount-$offer_amount),2);
                                    }else if($offer_type=='3'){ //send amount in cash wallet
                                        $disc_amount = round(($cat_total_amount-$offer_amount),2);
                                    }

                                    $data['discounted_amount'] = $cat_total_amount-$disc_amount; 
                                    $data['total_discounted_amount'] = $disc_amount+$dif_amt;

                                    $data['status'] = '1';
                                    $data['msg'] = 'Valid coupon code.';
                                }else{
                                    $data['status'] = '0';
                                    if($offer_category!=""){
                                        $data['msg'] = 'This is category based offer, minimum amount should be Rs. '.$min_amount_purchase.", You category total is Rs. ".$cat_total_amount.". (".$category_p_name.")";
                                    }else{
                                        $data['msg'] = 'To Avail this offer, min billed amt should be Rs. '.$min_amount_purchase;
                                    }
                                }

                            }else{
                                //check offer minimum amount
                                if($total_amount>=$min_amount_purchase){
                                    $disc_amount = '0';
                                    if($offer_type=='1'){ //off percentage amount from total bill
                                        $disc_amount = round((($total_amount*$offer_amount)/100),2);
                                        $disc_amount = $total_amount-$disc_amount;
                                    }else if($offer_type=='2'){ //off amount from total amount
                                        $disc_amount = round(($total_amount-$offer_amount),2);
                                    }else if($offer_type=='3'){ //send amount in cash wallet
                                        $disc_amount = round(($total_amount-$offer_amount),2);
                                    }

                                    $data['discounted_amount'] = $total_amount-$disc_amount; 
                                    $data['total_discounted_amount'] = $disc_amount;

                                    $data['status'] = '1';
                                    $data['msg'] = 'Valid coupon code.';
                                }else{
                                    $data['status'] = '0';
                                    if($offer_category!=""){
                                        $data['msg'] = 'This is category based offer, minimum amount should be Rs. '.$min_amount_purchase.", Your category total is Rs. ".$total_amount.". (".$category_p_name.")";
                                    }else{
                                        $data['msg'] = 'To Avail this offer, min billed amt should be Rs. '.$min_amount_purchase;
                                    }
                                }
                            }
                        }else{
                            $data['status'] = '0';
                            $data['msg'] = 'Cart is empty. Please add some product to the cart.';
                        }
                    }else{
                        $data['status'] = '0';
                        $data['msg'] = 'The Offer is valid for first order only.';    
                    }
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Offer limit has been reached.';    
                }
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid offer code is entered.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid offer code / mobile number entered.';
        }
        return json_encode($data);
    }

	function failure_txn($msg=""){
		$data['msg'] = $msg;
		$data['main_content']='payment/txn_failed';
		$this->load->view('includes/template',$data);
	}

	function cancelled_txn(){

		$status= isset($_POST["status"]) ? $_POST["status"] : ''; 
		
		if($status=='failure'){
	        $firstname=$_POST["firstname"];
	        $amount=$_POST["amount"];
	        $txnid=$_POST["txnid"];
	        $posted_hash=$_POST["hash"];
	        $key=$_POST["key"];
	        $productinfo=$_POST["productinfo"];
	        $email=$_POST["email"];
	        $salt="GY6xzQZBfM";
	        if(isset($_POST["additionalCharges"])) {
	            $additionalCharges=$_POST["additionalCharges"];
	            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	        } else {	  
	            $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	        }

	        $hash = hash("sha512", $retHashSeq);
	        if ($hash == $posted_hash) {

	        	$txnid = $_POST['txnid'];
	        	$this->model->updateData('online_txn_data',array('status'=>$status,'txn_data'=>json_encode($_POST)),array('txn_id'=>$txnid));

	        	$data['status'] = $status;
				$data['txnid'] = $txnid;
				$data['amount'] = $amount;
	        	
				$data['main_content']='payment/cancelled_txn';
				$this->load->view('includes/template',$data);
			}else{
				$this->failure_txn("Invalid Transaction, cancelled. Please try again");
			}
		}else{
			$this->failure_txn("Invalid Transaction cancelled. Please try again");
		}
	}

	function product_qty_dropdown(){
		echo $this->input->get_post('unit_id');
	}


/*End of Controller*/
}