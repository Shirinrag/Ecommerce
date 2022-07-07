<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->no_cache();
        $company_setting =  $this->model->getData('company_setting',array());
        $glob['company'] = $company_setting;

        $this->load->vars($glob);

        if(!$this->is_logged_in()){ 
            redirect('alogin');
        }
        date_default_timezone_set('Asia/Kolkata');
    }
    
    protected function no_cache(){
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0',false);
        header('Pragma: no-cache');
    }

    function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_admin_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != TRUE){ return FALSE; }
        return TRUE;
    }

    function logout() {
        $this->session->set_userdata(array('is_admin_logged_in' => FALSE));
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    function index(){   
        $str_total_earning = "SELECT ROUND(SUM(after_discounted_amount),2) as total FROM order_data WHERE  DATE(order_date_time) = '".date('Y-m-d')."'";
        $data['todays_earning'] = $this->model->getSqlData($str_total_earning);

        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d', strtotime("-7 day", strtotime($from_date)));
        
        $this_week_earning = "SELECT ROUND(SUM(after_discounted_amount),2) as total FROM order_data WHERE order_source='3' AND  (DATE(order_date_time) BETWEEN '".$to_date."' AND '".$from_date."')";
        $data['this_week_earning'] = $this->model->getSqlData($this_week_earning);

        $str_graph_query = "SELECT DATE(order_date_time) as order_date,ROUND(SUM(after_discounted_amount),2) as total FROM order_data 
                    WHERE order_source='3' AND  (DATE(order_date_time) BETWEEN '".$to_date."' AND '".$from_date."')
                    GROUP BY DATE(order_date_time)";
        $data['graph_data'] = $this->model->getSqlData($str_graph_query);

        // First day of the current month.
        $query_date = date('Y-m-d');
        $first_date = date('Y-m-01', strtotime($query_date));
        // Last day of the month.
        $last_date = date('Y-m-t', strtotime($query_date));
        $total_month_earning = "SELECT ROUND(SUM(after_discounted_amount),2) as total FROM order_data WHERE order_source='3' AND  (DATE(order_date_time) BETWEEN '".$first_date."' AND '".$last_date."')";
        $data['total_month_earning'] = $this->model->getSqlData($total_month_earning);

        $data['menu'] ='dashboard';
        $data['main_content']='admin/dashboard'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function warehouse(){
        $data['warehouse_list'] = $this->model->getData('warehouse');
        $data['menu'] ='warehouse';
        $data['main_content']='admin/warehouse';
        $this->load->view('admin/includes/template',$data);
    }

    function getProductData(){
        $sku = $_POST['sku'];
        $warehouse_id = $_POST['warehouse_id'];
        $product = $this->model->getData('product');

        $pack_wise_product_data = array();
        foreach ($product as $key => $value) {
            $value['stock'] = 0;
            if(!empty($value['pack_size'])){
                $packs = explode(',', $value['pack_size']);
                $price = explode(',', $value['price']);
                $vendor_sku = explode(',', $value['vendor_sku']);
                $sku2 = explode(',', $value['sku2']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = isset($packs[$key1])? $packs[$key1] : '';
                    $value['price'] = isset($price[$key1])? $price[$key1] : '';
                    $value['vendor_sku'] = isset($vendor_sku[$key1])? $vendor_sku[$key1] : '';
                    $value['sku2'] = isset($sku2[$key1])? $sku2[$key1] : '';
                    $stock = $this->model->getData('warehouse_stock',array('warehouse_id'=>$warehouse_id,'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                    if(isset($stock) &&  !empty($stock)){
                        $value['stock'] = $stock[0]['stock_qty'];
                    }
                    $pack_wise_product_data[] = $value;
                }

            }
            else{
                $value['pack_size'] = '';
                $stock = $this->model->getData('warehouse_stock',array('warehouse_id'=>$warehouse_id,'product_id'=>$value['product_id']));
                if(isset($stock) &&  !empty($stock)){
                    $value['stock'] = $stock[0]['stock_qty'];
                }
                $pack_wise_product_data[] = $value;
            }

        }
        $data = array();
        foreach ($pack_wise_product_data as $key => $value) {
            if($value['vendor_sku'] == $sku){
                $data = $value;
            }
            else if($value['sku2'] == $sku){
                $data = $value;
            }
        }
        echo json_encode($data);
    }

    function inword(){
        $current_supply_qty = $_POST['send_stock'];
        $warehouse_stock = $this->model->getData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'pack_size'=>$_POST['pack_size'],'product_id'=>$_POST['product_id']));
        if(isset($warehouse_stock) && empty($warehouse_stock)){
            $this->model->insertData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'product_id'=>$_POST['product_id'],'pack_size'=>$_POST['pack_size'],'stock_qty'=>$current_supply_qty));
        }
        else{
            $stock_qty = $warehouse_stock[0]['stock_qty'] + $current_supply_qty;
            $this->model->updateData('warehouse_stock',array('stock_qty'=>$stock_qty),array('stock_id'=>$warehouse_stock[0]['stock_id']));
        }
    }

    function outword(){
        $current_supply_qty = $_POST['send_stock'];
        $warehouse_stock = $this->model->getData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'pack_size'=>$_POST['pack_size'],'product_id'=>$_POST['product_id']));
        if(isset($warehouse_stock) && empty($warehouse_stock)){
            $this->model->insertData('warehouse_stock',array('warehous_id'=>$_POST['warehouse_id'],'product_id'=>$_POST['product_id'],'pack_size'=>$_POST['pack_size'],'stock_qty'=>0-$current_supply_qty));
        }
        else{
            $stock_qty = $warehouse_stock[0]['stock_qty'] - $current_supply_qty;
            $this->model->updateData('warehouse_stock',array('stock_qty'=>$stock_qty),array('stock_id'=>$warehouse_stock[0]['stock_id']));
        }
    }

    function add_new_user(){
        
        $data['user_role_list'] = $this->model->getData('op_user_role',array());
        $data['menu'] ='user';
        $data['main_content']='admin/add_new_user';
        $this->load->view('admin/includes/template',$data);
    }

    function isUserIdExist(){
        $postData = $_POST;
        $op_user = $this->model->getData('op_user',array('user_id' => $postData['user_id']));

        echo json_encode(!empty($op_user));
    }

    function add_user_role(){
        $data['menu'] ='user_role';
        $data['main_content']='admin/add_user_role';
        $this->load->view('admin/includes/template',$data);
    }

    function isRoleNameExist($role_name){
        $op_user_role = $this->model->getData('op_user_role',array('role_name' =>$role_name));

        return !empty($op_user_role);
    }

    function map_with(){
        $postData = $_POST;
        if($postData['map_with'] == 'B'){
            $branch =$this->model->getData("branch",array('status'=>'1'));
            echo json_encode($branch);
        }
        if($postData['map_with'] == 'W'){
            $warehouse =$this->model->getData("warehouse",array('status'=>'1'));
            echo json_encode($warehouse);
        }
        elseif($postData['map_with'] == 'K'){
            $kitchen =$this->model->getData("kitchen",array('status'=>'1'));
            echo json_encode($kitchen);
        }

        //echo json_encode($postData);
    }

    function add_new_category(){
        $data['category_list'] = $this->model->getData("category");;
        $data['menu'] ='category';
        $data['main_content']='admin/add_new_category';
        $this->load->view('admin/includes/template',$data);
    }

    function add_new_sub_category(){
        $data['menu'] ='subcategory';
        $data['category_data'] = $this->model->getAllData('category');
        $data['main_content']='admin/add_new_sub_category'; 
        $this->load->view('admin/includes/template',$data);
    }

    function add_new_child_category(){
        $data['menu'] ='childcategory';
        $data['category_data'] = $this->model->getAllData('category');
        $data['child_category_list'] = $this->model->getAllData('childcategory');
        foreach ($data['child_category_list'] as $key => $value) {
            $data['child_category_list'][$key]['category_name'] = $this->model->getValue('category','category_name',array('category_id'=>$value['category_id']));
            $data['child_category_list'][$key]['sub_category_name'] = $this->model->getValue('subcategory','sub_category_name',array('sub_category_id'=>$value['sub_category_id']));
        }
        $data['main_content']='admin/add_new_child_category'; 
        $this->load->view('admin/includes/template',$data);
    }

    function save_category(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $category_name = $array_entity['category_name'];
            $category_data =$this->model->getData("category",array('category_name'=>$category_name,'status'=>'1'));
            if(isset($category_data) && !empty($category_data)){
                $data['status'] = '0';
                $data['msg'] = 'Category already exist.';
            }else{
                $category_id = $this->model->insertData('category',array('category_name'=>$category_name));
                if($category_id>0){
                    $data['status'] = '1';
                    $data['msg'] = 'New category has been added successfully.';
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Something went wrong while submitting category.';
                }
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }

    function save_sub_category(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            
            $category_id = $array_entity['category_id'];
            $sub_category_name = $array_entity['sub_category_name'];
            $sub_category_data =$this->model->getData("subcategory",array('sub_category_name'=>$sub_category_name,'status'=>'1'));
            if(isset($sub_category_data) && !empty($sub_category_data)){
                $data['status'] = '0';
                $data['msg'] = 'Category already exist.';
            }else{
                $category_id = $this->model->insertData('subcategory',array('category_id'=>$category_id,'sub_category_name'=>$sub_category_name));
                if($category_id>0){
                    $data['status'] = '1';
                    $data['msg'] = 'New sub category has been added successfully.';
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Something went wrong while submitting sub category.';
                }
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }

    function save_child_category(){
        $this->model->insertData('childcategory',$_POST);
        $this->session->set_flashdata(array('class'=>'success','msg'=>'Child Category added Successfully'));
        redirect('admin/add_new_child_category');
    }

    function add_new_product(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='product';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['unit_list'] =$this->model->getData('product_unit',array('status'=>'1'));

        $data['main_content']='admin/add_new_product'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function add_new_recipe(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='recipe';
        $data['finish_goods'] = $this->model->getData('product',array('status'=>'1','product_type' => 'F'));
        $data['row_materials'] = $this->model->getData('product',array('status'=>'1','product_type'=> 'R'));
        $data['main_content']='admin/add_new_recipe'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function add_new_requisition(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='requisition';
        $data['product_list'] = $this->model->getData('product',array('status'=>'1'));
        $data['warehouse_list'] = $this->model->getData('warehouse',array('status'=>'1'));
        $data['branch_list'] = $this->model->getData('branch',array());
        $data['kitchen_list'] = $this->model->getData('kitchen',array());
        $data['main_content']='admin/add_new_requisition'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_next_req_no(){
        $postData = $_POST;
        $branch = $this->model->getData('branch',array('br_id'=>$postData['br_id']));
        $req_no = $this->model->generate_next_id('requisition','req_no',$branch[0]['branch_id']);
        echo json_encode($req_no);
    }

    function fetch_subcategory(){
        $product_category = $this->input->get_post('product_category');
        $category_data = $this->model->getData('subcategory',array('sub_category_id'=>$product_category));
        if (isset($category_data)) {
            echo '<option value="">Select division.</option>';
            foreach ($category_data as $key => $value) {
                echo '<option value="'.$value[0]['sub_category_id'].'">' . $value[0]['sub_category_name'] . "</option>";
            }
        }else{
            echo '<option value="">No Sub category found.</option>';
        }
    }

    function delete_user(){
        $user_id = $this->input->get_post('op_user_id');
        $this->model->deleteData('op_user',array('op_user_id'=>$user_id));
        
        $this->session->set_flashdata('msg' ,'The user has been deleted successfully.');

        redirect('admin/user_list');
    }

    function delete_user_role(){
        $role_id = $this->input->get_post('role_id');
        $this->model->deleteData('op_user_role',array('role_id'=>$role_id));
        $this->model->deleteData('role_access_level',array('role_id'=>$role_id));

        $this->session->set_flashdata('msg' ,'The role has been deleted successfully.');

        redirect('admin/user_role_list');
    }

    function delete_product(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $product_id = $array_entity['product_id'];
           
            $this->model->updateData('product',array('status'=>'0'),array('product_id'=>$product_id));    
            $data['status'] = '1';
            $data['msg'] = 'product has been deleted successfully.';
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product details';
        }
        echo json_encode($data);
    }

    function delete_branch(){
        $br_id = $this->input->get_post('br_id');
        $this->model->deleteData('branch',array('br_id'=>$br_id));
        $this->session->set_flashdata('msg' ,'The branch has been deleted successfully.');
        redirect('admin/branch_setting');
    }

    function delete_warehouse(){
        $jsonObj = $_POST['jsonObj']; 

        if(isset($jsonObj) && !empty($jsonObj)){
            $wid = $jsonObj;
           
            $this->model->deleteData('warehouse',array('wid'=>$wid)); 
            $data['msg'] = 'warehouse has been deleted successfully.';   
            $data['status'] = '1';
           // $this->session->set_flashdata('msg','warehouse has been deleted successfully.');
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product details';
        }
        echo json_encode($data);
    }

    function delete_kitchen(){
        $jsonObj = $_POST['jsonObj']; 

        if(isset($jsonObj) && !empty($jsonObj)){
            $kitchen_id = $jsonObj;
           
            $this->model->deleteData('kitchen',array('kitchen_id'=>$kitchen_id));    
            $data['status'] = 1;
            $data['msg'] = "kitchen has been deleted successfully.";
           // $this->session->set_flashdata('msg','kitchen has been deleted successfully.');
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product details';
        }
        echo json_encode($data);
    }

    function delete_gst_setting(){
        $jsonObj = $_POST['jsonObj']; 

        if(isset($jsonObj) && !empty($jsonObj)){
            $gst_set_id = $jsonObj;
           
            $this->model->deleteData('gst_setting',array('gst_set_id'=>$gst_set_id));    
            $data['status'] = 1;
            $data['msg'] = "Gst setting has been deleted successfully.";
           // $this->session->set_flashdata('msg','Gst setting has been deleted successfully.');
        
        }else{
           
        }
        echo json_encode($data);
    }

    function submit_user(){

        $user_array = $_POST;
        $user_array['status'] = '1';
        $user_array['password'] = md5($user_array['password']);
        $branches = $user_array['map_with_branch'];
        unset($user_array['map_with_branch']);
        unset($user_array['confirm_password']);
        //echo '<pre>';print_r($user_array);exit;
        $uploaddir = './uploads/user_profile/';
        $filename = rand().basename($_FILES['profile_photo']['name']);
        $uploadfile = $uploaddir . $filename;
        

        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadfile)) {
          echo "File is valid, and was successfully uploaded.\n";
          $user_array['profile_photo'] = $filename;
        } else {
           echo "Upload failed";
           $user_array['profile_photo'] = "";
        }

        if($user_array['map_with'] == 'B'){
            $user_array['map_with_id'] = '';
        }

        $user_id = $this->model->insertData('op_user',$user_array);

        if($user_array['map_with'] == 'B'){
            foreach ($branches as $branch_id) {
                $user_branch = array(
                    'user_id'=>$user_id,
                    'branch_id'=>$branch_id
                );
                $this->model->insertData('user_branches',$user_branch);
            }
            exit;
        }

        $this->session->set_flashdata('msg', 'The new user has been added successfully.');
        redirect('admin/user_list');
          
    }

    function submit_user_role(){

        $user_role_array = $_POST;

        if($this->isRoleNameExist($user_role_array['role_name'])){
            $this->session->set_flashdata('msg', ' Role name  ('.$user_role_array['role_name'].')  is already exist');
            redirect('admin/add_user_role');
        }

        $access_levels = isset($user_role_array['access_level']) ? $user_role_array['access_level'] : array();


        if(isset($user_role_array['access_level'])){
            unset($user_role_array['access_level']);
        }
        $role_id = $this->model->insertData('op_user_role',$user_role_array);

        if(!empty($access_levels)){
            foreach($access_levels as $sub_module => $sub_module_value){
                $access_level_array = array(
                    'role_id' => $role_id,
                    'module_name' => $sub_module,
                    'view_access'=>isset($sub_module_value['view_access'])?$sub_module_value['view_access'] :'0',
                    'update_access'=>isset($sub_module_value['update_access'])?$sub_module_value['update_access'] : '0',
                    'full_access'=>isset($sub_module_value['full_access'])?$sub_module_value['full_access']:'0'
                );
                $this->model->insertData('role_access_level',$access_level_array);
            }
        }
        
        $this->session->set_flashdata('msg', 'The new user role has been added successfully.');
        redirect('admin/user_role_list');

    }
    
    // function getCategoryTree($parent = 0){
    //     $category_list = $this->model->getData('category',array('parent_category_id'=>$parent));
    //     $subcategory = [];$subcategory1 = [];$subcategory2 = [];$subcategory3 = [];$subcategory4 = [];$subcategory5 = [];
    //     foreach ($category_list as $key => $value) {
    //         $subcategory = $this->model->getData('category',array('parent_category_id'=>$value['category_id']));
    //         foreach ($subcategory as $key1 => $value1) {
    //             $subcategory1 = $this->model->getData('category',array('parent_category_id'=>$value1['category_id']));
    //             foreach ($subcategory1 as $key2 => $value2) {
    //                 $subcategory2 = $this->model->getData('category',array('parent_category_id'=>$value2['category_id']));
    //                 foreach ($subcategory2 as $key3 => $value3) {
    //                     $subcategory3 = $this->model->getData('category',array('parent_category_id'=>$value3['category_id']));
    //                     foreach ($subcategory3 as $key4 => $value4) {
    //                         $subcategory4 = $this->model->getData('category',array('parent_category_id'=>$value4['category_id']));
    //                         foreach ($subcategory4 as $key5 => $value5) {
    //                             $subcategory5 = $this->model->getData('category',array('parent_category_id'=>$value5['category_id']));
    //                             if(isset($subcategory5[0])){
    //                                 $subcategory4[0]['subcategory'] = $subcategory5[0];
    //                             }
    //                         }
    //                         if(isset($subcategory4[0])){
    //                             $subcategory3[0]['subcategory'] = $subcategory4[0];
    //                         }
    //                     }
    //                     if(isset($subcategory3[0])){
    //                         $subcategory2[0]['subcategory'] = $subcategory3[0];
    //                     }
    //                 }
    //                 if(isset($subcategory2[0])){
    //                     $subcategory1[0]['subcategory'] = $subcategory2[0];
    //                 }
    //             }
    //             if(isset($subcategory1[0])){
    //                 $subcategory[0]['subcategory'] = $subcategory1[0];
    //             }
    //         }
    //         if(isset($subcategory[0])){
    //             $category_list[$key]['subcategory'] = $subcategory[0];
    //         }
    //     }

    //     return $category_list;
    // }

    function submit_product(){
        $_POST['status'] = '1';
        $_POST['stock_status'] = '1';
        $product_array = $_POST;
        if(isset($_FILES['product_image']) && !empty($_FILES['product_image'])){
            $uploaddir = 'products/';
            $filename = rand().basename($_FILES['product_image']['name']);
            $uploadfile = $uploaddir . $filename;
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadfile)) {
              echo "File is valid, and was successfully uploaded.\n";
              $product_array['product_image'] = $filename;
            } else {
               echo "Upload failed";
               $product_array['product_image'] = "";
            }
        }
        $this->model->insertData('product',$product_array);
        $this->session->set_flashdata('msg', 'The new product has been uploaded successfully.');
        redirect('admin/product_list');
    }

    function submit_recipe(){
        $recipe_array = $_POST;
        $isRecipeExist =  $this->model->isExist('recipe','product_id',$recipe_array['product_id']);
        if($isRecipeExist){
            $product_name = $this->model->getValue('product','product_name',array('product_id'=>$recipe_array['product_id']));
            $this->session->set_flashdata(array('class'=>'danger','msg'=>'Recipe of '.$product_name.' already exist'));
            redirect('admin/add_new_recipe');
        }
        $rec_products = $recipe_array['product_rows'];
        unset($recipe_array['product_rows']);
        $recipe_id = $this->model->insertData('recipe',$recipe_array);
        foreach ($rec_products as $product) {
            $product['recipe_id'] = $recipe_id;
            $this->model->insertData('recipe_products',$product);    
        }
        $this->session->set_flashdata('msg', 'The new recipe has been added successfully.');
        redirect('admin/recipe_list');
    }

    function submit_requisition(){

        $requisition_array = $_POST;
        $requisition_array['status'] = 'P';

        $req_products = $requisition_array['product_rows'];
        unset($requisition_array['product_rows']);

       // echo '<pre>';print_r($requisition_array); exit;
        $requisition_array['delivery_required_on'] = date('Y-m-d',strtotime($requisition_array['delivery_required_on']));
        $req_id = $this->model->insertData('requisition',$requisition_array);

        foreach ($req_products as $product) {
            $product['req_id'] = $req_id;
            
            $this->model->insertData('requisition_products',$product);    
        }
        $this->session->set_flashdata('msg', 'The new requisiion has been added successfully.');
        redirect('admin/requisition_list');
          
    }

    function submit_branch(){
        $branch_array = $_POST;
        $branch_array['status'] = '1';
        $this->model->insertData('branch',$branch_array);
        $this->session->set_flashdata('msg', 'The new branch has been added successfully.');
        redirect('admin/branch_setting');
    }

    function submit_warehouse(){
        $warehouse_array = $_POST;
        $map_with_kitchens = $warehouse_array['kitchens'];
        unset($warehouse_array['kitchens']);
        $warehouse_array['status'] = '1';
        $wid = $this->model->insertData('warehouse',$warehouse_array);

        if(!empty($map_with_kitchens)){
            foreach ($map_with_kitchens as $kitchen_id) {
                $newdata = array(
                    'wid' => $wid,
                    'kitchen_id'=>$kitchen_id
                );
                $this->model->insertData('warehouse_to_kitchens',$newdata);
            }
        }
        $this->session->set_flashdata('msg', 'The new warehouse has been added successfully.');
        redirect('admin/warehouse_setting');
    }

    function submit_kitchen(){
        $kitchen_array = $_POST;
        $kitchen_array['status'] = '1';
        $this->model->insertData('kitchen',$kitchen_array);
        $this->session->set_flashdata('msg', 'The new kitchen has been added successfully.');
        redirect('admin/kitchen_setting');
    }
    function edit_user(){
        $user_id = $this->input->get_post('op_user_id');
        $data['user'] = $this->model->getData('op_user',array('op_user_id'=>$user_id));
        $data['user_role_list'] = $this->model->getData('op_user_role',array());
        $branches = $this->model->getData('user_branches',array('user_id'=> $user_id));
        $data['branches'] = $branches;
        $data['menu'] ='user';
        $data['main_content']='admin/edit_user'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_user_role(){
        $role_id = $this->input->get_post('role_id');
        $user_role = $this->model->getData('op_user_role',array('role_id'=>$role_id));

        foreach ($user_role as $key => $value) {
            $access_levels = $this->model->getData('role_access_level',array('role_id'=>$value['role_id']));

            $access_levels2 = array();
            foreach ($access_levels as $key1 => $value1) {
                $access_levels2[$value1['module_name']] = array(
                    'view_access'   => $value1['view_access'],
                    'update_access' => $value1['update_access'],
                    'full_access'   => $value1['full_access']
                );
            }
            $user_role[$key]['access_level'] = $access_levels2;
        }
        $data['user_role'] = $user_role;
        $data['menu'] ='user_role';
        $data['main_content']='admin/edit_user_role';
        $this->load->view('admin/includes/template',$data);
    }

    function edit_product(){
        $product_id = $this->input->get_post('product_id');
        $data['product_data'] = $this->model->getData('product',array('product_id'=>$product_id));
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='product';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['unit_list'] =$this->model->getData('product_unit',array('status'=>'1'));
        $data['main_content']='admin/edit_product'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_recipe(){
        $recipe_id = $this->input->get_post('recipe_id');
        $data['menu'] ='recipe';
        $data['finish_goods'] = $this->model->getData('product',array('status'=>'1','product_type' => 'F'));
        $data['row_materials'] = $this->model->getData('product',array('status'=>'1','product_type'=> 'R'));
        $data['recipe'] = $this->model->getData('recipe',array('recipe_id'=>$recipe_id));
        $data['recipe_products'] =  $this->model->getData('recipe_products',array('recipe_id'=>$recipe_id)); 
        $data['main_content']='admin/edit_recipe'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_requisition(){
        $req_id = $this->input->get_post('req_id');
        $data['requisition'] = $this->model->getData('requisition',array('req_id'=>$req_id));
        $data['req_products'] = $this->model->getData('requisition_products',array('req_id'=>$req_id));
        $data['warehouse_list'] = $this->model->getData('warehouse',array('status'=>'1'));
        $data['branch_list'] = $this->model->getData('branch',array());
        $data['product_list'] = $this->model->getData('product',array('status'=>'1'));
        $data['kitchen_list'] = $this->model->getData('kitchen',array());
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='requisition';
        $data['main_content']='admin/edit_requisition'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_branch(){
        $branch_id = $this->input->get_post('br_id');
        $data['branch'] = $this->model->getData('branch',array('branch_id'=> $branch_id));
        $data['menu'] ='setting';
        $data['main_content']='admin/edit_branch'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_warehouse(){
        $wid = $this->input->get_post('wid');
        $data['warehouse'] = $this->model->getData('warehouse',array('wid'=>$wid));
        $data['kitchen_list'] = $this->model->getData('kitchen');
        $kitchens = $this->model->getData('warehouse_to_kitchens',array('wid'=> $wid));
        $data['kitchens'] = $kitchens;

        $data['menu'] ='warehouse';
        $data['main_content']='admin/edit_warehouse'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_kitchen(){
        $kitchen_id = $this->input->get_post('kitchen_id');
        $data['kitchen'] = $this->model->getData('kitchen',array('kitchen_id'=>$kitchen_id));
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='kitchen';
        $data['main_content']='admin/edit_kitchen'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }


    function view_requisition(){
        $req_id = $this->input->get_post('req_id');
        $requisition = $this->model->getData('requisition',array('req_id'=>$req_id));
        $branch = $this->model->getData('branch',array('br_id'=>$requisition[0]['branch_id']));
        $requisition[0]['branch_name'] = $branch[0]['branch_name'];
        $data['requisition'] = $requisition;
        $data['req_products'] = $this->model->getData('requisition_products',array('req_id'=>$req_id));
        $data['warehouse'] = $this->model->getData('warehouse',array('status'=>'1','wid'=>$data['requisition'][0]['warehouse_id']));
       
        $product_list = $this->model->getData('product',array('status'=>'1'));
        $product_list2 = array();
        foreach ($product_list as $key => $value) {
            $product_list2[$value['product_id']] = $value;
        }
        $data['product_list'] = $product_list2;

        $product_unit_list = $this->model->getData('product_unit',array('status'=>'1'));
        $product_unit_list2 = array();
        foreach ($product_unit_list as $key => $value) {
            $product_unit_list2[$value['unit_id']] = $value;
        }
        $data['product_unit_list'] = $product_unit_list2;

        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='requisition';
        $data['main_content']='admin/view_requisition'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function update_user()
    {
        $user_array = $_POST;
        $branches = $_POST['map_with_branch'];
        unset($user_array['map_with_branch']);
        $op_user_id = $user_array['op_user_id'];
        if($_FILES['profile_photo']['name'] != ''){
            $uploaddir = './uploads/user_profile/';
            $filename = rand().basename($_FILES['profile_photo']['name']);
            $uploadfile = $uploaddir . $filename;
            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadfile)) {
              echo "File is valid, and was successfully uploaded.\n";
              $user_array['profile_photo'] = $filename;
            } else {
               echo "Upload failed";
               $user_array['profile_photo'] = "";
            }
        }
        $this->model->updateData('op_user',$user_array,array('op_user_id'=>$op_user_id));
        $v_branches = array();
        foreach ($branches as $branch_id) {
           $user_branch = $this->model->getData('user_branches',array('user_id'=>$op_user_id,'branch_id'=>$branch_id));
           $v_branches[] = !empty($user_branch[0])? $user_branch[0] : array('user_branch_id'=>'','user_id'=>$op_user_id,'branch_id'=>$branch_id);
        }
        $db_branches = $this->model->getData('user_branches',array('user_id'=>$op_user_id));

        $db_bid_array = array();
        foreach ($db_branches as $key => $value) {
            $db_bid_array[] = $value['user_branch_id'];
        }

        $v_bid_array = array();
        foreach ($v_branches as $key => $value) {
            $v_bid_array[] = $value['user_branch_id'];
        }

        foreach ($v_branches as $key => $value) {

            if(in_array($value['user_branch_id'], $db_bid_array)){
                $this->model->updateData('user_branches',$value,array('user_branch_id'=>$value['user_branch_id']));
            }
            else{
                $this->model->insertData('user_branches',$value);
            }
        }
        foreach ($db_branches as $key => $value) {
            if(in_array($value['user_branch_id'], $v_bid_array)){
                //No action
            }
            else{
                $this->model->deleteData('user_branches',array('user_branch_id'=>$value['user_branch_id']));
            }
        }

        $this->session->set_flashdata('msg' ,'The user details has been updated successfully.');
        redirect('admin/user_list');
    }

     function update_user_role(){
        $user_role_array = $_POST;
        $access_levels = isset($user_role_array['access_level']) ? $user_role_array['access_level'] : array();


        if(isset($user_role_array['access_level'])){
            unset($user_role_array['access_level']);
        }
        $this->model->updateData('op_user_role',$user_role_array,array('role_id'=>$user_role_array['role_id']));

        $db_access_levels = $this->model->getData('role_access_level',array('role_id'=>$user_role_array['role_id']));

        $db_access_levels2 = array();
        if(!empty($db_access_levels)){
            foreach ($db_access_levels as $key => $value) {
                $db_access_levels2[$value['module_name']] = $value;
            }
        }
        if(!empty($db_access_levels2)){
            foreach($db_access_levels as $sub_module => $sub_module_value){

                $access_level_array = array();

                if(isset($db_access_levels[$sub_module]) && !isset($access_levels[$sub_module])){
                    $access_level_array['view_access'] = '0';
                    $access_level_array['update_access'] = '0';
                    $access_level_array['full_access'] = '0';

                    $where_array = array(
                        'role_id' => $user_role_array['role_id'],
                        'module_name' => $sub_module
                    );

                    $this->model->updateData('role_access_level',$access_level_array,$where_array);
                }
            }
        }

        if(!empty($access_levels)){
            foreach($access_levels as $sub_module => $sub_module_value){

                $access_level_array = array();

                if(isset($access_levels[$sub_module]) && !isset($db_access_levels2[$sub_module])){
                    
                    $access_level_array['role_id'] = $user_role_array['role_id'];
                    $access_level_array['module_name'] = $sub_module;
                    $access_level_array['view_access'] = isset($sub_module_value['view_access'])?$sub_module_value['view_access'] : '0';
                    $access_level_array['update_access'] = isset($sub_module_value['update_access'])?$sub_module_value['update_access'] : '0';
                    $access_level_array['full_access'] = isset($sub_module_value['full_access'])?$sub_module_value['full_access'] : '0';

                    $this->model->insertData('role_access_level',$access_level_array );
                }
                else if(isset($access_levels[$sub_module]) && isset($db_access_levels2[$sub_module])){
                    $access_level_array['view_access'] = isset($sub_module_value['view_access'])?$sub_module_value['view_access'] : '0';
                    $access_level_array['update_access'] = isset($sub_module_value['update_access'])?$sub_module_value['update_access'] : '0';
                    $access_level_array['full_access'] = isset($sub_module_value['full_access'])?$sub_module_value['full_access'] : '0';

                    $where_array = array(
                        'role_id' => $user_role_array['role_id'],
                        'module_name' => $sub_module
                    );

                    $this->model->updateData('role_access_level',$access_level_array,$where_array);
                }
            }
        }
        
        $this->session->set_flashdata('msg', 'The new user role has been added successfully.');
        redirect('admin/user_role_list');
          
    }


    function update_product(){
        // if(isset($_FILES['product_image']) && ($_FILES['product_image']['name']!="")){
            //     $target_dir = "products/"; 
            //     $new_image_name = strtolower(preg_replace('/\s+/', '-', $product_name)).'.png'; 
            //     $target_file = $target_dir . $new_image_name; 
            //     $uploadOk = 1;
            //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            //     // Check if image file is a actual image or fake image
                
            //     $check = getimagesize($_FILES["product_image"]["tmp_name"]);
            //     if($check !== false) {
            //         $data['status'] = '0';
            //         $data['msg'] = 'File is an image - "' . $check["mime"] . '".';
            //         $uploadOk = 1;
            //     } else {
            //         $data['status'] = '0';
            //         $data['msg'] = 'File is not an image.';
            //         $uploadOk = 0;
            //     }
                
            //     // Check if file already exists
            //     if (file_exists($target_file)) {
            //         unlink ($target_file); 
            //         /*$data['status'] = '0';
            //         $data['msg'] = 'Sorry, file already exists.';
            //         $uploadOk = 0;*/
            //     }
            //    /* // Check file size
            //     if ($_FILES["product_image"]["size"] > 500000) {
            //         $data['status'] = '0';
            //         $data['msg'] = 'Sorry, your file is too large.';
            //         $uploadOk = 0;
            //     }
            //     // Allow certain file formats
            //     if($imageFileType != "png") {
            //         $data['status'] = '0';
            //         $data['msg'] = 'Sorry, only .PNG files are allowed.';
            //         $uploadOk = 0;
            //     }*/
            //     // Check if $uploadOk is set to 0 by an error
            //     if ($uploadOk == 0) {
            //         $data['status'] = '0';
            //         $data['msg'] = 'Sorry, your file was not uploaded.';
            //     // if everything is ok, try to upload file
            //     } else {
            //         if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        if($_FILES['product_image']['name'] != ''){
            $uploaddir = './uploads/category/';
            $filename = rand().basename($_FILES['product_image']['name']);
            $uploadfile = $uploaddir . $filename;
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadfile)) {
              echo "File is valid, and was successfully uploaded.\n";
              $product_image = $filename;
            } else {
               echo "Upload failed";
               $product_image = "";
            }
        }
        else{
            $product_image = $this->model->getValue('product','image_name',array('product_id'=>$_POST['product_id']));
        } 
        $_POST['image_name'] = $product_image;               
        $_POST['expiry_date'] = date('Y-m-d',strtotime($_POST['expiry_date']));
        $this->model->updateData('product',$_POST,array('product_id'=>$_POST['product_id']));
                        
        $this->session->set_flashdata('msg' ,'The product details has been updated successfully.');

        redirect('admin/product_list');
    }

    function update_recipe(){
        $recipe_array = $_POST;
        $rec_products = $recipe_array['product_rows'];
        unset($recipe_array['product_rows']);
        $this->model->updateData('recipe',$recipe_array,array('recipe_id'=>$recipe_array['recipe_id']));
       
        $db_rec_products = $this->model->getData('recipe_products',array('recipe_id'=>$recipe_array['recipe_id']));

        $db_prodid_array = array();
        foreach ($db_rec_products as $key => $value) {
            $db_prodid_array[] = $value['rec_prod_id'];
        }

        $v_prodid_array = array();
        foreach ($rec_products as $key => $value) {
            $v_prodid_array[] = $value['rec_prod_id'];
        }

        foreach ($rec_products as $key => $value) {
            // echo '<pre>'; print_r($value);
            if(in_array($value['rec_prod_id'], $db_prodid_array)){
                $this->model->updateData('recipe_products',$value,array('rec_prod_id'=>$value['rec_prod_id']));
            }
            else{
                $value['recipe_id'] = $recipe_array['recipe_id'];
                $this->model->insertData('recipe_products',$value);

            }
        }
        foreach ($db_rec_products as $key => $value) {
            if(in_array($value['rec_prod_id'], $v_prodid_array)){
                //no action
            }
            else{
                $this->model->deleteData('recipe_products',array('rec_prod_id'=>$value['rec_prod_id']));
            }
        }
        $this->session->set_flashdata('msg', 'The new recipe has been updated successfully.');
        redirect('admin/recipe_list');
    }

    function update_requisition(){
        $requisition_array = $_POST;
        $req_products = $requisition_array['product_rows'];
        unset($requisition_array['product_rows']);
        $requisition_array['delivery_required_on'] = date('Y-m-d',strtotime($requisition_array['delivery_required_on']));
        $this->model->updateData('requisition',$requisition_array,array('req_id'=>$requisition_array['req_id']));
       
        $db_req_products = $this->model->getData('requisition_products',array('req_id'=>$requisition_array['req_id']));

        $db_prodid_array = array();
        foreach ($db_req_products as $key => $value) {
            $db_prodid_array[] = $value['req_prod_id'];
        }

        $v_prodid_array = array();
        foreach ($req_products as $key => $value) {
            $v_prodid_array[] = $value['req_prod_id'];
        }

        foreach ($req_products as $key => $value) {
            // echo '<pre>'; print_r($value);
            if(in_array($value['req_prod_id'], $db_prodid_array)){
                $this->model->updateData('requisition_products',$value,array('req_prod_id'=>$value['req_prod_id']));
            }
            else{
                $value['req_id'] = $requisition_array['req_id'];
                $this->model->insertData('requisition_products',$value);
            }
        }
        foreach ($db_req_products as $key => $value) {
            if(in_array($value['req_prod_id'], $v_prodid_array)){
                //no action
            }
            else{
                $this->model->deleteData('requisition_products',array('req_prod_id'=>$value['req_prod_id']));
            }
        }
        $this->session->set_flashdata('msg', 'The new requisiion has been updated successfully.');
        redirect('admin/requisition_list');
    }

    function update_branch()
    {
        $branch_array = $_POST;
        $br_id = $branch_array['br_id'];
        $this->model->updateData('branch',$branch_array,array('br_id'=>$br_id));
        $this->session->set_flashdata('msg' ,'The branch details has been updated successfully.');
        redirect('admin/branch_setting');
    }

    function update_warehouse()
    {
        $warehouse_array = $_POST;
        $wid = $warehouse_array['wid'];
        $kitchens = $_POST['kitchens'];
        unset($warehouse_array['kitchens']);
        $this->model->updateData('warehouse',$warehouse_array,array('wid'=>$wid));
        
        $v_kitchens = array();
        foreach ($kitchens as $kitchen_id) {
           $w_to_k = $this->model->getData('warehouse_to_kitchens',array('wid'=>$wid,'kitchen_id'=>$kitchen_id));
           $v_kitchens[] = !empty($w_to_k[0])? $w_to_k[0] : array('wkid'=>'','wid'=>$wid,'kitchen_id'=>$kitchen_id);
        }
        $db_kitchens = $this->model->getData('warehouse_to_kitchens',array('wid'=>$wid));

        $dkid_array = array();
        foreach ($db_kitchens as $key => $value) {
            $dkid_array[] = $value['wkid'];
        }

        $vkid_array = array();
        foreach ($v_kitchens as $key => $value) {
            $vkid_array[] = $value['wkid'];
        }

        foreach ($v_kitchens as $key => $value) {

            if(in_array($value['wkid'], $dkid_array)){
                $this->model->updateData('warehouse_to_kitchens',$value,array('wkid'=>$value['wkid']));
            }
            else{
                $this->model->insertData('warehouse_to_kitchens',$value);
            }
        }
        foreach ($db_kitchens as $key => $value) {
            if(in_array($value['wkid'], $vkid_array)){
                //No action
            }
            else{
                $this->model->deleteData('warehouse_to_kitchens',array('wkid'=>$value['wkid']));
            }
        }
        $this->session->set_flashdata('msg' ,'The warehouse details has been updated successfully.');
        redirect('admin/warehouse_setting');
    }

    function update_kitchen()
    {
        $warehouse_array = $_POST;
        $kitchen_id = $warehouse_array['kitchen_id'];
        $this->model->updateData('kitchen',$warehouse_array,array('kitchen_id'=>$kitchen_id));
        $this->session->set_flashdata('msg' ,'The kithen details has been updated successfully.');
        redirect('admin/kitchen_setting');
    }

    function send_requisition()
    {
        $requisition_array = $_POST;
        $requisition_array['delivered_on'] = date('Y-m-d');
        $vreq_products = $requisition_array['product_rows'];
        unset($requisition_array['product_rows']);
        $delivered = true;
        foreach ($vreq_products as $key =>$vreq_product) {
            if($vreq_product['remaining_qty'] > 0){
                $delivered = false;
            }
            $current_supply_qty = $vreq_product['current_supply_qty'];
            unset($vreq_product['current_supply_qty']);
            $this->model->updateData('requisition_products',$vreq_product,array('req_prod_id'=>$vreq_product['req_prod_id']));

            $kitchen_stock = $this->model->getData('kitchen_stock',array('kitchen_id'=>$_POST['kitchen_id'],'pack_size'=>$vreq_product['pack_size'],'product_id'=>$vreq_product['product_id']));
            if(isset($kitchen_stock) && empty($kitchen_stock)){
                $this->model->insertData('kitchen_stock',array('kitchen_id'=>$_POST['kitchen_id'],'product_id'=>$vreq_product['product_id'],'pack_size'=>$vreq_product['pack_size'],'stock_qty'=>$current_supply_qty,'modified_on'=>date('Y-m-d h:i:s')));
            }
            else{
                $stock_qty = $kitchen_stock[0]['stock_qty']+$current_supply_qty;
                $this->model->updateData('kitchen_stock',array('stock_qty'=>$stock_qty,'modified_on'=>date('Y-m-d h:i:s')),array('stock_id'=>$kitchen_stock[0]['stock_id']));
            }

            $warehouse_stock = $this->model->getData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'pack_size'=>$vreq_product['pack_size'],'product_id'=>$vreq_product['product_id']));
            if(isset($warehouse_stock) && empty($warehouse_stock)){
                $this->model->insertData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'product_id'=>$vreq_product['product_id'],'pack_size'=>$vreq_product['pack_size'],'stock_qty'=>0-$current_supply_qty,'modified_on'=>date('Y-m-d h:i:s')));
            }
            else{
                $stock_qty = $warehouse_stock[0]['stock_qty'] - $current_supply_qty;
                $this->model->updateData('warehouse_stock',array('stock_qty'=>$stock_qty,'modified_on'=>date('Y-m-d h:i:s')),array('stock_id'=>$warehouse_stock[0]['stock_id']));
            }
        }
        $requisition_array['status'] = $delivered ? 'D' : 'PD';

        $this->model->updateData('requisition',$requisition_array,array('req_id'=>$requisition_array['req_id']));


        $this->session->set_flashdata('msg', 'The new requisiion has been updated successfully.');
        redirect('admin/requisition_list');
    }

    function user_list(){
        $data['user_list'] = $this->model->getData('op_user',array());
        $data['menu'] ='user';
        $data['main_content']='admin/user_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function user_role_list(){
        $user_role_list = $this->model->getData('op_user_role',array());

        // foreach ($user_role_list as $key => $value) {
        //     $access_levels = $this->model->getData('role_access_level',array('role_id'=>$value['role_id']));
        //     $user_role_list[$key]['access_levels'] = $access_levels;
        // }

        $data['user_role_list'] = $user_role_list;
        //echo '<pre>'; print_r($data); exit;
        $data['menu'] ='user_role';
        $data['main_content']='admin/user_role_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function product_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='product';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['main_content']='admin/product_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_product_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('product');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM product WHERE status = '1' ";
        if( !empty($requestData['search']['value']) ) { 
             $sql.="  AND ( product_name LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY product_name ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $product_details=$this->model->getSqlData($sql);
        $data = array();

        $pack_wise_product_data = array();
        foreach ($product_details as $key => $value) {
            if(!empty($value['pack_size'])){
                $packs = explode(',', $value['pack_size']);
                $price = explode(',', $value['price']);
                $vendor_sku = explode(',', $value['vendor_sku']);
                $sku2 = explode(',', $value['sku2']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = $value1;
                    $value['price'] = isset($price[$key1])?$price[$key1]:'';
                    $value['vendor_sku'] = isset($vendor_sku[$key1])? $vendor_sku[$key1] : '';
                    $value['sku2'] = isset($sku2[$key1])? $sku2[$key1] : '';
                    $pack_wise_product_data[] = $value;
                }
            }
            else{
                $pack_wise_product_data[] = $value;
            }
        }

        foreach ($pack_wise_product_data as $key => $value) {
            $category_data = $this->model->getData('category',array('category_id'=>$value['category_id']));
            $sub_category_data = $this->model->getData('subcategory',array('sub_category_id'=>$value['sub_category_id']));
            $stock_status = '';
            
            $nestedData=array();
            $nestedData[] = $value['product_id'];
            $nestedData[] = strtoupper($value['product_name']);
            $nestedData[] = $value['pack_size'];
            $nestedData[] = $value['vendor_sku'];
            $nestedData[] = $value['sku2'];
            $nestedData[] = strtoupper($category_data[0]['category_name']);
            $nestedData[] = strtoupper($sub_category_data[0]['sub_category_name']);
            $nestedData[] = "<i class='fa fa-rupee'></i> ".$value['price'];
         /*   $nestedData[] = "<i class='fa fa-rupee'></i> ".$value['old_price'];*/

            if($value['status']=='0'){
                $update_active = access('product_list','update_access') ?  "onclick='update_product_status(this,1,".$value['product_id'].")'":"";
                $nestedData[] = "<a href='javascript:void(0);'".$update_active." >DE-ACTIVE</a>";
            }else{
                $update_deactive = access('product_list','update_access') ?  "onclick='update_product_status(this,0,".$value['product_id'].")'":"";
                $nestedData[] = "<a href='javascript:void(0);'".$update_deactive.">ACTIVE</a>";
            }


            if($value['stock_status']=='0'){
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_stock_status(this,1,".$value['product_id'].")'>Out of Stock</a>";
            }else{
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_stock_status(this,0,".$value['product_id'].")'>In Stock</a>";
            }

            $edit = (access('product_list','update_access') || access('product_list','full_access')) ? "<li><a href=".base_url()."admin/edit_product?product_id=".$value['product_id']."><i class='fa fa-pencil'></i></a></li>":'' ;
            $delete = access('product_list','full_access') ? "<li><a href='#' onclick='delete_product(this,".$value['product_id'].")'><i class='fa fa-trash'></i></a></li>" : '';

            $nestedData[] = "<ul class='table-options'>".$edit.$delete."</ul>";

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

    function get_product_details(){
        $product_id = $this->input->post('product_id');
        $data['product'] = $this->model->getData('product',array('status'=>'1','product_id'=>$product_id))[0];
        $data['product_unit'] = $this->model->getData('product_unit',array('status'=>'1','unit_id'=>$data['product']['unit_id']))[0];
        echo json_encode($data);
    }

    function recipe_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='recipe';
        $data['main_content']='admin/recipe_list'; //dashboard
        $recipe=$this->model->getData('recipe',array());
        foreach ($recipe as $key => $value) {
            $product = $this->model->getData('product',array('product_id'=>$value['product_id']));
            $recipe[$key]['product_name'] = $product[0]['product_name'];
        }
        $data['recipe'] = $recipe;
        $this->load->view('admin/includes/template',$data);
    }

    function requisition_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='requisiion';
        $data['main_content']='admin/requisition_list'; //dashboard
        $op_user_id = $this->session->userdata('op_user_id');
        $user = $this->model->getData('op_user',array('op_user_id'=>$op_user_id));
        
        $where = array();
        $where_in = array();
        if($user[0]['map_with'] == 'W'){
            $where['warehouse_id'] = $user[0]['map_with_id'];
        }
        else if($user[0]['map_with'] == 'K'){
            $kitchen_id = $user[0]['map_with_id'];
            $w_to_k = $this->model->getData('warehouse_to_kitchens',array('kitchen_id'=>$kitchen_id));

            $wid_array = array();
            foreach ($w_to_k as $key => $value) {
                $wid_array[] = $value['wid'];
            }
            $where_in['field'] = 'warehouse_id';
            $where_in['in_array'] = $wid_array;
            // echo '<pre>'; print_r($where_in); exit;
        }
        elseif ($user[0]['map_with'] == 'B'){
            $branches = $this->model->getData('user_branches',array('user_id'=>$op_user_id));
            $branch_id_array = array();
            foreach ($branches as $key => $value) {
                $branch_id_array[] = $value['branch_id'];
            }
            $where_in['field'] = 'branch_id';   
            $where_in['in_array'] = $branch_id_array;
        }
        $data['requisitions']=$this->model->getData('requisition',$where,$where_in);
        $this->load->view('admin/includes/template',$data);
    }

    function filterRequisition(){
        $postData = $_POST;
        $filter = array();

        if($postData['from_date'] != ''){
            $filter['req_date >='] = date('Y-m-d',strtotime($postData['from_date']));
        }
        if($postData['to_date'] != ''){
            $filter['req_date <='] = date('Y-m-d',strtotime($postData['to_date']));
        }
        if($postData['status'] != ''){
            $filter['status'] = $postData['status'];
        }
        $data['requisitions'] = $this->model->getData('requisition',$filter);
        echo json_encode($data);
        
    }

    function production(){
        $data['menu'] ='production';
        $data['main_content']='admin/production'; //dashboard
        $requirements = $this->model->getDataOrderBy('requisition',array('status !='=>'D'),'delivery_required_on','ASC');
        $batch_id = $this->model->generate_next_id('production','batch_id','batch');
        $i = 0;

        /***************** Requirement Tab Content***********************/
            foreach ($requirements as $key => $value) {
                $req_products = $this->model->getData('requisition_products',array('req_id'=>$value['req_id']));
                foreach ($req_products as $key1 => $value1) {
                    $product = $this->model->getData('product',array('product_id'=>$value1['product_id']));
                    
                    $category = $this->model->getData('category',array('category_id'=>$product[0]['category_id']));
                    $product[0]['category_name'] = $category[0]['category_name'];
                    
                    $subcategory = $this->model->getData('subcategory',array('sub_category_id'=>$product[0]['sub_category_id']));
                    $product[0]['sub_category_name'] = $subcategory[0]['sub_category_name'];
                    
                    $unit = $this->model->getData('product_unit',array('unit_id'=>$product[0]['unit_id']));
                    $product[0]['unit_name'] = $unit[0]['unit_name'];
                    
                    if($i == 0){
                        $product[0]['batch_id'] = $batch_id;
                    }
                    else{
                        $batch_id = $this->model->generate_next_id2($batch_id,'batch');
                        $product[0]['batch_id'] = $batch_id;
                    }
                    $req_products[$key1]['product'] = $product[0];
                    $i++;
                }

                $requirements[$key]['products'] = $req_products;
     
            }
            $production = $this->model->getData('production',array('status !='=>''));
            $production_data = array();
            foreach ($production as $key => $value) {
                // if(date('Y-m-d') )
                $production_data[] = array(
                    'product_id' => $value['product_id'],
                    'pack_size' => $value['pack_size'],
                    'delivery_required_on'=>$value['delivery_required_on']
                );
            }
            $product_id_array = array();
            $prod_data = array();
            $prod_data1 = array();
            foreach ($requirements as $key => $value) {
                $req_products = array();
                $prod_id_array = array();
              
                foreach ($value['products'] as $key1 => $value1) {
                    if(isset($product_id_array[$value1['product_id']][$value['delivery_required_on']])){
                        $product_id_array[$value1['product_id']][$value['delivery_required_on']] += $value1['quantity'];
                        unset($requirements[$key]['products'][$key1]);
                        $requirements[$prod_data[$value1['product_id']]]['products'][$prod_data1[$value1['product_id']]]['quantity'] = $product_id_array[$value1['product_id']][$value['delivery_required_on']];
                    }
                    else{
                        $prod_data[$value1['product_id']]  = $key;
                        $prod_data1[$value1['product_id']]  = $key1;
                        $product_id_array[$value1['product_id']][$value['delivery_required_on']] = $value1['quantity'];
                    }
                    $req_data = array(
                        'product_id' => $value1['product_id'],
                        'pack_size' => $value1['pack_size'],
                        'delivery_required_on'=>$value['delivery_required_on']
                    );
                    if(in_array($req_data, $production_data)){
                        unset($requirements[$key]['products'][$key1]);
                    }
                    // if(isset($production_data[$value1['product_id']][$value['delivery_required_on']])){
                    //     if($production_data[$value1['product_id']][$value['delivery_required_on']] == $product_id_array[$value1['product_id']][$value['delivery_required_on']]){
                    //         unset($requirements[$key]['products'][$key1]);
                    //     }    
                    // }
                }
            }

            $data['requirements'] = $requirements;
        /***************** Requirement Tab Content***********************/

        /***************** View Recipe Content***********************/

            $recipe = $this->model->getData('recipe');
            $recipe2  = array();
            foreach ($recipe as $key => $value) {
                $recipe_products = $this->model->getData('recipe_products',array('recipe_id'=>$value['recipe_id']));
                foreach ($recipe_products as $key1 => $value1) {
                    $product = $this->model->getData('product',array('product_id'=>$value1['product_id']))[0];
                    $unit = $this->model->getData('product_unit',array('unit_id'=>$product['unit_id']))[0];

                    $recipe_products[$key1]['product_name'] = $product['product_name'];
                    $recipe_products[$key1]['unit_name'] = $unit['unit_name'];
                }
                $recipe2[$value['product_id']] = $value;
                $recipe2[$value['product_id']]['rec_products'] = $recipe_products;
            }
            $data['recipe'] = $recipe2;
        /***************** View Recipe Content***********************/

        /***************** Production Tab Content***********************/
            $production_list = $this->model->getData('production',array('status !='=>'C'));

            foreach ($production_list as $key => $value) {
                $product = $this->model->getData('product',array('product_id'=>$value['product_id']))[0];
                $product['category_name'] = $this->model->getValue('category','category_name',array('category_id'=>$product['category_id']));
                $product['sub_category_name'] = $this->model->getValue('subcategory','sub_category_name',array('sub_category_id'=>$product['sub_category_id']));
                $product['unit_name'] = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$product['unit_id']));
                $production_list[$key]['product'] = $product;
            }
            $data['production_list'] = $production_list;
        /***************** Production Tab Content***********************/

        /***************** Stock Transfer Tab Content***********************/
            $production_list = $this->model->getData('production');
            foreach ($production_list as $key => $value) {
                $product = $this->model->getData('product',array('product_id'=>$value['product_id']))[0];
                $product['unit_name'] = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$product['unit_id']));
                $production_list[$key]['kitchen_location'] = $this->model->getValue('kitchen','location',array('kitchen_id'=>$value['kitchen_id']));
                $kitchen_stock = $this->model->getData('kitchen_stock',array('kitchen_id'=>$value['kitchen_id'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                $production_list[$key]['available_qty'] = 0;
                if(isset($kitchen_stock) && !empty($kitchen_stock)){
                    $production_list[$key]['available_qty'] = $kitchen_stock[0]['stock_qty'];
                }
                $production_list[$key]['product'] = $product;
            }

            $stock_transfer = array();
            $stock_transfer2 = array();
            foreach ($production_list as $key => $value) {
                $productData = array(
                    'product_id' => $value['product_id'],
                    'pack_size' => $value['pack_size'],
                    'kitchen_id'=>$value['kitchen_id']
                );
                if($value['status'] == 'C' && !in_array($productData, $stock_transfer2)){
                    $stock_transfer[] = $value;
                    $stock_transfer2[] = $productData;
                }
            }
            $data['stock_transfer'] = $stock_transfer;
            $data['warehouse_list'] = $this->model->getData('warehouse');
            $data['kitchen_list'] = $this->model->getData('kitchen');
        /***************** Stock Transfer Tab Content***********************/

        /***************** Requisition Tab Content***********************/
            $requisitions = $this->model->getDataOrderBy('requisition',array(),'delivery_required_on','ASC');
            $data['requisitions'] = $requisitions;
        /***************** Requisition Tab Content***********************/



        $this->load->view('admin/includes/template',$data);
    }

    function addStock(){
        $wastage = isset($_POST['wastage'])? $_POST['wastage'] :array();
        unset($_POST['wastage']);
        $production_id = $this->model->insertData('production',$_POST);
        if($_POST['status'] == 'C'){
            $transfer_qty = $_POST['finish_good_qty'];
            $kitchen_stock = $this->model->getData('kitchen_stock',array('kitchen_id'=>$_POST['kitchen_id'],'pack_size'=>$_POST['pack_size'],'product_id'=>$_POST['product_id']));
            
            if(isset($kitchen_stock) && empty($kitchen_stock)){
                $this->model->insertData('kitchen_stock',array('kitchen_id'=>$_POST['kitchen_id'],'product_id'=>$_POST['product_id'],'pack_size'=>$_POST['pack_size'],'stock_qty'=>$transfer_qty,'modified_on'=>date('Y-m-d h:i:s')));
            }
            else{
                $stock_qty = $kitchen_stock[0]['stock_qty']+$transfer_qty;
                $this->model->updateData('kitchen_stock',array('stock_qty'=>$stock_qty,'modified_on'=>date('Y-m-d h:i:s')),array('stock_id'=>$kitchen_stock[0]['stock_id']));
            }
        }
        if(!empty($wastage)){
            foreach ($wastage as $key => $value) {
                $value['production_id'] = $production_id;
                $value['batch_id'] = $_POST['batch_id'];
                $value['product_id'] = $_POST['product_id'];
                $this->model->insertData('wastage',$value);
            }
        }

       $this->session->set_flashdata(array('class'=>'success','msg'=>'Production and wastage added successfully'));
       echo json_encode(true);
    }

    function updateStock(){
        $wastage = isset($_POST['wastage'])? $_POST['wastage'] :array();
        unset($_POST['wastage']);
        $this->model->updateData('production',$_POST,array('production_id'=>$_POST['production_id']));
        $production = $this->model->getData('production',array('production_id'=>$_POST['production_id']))[0];
        if($_POST['status'] == 'C'){
            $transfer_qty = $_POST['finish_good_qty'];
            $kitchen_stock = $this->model->getData('kitchen_stock',array('kitchen_id'=>$production['kitchen_id'],'pack_size'=>$_POST['pack_size'],'product_id'=>$_POST['product_id']));
            if(isset($kitchen_stock) && empty($kitchen_stock)){
                $this->model->insertData('kitchen_stock',array('kitchen_id'=>$production['kitchen_id'],'product_id'=>$_POST['product_id'],'pack_size'=>$_POST['pack_size'],'stock_qty'=>$transfer_qty,'modified_on'=>date('Y-m-d h:i:s')));
            }
            else{
                $stock_qty = $kitchen_stock[0]['stock_qty']+$transfer_qty;
                $this->model->updateData('kitchen_stock',array('stock_qty'=>$stock_qty,'modified_on'=>date('Y-m-d h:i:s')),array('stock_id'=>$kitchen_stock[0]['stock_id']));
            }
        }
        if(!empty($wastage)){
            foreach ($wastage as $key => $value) {
                $isProductExist = $this->model->getData('wastage',array('production_id'=>$_POST['production_id'],'product_id'=>$_POST['product_id'],'row_material_id'=>$value['row_material_id']));
                if(!empty($isProductExist)){
                    $this->model->updateData('wastage',$value,array('production_id'=>$_POST['production_id'],'row_material_id'=>$value['row_material_id']));
                }
                else{
                    $value['production_id'] = $_POST['production_id'];
                    $value['batch_id'] = $_POST['batch_id'];
                    $value['product_id'] = $_POST['product_id'];
                    $this->model->insertData('wastage',$value);
                }
                
            }
        }
        $this->session->set_flashdata(array('class'=>'success','msg'=>'Production and wastage updated successfully'));
        echo json_encode(true);
    }

    function getWastage(){
        $wastage = $this->model->getData('wastage',array('production_id'=>$_POST['production_id']));
        echo json_encode($wastage);
    }

    function transferStock(){
        foreach ($_POST['product_row'] as $key => $value) {
            $transfer_qty = $value['transfer_qty'];
            $kitchen_stock = $this->model->getData('kitchen_stock',array('kitchen_id'=>$value['kitchen_id'],'pack_size'=>$value['pack_size'],'product_id'=>$value['product_id']));
            if(isset($kitchen_stock) && empty($kitchen_stock)){
                $this->model->insertData('kitchen_stock',array('kitchen_id'=>$value['kitchen_id'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size'],'stock_qty'=>0-$transfer_qty));
            }
            else{
                $stock_qty = $kitchen_stock[0]['stock_qty']-$transfer_qty;
                $this->model->updateData('kitchen_stock',array('stock_qty'=>$stock_qty),array('stock_id'=>$kitchen_stock[0]['stock_id']));
            }

            $warehouse_stock = $this->model->getData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'pack_size'=>$value['pack_size'],'product_id'=>$value['product_id']));
            if(isset($warehouse_stock) && empty($warehouse_stock)){
                $this->model->insertData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size'],'stock_qty'=>$transfer_qty,'modified_on'=>date('Y-m-d h:i:s')));
            }
            else{
                $stock_qty = $warehouse_stock[0]['stock_qty'] + $transfer_qty;
                $this->model->updateData('warehouse_stock',array('stock_qty'=>$stock_qty),array('stock_id'=>$warehouse_stock[0]['stock_id'],'modified_on'=>date('Y-m-d h:i:s')));
            }
        }
        redirect('admin/production');
    }

    function category_list(){
        $data['category_list'] = $this->model->getData('category');
        $data['menu'] ='category';
        $data['main_content']='admin/catgeory_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }
        
    function delete_category(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $category_id = $array_entity['category_id'];
           
            $this->model->updateData('category',array('status'=>'0'),array('category_id'=>$category_id));    
            $data['status'] = '1';
            $data['msg'] = 'category has been deleted successfully.';
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }

    function delete_offer(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $offer_id = $array_entity['offer_id'];
           
            $this->model->updateData('offer_master',array('status'=>'0'),array('offer_id'=>$offer_id));    
            $data['status'] = '1';
            $data['msg'] = 'offer has been deleted successfully.';
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }

    function edit_category(){
        $category_id = $this->input->get_post('category_id');
        $data['category_data'] = $this->model->getData('category',array('category_id'=>$category_id));
        $data['menu'] ='category';
        $data['main_content']='admin/edit_category'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function update_category(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $category_id = $array_entity['category_id'];
            $category_name = $array_entity['category_name'];
           
            $this->model->updateData('category',array('category_name'=>$category_name),array('category_id'=>$category_id));    
            $data['status'] = '1';
            $data['msg'] = 'Category has been updated successfully.';
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid category id.';
        }
        echo json_encode($data);
    }
    
    function sub_category_list(){
        $data['menu'] ='product';
        $data['category_data'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] = $this->model->getAllData('subcategory');
        foreach ($data['sub_category_list'] as $key => $value) {
            $data['sub_category_list'][$key]['category_name'] = $this->model->getValue('category','category_name',array('category_id'=>$value['category_id']));
        }
        $data['main_content']='admin/sub_catgeory_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function child_category_list(){
        $data['menu'] ='childcategory';
        $data['child_category_list'] = $this->model->getAllData('childcategory');
        foreach ($data['child_category_list'] as $key => $value) {
            $data['child_category_list'][$key]['category_name'] = $this->model->getValue('category','category_name',array('category_id'=>$value['category_id']));
            $data['child_category_list'][$key]['sub_category_name'] = $this->model->getValue('subcategory','sub_category_name',array('sub_category_id'=>$value['sub_category_id']));
        }
        $data['main_content']='admin/child_category_list'; 
        $this->load->view('admin/includes/template',$data);
    }

    function get_sub_category_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('subcategory');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM subcategory";
        if( !empty($requestData['search']['value']) ) { 
            $sql.=" WHERE sub_category_name LIKE '%".$requestData['search']['value']."%'";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY sub_category_name ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
        
        $category_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($category_details as $key => $value) {
            $nestedData=array();
            $nestedData[] = ++$key;
            // $nestedData[] = $value['catgeory_id'];
            $nestedData[] = $value['sub_category_name'];

            if($value['status']=='0'){
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_sub_category_status(this,1,".$value['sub_category_id'].")'>DE-ACTIVE</a>";
            }else{
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_sub_category_status(this,0,".$value['sub_category_id'].")'>ACTIVE</a>";
            }

            $edit = (access('sub_category_list','update_access') || access('sub_category_list','full_access')) ? "<li><a href=".base_url()."admin/edit_sub_category?sub_category_id=".$value['sub_category_id']."><i class='fa fa-pencil'></i></a></li>" :'';
            $delete = access('sub_category_list','full_access') ? "<li><a href='#' onclick='delete_sub_category(this,".$value['sub_category_id'].")'><i class='fa fa-trash'></i></a></li>":'';

            $nestedData[] = "<ul class='table-options'>".$edit.$delete."</ul>";
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data   
        );
        echo json_encode($json_data); 
    }
        
    function delete_sub_category(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $sub_category_id = $array_entity['sub_category_id'];
           
            $this->model->updateData('subcategory',array('status'=>'0'),array('sub_category_id'=>$sub_category_id));    
            $data['status'] = '1';
            $data['msg'] = 'Sub category has been deleted successfully.';
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid sub category';
        }
        echo json_encode($data);
    }

    function edit_sub_category(){
        $sub_category_id = $this->input->get_post('sub_category_id');
        $data['category_data'] = $this->model->getData('category',array('status'=>'1'));
        $data['subcategory_data'] = $this->model->getData('subcategory',array('sub_category_id'=>$sub_category_id));
        $data['menu'] ='subcategory';
        $data['main_content']='admin/edit_sub_category'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function edit_child_category(){
        $child_category_id = $this->input->get_post('child_category_id');
        $data['category_data'] = $this->model->getData('category');
        $data['childcategory'] = $this->model->getData('childcategory',array('child_category_id'=>$child_category_id))[0];
        $data['menu'] ='childcategory';
        $data['main_content']='admin/edit_child_category'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function update_sub_category(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $sub_category_id = $array_entity['sub_category_id'];
            $category_id = $array_entity['category_id'];
            $sub_category_name = $array_entity['sub_category_name'];
           
            $this->model->updateData('subcategory',array('category_id'=>$category_id,'sub_category_name'=>$sub_category_name),array('sub_category_id'=>$sub_category_id));    
            $data['status'] = '1';
            $data['msg'] = 'Sub category has been updated successfully.';
        
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid sub category';
        }
        echo json_encode($data);
    }

    function update_child_category(){
        $this->model->updateData('childcategory',$_POST,array('child_category_id'=>$_POST['child_category_id']));
        $this->session->set_flashdata(array('class'=>'success','msg'=>'Child Category added Successfully'));
        redirect('admin/child_category_list');
    }

    function print_online_order(){
        $order_number = $this->input->get_post('order_number');
        $data['order_data'] = $this->model->getData('order_data',array('order_number'=>$order_number));
        $this->load->view('admin/print_order',$data);
    }

    function order_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='order';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['main_content']='admin/order_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_order_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getData('order_data',array('status'=>'1'));
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM order_data WHERE  status='1' ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  AND ( order_number LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY order_date_time DESC  LIMIT ".$requestData['start']." ,".$requestData['length']."  ";

        $product_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($product_details as $key => $value) {
            $address_data = $this->model->getData('user_addresses',array('address_id'=>$value['address_id']));
            $user_data = $this->model->getData('user',array('user_id'=>$value['user_id']));
           
            $nestedData=array();
            
            $nestedData[] = $user_data[0]['full_name'];
            $nestedData[] = "<a class='hidden-print' target='_blank' href=".base_url().'admin/print_online_order?order_number='.$value['order_number'].">".$value['order_number']."</a>";
            $nestedData[] = "<i class='fa fa-rupee'></i> ". $value['total_amount'];
            $nestedData[] = $address_data[0]['full_name'].','.$address_data[0]['address1'].','.$address_data[0]['address2'].','.$address_data[0]['town_city'].','.$address_data[0]['pincode'];
            $nestedData[] = date('d-m-Y H:i:s',strtotime($value['order_date_time']));

            $nestedData[] = date('d-m-Y',strtotime($value['user_expected_order_date']));
            $nestedData[] = $value['user_expected_order_time_slot'];


            $nestedData[] = $value['payment_method'];

            $send = (access('new_order_list','update_access') || access('new_order_list','full_access')) ? "<li><a href='javascript:void(0);' onclick='send_for_delivery(this,".$value['order_id'].")'><i class='fa fa-automobile'></i></a></li>" : "";
            $nestedData[] = "<ul class='table-options'>".$send."</ul>";

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data   
        );
        echo json_encode($json_data); 
    }

    function send_order_for_delivery(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['order'];

        if(isset($array_entity) && !empty($array_entity)){
            $order_id = $array_entity['order_id'];
            if($order_id!=""){
                $this->model->updateData('order_data',array('status'=>'2'),array('order_id'=>$order_id));    
                $data['status'] = '1';
                $data['msg'] = 'Order has been processed for delivery.';    
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid order ids';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid order details';
        }
        echo json_encode($data);
    }

    function out_for_delivery_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='order';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['main_content']='admin/out_for_delivery_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_out_for_delivery_order_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getData('order_data',array('status'=>'2'));
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM order_data WHERE  status='2' ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  AND ( order_number LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY order_date_time ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $product_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($product_details as $key => $value) {
            $address_data = $this->model->getData('user_addresses',array('address_id'=>$value['address_id']));
            $user_data = $this->model->getData('user',array('user_id'=>$value['user_id']));
           
            $nestedData=array();
            
            $nestedData[] = $user_data[0]['full_name'];
            $nestedData[] = "<a class='hidden-print' target='_blank' href=".base_url().'admin/print_online_order?order_number='.$value['order_number'].">".$value['order_number']."</a>";
            $nestedData[] = "<i class='fa fa-rupee'></i> ".$value['total_amount'];
            $nestedData[] = $address_data[0]['full_name'].','.$address_data[0]['address1'].','.$address_data[0]['address2'].','.$address_data[0]['town_city'].','.$address_data[0]['pincode'];
            
            $nestedData[] = date('d-m-Y H:i:s',strtotime($value['order_date_time']));

            $nestedData[] = date('d-m-Y',strtotime($value['user_expected_order_date']));
            $nestedData[] = $value['user_expected_order_time_slot'];

            $nestedData[] = $value['payment_method'];

            $nestedData[] = "<ul class='table-options'><li><a href='javascript:void(0);' onclick='order_delivered(this,".$value['order_id'].")'>Has delivered?</a></li></ul>";

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data   
        );
        echo json_encode($json_data); 
    }

    function order_delivered(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['order'];

        if(isset($array_entity) && !empty($array_entity)){
            $order_id = $array_entity['order_id'];
            if($order_id!=""){
                $this->model->updateData('order_data',array('status'=>'3','delivered_at'=>date('Y-m-d H:i:s')),array('order_id'=>$order_id));    
                $data['status'] = '1';
                $data['msg'] = 'Selected order has been delivered to the customer';    
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid order ids';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid order details';
        }
        echo json_encode($data);
    }

    function delivered_order_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='order';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['main_content']='admin/delivered_order_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_delivered_order_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getData('order_data',array('status'=>'3'));
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM order_data WHERE  status='3' ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  AND ( order_number LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY order_date_time ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $product_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($product_details as $key => $value) {
            $address_data = $this->model->getData('user_addresses',array('address_id'=>$value['address_id']));
            $user_data = $this->model->getData('user',array('user_id'=>$value['user_id']));
           
            $nestedData=array();
            $nestedData[] = $user_data[0]['full_name'];
            $nestedData[] = "<a class='hidden-print' target='_blank' href=".base_url().'admin/print_online_order?order_number='.$value['order_number'].">".$value['order_number']."</a>";
            $nestedData[] = "<i class='fa fa-rupee'></i> ".$value['total_amount'];
            $nestedData[] = $address_data[0]['full_name'].','.$address_data[0]['address1'].','.$address_data[0]['town_city'].','.$address_data[0]['pincode'];
            $nestedData[] = date('d-m-Y H:i:s',strtotime($value['order_date_time']));

            $nestedData[] = ($value['user_expected_order_date']!="" || $value['user_expected_order_date']!=null) ? date('d-m-Y',strtotime($value['user_expected_order_date'])) : '-';
            $nestedData[] = $value['user_expected_order_time_slot'];

            $nestedData[] = $value['payment_method'];


            $nestedData[] = date('d-m-Y H:i:s',strtotime($value['delivered_at']));
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data   
        );
        echo json_encode($json_data); 
    }

    function search_order_number(){
        $order_number = $this->input->get_post('hdr_search_order');
        $data['order_data'] = $this->model->getData('order_data',array('order_number'=>$order_number));
        
        $data['menu'] ='order';
        $data['main_content']='admin/search_order_number'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function take_order(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='take_order';
        $session_id = $this->session->userdata('session_id');
        $data['total_amount'] = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"');
        $data['product_data'] = $this->model->getData('counter_order',array('session_id'=>$session_id));

        $data['product_list'] = $this->model->getData('product',array('status'=>'1'));
        
        $data['main_content']='admin/take_order'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function getPackPrice(){
        $postData = $_POST;
        $pack_size = $this->model->getValue('product','pack_size',array('product_id'=>$postData['product_id']));
        $pack_size = explode(',', $pack_size);
        $price = $this->model->getValue('product','price',array('product_id'=>$postData['product_id']));
        $price = explode(',', $price);

        $data = [];
        foreach ($pack_size as $key => $value) {
            if(isset($price[$key])){
                $data[$value] = $price[$key];
            }
        }

        if(isset($data[$postData['pack_size']])){
            echo $data[$postData['pack_size']];
        }
        else{
            echo json_encode('');
        }
    }   

    function get_product_info(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        $state_array = $array_data['state'];

        if(isset($array_entity) && !empty($array_entity)){
            $product_id = $array_entity['product_id'];
            $counter_id = $array_entity['counter_id'];
            if($product_id!=""){
                $session_id = $this->session->userdata('session_id').$counter_id;
                if(isset($session_id) && $session_id!=''){
                    $product_data =$this->model->getData('product',array('product_id'=>$product_id));    
                    
                    if(isset($product_data) && !empty($product_data)){
                        $pack_sizes = explode(',', $product_data[0]['pack_size']);
                        $prices = explode(',', $product_data[0]['price']);
                        $pack_size = '';
                        if(!empty($pack_sizes)){
                            $pack_size = $pack_sizes[0];
                        }
                        $price = '';
                        if(!empty($prices)){
                            $price = $prices[0];
                        }
                        $category_data = $this->model->getData('category',array('category_id'=>$product_data[0]['category_id']));
                        $data['gst_data'] = $this->model->getData('gst_setting',array('category_id'=>$product_data[0]['category_id'],'sub_category_id'=>$product_data[0]['sub_category_id']));
                        
                        $is_product_already = $this->model->getData('counter_order',array('session_id'=>$session_id,'product_id'=>$product_id));

                        if(isset($is_product_already) && empty($is_product_already)){
                            if(isset($data['gst_data'][0])){
								if($state_array['cust_state_code'] == $state_array['company_state_code']){
									$sgst = $product_data[0]['price'] * ($data['gst_data'][0]['SGST']/100);
									$cgst = $product_data[0]['price'] * ($data['gst_data'][0]['CGST']/100);
									$igst = 0;
								}
								else{
									$sgst = 0;
									$cgst = 0;
									$igst = $product_data[0]['price'] * ($data['gst_data'][0]['IGST']/100);
								}
							}
							else{
								$sgst = 0;
								$cgst = 0;
								$igst = 0;
							}
							$price = explode(',',$product_data[0]['price'])[0];
                            $array_data = array();
							$array_data['session_id']= $session_id;
							$array_data['product_id']= $product_id;
							$array_data['product_name']= strtoupper($product_data[0]['product_name']);
							$array_data['price']= $price;
							$array_data['qty']= 1;
							$array_data['unit_total']= $price*1;
							$array_data['category_id']= strtoupper($product_data[0]['category_id']);
							$array_data['category_name']= strtoupper($category_data[0]['category_name']);
                            $array_data['pack_size'] = $pack_size;
                            $array_data['sgst'] = $sgst;
                            $array_data['cgst'] = $cgst;
                            $array_data['igst'] = $igst;

                            $this->model->insertData('counter_order',$array_data);
                        }else{
                            $price = $is_product_already[0]['price'];
                            $qty = $is_product_already[0]['qty']+1;
							if(isset($data['gst_data'][0])){
								if($state_array['cust_state_code'] == $state_array['company_state_code']){
									$sgst = ($price*$qty) * ($data['gst_data'][0]['SGST']/100);
									$cgst = ($price*$qty) * ($data['gst_data'][0]['CGST']/100);
									$igst = 0;
								}
								else{
									$cgst = 0;
									$sgst = 0;
									$igst = $product_data[0]['price'] * ($data['gst_data'][0]['IGST']/100);
								}
							}
                            else{
								$sgst = 0;
								$cgst = 0;
								$igst = 0;
							}
                            $this->model->updateData('counter_order',
                                array('qty'=>$qty,'unit_total'=>$price*$qty,'sgst'=>$sgst,'cgst'=>$cgst,'igst'=>$igst),
                                array('counter_id'=>$is_product_already[0]['counter_id'])
                            );
                        }
                        $data['total_amount'] = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"');
                        $data['sgst'] = $this->model->getSqlData('SELECT SUM(sgst) as sgst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        $data['cgst'] = $this->model->getSqlData('SELECT SUM(cgst) as cgst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        $data['igst'] = $this->model->getSqlData('SELECT SUM(igst) as igst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        // $data['gst'] = $this->model->getSqlData('SELECT SUM(cgst,sgst,igst) as gst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        $product_data = $this->model->getDataOrderBy('counter_order',array('session_id'=>$session_id),'date_modified','DESC');
                        foreach ($product_data as $key => $value) {
                            $product = $this->model->getData('product',array('product_id'=>$value['product_id']));
                            $pack_size = $this->model->getValue('product','pack_size',array('product_id'=>$value['product_id']));
                            $pack_size = explode(',', $pack_size);
                            $product_data[$key]['pack_sizes'] = $pack_size;
                            $gst = $this->model->getData('gst_setting',array('category_id'=>$product[0]['category_id'],'sub_category_id'=>$product[0]['sub_category_id']));
                            $product_data[$key]['gst'] = isset($gst[0]['IGST']) ? $gst[0]['IGST'] : 0;
                        }
                        $data['product_data'] =$product_data;
                        

                        $data['status'] = '1';
                        $data['msg'] = 'product data has been added to cart';        
                    }else{
                        $data['status'] = '0';
                        $data['msg'] = 'No product details has been found';
                    }
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Your session has been expired. Please login again.';        
                }
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid product id';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product';
        }
        echo json_encode($data);
    }

    function get_barcode_wise_product_info(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        $state_array = $array_data['state'];
        $all_product_data =$this->model->getData('product');  
        $product_data = array();

        if(isset($array_entity) && !empty($array_entity)){
            $barcode_no = $array_entity['barcode_no'];
            $counter_id = $array_entity['counter_id'];
            if($barcode_no!=""){
                $session_id = $this->session->userdata('session_id').$counter_id;
                if(isset($session_id) && $session_id!=''){

                    
                    foreach ($all_product_data as $key => $value) {
                        $value['barcode_no']  = '';
                        if(!empty($value['pack_size'])){
                            $packs = explode(',', $value['pack_size']);
                            $prices = explode(',', $value['price']);
                            $gst_data = $this->model->getData('gst_setting',array('category_id'=>$value['category_id'],'sub_category_id'=>$value['sub_category_id']))[0];
                            $vendor_skus= explode(',', $value['vendor_sku']);
                            $custom_skus= explode(',', $value['sku2']);
                            foreach ($packs as $key1 => $value1) {
                                $value['pack_size'] = $value1;
                                if(isset($prices[$key1])){
                                    $value['price'] = $prices[$key1];
                                    if(isset($gst_data['SGST'])){
                                        $value['sgst'] = $value['price'] * ($gst_data['SGST']/100);
                                    }
                                    if(isset($gst_data['CGST'])){
                                        $value['cgst'] = $value['price'] * ($gst_data['CGST']/100);
                                    }
                                }
                                if(isset($mrps[$key1])){
                                    $value['mrp'] = $mrps[$key1];
                                }
                                if(isset($vendor_skus[$key1]) && !empty($vendor_skus[$key1])){
                                    $value['barcode_no'] = $vendor_skus[$key1];
                                }
                                elseif (isset($custom_skus[$key1]) && !empty($custom_skus[$key1])) {
                                    $value['barcode_no'] = $custom_skus[$key1];
                                }
                                else{
                                    $value['barcode_no'] = '';
                                }
                                if($barcode_no == $value['barcode_no']){
                                    $product_data[] = $value;
                                }
                            }
                        }
                        else{
                            if(isset($value['vendor_sku']) && !empty($value['vendor_sku'])){
                                $value['barcode_no'] = $value['vendor_sku'];
                            }
                            if(isset($value['sku2']) && !empty($value['sku2'])){
                                $value['barcode_no'] = $value['sku2'];
                            }
                            if($barcode_no == $value['barcode_no']){
                                $product_data[] = $value;
                            }
                        }
                    }
                    
                    if(isset($product_data) && !empty($product_data)){
                        $pack_sizes = explode(',', $product_data[0]['pack_size']);
                        $prices = explode(',', $product_data[0]['price']);
                        $pack_size = '';
                        if(!empty($pack_sizes)){
                            $pack_size = $pack_sizes[0];
                        }
                        $price = '';
                        if(!empty($prices)){
                            $price = $prices[0];
                        }
                        $category_data = $this->model->getData('category',array('category_id'=>$product_data[0]['category_id']));
                        $data['gst_data'] = $this->model->getData('gst_setting',array('category_id'=>$product_data[0]['category_id'],'sub_category_id'=>$product_data[0]['sub_category_id']));
                        
                        $is_product_already = $this->model->getData('counter_order',array('session_id'=>$session_id,'product_id'=>$product_data[0]['product_id']));

                        if(isset($is_product_already) && empty($is_product_already)){
                            if(isset($data['gst_data'][0])){
                                if($state_array['cust_state_code'] == $state_array['company_state_code']){
                                    $sgst = $product_data[0]['price'] * ($data['gst_data'][0]['SGST']/100);
                                    $cgst = $product_data[0]['price'] * ($data['gst_data'][0]['CGST']/100);
                                    $igst = 0;
                                }
                                else{
                                    $sgst = 0;
                                    $cgst = 0;
                                    $igst = $product_data[0]['price'] * ($data['gst_data'][0]['IGST']/100);
                                }
                            }
                            else{
                                $sgst = 0;
                                $cgst = 0;
                                $igst = 0;
                            }
                            $price = explode(',',$product_data[0]['price'])[0];
                            $array_data = array();
                            $array_data['session_id']= $session_id;
                            $array_data['product_id']= $product_data[0]['product_id'];
                            $array_data['product_name']= strtoupper($product_data[0]['product_name']);
                            $array_data['price']= $price;
                            $array_data['qty']= 1;
                            $array_data['unit_total']= $price*1;
                            $array_data['category_id']= strtoupper($product_data[0]['category_id']);
                            $array_data['category_name']= strtoupper($category_data[0]['category_name']);
                            $array_data['pack_size'] = $pack_size;
                            $array_data['sgst'] = $sgst;
                            $array_data['cgst'] = $cgst;
                            $array_data['igst'] = $igst;

                            $this->model->insertData('counter_order',$array_data);
                        }else{
                            $price = $is_product_already[0]['price'];
                            $qty = $is_product_already[0]['qty']+1;
                            if(isset($data['gst_data'][0])){
                                if($state_array['cust_state_code'] == $state_array['company_state_code']){
                                    $sgst = ($price*$qty) * ($data['gst_data'][0]['SGST']/100);
                                    $cgst = ($price*$qty) * ($data['gst_data'][0]['CGST']/100);
                                    $igst = 0;
                                }
                                else{
                                    $cgst = 0;
                                    $sgst = 0;
                                    $igst = $product_data[0]['price'] * ($data['gst_data'][0]['IGST']/100);
                                }
                            }
                            else{
                                $sgst = 0;
                                $cgst = 0;
                                $igst = 0;
                            }
                            $this->model->updateData('counter_order',
                                array('qty'=>$qty,'unit_total'=>$price*$qty,'sgst'=>$sgst,'cgst'=>$cgst,'igst'=>$igst),
                                array('counter_id'=>$is_product_already[0]['counter_id'])
                            );
                        }
                        $data['total_amount'] = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"');
                        $data['sgst'] = $this->model->getSqlData('SELECT SUM(sgst) as sgst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        $data['cgst'] = $this->model->getSqlData('SELECT SUM(cgst) as cgst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        $data['igst'] = $this->model->getSqlData('SELECT SUM(igst) as igst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        // $data['gst'] = $this->model->getSqlData('SELECT SUM(cgst,sgst,igst) as gst FROM counter_order WHERE session_id="'.$session_id.'"')[0];
                        $product_data = $this->model->getDataOrderBy('counter_order',array('session_id'=>$session_id),'date_modified','DESC');
                        foreach ($product_data as $key => $value) {
                            $product = $this->model->getData('product',array('product_id'=>$value['product_id']));
                            $pack_size = $this->model->getValue('product','pack_size',array('product_id'=>$value['product_id']));
                            $pack_size = explode(',', $pack_size);
                            $product_data[$key]['pack_sizes'] = $pack_size;
                            $gst = $this->model->getData('gst_setting',array('category_id'=>$product[0]['category_id'],'sub_category_id'=>$product[0]['sub_category_id']));
                            $product_data[$key]['gst'] = isset($gst[0]['IGST']) ? $gst[0]['IGST'] : 0;
                        }
                        $data['product_data'] =$product_data;
                        

                        $data['status'] = '1';
                        $data['msg'] = 'product data has been added to cart';        
                    }else{
                        $data['status'] = '0';
                        $data['msg'] = 'No product details has been found';
                    }
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Your session has been expired. Please login again.';        
                }
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid product id';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product';
        }
        echo json_encode($data);
    }

    function update_order_qty(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $order_details_id = $array_entity['order_details_id'];
            $product_qty = $array_entity['product_qty'];
            $product_price = $array_entity['product_price'];
                            
            if($order_details_id!="" && $product_qty!="" && $product_price!=""){
                
                $order_details_data = $this->model->getData('order_data_details',array('order_detail_id'=>$order_details_id));
                $order_number = $order_details_data[0]['order_number'];

                $price = $product_price;
                $qty = $product_qty;

                $updated_array =  array('price'=>$price,'qty'=>$qty,'unit_total'=>$price*$qty);
                $this->model->updateData('order_data_details',$updated_array,array('order_detail_id'=>$order_details_id));
                
                $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM order_data_details WHERE order_number="'.$order_number.'"');

                $data['total_amount'] = $total_amount[0]['total'];
                $data['product_data'] = $updated_array;

                $data['status'] = '1';
                $data['msg'] = 'product data has been updated to cart';      

            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid product id, qty, OR session might be expired.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid order details';
        }
        echo json_encode($data);
    }

    function update_counter_order_qty(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        $state_array = $array_data['state'];

        if(isset($array_entity) && !empty($array_entity)){
            $product_id = $array_entity['product_id'];
            $product_qty = $array_entity['product_qty'];
            $product_price = $array_entity['product_price'];
            $counter_id = $array_entity['counter_id'];
            $pack_size = $array_entity['pack_size'];

            $session_id = $this->session->userdata('session_id').$counter_id;
                
            if($product_id!="" && $product_qty!="" && isset($session_id) && $session_id!=''){
                $product_data =$this->model->getData('product',array('product_id'=>$product_id));    
                $gst_data =  $this->model->getData('gst_setting',array('category_id'=>$product_data[0]['category_id'],'sub_category_id'=>$product_data[0]['sub_category_id']));
                $data['gst_data'] = $gst_data;
                $is_product_already = $this->model->getData('counter_order',array('session_id'=>$session_id,'product_id'=>$product_id));
                $price = $product_price;
                $qty = $product_qty;

                if($state_array['cust_state_code'] == $state_array['company_state_code']){
                    $sgst = ($price*$qty) * ($gst_data[0]['SGST']/100);
                    $cgst = ($price*$qty) * ($gst_data[0]['CGST']/100);
                    $igst = 0;
                }
                else{
                    $sgst = 0;
                    $cgst = 0;
                    $igst = ($price*$qty) * ($gst_data[0]['IGST']/100);
                }

                $updated_array =  array('pack_size'=>$pack_size,'price'=>$price,'qty'=>$qty,'unit_total'=>$price*$qty,'sgst'=>$sgst,'cgst'=>$cgst,'igst'=>$igst);
                $this->model->updateData('counter_order',$updated_array,array('counter_id'=>$is_product_already[0]['counter_id']));
                
                $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"');
                $sgst = $this->model->getSqlData('SELECT SUM(sgst) as sgst FROM counter_order WHERE session_id="'.$session_id.'"');
                $cgst = $this->model->getSqlData('SELECT SUM(cgst) as cgst FROM counter_order WHERE session_id="'.$session_id.'"');
                $igst = $this->model->getSqlData('SELECT SUM(igst) as igst FROM counter_order WHERE session_id="'.$session_id.'"');
                $data['total_amount'] = $total_amount[0]['total'];
                $data['sgst'] = $sgst[0];
                $data['cgst'] = $cgst[0];
                $data['igst'] = $igst[0];
                $data['product_data'] = $updated_array;

                $data['status'] = '1';
                $data['msg'] = 'product data has been updated to cart';      

            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid product id, qty, OR session might be expired.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid order details';
        }
        echo json_encode($data);
    }

    /*function update_coupon_code(){
        for ($i=5835; $i <=8000; $i++) { 
            $insert_array = array('coupon_code' => 'DF'.sprintf('%04u', $i), 'expired_on'=>date('Y-m-d') );
            $this->model->insertData('coupon_master',$insert_array);
        }
    }*/

    function apply_coupon_code(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            
            $coupon_number = $array_entity['coupon_number'];
            $counter_id = $array_entity['counter_id'];
            
            $session_id = $this->session->userdata('session_id').$counter_id;

            $strSql = "SELECT * FROM coupon_master WHERE coupon_code='".$coupon_number."' AND status='0' AND expired_on>='".date('Y-m-d')."'";
            $coupon_data =$this->model->getSqlData($strSql);
            if(isset($coupon_data) && !empty($coupon_data)){

                $category_ids = $this->model->getSqlData("select category_id from category WHERE offer_applicable='1'");
                //print_array(flatten($category_ids));
                $cat_id = implode(',', flatten($category_ids));

                $strQry = 'SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'" AND category_id IN('.$cat_id.')'; //24: patanjali
                $unit_total_amount = $this->model->getSqlData($strQry);
                $total_amount = $unit_total_amount[0]['total'];

                $total_discounted_amount = '';
                $discounted_amount = '';
                $discount = $coupon_data[0]['discount'];
                $discount_type = $coupon_data[0]['discount_type'];

                if($discount_type=='1'){ //percentage 
                    $discounted_amount = ($total_amount*$discount)/100;
                    $total_discounted_amount = ($total_amount-$discounted_amount);
                }else{ //cash amount
                    $discounted_amount = ($total_amount-$discount);
                    $total_discounted_amount = ($total_amount-$discounted_amount);
                }

                $data['discounted_amount'] = $discounted_amount;
                $data['total_discounted_amount'] = $total_discounted_amount;

                $data['status'] = '1';
                $data['msg'] = 'Valid coupon code.';    
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Validity of coupon code has been expired.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid coupon details';
        }
        echo json_encode($data);
    }

    function delete_product_from_counter_data(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            
            $counter_id = $array_entity['counter_id'];
            $ctr_id = $array_entity['ctr_id'];
            
            $session_id = $this->session->userdata('session_id').$ctr_id;
            if($session_id!=""){
                $strSql = "DELETE FROM counter_order WHERE counter_id='".$counter_id."' AND  session_id='".$session_id."'";
                $has_deleted =$this->model->deleteData('counter_order',array('counter_id'=>$counter_id,'session_id'=>$session_id));
                
                $gst_data  = $this->model->getData('gst_setting');
                $data['cgst'] = $this->model->getSqlData('SELECT SUM(cgst) as cgst FROM counter_order WHERE session_id="'.$session_id.'"')[0]['cgst'];
                $data['sgst'] = $this->model->getSqlData('SELECT SUM(sgst) as sgst FROM counter_order WHERE session_id="'.$session_id.'"')[0]['sgst'];
                $data['igst'] = $this->model->getSqlData('SELECT SUM(igst) as igst FROM counter_order WHERE session_id="'.$session_id.'"')[0]['igst'];
                $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"')[0]['total'];
                $subtotal = $total_amount;
                $gst = $data['cgst'] + $data['sgst'] + $data['igst'];
                if($gst_data[0]['gst_type'] == 'I'){
                    $subtotal -= $gst;
                }
                else if($gst_data[0]['gst_type'] == 'E'){
                    $total_amount += $gst;
                }
                $data['total_amount'] = $total_amount;
                $data['subtotal'] = $subtotal;

                $data['status'] = '1';
                $data['msg'] = 'Product has been deleted from cart';    

            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid session data.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid coupon details';
        }
        echo json_encode($data);
    }

    function place_counter_order(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        if(isset($array_entity) && !empty($array_entity)){
           
            $counter_id = $array_entity['counter_id'];

            $session_id = $this->session->userdata('session_id').$counter_id;
            $op_user_id = $this->session->userdata('op_user_id');

            $user_id = $array_entity['user_id'];
            $user_data = $this->model->getData('user',array('user_id'=>$user_id));
            if(isset($user_data) && !empty($user_data)){
                $address_id = $array_entity['address_id'];

                $customer_name = $array_entity['customer_name'];
                $mobile_number = $array_entity['mobile_number'];
                $email_address = $array_entity['email_address'];
                $billing_date = $array_entity['billing_date'];
                $address_1 = $array_entity['address_1'];
                $address_2 = $array_entity['address_2'];
                $city = $array_entity['city'];
                $state = $array_entity['state'];
                $pincode = $array_entity['pincode'];

                $billed_amount = $array_entity['billed_amount'];
               

                $customer_paid =  $array_entity['customer_paid'];
                $returned_amount =  $array_entity['returned_amount'];

                // $coupon_number = $array_entity['coupon_number'];
                $total_amount = $array_entity['total_amount'];

                $wallet_balance = $array_entity['wallet_balance'];
                $payment_method = $array_entity['payment_method'];
                $offer_code = $array_entity['offer_code'];
                $order_source = $array_entity['order_source'];

                $sudexo_coupon = $array_entity['sudexo_coupon'];
                $credit_debit = $array_entity['credit_debit'];

                $has_coupon_code = '0'; 
                $discount_amount=  $array_entity['discount_amount'];
                $delivery_charges=  $array_entity['delivery_charges'];

                $orderNo = 'DF'.date('ymd').time();

                // if($coupon_number!=""){
                //     $strSql = "SELECT * FROM coupon_master WHERE coupon_code='".$coupon_number."' AND status='0' AND expired_on>='".date('Y-m-d')."'";
                //     $coupon_data =$this->model->getSqlData($strSql);
                //     if(isset($coupon_data) && !empty($coupon_data)){
                //         $has_coupon_code = '1';
                        
                //         $coupon_number = strtoupper($array_entity['coupon_number']);
                //         $discount_amount = $array_entity['discount_amount'];
                //         $total_amount = $array_entity['total_amount'];

                //         $this->model->updateData('coupon_master',array('status'=>'1'),array('coupon_code'=>$coupon_number));
                //     }
                // }

               
                $order_details = $this->model->getData('counter_order',array('session_id'=>$session_id));
                if(isset($order_details) && !empty($order_details)){
                    /*$address_id = '';
                        if($address_1!=""){
                            $address_array = array(
                                'user_id'=> $orderNo,'full_name'=>$customer_name,
                                'mobile_number'=>$mobile_number,'email_address'=>$email_address,'address1'=>$address_1,'address2'=>$address_2,
                                'landmark_nearest_area'=>'','town_city'=>$city,'pincode'=>$pincode,
                            );
                            $address_id = $this->model->insertData('user_addresses',$address_array);
                        }
                    */

                    if($customer_paid==''){
                        $customer_paid = $total_amount;
                    }

                    if($returned_amount==''){
                        $returned_amount = '00.00';
                    }
                    
                    $order_data_array=array(
                        'user_id'=>$user_id,
                        'address_id'=>$address_id,
                        'order_number'=>$orderNo,
                        'total_amount'=>$billed_amount,
                        'payment_method'=>$payment_method,//$payment_method
                        'payment_status'=>'COUNTERCASH',
                        'delivered_at'=>date('Y-m-d H:i:s'),
                        'delivered_by'=>$op_user_id,
                        'order_source'=>$order_source,'status'=>'3',
                        'order_date_time'=>$billing_date,
                        'has_coupon_code'=>$has_coupon_code,
                        // 'coupon_number'=>$coupon_number,
                        'discounted_amount'=>$discount_amount,
                        'after_discounted_amount'=>$total_amount,
                        'delivery_charges'=>$delivery_charges,
                        'cc_user_name'=>$customer_name,
                        'cc_mobile_no'=>$mobile_number,
                        'cc_email_address'=>$email_address,
                        'customer_paid'=>$customer_paid,
                        'returned_amount'=>$returned_amount,
                        'offer_code'=>$offer_code,
                        'sudexo_total'=>$sudexo_coupon,
                        'credit_debit_card_total'=>$credit_debit,
                        'subtotal' => $array_entity['subtotal'],
                        'cgst' => $array_entity['cgst'],
                        'sgst' => $array_entity['sgst'],
                        'igst' => $array_entity['igst']
                    );
                    $order_ids = $this->model->insertData('order_data',$order_data_array);

                    foreach ($order_details as $key => $value) {
                        $order_detailing_array = array(
                            'user_id'=>'COUNTERCASH',
                            'order_id'=>$order_ids,
                            'order_number'=>$orderNo,
                            'product_id'=>$value['product_id'],
                            'pack_size'=>$value['pack_size'],
                            'price'=>$value['price'],
                            'qty'=>$value['qty'],
                            'unit_total'=>$value['unit_total'],
                        );
                        $this->model->insertData('order_data_details',$order_detailing_array);
                        //Minus product qty from stock master
                        $stock_item_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id']));
                        if(isset($stock_item_data) && !empty($stock_item_data)){
                            $stock_qty = $stock_item_data[0]['stock_qty']-$value['qty'];
                            $this->model->updateData('stock_master',array('stock_qty'=>$stock_qty),array('stock_id'=>$stock_item_data[0]['stock_id']));
                        }
                    }

                    /*OFFER MANAGEMENT*/
                    $offer_data = $this->model->getData('offer_master', array('offer_name' => $offer_code));
                    $offer_type = '';
                    if(isset($offer_data) && !empty($offer_data)){
                        $offer_type = $offer_data[0]['offer_type'];
                    }

                    if($payment_method=='WALLET'){
                        $txn_no  = generateRandomString();
                        $total_wallet_balance = $this->wallet_balance($user_id);
                        
                        if($total_wallet_balance>=$total_amount){
                            $wallet_amount = $total_amount;

                            $wallet_array = array(
                                'txn_no'=>$txn_no,
                                'user_id'=>$user_id,
                                'offer_code'=>$offer_code,
                                'order_number'=>$orderNo,
                                'wallet_amount'=>$wallet_amount,
                                'date'=>date('Y-m-d'),
                                'txn_type'=>'2',//debit-gaya
                            );
                            //print_array($wallet_array);
                            $this->model->insertData('wallet_txn',$wallet_array);
                        }
                    }
                                        
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
                    /*OFFER MANAGEMENT*/

                    if($email_address!=""){
                        //$this->send_order_confirmation_mail($order_ids,$address_id,$email_address);
                    }

                    if($mobile_number!=""){
                        //$this->sms_on_order_confirmation_to_client($order_ids,$mobile_number,$customer_name);
                    }
                    
                    $data['status'] = '1';
                    $href_url = base_url()."admin/print_counter_order?order_number=".$orderNo;
                    $data['msg'] = "Order number ".$orderNo." has been created successfully. <a class='hidden-print' href=".$href_url.">Click here to print the Bill</a>";
                    $this->model->deleteData('counter_order',array('session_id'=>$session_id));

                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Order details are empty.';
                }
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid User data';
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid data sent';
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


    function sms_on_order_confirmation_to_client($order_id,$mobile_no,$customer_name){
        if($order_id!=""){
            $order_data = $this->model->getData('order_data',array('order_id'=>$order_id));
            if(isset($order_data) && !empty($order_data)){
                $order_no = $order_data[0]['order_number'];
                $total_amount = $order_data[0]['total_amount'];
              
                $text_message = "Dear ". $customer_name. ". Thank you for shopping with us, We have received your order no ".$order_no.". Your total billed amount is Rs. ".$total_amount.". Visit us again. Thanks, directfarm.in";

                $smssubject = urlencode($text_message);
                $url = "http://sms2biz.microlan.in/sendSMS?username=dtfarm&message=".$smssubject."&sendername=DTFARM&smstype=TRANS&numbers=".$mobile_no."&apikey=510ba168-561a-4afc-8925-eeb3e8aa9b59";

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

    function send_order_confirmation_mail($order_id,$deliver_address_id,$email_address){
        if($order_id!='' && $deliver_address_id!=''){

            $order_data = $this->model->getData('order_data',array('order_id'=>$order_id));
            if(isset($order_data) && !empty($order_data)){

                $del_data = $this->model->getData('user_addresses',array('address_id'=>$deliver_address_id));
                $shipping_address=  $del_data[0]['full_name'].'<br>'.$del_data[0]['mobile_number'].'<br>'.$del_data[0]['address1'].'<br>'.$del_data[0]['address2'].'<br>'.$del_data[0]['landmark_nearest_area'].'<br>'.$del_data[0]['town_city'].'<br>'.$del_data[0]['pincode'].'<br>';

                $user_data = $this->model->getData('user',array('user_id'=>$order_data[0]['user_id']));
                $to_email_address = 'myorder@directfarm.in,'.$email_address;
                $user_name =  $user_data[0]['full_name'];
                $order_number = $order_data[0]['order_number'];
                
                $user_expec_received_by_date = $order_data[0]['user_expected_order_date'];
                $user_expec_received_by_time = $order_data[0]['user_expected_order_time_slot'];

                $total_amount =  $order_data[0]['total_amount'];

                $item_in_cart = '';
                $order_details = $this->model->getData('order_data_details',array('order_id'=>$order_id));
                if(isset($order_details) && !empty($order_details)){
                    foreach ($order_details as $key => $value) {
                        $product_details = $this->model->getData('product',array('product_id'=>$value['product_id']));
                        $item_in_cart.='<tr><td>'.++$key.'</td><td>'.$product_details[0]['product_name'].'</td><td>'.$value['qty'].'</td>
                        <td align="right">'.$value['price'].'</td><td align="right">'.$value['unit_total'].'</td></tr>';
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


                            
                $headers = 'From: DirectFarm <myorder@directfarm.in>' . "\r\n" .
                            'Reply-To: myorder@directfarm.in' . "\r\n" .
                            "MIME-Version: 1.0\r\n".
                            "Content-Type: text/html; charset=ISO-8859-1\r\n";
                            'X-Mailer: PHP/';

                mail($to_email_address, $subject, $mail_content, $headers);
            }
        }
    }

    function update_product_active_deactive_status(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        $session_id = $this->session->userdata('session_id');
        if(isset($array_entity) && !empty($array_entity) && $session_id!=""){
            $product_id = $array_entity['product_id'];
            $stock_status = $array_entity['status'];

            $this->model->updateData('product',array('status'=>$stock_status),array('product_id'=>$product_id));

            $data['status'] = '1';
            $data['msg'] = 'Product status has been updated';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Your session has been expired';
        }
        echo json_encode($data);
    }

    function update_category_active_deactive_status(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        $session_id = $this->session->userdata('session_id');
        if(isset($array_entity) && !empty($array_entity) && $session_id!=""){
            $category_id = $array_entity['category_id'];
            $stock_status = $array_entity['status'];

            $this->model->updateData('category',array('status'=>$stock_status),array('category_id'=>$category_id));

            $data['status'] = '1';
            $data['msg'] = 'category status has been updated';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Your session has been expired';
        }
        echo json_encode($data);
    }

    function update_sub_category_active_deactive_status(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        $session_id = $this->session->userdata('session_id');
        if(isset($array_entity) && !empty($array_entity) && $session_id!=""){
            $sub_category_id = $array_entity['sub_category_id'];
            $stock_status = $array_entity['status'];

            $this->model->updateData('subcategory',array('status'=>$stock_status),array('sub_category_id'=>$sub_category_id));

            $data['status'] = '1';
            $data['msg'] = 'Sub category status has been updated';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Your session has been expired';
        }
        echo json_encode($data);
    }


    function update_product_status(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        $session_id = $this->session->userdata('session_id');
        if(isset($array_entity) && !empty($array_entity) && $session_id!=""){
            $product_id = $array_entity['product_id'];
            $stock_status = $array_entity['stock_status'];

            $this->model->updateData('product',array('stock_status'=>$stock_status),array('product_id'=>$product_id));

            $data['status'] = '1';
            $data['msg'] = 'Product stock status has been updated';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Your session has been expired';
        }
        echo json_encode($data);
    }

    function print_counter_order(){
        $order_number = $this->input->get_post('order_number');
        $order_data = $this->model->getData('order_data',array('order_number'=>$order_number));
        $data['address_data'] = $this->model->getData('user_addresses',array('address_id'=>$order_data[0]['address_id']));
        $data['order_data'] = $order_data;
        $data['gst_data'] = $this->model->getData('gst_setting')[0];
        $this->load->view('admin/print_counter_order',$data);
    }

    function change_pasword(){
        $data['menu'] ='category';
        $data['main_content']='admin/change_password';
        $this->load->view('admin/includes/template',$data);
    }

    function update_password(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['user_data'];

        $old_password = $array_entity['old_password'];
        $new_password = $array_entity['new_password'];
        $conf_password = $array_entity['conf_password'];

        if($old_password!=""  && $new_password!="" && $conf_password!=""){
            if($new_password == $conf_password){
                $op_user_id = $this->session->userdata('op_user_id');
                $has_admin = $this->model->getData('op_user',array("op_user_id"=>$op_user_id,"password"=>md5($old_password)));
                if(isset($has_admin) && !empty($has_admin)){

                    $hasUpdated = $this->model->updateData('op_user',array("password"=>md5($conf_password)), array("op_user_id"=>$op_user_id));
                    if($hasUpdated==1){
                        $data['status'] = "1";
                        $data['msg'] = "Password has been changed successfully";  
                    }else{
                        $data['status'] = "0";
                        $data['msg'] = "Password has not updated.";  
                    }

                }else{
                    $data['status'] = "0";
                    $data['msg'] = "Invalid old password.";    
                }

            }else{
                $data['status'] = "0";
                $data['msg'] = "New password and confirm password does not match.";
            }

        }else{
            $data['status'] = "0";
            $data['msg'] = "Invalid required parameter";
        }

        echo json_encode($data);
    }


    function download_price_list(){
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv($output, array('Sr No','Product Name','Pack Size','Category','SGST','CGST','MRP','Selling cost','Barcode_no'));

        // fetch the data
        $product_data = $this->model->getDataOrderBy('product',array(),'product_name','ASC');

        $pack_wise_product_data = array();
        foreach ($product_data as $key => $value) {
            $value['sgst'] = 0;
            $value['cgst'] = 0;
            $value['barcode_no'] = '';

            if(!empty($value['pack_size'])){
                $packs = explode(',', $value['pack_size']);
                $prices = explode(',', $value['price']);
                $mrps = explode(',', $value['mrp']);
                $gst_data = $this->model->getData('gst_setting',array('category_id'=>$value['category_id'],'sub_category_id'=>$value['sub_category_id']))[0];
                $vendor_skus= explode(',', $value['vendor_sku']);
                $custom_skus= explode(',', $value['sku2']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = $value1;
                    if(isset($prices[$key1])){
                        $value['price'] = $prices[$key1];
                        if(isset($gst_data['SGST'])){
                            $value['sgst'] = $value['price'] * ($gst_data['SGST']/100);
                        }
                        if(isset($gst_data['CGST'])){
                            $value['cgst'] = $value['price'] * ($gst_data['CGST']/100);
                        }
                    }
                    if(isset($mrps[$key1])){
                        $value['mrp'] = $mrps[$key1];
                    }
                    if(isset($vendor_skus[$key1]) && !empty($vendor_skus[$key1])){
                        $value['barcode_no'] = $vendor_skus[$key1];
                    }
                    elseif (isset($custom_skus[$key1]) && !empty($custom_skus[$key1])) {
                        $value['barcode_no'] = $custom_skus[$key1];
                    }
                    $pack_wise_product_data[] = $value;
                }
            }
            else{
                $pack_wise_product_data[] = $value;
            }
        }
        
        // loop over the rows, outputting them
        if (isset($pack_wise_product_data) && !empty($pack_wise_product_data)) {
            foreach ($pack_wise_product_data as $key => $row) {
                $cat_data = $this->model->getData('category',array('category_id'=>$row['category_id']));
                $sub_cat_data = $this->model->getData('subcategory',array('sub_category_id'=>$row['sub_category_id']));
                $unit_data = $this->model->getData('product_unit',array('unit_id'=>$row['unit_id']));

                $stock_status_value = ($row['stock_status']=='1') ? '1' : '2';

                $stock_status = ($row['stock_status']=='1') ? 'IN STOCK' : 'OUT OF STOCK';
                $product_status = ($row['status']=='1') ? 'ACTIVE' : 'DE-ACTIVATED';

                $prows = array( 
                    ++$key,
                    strtoupper($row['product_name']),
                    $row['pack_size'],
                    strtoupper($cat_data[0]['category_name']),
                    $row['sgst'],
                    $row['cgst'],
                    $row['mrp'],
                    $row['price'],
                    $row['barcode_no']
                );
                fputcsv($output, $prows);
            }
        }
    }

    function upload_price_list(){
        $data['menu'] ='category';
        $data['main_content']='admin/upload_price_list';
        $this->load->view('admin/includes/template',$data);
    }

    function upload_product_price_list(){
        $msg = '0';
        $file = (isset($_FILES['product_excel']['tmp_name']) && $_FILES['product_excel']['tmp_name']!='') ? $_FILES['product_excel']['tmp_name'] : '';
        $arr_data = array();

        if(file_exists($file)){
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);            
            //get only the Cell Collection
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            //extract to a PHP readable array format
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
                //header will/should be in row 1 only. of course this can be modified to suit your need.
                if ($row>1) {
                    $arr_data[$row][$column] = $data_value;
                }
            }
            if(isset($arr_data) && !empty($arr_data)){

                foreach ($arr_data as $key => $value) {
                    $isProductExist = $this->model->getData('product',array('product_id'=>$value['A']));
                    if(!empty($isProductExist)){
                        $update_data = array(
                            'product_id'=>$value['A'],
                            'product_name'=>$value['B'],
                            'product_type'=>(isset($value['C']) && $value['C']!='') ? $value['C'] : '',
                            'company_name'=>(isset($value['D']) && $value['D']!='') ? $value['D'] : '',
                            'manufacturer_name'=>(isset($value['E']) && $value['E']!='') ? $value['E'] : '',
                            'brand_name'=>(isset($value['F']) && $value['F']!='') ? $value['F'] : '',
                            'category_id'=>(isset($value['G']) && $value['G']!='') ? $value['G'] : '',
                            'category_name'=>(isset($value['H']) && $value['H']!='') ? $value['H'] : '',
                            'sub_category_id'=>(isset($value['I']) && $value['I']!='') ? $value['I'] : '',
                            'sub_category_name'=>(isset($value['J']) && $value['J']!='') ? $value['J'] : '',
                            'listed_in_super_deal'=>(isset($value['K']) && $value['K']!='') ? $value['K'] : '',
                            'unit_id'=>(isset($value['L']) && $value['L']!='') ? $value['L'] : '',
                            'unit_name'=>(isset($value['M']) && $value['M']!='') ? $value['M'] : '',
                            'pack_size'=>(isset($value['N']) && $value['N']!='') ? $value['N'] : '',
                            'price'=>(isset($value['O']) && $value['O']!='') ? $value['O'] : '',
                            'vendor_sku'=>(isset($value['P']) && $value['P']!='') ? $value['P'] : '',
                            'sku2'=>(isset($value['Q']) && $value['Q']!='') ? $value['Q'] : '',
                            'stock_qty'=>(isset($value['R']) && $value['R']!='') ? $value['R'] : '',
                            'hsn_code'=>(isset($value['S']) && $value['S']!='') ? $value['S'] : '',
                            'mrp'=>(isset($value['T']) && $value['T']!='') ? $value['T'] : '',
                            'stock_status'=> (isset($value['U']) && $value['U']=='1') ? '1' : '0',
                        );
                        $this->model->updateData('product',$update_data);
                    }
                    else{
                        $insert_data = array(
                            'product_name'=>$value['A'],
                            'product_type'=>(isset($value['B']) && $value['B']!='') ? $value['B'] : '',
                            'company_name'=>(isset($value['C']) && $value['C']!='') ? $value['C'] : '',
                            'manufacturer_name'=>(isset($value['D']) && $value['D']!='') ? $value['D'] : '',
                            'brand_name'=>(isset($value['E']) && $value['E']!='') ? $value['E'] : '',
                            'category_id'=>(isset($value['F']) && $value['F']!='') ? $value['F'] : '',
                            // 'category_name'=>(isset($value['G']) && $value['G']!='') ? $value['G'] : '',
                            'sub_category_id'=>(isset($value['H']) && $value['H']!='') ? $value['H'] : '',
                            // 'sub_category_name'=>(isset($value['I']) && $value['I']!='') ? $value['I'] : '',
                            'listed_in_super_deal'=>(isset($value['J']) && $value['J']!='') ? $value['J'] : '',
                            'unit_id'=>(isset($value['K']) && $value['K']!='') ? $value['K'] : '',
                            // 'unit_name'=>(isset($value['L']) && $value['L']!='') ? $value['L'] : '',
                            'pack_size'=>(isset($value['M']) && $value['M']!='') ? $value['M'] : '',
                            'price'=>(isset($value['N']) && $value['N']!='') ? $value['N'] : '',
                            'vendor_sku'=>(isset($value['O']) && $value['O']!='') ? $value['O'] : '',
                            'sku2'=>(isset($value['P']) && $value['P']!='') ? $value['P'] : '',
                            'stock_qty'=>(isset($value['Q']) && $value['Q']!='') ? $value['Q'] : '',
                            'hsn_code'=>(isset($value['R']) && $value['R']!='') ? $value['R'] : '',
                            'mrp'=>(isset($value['S']) && $value['S']!='') ? $value['S'] : '',
                            'stock_status'=> (isset($value['T']) && $value['T']=='1') ? '1' : '0',
                        );
                        $this->model->insertData('product',$insert_data);
                    }
                }
            }
        }


        $data['status'] = '1';
        $data['msg'] = 'Product Data/Price has been updated.';
        $data['menu'] ='product';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['product_unit'] =$this->model->getData('product_unit',array('status'=>'1'));
        $data['main_content']='admin/product_list'; //dashboard
        $this->load->view('admin/includes/template',$data);

    }

    function counter_order_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='take_order';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['product_unit'] =$this->model->getData('product_unit',array('status'=>'1'));
        $data['main_content']='admin/counter_order_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_counter_order_list(){
        $requestData= $_REQUEST;
        $requestData['order'][0]['dir'] = 'DESC';
        
        $totalData = $this->model->getData('order_data',array('order_source'=>'3'));
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM order_data WHERE  order_source='3' ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  AND ( order_number LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY order_date_time ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."  ";

        $order_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($order_details as $key => $value) {
            $address_data = $this->model->getData('user_addresses',array('address_id'=>$value['address_id']));
           
            $nestedData=array();
            
            $nestedData[] = ucwords($value['cc_user_name']);
            $nestedData[] = "<a target='_blank' href=".base_url().'admin/print_order?order_number='.$value['order_number'].">".$value['order_number']."</a>";
            $nestedData[] = "<i class='fa fa-rupee'></i> ". $value['after_discounted_amount'];
            $nestedData[] = $address_data[0]['full_name'].','.$address_data[0]['address1'].','.$address_data[0]['address2'].','.$address_data[0]['town_city'].','.$address_data[0]['pincode'];
            $nestedData[] = date('d-m-Y H:i:s',strtotime($value['order_date_time']));

            $edit = (access('order_list','update_access') || access('order_list','full_access')) ? "<li><a target='_blank' href='".base_url('admin/edit_counter_order?order_number='.$value['order_id'])."'><i class='fa fa-edit'></i></a></li>" : "" ;
            $delete = access('order_list','full_access') ? "<li><a href='javascript:void(0);' onclick='cancel_counter_order(this,".$value['order_id'].")'><i class='fa fa-remove'></i></a></li>" : "";

            $nestedData[] = "<ul class='table-options'>
                                ".$edit.$delete."                               
                            </ul>";           

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data   
        );
        echo json_encode($json_data); 
    }

    function edit_counter_order(){
        $order_number = $this->input->get_post('order_number');
        if(isset($order_number) && $order_number!=""){
            $data['order_data'] =  $this->model->getData('order_data',array('order_id'=>$order_number));
            $data['order_data_details'] = $this->model->getDataOrderBy('order_data_details',array('order_id'=>$order_number),'added_on','DESC');
            $data['total_amount'] = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM order_data_details WHERE order_id="'.$order_number.'"');
            $data['product_list'] = $this->model->getData('product',array('status'=>'1'));

            $user_id = $data['order_data'][0]['user_id'];
           
            $data['userdata'] = $this->model->getData('user',array('user_id'=>$user_id));
            $data['user_id'] = $user_id;
            $data['address_details'] = $this->model->getData('user_addresses',array('address_id'=>$data['order_data'][0]['address_id']));
            
            $data['menu'] ='take_order';
            $data['main_content']='admin/edit_counter_order';
            $this->load->view('admin/includes/template',$data);
        }else{
            echo "Invalid order details";
        }
    }

    function sync_live_product_list(){
        $json = file_get_contents("http://directfarm.in/api/sync_product_to_outlet");
        $product_array = objectToArray(json_decode($json));

        if(isset($product_array) && !empty($product_array)){
            $this->model->truncate_table("product");

            foreach ($product_array as $key => $value) {
                $this->model->insertData('product',$value);
            }
            $data['status'] = '1';
            $data['msg'] = 'Product list has been updated.';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'No product found';
        }
        echo json_encode($data);
    }

    function get_counter_order(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $counter_id = $array_entity['counter_id'];
            $session_id = $this->session->userdata('session_id').$counter_id;
            $product_data = $this->model->getDataOrderBy('counter_order',array('session_id'=>$session_id),'date_modified','desc');
            foreach ($product_data as $key => $value) {
                $product = $this->model->getData('product',array('product_id'=>$value['product_id']));
                $product_data[$key]['pack_sizes'] = explode(',', $product[0]['pack_size']);
                $gst = $this->model->getData('gst_setting',array('category_id'=>$product[0]['category_id'],'sub_category_id'=>$product[0]['sub_category_id']));
                $product_data[$key]['gst'] = isset($gst[0]['IGST']) ? $gst[0]['IGST'] : 0;
            }
            $gst_data = $this->model->getData('gst_setting');
            $data['cgst'] = $this->model->getSqlData('SELECT SUM(cgst) as cgst FROM counter_order WHERE session_id="'.$session_id.'"')[0]['cgst'];
            $data['sgst'] = $this->model->getSqlData('SELECT SUM(sgst) as sgst FROM counter_order WHERE session_id="'.$session_id.'"')[0]['sgst'];
            $data['igst'] = $this->model->getSqlData('SELECT SUM(igst) as igst FROM counter_order WHERE session_id="'.$session_id.'"')[0]['igst'];
            $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"')[0]['total'];
            $subtotal = $total_amount;
            $gst = $data['cgst'] + $data['sgst'] + $data['igst'];
            if(isset($gst_data[0]) && $gst_data[0]['gst_type'] == 'I'){
                $subtotal -= $gst;
            }
            else if(isset($gst_data[0]) && $gst_data[0]['gst_type'] == 'E'){
                $total_amount += $gst;
            }
            $data['total_amount'] = $total_amount;
            $data['subtotal'] = $subtotal;

            $data['product_data'] = $product_data;
            $data['product_list'] = $this->model->getData('product');
            $data['state_list'] = $this->model->getData('states');
            $data['gst_setting'] = $this->model->getData('gst_setting');
            $data['counter_id'] = $counter_id;

           $this->load->view('admin/multiple_billing_ajax_view',$data);
        }else{
            echo '<h2>Invalid Counter Number</h2>';
        }
    }

    function purchase_product(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='stock';
        $session_id = $this->session->userdata('session_id');
        $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM purchase_order WHERE session_id="'.$session_id.'" AND status="0"');
        $data['total_amount'] = $total_amount[0]['total'];

        $data['product_data'] = $this->model->getData('counter_order',array('session_id'=>$session_id));

        $data['product_list'] = $this->model->getData('product',array('status'=>'1'));
        $data['warehouse_list'] = $this->model->getData('warehouse',array('status'=>'1'));
        $data['product_unit'] =$this->model->getData('product_unit',array('status'=>'1'));
        
        $data['main_content']='admin/purchase_product';
        $this->load->view('admin/includes/template',$data);
    }

   
    function get_auto_product_list(){
        $product_name = $this->input->get_post('term');
        $product_data = $this->model->getSqlData("SELECT * FROM product WHERE status='1' AND (product_id LIKE '%".$product_name."%' OR product_name LIKE '%".$product_name."%') ");
        $product_list = array(); $strResult = '';
        if(isset($product_data) && !empty($product_data)){
            foreach ($product_data as $key => $value) {
                $data['id'] = $value['product_id'];
                $data['value'] = strtoupper($value['product_name']);
                $data['label'] = strtoupper($value['product_name']);
                array_push($product_list, $data);
            }
        }
        echo json_encode($product_list);
    }

    function search_supplier_list(){
        $supplier_name = $this->input->get_post('term');
        $sup_data = $this->model->getSqlData("SELECT * FROM supplier_list WHERE status='1' AND supplier_name LIKE '%".$supplier_name."%'");
        $sup_list = array(); $strResult = '';
        if(isset($sup_data) && !empty($sup_data)){
            foreach ($sup_data as $key => $value) {
                $data['id'] = $value['sup_id'];
                $data['value'] = $value['supplier_name'];
                $data['label'] = $value['supplier_name'];
                array_push($sup_list, $data);
            }
        }
        echo json_encode($sup_list);
    }


    function get_purchase_product_list(){
        $session_id = $this->session->userdata('session_id');
        $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM purchase_order WHERE session_id="'.$session_id.'" AND status="0"');
        $data['total_amount'] = $total_amount[0]['total'];
        $data['product_data'] = $this->model->getDataOrderBy('purchase_order',array('session_id'=>$session_id,'status'=>'0'),'added_on','desc');
        $data['unit_list'] = $this->model->getData('product_unit',array('status'=>'1'));

        $this->load->view('admin/purchase_product_item_list_ajax',$data);
    }

    function update_purchase_order_qty(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        $session_id = $this->session->userdata('session_id');
        if(isset($array_entity) && !empty($array_entity)){
            $purchase_id = $array_entity['purchase_id'];
            $qty = $array_entity['product_qty'];
            $price = $array_entity['product_price'];

            $updated_array =  array('amount'=>$price,'purchased_qty'=>$qty,'unit_total'=>round($price*$qty));
            $this->model->updateData('purchase',$updated_array,array('purchase_id'=>$purchase_id));

            $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM purchase WHERE session_id="'.$session_id.'"');
            $data['total_amount'] = $total_amount[0]['total'];
            $data['status'] = '1';
            $data['msg'] = 'Product updated successfully';

        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product';
        }
        echo json_encode($data);

    }


    function add_supplier(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='supplier';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['unit_list'] =$this->model->getData('product_unit',array('status'=>'1'));
        $data['product_list'] =$this->model->getData('product',array('status'=>'1','product_type'=>'R'));

        $data['main_content']='admin/add_supplier'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }
    
    function submit_supplier_form(){

        $supplier_name = $this->input->get_post('supplier_name');
        $phone_number = $this->input->get_post('phone_number');
        $email_address = $this->input->get_post('email_address');
        $contact_person_name = $this->input->get_post('contact_person_name');
        $address_1 = $this->input->get_post('address_1');
        $address_2 = $this->input->get_post('address_2');
        $area_name = $this->input->get_post('area_name');
        $city_name = $this->input->get_post('city_name');
        $state = $this->input->get_post('state');
        $pincode = $this->input->get_post('pincode');

        if($supplier_name!=''){
            foreach ($_FILES as $key => $value) {
                if($key == 'gst_file' ){
                    $uploaddir = './uploads/gst_files/';
                    $filename = rand().basename($_FILES['gst_file']['name']);
                    $uploadfile = $uploaddir.$filename;

                    if (move_uploaded_file($_FILES['gst_file']['tmp_name'], $uploadfile)) {
                      echo "File is valid, and was successfully uploaded.\n";
                      $gst_file_name = $filename;
                    } else {
                       echo "Upload failed";
                       $gst_file_name = "";
                    }
                    
                }
                else if($key == 'pan_file'){
                    $uploaddir = './uploads/pan_files/';
                    $filename = rand().basename($_FILES['pan_file']['name']);
                    $uploadfile = $uploaddir.$filename;
                    

                    if (move_uploaded_file($_FILES['pan_file']['tmp_name'], $uploadfile)) {
                      echo "File is valid, and was successfully uploaded.\n";
                      $pan_file_name = $filename;
                    } else {
                       echo "Upload failed";
                       $pan_file_name = "";
                    }
                }
            }
            $insert_data = array(
                'supplier_name'=>$supplier_name,
                'phone_number'=>$phone_number,
                'email_address'=>$email_address,
                'contact_person_name'=>$contact_person_name,
                'address_1'=>$address_1,
                'address_2'=>$address_2,
                'area_name'=>$area_name,
                'city_name'=>$city_name,
                'state'=>$state,
                'pincode'=>$pincode,
                'gst_number'=>$_POST['gst_number'],
                'gst_file_name' => $gst_file_name,
                'pan_number'=>$_POST['pan_number'],
                'pan_file_name'=> $pan_file_name,
                'account_name'=>$_POST['account_name'],
                'account_no'=>$_POST['account_no'],
                'bank_name'=>$_POST['bank_name'],
                'branch_name'=>$_POST['branch_name'],
                'ifsc_code'=>$_POST['ifsc_code'],
                'swift_code'=>$_POST['swift_code']
            );
            $supplier_id = $this->model->insertData('supplier_list',$insert_data);

            foreach ($_POST['supplier_items'] as $key => $value) {
                $new_item = array(
                    'supplier_id' => $supplier_id,
                    'product_id' => $value
                );
                $this->model->insertData('supplier_items',$new_item);
            }

            $data['status'] = '1';
            $data['msg'] = 'Supplier added successfully.';
            $this->session->set_flashdata('msg','Supplier added successfully.');
            redirect('admin/supplier_list');
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid supplier name.';
        }
        echo json_encode($data);
    }

     function supplier_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='supplier';
        $data['main_content']='admin/supplier_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_supplier_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getDataOrderBy('supplier_list',array(),'added_on','desc');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM supplier_list  ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  WHERE ( supplier_name LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY supplier_name ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $supplier_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($supplier_details as $key => $value) {
            
            $status = '';
            
            $nestedData=array();
            $nestedData[] = ++$key;
            $nestedData[] = $value['supplier_name'];
            $nestedData[] = $value['phone_number'];
            $nestedData[] = $value['email_address'];
            $nestedData[] = $value['contact_person_name'];
            $nestedData[] = $value['city_name'];

            $nestedData[] = $value['state'];

            if($value['status']=='0'){
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_supplier_status(this,1,".$value['sup_id'].")'>DE-ACTIVE</a>";
            }else{
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_supplier_status(this,0,".$value['sup_id'].")'>ACTIVE</a>";
            }

            $edit = (access('supplier_list','update_access') || access('supplier_list','full_access')) ? "<li><a href=".base_url()."admin/edit_supplier?supplier_id=".$value['sup_id']."><i class='fa fa-pencil'></i></a></li>":'';

            $nestedData[] = "<ul class='table-options'>".$edit."</ul>";
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

     function update_supplier_active_deactive_status(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['supplier'];

        if(isset($array_entity) && !empty($array_entity)){
            $sup_id = $array_entity['sup_id'];
            $status = $array_entity['status'];

            $this->model->updateData('supplier_list',array('status'=>$status),array('sup_id'=>$sup_id));

            $data['status'] = '1';
            $data['msg'] = 'Supplier status has been updated';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid credential sent. Please login.';
        }
        echo json_encode($data);
    }

    function edit_supplier(){
        $supplier_id = $this->input->get_post('supplier_id');
        if($supplier_id!=""){
            $data['supplier_data'] = $this->model->getData('supplier_list',array('sup_id'=>$supplier_id));
            $data['product_list'] =$this->model->getData('product',array('status'=>'1','product_type'=>'R'));
            $supplier_items = $this->model->getData('supplier_items',array('supplier_id'=>$supplier_id));
            $items = array();
            foreach ($supplier_items as $key => $value) {
                $items[] = $value['product_id'];
             }
            $data['supplier_items'] = $items;
            $data['menu'] ='supplier';
            $data['main_content']='admin/edit_supplier'; //dashboard
            $this->load->view('admin/includes/template',$data);
        }else{
            echo "Invalid supplier.";
        }
    }

    function update_supplier_form(){
        $sup_id = $this->input->get_post('sup_id');
        $supplier_name = $this->input->get_post('supplier_name');
        $phone_number = $this->input->get_post('phone_number');
        $email_address = $this->input->get_post('email_address');
        $contact_person_name = $this->input->get_post('contact_person_name');
        $address_1 = $this->input->get_post('address_1');
        $address_2 = $this->input->get_post('address_2');
        $area_name = $this->input->get_post('area_name');
        $city_name = $this->input->get_post('city_name');
        $state = $this->input->get_post('state');
        $pincode = $this->input->get_post('pincode');

        if($sup_id!=''){

            
            if($_FILES['gst_file']['name'] != ''){

                $uploaddir = './uploads/gst_files/';
                $filename = rand().basename($_FILES['gst_file']['name']);
                $uploadfile = $uploaddir.$filename;
                

                if (move_uploaded_file($_FILES['gst_file']['tmp_name'], $uploadfile)) {
                  echo "File is valid, and was successfully uploaded.\n";
                  $gst_file_name = $filename;
                } else {
                   echo "Upload failed";
                   $gst_file_name = "";
                }
            }
            else{
               $gst_file_name =  $_POST['gst_file_name'];
            }
            if($_FILES['pan_file']['name'] != ''){     
                
                $uploaddir = './uploads/pan_files/';
                $filename = rand().basename($_FILES['pan_file']['name']);
                $uploadfile = $uploaddir.$filename;
                

                if (move_uploaded_file($_FILES['pan_file']['tmp_name'], $uploadfile)) {
                  echo "File is valid, and was successfully uploaded.\n";
                  $pan_file_name = $filename;
                } else {
                   echo "Upload failed";
                   $pan_file_name = "";
                }
            }
            else{
                $pan_file_name = $_POST['pan_file_name'];;
            }
            $update_data = array(
                'supplier_name'=>$supplier_name,
                'phone_number'=>$phone_number,
                'email_address'=>$email_address,
                'contact_person_name'=>$contact_person_name,
                'address_1'=>$address_1,
                'address_2'=>$address_2,
                'area_name'=>$area_name,
                'city_name'=>$city_name,
                'state'=>$state,
                'pincode'=>$pincode,
                'gst_number'=>$_POST['gst_number'],
                'gst_file_name' => $gst_file_name,
                'pan_number'=>$_POST['pan_number'],
                'pan_file_name'=> $pan_file_name,
                'registered_date'=>date('Y-m-d H:i:s'),
                'account_name'=>$_POST['account_name'],
                'account_no'=>$_POST['account_no'],
                'bank_name'=>$_POST['bank_name'],
                'branch_name'=>$_POST['branch_name'],
                'ifsc_code'=>$_POST['ifsc_code'],
                'swift_code'=>$_POST['swift_code']

            );
            // print_array($update_data);
            $this->model->updateData('supplier_list',$update_data,array('sup_id'=>$sup_id));

            $vitems = $_POST['supplier_items'];
            $vsupplier_items = array();
            foreach ($vitems as $key => $value) {
               $item = $this->model->getData('supplier_items',array('supplier_id'=>$sup_id,'product_id'=>$value));
               $vsupplier_items[] = !empty($item[0])? $item[0] : array('sitem_id'=>'','product_id'=>$value);
            }
            $dsupplier_items = $this->model->getData('supplier_items',array('supplier_id'=>$sup_id));

            $ditem_array = array();
            foreach ($dsupplier_items as $key => $value) {
                $ditem_array[] = $value['sitem_id'];
            }

            $vitem_array = array();
            foreach ($vsupplier_items as $key => $value) {
                $vitem_array[] = $value['sitem_id'];
            }

            foreach ($vsupplier_items as $key => $value) {

                if(in_array($value['sitem_id'], $ditem_array)){
                    $this->model->updateData('supplier_items',$value,array('sitem_id'=>$value['sitem_id']));
                }
                else{
                    $newitem = array('supplier_id'=>$sup_id,'product_id'=>$value['product_id']);
                    $this->model->insertData('supplier_items',$newitem);
                }
            }
            foreach ($dsupplier_items as $key => $value) {


                if(in_array($value['sitem_id'], $vitem_array)){
                    //No action
                }
                else{
                    $this->model->deleteData('supplier_items',array('sitem_id'=>$value['sitem_id']));
                }
            }

            $data['status'] = '1';
            $this->session->set_flashdata('msg','Supplier updated successfully.');
            redirect('admin/supplier_list');
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid supplier id.';
        }
        echo json_encode($data);
    }

    function add_product_to_purchase_list(){
        if(isset($_POST) && !empty($_POST)){
            $purchase_order_number = $_POST['purchase_order_number'];
            $purchase_date = $_POST['purchase_date'];
            $total_amount = $_POST['total_amount'];
            $sup_id = $_POST['sup_id'];
            $invoice_name = '';

            if(!empty($_FILES['invoice_name'])){
                $uploaddir = './uploads/purchase_product/';
                $filename = rand().basename($_FILES['invoice_name']['name']);
                $uploadfile = $uploaddir.$filename;

                if (move_uploaded_file($_FILES['invoice_name']['tmp_name'], $uploadfile)) {
                  $invoice_name = $filename;
                } else {
                }
            }   

            $purchase_master = array(
                'supplier_id'=>$sup_id,
                'purchase_order_number'=>$purchase_order_number,
                'total_amount'=>$total_amount,
                'purchased_date'=>date('Y-m-d H:i:s',strtotime($purchase_date)),
                // 'warehouse_id'=>$_POST['warehouse_id']
            );
           $purchase_id = $this->model->insertData('purchase_master',$purchase_master);

           if($purchase_id>0){
                $pur_data = $this->model->getData('purchase_order',array('po_number'=>$purchase_order_number));
                if(isset($pur_data) && !empty($pur_data)){
                    $purchase_master_details = array();
                    foreach ($pur_data as $key => $value) {
                        $txt_qty = $_POST['product'][$value['purchase_id']]['txtqty'];
                        $txt_price = $_POST['product'][$value['purchase_id']]['txt_price'];
                        $purchase_master_details = array(
                            'purchase_id'=>$purchase_id,
                            'purchase_order_id'=>$value['purchase_id'],
                            'product_id'=>$value['product_id'],
                            'pack_size'=>$value['pack_size'],
                            'purchase_unit'=>$value['purchase_unit'],
                            'purchased_qty'=>$txt_qty,
                            'unit_total'=>$txt_price*$txt_qty,
                            'purchase_amount'=>$value['amount'],
                            'invoice_name'=>$invoice_name
                        );
                        $history = $this->model->getData('purchase_master_details',array('purchase_order_id'=>$value['purchase_id']));
                        $total_purchase = 0;
                        if(!empty($history)){
                             foreach ($history as $key1 => $value1) {
                                $total_purchase+=$value1['purchased_qty'];
                            }
                        }
                       
                        $remaining_qty = $value['purchased_qty']-($txt_qty+$total_purchase);

                        $purchase_product_history = array(
                            'po_number' => $value['po_number'],
                            'product_id' => $value['product_id'],
                            'pack_size' => $value['pack_size'],
                            'material_received_date'=> date('Y-m-d'),
                            'purchase_qty'=>$txt_qty,
                            'remaining_qty'=> $remaining_qty >=0 ? $remaining_qty : 0
                        );
                        $this->model->insertData('purchase_product_history',$purchase_product_history);

                        $po_status = array();
                        if(($total_purchase+$txt_qty) >= $value['purchased_qty']){
                            $po_status = array('status'=> 'D');
                        }
                        else{
                            $po_status = array('status'=> 'PD');
                        }

                        $data['purchase_master_details'] = $purchase_master_details;

                        $this->model->updateData('purchase_order',$po_status,array('purchase_id'=>$value['purchase_id']));

                        $this->model->insertData('purchase_master_details',$purchase_master_details);
                        //Updating the stock qty
                        $stock_product = $this->model->getData('stock_master',array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                        
                        if(isset($stock_product) && empty($stock_product)){
                            $insert_stock_array = array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size'],'stock_qty'=>$txt_qty);
                           $this->model->insertData('stock_master',$insert_stock_array);
                        }else{
                            $stock_qty = $stock_product[0]['stock_qty']+$txt_qty;
                            $update_stock_array = array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size'],'stock_qty'=>$stock_qty);
                           $this->model->updateData('stock_master',$update_stock_array,array('stock_id'=>$stock_product[0]['stock_id']));
                        }

                        // $stock_product = $this->model->getData('warehouse_stock',array('warehouse_id'=>$_POST['warehouse_id'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                        
                        // if(isset($stock_product) && empty($stock_product)){
                        //     $insert_stock_array = array('warehouse_id'=>$_POST['warehouse_id'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size'],'stock_qty'=>$txt_qty,'modified_on'=>date('Y-m-d h:i:s'));
                        //     $this->model->insertData('warehouse_stock',$insert_stock_array);
                        // }else{
                        //     $stock_qty = $stock_product[0]['stock_qty']+$txt_qty;
                        //     $update_stock_array = array('stock_qty'=>$stock_qty,'modified_on'=>date('Y-m-d h:i:s'));
                        //     $this->model->updateData('warehouse_stock',$update_stock_array,array('stock_id'=>$stock_product[0]['stock_id']));
                        // }
                    }
                }                
            }

            $data['status'] = '1';
            $data['msg'] = 'Product has been purchased successfully. Stock QTY has been updated.';
        }else{
           $data['status'] = '0';
           $data['msg'] = 'Product list is empty. Please add some more product';
        }
        echo json_encode($data);
    }


    function stock_report(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='stock';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] = $this->model->getData('subcategory',array('status'=>'1'));
        $product_list = $this->model->getData('product');
        $data['main_content']='admin/stock_report'; //dashboard


        $pack_wise_product_data = array();
        foreach ($product_list as $key => $value) {
            $value['unit_name'] = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));
            $value['category_name'] = $this->model->getValue('category','category_name',array('category_id'=>$value['category_id']));
            $value['sub_category_name'] = $this->model->getValue('subcategory','sub_category_name',array('sub_category_id'=>$value['sub_category_id']));
            $stock_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id']));
            $value['stock'] = (isset($stock_data) && !empty($stock_data)) ? $stock_data[0]['stock_qty'] : '';
            $purchase_master_details = $this->model->getData('purchase_master_details',array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));

            $cost = 0;
            if(!empty($purchase_master_details)){
                foreach ($purchase_master_details as $key1 => $value1) {
                    $cost += $value1['unit_total'];
                }
            }
            $value['cost'] = $cost;

            if(!empty($value['pack_size'])){
                $packs = explode(',', $value['pack_size']);
                $price = explode(',', $value['price']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = $value1;
                    $value['price'] = isset($price[$key1])?$price[$key1]:0;

                    $stock_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                    $value['stock'] = (isset($stock_data) && !empty($stock_data)) ? $stock_data[0]['stock_qty'] : '';

                    $pack_wise_product_data[] = $value;
                }
            }
            else{
                $pack_wise_product_data[] = $value;
            }
        }
        $data['product_list'] = $pack_wise_product_data;

        $this->load->view('admin/includes/template',$data);
    }

    function filterStockReport(){
        $filter = $_POST;
        $where = array();
        if(!empty($filter['upto_date']) ){
            $where['added_on <='] = date('Y-m-d',strtotime($filter['upto_date']));
        }
        if(!empty($filter['category_id'])){
            $where['category_id'] = $filter['category_id'];
        }
        if(!empty($filter['product_type'])){
            $where['product_type'] = $filter['product_type'];
        }

        $product_list =  $this->model->getData('product',$where);

        $pack_wise_product_data = array();
        foreach ($product_list as $key => $value) {
            $value['unit_name'] = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));
            $value['category_name'] = $this->model->getValue('category','category_name',array('category_id'=>$value['category_id']));
            $value['sub_category_name'] = $this->model->getValue('subcategory','sub_category_name',array('sub_category_id'=>$value['sub_category_id']));
            $stock_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id']));
            $value['location'] = '';
            if(!empty($filter['stock_for']) ){
                if($filter['stock_for'] == 'W' && !empty($filter['location'])){
                    $stock_data = $this->model->getData('warehouse_stock',array('warehouse_id'=>$filter['location'],'product_id'=>$value['product_id']));
                    $value['location'] = $this->model->getValue('warehouse','location',array('wid'=>$filter['location']));
                }
                else if($filter['stock_for'] == 'K' && !empty($filter['location'] )){
                    $stock_data = $this->model->getData('kitchen_stock',array('kitchen_id'=>$filter['location'],'product_id'=>$value['product_id']));
                    $value['location'] = $this->model->getValue('kitchen','location',array('kitchen_id'=>$filter['location']));
                }
            }
            $value['stock'] = (isset($stock_data) && !empty($stock_data)) ? $stock_data[0]['stock_qty'] : '';
            $purchase_master_details = $this->model->getData('purchase_master_details',array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));

            $cost = 0;
            if(!empty($purchase_master_details)){
                foreach ($purchase_master_details as $key1 => $value1) {
                    $cost += $value1['unit_total'];
                }
            }
            $value['cost'] = $cost;
            
            if(!empty($value['pack_size'])){
                $packs = explode(',', $value['pack_size']);
                $price = explode(',', $value['price']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = $value1;
                    $value['price'] = isset($price[$key1])?$price[$key1]:0;

                    $stock_data = $this->model->getData('stock_master',array('product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                    if(!empty($filter['stock_for']) ){
                        if($filter['stock_for'] == 'W' && !empty($filter['location'])){
                            $stock_data = $this->model->getData('warehouse_stock',array('warehouse_id'=>$filter['location'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                        }
                        else if($filter['stock_for'] == 'K' && !empty($filter['location'] )){
                            $stock_data = $this->model->getData('kitchen_stock',array('kitchen_id'=>$filter['location'],'product_id'=>$value['product_id'],'pack_size'=>$value['pack_size']));
                        }
                    }
                    $value['stock'] = (isset($stock_data) && !empty($stock_data)) ? $stock_data[0]['stock_qty'] : '';

                    $pack_wise_product_data[] = $value;
                }
            }
            else{
                $pack_wise_product_data[] = $value;
            }
        }
        $data = $pack_wise_product_data;

        echo json_encode($data);
    }


    function getLocationsForStock(){
        $data = array();
        if($_POST['stock_for'] == 'W'){
            $data = $this->model->getData('warehouse');
        }
        elseif ($_POST['stock_for'] == 'K') {
           $data = $this->model->getData('kitchen');
        }
        elseif ($_POST['stock_for'] == 'B') {
           $data = $this->model->getData('branch');
        }
        echo json_encode($data);
    }

    function get_customer_list_by_name(){
        $customer_name = $this->input->get_post('term');
        $strQry = "SELECT * FROM user WHERE full_name LIKE '%".$customer_name."%'";
        $customer_data = $this->model->getSqlData($strQry);
        $customer_list = array(); $strResult = '';
        if(isset($customer_data) && !empty($customer_data)){
            foreach ($customer_data as $key => $value) {
                $address_data = $this->model->getdata('user_addresses',array('user_id'=>$value['user_id'],'status'=>'1'));
                
                if(isset($address_data) && !empty($address_data)){
                    $address1 = '';$address2 = '';$nearest_area = '';$city = '';$pincode = '';$state = '';
                    foreach($address_data as $add_key => $add_value) {
                        
                        $address1 = $add_value['address1'];
                        $address2 = $add_value['address2'];
                        $nearest_area = $add_value['landmark_nearest_area'];
                        $city = $add_value['town_city'];
                        $pincode = $add_value['pincode'];
                        $state_code = $add_value['state_code'];
                        $address_id = $add_value['address_id'];

                        $label = ucfirst($value['full_name']).' - '.$value['mobile_number'].' - '.ucwords($address1).' - '.ucwords($address2).' - '.ucwords($nearest_area).' - '.ucwords($city).' - '.ucwords($pincode);

                        $data['user_id'] = $value['user_id'];
                        $data['address_id'] = $address_id;
                        $data['value'] = ucfirst($value['full_name']);
                        $data['label'] = ucwords($label);
                        $data['mobile_number'] = $value['mobile_number'];
                        $data['email_address'] = $value['email_address'];
                        $data['wallet_balance'] = $this->wallet_balance($value['user_id']);//$value['wallet_balance'];

                        $data['address1'] = $address1;
                        $data['address2'] = $address2;
                        $data['nearest_area'] = $nearest_area;
                        $data['city'] = $city;
                        $data['pincode'] = $pincode;
                        $data['state_code'] = $state_code;
                        array_push($customer_list, $data);
                    }
                }else{
                    $label = ucfirst($value['full_name']).' - '.$value['mobile_number'];
                    $data['user_id'] = $value['user_id'];
                    $data['address_id'] = '';
                    $data['value'] = ucfirst($value['full_name']);
                    $data['label'] = ucwords($label);
                    $data['mobile_number'] = $value['mobile_number'];
                    $data['email_address'] = $value['email_address'];
                    $data['wallet_balance'] = $this->wallet_balance($value['user_id']);//$value['wallet_balance'];

                    $data['address1'] = '';
                    $data['address2'] = '';
                    $data['nearest_area'] = '';
                    $data['city'] = '';
                    $data['pincode'] = '';
                    $data['state_code'] = '';
                    array_push($customer_list, $data);
                }
            }
        }
        echo json_encode($customer_list);
    }

    function get_customer_list_by_mobile_number(){
        $mobile_number = $this->input->get_post('term');
        $customer_data = $this->model->getSqlData("SELECT * FROM user WHERE mobile_number LIKE '%".$mobile_number."%'");
        $customer_list = array(); $strResult = '';
        if(isset($customer_data) && !empty($customer_data)){
            foreach ($customer_data as $key => $value) {
                $address_data = $this->model->getdata('user_addresses',array('user_id'=>$value['user_id'],'status'=>'1'));
                
                if(isset($address_data) && !empty($address_data)){
                    $address1 = '';$address2 = '';$nearest_area = '';$city = '';$pincode = '';$state = '';
                    foreach($address_data as $add_key => $add_value) {
                        
                        $address1 = $add_value['address1'];
                        $address2 = $add_value['address2'];
                        $nearest_area = $add_value['landmark_nearest_area'];
                        $city = $add_value['town_city'];
                        $pincode = $add_value['pincode'];
                        $state = $add_value['state'];
                        $address_id = $add_value['address_id'];

                        $label = $value['mobile_number'].'-'.ucfirst($value['full_name']).' - '.ucwords($address1).' - '.ucwords($address2).' - '.ucwords($nearest_area).' - '.ucwords($city).' - '.ucwords($pincode);

                        $data['user_id'] = $value['user_id'];
                        $data['address_id'] = $address_id;
                        $data['value'] = $value['mobile_number'];
                        $data['full_name'] = ucfirst($value['full_name']);
                        $data['label'] = $label;
                        $data['mobile_number'] = $value['mobile_number'];
                        $data['email_address'] = $value['email_address'];

                        $data['wallet_balance'] = $this->wallet_balance($value['user_id']); //$value['wallet_balance'];

                        $data['address1'] = $address1;
                        $data['address2'] = $address2;
                        $data['nearest_area'] = $nearest_area;
                        $data['city'] = $city;
                        $data['pincode'] = $pincode;
                        $data['state'] = $state;
                        array_push($customer_list, $data);
                    }
                }else{
                    $label = $value['mobile_number'].'-'.ucfirst($value['full_name']);

                    $data['user_id'] = $value['user_id'];
                    $data['address_id'] = '';
                    $data['value'] = ucfirst($value['mobile_number']);
                    $data['label'] = $label;
                    $data['full_name'] = ucfirst($value['full_name']);
                    $data['mobile_number'] = $value['mobile_number'];
                    $data['email_address'] = $value['email_address'];
                    $data['wallet_balance'] = $this->wallet_balance($value['user_id']); //$value['wallet_balance'];

                    $data['address1'] = '';
                    $data['address2'] = '';
                    $data['nearest_area'] = '';
                    $data['city'] = '';
                    $data['pincode'] = '';
                    $data['state'] = '';
                    array_push($customer_list, $data);
                }
            }
        }
        echo json_encode($customer_list);
    }


    function update_counter_customer(){
        $user_list = $this->model->getAllData('user_counter');
        if(isset($user_list) && !empty($user_list)){
            foreach ($user_list as $key => $value) {
                $user_array = array(
                    'full_name'=>$value['customer_name'],
                    'email_address'=>$value['email_address'],
                    'mobile_number'=>$value['mobile_number'],
                    'registration_date'=>date('Y-m-d h:i:s'),
                    'registration_source'=>'3',
                );

                //$user_id = $this->model->insertData('user',$user_array);
                if($user_id>0){
                    $address_data = array(
                        'user_id'=>$user_id,
                        'address1'=>$value['address1'],
                        'address2'=>$value['address1'],
                        'landmark_nearest_area'=>'',
                        'town_city'=>$value['city'],
                        'pincode'=>$value['pincode'],
                        'state'=>'12',
                        'added_on'=>date('Y-m-d h:i:s'),
                    );
                    //$this->model->insertData('user_addresses',$address_data);
                    
                }

            }
        }
    }

    function update_user_address()
    {
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['user'];
        if(isset($array_entity) && !empty($array_entity)){
            $user_id = $array_entity['user_id'];

            $user_Data = array(
                'full_name' => $array_entity['customer_name'],
                'email_address' => $array_entity['email_address'],
                'mobile_number' => $array_entity['mobile_number'],
            );
            $this->model->updateData('user',$user_Data,array('user_id'=>$user_id));

            $address_id = $array_entity['address_id'];
            $address_Data = array(
                'address1' => $array_entity['address_1'],
                'address2' => $array_entity['address_2'],
                'landmark_nearest_area' => $array_entity['nearest_area'],
                'town_city' => $array_entity['city'],
                'state_code' => $array_entity['state_code'],
                'pincode' => $array_entity['pincode'],
            );
            if($address_id!=""){
                $this->model->updateData('user_addresses',$address_Data,array('address_id'=>$address_id));
                $data['status'] = '1';
                $data['msg'] = 'Data Updated successfully';
            }else{
                $inserted_data = array_merge($address_Data,array('user_id'=>$user_id));
                $address_id = $this->model->insertData('user_addresses',$inserted_data);
                $data['address_id'] = $address_id;
                $data['status'] = '2';
                $data['msg'] = 'New Address added successfully';
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid data';
        }
        echo json_encode($data);
    }


    function add_new_counter_customer($value='')
    {
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['user'];
        
        if(isset($array_entity) && !empty($array_entity)){
            if($array_entity['mobile_number']!=""){
                $user_with_mobile = $this->model->getdata('user',array('mobile_number'=>$array_entity['mobile_number']));
            }else{
                $user_with_mobile = array();
            }
            if(isset($user_with_mobile) && !empty($user_with_mobile)){
                $data['status'] = '0';
                $data['msg'] = 'Mobile number is already registered with us.';
            }else{
                $customer_name = $array_entity['customer_name'];
                $mobile_number = $array_entity['mobile_number'];
                $email_address = $array_entity['email_address'];
                $address_1 = $array_entity['address_1'];
                $address_2 = $array_entity['address_2'];
                $nearest_area = $array_entity['nearest_area'];
                $city = $array_entity['city'];
                $state_code = $array_entity['state_code'];
                $pincode = $array_entity['pincode'];

                $user_array = array(
                    'full_name'=>$customer_name,
                    'mobile_number'=>$mobile_number,
                    'email_address'=>$email_address,
                    'registration_date'=>date('Y-m-d h:i:s'),
                    'registration_source'=>'3',
                );
                $user_id = $this->model->insertData('user',$user_array);

                $address_id = '';
                if($user_id>0){
                    if($address_1!=""){
                        $address_data = array(
                            'user_id'=>$user_id,
                            'address1'=>$address_1,
                            'address2'=>$address_2,
                            'landmark_nearest_area'=>$nearest_area,
                            'town_city'=>$city,
                            'state_code'=>$state_code,
                            'pincode'=>$pincode,
                            'added_on'=>date('Y-m-d h:i:s'),
                        );
                        $address_id = $this->model->insertData('user_addresses',$address_data);
                    }
                }
                $data['user_id'] = $user_id;
                $data['address_id'] = $address_id;
                $data['status'] = '1';
                $data['msg'] = 'User added successfully.';
            }
        }else{
            $data['user_id'] = '';
            $data['address_id'] = '';
            $data['status'] = '0';
            $data['msg'] = 'Invalid user data';
        }
        echo json_encode($data);
    }

    function new_orgnisation(){
        $data['menu'] ='offer';
        $data['state_master'] = $this->model->getDataOrderBy('state_master',array('status'=>'1'),'state_name','ASC');
        $data['main_content']='admin/new_orgnisation';
        $this->load->view('admin/includes/template',$data);
    }

    function submit_new_orgnisation(){
        $org_name = $this->input->get_post('org_name');
        $contact_number = $this->input->get_post('contact_number');
        $email_address = $this->input->get_post('email_address');
        $org_code = $this->input->get_post('org_code');

        $address_1 = $this->input->get_post('address_1');
        $address_2 = $this->input->get_post('address_2');
        $city = $this->input->get_post('city');
        $state = $this->input->get_post('state');
        $pincode = $this->input->get_post('pincode');

        if(isset($org_name) && $org_name!=""){
            $array_data = array(
                'org_name' => $org_name,
                'contact_number' => $contact_number,
                'email_address' => $email_address,
                'org_code'=> $org_code,
                'address_1' => $address_1,
                'address_2' => $address_2,
                'city' => $city,
                'state' => $state,
                'pincode' => $pincode,
            );
            //print_array($array_data);
            $this->model->insertData('orgnisation_master',$array_data);
            $data['status'] = '1';
            $data['msg'] = 'New orgnisation saved successfully.';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Orgnisation name is required.';
        }
        echo json_encode($data);
    }

    function org_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='offer';
       
        $data['state_master'] = $this->model->getDataOrderBy('state_master',array('status'=>'1'),'state_name','ASC');
        $data['main_content']='admin/org_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_org_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('orgnisation_master');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM orgnisation_master  ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  WHERE ( org_name LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY org_name ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $product_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($product_details as $key => $value) {
            $stock_status = '';
            
            $nestedData=array();
            $nestedData[] = ++$key;
            $nestedData[] = strtoupper($value['org_name']);
            $nestedData[] = strtoupper($value['contact_number']);
            $nestedData[] = ucfirst($value['address_1']);
            $nestedData[] = strtoupper($value['city']);
           
            if($value['status']=='0'){
                $nestedData[] = "<a href='javascript:void(0);'>DE-ACTIVE</a>";
            }else{
                $nestedData[] = "<a href='javascript:void(0);'>ACTIVE</a>";
            }

            $edit = (access('orgnisation_list','update_access') || access('orgnisation_list','full_access')) ? "<li><a href=''><i class='fa fa-pencil'></i></a></li>" : "";
            $delete = (access('orgnisation_list','full_access')) ? "<li><a href='#'><i class='fa fa-trash'></i></a></li>" : "";

            $nestedData[] = "<ul class='table-options'>".$edit.$delete."</ul>";
            /*".base_url()."admin/edit_org?org_id=".$value['org_id'].   
                onclick='delete_product(this,".$value['org_id'].")'
             */
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

    function create_offer($status='',$msg=''){
          
        $data['status'] = $status;
        $data['msg'] = $msg;
        $data['menu'] ='offer';
        $data['main_content']='admin/create_offer';
        $data['org_data'] = $this->model->getData('orgnisation_master',array('status'=>'1'));
        $data['product_category'] = $this->model->getData('category',array('status'=>'1'));
        $this->load->view('admin/includes/template',$data);
       /*  $this->submit_new_offer();*/
    }

    function submit_new_offer(){
    
        $org_ids = array();
        if (is_array($this->input->get_post('org_id'))){
            foreach ($this->input->get_post('org_id') as $value){
               $org_ids[] = $value; // loop through...
            }
        }

        $product_category = array();
        if (is_array($this->input->get_post('product_category'))){
            foreach ($this->input->get_post('product_category') as $value){
               $product_category[] = $value; // loop through...
            }
        }

        $offer_name = $this->input->get_post('offer_name');
        $nos_of_uses = $this->input->get_post('nos_of_uses');
        $from_date = $this->input->get_post('from_date');
        $to_date = $this->input->get_post('to_date');
        $on_first_order_only = $this->input->get_post('is_on_first_order');
        $offer_type = $this->input->get_post('offer_type');
        $offer_amount = $this->input->get_post('offer_amount');
        $amount_purchase = $this->input->get_post('amount_purchase');
        

        if(isset($offer_name) && $offer_name!=""){
            $offer_data = $this->model->getData('offer_master', array('offer_name' => $offer_name));
            if(isset($offer_data) && !empty($offer_data)){
                $data['msg'] =  'Offer name is already exist. Please create new offer name.';
                $data['status'] =  '0';
            }else{

                $org_data = (isset($org_ids) && !empty($org_ids)) ? implode(',', $org_ids) : '';
                $product_cat_data = (isset($org_ids) && !empty($org_ids)) ? implode(',', $product_category) : '';

                $array_data = array(
                    'offer_name'=>$offer_name,
                    'nos_of_uses'=>$nos_of_uses,
                    'org_id'=>$org_data,
                    'offer_category'=>$product_cat_data,
                    'on_first_order_only'=>$on_first_order_only,
                    'from_date'=>date('Y-m-d',strtotime($from_date)),
                    'to_date'=>date('Y-m-d',strtotime($to_date)),
                    'offer_type'=>$offer_type,
                    'offer_amount'=>$offer_amount,
                    'min_amount_purchase'=>$amount_purchase,
                    'added_on'=>date('Y-m-d'),
                );
                /* echo "hi";
                 exit;*/
                $this->model->insertData('offer_master',$array_data);
                $data['msg'] =  'New offer has been created successfully.';
                $data['status'] =  '1';
            }
        }else{
            $data['msg'] =  'Offer name is missing';
            $data['status'] =  '0';
        }
        $this->create_offer($data['status'],$data['msg']);
    }

    function offer_list(){
        $data['menu'] ='offer';
        $data['main_content']='admin/offer_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_offer_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('offer_master');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM offer_master WHERE status='1' ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.=" ( offer_name LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY added_on DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $offer_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($offer_details as $key => $value) {
            $stock_status = '';$offer_type = '';

            if($value['offer_type']=='1'){$offer_type = 'Percentage';}else if($value['offer_type']=='2'){$offer_type = 'Rupees';}else{$offer_type = 'Cash Back';}

            $org_data = array(); $category_data = array();
            $org_id = explode(',',$value['org_id']);
            foreach ($org_id as $org_key => $org_value) {
                $org_info = $this->model->getData('orgnisation_master',array('org_id'=>$org_value));
                array_push($org_data, $org_info[0]['org_name']);
            }

            $offer_category = explode(',',$value['offer_category']);
            foreach ($offer_category as $cat_key => $cat_value) {
                $category_info = $this->model->getData('category',array('category_id'=>$cat_value));
                array_push($category_data, $category_info[0]['category_name']);
            }

            $nestedData=array();
            $nestedData[] = ++$key;
            $nestedData[] = strtoupper(implode(',', $org_data));
            $nestedData[] = strtoupper($value['offer_name']);
            $nestedData[] = strtoupper(implode(',', $category_data));
            $nestedData[] = $value['nos_of_uses'];
            
            $nestedData[] = $offer_type;

            $nestedData[] = $value['offer_amount'];
            $nestedData[] = $value['min_amount_purchase'];
            $nestedData[] = date('d-m-Y', strtotime($value['from_date']));
            $nestedData[] = date('d-m-Y', strtotime($value['to_date']));
            
            $edit = (access('offer_list','update_access') || access('offer_list','full_access')) ? "<li><a href=".base_url()."admin/edit_offer?update_id=".$value['offer_id']."><i class='fa fa-pencil'></i></a></li>" : "";
            $delete = access('offer_list','full_access') ? "<li><a href='#' onclick='delete_offer_list(this,".$value['offer_id'].")'><i class='fa fa-trash'></i></a></li>" : "";
            $nestedData[] = "<ul class='table-options'>
                            ".$edit.$delete."
                            </ul>";
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

    function edit_offer(){
        $update_id = $this->input->get_post('update_id');
        if(isset($update_id) && !empty($update_id)){
            $offer_data = $this->model->getData('offer_master',array('offer_id'=>$update_id));
            if(isset($offer_data) && !empty($offer_data)){
                $data['status'] = '';
                $data['msg'] = '';
                $data['offer_data'] = $offer_data;
            }else{  
                $data['status'] = '0';
                $data['msg'] = 'Invalid offer data';
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid offer Id';
        }

        $data['org_data'] = $this->model->getData('orgnisation_master',array('status'=>'1'));
        $data['product_category'] = $this->model->getData('category',array('status'=>'1'));

        $data['menu'] ='offer';
        $data['main_content']='admin/edit_offer';
        $this->load->view('admin/includes/template',$data);
    }

    function update_offer_data(){
        $org_ids = array();
        if (is_array($this->input->get_post('org_id'))){
            foreach ($this->input->get_post('org_id') as $value){
               $org_ids[] = $value; // loop through...
            }
        }

        $product_category = array();
        if (is_array($this->input->get_post('product_category'))){
            foreach ($this->input->get_post('product_category') as $value){
               $product_category[] = $value; // loop through...
            }
        }
        $offer_id = $this->input->get_post('offer_id');
        $offer_name = $this->input->get_post('offer_name');
        $nos_of_uses = $this->input->get_post('nos_of_uses');
        $from_date = $this->input->get_post('from_date');
        $to_date = $this->input->get_post('to_date');
        $on_first_order_only = $this->input->get_post('is_on_first_order');
        $offer_type = $this->input->get_post('offer_type');
        $offer_amount = $this->input->get_post('offer_amount');
        $amount_purchase = $this->input->get_post('amount_purchase');

        if(isset($offer_name) && $offer_name!=""){
            $org_data = (isset($org_ids) && !empty($org_ids)) ? implode(',', $org_ids) : '';
            $product_cat_data = (isset($org_ids) && !empty($org_ids)) ? implode(',', $product_category) : '';

            $array_data = array(
                'offer_name'=>$offer_name,
                'nos_of_uses'=>$nos_of_uses,
                'org_id'=>$org_data,
                'offer_category'=>$product_cat_data,
                'on_first_order_only'=>$on_first_order_only,
                'from_date'=>date('Y-m-d',strtotime($from_date)),
                'to_date'=>date('Y-m-d',strtotime($to_date)),
                'offer_type'=>$offer_type,
                'offer_amount'=>$offer_amount,
                'min_amount_purchase'=>$amount_purchase,
                'added_on'=>date('Y-m-d'),
            );

            $this->model->updateData('offer_master',$array_data,array('offer_id'=>$offer_id));
            $data['msg'] =  'Offer data has been updated successfully.';
            $data['status'] =  '1';
            
        }else{
            $data['msg'] =  'Offer name is missing';
            $data['status'] =  '0';
        }

        $offer_data = $this->model->getData('offer_master',array('offer_id'=>$offer_id));
        $data['offer_data'] = $offer_data;
        $data['org_data'] = $this->model->getData('orgnisation_master',array('status'=>'1'));
        $data['product_category'] = $this->model->getData('category',array('status'=>'1'));

        $data['menu'] ='offer';
        $data['main_content']='admin/edit_offer';
        $this->load->view('admin/includes/template',$data);
    }


    function apply_offer_code(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            
            $offer_code = trim($array_entity['offer_code']);
            $counter_id = $array_entity['counter_id'];
            // $mobile_number = $array_entity['mobile_number'];
            
            $session_id = $this->session->userdata('session_id').$counter_id;
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
                    $strSql = "SELECT u.user_id, u.mobile_number, od.* FROM user u, order_data od WHERE od.user_id= u.user_id ";
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

                            $order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"');
                            $total_amount = $order_data[0]['total'];

                            $strSql = "SELECT sum(co.unit_total) as total FROM product p, counter_order co
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
                            $order_data = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM counter_order WHERE session_id="'.$session_id.'"');
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
                                        $data['msg'] = 'This is category based offer, minimum amount should be Rs. '.$min_amount_purchase.", You category total is Rs. ".$total_amount.". (".$category_p_name.")";
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
            } else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid offer code is entered.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product data found.';
        }
        echo json_encode($data);
    }

    function purchase_order(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='stock';
        $session_id = $this->session->userdata('session_id');
        $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM purchase_order WHERE session_id="'.$session_id.'" AND status="0"');
        $data['total_amount'] = $total_amount[0]['total'];

        $po_data = $this->model->getSqlData("SELECT MAX(po_number) po_number FROM purchase_order");
        $data['po_number'] = $po_data[0]['po_number'];

        $data['product_data'] = $this->model->getData('counter_order',array('session_id'=>$session_id));

        $data['product_list'] = $this->model->getData('product',array('status'=>'1'));
        $data['product_unit'] =$this->model->getData('product_unit',array('status'=>'1'));

        $data['category'] =$this->model->getData('category',array('status'=>'1'));
        $data['supplier_list'] =$this->model->getData('supplier_list',array('status'=>'1'));

        $data['main_content']='admin/purchase_order';
        $this->load->view('admin/includes/template',$data);
    }

    function get_category_wise_product_list()
    {
        $category_id = $this->input->get_post('category_id');
        $data['product_data'] = $this->model->getDataOrderBy('product',array('category_id'=>$category_id),'product_name','asc');
        $data['unit_list'] = $this->model->getData('product_unit',array('status'=>'1'));
        $this->load->view('admin/get_category_wise_product_list',$data);
    }

    function get_supplier_wise_product()
    {
        $supplier_id = $this->input->get_post('supplier_id');
        $supplier_items = $this->model->getData('supplier_items',array('supplier_id'=>$supplier_id));
        $product_data = array();
        foreach ($supplier_items as $key => $value) {
            $product = $this->model->getData('product',array('product_id'=>$value['product_id']));
            $product_data[] = $product[0];      
        }
        // echo '<pre>'; print_r($product_data); exit;
        $pack_wise_product_data = array();
        foreach ($product_data as $key => $value) {
            if(!empty($value['pack_size'])){
                $packs = explode(',', $value['pack_size']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = $value1;
                    $pack_wise_product_data[] = $value;
                }
            }
            else{
                $pack_wise_product_data[] = $value;
            }
        }
        $data['product_data'] = $pack_wise_product_data;
        // echo '<pre>'; print_r($pack_wise_product_data); exit;
        $data['unit_list'] = $this->model->getData('product_unit',array('status'=>'1'));
        $this->load->view('admin/get_supplier_wise_product_list',$data);
    }

    function create_purchase_order(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 

        
        if(isset($array_data) && !empty($array_data)){
            foreach ($array_data as $key => $value) {
                $product_data = $this->model->getData('product',array('product_id'=>$value['product_id']));

                $po_data = array(
                    'po_number'=>$value['order_no'],
                    'product_id'=>$value['product_id'],
                    'product_name'=>strtoupper($product_data[0]['product_name']),
                    'purchase_unit'=>$product_data[0]['unit'],
                    'purchased_qty'=>$value['qty'],
                    'pack_size'=>(float)$value['pack_size'],
                    'amount'=>$value['price'],
                    'unit_total'=>$value['qty']*$value['price'],
                    'po_date'=>date('Y-m-d',strtotime($value['date'])),
                    'supply_date'=>!empty($value['supply_date'])?date('Y-m-d',strtotime($value['supply_date'])):'',
                    'supplier_id'=>$value['supplier_id'],
                );

                $this->model->insertData('purchase_order',$po_data);
            }
            $data['status'] = '1';
            $data['msg'] = 'Purchase order has been generated successfully.';
        }else{
             $data['status'] = '0';
             $data['msg'] = 'Invalid purchase data';
        }
        echo json_encode($data);
    }

    function purchase_order_list(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='stock';

        $data['main_content']='admin/purchase_order_list'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_purchase_order_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getSqlData('SELECT * FROM purchase_order GROUP BY po_number ORDER BY po_number DESC');        $totalFiltered = (isset($totalData) && !empty($totalData)) ? count($totalData) : '' ;

        $sql = "SELECT * FROM purchase_order  ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  WHERE ( po_number LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" GROUP BY po_number ORDER BY po_number DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $po_data=$this->model->getSqlData($sql);
        $data = array();
        if(isset($po_data) && !empty($po_data)){
           foreach ($po_data as $key => $value) { 
                $supplier_data = $this->model->getData('supplier_list',array('sup_id'=>$value['supplier_id'])); 
                $total_purchase = $this->model->CountWhereRecord('purchase_order',array('po_number'=>$value['po_number']));
                $strQry = "SELECT SUM(unit_total) AS TOTAL FROM purchase_order WHERE po_number=".$value['po_number'];
                $total_amount=$this->model->getSqlData($strQry);
                
                $nestedData=array();
                $nestedData[] = ++$key;
                $nestedData[] = sprintf('%04u', $value['po_number']);
                $nestedData[] = $supplier_data[0]['supplier_name'];
                $nestedData[] = $total_purchase;
                $nestedData[] = $total_amount[0]['TOTAL'];
                $nestedData[] = $value['po_date'];
                $nestedData[] = $value['supply_date'] == '0000-00-00'?'':$value['supply_date'];
                $nestedData[] = $value['status'] == 'P'?'Pending':($value['status'] == 'PD' ? 'Partially Delivered' :'Done');
                $nestedData[] = "<a data-toggle='tooltip'  title ='print' class='hidden-print' href='".base_url('admin/print_purchase_order?po_number='.$value['po_number'])."'><i class='fa fa-print'></i></a>    ".
                "<a data-toggle='tooltip'  title ='View' href='".base_url('admin/view_purchase_order?po_number='.$value['po_number'])."'><i class='fa fa-eye'></i></a>    ".
                "<a data-toggle='tooltip'  title ='Email' href='".base_url('admin/email_purchase_order?po_number='.$value['po_number'])."'><i class='fa fa-envelope'></i></a><br>".
                "<span data-toggle='modal' data-target='#uploadChalan'><a data-toggle='tooltip' onclick='uploadChalan(".$value['po_number'].")' title ='Upload Chalan'> <i class='fa fa-upload'></i></a></span>    ".
                "<span data-toggle='modal' data-target='#viewHistory'><a data-toggle='tooltip' onclick='getHistory(".$value['po_number'].")' title ='View History'><i class='fa fa-history'></i></a></span>    ".
                "<span data-toggle='modal' data-target='#addRemark'><a data-toggle='tooltip' onClick='setRemark(".$value['po_number'].")' title ='Add Remark'><i class='fa fa-comments-o'></i></a></span>";
                $data[] = $nestedData;
            }
        }else{
            $data = array();
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

    function get_purchase_product_history(){
        $po_number = $_POST['po_number'];

        $history = $this->model->getData('purchase_product_history',array('po_number' =>$po_number));

        foreach($history as $key => $value){
            $product_data = $this->model->getData('product',array('product_id'=>$value['product_id']));
            $history[$key]['product_name'] = $product_data[0]['product_name'];
            $history[$key]['material_received_date'] = date('d-m-Y',strtotime($value['material_received_date']));
        }

        echo json_encode($history);
    }

    function upload_chalan(){
        echo '<pre>'; print_r($_FILES); 
        if(!empty($_FILES['chalan_file'])){
            $uploaddir = './uploads/chalan_file/';
            $filename = rand().basename($_FILES['chalan_file']['name']);
            $uploadfile = $uploaddir . $filename;

            if (move_uploaded_file($_FILES['chalan_file']['tmp_name'], $uploadfile)) {
              echo "File is valid, and was successfully uploaded.\n";
              $postData['chalan_file'] = $filename;
              $this->session->set_flashdata('msg','Chalan file uploaded successfully');
            } else {
               echo "Upload failed";
            }
        }
        $this->model->updateData('purchase_order',array('chalan_file'=>$filename),array('po_number'=>$_POST['po_number']));
        redirect('admin/purchase_order_list');
    }

    function add_remark(){
        // echo '<pre>'; print_r($_POST); exit;
        foreach ($_POST['remark'] as $key => $value) {
            $newdata = array('po_number' => $_POST['po_number'],'remark'=>$value );
            $this->model->insertData('purchase_order_remark',$newdata);
        }
        $this->session->set_flashdata(array('class'=>'success','msg'=>'reamrk added and updated successfully'));
        redirect('admin/purchase_order_list');
    }
    
    function print_purchase_order(){
        // $po_number = $this->input->get_post('po_number');
        // $data['po_data'] = $this->model->getData('purchase_order',array('po_number'=>$po_number));
        // $this->load->view('admin/print_purchase_order',$data);

        require('././third_party/pdf/fpdf/fpdf.php');
        include("././third_party/pdf/mpdf/mpdf.php");
        require('././third_party/pdf/WriteHTML.php');

        $pdf = new mPDF();
        
        $po_number = $this->input->get_post('po_number');
        $data['po_data'] = $this->model->getData('purchase_order',array('po_number'=>$po_number));
        $data['supplier_data'] = $this->model->getData('supplier_list',array('sup_id'=>$data['po_data'][0]['supplier_id']));
        $html = $this->load->view('admin/print_purchase_order',$data,true);
        
        $pdf->WriteHTML($html);
        
        $filename = 'purchase_order_'.$data['supplier_data'][0]['supplier_name'].'_'.rand().'.pdf';

        $pdf->Output($filename,'I');
    }

    function view_purchase_order(){
        $po_number = $this->input->get_post('po_number');
        $data['po_data'] = $this->model->getData('purchase_order',array('po_number'=>$po_number));
        $data['supplier_data'] = $this->model->getData('supplier_list',array('sup_id'=>$data['po_data'][0]['supplier_id']));
        $data['remarks'] = $this->model->getData('purchase_order_remark',array('po_number'=>$po_number));
        $data['menu'] ='stock';
        $data['main_content']='admin/view_purchase_order'; //dashboard

        // print_array($data);
        $this->load->view('admin/includes/template',$data);
    }

    function email_purchase_order(){
        require('././third_party/pdf/fpdf/fpdf.php');
        include("././third_party/pdf/mpdf/mpdf.php");
        require('././third_party/pdf/WriteHTML.php');

        $pdf = new mPDF();
        
        $po_number = $this->input->get_post('po_number');
        $data['po_data'] = $this->model->getData('purchase_order',array('po_number'=>$po_number));
        $data['supplier_data'] = $this->model->getData('supplier_list',array('sup_id'=>$data['po_data'][0]['supplier_id']));
        $html = $this->load->view('admin/print_purchase_order',$data,true);
        
        $pdf->WriteHTML($html);
        
        $filename = 'purchase_order_'.$data['supplier_data'][0]['supplier_name'].'_'.rand();
        $dir = FCPATH.'downloads/purchase_orders/' ;

        $pdf->Output($dir.$filename.".pdf");

        $from = 'krishnamurari.prajapati@microlan.in';
        $to = $data['supplier_data'][0]['email_address'];
        $subject = 'Purchase Order No.....'.$po_number;
        $message = "Dear   ".$data['supplier_data'][0]['contact_person_name'].",<br>

        We would like to inform you that, we require goods as attached list of product.

        Hope you send it as soon as possible, in case having any query pls don't hesitate to call us or reply to .......".$from.".

        Hoping to receive the said order soon without any delay, also the payment for the same would be done as per the our payment terms.

        Thanks & Regards,
        Purchase Team ";


        $attach = $dir.$filename.".pdf";

        sendEmail($from,$to,$subject,$message,$attach);

        $this->session->set_flashdata('msg','Email Purchase Order Pdf Successfully Delivered');

        redirect('admin/purchase_order_list');
    }

    function get_purchase_order_data(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['purchase'];

        if(isset($array_entity) && !empty($array_entity)){
            $order_number = (int)$array_entity['order_no'];
            $isProductPurchased = $this->model->getData('purchase_order',array('po_number'=>$order_number,'status !='=>'D'));
            $isPoNumberExist = $this->model->getData('purchase_master',array('purchase_order_number'=>$order_number));
            if(!empty($isProductPurchased)){
                $po_data = $this->model->getDataOrderBy('purchase_order',array('po_number'=>$order_number),'added_on','DESC');
                if(isset($po_data) && !empty($po_data)){
                    $data['po_data'] = $po_data;
                    $data['supplier_data'] = $this->model->getData('supplier_list',array('sup_id'=>$po_data[0]['supplier_id']));
                    $data['po_date'] = date('d-m-Y',strtotime($po_data[0]['po_date']));

                    $strQry = "SELECT SUM(unit_total) AS TOTAL FROM purchase_order WHERE po_number=".$order_number;
                    $total_amount=$this->model->getSqlData($strQry);
                    $data['total_amount'] = $total_amount[0]['TOTAL'];

                    $data['po_date'] = date('d-m-Y',strtotime($po_data[0]['po_date']));
                    $data['status'] = '1';
                    $data['msg'] = 'Purchase data found';
                    
                }else{
                    $data['po_data']= array();
                    $data['status'] = '0';
                    $data['msg'] = 'Invalid order number';
                }
            }
            elseif(!empty($isPoNumberExist)){
                $data['po_data']= array();
                $data['status'] = 'P';
                $data['msg'] = 'Product is Already Purchased';
            }
            else{
                $data['po_data']= array();
                $data['status'] = '0';
                $data['msg'] = 'Invalid order number';
            }
        }else{
            $data['po_data']= array();
            $data['status'] = '0';
            $data['msg'] = 'Invalid purchase data';
        }
        echo json_encode($data);
    }


    function add_item_to_purchase_list(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $po_number = $array_entity['po_number'];
            $product_id = $array_entity['product_id'];
            $sup_id = $array_entity['sup_id'];
            
            if($product_id!=""){
                $session_id = $this->session->userdata('session_id');
                if(isset($session_id) && $session_id!=''){
                    $product_data =$this->model->getData('product',array('product_id'=>$product_id));    
                    if(isset($product_data) && !empty($product_data)){

                        $is_product_already = $this->model->getData('purchase_order',array('po_number'=>$po_number,'product_id'=>$product_id));
                        
                        if(isset($is_product_already) && empty($is_product_already)){
                            $array_data = array(
                                'product_id'=>$product_id,
                                'purchased_qty'=>1,
                                'product_name'=>strtoupper($product_data[0]['product_name']),
                                'po_date'=>date('Y-m-d H:i:s'),
                                'po_number'=>$po_number,
                                'supplier_id'=>$sup_id,
                            );

                            /*'amount'=>$product_data[0]['price'],'unit_total'=>$product_data[0]['price']*1*/
                            $this->model->insertData('purchase_order',$array_data);
                        }else{
                            $p_qty = $is_product_already[0]['purchased_qty']+1;
                            $unit_total = $product_data[0]['price']*$p_qty;
                            $update_list = array('purchased_qty' => $p_qty, 'unit_total'=>$unit_total);

                            $this->model->updateData('purchase_order',$update_list,array('purchase_id'=>$is_product_already[0]['purchase_id']));
                        }    

                        $po_data = $this->model->getDataOrderBy('purchase_order',array('po_number'=>$po_number),'added_on','DESC');
                        $data['po_data'] = $po_data;
                        $data['supplier_data'] = $this->model->getData('supplier_list',array('sup_id'=>$po_data[0]['supplier_id']));
                        $data['po_date'] = date('d-m-Y',strtotime($po_data[0]['po_date']));

                        $strQry = "SELECT SUM(unit_total) AS TOTAL FROM purchase_order WHERE po_number=".$po_number;
                        $total_amount=$this->model->getSqlData($strQry);
                        $data['total_amount'] = $total_amount[0]['TOTAL'];

                        $data['po_date'] = date('d-m-Y',strtotime($po_data[0]['po_date']));

                        $data['status'] = '1';
                        $data['msg'] = 'product data has been added to cart';        
                    }else{
                        $data['status'] = '0';
                        $data['msg'] = 'No product details has been found';
                    }
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'Your session has been expired. Please login again.';        
                }
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid product id';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid Purchase product number';
        }
        echo json_encode($data);
    }

    function update_purchase_qty(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $purchase_id = $array_entity['purchase_id'];
            $qty = $array_entity['product_qty'];
            $price = $array_entity['product_price'];
            $po_number = $array_entity['po_number'];
            if($purchase_id!="" && $po_number!=""){
                
                $updated_array =  array('amount'=>$price,'purchased_qty'=>$qty,'unit_total'=>$price*$qty);
                $this->model->updateData('purchase_order',$updated_array,array('purchase_id'=>$purchase_id));
                
                $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM purchase_order WHERE po_number="'.$po_number.'"');
                $data['total_amount'] = $total_amount[0]['total'];
                $data['unit_total'] =$price*$qty;
                $data['status'] = '1';
                $data['msg'] = 'product data has been updated to purchase';      

            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid purchase id, qty, OR session might be expired.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid order details';
        }
        echo json_encode($data);
    }

   
    function delete_product_from_purchase_data(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $po_number = $array_entity['po_number'];   
            $purchase_id = $array_entity['purchase_id'];
            $has_deleted =$this->model->deleteData('purchase_order',array('purchase_id'=>$purchase_id));
            
            $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM purchase_order WHERE po_number="'.$po_number.'"');
            $data['total_amount'] = $total_amount[0]['total'];

            $data['status'] = '1';
            $data['msg'] = 'Product has been deleted from cart';    

        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid Purchase id';
        }
        echo json_encode($data);
    }

    function add_money_to_wallet(){
        $data['menu'] ='wallet';
        $data['state_master'] = $this->model->getDataOrderBy('state_master',array('status'=>'1'),'state_name','ASC');
        $data['main_content']='admin/add_money_to_wallet';
        $this->load->view('admin/includes/template',$data);
    }

    function add_money_to_customer_wallet(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            
            $customer_id = $array_entity['customer_id'];
            $customer_name = $array_entity['customer_name'];
            $mobile_number = $array_entity['mobile_number'];
            $amount = $array_entity['amount'];
            $add_date = $array_entity['add_date'];

            $txn_no  = generateRandomString();

            if($customer_id!=""){
                $wallet_array = array(
                    'txn_no'=>$txn_no,
                    'user_id'=>$customer_id,
                    'offer_code'=>'ADDED',
                    'wallet_amount'=>$amount,
                    'date'=>date('Y-m-d',strtotime($add_date)),
                    'txn_type'=>'1',//credit-aaya
                );
                $this->model->insertData('wallet_txn',$wallet_array);
            }else{

                $cust_data = array(
                    'full_name'=>$customer_name,
                    'mobile_number'=>$mobile_number,
                );
                $customer_id = $this->model->insertData('user',$cust_data);
                if($customer_id>0){
                    $wallet_array = array(
                        'txn_no'=>$txn_no,
                        'user_id'=>$customer_id,
                        'offer_code'=>'ADDED',
                        'wallet_amount'=>$amount,
                        'date'=>date('Y-m-d',strtotime($add_date)),
                        'txn_type'=>'1',//credit-aaya
                    );
                    $this->model->insertData('wallet_txn',$wallet_array);
                }
            }

            $data['status'] = '1';
            $data['msg'] = 'Money has been added to wallet. Your transaction no is: '.$txn_no;    
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid data sent';
        }
        echo json_encode($data);
    }

    function wallet_report(){
        $data['menu'] ='wallet';
        $data['main_content']='admin/wallet_report';
        $this->load->view('admin/includes/template',$data);
    }

    function get_wallet_report(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        if(isset($array_entity) && !empty($array_entity)){
            $customer_id = $array_entity['customer_id'];
            $data['wallet_data'] = $this->model->getDataOrderBy('wallet_txn',array('user_id' =>$customer_id),'updated_on','DESC');
            $this->load->view('admin/wallet_report_data',$data);
        }else{
            echo "No Record found";
        }
    }

    function productwise_sales_report(){
        $data['category_data'] = $this->model->getData('category',array('status'=>'1'));
        $data['menu'] ='report';
        $data['main_content']='admin/sales_report';
        $this->load->view('admin/includes/template',$data);
    }
    function pytm_type_wise_report()
    {
       $data['category_data'] = $this->model->getData('category',array('status'=>'1'));
       $data['main_content']='admin/pytm_type_wise_report';
       $this->load->view('admin/includes/template',$data); 
    }

    function get_sales_report(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['report'];

        if(isset($array_entity) && !empty($array_entity)){
            $category_id = $array_entity['category_id'];
            $product_id = $array_entity['product_id'];
            $frm_date = date('Y-m-d',strtotime($array_entity['frm_date']));
            $to_date = date('Y-m-d',strtotime($array_entity['to_date']));

            if($category_id!='' && $product_id!='' && $frm_date!='' && $to_date!=''){
                $strQry = "SELECT product_id,SUM(qty) AS qty, SUM(unit_total) AS unit_total  FROM order_data_details 
                    WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND  DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' GROUP BY product_id ORDER BY qty DESC";

            }else if($category_id!='' && $frm_date!='' && $to_date!=''){
                $strQry = "SELECT product_id,SUM(qty) AS qty, SUM(unit_total) AS unit_total  FROM order_data_details 
                    WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND  DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' GROUP BY product_id ORDER BY qty DESC";
            
            }else if($product_id!='' && $frm_date!='' && $to_date!=''){
                $strQry = "SELECT product_id,SUM(qty) AS qty, SUM(unit_total) AS unit_total  FROM order_data_details 
                    WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' AND product_id='".$product_id."' GROUP BY  product_id ORDER BY qty DESC";

            }else if($frm_date!='' && $to_date!=''){
                $strQry = "SELECT product_id,SUM(qty) AS qty, SUM(unit_total) AS unit_total  FROM order_data_details 
                    WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND  DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' GROUP BY product_id ORDER BY qty DESC";
            }

            $data['report_data']=$this->model->getSqlData($strQry);
            $data['category_id'] = $category_id;
            $this->load->view('admin/get_sales_report',$data);
        }else{
            echo '<div class="alert alert-danger">Invalid parameter sent</div>';
        }
    }

    function product_date_wise_sales_report(){
        $data['category_data'] = $this->model->getData('category',array('status'=>'1'));
        $data['menu'] ='report';
        $data['main_content']='admin/product_date_wise_sales_report';
        $this->load->view('admin/includes/template',$data);
    }

    function get_date_wise_sales_report(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['report'];

        if(isset($array_entity) && !empty($array_entity)){
            $category_id = $array_entity['category_id'];
            $product_id = $array_entity['product_id'];
            $frm_date = date('Y-m-d',strtotime($array_entity['frm_date']));
            $to_date = date('Y-m-d',strtotime($array_entity['to_date']));

            if($category_id!='' && $product_id!='' && $frm_date!='' && $to_date!=''){
                $strQry= "SELECT product_id, qty, price, unit_total,added_on FROM order_data_details 
                WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' ORDER BY added_on";

            }else if($category_id!='' && $frm_date!='' && $to_date!=''){
                $strQry= "SELECT product_id, qty, price, unit_total,added_on FROM order_data_details 
                WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' ORDER BY added_on";
            
            }else if($product_id!='' && $frm_date!='' && $to_date!=''){
                $strQry= "SELECT product_id, qty, price, unit_total,added_on FROM order_data_details 
                    WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' AND product_id='".$product_id."' ORDER BY added_on";

            }else if($frm_date!='' && $to_date!=''){
                $strQry= "SELECT product_id, qty, price, unit_total,added_on FROM order_data_details 
                        WHERE DATE_FORMAT(added_on, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(added_on, '%Y-%m-%d')<='".$to_date."' ORDER BY added_on";

            }

            $data['report_data']=$this->model->getSqlData($strQry);
            $data['category_id'] = $category_id;
            $this->load->view('admin/get_date_wise_sales_report',$data);
        }else{
            echo '<div class="alert alert-danger">Invalid parameter sent</div>';
        }
    }

    function pymt_wish_report(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['report'];

        if(isset($array_entity) && !empty($array_entity)){
          /*  $category_id = $array_entity['category_id'];
            $product_id = $array_entity['product_id'];*/
            $pymt_type= $array_entity['pymt_type'];
            $frm_date = date('Y-m-d',strtotime($array_entity['frm_date']));
            $to_date = date('Y-m-d',strtotime($array_entity['to_date']));

            if($pymt_type!='' && $frm_date!='' && $to_date!='')
            {
 
              $strQry="SELECT * FROM order_data WHERE DATE_FORMAT(order_date_time, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(order_date_time, '%Y-%m-%d')<='".$to_date."' AND payment_method='".$pymt_type."' ORDER BY order_date_time";
            }
            else if($pymt_type=='' && $frm_date!='' && $to_date!='')
            {
             $strQry="SELECT * FROM order_data WHERE DATE_FORMAT(order_date_time, '%Y-%m-%d')>='".$frm_date."' AND DATE_FORMAT(order_date_time, '%Y-%m-%d')<='".$to_date."' ORDER BY order_date_time";
            }
            $data['report_data']=$this->model->getSqlData($strQry);
            /*$data['category_id'] = $category_id;*/
            $data['pymt_']=$pymt_type;
            $this->load->view('admin/get_pymt_wish_report.php',$data);
        }else{
            echo '<div class="alert alert-danger">Invalid parameter sent</div>';
        }
    }




    function delete_product_from_edit_bill_data(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            
            $order_details_id = $array_entity['order_details_id'];
            
            if($order_details_id!=""){
                $order_details_data = $this->model->getData('order_data_details',array('order_detail_id'=>$order_details_id));

                $has_deleted =$this->model->deleteData('order_data_details',array('order_detail_id'=>$order_details_id));
                
                $order_number = $order_details_data[0]['order_number'];
                $total_amount = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM order_data_details WHERE order_number="'.$order_number.'"');
               
                $data['total_amount'] = $total_amount[0]['total'];

                $data['status'] = '1';
                $data['msg'] = 'Product has been deleted from cart';    

            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid session data.';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid coupon details';
        }
        echo json_encode($data);
    }


     function get_edit_product_info(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];

        if(isset($array_entity) && !empty($array_entity)){
            $product_id = $array_entity['product_id'];
            $order_number = $array_entity['order_number'];
            $order_id = $array_entity['order_id'];
            $user_id = $array_entity['user_id'];

            if($product_id!="" && $order_number!=''){
                                
                $product_data =$this->model->getData('product',array('product_id'=>$product_id));    
                if(isset($product_data) && !empty($product_data)){
                    $category_data = $this->model->getData('category',array('category_id'=>$product_data[0]['category_id']));

                    $is_product_already = $this->model->getData('order_data_details',array('order_number'=>$order_number,'product_id'=>$product_id));

                    /*If product not listed in order*/
                    if(isset($is_product_already) && empty($is_product_already)){
                        $array_data = array(
                            'user_id'=>$user_id,
                            'order_id'=>$order_id,
                            'order_number'=>$order_number,
                            'product_id'=>$product_id,
                            'qty'=>1,
                            'price'=>$product_data[0]['price'],
                            'unit_total'=>upto2Decimal($product_data[0]['price']*1),
                        );

                        $this->model->insertData('order_data_details',$array_data);

                    }else{

                        $price = $is_product_already[0]['price'];
                        $qty = $is_product_already[0]['qty']+1;

                        $this->model->updateData('order_data_details',
                            array('qty'=>$qty,'unit_total'=>$price*$qty),
                            array('order_number'=>$order_number,'product_id'=>$product_id)
                        );
                    }

                    $data['total_amount'] = $this->model->getSqlData('SELECT SUM(unit_total) as total FROM order_data_details WHERE order_number="'.$order_number.'"');

                    $this->model->updateData('order_data',array('total_amount'=>$data['total_amount'][0]['total'],'after_discounted_amount'=>$data['total_amount'][0]['total']),array('order_id'=>$order_id));

                    $strQry = "SELECT odd.*,p.product_name,c.category_name FROM order_data_details odd, product p, category c 
                               WHERE odd.order_number ='".$order_number."' AND p.product_id=odd.product_id AND p.category_id=c.category_id ORDER BY odd.added_on DESC";
                    $data['product_data'] = $this->model->getSqlData($strQry);


                    $data['status'] = '1';
                    $data['msg'] = 'product data has been added to cart';        
                }else{
                    $data['status'] = '0';
                    $data['msg'] = 'No product details has been found';
                }
                
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid product id Or order number';    
            }
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product';
        }
        echo json_encode($data);
    }

    function update_order_data(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        if(isset($array_entity) && !empty($array_entity)){
           
            $user_id = $array_entity['user_id'];
            $customer_name = $array_entity['customer_name'];
            $mobile_number = $array_entity['mobile_number'];
            $email_address = $array_entity['email_address'];
            $billing_date = $array_entity['billing_date'];
                        
            $address_id = $array_entity['address_id'];
            $address_1 = $array_entity['address_1'];
            $address_2 = $array_entity['address_2'];
            $nearest_area = $array_entity['nearest_area'];
            $city = $array_entity['city'];
            $state = $array_entity['state'];
            $pincode = $array_entity['pincode'];

            $order_number = $array_entity['order_number'];
            $order_id = $array_entity['order_id'];

            //update user details
            $user_data = array('full_name'=>$customer_name,'email_address'=>$email_address,'mobile_number'=>$mobile_number);
            $this->model->updateData('user',$user_data,array('user_id'=>$user_id));

            //update user address
            if($address_id>0){
                $user_address_data = array('full_name'=>$customer_name,'mobile_number'=>$mobile_number,'address1'=>$address_1,'address2'=>$address_2,'landmark_nearest_area'=>$nearest_area,'town_city'=>$city,'state'=>$state,'pincode'=>$pincode);
                $this->model->updateData('user_addresses',$user_address_data,array('address_id'=>$address_id));
            }

            $this->model->updateData('order_data',array('cc_user_name'=>$customer_name,'cc_mobile_no'=>$mobile_number,'cc_email_address'=>$email_address,'user_id'=>$user_id,'address_id'=>$address_id),array('order_id'=>$order_id));
            
            $data['status'] = '1';
            $data['msg'] = 'Order data has been updated successfully';
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Something went wrong while updating the order data';
        }
        echo json_encode($data);

    }

    function branch_setting(){
        $data['branch_list'] = $this->model->getData('branch',array());
        $data['menu'] ='setting';
        $data['main_content']='admin/branch_setting'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function kitchen_setting(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='setting';
        $data['main_content']='admin/kitchen_setting'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_kitchen_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('kitchen');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM kitchen";
        if( !empty($requestData['search']['value']) ) { 
             $sql.=" WHERE ( location LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY location ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $kitchen_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($kitchen_details as $key => $value) {
            $stock_status = '';
            
            $nestedData=array();
            $nestedData[] = $value['kitchen_id'];
            $nestedData[] = strtoupper($value['location']);
            $nestedData[] = ucwords($value['contact_person']);
            $nestedData[] = $value['contact_email'];
            $nestedData[] = ucwords($value['address']);

            $edit =  (access('kitchen_setting','update_access') || access('kitchen_setting','full_access')) ? "<li><a href=".base_url()."admin/edit_kitchen?kitchen_id=".$value['kitchen_id']."><i class='fa fa-pencil'></i></a></li>" : ""; 
            $delete = access('kitchen_setting','full_access') ? "<li><a href='#' onclick='delete_kitchen(this,".$value['kitchen_id'].")'><i class='fa fa-trash'></i></a></li>" : "" ;

            $nestedData[] = "<ul class='table-options'>".$edit.$delete."</ul>";

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

    function warehouse_setting(){
        $data['kitchen_list'] = $this->model->getData('kitchen');
        $data['menu'] ='setting';
        $data['main_content']='admin/warehouse_setting'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }

    function get_warehouse_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('warehouse');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM warehouse";

        if( !empty($requestData['search']['value']) ) { 
             $sql.=" WHERE ( location LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY location ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $warehouse_details=$this->model->getSqlData($sql);
        $data = array();

        foreach ($warehouse_details as $key => $value) {
            $stock_status = '';
            
            $nestedData=array();
            $nestedData[] = $value['wid'];
            $nestedData[] = strtoupper($value['location']);
            $nestedData[] = ucwords($value['contact_person']);
            $nestedData[] = $value['contact_email'];
            $nestedData[] = ucwords($value['address']);

            $edit  = (access('warehouse_setting','update_access') || access('warehouse_setting','full_access')) ? "<li><a href=".base_url()."admin/edit_warehouse?wid=".$value['wid']."><i class='fa fa-pencil'></i></a></li>" : "";
            $delete = access('warehouse_setting','full_access') ? "<li><a href='#' onclick='delete_warehouse(this,".$value['wid'].")'><i class='fa fa-trash'></i></a></li>" : "";


            $nestedData[] = "<ul class='table-options'>".$edit.$delete."</ul>";

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }

    function gst_setting(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='setting';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));

        $gst_settings = $this->model->getData('gst_setting',array());

        foreach ($gst_settings as $key => $value) {
            $category = $this->model->getData('category',array('status'=>'1','category_id'=> $value['category_id']));
            $gst_settings[$key]['category_name'] = $category[0]['category_name'];

            $sub_category = $this->model->getData('subcategory',array('status'=>'1','sub_category_id'=>$value['sub_category_id']));
            $gst_settings[$key]['sub_category_name'] = $sub_category[0]['sub_category_name'];
        }
        $data['gst_settings'] = $gst_settings;
        
        $data['main_content']='admin/gst_setting';
        $this->load->view('admin/includes/template',$data);
    }

    function get_gst_setting_list(){
        $requestData= $_REQUEST;

        $totalData = $this->model->getAllData('gst_setting');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM gst_setting";
        if( !empty($requestData['search']['value']) ) { 
             $sql.=" WHERE ( category_id LIKE '%".$requestData['search']['value']."%' ) ";
        }

        $totalFiltered =$this->model->count_by_query($sql);
        $sql.=" ORDER BY category_id ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

        $gst_settings=$this->model->getSqlData($sql);
        $data = array();

        foreach ($gst_settings as $key => $value) {
            $category = $this->model->getData('category',array('status'=>'1','category_id'=> $value['category_id']));
            $gst_settings[$key]['category_name'] = $category[0]['category_name'];

            $sub_category = $this->model->getData('subcategory',array('status'=>'1','sub_category_id'=>$value['sub_category_id']));
            $gst_settings[$key]['sub_category_name'] = $sub_category[0]['sub_category_name'];
        }
        // print_array($gst_settings);
        $i= 0;
        foreach ($gst_settings as $key => $value) {
            $stock_status = '';
            
            $nestedData=array();
            $nestedData[] = ++$i;
            $nestedData[] = strtoupper($value['category_name']);
            $nestedData[] = strtoupper($value['sub_category_name']);
            $nestedData[] = $value['CGST'];
            $nestedData[] = $value['SGST'];
            $nestedData[] = $value['IGST'];

            $nestedData[] = "<ul class='table-options'><li><a href='#' onclick='delete_gst_setting(this,".$value['gst_set_id'].")'><i class='fa fa-trash'></i></a></li></ul>";

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"            => intval($requestData['draw'] ),  
            "recordsTotal"    => intval($totalData ), 
            "recordsFiltered" => intval($totalFiltered ), 
            "data"            => $data,
        );
        echo json_encode($json_data); 
    }


    function getSubCategory(){
       $postData = $_POST;
        // $postData['category_id'] = 1;

        $sub_category_list = $this->model->getData('subcategory',array('status'=>'1'));

        $sub_cats = array();
        foreach ($sub_category_list as $key => $value) {
            if($postData['category_id'] == $value['category_id']){
                $sub_cats[] = $value;
            }
        }
        echo json_encode($sub_cats);
    }

    function getChildCategory(){
        $postData = $_POST;
        $child_category_list = $this->model->getData('childcategory');

        $child_cats = array();
        foreach ($child_category_list as $key => $value) {
            if($postData['sub_category_id'] == $value['sub_category_id']){
                $child_cats[] = $value;
            }
        }
        echo json_encode($child_cats);
    }

    function getGstSetting(){
        $postData = $_POST;
        $gst_setting = $this->model->getData('gst_setting',array('category_id'=>$postData['category_id']));
        echo json_encode($gst_setting);
    }

    function save_gst_type(){
        $postData = $_POST;
        $this->model->updateData('gst_setting',$postData,array());
        $this->session->set_flashdata('msg', 'Gst type saved successfully.');
        redirect('admin/gst_setting');
    }

    function save_gst_setting(){
        $postData = $_POST;

        $isSubcatExist = $this->model->getData('gst_setting',array('category_id'=>$postData['category_id'],'sub_category_id'=>$postData['sub_category_id']));
        $isCatExist = $this->model->getData('gst_setting',array('category_id'=>$postData['category_id'],'sub_category_id'=>'0'));
        // print_array($isSubcatExist);
        if(!empty($isSubcatExist)){
            $this->model->updateData('gst_setting',$postData,array('gst_set_id'=>$isSubcatExist[0]['gst_set_id']));
        }
        elseif (!empty($isCatExist)) {
            $this->model->updateData('gst_setting',$postData,array('gst_set_id'=>$isCatExist[0]['gst_set_id'],'sub_category_id'=>'0')); 
        }
        else{
            $this->model->insertData('gst_setting',$postData);
        }
        
        $this->session->set_flashdata('msg', 'Gst Setting saved successfully.');
        redirect('admin/gst_setting');
    }

    function company_setting(){
        $data['menu'] ='setting';
        $data['company_setting'] = $this->model->getData('company_setting',array('comp_sett_id'=>'1'));
        $data['state_list'] = $this->model->getData('states');
        $data['main_content']='admin/company_setting';
        $this->load->view('admin/includes/template',$data);
    }

    function points_setting(){
        $data['menu'] ='setting';
        $points_setting = $this->model->getData('points_setting',array('id'=>'1'))[0];
        $laps_duration = explode(' ', $points_setting['laps_duration']);
        $points_setting['laps_duration_type'] = end($laps_duration);
        $expiring_in = explode(' ', $points_setting['expiring_in']);
        $points_setting['expiring_in_type'] = end($expiring_in);
        $data['points_setting'] = $points_setting;
        $data['main_content']='admin/points_setting';
        $this->load->view('admin/includes/template',$data);
    }

    function save_company_setting(){
        $postData = $_POST;

        if(!empty($_FILES['company_logo'])){
            $uploaddir = './uploads/';
            $filename = rand().basename($_FILES['company_logo']['name']);
            $uploadfile = $uploaddir . $filename;

            if (move_uploaded_file($_FILES['company_logo']['tmp_name'], $uploadfile)) {
              echo "File is valid, and was successfully uploaded.\n";
              $postData['company_logo'] = $filename;
            } else {
               echo "Upload failed";
            }
        }


        $this->model->updateData('company_setting',$postData,array('comp_sett_id'=>'1')); 
        $this->session->set_flashdata('msg', 'Company Setting Saved Successfully.');
        redirect('admin/company_setting');
    }

    function save_points_setting(){
        $postData = $_POST;
        $postData['laps_duration'] = $postData['laps_duration']." ".$postData['laps_duration_type'];
        $postData['expiring_in'] = $postData['expiring_in']." ".$postData['expiring_in_type'];
        unset($postData['laps_duration_type']);
        unset($postData['expiring_in_type']);
        $this->model->updateData('points_setting',$postData,array('id'=>'1'));
        $this->session->set_flashdata('msg', 'Points Setting Saved Successfully.');
        redirect('admin/points_setting');
    }

    function sendEmail($from,$to,$subject,$message,$attach='')
    {
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'piyush.nerkar@microlan.in', 
          'smtp_pass' => 'microlan@123', 
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($attach);
        if($this->email->send())
        {
          echo 'Email send.';
        }
        else
        {
         show_error($this->email->print_debugger());
        }
    }

    function test(){
        // $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        // echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('500', $generator::TYPE_CODE_128)) . '">';
        sendEmail('piyush.nerkar@microlan.in','piyush.nerkar@microlan.in','test','hi');
        // sendEmail($from,$to,$subject,$message,);
    }

 /*End of Controller*/
}?>