<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {

	function __construct(){
      	parent::__construct();
	  	$this->no_cache();
	  	
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

	  	if(!$this->is_logged_in()){ 
  			redirect('account/my_account');
  		}
  	}
	
	   /** Clear the old cache (usage optional) **/
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

	function index(){
		$data['profile_data'] = $this->model->getData('user',array('user_id'=>$this->session->userdata('user_id')));
		$data['main_content']='profile/myprofile';
		$this->load->view('includes/template',$data);
	}

	function myaddress(){
		$data['address_data'] = $this->model->getData('user_addresses',array('user_id'=>$this->session->userdata('user_id'),'status'=>'1'));
		$data['main_content']='profile/myaddress';
		$this->load->view('includes/template',$data);
	}

	function add_new_address(){
		$data['main_content']='profile/add_new_address';
		$this->load->view('includes/template',$data);
	}

	function edit_address(){
		$address_id = $this->input->get_post('address_id');
		$address_data = $this->model->getData('user_addresses',array('user_id'=>$this->session->userdata('user_id'),'address_id'=>$address_id));
		$data['address_data'] = $address_data;
		$data['main_content']='profile/edit_address';
		$this->load->view('includes/template',$data);
	}

	function update_personal_information(){
		$jsonObj = $_POST['jsonObj'];       
		$user_object = json_decode($jsonObj,true); 
		$user_data = $user_object['FormData'];

		if(isset($user_data) && !empty($user_data)){
			$user_id = $this->session->userdata('user_id');

			if($user_id!=""){
				$update_data = array(
					'full_name'=>$user_data['full_name'],
					'password'=>md5($user_data['new_password']),
					'gender'=>$user_data['gender'],
				);
				$this->model->updateData('user',$update_data,array('user_id'=>$user_id));
				$data['status'] = '1';
				$data['msg'] = "Your personal information has been updated successfully.";
			}else{
				$data['status'] = '0';
				$data['msg'] = "Your session has been expired. Please login again.";
			}
			
		}else{
			$data['status'] = '0';
			$data['msg'] = "Somthing went wrong while updating your information. Please try after sometime.";
		}
		echo json_encode($data);
	}

	function delete_my_address(){
		$jsonObj = $_POST['jsonObj'];       
		$user_object = json_decode($jsonObj,true); 
		$user_data = $user_object['FormData'];

		$address_id = $user_data['address_id'];
		if($address_id!=""){
			$user_id = $this->session->userdata('user_id');
			if($user_id!=""){
				$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_id,'address_id'=>$address_id));
				if(isset($address_data) && !empty($address_data)){
					$this->model->updateData('user_addresses',array('status'=>'0'),array('address_id'=>$address_id));
					$data['status'] = '1';
					$data['msg'] = "Address has been deleted successfully.";
				}else{
					$data['status'] = '0';
					$data['msg'] = "Invalid address.";
				}
			}else{
				$data['status'] = '0';
				$data['msg'] = "Your session has been expired. Please login again.";	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = "Invalid address";
		}
		echo json_encode($data);
	}

	function myorders(){
		$data['order_data'] = $this->model->getDataOrderBy('order_data',array('user_id'=>$this->session->userdata('user_id')),'order_date_time','desc');
		$data['main_content']='profile/myorders';
		$this->load->view('includes/template',$data);
	}

	function cancel_order(){
		$jsonObj = $_POST['jsonObj'];       
		$user_object = json_decode($jsonObj,true); 
		$user_data = $user_object['product'];

		$order_number = $user_data['order_number'];
		if($order_number!=""){
			$order_data = $this->model->getData('order_data',array('order_number'=>$order_number,'status'=>'1','user_id'=>$this->session->userdata('user_id')));
			//1: order is in packaging mode
			if(isset($order_data) && !empty($order_data)){
				$this->model->updateData('order_data',array('status'=>'0','cancelled_at'=>date('Y-m-d H:i:s')),array('order_id'=>$order_data[0]['order_id']));
				$data['status'] = '1';
				$data['msg'] = 'Your order #'.$order_number.' has been cancelled.';
				//$this->send_order_cancellation_mail($order_number);
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Your order can not be cancelled. Please contact to customer care.';	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Order number is missing';
		}
		echo json_encode($data);
	}

	function send_order_cancellation_mail($order_number){
		if($order_number!=''){
			$order_data = $this->model->getData('order_data',array('order_number'=>$order_number));
			if(isset($order_data) && !empty($order_data)){

				$user_data = $this->model->getData('user',array('user_id'=>$order_data[0]['user_id']));
				$to_email_address = $user_data[0]['email_address'];
				$user_name =  $user_data[0]['full_name'];
				$order_number = $order_data[0]['order_number'];
				$user_expec_received_by_date = $order_data[0]['user_expected_order_date'];
				$user_expec_received_by_time = $order_data[0]['user_expected_order_time_slot'];

				$total_amount =  upto2Decimal($order_data[0]['total_amount']); 
				$discounted_amount =  upto2Decimal($order_data[0]['discounted_amount']);
				$del_charges= upto2Decimal($order_data[0]['delivery_charges']);

				$payable_amount= upto2Decimal(($total_amount - $discounted_amount) + $del_charges);

				$offer_code= ($order_data[0]['offer_code']!='') ? strtoupper($order_data[0]['offer_code']) : 'NA';

				$item_in_cart = '';
				$order_details = $this->model->getData('order_data_details',array('order_id'=>$order_number));
				if(isset($order_details) && !empty($order_details)){
					foreach ($order_details as $key => $value) {
						$product_details = $this->model->getData('product',array('product_id'=>$value['product_id']));
						$unit_data = $this->model->getData('product_unit',array('unit_id'=>$product_details[0]['unit_id']));

						$exact_qty = gram_to_kg($product_details[0]['unit_id'],$value['qty']);
						$p_unit = (isset($unit_data) && !empty($unit_data)) ?  strtolower($unit_data[0]['abbrivation']) : '';

						$item_in_cart.='<tr ><td style="padding: 5px 0px;">'.++$key.'</td><td>'.$product_details[0]['product_name'].'</td><td>'.$exact_qty.'</td><td>'.$p_unit.'</td>
						<td align="right">'.$value['price'].'</td><td align="right">'.$value['unit_total'].'</td></tr>';
					}
				}
				
							
				$subject = 'Cancellation of your Order #'.$order_number.' on DirectFarm.in';
				$emailer = 'emailer/order_cancellation.html';
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

							
				$headers = 'From: DirectFarm <orders@directfarm.in>' . "\r\n" .
				    		'Reply-To: orders@directfarm.in' . "\r\n" .
				    		"MIME-Version: 1.0\r\n".
							"Content-Type: text/html; charset=ISO-8859-1\r\n";
							'X-Mailer: PHP/';

				mail($to_email_address, $subject, $mail_content, $headers);
			}
		}
	}

	function get_address_for_edit(){
		$jsonObj = $_POST['jsonObj'];       
		$user_object = json_decode($jsonObj,true); 
		$user_data = $user_object['product'];

		$address_id = $user_data['address_id'];
		if($address_id!=""){
			$address_data = $this->model->getData('user_addresses',array('address_id'=>$address_id,'user_id'=>$this->session->userdata('user_id')));
			if(isset($address_data) && !empty($address_data)){
				$data['status'] = '1';
				$data['msg'] = json_encode($address_data);
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Invalid address';
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invalid address';
		}
		echo json_encode($data);
	}

	function change_password(){
		$data['main_content']='profile/change_password';
		$this->load->view('includes/template',$data);
	}

	function update_change_password(){
		$jsonObj = $_POST['jsonObj'];       
		$user_object = json_decode($jsonObj,true); 
		$user_entity = $user_object['data'];
		
		if(isset($user_entity) && !empty($user_entity)){
			$user_id = $this->session->userdata('user_id');
			if(isset($user_id) && $user_id>0){
				$old_password = $user_entity['old_password'];
				$new_password = $user_entity['confirm_new_password'];
				$user_data = $this->model->getData('user',array('user_id'=>$user_id,'password'=>md5($old_password)));
				if(isset($user_data) && !empty($user_data)){
					$this->model->updateData('user',array('password'=>md5($new_password)),array('user_id'=>$user_id));
					$data['status'] = '1';
					$data['msg'] = 'Password has been changed successfully';
				}else{
					$data['status'] = '0';
					$data['msg'] = 'Invalid old password entered.';		
				}
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Invalid user data sent.';	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invalid data.';
		}
		echo json_encode($data);
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

    function mywallet(){
    	$data['w_balance'] = $this->model->wallet_balance($this->session->userdata('user_id'));
    	$data['wallet_data'] = $this->model->getDataOrderBy('wallet_txn',array('user_id' =>$this->session->userdata('user_id')),'updated_on','DESC');
		$data['main_content']='profile/mywallet';
		$this->load->view('includes/template',$data);
    }
    	
    function add_money(){
    	$data['main_content']='profile/add_money';
		$this->load->view('includes/template',$data);
    }

    function add_money_txn_start(){
    	$total_amount = $this->input->get_post('amount_add');
    	
    	if($total_amount>0){
			$user_id = $this->session->userdata('user_id');
			$user_data = $this->model->getData('user',array('user_id'=>$user_id));
			$session_id = $this->session->userdata('session_id');

			$data['amount'] = $total_amount;
			$data['firstname'] = $user_data[0]['full_name'];
			$data['email'] = $user_data[0]['email_address'];
			$data['phone'] = $user_data[0]['mobile_number'];

			$txn_code = 'MONEY_ADDED_TO_WALLET';
			$data['txn_code'] = $txn_code;

			$txn_id = generateRandomString(6);
			$data['txnid'] = $txn_id;

			$txn_array=array(
				'user_id'=>$user_id,
				'txn_id'=>$txn_id,
				'del_date'=> date('Y-m-d'),
				'del_time'=> date('H:i:s'),
				'amount'=>$total_amount,
				'offer_code'=>$txn_code,
				'session_id'=>$session_id,
				'status'=>'0',
			);
			$txn_order_data = $this->model->getData('online_txn_data',array('txn_id'=>$txn_id));
			//print_array($txn_order_data);
			if(isset($txn_order_data) && empty($txn_order_data)){
				$this->model->insertData('online_txn_data',$txn_array);
			}
			$this->load->view('profile/add_money_txn_start',$data);
		}else{
			$this->failure_txn("Your cart is empty. Please add some product to your cart");	
		}
    }

    function failure_txn($msg=""){
		$data['msg'] = $msg;
		$data['main_content']='payment/txn_failed';
		$this->load->view('includes/template',$data);
	}

    function success_txn($msg=""){
    	$session_id = $this->session->userdata('session_id');
		$status= isset($_POST["status"]) ? $_POST['status']: '' ;
		if($status=='success'){

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
	        	
	        	$has_txn_updated = $this->model->getData('online_txn_data',array('txn_id' => $txnid,'status'=>'0'));

	        	if(isset($has_txn_updated) && !empty($has_txn_updated)){
	        		//update the txn_table
		        	$this->model->updateData('online_txn_data',array('status'=>$status,'txn_data'=>json_encode($_POST)),array('txn_id'=>$txnid));
		        	
		        	$txn_data = $this->model->getData('online_txn_data',array('txn_id' => $txnid));

		        	$user_id = $txn_data[0]['user_id'];
		        	$address_id = $txn_data[0]['address_id'];
		        	$delivery_date = date('Y-m-d',strtotime($txn_data[0]['del_date']));
		        	$delivery_time = date('Y-m-d',strtotime($txn_data[0]['del_time']));
		        	$offer_code = $txn_data[0]['offer_code'];

		        	$user_data = $this->model->getData('user',array('user_id'=>$user_id));
		        	$mobile_number = $user_data[0]['mobile_number'];

	                $txn_no  = generateRandomString();
	                $wallet_array = array(
	                    'txn_no'=>$txn_no,
	                    'user_id'=>$user_id,
	                    'offer_code'=>$offer_code,
	                    'wallet_amount'=>$amount,
	                    'date'=>date('Y-m-d'),
	                    'txn_type'=>'1',//credit-aaya
	                );

	                $this->model->insertData('wallet_txn',$wallet_array);

	                $total_wallet_balance = $this->wallet_balance($user_id);
	                $this->model->updateData('user',array('wallet_balance'=>$total_wallet_balance),array('user_id'=>$user_id));
	                /*Wallet balance update complete*/
	                if($mobile_number>0 && $mobile_number!=""){
	    				$this->send_sms_amount_added_to_wallet($amount,$mobile_number,$user_data[0]['full_name']);
	    			}

		        	$data['status'] = $status;
					$data['txnid'] = $txnid;
					$data['amount'] = $amount;

		        	$data['msg'] = $msg; 
					$data['main_content']='profile/add_money_txn_success';
					$this->load->view('includes/template',$data);

	    		}else{
	        		$this->failure_txn("Invalid Transaction details. Please try again");
		        }

	        }else{
        		$this->failure_txn("Invalid Transaction details. Please try again");
	        }
        }else{
        	$this->failure_txn("Invalid Transaction. Please try again");
        }
    }

    function send_sms_amount_added_to_wallet($amount,$mobile_no,$customer_name)
    {
        if($amount!=""){
            
            $total_amount = $amount;
          
            $text_message = "Dear ".$customer_name.", We have received your wallet money Rs ". $amount ." and will be updated in your account ASAP. ";

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

    function profile_cancelled_txn(){
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
	        	
				$data['main_content']='profile/profile_cancelled_txn';
				$this->load->view('includes/template',$data);
			}else{
				$this->failure_txn("Invalid Transaction, cancelled. Please try again");
			}
		}else{
			$this->failure_txn("Invalid Transaction cancelled. Please try again");
		}
    }


} ?>