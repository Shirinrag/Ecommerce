<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller {

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
        //echo '<pre>'; print_r($glob['categories']); exit;
        $this->load->vars($glob);
        date_default_timezone_set('Asia/Kolkata');
	}
	
		function listing($category_data='',$sub_cat_data='',$child_cat_data='',$brand_data=''){	
		$category_data = explode('-',$category_data);
		$category_id = end($category_data);
		$sub_cat_data = explode('-',$sub_cat_data);
		$sub_cat_ids = end($sub_cat_data);
		$child_cat_data = explode('-',$child_cat_data);
		$child_cat_ids = end($child_cat_data);
		$brand_data = explode('-',$brand_data);
		$brand_ids = end($brand_data);

		
		

		$product_keyword = $this->input->get_post('keyword');

	

		$data['product_super_deal'] = $this->input->get_post('listed_in_super_deal');
		//echo '<pre>'; print_r($data['product_super_deal']); exit;
		$data['product_trending'] = $this->input->get_post('listed_in_trending');


		//echo '<pre>'; print_r($product_super_deal); exit;
		//$top_50 = $_GET['top_fifty'];

		$top_f = $this->input->get_post('top_fifty');

		$data['top_fif'] = $top_f;

			


		$data['brand_id'] = $brand_ids;
		$data['keyword'] = $product_keyword;
		//print_r($brand_ids);exit;
		// print_r($sub_cat_ids);
		// print_r($child_cat_ids);exit;

		$data['category_list'] = $this->model->getData('category',array('status'=>'1'));

		$data['category_data'] = $this->model->getData('category',array('category_id'=>$category_id,'status'=>'1'));
		$data['sub_category_data'] = $this->model->getData('subcategory',array('sub_category_id'=>$sub_cat_ids,'status'=>'1'));
		$data['child_category_data'] = $this->model->getData('childcategory',array('child_category_id'=>$child_cat_ids));
		//echo '<pre>';print_r($data['child_category_data']);exit;
		
		
		$productarr = array('category_id'=>$category_id,'sub_category_id'=>$sub_cat_ids,'child_category_id'=>$child_cat_ids,'status'=>'1');
		

		$data['product_data'] = $this->model->getDataOrderBytop_ten('product',$productarr,'top_ten');

		//echo '<pre>';print_r(count($data['product_data']));exit;

		$data['hidden_category_id'] = $category_id;
		$data['hidden_subcategory_id'] = $sub_cat_ids;
		$data['hidden_childcategory_id'] = $child_cat_ids;


		foreach ($data['product_data'] as $prokey => $proval) {
			$product_id = $proval['product_id'];
			if(!empty($product_id)){
				$allrating= $this->model->getData('product_review',array('product_id'=>$product_id));
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

			$data['percent'] = round($ratings_count * 100 / 5);
			
		}

		$data['brand_data'] = $this->model->getData('brands',array('status'=>'1'));

		$data['price_slider_data'] = $this->model->getSqlData("SELECT price FROM product WHERE status='1'");
		$prices = [];
		foreach ($data['price_slider_data'] as $key => $value) {
			$prices[] = $value['price'];
		}
		$data['price_slider_data']['min_price'] = min($prices);
		$data['price_slider_data']['max_price'] = max($prices);

		// echo '<pre>';print_r($data['price_slider_data']);exit;


		// $query = "SELECT MAX(price) as max FROM product";
		// $query1 = "SELECT MIN(price) as min FROM product";
		//$data['max_data'] = $this->model->getSqlData($query)[0];
		//$data['min_data'] = $this->model->getSqlData($query1)[0];
		// $data['max_data']['max'] = 6299;
		// $data['min_data']['min'] = 600;
		//print_r($data['max_data']);exit;

	    

		// $brand = [];
		// foreach ($data['brand_data'] as $key => $bval) {
			
		// 	if(!in_array($bval['brand_name'], $brand)){
			
		// 		$brand[] = $bval['brand_name'];
		// 	}
		// }

		// $data['brand'] = $brand;

		//echo '<pre>';print_r($data['brand_data']);exit;

		

		// $brand = [];
		// foreach ($data['product_data'] as $key => $bval) {

		// 	if(!in_array($bval['brand_name'], $brand)){
			
		// 		$brand[] = $bval['brand_name'];
		// 	}
		// }

		// $data['brand'] = $brand;

		foreach ($data['product_data'] as $key => $value) {
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
			$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
			$data['product_data'][$key]['unit_name']= $unit_name;
		}

		
        
		$data['main_content']='product/category';
		$this->load->view('includes/template',$data);
	}
	function listing1($category_data='',$sub_cat_data='',$child_cat_data='',$brand_data=''){	
		$category_data = explode('-',$category_data);
		$category_id = end($category_data);
		$sub_cat_data = explode('-',$sub_cat_data);
		$sub_cat_ids = end($sub_cat_data);
		$child_cat_data = explode('-',$child_cat_data);
		$child_cat_ids = end($child_cat_data);
		$brand_data = explode('-',$brand_data);
		$brand_ids = end($brand_data);

		
		

		$product_keyword = $this->input->get_post('keyword');

	

		$data['product_super_deal'] = $this->input->get_post('listed_in_super_deal');
		//echo '<pre>'; print_r($data['product_super_deal']); exit;
		$data['product_trending'] = $this->input->get_post('listed_in_trending');


		//echo '<pre>'; print_r($product_super_deal); exit;
		//$top_50 = $_GET['top_fifty'];

		$top_f = $this->input->get_post('top_ten');

		$data['top_fif'] = $top_f;

			


		$data['brand_id'] = $brand_ids;
		$data['keyword'] = $product_keyword;
		//print_r($brand_ids);exit;
		// print_r($sub_cat_ids);
		// print_r($child_cat_ids);exit;

		$data['category_list'] = $this->model->getData('category',array('status'=>'1'));

		$data['category_data'] = $this->model->getData('category',array('category_id'=>$category_id,'status'=>'1'));
		$data['sub_category_data'] = $this->model->getData('subcategory',array('sub_category_id'=>$sub_cat_ids,'status'=>'1'));
		$data['child_category_data'] = $this->model->getData('childcategory',array('child_category_id'=>$child_cat_ids));
		//echo '<pre>';print_r($data['child_category_data']);exit;
		
		
		$productarr = array('category_id'=>$category_id,'sub_category_id'=>$sub_cat_ids,'child_category_id'=>$child_cat_ids,'status'=>'1');
		

		$data['product_data'] = $this->model->getDataOrderBy('product',$productarr,'product_name');

		//echo '<pre>';print_r(count($data['product_data']));exit;

		$data['hidden_category_id'] = $category_id;
		$data['hidden_subcategory_id'] = $sub_cat_ids;
		$data['hidden_childcategory_id'] = $child_cat_ids;


		foreach ($data['product_data'] as $prokey => $proval) {
			$product_id = $proval['product_id'];
			if(!empty($product_id)){
				$allrating= $this->model->getData('product_review',array('product_id'=>$product_id));
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

			$data['percent'] = round($ratings_count * 100 / 5);
			
		}

		$data['brand_data'] = $this->model->getData('brands',array('status'=>'1'));

		$data['price_slider_data'] = $this->model->getSqlData("SELECT price FROM product WHERE status='1'");
		$prices = [];
		foreach ($data['price_slider_data'] as $key => $value) {
			$prices[] = $value['price'];
		}
		$data['price_slider_data']['min_price'] = min($prices);
		$data['price_slider_data']['max_price'] = max($prices);

		// echo '<pre>';print_r($data['price_slider_data']);exit;


		// $query = "SELECT MAX(price) as max FROM product";
		// $query1 = "SELECT MIN(price) as min FROM product";
		//$data['max_data'] = $this->model->getSqlData($query)[0];
		//$data['min_data'] = $this->model->getSqlData($query1)[0];
		// $data['max_data']['max'] = 6299;
		// $data['min_data']['min'] = 600;
		//print_r($data['max_data']);exit;

	    

		// $brand = [];
		// foreach ($data['brand_data'] as $key => $bval) {
			
		// 	if(!in_array($bval['brand_name'], $brand)){
			
		// 		$brand[] = $bval['brand_name'];
		// 	}
		// }

		// $data['brand'] = $brand;

		//echo '<pre>';print_r($data['brand_data']);exit;

		

		// $brand = [];
		// foreach ($data['product_data'] as $key => $bval) {

		// 	if(!in_array($bval['brand_name'], $brand)){
			
		// 		$brand[] = $bval['brand_name'];
		// 	}
		// }

		// $data['brand'] = $brand;

		foreach ($data['product_data'] as $key => $value)
		 {
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
			$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
			$data['product_data'][$key]['unit_name']= $unit_name;
		}

		
        
		$data['main_content']='product/category';
		$this->load->view('includes/template',$data);
	}

	function add_notify_me()
	{
		$_POST['status'] = 'I';
		$postdata = $_POST;
		$this->model->insertData('flavour_notify',$postdata);
		redirect('home/');
		//echo '<pre>'; print_r($postdata); exit;
	}


	function brandfilter($brand_name)
	{
		$brand_name = explode('-',$brand_name);
		$brand_id = $brand_name[0];
		$product_id = end($brand_name);
		//echo '<pre>';print_r($brand_id);exit;
		$product_data = $this->model->getData('product',array('brand_id'=>$brand_id,'status'=>'1'));
		$data['product_details'] = $this->model->getData('product_details',array('product_id'=>$product_id));

		
		$data['product_data'] = $product_data;

		foreach ($data['product_data'] as $prokey => $proval) {
				$product_id = $proval['product_id'];
				
				
				if(!empty($product_id)){
					$allrating= $this->model->getData('product_review',array('product_id'=>$product_id));
					
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
				$data['percent'] = round($ratings_count * 100 / 5);
				$data['product_data'][$prokey]['average_rating'] = $data['percent'];
				$data['product_data'][$prokey]['count_rating'] = $ratings_count;
			}
		//echo '<pre>';print_r($data['product_data']);exit;
		$data['category_list'] = $this->model->getData('category',array('status'=>'1'));

		$brand =[];
		foreach ($data['product_data'] as $key => $bval) {
			if(!in_array($bval['brand_name'], $brand)){
			
				$brand[] = $bval['brand_name'];
			}
		}

		$data['brand'] = $brand;

		$data['brand_data'] = $this->model->getData('brands',array('status'=>'1'));

		foreach ($data['product_data'] as $key => $value) {
			if(empty($value['pack_size'])) {
				$value['pack_size'] = "1";
			}
			$pack_sizes = explode(',', $value['pack_size']);
			$prices = explode(',', $value['price']);
			$mrps = explode(',', $value['mrp']);
			$unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

			$pack_sizes2 = [];
			foreach ($pack_sizes as $key1 => $value1) {
				if(isset($prices[$key1])){
					$pack_sizes2[] = array(
						'pack_size'=> $value1,
						'price'=> empty($prices[$key1]) ? 0 : $prices[$key1],
						'mrp'=>empty($mrps[$key1]) ? 0 : $mrps[$key1]
					);
				}
			}


			$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
			$data['product_data'][$key]['unit_name']= $unit_name;
			$data['product_data'][$key]['mrp']= $mrps[0];
			$data['product_data'][$key]['banner_images']= unserialize($value['banner_images']);
		}
		
		$data['body_class'] = 'home';
		$data['main_content']='product/brandfilter';
		$this->load->view('includes/template',$data);
	}

	function authentic()
	{
		$data['body_class'] = 'authentic';
		$data['authentic'] = $this->model->getData('product_importer',array('status'=>'1'));
		$data['main_content']='product/genuine';
		$this->load->view('includes/template',$data);
	}

	function category($category_data){	
		$category_id = end(explode('-',$category_data));
		$data['category_data'] = $this->model->getData('category',array('category_id'=>$category_id,'status'=>'1'));

		$data['product_data'] = $this->model->getDataOrderBy('product',array('category_id'=>$category_id,'status'=>'1'),'product_name');
		foreach ($data['product_data'] as $key => $value) {
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
			$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
			$data['product_data'][$key]['unit_name']= $unit_name;
		}


		$data['price_slider_data'] = $this->model->getSqlData("SELECT min(price) as min_price, max(price) AS max_price FROM product WHERE status='1'");
		
		$data['main_content']='product/category';
		$this->load->view('includes/template',$data);
	}

	function sort_data()
	{

		if(isset($_POST["short"])){
			
			if($_POST["short"] == 'DESC'){

				$query  = "SELECT * FROM product ORDER BY price DESC";

			}else if($_POST["short"] == 'popular'){

				$query = "SELECT * FROM product as p inner join order_data_details as od on p.product_id = od.product_id group by p.product_id order by sum(od.qty) desc";
			}
			else if($_POST["short"] == 'trending'){
				$query = "SELECT * FROM product WHERE listed_in_trending = 1";
			}
			else if($_POST["short"] == 'date'){
				$query = "SELECT * FROM product order by date_modified desc";
			}
			else
			{

				$query  = "SELECT * FROM product ORDER BY price ASC";
			}



			$result = $this->model->getSqlData($query);

			foreach ($result as $prokey => $proval) {
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
				$result[$prokey]['average_rating'] = $data['percent'];
				$result[$prokey]['count_rating'] = $ratings_count;
			}

			$total_row = count($result);
			$output = '';
			if($total_row > 0)
			{
				
				foreach($result as $row)
				{
					$output .='<div class="col-4">
                                        <div class="products">
                                            <div class="product-short-info product-info">
                                                <div>';
                                                $minus = (float)$row['mrp'] - (float)$row['price'];
                                                $divide   = $minus/(float)$row['mrp']*100;
                                                $output .='<div class="p-discount" style="background-color: #00bfbf;">'.round($divide).'%<br></div>';
                                                    if($row['stock_status']=='0'){
                                                         $output .='<div class="out-of-stock-label ab11">SOLD OUT</div>';
                                                    }
                                                    $output .='<div class="product-img">
                                                        <a href="'.base_url().'product/detailing/'.strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'">';
                                                            if(!empty($row['image_name'])){
                                                                $output .='<img width="370" height="370" src="'.base_url().'products/'.$row['image_name'].'" class="attachment-shop_single size-shop_single wp-post-image" alt="'.$row['product_name'].'">';
                                                            }else{

                                                                $output .='<img width="370" height="370" class="attachment-shop_single size-shop_single wp-post-image" src="'.base_url().'assets/images/no-image.png">';
                                                            }
                                                        $output .='</a>';
                                                    $output .='</div>';
                                                    $output .='<div class="product-desc">';
                                                    $output .=' <h4 class="text-truncate">';
                                                     $output .='<a href="'.base_url().'product/detailing/'. strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'">'
                                                            .ucwords($row['product_name']).'
                                                          </a>';
                                                    $output .='</h4>';
                                                    $output .='<br>';
                                                    $output .= '<div class="ratings">
																  <div class="empty-stars"></div>
																  <div class="full-stars" style="width:'.$row['average_rating'].'%"></div>
																</div><div class="review-count">('.$row['count_rating'].' Reviews)</div><br>';
                                                    // $output .='<span class="variant-rating-count" style="display: inline-flex;"><div class="review-stars" style="width:100px;    margin-left: -4em;display: inline-flex;"><div class="rtng-usr" style="width: '.$row['average_rating'].'%;" style="display:inline-flex;"></div></div><div class="review-count" style="display:inline-flex;">(582 Reviews)</div></span>';
//                                                         $output .='<span class="fa fa-star checked"></span>
// <span class="fa fa-star checked"></span>
// <span class="fa fa-star checked"></span>
// <span class="fa fa-star"></span>
// <span class="fa fa-star"></span><br>
                                                       $output .='<input type="hidden" class="qty" value="1">
                                                        
                                                        <input type="hidden" class="price" value="'.(float)$row['price'].'">
                                                        <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>'.$row['mrp'].'</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> '.$row['price'].'</span></span></ins></div>
                                                    </div>';
                                                    $output .='<p class="text-center">';
                                                        // if($row['stock_status']=='1'){ 
                                                                // $output .='<a href="javascript:void(0)">
                                                                //     <button class="btn btn-primary3" style="color:#fff;margin-left:0px;" onclick="return addItemToCart(this,'.$row['product_id'].',1);">Add To Cart</button>
                                                                // </a>&nbsp;&nbsp;';
                                                        //  } else { 

                                                        //     $output .='<a href="javascript:void(0)">
                                                        //         <button class="btn btn-primary3" style="color:#fff;margin-left:0px;">OUT OF STOCK</button>
                                                        //     </a>';

                                                        // } 
                                                            // $output .='<a href="'.base_url().'product/detailing/'.strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'">
                                                            //     <button class="btn btn-primary3" style="color:#fff;width:124px;"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp;&nbsp;View More</button>
                                                            // </a>';

                                                    $output .='</p>
                                                    <br>
                                                   <div class="p-action">
                                                   
                                                   <a href="'.base_url().'product/detailing/'.strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style=""></i>View Product</a></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
					
				}
				
			}
			else
			{
				$output = '<div class="col-12"> 
                                        <img class="img-responsive" src="'.base_url().'assets/images/coming-soon-page-large.png">
                                    </div>';
			}
			echo $output;
	
		$data['product_data'] = $output;
		$this->load->view('product/productcategoryfilter',$data);

		//$data['category_data'] = $this->model->getData('category');

		//$data['product_data'] = $this->model->getData('product');

		

		//echo '<pre>';print_r($data['product_data']);exit;

		//$data['main_content']='home/productcategory';
		//$this->load->view('includes/template',$data);

		
			

			
		}
	}

	function detailing($product_name){
		$product_name = explode('-',$product_name);
		$product_id = end($product_name);
		$product_data= $this->model->getData('product',array('product_id'=>$product_id,'status'=>'1'));
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
				$data['count_rating'] = $ratings_count;
				//$data[$prokey]['average_rating'] = $data['percent'];
				//$data[$prokey]['count_rating'] = $ratings_count;
			}
		$data['category'] = $this->model->getData('category',array('category_id'=>$product_data[0]['category_id'],'status'=>'1'))[0];
		$data['sub_category'] = $this->model->getData('subcategory',array('sub_category_id'=>$product_data[0]['sub_category_id'],'status'=>'1'))[0];
		//echo '<pre>';print_r($data['sub_category']);exit;
		$data['product_details'] = $this->model->getData('product_details',array('product_id'=>$product_id));
		$data['product_data'] = $product_data;

		$data['brand_details'] = $this->model->getData('brands',array('brand_id'=>$data['product_data'][0]['brand_id']))[0];
		//echo '<pre>'; print_r($data['brand_details']); exit;

		$data['size_product'] = $this->model->getData('product_relative',array('product_id'=>$product_id));

		$data['flavour_data'] = $this->model->getData('product_flavour',array('product_id'=>$product_id));
		//echo '<pre>'; print_r($data['flavour_data']); exit;

		// foreach ($data['size_product'] as $szekey => $sze_prod) {
			
		// 	$data['s_product'] = $this->model->getData('product',array('product_id'=>$sze_prod['rel_product_id']));

			
		// }

		// echo '<pre>'; print_r($data['s_product']); exit;

		foreach ($data['product_data'] as $prdkey => $prdval) {
			$data['category_details'] = $this->model->getData('category',array('category_id'=>$data['product_data'][0]['category_id']))[0];
			$data['sub_cate_details'] = $this->model->getData('subcategory',array('sub_category_id'=>$data['product_data'][0]['sub_category_id']))[0];
			$data['child_cate_details'] = $this->model->getData('childcategory',array('child_category_id'=>$data['product_data'][0]['child_category_id']))[0];
		}

		//echo "<pre>";print_r($data['child_cate_details']);exit;
		foreach ($data['product_data'] as $key => $value) {
			if(empty($value['pack_size'])) {
				$value['pack_size'] = "1";
			}
			$pack_sizes = explode(',', $value['pack_size']);
			$prices = explode(',', $value['price']);
			$mrps = explode(',', $value['mrp']);
			$unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

			$pack_sizes2 = [];
			foreach ($pack_sizes as $key1 => $value1) {
				if(isset($prices[$key1])){
					$pack_sizes2[] = array(
						'pack_size'=> $value1,
						'price'=> empty($prices[$key1]) ? 0 : $prices[$key1],
						'mrp'=>empty($mrps[$key1]) ? 0 : $mrps[$key1]
					);
				}
			}


			$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
			$data['product_data'][$key]['unit_name']= $unit_name;
			$data['product_data'][$key]['mrp']= $mrps[0];
			$data['product_data'][$key]['banner_images']= unserialize($value['banner_images']);
			$data['product_data'][$key]['rela_product']= unserialize($value['rel_product_id']);
		}


		if(!empty($data['product_data'][0]['rela_product'])){
            $supder_deal_products = $this->model->getData('product',array(),array('field'=>'product_id','in_array'=>$data['product_data'][0]['rela_product']));

	            foreach ($supder_deal_products as $key => $relval) {
		        if(empty($relval['pack_size'])) {
		            $relval['pack_size'] = "1";
		        }
		        $pack_sizes = explode(',', $relval['pack_size']);
		        $prices = explode(',', $relval['price']);
		        $unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$relval['unit_id']));

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
        }

        //echo '<pre>';print_r($data['supder_deal_products']);exit;

		
		$data['flavours'] = explode(',', $product_data[0]['flavour']);
		$data['flavstatus'] = explode(',', $product_data[0]['flav_status']);
		$data['pck_sze'] = explode(',', $product_data[0]['pack_size']);
		$data['price'] = explode(',', $product_data[0]['price']);

		$data['comb_aray'] = array_combine($data['pck_sze'], $data['price']);
		$data['flav_aray'] = array_combine($data['flavours'], $data['flavstatus']);

		//echo '<pre>';print_r($data['flav_aray']);exit;

		
		

		$data['mrp'] = explode(',', $product_data[0]['mrp']);

		if(isset($product_data[0]['importer_title']) && !empty($product_data[0]['importer_title'])){
			$data['importer_title'] = explode(',', $product_data[0]['importer_title']);

		}


		//echo '<pre>';print_r($data['importer_title']);exit;




		
		
		$strQry = "select * from product where status='1' order by added_on limit 15 ";
		$data['upsell_product'] = $this->model->getSqlData($strQry);
		foreach ($data['upsell_product'] as $key => $value) {
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
			$data['upsell_product'][$key]['pack_sizes']= $pack_sizes2;
			$data['upsell_product'][$key]['unit_name']= $unit_name;
		}

		$data['reviews'] = $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
		//echo '<pre>'; print_r($data['reviews']); exit;
		$rating = [];
		foreach ($data['reviews'] as $key => $value) {
			if(!empty($value['user_id'])){
				$data['reviews'][$key]['user_name'] = $this->model->getValue('user','full_name',array('user_id'=>$value['user_id']));
			}else{

				$data['reviews'][$key]['user_name'] = $value['user_name'];
			}
			$rating[] = $value['rating'];
		}

		//echo '<pre>';print_r($data['reviews']);exit;
		$rating2 = [];
		$a=0;$b=0;$c=0;$d=0;$e=0;
		$total_rating = 0;
		foreach ($rating as $key => $value) {
			if($value == 1){
				$a++;
			}
			if($value == 2){
				$b++;
			}
			if($value == 3){
				$c++;
			}
			if($value == 4){
				$d++;
			}
			if($value ==5){
				$e++;
			}
			$total_rating = $a+$b*2+$c*3+$d*4+$e*5;
			$rating2[1]['percent'] = round($a/$total_rating *100);
			$rating2[1]['rating'] = $a;
			$rating2[2]['percent'] = round(($b * 2)/$total_rating *100);
			$rating2[2]['rating'] = $b * 2;
			$rating2[3]['percent'] = round(($c * 3)/$total_rating *100);
			$rating2[3]['rating'] = $c * 3;
			$rating2[4]['percent'] = round(($d * 4)/$total_rating *100);
			$rating2[4]['rating'] = $d * 4;
			$rating2[5]['percent'] = round(($e * 5)/$total_rating *100);
			$rating2[5]['rating'] = $e * 5;
		}

		// $data['breadcrumbs'] = '<a href="https://healthxp.in">Home</a>';

        //$data['breadcrumbs'] .= '<i class="icon icon-breadcrubm-delimiter"></i>'.$data['category_data'][0]['category_name'].'';

        //$data['breadcrumbs'] .= '<i class="icon icon-breadcrubm-delimiter"></i>'.$data['sub_category_data'][0]['sub_category_name'].'';
		$data['rating'] = $rating2;
		$data['body_class'] = 'home';
		$data['main_content']='product/detailing';
		$this->load->view('includes/template',$data);
	}

	// function detailing($product_name){
	// 	$product_name = explode('-',$product_name);
	// 	$product_id = end($product_name);
	// 	$product_data= $this->model->getData('product',array('product_id'=>$product_id,'status'=>'1'));
	// 	$data['product_details'] = $this->model->getData('product_details',array('product_id'=>$product_id));

	// 	//echo '<pre>';print_r($product_details);exit;
	// 	$data['product_data'] = $product_data;
	// 	foreach ($data['product_data'] as $key => $value) {
	// 		if(empty($value['pack_size'])) {
	// 			$value['pack_size'] = "1";
	// 		}
	// 		$pack_sizes = explode(',', $value['pack_size']);
	// 		$prices = explode(',', $value['price']);
	// 		$mrps = explode(',', $value['mrp']);
	// 		$unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

	// 		$pack_sizes2 = [];
	// 		foreach ($pack_sizes as $key1 => $value1) {
	// 			if(isset($prices[$key1])){
	// 				$pack_sizes2[] = array(
	// 					'pack_size'=> $value1,
	// 					'price'=> empty($prices[$key1]) ? 0 : $prices[$key1],
	// 					'mrp'=>empty($mrps[$key1]) ? 0 : $mrps[$key1]
	// 				);
	// 			}
	// 		}


	// 		$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
	// 		$data['product_data'][$key]['unit_name']= $unit_name;
	// 		$data['product_data'][$key]['mrp']= $mrps[0];
	// 		$data['product_data'][$key]['banner_images']= unserialize($value['banner_images']);
	// 	}
	// 	$supder_deal_products = $this->model->getData('product',array('listed_in_super_deal'=>'1','status'=>'1'));
	//     foreach ($supder_deal_products as $key => $value) {
	//         if(empty($value['pack_size'])) {
	//             $value['pack_size'] = "1";
	//         }
	//         $pack_sizes = explode(',', $value['pack_size']);
	//         $prices = explode(',', $value['price']);
	//         $unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

	//         $pack_sizes2 = [];
	//         foreach ($pack_sizes as $key1 => $value1) {
	//             if(isset($prices[$key1])){
	//                 $pack_sizes2[] = array(
	//                     'pack_size'=> $value1,
	//                     'price'=> $prices[$key1]
	//                 );
	//             }
	//         }
	//         $supder_deal_products[$key]['pack_sizes']= $pack_sizes2;
	//         $supder_deal_products[$key]['unit_name']= $unit_name;
	//     }
	//     $data['supder_deal_products'] = $supder_deal_products;
	// 	$data['flavours'] = explode(',', $product_data[0]['flavour']);
	// 	$data['flavstatus'] = explode(',', $product_data[0]['flav_status']);
	// 	$data['pck_sze'] = explode(',', $product_data[0]['pack_size']);
	// 	$data['price'] = explode(',', $product_data[0]['price']);

	// 	$data['comb_aray'] = array_combine($data['pck_sze'], $data['price']);
	// 	$data['flav_aray'] = array_combine($data['flavours'], $data['flavstatus']);

	// 	//echo '<pre>';print_r($data['flav_aray']);exit;

		
		

	// 	$data['mrp'] = explode(',', $product_data[0]['mrp']);




		
		
	// 	$strQry = "select * from product where status='1' order by added_on limit 15 ";
	// 	$data['upsell_product'] = $this->model->getSqlData($strQry);
	// 	foreach ($data['upsell_product'] as $key => $value) {
	// 		if(empty($value['pack_size'])) {
	// 			$value['pack_size'] = "1";
	// 		}
	// 		$pack_sizes = explode(',', $value['pack_size']);
	// 		$prices = explode(',', $value['price']);
	// 		$unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

	// 		$pack_sizes2 = [];
	// 		foreach ($pack_sizes as $key1 => $value1) {
	// 			if(isset($prices[$key1])){
	// 				$pack_sizes2[] = array(
	// 					'pack_size'=> $value1,
	// 					'price'=> $prices[$key1]
	// 				);
	// 			}
	// 		}
	// 		$data['upsell_product'][$key]['pack_sizes']= $pack_sizes2;
	// 		$data['upsell_product'][$key]['unit_name']= $unit_name;
	// 	}

	// 	$data['reviews'] = $this->model->getData('product_review',array('product_id'=>$product_id));
	// 	$rating = [];
	// 	foreach ($data['reviews'] as $key => $value) {
	// 		$data['reviews'][$key]['user_name'] = $this->model->getValue('user','full_name',array('user_id'=>$value['user_id']));
	// 		$rating[] = $value['rating'];
	// 	}
	// 	$rating2 = [];
	// 	$a=0;$b=0;$c=0;$d=0;$e=0;
	// 	$total_rating = 0;
	// 	foreach ($rating as $key => $value) {
	// 		if($value == 1){
	// 			$a++;
	// 		}
	// 		if($value == 2){
	// 			$b++;
	// 		}
	// 		if($value == 3){
	// 			$c++;
	// 		}
	// 		if($value == 4){
	// 			$d++;
	// 		}
	// 		if($value ==5){
	// 			$e++;
	// 		}
	// 		$total_rating = $a+$b*2+$c*3+$d*4+$e*5;
	// 		$rating2[1]['percent'] = round($a/$total_rating *100);
	// 		$rating2[1]['rating'] = $a;
	// 		$rating2[2]['percent'] = round(($b * 2)/$total_rating *100);
	// 		$rating2[2]['rating'] = $b * 2;
	// 		$rating2[3]['percent'] = round(($c * 3)/$total_rating *100);
	// 		$rating2[3]['rating'] = $c * 3;
	// 		$rating2[4]['percent'] = round(($d * 4)/$total_rating *100);
	// 		$rating2[4]['rating'] = $d * 4;
	// 		$rating2[5]['percent'] = round(($e * 5)/$total_rating *100);
	// 		$rating2[5]['rating'] = $e * 5;
	// 	}
	// 	$data['rating'] = $rating2;
	// 	$data['body_class'] = 'home';
	// 	$data['main_content']='product/detailing';
	// 	$this->load->view('includes/template',$data);
	// }

	function fetch_data(){
		//$data['is_hide_cat'] = 'yes';
		// $brand_id = $_GET["brand_id"];
		$category_id = $_POST["category_id"];
		$sub_category_id = $_POST["sub_category_id"];
		$child_category_id = $_POST["child_category_id"];
		if(isset($_POST["action"]))
		{

			$filters = $_POST;
			$where = [];
			$where_in = [];
			$like = [];
			// if(!empty($brand_id)){
			// 	$where_in = array('field'=>'brand_id','in_array'=>$brand_id);
			// }
			if(!empty($category_id)){
				$where_in = array('field'=>'category_id','in_array'=>$category_id);
			}
			if(!empty($sub_category_id)){
				$where_in = array('field'=>'sub_category_id','in_array'=>$sub_category_id);
			}
			if(!empty($child_category_id)){
				$where_in = array('field'=>'child_category_id','in_array'=>$child_category_id);
			}
			if(!empty($filters['category'])){
				$where_in = array('field'=>'category_id','in_array'=>$filters['category']);
			}
			if(!empty($filters['brand'])){
				$where_in = array('field'=>'brand_id','in_array'=>$filters['brand']);
			}
			if(!empty($filters['brand_id'])){
				$where_in = array('field'=>'brand_id','in_array'=>$filters['brand_id']);
			}
			if(!empty($filters['keyword'])){
				$like = array('field'=>'product_name','keyword'=>$filters['keyword']);
			}
			if(!empty($filters['top_fifty'])){
				$where_in = array('field'=>'top_fifty','in_array'=>$filters['top_fifty']);
			}
			if(!empty($filters['super_deals'])){
				$where_in = array('field'=>'listed_in_super_deal','in_array'=>$filters['super_deals']);
			}
			if(!empty($filters['trend_p'])){
				$where_in = array('field'=>'listed_in_trending','in_array'=>$filters['trend_p']);
			}

			$product_data = $this->model->getDatanew('product',$where,$where_in,$like,'top_ten');
		
			foreach ($product_data as $key => $value) {
				$prices = explode(',', (float)$value['price']);
				if(!empty($filters['price_range'])){
				$price_range = explode('-', $filters['price_range']);
				$start_price = (float)$price_range[0];
				$end_price = (float)$price_range[1];
					foreach ($prices as $price) {
						if(!($price >=$start_price && $price <= $end_price)){
							unset($product_data[$key]);
						}
					}
				}
			}

			// echo '<pre>';print_r($prices);exit;
			// $query = "SELECT * FROM product WHERE status = '1' AND category_id='".$category_id."' AND sub_category_id='".$sub_category_id."' AND child_category_id='".$child_category_id."' ORDER BY stock_status DESC";


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
			$product_data1 = [];
			$product_data2 = [];
			foreach ($product_data as $key => $value) {
				if($value['stock_status'] == 1){
					$product_data1[] = $value;
				}
				else if($value['stock_status'] == 0){
					$product_data2[] = $value;
				}
			}
			$product_data = [];
			foreach ($product_data1 as $key => $value) {
				$product_data[] = $value;
			}
			foreach ($product_data2 as $key => $value) {
				$product_data[] = $value;
			}
			
			$total_row = count($product_data);
			$output = '';
			if($total_row > 0)
			{
				
				foreach($product_data as $row)
				{
					$output .='<div class="col-xs-6 col-md-4 productcateg">
                                        <div class="products">
                                            <div class="product-short-info product-info">
                                                <div>';
                                                $minus = (float)$row['mrp'] - (float)$row['price'];
                                                $divide   = $minus/(float)$row['mrp']*100;
                                                $output .='<div class="p-discount" style="background-color: #00bfbf;">'.round($divide).'%<br></div>';
                                                    if($row['stock_status']=='0'){
                                                         $output .='<div class="out-of-stock-label ab11">SOLD OUT</div>';
                                                    }
                                                    $output .='<div class="product-img">
                                                        <a href="'.base_url().'product/detailing/'.strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'">';
                                                            if(!empty($row['image_name'])){
                                                                $output .='<img width="370" height="370" src="'.base_url().'products/'.$row['image_name'].'" class="attachment-shop_single size-shop_single wp-post-image" alt="'.$row['product_name'].'">';
                                                            }else{

                                                                $output .='<img width="370" height="370" class="attachment-shop_single size-shop_single wp-post-image" src="'.base_url().'assets/images/no-image.png">';
                                                            }
                                                        $output .='</a>';
                                                    $output .='</div>';
                                                    $output .='<div class="product-desc">';
                                                    $output .=' <h4 class="text-truncate">';
                                                     $output .='<a href="'.base_url().'product/detailing/'. strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'">'
                                                            .ucwords($row['product_name']).'
                                                          </a>';
                                                    $output .='</h4>';
                                                    $output .='<br>';
                                                    $output .= '<div class="ratings" style="display:inline-flex;">
																  <div class="empty-stars"></div>
																  <div class="full-stars" style="width:'.$row['average_rating'].'%"></div>
																</div>&nbsp;<div class="review-count" style="display:inline-flex;font-size:12px;margin-top:0.5em;">('.$row['count_rating'].')</div><br>';
                                                    // $output .='<span class="variant-rating-count" style="display: inline-flex;"><div class="review-stars" style="width:100px;    margin-left: -4em;display: inline-flex;"><div class="rtng-usr" style="width: '.$row['average_rating'].'%;" style="display:inline-flex;"></div></div><div class="review-count" style="display:inline-flex;">(582 Reviews)</div></span>';
//                                                         $output .='<span class="fa fa-star checked"></span>
// <span class="fa fa-star checked"></span>
// <span class="fa fa-star checked"></span>
// <span class="fa fa-star"></span>
// <span class="fa fa-star"></span><br>
                                                       $output .='<input type="hidden" class="qty" value="1">
                                                        
                                                        <input type="hidden" class="price" value="'.(float)$row['price'].'">
                                                        <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>'.$row['mrp'].'</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> '.$row['price'].'</span></span></ins></div>
                                                    </div>';
                                                    $output .='<p class="text-center">';
                                                        // if($row['stock_status']=='1'){ 
                                                                // $output .='<a href="javascript:void(0)">
                                                                //     <button class="btn btn-primary3" style="color:#fff;margin-left:0px;" onclick="return addItemToCart(this,'.$row['product_id'].',1);">Add To Cart</button>
                                                                // </a>&nbsp;&nbsp;';
                                                        //  } else { 

                                                        //     $output .='<a href="javascript:void(0)">
                                                        //         <button class="btn btn-primary3" style="color:#fff;margin-left:0px;">OUT OF STOCK</button>
                                                        //     </a>';

                                                        // } 
                                                            // $output .='<a href="'.base_url().'product/detailing/'.strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'">
                                                            //     <button class="btn btn-primary3" style="color:#fff;width:124px;"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp;&nbsp;View More</button>
                                                            // </a>';

                                                    $output .='</p>
                                                    <br>
                                                   <div class="p-action">
                                                   
                                                   <a href="'.base_url().'product/detailing/'.strtolower(preg_replace('/\s+/', '-',$row['product_name'])).'-'.$row['product_id'].'" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style=""></i>View Product</a></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
					
				}
				
			}
			else
			{
				$output = '<div class="col-12"> 
                                        <img class="img-responsive" src="'.base_url().'assets/images/coming-soon-page-large.png">
                                    </div>';
			}
			echo $output;
		}
		$data['product_data'] = $output;
		//$data['total'] = "<strong>Total:</strong> ".$total_row."";
		$this->load->view('product/productcategoryfilter',$data);

		//$data['category_data'] = $this->model->getData('category');

		//$data['product_data'] = $this->model->getData('product');

		

		//echo '<pre>';print_r($data['product_data']);exit;

		//$data['main_content']='home/productcategory';
		//$this->load->view('includes/template',$data);
	}

	function category_old()
	{
		$category_id = $this->input->get_post('id');

		$catdata = $this->model->getData('km_category',array('category_id'=>$category_id ));

		$data['category_title'] = $catdata[0]['category_name'];

		$count_product_data =$this->model->CountWhereRecord('km_product',array('category'=>$category_id));
		$data['count_product_data'] = $count_product_data;

		$product_data =$this->model->getDataLimit('km_product',array('category'=>$category_id),'30','0');
		$data['product_data'] = $product_data;

		$data['ptype_desc'] = $this->model->getData('km_product_type',array('product_type_id'=>$product_data[0]['product_type']));
		$data['pcategory_desc'] = $catdata;//$this->model->getData('km_category',array('category_id'=>$product_data[0]['category']));
		$data['filter_title'] = 'Sub Category';

		$data['pfilter_min_max']= $this->model->getSqlData("SELECT min(price) as MinPrice, max(price) AS MaxPrice FROM km_product WHERE category='".$category_id."'");

		$pfilter_sub_category= $this->model->getSqlData("SELECT DISTINCT(sub_category) FROM km_product WHERE category='".$category_id."'");
		$filterproduct = array();
		foreach ($pfilter_sub_category as $key => $value) {
			$filterproduct[$key]['flcount'] = $this->model->CountWhereRecord('km_product',array('sub_category'=>$value['sub_category']));
			$sub_categorydetails = $this->model->getData('km_subcategory',array('sub_category_id'=>$value['sub_category']));
			$filterproduct[$key]['fltypename'] = $sub_categorydetails[0]['sub_category_name'];
		}
		$data['filterproduct'] = $filterproduct;
		
		$strQry = "SELECT COUNT(product_id) as Total FROM km_product WHERE price <='100' AND category='".$category_id."'";
		$Below_100_Data = $this->model->getSqlData($strQry);
		$strQry = "SELECT COUNT(product_id) as Total FROM km_product WHERE price >'100' and price <='500' AND category='".$category_id."'";
		$Between_100_500_Data = $this->model->getSqlData($strQry);
		$strQry = "SELECT COUNT(product_id) as Total FROM km_product WHERE price >'500' AND category='".$category_id."'";
		$More_500_Data = $this->model->getSqlData($strQry);

		$data['Below_100'] = $Below_100_Data[0]['Total'];
		$data['Between_100_500'] = $Between_100_500_Data[0]['Total'];
		$data['More_500'] = $More_500_Data[0]['Total'];

		$data['page_type'] = 'category';
		$data['type_id'] = $category_id;
		$data['body_class'] = 'category-page';
		$data['main_content']='product/index';
		$this->load->view('includes/template',$data);
	}

	function getProductDetails()
	{
		$prod_det_id = $_POST['product_det'];

		$proddata = $this->model->getData('product_details',array('id'=>$prod_det_id))[0];

		echo json_encode($proddata);

		//echo '<pre>';print_r($proddata);exit;

	}
	
	function subcategory()
	{
		$subcategory_id = $this->input->get_post('id');
		$subcatdata = $this->model->getData('km_subcategory',array('sub_category_id'=>$subcategory_id ));
		$data['category_title'] = $subcatdata[0]['sub_category_name'];

		$count_product_data =$this->model->CountWhereRecord('km_product',array('sub_category'=>$subcategory_id));
		$data['count_product_data'] = $count_product_data;

		$product_data =$this->model->getDataLimit('km_product',array('sub_category'=>$subcategory_id),'24','0');
		$data['product_data'] = $product_data;

		$data['ptype_desc'] = $this->model->getData('km_product_type',array('product_type_id'=>$product_data[0]['product_type']));
		$data['pcategory_desc'] = $this->model->getData('km_category',array('category_id'=>$product_data[0]['category']));
		$data['psubcategory_desc'] = $this->model->getData('km_subcategory',array('sub_category_id'=>$product_data[0]['sub_category']));

		$data['pfilter_min_max']= $this->model->getSqlData("SELECT min(price) as MinPrice, max(price) AS MaxPrice FROM km_product WHERE sub_category='".$subcategory_id."'");

		$pfilter_brands= $this->model->getSqlData("SELECT DISTINCT(brand) FROM km_product WHERE sub_category='".$subcategory_id."'");
		$filterproduct = array();
		foreach ($pfilter_brands as $key => $value) {
			$filterproduct[$key]['flcount'] = $this->model->CountWhereRecord('km_product',array('brand'=>$value['brand']));
			$filterproduct[$key]['fltypename'] = ucwords($value['brand']);
		}
		$data['filterproduct'] = $filterproduct;

		$strQry = "SELECT COUNT(product_id) as Total FROM km_product WHERE price <='100' AND sub_category='".$subcategory_id."'";
		$Below_100_Data = $this->model->getSqlData($strQry);
		$strQry = "SELECT COUNT(product_id) as Total FROM km_product WHERE price >'100' and price <='500' AND sub_category='".$subcategory_id."'";
		$Between_100_500_Data = $this->model->getSqlData($strQry);
		$strQry = "SELECT COUNT(product_id) as Total FROM km_product WHERE price >'500' AND sub_category='".$subcategory_id."'";
		$More_500_Data = $this->model->getSqlData($strQry);

		$data['Below_100'] = $Below_100_Data[0]['Total'];
		$data['Between_100_500'] = $Between_100_500_Data[0]['Total'];
		$data['More_500'] = $More_500_Data[0]['Total'];

		$data['page_type'] = 'category';
		$data['type_id'] = $subcategory_id;
		$data['body_class'] = 'category-page';
		$data['filter_title'] = 'Brands';
		$data['main_content']='product/index';
		$this->load->view('includes/template',$data);
	}

	function filter(){
		
		$flproduct = $this->input->get_post('flproduct');
		$flrange = $this->input->get_post('flpricerange');
		
		$fltitle = $this->input->get_post('fltitle');
		$TableName = '';

		if($flproduct!='' && $flrange!='' && $fltitle!=''){
			if($fltitle=='Category'){
				$TableName = "km_category";
				$fld= "category_name";
				$mat_product_type = "category";
				$product_idx = "category_id";

			}elseif($fltitle=='Sub Category'){
				$TableName = "km_subcategory";
				$fld= "sub_category_name";
				$mat_product_type = "sub_category";
				$product_idx = "sub_category_id";

			}elseif($fltitle=='Brands'){
				$TableName = "km_product";
				$fld= "brand";
				$mat_product_type = "brand";
				$product_idx = "brand";

			}else{
				$TableName = "km_category";
				$fld= "category_name";
				$mat_product_type = "category";
				$product_idx = "category_id";
			}

			if($flrange!='undefined'){
				$pricerange = explode('-', $flrange);
				$minPrice = $pricerange[0];
				$maxPrice = (isset($pricerange[1]) && $pricerange[1]!='') ? $pricerange[1] : '';

				if($maxPrice!='') {
					$strPriceRange = ' AND price >='.$minPrice.' AND price <='.$maxPrice;
				}else{
					$strPriceRange = ' AND price >='.$minPrice;
				}
			}

			$strQry = "SELECT * FROM ". $TableName. " WHERE ". $fld. "="."'".$flproduct."'";
			$idData = $this->model->getSqlData($strQry);

			if(isset($idData) && !empty($idData)){
				$searchIdx = $idData[0][$product_idx];

				$data['product_data']=$this->model->getData('km_product',array($mat_product_type=>$searchIdx));
				$this->load->view('product/filter-product-list',$data);
			}else{
				echo 'No Product Found';
			}

		}else{
			echo 'No Product Found.';
		}
	}

	function item_in_cart(){
		$data['item_in_cart'] = $this->model->getData('cart',array('session_id'=>$this->session->userdata('session_id')));
		$data['body_class'] = 'product-page';
		$data['main_content']='product/item-in-cart';
		$this->load->view('includes/template',$data);
	}
	function combo_page(){
		
		$data['body_class'] = 'product-page';
		$data['main_content']='product/combo';
		$this->load->view('includes/template',$data);
	}
	function single_page(){
		
		$data['body_class'] = 'product-page';
		$data['main_content']='product/single';
		$this->load->view('includes/template',$data);
	}


	function qty_price($qty='',$unit_id="",$price=""){
		/*$array_1000k = array('1','2','3','6'); //1:kg,2:Gram,3:Liter,6:Mili liter
	    $array_1pcs = array('4','7'); //4:Piece, 7:Bunch,
	    $array_12dozen = array('5'); //5:Dozen*/
		$qty_price = '0';
		
		if($qty!='' && $price!="" && $unit_id!=""){
			if(($unit_id)=='1' || ($unit_id)=='2' || ($unit_id)=='3' || ($unit_id)=='6'){ /*Kg:1 and Ltr:3*/
				$qty_price = ($price / 1000) * ($qty);
			}else if(($unit_id)=='4' || ($unit_id)=='7'){
				$qty_price = ($price) * ($qty);
			}else if(($unit_id)=='5'){
				$qty_price = ($price / 12) * ($qty);
			}
		}
		return upto2Decimal($qty_price);
	}


	function addItemToCart(){
		$product_id = $this->input->get_post('product_id');
		$purchase_qty = $this->input->get_post('purchase_qty');
		$price  = $_POST['price'];
		$flavour  = $_POST['flavour'];
		// $pack_size = $_POST['pack_size'];
		$pack_size = 1;
		if($product_id!=''){
			$csession_id = $this->session->userdata('session_id');
			$ProductDetails = $this->model->getData('product',array('product_id'=>$product_id));
			
			if(isset($ProductDetails) && !empty($ProductDetails)){ //if product available
				
				if($ProductDetails[0]['stock_status']=='1'){

					$productPrice= $ProductDetails[0]['price'];
					$unit_id = ($ProductDetails[0]['unit_id']>0) ? $ProductDetails[0]['unit_id'] : '0' ;
					
					$isItemInCart = $this->model->getData('cart',array('product_id'=>$product_id,'flavour'=>$flavour,'pack_size'=>$pack_size,'session_id'=>$csession_id));

					if($isItemInCart){
						//update item in cart
						$cartQty = $isItemInCart[0]['qty']+$purchase_qty;
						// $unit_total = $this->qty_price($cartQty,$unit_id,$productPrice);
						$unit_total = $price * $cartQty;
						$itemcart = array('price'=>$price,'unit_total'=>$unit_total, 'product_id'=>$product_id,'flavour'=>$flavour,'qty'=>$cartQty,'session_id'=>$csession_id);
						$this->model->updateData('cart',$itemcart, array('cart_id'=>$isItemInCart[0]['cart_id']));
					}else{
						//insert into cart
						$unit_total = $price * $purchase_qty;
						$itemcart = array('price'=>$price,'unit_total'=>$unit_total, 'product_id'=>$product_id,'qty'=>$purchase_qty,'flavour'=>$flavour,'session_id'=>$csession_id);
						$itemcart['pack_size'] = $pack_size;
						$this->model->insertData('cart',$itemcart);
					}
					$data['status'] = 1;
					$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('session_id'=>$csession_id));
					$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE session_id='".$csession_id."'");
					$data['total_amount'] = sprintf('%0.2f', $unit_total[0]['total']);

				}else{
					$data['status'] = '0';
				}

			}else{
				$data['status'] = 0;
				$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('session_id'=>$csession_id));
				$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE session_id='".$csession_id."'");
				$data['total_amount'] = sprintf('%0.2f', $unit_total[0]['total']);
			}
		}else{
			$data['status'] = 0;
			$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('session_id'=>$csession_id));
			$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE session_id='".$csession_id."'");
			$data['total_amount'] = sprintf('%0.2f', $unit_total[0]['total']);
		}
		echo json_encode($data);
	}


	function UpdateItemToCart(){
		$csession_id = $this->session->userdata('session_id');
		$cart_id = $this->input->get_post('cart_id');
		$purchase_qty = $this->input->get_post('purchase_qty');
		
		if($cart_id!='' && $purchase_qty!=''){
			$iscartvalid = $this->model->getData('cart',array('cart_id'=>$cart_id));
			if($iscartvalid){

				$this->model->updateData('cart',array('qty'=>$purchase_qty,'unit_total'=>upto2Decimal($iscartvalid[0]['price']*$purchase_qty)), array('cart_id'=>$cart_id));
				$cartData = $this->model->getData('cart',array('cart_id'=>$cart_id));

				$data['Unit_Price'] = upto2Decimal($cartData[0]['qty']*$cartData[0]['price']);

				$strSql = "SELECT SUM(unit_total) as GrandTotal FROM cart WHERE session_id='".$this->session->userdata('session_id')."'";
				$SqlResult = $this->model->getSqlData($strSql);
				
				$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('session_id'=>$csession_id));
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
		if($cart_id!=''){
			$iscartvalid = $this->model->getData('cart',array('cart_id'=>$cart_id));
			if($iscartvalid){
				$this->model->deleteData('cart',array('cart_id'=>$cart_id));
				$strSql = "SELECT SUM(unit_total) as GrandTotal FROM cart WHERE session_id='".$this->session->userdata('session_id')."'";
				$SqlResult = $this->model->getSqlData($strSql);
				
				$data['GrandTotal'] = upto2Decimal($SqlResult[0]['GrandTotal']);
				$data['total_cart_item'] = $this->model->CountWhereRecord('cart',array('session_id'=>$this->session->userdata('session_id')));
				$data['status'] = '1';
			}else{
				$data['status'] = '0';
			}
		}else{
			$data['status'] = '0';
		}
		echo json_encode($data);
	}


	function search(){
		$product_keyword = $this->input->get_post('keyword');	
		//print_r($product_keyword);exit;	
		if($product_keyword!=''){
			$sqlQuery = "product_name LIKE '%".$product_keyword."%'";
		}else{
			$sqlQuery = "product_name LIKE '%".$product_keyword."%'";
		}
		$Query = 'SELECT * FROM product WHERE '.$sqlQuery.' AND status="1"';
 
		$searched_product_data = $this->model->getSqlData($Query);
		//echo '<pre>';print_r($searched_product_data);exit;
		$data['product_data'] = $searched_product_data;
		$data['product_name'] = $product_keyword;
		
		$data['child_category_data'] = $this->model->getData('childcategory',array('child_category_id'=>$data['product_data'][0]['child_category_id']));
		//echo '<pre>';print_r($data['child_category_data']);exit;
		foreach ($data['product_data'] as $key => $value) {
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
			$data['product_data'][$key]['pack_sizes']= $pack_sizes2;
			$data['product_data'][$key]['unit_name']= $unit_name;
		}

		$data['main_content']='product/product-search1';
		$this->load->view('includes/template',$data);
	}

	function search_next_content(){
		$pgtype = $this->input->get_post('pgtype');
		$offset = $this->input->get_post('offset');
		$id = $this->input->get_post('type_id');

		if($pgtype=='category'){
			$clm = 'category';
		}else{
			$clm = 'sub_category';
		}

		$product_data =$this->model->getDataLimit('km_product',array($clm=>$id),$offset,'30');
		$data['product_data'] = $product_data;

		$this->load->view('product/filter-product-list',$data);

	}
	function combo(){
			$data['main_content']='product/combo';
		$this->load->view('includes/template',$data);
	}
	function shop_by_brand(){
		$data['brand_data'] = $this->model->getDataOrderBy('brands',array('status'=>'1'),'brand_name');
		//$data['brand_data'] = $this->model->getData('brands',array('status'=>'1'));

		
		//echo '<pre>'; print_r($data['brand_data']); exit;
		$data['main_content']='product/shop_by_brand';
		$this->load->view('includes/template',$data);
	}
	function blog(){
		$data['blog_data'] = $this->model->getDataOrderBy('blog',array('status'=>'1'),'title');

		//echo '<pre>'; print_r($data['blog_data']); exit;
		//$data['brand_data'] = $this->model->getData('brands',array('status'=>'1'));

		
		//echo '<pre>'; print_r($data['brand_data']); exit;
		$data['main_content']='product/blog';
		$this->load->view('includes/template',$data);
	}
	function blog_view(){
		// $data['brand_data'] = $this->model->getDataOrderBy('brands',array('status'=>'1'),'brand_name');
		//$data['brand_data'] = $this->model->getData('brands',array('status'=>'1'));
		$id = $this->uri->segment(3);
		$data['blog_data'] = $this->model->getData('blog',array('blog_id'=>$id,'status'=>'1'))[0];
		$data['blog_details'] = $this->model->getData('blog_details',array('blog_detail_id'=>$id));
		//echo '<pre>'; print_r($data['blog_data']); exit;

		
		//echo '<pre>'; print_r($data['brand_data']); exit;
		$data['main_content']='product/blogview';
		$this->load->view('includes/template',$data);
	}

	function add_product_review(){
		if(empty($_POST['user_id'])){
			redirect('account/my_account');
		}
		$review_data = $_POST;
		$review_data['added_on'] = date('Y-m-d h:i:s');
		$review_data['status'] = 'P';
		$this->model->insertData('product_review',$review_data);
		$pvalue = $this->model->getData('product',array('product_id'=>$_POST['product_id']))[0];
		redirect('product/detailing/'.strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']);
	}

/*End of Controller*/
}
