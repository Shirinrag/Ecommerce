<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	 function wallet_balance($user_id=''){
        //calculate user's wallet amount and update it
       /* $str_debit = "SELECT SUM(wallet_amount) as debit_total FROM wallet_txn WHERE status='1' AND txn_type='2' AND user_id='".$user_id."'";
        $debit_data = $this->model->getSqlData($str_debit);
        $debit_total = (isset($debit_data) && !empty($debit_data)) ? $debit_data[0]['debit_total'] : '0';

        $str_credit = "SELECT SUM(wallet_amount) as credit_total FROM wallet_txn WHERE status='1' AND txn_type='1' AND user_id='".$user_id."'";
        $credit_data = $this->model->getSqlData($str_credit);
        $credit_total = (isset($credit_data) && !empty($credit_data)) ? $credit_data[0]['credit_total'] : '0';

        $total_wallet_balance = $credit_total-$debit_total;
        */
        $total_wallet_balance =$this->model->wallet_balance($user_id);
        return $total_wallet_balance;
    }

    function homeDeshboard(){
		$sliders = $this->model->getData('bottom_banner',array('status'=>'1'));
		$sup_products = $this->model->getData('product',array('listed_in_super_deal'=>'1','status'=>'1'));
		$trend_products = $this->model->getData('product',array('listed_in_trending'=>'1','status'=>'1'));
		$category_banner = $this->model->getData('child_banner',array('status'=>'1'));
		$top_fifty = $this->model->getData('product',array('top_fifty'=>'1','status'=>'1'));
		$combo_offer = $this->model->getData('product',array('category_id'=>'6','status'=>'1'));
		$data['slider_data'] = [];
		$data['super_products'] = [];
		$data['trending_products'] = [];
		$data['category_banner'] = [];
		$data['top_50'] = [];
		$data['combo_offer'] = [];
		foreach ($sliders  as $slkey => $slvalue) {
			$data['slider_data'][] = array('bottom_id'=>$slvalue['bottom_id'],'image_name'=>base_url().'uploads/botbanner/'.$slvalue['image_name'],'image_url'=>$slvalue['img_url']);
		}
		if(!empty($data['slider_data'])){
			$data['slider_status'] = '1';
		}else{
			$data['slider_status'] = '0';
		}
		foreach ($sup_products as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];
          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $sup_products[$prokey]['average_rating'] = $data['percent'];
          $sup_products[$prokey]['count_rating'] = $ratings_count;
        }
		foreach ($sup_products as $skey => $svalue) {
			$minus = (float)$svalue['mrp'] - (float)$svalue['price'];
            $divide   = $minus/(float)$svalue['mrp']*100;
			$data['super_products'][] = array('product_id'=>$svalue['product_id'],'product_name'=>$svalue['product_name'],'mrp'=>$svalue['mrp'],'price'=>$svalue['price'],'image_name'=>base_url().'products/'.$svalue['image_name'],'rating'=>$svalue['average_rating'],'count'=>$svalue['count_rating'],'off'=>round($divide).'%');
		}


		if(!empty($data['super_products'])){
			$data['super_status'] = '1';
		}else{
			$data['super_status'] = '0';
		}

		foreach ($trend_products as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];
          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $trend_products[$prokey]['average_rating'] = $data['percent'];
          $trend_products[$prokey]['count_rating'] = $ratings_count;
        }

		foreach ($trend_products as $tkey => $tvalue) {
			$minus = (float)$tvalue['mrp'] - (float)$tvalue['price'];
            $divide   = $minus/(float)$tvalue['mrp']*100;
			$data['trending_products'][] = array('product_id'=>$tvalue['product_id'],'product_name'=>$tvalue['product_name'],'mrp'=>$tvalue['mrp'],'price'=>$tvalue['price'],'image_name'=>base_url().'products/'.$tvalue['image_name'],'rating'=>$tvalue['average_rating'],'count'=>$tvalue['count_rating'],'off'=>round($divide).'%');
		}

		if(!empty($data['trending_products'])){
			$data['trending_status'] = '1';
		}else{
			$data['trending_status'] = '0';
		}

		foreach ($category_banner as $ckey => $cvalue) {
			
			$data['category_banner'][] = array('cat_banner_id'=>$cvalue['bottom_id'],'image_name'=>base_url().'uploads/childbanner/'.$cvalue['image_name'],'image_url'=>$cvalue['img_url'],'category_id'=>$cvalue['category_id']);
		}//exit;

		if(!empty($data['category_banner'])){
			$data['banner_status'] = '1';
		}else{
			$data['banner_status'] = '0';
		}

		foreach ($top_fifty as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];
          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $top_fifty[$prokey]['average_rating'] = $data['percent'];
          $top_fifty[$prokey]['count_rating'] = $ratings_count;
        }

		foreach ($top_fifty as $tfkey => $tfvalue) {
			$minus = (float)$tfvalue['mrp'] - (float)$tfvalue['price'];
            $divide   = $minus/(float)$tfvalue['mrp']*100;
			$data['top_50'][] = array('product_id'=>$tfvalue['product_id'],'product_name'=>$tfvalue['product_name'],'mrp'=>$tfvalue['mrp'],'price'=>$tfvalue['price'],'image_name'=>base_url().'products/'.$tfvalue['image_name'],'rating'=>$tfvalue['average_rating'],'count'=>$tfvalue['count_rating'],'off'=>round($divide).'%');
		}

		if(!empty($data['top_50'])){
			$data['t_50_status'] = '1';
		}else{
			$data['t_50_status'] = '0';
		}

		foreach ($combo_offer as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];
          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $combo_offer[$prokey]['average_rating'] = $data['percent'];
          $combo_offer[$prokey]['count_rating'] = $ratings_count;
        }

		foreach ($combo_offer as $cmkey => $cmvalue) {
			$minus = (float)$cmvalue['mrp'] - (float)$cmvalue['price'];
            $divide   = $minus/(float)$cmvalue['mrp']*100;
			$data['combo_offer'][] = array('product_id'=>$cmvalue['product_id'],'product_name'=>$cmvalue['product_name'],'mrp'=>$cmvalue['mrp'],'price'=>$cmvalue['price'],'image_name'=>base_url().'products/'.$cmvalue['image_name'],'rating'=>$cmvalue['average_rating'],'count'=>$cmvalue['count_rating'],'off'=>round($divide).'%');
		}

		if(!empty($data['combo_offer'])){
			$data['com_offer'] = '1';
		}else{
			$data['com_offer'] = '0';
		}

		echo json_encode($data);
		
	}


	function add_notify_me()
	{
		$postdata['status'] = 'I';
		$postdata['product_id'] = $this->input->get_post('product_id');
		$postdata['user_id'] = $this->input->get_post('user_id');
		$postdata['ofs_flav'] = $this->input->get_post('flvour_name');
		$postdata['user_email'] = $this->input->get_post('email');
		$notify = $this->model->insertData('flavour_notify',$postdata);
		if(!empty($notify)){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}

	function subscribe_user(){
		$user_data = $this->input->get_post('email_address');

		//$final_user_data = array_merge($user_data,array('added_on' => date('Y-m-d H:i:s')));
		
		$profile_email = $this->model->getData('user_subscription',array('email_address' =>$user_data));
		
		if(isset($profile_email) && empty($profile_email)){
			$final_user_data['status'] = '1';
			$final_user_data['email_address'] = $user_data;
			$final_user_data['added_on'] = date('Y-m-d H:i:s');
			$user_id = $this->model->insertData('user_subscription',$final_user_data);
			$data['status'] = '1';
			$data['msg'] = "Thank you for your email subscription.";
		}else{
			$data['status'] = '0';
			$data['msg'] = "Email address is already subscribed with us. Please provide other email address.";
		}
		echo json_encode($data);
	}

	function detailing()
	{
		$product_id = $this->input->get_post('product_id');
		$user_id = $this->input->get_post('user_id');
		//$product_id = 1;
		$product_data = $this->model->getData('product',array('product_id'=>$product_id,'status'=>'1'));
		$combo_offer = $this->model->getData('product',array('category_id'=>'6','status'=>'1'));
		$sup_products = $this->model->getData('product',array('listed_in_super_deal'=>'1','status'=>'1'));
		$bookmark_products = $this->model->getData('bookmark',array('product_id'=>$product_id,'user_id'=>$user_id,'status'=>'1'));
		$data['product_info'] = [];
		$data['b_images'] = [];
		$data['sizes'] = [];
		$data['flavour_data'] = [];
		$data['related_product'] = [];
		$data['combo_offer'] = [];
		$data['brand_details'] = [];
		$data['information']= [];
		$data['information']['ratings'] =[];
		foreach ($product_data as $pkey => $pvalue) {
			$minus = (float)$pvalue['mrp'] - (float)$pvalue['price'];
            $divide   = $minus/(float)$pvalue['mrp']*100;
            $brand_details = $this->model->getData('brands',array('brand_id'=>$pvalue['brand_id']));
            foreach ($brand_details as $brkey => $brvalue) {
            	$data['brand_details'][] = array('brand_id'=>$brvalue['brand_id'],'brand_name'=>$brvalue['brand_name'],'brand_iamge'=>base_url().'uploads/brand/'.$brvalue['image_name']);
            }

            $product_id = $pvalue['product_id'];
			if(!empty($product_id)){
				$allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
				
			}
			if(empty($allrating)){
				$allrating = array();
			}
			$ratings_count = count($allrating);
			$total_ratings = 0;
			foreach ($allrating as $key => $value) {
				$total_ratings += $value['rating'];
				 
			}

			$data['average_rating'] = $total_ratings / $ratings_count;
			$ratings = round($total_ratings * 5)/($ratings_count * 5);
			$data['percent'] = ($ratings * 100)/5;
			$data['count_rating'] = $ratings_count;
			$average_rating = $data['percent'];
			$count_rating = $ratings_count;



			$data['product_info'][] = array('product_id'=>$pvalue['product_id'],'product_name'=>$pvalue['product_name'],'product_image'=>base_url().'products/'.$pvalue['image_name'],'mrp'=>$pvalue['mrp'],'price'=>$pvalue['price'],'off'=>round($divide).'%','sold_by'=>$pvalue['sold_by'],'average_rating'=>$average_rating,'count_rating'=>$count_rating,'importer_title'=>$pvalue['importer_title'],'importer_certificate'=>base_url().'uploads/product_certificate/'.$pvalue['importer_certf'],'share_link'=>base_url().'api/detailing/'.$pvalue['product_id']);
			$data['information']['specification'][] = array('Brand'=>$pvalue['brand'],'Form'=>$pvalue['form'],'Flavour'=>$pvalue['prod_flavour'],'Number_of_serving'=>$pvalue['no_of_serving'],'Protein_per_serving'=>$pvalue['protein_per_serving'],'Serving_size'=>$pvalue['serving_size'],'Packaging'=>$pvalue['packaging']);
			$data['information']['description'][] = array('description'=>$pvalue['description']);
			foreach ($allrating as $rkey => $rvalue) {
				$user_name = $this->model->getValue('user','full_name',array('user_id'=>$user_id));
				$data['information']['ratings'][] = array('user_name'=>$user_name,'rating'=>$rvalue['rating'],'description'=>$rvalue['description']);
				
			}
			
			$size_product = $this->model->getData('product_relative',array('product_id'=>$pvalue['product_id']));
			$flavour_data = $this->model->getData('product_flavour',array('product_id'=>$product_id));
			foreach ($size_product as $skey => $svalue) {
				$s_product = $this->model->getData('product',array('product_id'=>$svalue['rel_product_id']));
				foreach ($s_product as $fkey => $fvalue) {
					$unit_name = $this->model->getValue('product_unit','abbrivation',array('unit_id'=>$fvalue['unit_id']));
					$data['sizes'][] = array('pack_size'=>round($fvalue['pack_size']),'unit_name'=>$unit_name,'size_price'=>round($fvalue['price']),'product_id'=>$fvalue['product_id']);
				}
			}
			$banner_images = unserialize($pvalue['banner_images']);
			foreach ($banner_images as $bkey => $bvalue) {
				$data['b_images'][] = array('banner_image'=>base_url().'uploads/product_banners/'.$bvalue);
			}

			foreach ($flavour_data as $flkey => $flvalue) {
				$data['flavour_data'][] = array('flavour_id'=>$flvalue['id'],'flavour_name'=>$flvalue['flavour_name'],'flavour_status'=>$flvalue['flavour_status']);
			}

			$related_product = unserialize($pvalue['rel_product_id']);
			foreach ($related_product as $rekey => $revalue) {
				$relatedproduct = $this->model->getData('product',array('product_id'=>$revalue));
				foreach ($relatedproduct as $prokey => $proval) {
		          $product_id = $proval['product_id'];
		          if(!empty($product_id)){
		            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
		            
		          }
		          if(empty($allrating)){
		            $allrating = array();
		          }
		          $ratings_count = count($allrating);
		          $total_ratings = 0;
		          foreach ($allrating as $key => $value) {
		            $total_ratings += $value['rating'];

		          }

		          $data['average_rating'] = $total_ratings / $ratings_count;
		          $ratings = round($total_ratings * 5)/($ratings_count * 5);
		          $data['percent'] = ($ratings * 100)/5;
		          $relatedproduct[$prokey]['average_rating'] = $data['percent'];
		          $relatedproduct[$prokey]['count_rating'] = $ratings_count;
		        }
				foreach ($relatedproduct as $relkey => $relvalue) {

					$minus = (float)$relvalue['mrp'] - (float)$relvalue['price'];
            		$divide   = $minus/(float)$relvalue['mrp']*100;
					$data['related_product'][] = array('product_id'=>$relvalue['product_id'],'product_name'=>$relvalue['product_name'],'mrp'=>$relvalue['mrp'],'price'=>$relvalue['price'],'image_name'=>base_url().'products/'.$relvalue['image_name'],'rating'=>$relvalue['average_rating'],'count'=>$relvalue['count_rating'],'off'=>round($divide).'%');
				}
			}
		}
		foreach ($combo_offer as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];

          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $combo_offer[$prokey]['average_rating'] = $data['percent'];
          $combo_offer[$prokey]['count_rating'] = $ratings_count;
        }
		//echo '<pre>'; print_r($combo_offer); exit;
		foreach ($combo_offer as $cmkey => $cmvalue) {
			$minus = (float)$cmvalue['mrp'] - (float)$cmvalue['price'];
            $divide   = $minus/(float)$cmvalue['mrp']*100;
			$data['combo_offer'][] = array('product_id'=>$cmvalue['product_id'],'product_name'=>$cmvalue['product_name'],'mrp'=>$cmvalue['mrp'],'price'=>$cmvalue['price'],'image_name'=>base_url().'products/'.$cmvalue['image_name'],'rating'=>$cmvalue['average_rating'],'count'=>$cmvalue['count_rating'],'off'=>round($divide).'%');
		}

		if(!empty($data['combo_offer'])){
			$data['com_offer'] = '1';
		}else{
			$data['com_offer'] = '0';
		}

		foreach ($sup_products as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];
          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $sup_products[$prokey]['average_rating'] = $data['percent'];
          $sup_products[$prokey]['count_rating'] = $ratings_count;
        }


		foreach ($sup_products as $skey => $svalue) {
			$minus = (float)$svalue['mrp'] - (float)$svalue['price'];
            $divide   = $minus/(float)$svalue['mrp']*100;
			$data['super_products'][] = array('product_id'=>$svalue['product_id'],'product_name'=>$svalue['product_name'],'mrp'=>$svalue['mrp'],'price'=>$svalue['price'],'image_name'=>base_url().'products/'.$svalue['image_name'],'rating'=>$svalue['average_rating'],'count'=>$svalue['count_rating'],'off'=>round($divide).'%');
		}

		if(!empty($data['super_products'])){
			$data['super_status'] = '1';
		}else{
			$data['super_status'] = '0';
		}

		if(!empty($data['product_info'])){
			$data['product_status'] = '1';
		}else{
			$data['product_status'] = '0';
		}

		if(!empty($data['b_images'])){
			$data['banner_status'] = '1';
		}else{
			$data['banner_status'] = '0';
		}

		if(!empty($data['brand_details'])){
			$data['brand_status'] = '1';
		}else{
			$data['brand_status'] = '0';
		}
		if(!empty($data['sizes'])){
			$data['size'] = '1';
		}else{
			$data['size'] = '0';
		}
		if(!empty($data['flavour_data'])){
			$data['flavour_status'] = '1';
		}else{
			$data['flavour_status'] = '0';
		}
		if(!empty($data['related_product'])){
			$data['realted_status'] = '1';
		}else{
			$data['realted_status'] = '0';
		}

		if(!empty($data['information'])){
			$data['inform_status'] = '1';
		}else{
			$data['inform_status'] = '0';
		}
		if(!empty($bookmark_products)){
			$data['bookmark_status'] = '1';
			$data['bookmark_id'] = $bookmark_products[0]['bookmark_id'];
		}else{
			$data['bookmark_status'] = '0';
		}

		echo json_encode($data);
	}
	
	function authentic()
	{
		
		$data['authentic'] = $this->model->getData('product_importer',array('status'=>'1'));
		if($data)
		{
			$data['status'] = "1";
		}
		else
		{
			$data['status'] = "0";
		}
		
		
		echo json_encode($data);
		
	}

	function get_auto_product_list(){
        $product_name = $this->input->get_post('term');
        $product_data = $this->model->getSqlData("SELECT * FROM product WHERE status='1' AND (product_id LIKE '%".$product_name."%' OR product_name LIKE '%".$product_name."%') ");
        
        if(isset($product_data) && !empty($product_data)){
            foreach ($product_data as $key => $value) {
            	$category_data = $this->model->getData('category',array('category_id'=>$value['category_id']))[0];

            	$data['product_info'][] = array('category_id'=>$category_data['category_id'],'category_name'=>$category_data['category_name'],'product_id'=>$value['product_id'],'product_name'=>strtoupper($value['product_name']));
            	// $data['category_id'] = $category_data['category_id'];
             //    $data['id'] = $value['product_id'];
             //    $data['value'] = strtoupper($value['product_name']);
             //    $data['label'] = strtoupper($value['product_name']);
                //array_push($product_list, $data);
                $data['status'] = 1;
            }
        }else{
        	$data['status'] = 0;
        }
        echo json_encode($data);
    }


    function offer_list(){
    	$product_data = $this->model->getData('product',array('status'=>'1'));
    	$data['product_offer'] = [];
    	foreach ($product_data as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];

          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $product_data[$prokey]['average_rating'] = $data['percent'];
          $product_data[$prokey]['count_rating'] = $ratings_count;
        }
    	foreach ($product_data as $okey => $ovalue) {
			$minus = (float)$ovalue['mrp'] - (float)$ovalue['price'];
            $divide   = $minus/(float)$ovalue['mrp']*100;
            if($divide > 30){
            	$data['product_offer'][] = array('product_id'=>$ovalue['product_id'],'product_name'=>$ovalue['product_name'],'mrp'=>$ovalue['mrp'],'price'=>$ovalue['price'],'image_name'=>base_url().'products/'.$ovalue['image_name'],'rating'=>$ovalue['average_rating'],'count'=>$ovalue['count_rating'],'off'=>round($divide).'%');
            }
		}
		if(!empty($data['product_offer'])){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
    }


    function addItemToCart()
	{
		$product_id = $this->input->get_post('product_id');
		//echo '<pre>'; print_r($product_id); exit;
		$purchase_qty = $this->input->get_post('purchase_qty');
		$price = $this->input->get_post('price');
		$pack_size = $this->input->get_post('pack_size');
		$pack_color = $this->input->get_post('pack_color');
		$pack_image = $this->input->get_post('pack_image');
		$user_id = $this->input->get_post('user_id');
		$flavour = $this->input->get_post('flavour');
		$product_name = $this->input->get_post('product_name');
		if($product_id!=''){
			//$csession_id = $this->session->userdata('session_id');
			$ProductDetails = $this->model->getData('product',array('product_id'=>$product_id));
			//echo '<pre>'; print_r($ProductDetails); exit;
			if(isset($ProductDetails) && !empty($ProductDetails)){ //if product available
				
				if($ProductDetails[0]['stock_status']=='1'){

					$productPrice= $ProductDetails[0]['price'];
					$productPrice= $ProductDetails[0]['mrp'];
					$unit_id = ($ProductDetails[0]['unit_id']>0) ? $ProductDetails[0]['unit_id'] : '0' ;
					//echo '<pre>'; print_r($csession_id); exit;
					$isItemInCart = $this->model->getData('cart',array('product_id'=>$product_id,'pack_size'=>$pack_size,'product_name'=>$product_name,'user_id'=>$user_id));

					

					if($isItemInCart){
						//update item in cart
						$cartQty = $isItemInCart[0]['qty']+$purchase_qty;
						// $unit_total = $this->qty_price($cartQty,$unit_id,$productPrice);
						$unit_total = $price * $cartQty;
						$itemcart = array('price'=>$price,'unit_total'=>$unit_total, 'product_id'=>$product_id,'pack_size'=>$pack_size,'product_name'=>$product_name,'pack_image'=>$pack_image,'qty'=>$cartQty,'user_id'=>$user_id,'flavour'=>$flavour);
						$this->model->updateData('cart',$itemcart, array('cart_id'=>$isItemInCart[0]['cart_id']));
					}else{
						//insert into cart
						$unit_total = $price * $purchase_qty;
						//$itemcart = array('price'=>$price,'unit_total'=>$unit_total, 'product_id'=>$product_id,'pack_color'=>$pack_color,'qty'=>$purchase_qty,'product_name'=>$product_name,'pack_image'=>$pack_image,'user_id'=>$user_id,'flavour'=>$flavour);
						$itemcart = array('price'=>$price,'unit_total'=>$unit_total, 'product_id'=>$product_id,'qty'=>$purchase_qty,'product_name'=>$product_name,'pack_image'=>$pack_image,'user_id'=>$user_id,'flavour'=>$flavour);
						$itemcart['pack_size'] = $pack_size;
						$this->model->insertData('cart',$itemcart);
					}
					$data['status'] = 1;
					$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
					$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE user_id='".$user_id."'");
					$data['total_amount'] = sprintf('%0.2f', $unit_total[0]['total']);

				}else{
					$data['status'] = '0';
				}

			}else{
				$data['status'] = 0;
				$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
				$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE user_id='".$user_id."'");
				$data['total_amount'] = sprintf('%0.2f', $unit_total[0]['total']);
			}
		}else{
			$data['status'] = 0;
			$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
			$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE user_id='".$user_id."'");
			$data['total_amount'] = sprintf('%0.2f', $unit_total[0]['total']);
		}
		echo json_encode($data);
	}

	function item_in_cart(){
		$user_id = $this->input->get_post('user_id');
		$data['item_in_cart'] = $this->model->getData('cart',array('user_id'=>$user_id));
		if(!empty($data['item_in_cart'])){
			$total_cart_item=$this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
    		$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE user_id='".$user_id."'");
    		$data['cart_total_amount'] = $unit_total[0]['total'];
			$data['status'] = 1;
		}else{
			$data['status'] = 0;
		}
		
		echo json_encode($data);
		
	}
	
	 function add_review(){
		 
		 $de['user_id'] = $this->input->get_post('user_id');
		$de['product_id'] = $this->input->get_post('product_id');
		$de['rating'] = $this->input->get_post('rating');
		$de['description'] = $this->input->get_post('description');
		$de['user_name'] =$this->model->getValue('user','full_name',array('user_id' => $de['user_id'])); 

	$data1['details'] =$this->model->getData('product_review',array('product_id' => $de['product_id'],'user_id' => $de['user_id']));
		 
		if(!empty($data1['details'])){
			
				$this->model->updateData('product_review',$de,array('product_id' => $de['product_id'],'user_id' => $de['user_id']));
			$data['status'] = '1';
			
			
		}
		else{
			
			$adddata = $this->model->insertData('product_review',$de);
			if($adddata)
			{
				$data['status'] = '0';
			}
			
			
		}
		echo json_encode($data);
	}
	
	function count_in_cart(){
		$user_id = $this->input->get_post('user_id');

		$data['item_in_cart'] = $this->model->getData('cart',array('user_id'=>$user_id));

		if(!empty($data['item_in_cart'])){
			$data['status'] = 1;
			$data['count'] = count($data['item_in_cart']);
		}else{
			$data['status'] = 0;
			$data['count'] = 0;
		}
		
		echo json_encode($data);
		
	}



	function UpdateItemToCart(){
		$user_id = $this->input->get_post('user_id');
		$cart_id = $this->input->get_post('cart_id');
		$purchase_qty = $this->input->get_post('purchase_qty');
		
		if($cart_id!='' && $purchase_qty!=''){
			$iscartvalid = $this->model->getData('cart',array('cart_id'=>$cart_id));
			if($iscartvalid){

				$this->model->updateData('cart',array('qty'=>$purchase_qty,'unit_total'=>upto2Decimal($iscartvalid[0]['price']*$purchase_qty)), array('cart_id'=>$cart_id));
				$cartData = $this->model->getData('cart',array('cart_id'=>$cart_id));

				$data['Unit_Price'] = upto2Decimal($cartData[0]['qty']*$cartData[0]['price']);

				$strSql = "SELECT SUM(unit_total) as GrandTotal FROM cart WHERE user_id='".$user_id."'";
				$SqlResult = $this->model->getSqlData($strSql);
				
				$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
				$data['GrandTotal'] = upto2Decimal($SqlResult[0]['GrandTotal']);
				$data['status'] = '1';
			}else{
				$data['status'] = '0';
			}
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}

	function DeleteItemFromCart(){
		$cart_id = $this->input->get_post('cart_id');
		$user_id = $this->input->get_post('user_id');
		if($cart_id!=''){
			$iscartvalid = $this->model->getData('cart',array('cart_id'=>$cart_id));
			if($iscartvalid){
				$this->model->deleteData('cart',array('cart_id'=>$cart_id));
				$strSql = "SELECT SUM(unit_total) as GrandTotal FROM cart WHERE user_id='".$user_id."'";
				$SqlResult = $this->model->getSqlData($strSql);
				
				$data['GrandTotal'] = upto2Decimal($SqlResult[0]['GrandTotal']);
				$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
				$data['status'] = '1';
			}else{
				$data['status'] = '0';
			}
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}

	function addBookmark(){
		$bookmark['user_id'] = $this->input->get_post('user_id');
		$bookmark['product_id'] = $this->input->get_post('product_id');
		//echo '<pre>'; print_r($bookmark); exit;
		$addbook = $this->model->insertData('bookmark',$bookmark);

		if(!empty($addbook)){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}

	function get_bookmarklist(){
		$user_id = $this->input->get_post('user_id');
		$bookmark_list = $this->model->getData('bookmark',array('user_id'=>$user_id));

		$data['product_info'] = [];
		foreach ($bookmark_list as $bkey => $bvalue) {
			$ProductDetails = $this->model->getData('product',array('product_id'=>$bvalue['product_id']));
			foreach ($ProductDetails as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];

          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $ProductDetails[$prokey]['average_rating'] = $data['percent'];
          $ProductDetails[$prokey]['count_rating'] = $ratings_count;
        }
			foreach ($ProductDetails as $pkey => $pvalue) {
				$minus = (float)$pvalue['mrp'] - (float)$pvalue['price'];
            		$divide   = $minus/(float)$pvalue['mrp']*100;
					$data['product_info'][] = array('product_id'=>$pvalue['product_id'],'product_name'=>$pvalue['product_name'],'mrp'=>$pvalue['mrp'],'price'=>$pvalue['price'],'image_name'=>base_url().'products/'.$pvalue['image_name'],'rating'=>$pvalue['average_rating'],'count'=>$pvalue['count_rating'],'off'=>round($divide).'%');

			}
		}
		if(!empty($data['product_info'])){
			$data['status'] = 1;
		}else{
			$data['status'] = 0;
		}
		
		echo json_encode($data);
		
	}

	function remove_bookmark(){
		$user_id = $this->input->get_post('user_id');
		$bookmark_id = $this->input->get_post('bookmark_id');
		$delete_bookmark = $this->model->deleteData('bookmark',array('bookmark_id'=>$bookmark_id,'user_id'=>$user_id));
		if(empty($delete_bookmark)){
			$data['status'] = 1;
		}else{
			$data['status'] = 0;
		}
		
		echo json_encode($data);
		
	}

	function getSideCategory(){
        $category_id = !empty($_POST['parent_category_id']) ? $_POST['parent_category_id'] : 0;
		$categories = $this->model->getData('category',array('status'=>'1','parent_category_id'=>$category_id));
		$data['category'] = [];
		foreach ($categories as $catkey => $catvalue) {
			$data['category'][] = array('category_id'=>$catvalue['category_id'],'category_name'=>$catvalue['category_name']);
		}

		if(!empty($data['category'])){
			$data['status']= '1';
		}else{
			$data['status']= '0';
		}
		
		echo json_encode($data);
	}

	function getBrandList(){

		$brand = $this->model->getData('brands',array('status'=>'1'));
		$data['brands'] = [];
		foreach ($brand as $bkey => $bvalue) {
			$data['brands'][] = array('brand_id'=>$bvalue['brand_id'],'brand_name'=>$bvalue['brand_name'],'image_name'=>base_url().'uploads/brand/'.$bvalue['image_name'],'description'=>$bvalue['manufacture']);
		}

		if(!empty($data['brands'])){
			$data['status']= '1';
		}else{
			$data['status']= '0';
		}
		
		echo json_encode($data);
	}

	function getBrandWiseProduct(){
		$brand_id = $this->input->get_post('brand_id');
		$products = $this->model->getData('product',array('brand_id'=>$brand_id,'status'=>'1'));
		$data['product_info'] = [];
		foreach ($products as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];

          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $products[$prokey]['average_rating'] = $data['percent'];
          $products[$prokey]['count_rating'] = $ratings_count;
        }
		foreach ($products as $prokey => $pvalue) {
			$minus = (float)$pvalue['mrp'] - (float)$pvalue['price'];
    		$divide   = $minus/(float)$pvalue['mrp']*100;
			$data['product_info'][] = array('product_id'=>$pvalue['product_id'],'product_name'=>$pvalue['product_name'],'mrp'=>$pvalue['mrp'],'price'=>$pvalue['price'],'image_name'=>base_url().'products/'.$pvalue['image_name'],'rating'=>$pvalue['average_rating'],'count'=>$pvalue['count_rating'],'off'=>round($divide).'%');
		}

		if(!empty($data['product_info'])){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);

	}

	function getCategoryWiseProduct(){
		$categ_id = $this->input->get_post('category_id');
		$brand = $this->input->get_post('brand');
		$size = $this->input->get_post('size');
		$type = $this->input->get_post('type');
		$minprice = $this->input->get_post('min_price');
		$maxprice = $this->input->get_post('max_price');
		$rating = $this->input->get_post('rating');
		$highestprice = $this->input->get_post('highestprice');
		$lowestprice = $this->input->get_post('lowestprice');
		$query = "SELECT * FROM product WHERE status = '1'";
		if(isset($categ_id) && !empty($categ_id))
		{
			$query .= "
			AND category_id='".$categ_id."'
			";
		}
		

		if(isset($brand) && !empty($brand)){
	        $query .= "
	         AND brand_id IN('".$brand."')
	         ";
	    }
	    if(isset($size) && !empty($size)){
	        $query .= "
	         AND pack_size IN('".$size."')
	         ";
	    }
	    if(isset($type) && !empty($type)){
	        $query .= "
	         AND product_type IN('".$type."')
	         ";
	    }
		if(isset($highestprice) && !empty($highestprice)){
			$query .= "
	         ORDER BY price DESC
	         ";
		}

		if(isset($lowestprice) && !empty($lowestprice)){
			$query .= "
	         ORDER BY price ASC
	         ";
		}
		//echo '<pre>'; print_r($query); exit;
		$products = $this->model->getSqlData($query);
		// $category_id = $this->input->get_post('category_id');
		// $products = $this->model->getData('product',array('category_id'=>$category_id,'status'=>'1'));
		$data['product_info'] = [];
		foreach ($products as $prokey => $proval) {
          $product_id = $proval['product_id'];
          if(!empty($product_id)){
            $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
            
          }
          if(empty($allrating)){
            $allrating = array();
          }
          $ratings_count = count($allrating);
          $total_ratings = 0;
          foreach ($allrating as $key => $value) {
            $total_ratings += $value['rating'];

          }

          $data['average_rating'] = $total_ratings / $ratings_count;
          $ratings = round($total_ratings * 5)/($ratings_count * 5);
          $data['percent'] = ($ratings * 100)/5;
          $products[$prokey]['average_rating'] = $data['percent'];
          $products[$prokey]['count_rating'] = $ratings_count;
        }
		foreach ($products as $prokey => $pvalue) {
			$minus = (float)$pvalue['mrp'] - (float)$pvalue['price'];
    		$divide   = $minus/(float)$pvalue['mrp']*100;
			$data['product_info'][] = array('product_id'=>$pvalue['product_id'],'product_name'=>$pvalue['product_name'],'mrp'=>$pvalue['mrp'],'price'=>$pvalue['price'],'image_name'=>base_url().'products/'.$pvalue['image_name'],'rating'=>$pvalue['average_rating'],'count'=>$pvalue['count_rating'],'off'=>round($divide).'%');
		
		}

		if(!empty($data['product_info'])){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);

	}


	function proceed_to_checkout()
	{
		//$user_id ='1';
		$user_id = $this->input->get_post('user_id');
		//$data['my_address'] = $this->model->getDataOrderBy('user_addresses',array('user_id'=>$user_id,'status'=>'1'),'added_on','desc');
			// foreach ($data['my_address'] as $key => $value) {
			// 	$data['my_address'][$key]['state_name'] = $this->model->getValue('states','state_name',array('state_code'=>$value['state_code']));
			// }
			//$data['states'] =$this->model->getAllData('states');
			$item_in_cart = $this->model->getData('cart',array('user_id'=>$user_id));
			//echo '<pre>'; print_r($item_in_cart); exit;

			$cgst = 0;
			$sgst = 0;
			$igst = 0;
			$data['gst_type'] = '';
			//$data['available_points_value'] = $this->model->getAvailablePoints($user_id)['total_point_value'];
			//$data['available_points'] = $this->model->getAvailablePoints($user_id)['total_points'];
			
			//$total_reedem_points = 0;
			foreach($item_in_cart as $key => $item){
				$product = $this->model->getData('product',array('product_id'=>$item['product_id']))[0];
				$data['category_id'] = $this->model->getValue('product','category_id',array('product_id'=>$item['product_id']));
				$sub_category_id = $this->model->getValue('product','sub_category_id',array('product_id'=>$item['product_id']));
				$gst_setting = $this->model->getData('gst_setting',array('category_id'=>$data['category_id'],'sub_category_id'=>$sub_category_id));
				
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
				//$total_reedem_points += $product['redeem_point'] * $item['qty'];
			}
			//$data['total_reedem_points'] = $total_reedem_points;
			
			$data['cgst'] = $cgst;
			$data['sgst'] = $sgst;
			$data['igst'] = $igst;
			$data['state_code'] = $this->model->getValue('company_setting','state_code',array('comp_sett_id'=>'1'));
			$data['item_in_cart'] = $item_in_cart;
			//echo '<pre>'; print_r($data['item_in_cart']); exit;
			$total_cart_item=$this->model->CountWhereRecord('cart',array('user_id'=>$user_id));
			$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE user_id='".$user_id."'");
			
			$data['subtotal'] = $unit_total[0]['total'];
			$data['total'] = $unit_total[0]['total'];

			if($data['gst_type'] == 'I'){
				$data['subtotal'] -= $igst;
			}
			else if($data['gst_type'] == 'E'){
				$data['total'] += $igst;
			}

			if(!empty($data['item_in_cart'])){
				$data['status'] = '1';
			}else{
				$data['status'] = '0';
			}

			$courier_charges = $this->model->getData('courier_charges');
			//$courier_charge = 0;
			$data['courier_charge'] = 0;
			foreach ($courier_charges as $key => $charge) {
				if($data['total'] >= $charge['bill_amount_from'] && $data['total'] <= $charge['bill_amount_to'] ){
					$data['courier_charge'] = $charge['courier_charge'];
				}
			}
			$data['final_total'] = 	$data['subtotal'] + $data['courier_charge'] ;	
			$data['wallet_balance'] = $this->model->wallet_balance($user_id);
			

			echo json_encode($data);
		
	}


	
function order_confirmation(){
		
        
        $user_id = $this->input->get_post('user_id');
         $courier_charges = $this->input->get_post('courier_charges');
        $discounted_amount = 0;	
        $payment_method = $this->input->get_post('payment_method');
        $deliver_address = $this->input->get_post('deliver_address');	
        $redeem_amount = 230;
        $redeem_points = 1;
        $sgst = 0;
    	$cgst = 0;
    	$igst = 0;
    	$promo_code = 0;
    	$data = array();
	     if(isset($user_id) && $user_id!=''){

	        $user_data = $this->model->getData('user',array('user_id'=>$user_id));
	        //echo '<pre>'; print_r($user_data); exit;
	        if(isset($user_data) && !empty($user_data)){
	        	$cart_item =$this->model->getData('cart',array('user_id'=>$user_id));
	        	//echo '<pre>'; print_r($cart_item); exit;
		        $product_total = $this->model->getSqlData("SELECT SUM(unit_total) AS Total FROM cart WHERE user_id='".$user_id."'");

		        		$total_amount = $product_total[0]['Total'] ;
		        		
		        		if((isset($cart_item) && !empty($cart_item)))
		        		{
		        			$orderNo = rand();
		        			//echo '<pre>'; print_r($orderNo); exit;
		        			$gst_data  = $this->model->getData('gst_setting');

		        			$gst_type = '';
		        			if(!empty($gst_data)){
				                $gst_type = $gst_data[0]['gst_type'];
		        			}
		        			

		        			$order_data = array(
		        				'user_id'=>$user_id,
		        				'order_number'=>$orderNo,
		        				'courier_charges'=>$courier_charges,
		        				'total_amount'=>$total_amount,
		        				'after_discounted_amount'=>$total_amount - $discounted_amount,
		        				'payment_method'=>$payment_method,
		        				'address_id'=>$deliver_address,
		        				'redeem_amount'=>$redeem_amount,
		        				'redeem_points'=>$redeem_points,
		        				// 'user_expected_order_date'=>date('Y-m-d',strtotime($delivery_date)),
		        				// 'user_expected_order_time_slot'=>$delivery_time,
		        				'order_date_time'=>date('Y-m-d H:i:s'),
		        				'offer_code'=>$promo_code,
		        				'discounted_amount'=>$discounted_amount,
		        				'sgst'=>$sgst,
		        				'cgst'=>$cgst,
		        				'igst'=>$igst,
		        				'gst_type'=>$gst_type
		        			);
		        			//echo '<pre>'; print_r($order_data); exit;
		        			$order_id = $this->model->insertData('order_data',$order_data);

		        			//$this->model->reduceUserPoints($user_id,$redeem_amount,$orderNo);
		        			
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
		        				//echo '<pre>'; print_r($array_cart_item); exit;
		        				$this->model->insertData('order_data_details',$array_cart_item);

		        				$product_data = $this->model->getData('product',array('product_id'=>$value['product_id']))[0];
		        				$points_for_distribution = ($value['unit_total'] ) * $product_data['mlm_distribution']/100;

		        				
		        			}
		        			$data['status'] = '1';
		        			$data['orderNo'] = $orderNo;
		        			$data['msg'] = 'Your order has been placed successfully. Your order no is: '.$orderNo;

		        			$this->model->deleteData('cart',array('user_id'=>$user_id));

		        		}else{
		        			$data['status'] = '0';
		        			$data['msg'] = 'Your cart is empty.';
		        		}
		        	}else{
		        		$data['status'] = '0';
	        			$data['msg'] = 'We are not recognizing you. Please login again';	
		        	}
	        	 }else{
	        	 	$data['status'] = 0;
	        	 	$data['msg'] = 'Session has been expired. Please login again';
	        	 }
	       
        
        echo json_encode($data);
	}
	function myorders(){
		$user_id = $this->input->get_post('user_id');
		
		//$data['order_data'] = $this->model->getDataOrderBy('order_data',array('user_id'=>$user_id,'status'=>'1'),'order_date_time','desc');
		$data['order_data_details'] = $this->model->getDataOrderBy('order_data_details',array('user_id'=>$user_id),'added_on','desc');
		//$data['product_info'] = [];
		foreach ($data['order_data_details'] as $odkey => $odvalue) {
			$product_data = $this->model->getData('product',array('product_id'=>$odvalue['product_id'],'status'=>'1'));
			foreach ($product_data as $pkey => $pvalue) {
            	$data['order_data_details'][$odvalue['order_number']]['product_info'][] = array('product_id'=>$pvalue['product_id'],'product_name'=>$pvalue['product_name'],'product_image'=>base_url().'products/'.$pvalue['image_name'],'mrp'=>$pvalue['mrp'],'price'=>$pvalue['price'],'sold_by'=>$pvalue['sold_by'],'importer_title'=>$pvalue['importer_title'],'importer_certificate'=>base_url().'uploads/product_certificate/'.$pvalue['importer_certf'],'share_link'=>base_url().'api/detailing/'.$pvalue['product_id']);
            }
		}
		if(!empty($data['order_data_details'])){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		
		
		echo json_encode($data);
	}


	function cancel_order(){
		$order_number = $this->input->get_post('order_number');
		$user_id = $this->input->get_post('user_id');
		$data = array();
		if($order_number!="" && $user_id!=""){
			$order_data = $this->model->getData('order_data',array('order_number'=>$order_number,'status'=>'1','user_id'=>$user_id));
			//1: order is in packaging mode
			if(isset($order_data) && !empty($order_data)){
				$this->model->updateData('order_data',array('status'=>'0','cancelled_at'=>date('Y-m-d H:i:s')),array('order_id'=>$order_data[0]['order_id']));
				$data['status'] = '1';
				$data['msg'] = 'Your order #'.$order_number.' has been cancelled.';
				$this->send_order_cancellation_mail($order_number);
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Your order can not be cancelled. Please contact to customer care.';	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Order number/user details are missing';
		}
		echo json_encode($data);
	}




    function validate_signin(){
		$mobile_number = $this->input->get_post('mobile_number');
		$password = $this->input->get_post('password');
		if($mobile_number!='' && $password!=''){
			$user_data = $this->model->getData('user',array('mobile_number'=>$mobile_number,'password'=>md5($password)));
			if(isset($user_data) && !empty($user_data)){

					$data['user_id'] = $user_data[0]['user_id'];
					$data['full_name'] = $user_data[0]['full_name'];
					$data['email_address'] = strtolower($user_data[0]['email_address']);
					$data['mobile_number'] = $user_data[0]['mobile_number'];
					$data['gender'] = $user_data[0]['gender'];
					$data['registration_date'] = $user_data[0]['registration_date'];
					$data['gcm_id'] = $user_data[0]['gcm_id'];
					$data['wallet_balance'] = $this->wallet_balance($user_data[0]['user_id']);
					$data['addresses'] = array();
						
					$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_data[0]['user_id'],'status'=>'1'));
					if(isset($address_data) && !empty($address_data)){
						foreach ($address_data as $key => $value) {
							$data['addresses'][$key]['address_id'] = $value['address_id'];
							$data['addresses'][$key]['user_id'] = $value['user_id'];
							$data['addresses'][$key]['full_name'] = $value['full_name'];
							$data['addresses'][$key]['mobile_number'] = $value['mobile_number'];
							$data['addresses'][$key]['email_address'] = $value['email_address'];
							$data['addresses'][$key]['address1'] = $value['address1'];
							$data['addresses'][$key]['address2'] = $value['address2'];
							$data['addresses'][$key]['landmark_nearest_area'] = $value['landmark_nearest_area'];
							$data['addresses'][$key]['town_city'] = $value['town_city'];
							$data['addresses'][$key]['pincode'] = $value['pincode'];
							$data['addresses'][$key]['added_on'] = $value['added_on'];
						}
					}
					$data['status'] = '1';
              		$data['msg'] = 'You have logged in successfully.';
              	
			}else{
				$data['status'] = '0';
				$data['msg'] = 'The mobile number or password you entered is invalid.';
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Required parameters are missing.';
		}
		echo json_encode($data);
	}

	function signup(){
		$full_name = $this->input->get_post('full_name');
		$email_address =  $this->input->get_post('email_address');

		$mobile_number =  $this->input->get_post('mobile_number');
		

		if($full_name!=''){
			if(!empty($email_address)){
				$email_info=$this->model->getData('user',array('email_address'=>$email_address));
			}else{
				$email_info = array();
			}
			if(!empty($mobile_number)){
				$mobile_info=$this->model->getData('user',array('mobile_number'=>$mobile_number));
			}else{
				$mobile_info = array();
			}
			
			
			if(isset($email_info) && empty($email_info))
			{
				if(isset($mobile_info) && empty($mobile_info))
				{
					$array_data=array(
						'full_name'=>$full_name,
						'email_address'=>$email_address,
						'mobile_number'=>$mobile_number,
						'registration_date'=>date('Y-m-d H:i:s'),
					);
					$user_inserted_id=$this->model->insertData('user',array_map('strtoupper', $array_data));

					if($user_inserted_id){
						$user_info=$this->model->getData('user',array('user_id'=>$user_inserted_id));
						$data['user_id'] = $user_info[0]['user_id'];
						$data['full_name'] = $user_info[0]['full_name'];
						$data['email_address'] = $user_info[0]['email_address'];
						$data['mobile_number'] = $user_info[0]['mobile_number'];
						$data['gender'] = $user_info[0]['gender'];
						$data['gcm_id'] = $user_info[0]['gcm_id'];
						$data['registration_date'] = $user_info[0]['registration_date'];
						$data['wallet_balance'] = $this->wallet_balance($user_info[0]['user_id']);
						$data['status'] = '1';
						$data['msg'] = 'Your account has been registered successfully.';
					}else{
						$data['status'] = '0';
						$data['msg'] = 'Error while signing up. please try again.';
					}
				}else{
					$data['user_id'] = $mobile_info[0]['user_id'];
					$data['status'] = '0';
					$data['msg'] = 'Mobile number is already registered with us';
				}
			}else{
				$data['user_id'] = $email_info[0]['user_id'];
				$data['status'] = '0';
				$data['msg'] = 'Email address is already registered with us. Please enter unique email address';
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Required parameters are missing.';
		}
		echo json_encode($data);	
	}

	function update_profile(){
		$user_id = $this->input->get_post('user_id');
		$full_name = $this->input->get_post('full_name');
		$email_address = $this->input->get_post('email_address');
		$gender = $this->input->get_post('gender');
		$date_of_birth = $this->input->get_post('date_of_birth');
		
		if($user_id!="" && $full_name!="" && $email_address!="" && $gender!="" && $date_of_birth!=""){
			$user_data = $this->model->getData('user',array('user_id'=>$user_id));

			if(isset($user_data) && !empty($user_data)){
				$update_data = array(
					'user_id' =>$user_id,
					'full_name' =>$full_name,
					'email_address' =>$email_address,
					'gender' =>$gender,
					'date_of_birth' => $date_of_birth,
				);

				$this->model->updateData('user',$update_data,array('user_id'=>$user_id));

				$user_data = $this->model->getData('user',array('user_id'=>$user_id));
				$data['user_id'] = $user_data[0]['user_id'];
				$data['full_name'] = $user_data[0]['full_name'];
				$data['email_address'] = $user_data[0]['email_address'];
				$data['gender'] = $user_data[0]['gender'];
				$data['wallet_balance'] = $this->wallet_balance($user_data[0]['user_id']);

				$date_of_birth = $user_data[0]['date_of_birth'];
				$data['date_of_birth'] = ($date_of_birth!="" && $date_of_birth!='0000-00-00')? date('d-m-Y',strtotime($date_of_birth)) : '' ;

				$data['status'] = '1';
				$data['msg'] = 'Profile data has been updated successfully.';
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Un Authorised user.';	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invalid required parameter sent.';
		}
		echo json_encode($data);
	}



	// function signup(){
	// 	$full_name = $this->input->get_post('full_name');
	// 	$email_address =  $this->input->get_post('email_address');
	// 	$password = $this->input->get_post('password');
	// 	$mobile_number =  $this->input->get_post('mobile_number');
	// 	$gender =  $this->input->get_post('gender');
	// 	$gcm_id =  $this->input->get_post('gcm_id');

	// 	if($full_name!='' && $email_address!='' && $password!='' && $mobile_number!='' && $gender!=''){
	// 		$email_info=$this->model->getData('user',array('email_address'=>$email_address));
	// 		$mobile_info=$this->model->getData('user',array('mobile_number'=>$mobile_number));
			
	// 		if(isset($email_info) && empty($email_info)){
	// 			if(isset($mobile_info) && empty($mobile_info)){
	// 				$array_data=array(
	// 					'full_name'=>$full_name,
	// 					'email_address'=>$email_address,
	// 					'password'=>md5($password),
	// 					'mobile_number'=>$mobile_number,
	// 					'gender'=>$gender,
	// 					'gcm_id'=>$gcm_id,
	// 					'registration_date'=>date('Y-m-d H:i:s'),
	// 				);
	// 				$user_inserted_id=$this->model->insertData('user',array_map('strtoupper', $array_data));

	// 				if($user_inserted_id){
	// 					$user_info=$this->model->getData('user',array('user_id'=>$user_inserted_id));
	// 					$data['user_id'] = $user_info[0]['user_id'];
	// 					$data['full_name'] = $user_info[0]['full_name'];
	// 					$data['email_address'] = $user_info[0]['email_address'];
	// 					$data['mobile_number'] = $user_info[0]['mobile_number'];
	// 					$data['gender'] = $user_info[0]['gender'];
	// 					$data['gcm_id'] = $user_info[0]['gcm_id'];
	// 					$data['registration_date'] = $user_info[0]['registration_date'];
	// 					$data['wallet_balance'] = $this->wallet_balance($user_info[0]['user_id']);
	// 					$data['status'] = '1';
	// 					$data['msg'] = 'Your account has been registered successfully.';
	// 				}else{
	// 					$data['status'] = '0';
	// 					$data['msg'] = 'Error while signing up. please try again.';
	// 				}
	// 			}else{
	// 				$data['status'] = '0';
	// 				$data['msg'] = 'Mobile number is already registered with us';
	// 			}
	// 		}else{
	// 			$data['status'] = '0';
	// 			$data['msg'] = 'Email address is already registered with us. Please enter unique email address';
	// 		}
	// 	}else{
	// 		$data['status'] = '0';
	// 		$data['msg'] = 'Required parameters are missing.';
	// 	}
	// 	echo json_encode($data);	
	// }

	function validate_otp_confirmation(){
		$mobile_number = $this->input->get_post('mobile_number');
		$otp_code = $this->input->get_post('otp_code');
		if($mobile_number!="" && $otp_code!=""){
			$user_data = $this->model->getData('user',array('mobile_number'=>$mobile_number));
			if(isset($user_data) && !empty($user_data)){
				if($user_data[0]['otp_code']==$otp_code){
					$data['user_id'] = $user_data[0]['user_id'];
					$data['full_name'] = $user_data[0]['full_name'];
					$data['email_address'] = $user_data[0]['email_address'];
					$data['mobile_number'] = $user_data[0]['mobile_number'];
					$data['gender'] = $user_data[0]['gender'];
					$data['gcm_id'] = $user_data[0]['gcm_id'];
					$data['registration_date'] = $user_data[0]['registration_date'];
					$data['wallet_balance'] = $this->wallet_balance($user_info[0]['user_id']);

					$data['addresses'] = array();
					$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_data[0]['user_id'],'status'=>'1'));
					if(isset($address_data) && !empty($address_data)){
						foreach ($address_data as $key => $value) {
							$data['addresses'][$key]['address_id'] = $value['address_id'];
							$data['addresses'][$key]['user_id'] = $value['user_id'];
							$data['addresses'][$key]['full_name'] = $value['full_name'];
							$data['addresses'][$key]['mobile_number'] = $value['mobile_number'];
							$data['addresses'][$key]['email_address'] = $value['email_address'];
							$data['addresses'][$key]['address1'] = $value['address1'];
							$data['addresses'][$key]['address2'] = $value['address2'];
							$data['addresses'][$key]['landmark_nearest_area'] = $value['landmark_nearest_area'];
							$data['addresses'][$key]['town_city'] = $value['town_city'];
							$data['addresses'][$key]['pincode'] = $value['pincode'];
							$data['addresses'][$key]['added_on'] = $value['added_on'];
						}
					}
					$data['status'] = '1';
					$data['msg'] = 'You have logged in successfully';
					$this->model->updateData('user',array('is_mobile_verified'=>'1'),array('mobile_number'=>$mobile_number));
				}else{
					$data['status'] = '0';
					$data['msg'] = 'Invalid OTP code is entered.';
				}
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Invalid mobile number.';
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invadli parameter sent';
		}
		echo json_encode($data);
	}
	
	function signin(){
		$mobile_number = $this->input->get_post('mobile_number');
		$password = $this->input->get_post('password');
		if($mobile_number!='' && $password!=''){
			$user_data = $this->model->getData('user',array('mobile_number'=>$mobile_number));
			$otpcode = generateRandomCode();
			$otp_code = mt_rand(10000,999999); // 6 digit code //strtoupper(substr($otpcode, 0,6));
			if(isset($user_data) && !empty($user_data)){
				$has_mobile_verified = $user_data[0]['is_mobile_verified'];
				$otp_code =  $user_data[0]['otp_code'];
				if($has_mobile_verified=='1'){
					if($user_data[0]['password']==md5($password)){

						$data['user_id'] = $user_data[0]['user_id'];
						$data['full_name'] = $user_data[0]['full_name'];
						$data['email_address'] = $user_data[0]['email_address'];
						$data['mobile_number'] = $user_data[0]['mobile_number'];
						$data['gender'] = $user_data[0]['gender'];
						$data['gcm_id'] = $user_data[0]['gcm_id'];
						$data['registration_date'] = $user_data[0]['registration_date'];
						$data['wallet_balance'] = $this->wallet_balance($user_data[0]['user_id']);
						$data['addresses'] = array();

						$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_data[0]['user_id'],'status'=>'1'));
						if(isset($address_data) && !empty($address_data)){
							foreach ($address_data as $key => $value) {
								$data['addresses'][$key]['address_id'] = $value['address_id'];
								$data['addresses'][$key]['user_id'] = $value['user_id'];
								$data['addresses'][$key]['full_name'] = $value['full_name'];
								$data['addresses'][$key]['mobile_number'] = $value['mobile_number'];
								$data['addresses'][$key]['email_address'] = $value['email_address'];
								$data['addresses'][$key]['address1'] = $value['address1'];
								$data['addresses'][$key]['address2'] = $value['address2'];
								$data['addresses'][$key]['landmark_nearest_area'] = $value['landmark_nearest_area'];
								$data['addresses'][$key]['town_city'] = $value['town_city'];
								$data['addresses'][$key]['pincode'] = $value['pincode'];
								$data['addresses'][$key]['added_on'] = $value['added_on'];
							}
						}

						$data['status'] = '1';
	              		$data['msg'] = 'You have logged in successfully.';
	              	}else{
	              		$data['status'] = '0';
	              		$data['msg'] = 'Invalid user name and password entered.';
	              	}
				}else{
					//$this->send_otp_confirmation($mobile_number,$otp_code);
					$data['user_id'] = $user_data[0]['user_id'];
					$data['otp_code'] = $otp_code;
					$data['mobile_number'] = $mobile_number;
					$data['status'] = '2';
					$data['msg']="Your mobile number verification is still pending. Please enter the OTP sent on your mobile.";
				}
			}else{
				$user_data = $this->model->getData('user',array('mobile_number'=>$mobile_number));
				if(isset($user_data) && empty($user_data)){
				$this->model->insertData('user',array('otp_code'=>$otp_code,'mobile_number'=>$mobile_number,'password'=>md5($password),'registration_date'=>date('Y-m-d H:i:s')));
					$this->send_otp_confirmation($mobile_number,$otp_code);
					$data['mobile_number'] = $mobile_number;
					$data['otp_code'] = $otp_code;
					$data['status'] = '2';
					$data['msg']="Your mobile number is not registered with us. To verify your mobile number. ".$mobile_number." plz enter OTP sent on your mobile..";
				}
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Required parameters are missing.';
		}
		echo json_encode($data);
	}

	function send_otp_confirmation($mobile_no,$otp_code){
		/*echo $mobile_no = $this->input->get_post('mobile_no');
		echo $otp_code = $this->input->get_post('otp_code');*/
		if($mobile_no!="" && $otp_code!=""){
			$text_message = $otp_code." is your One Time Password(OTP) to verify your mobile no at Directfarm.in. Thx, directfarm.in";
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
	
	function get_product_list(){
		$category_list = $this->model->getData('category',array('status'=>'1'));
		if(isset($category_list) && !empty($category_list)){
			$data['data'] = array();

			$slider_data = $this->model->getData('slider_info',array('status'=>'1'));
			if(isset($slider_data) && !empty($slider_data)){
				foreach ($slider_data as $sd_key => $sd_value) {
					$data['slider'][$sd_key]['slider_id'] = $sd_value['slider_id'];
					$data['slider'][$sd_key]['image_name'] = base_url().'assets/images/sliders/'.$sd_value['image_name'];
				}
			}
			foreach ($category_list as $ckey => $cvalue) {
				$data['data'][$ckey]['category_id'] = $cvalue['category_id'];
				$data['data'][$ckey]['category_name'] = strtoupper($cvalue['category_name']);
				$data['data'][$ckey]['category_image'] = base_url().'category_image/'.str_replace(' ', '_', strtolower(trim($cvalue['category_name']))).'.jpg';
				$category_products = $this->model->getData('product',array('category_id'=>$cvalue['category_id'],'status'=>'1'));
				if(isset($category_products) && !empty($category_products)){
					$pk= 0;
					foreach ($category_products as $cpkey => $cpvalue) {
						if($cpvalue['unit_id']>0 ){
							$unit_title = '';
							$unit_data = $this->model->getData('product_unit',array('unit_id'=>$cpvalue['unit_id']));

							if(isset($unit_data) && !empty($unit_data)){
								$unit_title = $unit_data[0]['abbrivation'];
							}
							$product_wise_price = unit_wise_price($cpvalue['unit_id'],$cpvalue['price']);

							//print_array($product_wise_price);
							
							$data['data'][$ckey]['product'][$pk]['product_id'] = $cpvalue['product_id'];
							$data['data'][$ckey]['product'][$pk]['product_name'] = strtoupper($cpvalue['product_name']);

							$data['data'][$ckey]['product'][$pk]['category_id'] = $cpvalue['category_id'];
							$data['data'][$ckey]['product'][$pk]['image_name'] = base_url().'products/'.$cpvalue['image_name'];
							$data['data'][$ckey]['product'][$pk]['price'] = $cpvalue['price'];
							$data['data'][$ckey]['product'][$pk]['old_price'] = $cpvalue['old_price'];
							$data['data'][$ckey]['product'][$pk]['unit'] = $cpvalue['unit_id'];
							$data['data'][$ckey]['product'][$pk]['unit_title'] = $unit_title;
							$data['data'][$ckey]['product'][$pk]['listed_in_super_deal'] = $cpvalue['listed_in_super_deal'];

							/*$data['data'][$ckey]['product'][$pk]['description'] = $cpvalue['description'];*/
							$data['data'][$ckey]['product'][$pk]['stock_status'] = $cpvalue['stock_status'];
							$data['data'][$ckey]['product'][$pk]['status'] = $cpvalue['status'];
							$data['data'][$ckey]['product'][$pk]['product_price'] = $product_wise_price;

							$pk++;
						}
					}
				}else{
					$data['data'][$ckey]['status'] = '0';
					$data['data'][$ckey]['msg'] = 'No product found for this category';
				}
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'No category list present';
		}

		echo json_encode($data);
	}

	function add_my_addresses(){
		$user_id = $this->input->get_post('user_id');
		$full_name = $this->input->get_post('full_name');
		$mobile_number = $this->input->get_post('mobile_number');
		$address1 = $this->input->get_post('address1');
		$address2 = $this->input->get_post('address2');
		$address_type = $this->input->get_post('address_type');
		//$town_city = $this->input->get_post('town_city');
		$pincode = $this->input->get_post('pincode');

		if($user_id!="" && $full_name!="" && $address1!="" && $pincode!=""){

			$address_data = array(
				'user_id'=>$user_id,
				'full_name'=>$full_name,
				'mobile_number'=>$mobile_number,
				'address1'=>$address1,
				'address2'=>$address2,
				//'landmark_nearest_area'=>$landmark_nearest_area,
				'address_type'=>$address_type,
				'pincode'=>$pincode,
			);
			$address_id = $this->model->insertData('user_addresses',$address_data);
			
			$data['addresses'] = array();
			$address_data = $this->model->getDataOrderBy('user_addresses',array('user_id'=>$user_id,'status'=>'1'),'added_on','desc');
			if(isset($address_data) && !empty($address_data)){
				foreach ($address_data as $key => $value) {
					$data['addresses'][$key]['address_id'] = $value['address_id'];
					$data['addresses'][$key]['user_id'] = $value['user_id'];
					$data['addresses'][$key]['full_name'] = $value['full_name'];
					$data['addresses'][$key]['mobile_number'] = $value['mobile_number'];
					$data['addresses'][$key]['email_address'] = $value['email_address'];
					$data['addresses'][$key]['address1'] = $value['address1'];
					$data['addresses'][$key]['address2'] = $value['address2'];
					$data['addresses'][$key]['landmark_nearest_area'] = $value['landmark_nearest_area'];
					$data['addresses'][$key]['town_city'] = $value['town_city'];
					$data['addresses'][$key]['pincode'] = $value['pincode'];
					$data['addresses'][$key]['added_on'] = $value['added_on'];
				}
			}

			$data['status'] = '1';
			$data['msg'] = 'New Address has been saved successfully';

		}else{
			$data['status'] = '0';
			$data['msg'] = 'Required parameter are missing.';
		}
		echo json_encode($data);
	}

	function edit_address(){
		$address_id = $this->input->get_post('address_id');
		$user_id = $this->input->get_post('user_id');
		$full_name = $this->input->get_post('full_name');
		$mobile_number = $this->input->get_post('mobile_number');
		$address1 = $this->input->get_post('address1');
		$address2 = $this->input->get_post('address2');
		$landmark_nearest_area = $this->input->get_post('landmark_nearest_area');
		$town_city = $this->input->get_post('town_city');
		$pincode = $this->input->get_post('pincode');

		if($address_id!="" && $user_id!=""){
			$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_id,'address_id'=>$address_id));
			if(isset($address_data) && !empty($address_data)){
					$update_address = array(
						'full_name'=>$full_name,
						'mobile_number'=>$mobile_number,
						'address1'=>$address1,
						'address2'=>$address2,
						'landmark_nearest_area'=>$landmark_nearest_area,
						'town_city'=>$town_city,
						'pincode'=>$pincode,
					);
				$this->model->updateData('user_addresses',$update_address,array('address_id'=>$address_id));
				$data['status'] = '1';
				$data['msg'] = 'Address has been updated successfully';

				$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_id,'status'=>'1'));
				if(isset($address_data) && !empty($address_data)){
					foreach ($address_data as $key => $value) {
						$data['addresses'][$key]['address_id'] = $value['address_id'];
						$data['addresses'][$key]['user_id'] = $value['user_id'];
						$data['addresses'][$key]['full_name'] = $value['full_name'];
						$data['addresses'][$key]['mobile_number'] = $value['mobile_number'];
						$data['addresses'][$key]['email_address'] = $value['email_address'];
						$data['addresses'][$key]['address1'] = $value['address1'];
						$data['addresses'][$key]['address2'] = $value['address2'];
						$data['addresses'][$key]['landmark_nearest_area'] = $value['landmark_nearest_area'];
						$data['addresses'][$key]['town_city'] = $value['town_city'];
						$data['addresses'][$key]['pincode'] = $value['pincode'];
						$data['addresses'][$key]['added_on'] = $value['added_on'];
					}
				}

			}else{
				$data['status'] = '0';
				$data['msg'] = "Invalid address.";
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Address and user id are missing.';
		}
		echo json_encode($data);
	}

	function delete_my_address(){
		$user_id = $this->input->get_post('user_id');
		$address_id = $this->input->get_post('address_id');

		if($user_id!="" && $address_id!=""){
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
			$data['msg'] = "Invalid address.";	
		}
		echo json_encode($data);
	}

	function my_orders(){
		$user_id = $this->input->get_post('user_id');
		if($user_id!=""){
			$order_data = $this->model->getDataOrderBy('order_data',array('user_id'=>$user_id,'status'=>'1'),'order_date_time','desc');
			$data['order_data'] = array();
			if(isset($order_data) && !empty($order_data)){
				foreach ($order_data as $key => $value) {
					$data['order_data'][$key]['order_id'] = $value['order_id'];
					$data['order_data'][$key]['order_number'] = $value['order_number'];
					$data['order_data'][$key]['total_amount'] = $value['total_amount'];
					$data['order_data'][$key]['order_date_time'] = $value['order_date_time'];
					$data['order_data'][$key]['status'] = $value['status'];

					$data['order_data'][$key]['order_details'] = array();
					$order_details = $this->model->getData('order_data_details',array('order_number'=>$value['order_number']));
					if(isset($order_details) && !empty($order_details)){
						foreach ($order_details as $od_key => $od_value) {
							$product_data = $this->model->getData('product',array('product_id'=>$od_value['product_id']));
							$data['order_data'][$key]['order_details'][$od_key]['product_name'] = $product_data[0]['product_name'];
							$data['order_data'][$key]['order_details'][$od_key]['image_name'] = base_url().'products/'.$product_data[0]['image_name'];
							$data['order_data'][$key]['order_details'][$od_key]['qty'] = $od_value['qty'];
							$data['order_data'][$key]['order_details'][$od_key]['price'] = $od_value['price'];
							$data['order_data'][$key]['order_details'][$od_key]['unit_total'] = $od_value['unit_total'];
						}
					}
				}
			}else{
				$data['status'] = '0';
				$data['msg'] = "No Order found.";	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = "Invalid required parameters.";	
		}

		if(!empty($data['order_data'])){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}

	   function place_order_via_netbanking_wallet(){
		$jsonObj = $this->input->get_post('jsonObj');
		$jsonObj = stripslashes($jsonObj);
		$user_object = json_decode($jsonObj,true); 
		//print_array($user_object);

		if(isset($user_object) && !empty($user_object)){
			
			$order_data = $user_object['order_data'];

			$user_id = $order_data['user_id'];
			$address_id= $order_data['address_id'];
			$delivery_date= $order_data['delivery_date'];
			$delivery_time= $order_data['delivery_time'];
			$total_amount= $order_data['total_amount'];
			$mPaymentType = $order_data['mPaymentType'];
			$net_banking_amount = $order_data['net_banking_amount'];

			$cod_amount = $order_data['cod_amount'];
			$wallet_amount = $order_data['wallet_amount'];
			$offer_code = $order_data['offer_code'];
			$paymentId = $order_data['paymentId'];
			$order_details= $order_data['order_details'];
			$delivery_charges= isset($order_data['delivery_charges']) ? $order_data['delivery_charges']:'' ;
			
			if($user_id>0){

				$orderNo = 'DF'.date('ymd').time();
				$user_data = $this->model->getData('user',array('user_id'=>$user_id));
				$user_name = ($user_data[0]['full_name']!='') ? $user_data[0]['full_name'] : $user_data[0]['mobile_number'];


				if(isset($order_details) && !empty($order_details)){
					$order_data = array(
						'user_id'=>$user_id,
						'order_number'=>$orderNo,
						'total_amount'=>$total_amount,
						'after_discounted_amount'=>$total_amount,
						'address_id'=>$address_id,
						'offer_code'=>$offer_code,
						'delivery_charges'=>$delivery_charges,
						'user_expected_order_date'=>date('Y-m-d',strtotime($delivery_date)),
						'user_expected_order_time_slot'=>$delivery_time,
						'order_date_time'=>date('Y-m-d H:i:s'),
						'order_source'=>'2',

						'payment_status'=>'APP',
						'payment_method'=>$mPaymentType,

						'app_cod_amount'=>$cod_amount,
						'app_payment_id'=>$paymentId,
						'app_wallet_amount'=>$wallet_amount,
						'app_netbanking_amount'=>$net_banking_amount,
					);
					//print_array($order_data);

					$order_id = $this->model->insertData('order_data',$order_data);

					foreach ($order_details as $key => $value) {
						$product_data = $this->model->getData('product',array('product_id'=>$value['product_id']));
						//$unit_total = upto2Decimal($value['product_quantity']*$price);*/
						//$price = $value['price'];
						//$exact_qty = gram_to_kg($product_data[0]['unit_id'],);
						
						$price = $value['price']; 
						$unit_total = $value['unit_total'];
						$qty = $value['product_quantity'];

						$array_cart_item=array(
							'user_id'=>$user_id,
							'order_id'=>$order_id,
							'order_number'=>$orderNo,
							'product_id'=>$value['product_id'],
							'qty'=> $qty,
							'price'=>$price,
							'unit_total'=>$unit_total,
						);
						$this->model->insertData('order_data_details',$array_cart_item);
					}

					if($wallet_amount>0){
						$txn_no  = generateRandomString();
		                $wallet_array = array(
		                    'txn_no'=>$txn_no,
		                    'user_id'=>$user_id,
		                    'offer_code'=>'PAID_FROM_APP',
		                    'wallet_amount'=>$wallet_amount,
		                    'order_number'=>$orderNo,
		                    'date'=>date('Y-m-d'),
		                    'txn_type'=>'2',//2:debit-Gaya
		                );
		                $this->model->insertData('wallet_txn',$wallet_array);
					}

					$this->send_order_confirmation_mail($order_id,$address_id);
					$this->sms_order_confirmation_to_user($order_id,$user_data[0]['mobile_number'],$user_name);
			        $this->sms_order_confirmation_to_admin($order_id,'9029921216',$user_name);

					$data['status'] = '1';
					$data['msg'] = 'Your order number <br><br> #'.$orderNo.' <br><br>has been placed successfully.';

					$total_wallet_balance =$this->model->wallet_balance($user_id);
					$data['wallet_balance'] = $total_wallet_balance;

				}else{
					$data['status'] = '0';
					$data['msg'] = 'Order details are empty.';
				}
			}else{
				$data['status'] = '0';
				$data['msg'] = 'User id is missing . Please do login/signup and try again';
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invalid json data sent.';
		}
		echo json_encode($data);

	}


	function create_order(){
		$jsonObj = $this->input->get_post('jsonObj');
		$jsonObj = stripslashes($jsonObj);
		$user_object = json_decode($jsonObj,true); 
		
		//print_array($user_object);
		if(isset($user_object) && !empty($user_object)){
			$orderNo = 'DF'.date('Ymd').time();
			$order_data = $user_object['order_data'];
			$user_id = $order_data['user_id'];
			$address_id= $order_data['address_id'];
			$delivery_date= $order_data['delivery_date'];
			$delivery_time= $order_data['delivery_time'];
			$total_amount= $order_data['total_amount'];
			$delivery_charges= $order_data['delivery_charges'];

			$order_details= $order_data['order_details'];
			
			$user_data = $this->model->getData('user',array('user_id'=>$user_id));

			if(isset($order_details) && !empty($order_details)){
				
				$order_data = array(
					'user_id'=>$user_id,
					'order_number'=>$orderNo,
					'total_amount'=>$total_amount,
					'delivery_charges'=>$delivery_charges,
					'after_discounted_amount'=>$total_amount,
					'payment_method'=>'COD',
					'address_id'=>$address_id,
					'user_expected_order_date'=>date('Y-m-d',strtotime($delivery_date)),
					'user_expected_order_time_slot'=>$delivery_time,
					'order_date_time'=>date('Y-m-d H:i:s'),
					'order_source'=>'2',
				);
				$order_id = $this->model->insertData('order_data',$order_data);

				foreach ($order_details as $key => $value) {
					$product_data = $this->model->getData('product',array('product_id'=>$value['product_id']));
					$price = $product_data[0]['price'];
					$unit_total = upto2Decimal($value['product_quantity']*$price);
					
					$array_cart_item=array(
						'user_id'=>$user_id,
						'order_id'=>$order_id,
						'order_number'=>$orderNo,
						'product_id'=>$value['product_id'],
						'qty'=>$value['product_quantity'],
						'price'=>$price,
						'unit_total'=>$unit_total,
					);
					$this->model->insertData('order_data_details',$array_cart_item);
				}

				$this->send_order_confirmation_mail($order_id,$address_id);
				$this->sms_order_confirmation_to_user($order_id,$user_data[0]['mobile_number'],$user_data[0]['full_name']);
		        $this->sms_order_confirmation_to_admin($order_id,'9029921216',$user_data[0]['full_name']);

				$data['status'] = '1';
				$data['msg'] = 'Your order number <br><br> #'.$orderNo.' <br><br>has been placed successfully.';
				
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Order details has not found.';
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invalid parameter send';
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
              
                $text_message = "Dear Admin, We have received new order no ".$order_no.". from MOBILE APP with total billed amount Rs. ".$total_amount." from ".$customer_name.". Plz check mail.";

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

				$total_amount =  $order_data[0]['total_amount'];

				$item_in_cart = '';
				$order_details = $this->model->getData('order_data_details',array('order_number'=>$order_number));
				if(isset($order_details) && !empty($order_details)){
					foreach ($order_details as $key => $value) {
						$product_details = $this->model->getData('product',array('product_id'=>$value['product_id']));
						$item_in_cart.='<tr><td>'.++$key.'</td><td>'.$product_details[0]['product_name'].'</td><td>'.$value['qty'].'</td>
						<td align="right">'.$value['price'].'</td><td align="right">'.$value['unit_total'].'</td></tr>';
					}
				}
				
				$subject = 'Cancellation of your Order #'.$order_number.' on DirectFarm.in';
				$emailer = 'emailer/order_cancellation.html';
				$mail_content = file_get_contents($emailer);

				$mail_content = str_replace('@_user_name_@', $user_name, $mail_content);
				$mail_content = str_replace('@_order_number_@', $order_number, $mail_content);
				$mail_content = str_replace('@_total_amount_@', $total_amount, $mail_content);
				$mail_content = str_replace('@_item_in_cart_@', $item_in_cart, $mail_content);
							
				$headers = 'From: DirectFarm <orders@directfarm.in>' . "\r\n" .
				    		'Reply-To: orders@directfarm.in' . "\r\n" .
				    		"MIME-Version: 1.0\r\n".
							"Content-Type: text/html; charset=ISO-8859-1\r\n";
							'X-Mailer: PHP/';

				mail($to_email_address, $subject, $mail_content, $headers);
			}
		}
	}

	function sync_product_to_outlet(){
		$product_list = $this->model->selectData('product','product_id,category_id,sub_category_id,product_name,unit_id,image_name,price,old_price,listed_in_super_deal,status,stock_status');
		echo json_encode($product_list);
	}


	function search_by_product_name($value='')
	{
		$product_name = $this->input->get_post('product_name');
		$product_data = $this->model->get_like_data('product','product_name',$product_name);
		$data = array();
		if(isset($product_data) && !empty($product_data)){
			$data['status'] = '1';
			$data['msg'] = count($product_data).' Records found';

			foreach ($product_data as $ckey => $cvalue) {
				$category_data = $this->model->getData('category',array('category_id'=>$cvalue['category_id']));
				$sub_category_data = $this->model->getData('subcategory',array('sub_category_id'=>$cvalue['sub_category_id']));

				$data['data'][$ckey]['category_id'] = $cvalue['category_id'];
				$data['data'][$ckey]['category_name'] = $category_data[0]['category_name'];
				$data['data'][$ckey]['sub_category_id'] = $cvalue['sub_category_id'];
				$data['data'][$ckey]['sub_category_name'] = $sub_category_data[0]['sub_category_name'];

				$data['data'][$ckey]['product_id'] = $cvalue['product_id'];
				$data['data'][$ckey]['product_name'] = strtoupper($cvalue['product_name']);
				$data['data'][$ckey]['category_id'] = $cvalue['category_id'];
				$data['data'][$ckey]['image_name'] = base_url().'products/'.$cvalue['image_name'];
				$data['data'][$ckey]['price'] = $cvalue['price'];
				$data['data'][$ckey]['old_price'] = $cvalue['old_price'];
				$data['data'][$ckey]['unit'] = $cvalue['unit_id'];
				$data['data'][$ckey]['listed_in_super_deal'] = $cvalue['listed_in_super_deal'];

				$data['data'][$ckey]['description'] = $cvalue['description'];
				$data['data'][$ckey]['stock_status'] = $cvalue['stock_status'];
				$data['data'][$ckey]['status'] = $cvalue['status'];
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = count($product_data).' Record found';
		}
		echo json_encode($data);
	}

	function get_profile_data(){
		$user_id = $this->input->get_post('user_id');
		if(isset($user_id) && $user_id!=""){
			$user_data = $this->model->getData('user',array('user_id'=>$user_id));
			if(isset($user_data) && !empty($user_data)){
					$data['user_id'] = $user_data[0]['user_id'];
					$data['full_name'] = $user_data[0]['full_name'];
					$data['email_address'] = $user_data[0]['email_address'];
					$data['mobile_number'] = $user_data[0]['mobile_number'];
					$data['gender'] = $user_data[0]['gender'];
					$data['wallet_balance'] = $this->wallet_balance($user_data[0]['user_id']);

					$date_of_birth = $user_data[0]['date_of_birth'];
					$data['date_of_birth'] = ($date_of_birth!="" && $date_of_birth!='0000-00-00')? date('d-m-Y',strtotime($date_of_birth)) : '' ;

					$data['status'] = '1';
					$data['msg'] = 'User data found.';	
				
			}else{
				$data['status'] = '0';
				$data['msg'] = 'Invalid user data.';	
			}
		}else{
			$data['status'] = '0';
			$data['msg'] = 'Invalid required parameters are sent.';
		}
		echo json_encode($data);
	}

	// function update_profile(){
	// 	$user_id = $this->input->get_post('user_id');
	// 	$full_name = $this->input->get_post('full_name');
	// 	$email_address = $this->input->get_post('email_address');
	// 	$gender = $this->input->get_post('gender');
	// 	$date_of_birth = $this->input->get_post('date_of_birth');

	// 	if($user_id!="" && $full_name!="" && $email_address!="" && $gender!="" && $date_of_birth!=""){
	// 		$user_data = $this->model->getData('user',array('user_id'=>$user_id));
	// 		if(isset($user_data) && !empty($user_data)){
	// 			$update_data = array(
	// 				'user_id' =>$user_id,
	// 				'full_name' =>$full_name,
	// 				'email_address' =>$email_address,
	// 				'gender' =>$gender,
	// 				'date_of_birth' => $date_of_birth,
	// 			);

	// 			$this->model->updateData('user',$update_data,array('user_id'=>$user_id));

	// 			$user_data = $this->model->getData('user',array('user_id'=>$user_id));
	// 			$data['user_id'] = $user_data[0]['user_id'];
	// 			$data['full_name'] = $user_data[0]['full_name'];
	// 			$data['email_address'] = $user_data[0]['email_address'];
	// 			$data['gender'] = $user_data[0]['gender'];
	// 			$data['wallet_balance'] = $this->wallet_balance($user_data[0]['user_id']);

	// 			$date_of_birth = $user_data[0]['date_of_birth'];
	// 			$data['date_of_birth'] = ($date_of_birth!="" && $date_of_birth!='0000-00-00')? date('d-m-Y',strtotime($date_of_birth)) : '' ;

	// 			$data['status'] = '1';
	// 			$data['msg'] = 'Profile data has been updated successfully.';
	// 		}else{
	// 			$data['status'] = '0';
	// 			$data['msg'] = 'Un Authorised user.';	
	// 		}
	// 	}else{
	// 		$data['status'] = '0';
	// 		$data['msg'] = 'Invalid required parameter sent.';
	// 	}
	// 	echo json_encode($data);
	// }

	// function get_addresses(){
	// 	$user_id = $this->input->get_post('user_id');
	// 	if(isset($user_id) && !empty($user_id)){
	// 		$address_data = $this->model->getData('user_addresses',array('user_id'=>$user_id,'status'=>'1'));
	// 		if(isset($address_data) && !empty($address_data)){
	// 			foreach ($address_data as $key => $value) {
	// 				$data['addresses'][$key]['address_id'] = $value['address_id'];
	// 				$data['addresses'][$key]['user_id'] = $value['user_id'];
	// 				$data['addresses'][$key]['full_name'] = $value['full_name'];
	// 				$data['addresses'][$key]['mobile_number'] = $value['mobile_number'];
	// 				$data['addresses'][$key]['email_address'] = $value['email_address'];
	// 				$data['addresses'][$key]['address1'] = $value['address1'];
	// 				$data['addresses'][$key]['address2'] = $value['address2'];
	// 				$data['addresses'][$key]['landmark_nearest_area'] = $value['landmark_nearest_area'];
	// 				$data['addresses'][$key]['town_city'] = $value['town_city'];
	// 				$data['addresses'][$key]['pincode'] = $value['pincode'];
	// 				$data['addresses'][$key]['added_on'] = $value['added_on'];
	// 			}
	// 			$data['status'] = '1';
	// 			$data['msg'] = 'User address found.';
	// 		}else{
	// 			$data['status'] = '0';
	// 			$data['msg'] = 'No addresses found.';
	// 		}
	// 	}else{
	// 		$data['status'] = '0';
	// 		$data['msg'] = 'Invalid required parameter sent.';
	// 	}
	// 	echo json_encode($data);
	// }
	function get_address_data(){
		$user_id = $this->input->get_post('user_id');
		if(isset($user_id) && $user_id!=""){

			$data['address_data'] = $this->model->getData('user_addresses',array('user_id'=>$user_id,'status'=>'1'));
	
		}
		if(!empty($data['address_data'])){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}

	function about_direct_farm(){
		$data['about_us'] = base64_encode("<p>Directfarm.in is prefered destination for buying fresh fruits & vegetables online in Navi Mumbai only, offering fresh and best prices and a completely hassle-free experience with options of paying through cash on delivery (COD).</p><p> Now shop for your daily fresh vegetables & fruits needs with descriptions and get the best online shopping experience every time.");

		$data['contact_us'] = base64_encode("<p>Directfarm.in<br>Shop no 6, Plot no 32,<br>Trishul Annex, Koparkhairane,<br>Navi Mumbai - 400 709 <br> <b>Ph No</b>: +91 90299 21216 <br><b>Email Address: </b>support@directfarm.in");

		$data['term_conditions'] = base64_encode("By accessing and browsing DirectFarm.in or by using and/or downloading any content from the site, it is assumed that you agree and accept Terms and Conditions of our site. If you do not agree with them, please do not use the Site. We reserve the right, at our discretion, to change, modify, add or remove portions of these terms and conditions at any time. Please check this page periodically for changes. Unless the law requires otherwise, your continued use of the Site will mean that you accept those changes. <br><br><h3>Ownership of rights</h3> All rights including copyright, in this Site are owned by DirectFarm.in. Using the Site and its content for any use excluding personal or non commercial use is prohibited without taking any prior permission from the company. Any comments you submit to us through the Site, such as remarks, suggestions, ideas, graphics, or other information becomes and remains our exclusive property, even if this agreement is later terminated. This means that we do not have to treat any such submission (including, but not limited to, product or advertising ideas) as confidential. We will not pay you or anyone else for any information that you provide which is used by us. Note that any information, materials, ideas, suggestions or comments sent to us will be considered as non-confidential. By submitting this information, you are conceding DirectFarm.in a permanent and unlimited license to modify, use, display, reproduce, transmit and distribute such information, suggestions, ideas or comments for any purpose. Additionally, you acknowledge that you have full responsibility for any such submission you make, including its legality, reliability, appropriateness, originality, and copyright. This DOES NOT apply to any orders that you place on our Site. <br><br><h3>Accuracy of content and invitation to offer</h3> Our team has taken every possible precaution in preparing the content of this Site, particularly to ensure that the quoted prices are correct at time of publishing and also that all products are fairly described. Products will mostly be as seen on the site. We therefore make every possible effort to show as accurate as possible the colors of our products as they appear on the Site. However, as the actual colors you see will vary as per your monitor, hence we are not responsible if the color of the product in actual varied from the color as seen on the Site. We cannot guarantee complete 100% accuracy with regards to the product description offered on the site. DirectFarm.in will not be liable for any damages or injury, including but not limited to direct, indirect, incidental, punitive and consequential damages that accompany or result from your use of our site or any other Site. These include (but are not limited to) damages or injury caused by any use of (or inability to use) our site or any other Site to which you hyperlink or share link (as described above) from our site, failure of performance, error, omission, inaccuracy, interruption, defect, delay in operation or transmission, computer virus, or line failure. Furthermore, DirectFarm.in is not liable even if we've been negligent or if our authorized representative has been advised of the possibility of such damages. Exception in certain states the law may not allow the limitation or exclusion of liability for these 'incidental' or 'consequential' damages, so the above limitation may not apply. This site may contain typographical errors or inaccuracies and may not be complete or current. DirectFarm.in therefore reserves the right to correct any errors, inaccuracies or omissions (including after an order has been submitted) and to change or update information at any time without prior notice. Please note that such errors, inaccuracies or omissions may relate to pricing and availability. We apologize for any inconvenience. The site content is provided on an 'as is' 'as available' basis and without representations or warranties of any kind, either express or implied, as to the operation of the site, the information, content, materials or products included on this site. To the fullest extent permissible pursuant to applicable law, DirectFarm.in disclaims all representations and warranties with respect to this site or its contents, whether express or implied or statutory, including, but not limited to, warranties of title, merchantability and fitness for a particular purpose. Please be advised that to the extent that DirectFarm.in provides any content from third parties, such content is provided for informational purposes only and DirectFarm.in cannot and does not investigate the legitimacy, validity, accuracy and legality of the items listed and expressly disclaims any responsibility or liability arising out of or relating to any third party content listed. <br><br><h3>Account and Registration Obligations</h3> All personal information provided during registration is kept secured to the fullest extent possible. DirectFarm.in is not liable to any person for any damage or loss occurred due to your failure to protect your password or account. If you feel that someone else is aware of your password or suspect any unauthorized use of your password it is your duty to inform us by sending an email at support@DirectFarm.in. If we feel there are possibilities of breach of security or misuse of the Site, we ask you to change your password or simply suspend your account. - You must agree and confirm - To provide true, accurate, current and complete personal information while registering with us - To maintain and update the Registration Data to keep accurate, up-to-date and complete. If you provide any untrue, inaccurate or incomplete information, DirectFarm.in reserves the right to suspend your account. <br><br><h3>Usage Restrictions</h3> You are not permitted to use DirectFarm.in for any of the following purposes Disseminate any unlawful, libelous, harassing, abusive, harmful, vulgar, obscene or otherwise objectionable material Transmit material that encourages criminal offence, results in civil liability or otherwise breaches of any laws Gain unauthorized access to other computer and network systems Breach any applicable laws <br><br><h3>Cancellations</h3> <h3>By DirectFarm.in</h3> We reserve the right to cancel or refuse any order for any reason. Some situations that lead to cancellation of any order include limitation of the quantities available for purchase, error or inaccuracies in product or pricing information and so on. We will notify in case of any such cancellations and the amount charged by your credit or debit card will be reversed back to your Card Account. <br><br><h3>By the customer</h3> You can cancel your order or some items in your order before the item is shipped and the bill is generated. You also have the opportunity to exchange the merchandise or get a refund by returning the item back to us. However returns are accepted only for specific items, excluding perishables, made to order or items of personal hygiene such as under garments or cosmetics, in unused and saleable condition with its original packaging and other original tags. The product must be return or exchanged within 7 days from the date on which these goods are delivered. For additional details read our Returns Policy. We don't accept returns or exchanges for specific toys, fragrances, cosmetics, under garments, gift vouchers, and made to order or altered merchandise. If we receive a cancellation notice for any of these products before the processing of the same then we shall cancel the order and give refund for the entire amount. However, orders placed for gift vouchers cannot be canceled nor returned. <br><br><h3>Copyright & Trademark</h3> All product names and company logos stated here are the trademarks of their respective owners. All REGISTERED MARKS, TRADEMARKS, TRADE NAMES, SALES MARKS, brands, products as well as images by the respective companies that reserve its intellectual property and other rights. We do not offer license of any kind with respect to use of these rights. The use of manufacturer's name, product names, product images, or other registered trademark on our site is merely for brand recognition and model description purpose only. All content including text, images, designs, illustrations, photographs, icons, programs, music clips and other materials available on this Site are intended for personal and non-commercial use. You can copy or download the Contents and other down-loadable materials displayed on DirectFarm.in for your personal use only. You have no right whatsoever to reproduce, transmit, publish, distribute, modify, display, sell or participate in any sale of any of the Content from the Site. <br><br><h3>Security</h3> You are forbidden from attempting to violate or violating the security of DirectFarm.in. It includes accessing data not intended for you or logging onto a server or an account which you are not authorized to access or to breach security or authentication measures without proper authorization and spamming. DirectFarm.in will examine any such occurrences that involve violations and may cooperate with law enforcement authorities in taking legal action against users involved in such violations. You agree not to use any device or software to interfere with the proper working of this Site or activity conducted on the site. <br><br><h3>Modification of Terms and Conditions of Service</h3> DirectFarm.in has the right to modify the Terms and Conditions any time without any prior notification to you. It is your responsibility to check the Terms and Conditions and Privacy Policy periodically for any such changes. If you proceed with the use of the site, it is understood that you comply with the modified terms and conditions. In case you do not agree or accept the changes you can stop using our site. If you have any questions about the Terms & Conditions, the practices of this site or your dealings with this site, please contact us via the Contact Us Page.");

		echo json_encode($data);
	}


	function validate_offer_code(){
       
        $user_id = $this->input->get_post('user_id');
        $offer_code = $this->input->get_post('offer_code');
        $total_amount = $this->input->get_post('total_amount');
        $order_data = $this->input->get_post('order_data');

        $order_object = json_decode($order_data,true); 

        if($user_id>0){
	       
            $user_data = $this->model->getData('user',array('user_id'=>$user_id));
            $mobile_number = $user_data[0]['mobile_number'];

            $session_id = $this->session->userdata('session_id');
           
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
	                        $cat_total_amount = '0'; $dif_amt = '';


	                        if($offer_category!="" && !empty($order_object)){

	                        	//whatever_return($order_object,'',)
	                        	$categgory_ids = explode(',', $offer_category);
	                        	
	                        	foreach ($order_object as $o_key => $o_value) {
	                        		if(in_array($o_value['category_id'], $categgory_ids)){
	                        			$cat_total_amount = $cat_total_amount+$o_value['price'];
	                        		}
	                        	}

	                            $dif_amt = $total_amount-$cat_total_amount;

	                            $product_category = array();
	                            $ofr_cat = explode(',', $offer_category); 
	                            foreach ($ofr_cat as $ofr_key=>$ofr_value){
	                                $cat_data = $this->model->getData('category',array('category_id'=>$ofr_value));
	                                array_push($product_category, $cat_data[0]['category_name']);
	                            }
	                            $category_p_name = implode(',', $product_category);

	                        }

	                        if($total_amount>0){

	                            // check if category based offer
	                            if($cat_total_amount>0){
	                            	//check offer minimum amount
	                                if($total_amount>=$min_amount_purchase){
	                                	if($cat_total_amount<$min_amount_purchase){
	                                		$data['status'] = '0';
	                                		$data['msg'] = 'This is category based offer, minimum billed amount should be Rs. '.$min_amount_purchase.", Your category total is Rs. ".$cat_total_amount.". (".$category_p_name.")";
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
		                                    $data['msg'] = 'Valid coupon code.';
		                                }

	                                }else{
	                                    $data['status'] = '0';
	                                    if($offer_category!=""){
	                                        $data['msg'] = 'This is category based offer, minimum billed amount should be Rs. '.$min_amount_purchase.", Your category total is Rs. ".$cat_total_amount.". (".$category_p_name.")";
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
	                                    $data['msg'] = 'Coupon code is applied successfully.';
	                                }else{
	                                    $data['status'] = '0';
	                                    if($offer_category!=""){
	                                        $data['msg'] = 'This is category based offer, minimum billed amount should be Rs. '.$min_amount_purchase.", Your category total is Rs. ".$cat_total_amount.". (".$category_p_name.")";
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
        		$data['msg'] = 'In order to avail the benefits of the promotional / voucher / offer code, please update your monile number';
	        }
	       
	    }else{
	    	$data['status'] = '0';
	        $data['msg'] = 'In order to avail the benefits of the promotional / voucher / offer code, please Login/Sign Up';
	    }
        echo json_encode($data);
    }


 
	function add_money_to_wallet(){
		$user_id = $this->input->get_post('user_id');
		$amount = $this->input->get_post('amount');
		$payment_id = $this->input->get_post('payment_id');
		
        if($user_id!='' && $user_id>0 && $amount!='' && $amount>0 && $payment_id!=''){
        	$txn_no  = generateRandomString();
            $wallet_array = array(
            	'payment_id'=>$payment_id,
                'txn_no'=>$txn_no,
                'user_id'=>$user_id,
                'offer_code'=>'ADDED_VIA_APP',
                'wallet_amount'=>$amount,
                'date'=>date('Y-m-d'),
                'txn_type'=>'1',//credit-aaya
            );
            $this->model->insertData('wallet_txn',$wallet_array);
            $data['status'] = '1';
        	$data['msg'] = 'Rs.' .$amount .' has been successfully added to your wallet.';

        	$total_wallet_balance =$this->model->wallet_balance($user_id);
			$data['wallet_balance'] = $total_wallet_balance;
        }else{
        	$data['status'] = '0';
        	$data['msg'] = 'Required parameters are missing.';
        }
        echo json_encode($data);
	}


/*Class Ends*/	
}
