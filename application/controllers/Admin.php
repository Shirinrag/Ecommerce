<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->no_cache();
        $company_setting = $this->model->getData('company_setting', array());
        $glob['company'] = $company_setting;
        $this->load->vars($glob);
        if (!$this->is_logged_in()) {
            redirect('Alogin');
        }
        date_default_timezone_set('Asia/Kolkata');
    }
    protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }
    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_admin_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            return FALSE;
        }
        return TRUE;
    }
    function logout() {
        $this->session->set_userdata(array('is_admin_logged_in' => FALSE));
        $this->session->sess_destroy();
        redirect(base_url() . "Admin");
    }
    function index() {
        $str_total_earning = "SELECT ROUND(SUM(sub_total),2) as total FROM order_data WHERE  DATE(order_date_time) = '" . date('Y-m-d') . "'";
        $data['todays_earning'] = $this->model->getSqlData($str_total_earning);
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d', strtotime("-7 day", strtotime($from_date)));
        $this_week_earning = "SELECT ROUND(SUM(sub_total),2) as total FROM order_data WHERE order_source='3' AND  (DATE(order_date_time) BETWEEN '" . $to_date . "' AND '" . $from_date . "')";
        $data['this_week_earning'] = $this->model->getSqlData($this_week_earning);
        $str_graph_query = "SELECT DATE(order_date_time) as order_date,ROUND(SUM(sub_total),2) as total FROM order_data 
            WHERE order_source='3' AND  (DATE(order_date_time) BETWEEN '" . $to_date . "' AND '" . $from_date . "')
                GROUP BY DATE(order_date_time)";
        $graph_data = $this->model->getSqlData($str_graph_query);
        foreach ($graph_data as $key => $value) {
            $graph_data[$key]['order_date'] = date('M y', strtotime($value['order_date']));
        }
        $data['graph_data'] = $graph_data;
        $order_data = $this->model->getData('order_data');
        $i = 0;
        $j = 0;
        $k = 0;
        $l = 0;
        $m = 0;
        $order_count = [];
        foreach ($order_data as $key => $value) {
            // if ($value['status'] == '1') {
            //     $i++;
            // }
            // if ($value['status'] == '2') {
            //     $j++;
            // }
            // if ($value['status'] == '2') {
            //     $k++;
            // }
            // if ($value['status'] == '0') {
            //     $l++;
            // }
        }
        // $order_count[] = ['New Orders', $i];
        // $order_count[] = ['Out For Delivery', $j];
        // $order_count[] = ['Delivered', $k];
        // $order_count[] = ['Cancelled', $l];
        // $data['order_count'] = $order_count;
        $data['branches'] = $this->model->getData('branch');
        // First day of the current month.
        $query_date = date('Y-m-d');
        $first_date = date('Y-m-01', strtotime($query_date));
        // Last day of the month.
        $last_date = date('Y-m-t', strtotime($query_date));
        $total_month_earning = "SELECT ROUND(SUM(sub_total),2) as total FROM order_data WHERE order_source='3' AND  (DATE(order_date_time) BETWEEN '" . $first_date . "' AND '" . $last_date . "')";
        $data['total_month_earning'] = $this->model->getSqlData($total_month_earning);
        $data['menu'] = 'dashboard';
        $data['main_content'] = 'admin/dashboard'; //dashboard
        $this->load->view('admin/includes/template', $data);
    }
    function user_list() {
        $data['user_list'] = $this->model->getData('op_user', array());
        $data['menu'] = 'user';
        $data['main_content'] = 'admin/user_list'; //dashboard
        $this->load->view('admin/includes/template', $data);
    }
    function add_new_category() {
        $data['category_list'] = $this->model->getDataOrderBy('category', array('status' => '1'), 'category_id', 'desc');
        $data['lang_name'] = $this->model->selectWhereData('tbl_language', array(), array('id', 'lang_name'), false);
        $data['menu'] = 'category';
        $data['main_content'] = 'admin/add_new_category';
        $this->load->view('admin/includes/template', $data);
    }
    function save_category() {
        $array_entity = $_POST;
        if (isset($array_entity) && !empty($array_entity)) {
            $category_name = $array_entity['category_name'];
            $category_data = $this->model->getData("category", array('category_name' => $category_name, 'status' => '1'));
            if (isset($category_data) && !empty($category_data)) {
                $data['class'] = 'danger';
                $data['msg'] = 'Category already exist.';
            } else {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpg|jpeg';
                // $config['max_size']='2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image_file')) {
                    $error = array('error' => $this->upload->display_errors());
                    $data['msg'] = $error['error'];
                    $this->load->view('admin/add_new_category', $data);
                } else {
                    move_uploaded_file($_FILES['image_file']['tmp_name']);
                    $data = array('file_path' => $this->upload->data());
                    $array_entity['image_path'] = 'uploads/' . $data['file_path']['file_name'];
                    $category_id = $this->model->insertData('category', $array_entity);
                    if ($category_id > 0) {
                        $data['class'] = 'success';
                        $data['msg'] = 'New category has been added successfully.';
                    } else {
                        $data['class'] = 'danger';
                        $data['msg'] = 'Something went wrong while submitting category.';
                    }
                }
            }
        } else {
            $data['class'] = 'danger';
            $data['msg'] = 'Invalid product category';
        }
        $this->session->set_flashdata($data);
        //echo "hii";die();
        redirect('Admin/add_new_category');
    }
    function edit_category() {
        $category_id = $this->input->get_post('category_id');
        $this->load->model('superadmin_model');
        $data['category_data'] = $this->superadmin_model->get_category($category_id);
        $data['menu'] = 'category';
        $data['main_content'] = 'admin/edit_category'; //dashboard
        $this->load->view('admin/includes/template', $data);
    }
    function update_category() {
        $array_entity = $_POST;
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['category_id'];
            $category_name = $array_entity['category_name'];
            if ($_FILES['image_file']['name'] != '') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image_file')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('admin/edit_category', $error);
                } else {
                    move_uploaded_file($_FILES['image_path']['tmp_name']);
                    $data = array('file_path' => $this->upload->data());
                    $array_entity['image_path'] = 'uploads/' . $data['file_path']['file_name'];
                }
            }
            //print_r($array_entity);die();
            $this->model->updateData('category', $array_entity, array('category_id' => $category_id));
            $data['class'] = 'success';
            $data['msg'] = 'Category has been updated successfully.';
        } else {
            $data['class'] = 'danger';
            $data['msg'] = 'Invalid category id.';
        }
        $this->session->set_flashdata($data);
        redirect('Admin/add_new_category');
    }
    function update_child_category() {
        $array_entity = $_POST;
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['child_category_id'];
            $category_name = $array_entity['category_name'];
            $this->model->updateData('childcategory', $array_entity, array('child_category_id' => $category_id));
            $data['class'] = 'success';
            $data['msg'] = 'Category has been updated successfully.';
        } else {
            $data['class'] = 'danger';
            $data['msg'] = 'Invalid category id.';
        }
        $this->session->set_flashdata($data);
        redirect('Admin/add_new_child_category');
    }
    function add_new_sub_category() {
        $data['menu'] = 'subcategory';
        $data['category_data'] = $this->model->getData('category', array('status' => '1'));
        $sql = "SELECT sb.sub_category_id,ct.category_name,ct.category_name_ar,sb.sub_category_name,
        sb.sub_category_name_ar,sb.sort_order FROM subcategory as sb
        left join category as ct on sb.category_id = ct.category_id
        WHERE sb.status=1";
        $data['lang_name'] = $this->model->selectWhereData('tbl_language', array(), array('id', 'lang_name'), false);
        $data['subcategory_list'] = $this->model->getSqlData($sql);
        $data['main_content'] = 'admin/add_new_sub_category';
        $this->load->view('admin/includes/template', $data);
    }
    function save_sub_category() {
        $jsonObj = $_POST['jsonObj'];
        //print_r($jsonObj);die();
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['category_id'];
            $sub_category_name = $array_entity['sub_category_name'];
            $sub_category_name_ar = $array_entity['sub_category_name_ar'];
            $sub_category_sort_order = $array_entity['sub_category_sort_order'];
           // $fk_lang_id = $array_entity['fk_lang_id'];
            $sub_category_data = $this->model->getData("subcategory", array('sub_category_name' => $sub_category_name, 'status' => '1'));
            if (isset($sub_category_data) && !empty($sub_category_data)) {
                $data['status'] = '0';
                $data['msg'] = 'Category already exist.';
            } else {
                $category_id = $this->model->insertData('subcategory', array('category_id' => $category_id, 'sub_category_name' => $sub_category_name, 'sort_order' => $sub_category_sort_order, 'sub_category_name_ar' => $sub_category_name_ar));
                if ($category_id > 0) {
                    $data['status'] = '1';
                    $data['msg'] = 'New sub category has been added successfully.';
                } else {
                    $data['status'] = '0';
                    $data['msg'] = 'Something went wrong while submitting sub category.';
                }
            }
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }
    function edit_sub_category() {
        $sub_category_id = $this->input->get_post('sub_category_id');
        $this->load->model('superadmin_model');
        $data['subcategory_data'] = $this->superadmin_model->get_subcategory($sub_category_id);
        $data['category_data'] = $this->model->getData('category', array('status' => '1'));
        $data['menu'] = 'subcategory';
        $data['main_content'] = 'admin/edit_sub_category'; //dashboard
        $this->load->view('admin/includes/template', $data);
    }
    function update_sub_category() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $sub_category_id = $array_entity['sub_category_id'];
            $category_id = $array_entity['category_id'];
            $sub_category_name = $array_entity['sub_category_name'];
            $sub_category_name_ar = $array_entity['sub_category_name_ar'];
            $sub_category_sort_order = $array_entity['sub_category_sort_order'];
            $this->model->updateData('subcategory', array('category_id' => $category_id, 'sub_category_name' => $sub_category_name, 'sort_order' => $sub_category_sort_order), array('sub_category_id' => $sub_category_id));
            $data['status'] = '1';
            $data['msg'] = 'Sub category has been updated successfully.';
            //redirect(base_url().'admin/add_new_sub_category');
         } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid sub category';
        }
        echo json_encode($data);
    }
    function sub_category_list() {
        $data['menu'] = 'product';
        $data['category_data'] = $this->model->getData('category', array('status' => '1'));
        $data['sub_category_list'] = $this->model->getAllData('subcategory');
        foreach ($data['sub_category_list'] as $key => $value) {
            $data['sub_category_list'][$key]['category_name'] = $this->model->getValue('category', 'category_name', array('category_id' => $value['category_id']));
        }
        $data['main_content'] = 'admin/sub_catgeory_list'; //dashboard
        $this->load->view('admin/includes/template', $data);
    }
    function get_sub_category_list() {
        $requestData = $_REQUEST;
        $totalData = $this->model->getAllData('subcategory');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM subcategory";
        if (!empty($requestData['search']['value'])) {
            $sql.= " WHERE status = '1' AND sub_category_name LIKE '%" . $requestData['search']['value'] . "%'";
        }
        $totalFiltered = $this->model->count_by_query($sql);
        $sql.= " where status = '1' ORDER BY sub_category_name " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ";
        $category_details = $this->model->getSqlData($sql);
        $data = array();
        foreach ($category_details as $key => $value) {
            $nestedData = array();
            $nestedData[] = ++$key;
            $nestedData[] = $this->model->getValue('category', 'category_name', array('category_id' => $value['category_id']));
            $nestedData[] = $value['sub_category_name'];
            $nestedData[] = $value['sub_category_name_ar'];
            $edit = "<span><a href=" . base_url() . "admin/edit_sub_category?sub_category_id=" . $value['sub_category_id'] . "><i class='fa fa-pencil'></i></a></span>&nbsp;&nbsp;";
            $delete = "<span><a href='#' onclick='delete_sub_category(this," . $value['sub_category_id'] . ")'><i class='fa fa-trash'></i></a></span>";
            $nestedData[] = "<ul class='table-options'>" . $edit . $delete . "</ul>";
            $data[] = $nestedData;
        }
        $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data);
        echo json_encode($json_data);
    }
    function add_new_child_category() {
        $data['menu'] = 'childcategory';
         $data['category_data']= $this->model->getDataOrderBy('category',array('status'=>'1'),'category_id','desc');
        $data['child_category_list'] = $this->model->getDataOrderBy('childcategory', array('status' => '1'), 'child_category_id ', 'desc');
        foreach ($data['child_category_list'] as $key => $value) {
            $data['child_category_list'][$key]['category_name'] = $this->model->getValue('category', 'category_name', array('category_id' => $value['category_id']));
            $data['child_category_list'][$key]['sub_category_name'] = $this->model->getValue('subcategory', 'sub_category_name', array('sub_category_id' => $value['sub_category_id']));
        }
        $data['lang_name'] = $this->model->selectWhereData('tbl_language', array(), array('id', 'lang_name'), false);
        $data['main_content'] = 'admin/add_new_child_category';
        $this->load->view('admin/includes/template', $data);
    }
    function save_child_category() {
        $array_entity = $_POST;
        if (isset($array_entity) && !empty($array_entity)) {
            $sub_category_id=$this->model->insertData('childcategory', $array_entity);
            // $data['status'] = '1';
            // $data['msg'] = 'Sub category has been updated successfully.';
            if ($sub_category_id > 0) {
                $data['class'] = 'success';
                $data['msg'] = 'Sub category has been added successfully.';
            } else {
                $data['class'] = 'danger';
                $data['msg'] = 'Something went wrong while submitting category.';
            }
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid sub category';
        }
        $this->session->set_flashdata($data);
        redirect('Admin/add_new_child_category');
    }
    function getsubcatdatabyid() {
        $child_category_id = $this->input->get_post('category_id');
        $data['childcategory'] = $this->model->getData('childcategory', array('child_category_id' => $child_category_id)) [0];
        $data['category_data_by_id'] = $this->model->getData('category', array('category_id' => $data['childcategory']['category_id']));
        $data['subcategory_data_by_id'] = $this->model->getData('subcategory', array('sub_category_id' => $data['childcategory']['sub_category_id']));
        echo json_encode($data['subcategory_data_by_id'][0]['sub_category_name']);
    }   
    function edit_child_category() {
        $child_category_id = $this->input->get_post('child_category_id');
        $this->load->model('superadmin_model');
        $data['childcategory'] = $this->superadmin_model->get_child_category($child_category_id) [0];
        $data['category_data'] = $this->model->getData('category', array('status' => '1'));
        $data['category_data_by_id'] = $this->model->getData('category', array('category_id' => $data['childcategory']['category_id']));
        $data['subcategory_data_by_id'] = $this->model->getData('subcategory', array('sub_category_id' => $data['childcategory']['sub_category_id']));
        $data['menu'] = 'childcategory';
        $data['main_content'] = 'admin/edit_child_category'; //dashboard
        // echo "<pre>";
        // print_r($data);
        // die;
        $this->load->view('admin/includes/template', $data);
    }
    function delete_child_category() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $child_category_id = $array_entity['child_category_id'];
            $this->model->updateData('childcategory', array('status' => '0'), array('child_category_id ' => $child_category_id));
            $data['status'] = '1';
            $data['msg'] = 'child category has been deleted successfully.';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid category Id.';
        }
        echo json_encode($data);
    }
    function delete_category() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['category_id'];
            $this->model->updateData('category', array('status' => '0'), array('category_id' => $category_id));
            $data['status'] = '1';
            $data['msg'] = 'category has been deleted successfully.';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }

    function delete_sub_category() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['sub_category_id'];
            $this->model->updateData('subcategory', array('status' => '0'), array('sub_category_id' => $category_id));
            $data['status'] = '1';
            $data['msg'] = 'subcategory has been deleted successfully.';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }
    function delete_banner() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['category_id'];
            $this->model->updateData('top_banner', array('status' => '0'), array('bottom_id' => $category_id));
            $data['status'] = '1';
            $data['msg'] = 'Banner has been deleted successfully.';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid product category';
        }
        echo json_encode($data);
    }
    function getCategory() {
        $postData = $_POST;
        $sub_category_list = $this->model->getData('category', array('status' => '1'));
        $category_data = array();
        foreach ($sub_category_list as $key => $value) {
            if ($postData['fk_lang_id'] == $value['fk_lang_id']) {
                $category_data[] = $value;
            }
        }
        echo json_encode($category_data);
    }

    function getproductname() {
        $postData = $_POST;
        $product_list = $this->model->getData('product', array('status' => '1'));
        $product_data = array();
        foreach ($product_list as $key => $value) {
            
                $product_data[] = $value;
        
        }
        echo json_encode($product_data);
    }

    function getSubCategory() {
        $postData = $_POST;
        $sub_category_list = $this->model->getData('subcategory', array('status' => '1'));
        $sub_cats = array();
        foreach ($sub_category_list as $key => $value) {
            if ($postData['category_id'] == $value['category_id']) {
                $sub_cats[] = $value;
            }
        }
        echo json_encode($sub_cats);
    }
    function getChildCategory(){
        $postData = $_POST;
        $sub_category_list = $this->model->getData('childcategory',array('status'=>'1'));
        $sub_cats = array();
        foreach ($sub_category_list as $key => $value) {
            if($postData['sub_category_id'] == $value['sub_category_id']){
                $sub_cats[] = $value;
            }
        }  
         echo json_encode($sub_cats);
     }
    function add_new_product() {
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] = 'product';
        $data['categpry_list'] = $this->model->getData("category", array('status' => '1'));
        $data['supplier_list'] = $this->model->getData("supplier_list", array('status' => '0'));
        $data['sub_category_list'] = $this->model->getData('subcategory', array('status' => '1'));
        $data['unit_list'] = $this->model->getData('product_unit', array('status' => '1'));
        $data['main_content'] = 'admin/add_new_product'; //dashboard
        $data['product_list'] = $this->model->getData("product", array('status' => '1'));
        $data['lang_name'] = $this->model->selectWhereData('tbl_language', array(), array('id', 'lang_name'), false);
        $this->load->view('admin/includes/template', $data);
    }

    function delete_gallery_product(){
        $jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['product'];
        if(isset($array_entity) && !empty($array_entity)){
            $product_id = $array_entity['product_id'];
            $img_path = $array_entity['img_path'];
            if(unlink(FCPATH.$img_path)) {
                echo 'File '.$img_path.' has been deleted';    
            }else echo 'Could not delete '.$filename;
            $this->model->deleteData('product_gallery',array('id'=>$product_id));    
            $data['msg'] = 'product Image has been deleted successfully.';
            
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid product details';
        }
        redirect('Admin/edit_product?product_id='.$product_id);
        echo json_encode($data);
    }
    
    function submit_product() {
        if(empty($_POST)){
            redirect('Admin/add_new_product');
        }else{
                $_POST['status'] = '1';
                $_POST['stock_status'] = '1';
                $_POST['relatable_products'] = implode(",", $_POST['relatable_products']);
                $product_array = $_POST;
                //print_r($product_array);die();
                $product_gallery = array();
                $data = array();
                if (!empty($_FILES['image_files']['name'][0])) {
                    $_FILES['file']['name'] = $_FILES['image_files']['name'][0];
                    $_FILES['file']['type'] = $_FILES['image_files']['type'][0];
                    $_FILES['file']['tmp_name'] = $_FILES['image_files']['tmp_name'][0];
                    $_FILES['file']['error'] = $_FILES['image_files']['error'][0];
                    $_FILES['file']['size'] = $_FILES['image_files']['size'][0];
                    $config['upload_path'] = './uploads/products/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $_FILES['image_files']['name'][0];
                    $product_array['image_name'] = $_FILES['image_files']['name'][0];
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $product_array['image_name'] = 'uploads/products/' . $filename;
                    }
                }
                $category_data = $this->model->CountWhereRecord("product", array('product_name' => $product_array['product_name'], 'status' => '1'));
                if ($category_data > 0) {
                    $this->session->set_flashdata('msg', 'Product Name already exist.');
                    redirect('Admin/add_new_product');
                } else {
                    
                    $last_id = $product_id = $this->model->insertData('product', $product_array);
                    $last_product_id = $this->db->insert_id();
                    $this->model->insertData('inventory',array('product_id' => $last_id,'qty' => $product_array['qty'],'supplier_id' => $product_array['supplier_id'],'created_at'=>date('Y-m-d H:i:s'),'status'=>'1'));
                    $countfiles = count($_FILES['image_files']['name']);
                    for ($i = 0;$i < $countfiles;$i++) {
                        if (!empty($_FILES['image_files']['name'][$i])) {
                            $_FILES['file']['name'] = $_FILES['image_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['image_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['image_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['image_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['image_files']['size'][$i];
                            $config['upload_path'] = './uploads/products/';
                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                            $config['file_name'] = $_FILES['image_files']['name'][$i];
                            $this->load->library('upload', $config);
                            if ($this->upload->do_upload('file')) {
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $product_gallery['img_name'] = $filename;
                                $product_gallery1 = './uploads/products/' . $filename;
                                $product_gallery['img_url'] = 'uploads/products/' . $filename;
                                $product_gallery['status'] = '1';
                                $product_gallery['product_id'] = $last_id;
                                $product_gallery['created_at'] = date('Y-m-d h:i:s');
                                $product_gallery['modified_on'] = date('Y-m-d h:i:s');
                                $product_gallery['modified_by'] = $this->session->userdata('op_user_id');
                                move_uploaded_file($_FILES['image_files']['tmp_name'], $product_gallery1);
                                //print_r($product_gallery);die();
                                $product_id = $this->model->insertData('product_gallery', $product_gallery);
                            }
                        }
                    }
                    $this->session->set_flashdata('msg', 'The new product has been uploaded successfully.');
                    redirect('Admin/product_list');
                }
            }
    }
    function update_products() {
        $_POST['status'] = '1';
        $_POST['stock_status'] = '1';
        $_POST['relatable_products'] = implode(",", $_POST['relatable_products']);
        $product_array = $_POST;
        if($product_array['featured'] == '1')
        { $product_array['featured']='1';
        }else{ $product_array['featured']='0'; }

        if($product_array['popular'] == '1')
        { $product_array['popular']='1';
        }else{ $product_array['popular']='0'; }

        if($product_array['best_selling'] == '1')
        { $product_array['best_selling']='1';
        }else{ $product_array['best_selling']='0'; }

        $product_gallery = array();
        
        $product_record = $this->model->getData('product_gallery', array('product_id' => $product_array['product_id']));
        if($product_record[0]['img_url'] != '')
        {
            $product_array['image_name']=$product_record[0]['img_url'];
        }else{
            $product_array['image_name']='uploads/products/'.$_FILES['image_files']['name'][0];
        }
        $data['product_data'] = $this->model->getData('product', array('product_id' => $product_array['product_id']));
        if($data['product_data'][0]['qty'] != $product_array['qty'])
        {
            $inventory=$this->model->selectWhereData('inventory',array('product_id' => $product_array['product_id'],'supplier_id' => $product_array['supplier_id'],'status'=>'1'),array('qty','id'));
            $new_qty=$inventory['qty']+ $product_array['qty'];
            
            if($this->model->updateData('inventory',array('modified_at'=>date('Y-m-d H:i:s'),'status'=>'0'),array('id'=>$inventory['id'])))
            {
                $this->model->insertData('inventory',array('qty'=>$new_qty,'product_id' => $product_array['product_id'],'supplier_id' => $product_array['supplier_id'],'created_at'=>date('Y-m-d H:i:s'),'status'=>'1'));
            }
        }   
        if($data['product_data'][0]['qty'] != $product_array['qty'])
        {
            $last_id = $this->model->updateData('product',array('qty'=>$new_qty), array('product_id' => $product_array['product_id']));
        }
        else{
            $last_id = $this->model->updateData('product', $product_array, array('product_id' => $product_array['product_id']));
        }
            $last_product_id = $product_array['product_id'];
        $countfiles = count($_FILES['image_files']['name']);
        for ($i = 0;$i < $countfiles;$i++) {
            if (!empty($_FILES['image_files']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['image_files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['image_files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['image_files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['image_files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['image_files']['size'][$i];
                $config['upload_path'] = './uploads/products/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['image_files']['name'][$i];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $product_gallery['img_name'] = $filename;
                    $product_gallery1 = './uploads/products/' . $filename;
                    $product_gallery['img_url'] = 'uploads/products/' . $filename;
                    $product_gallery['status'] = '1';
                    $product_gallery['product_id'] = $last_product_id;
                    $product_gallery['created_at'] = date('Y-m-d h:i:s');
                    $product_gallery['modified_on'] = date('Y-m-d h:i:s');
                    $product_gallery['modified_by'] = $this->session->userdata('op_user_id');
                    move_uploaded_file($_FILES['image_files']['tmp_name'], $product_gallery1);
                    $product_id = $this->model->insertData('product_gallery', $product_gallery);
                }
            }
        }
        $this->session->set_flashdata('msg', 'The new product has been uploaded successfully.');
        redirect('Admin/product_list');
        //}
        
    }
    function upload_banner_image() {
        $product_array = $_POST;
        $data = array();
        $countfiles = count($_FILES['image_files']['name']);
        for ($i = 0;$i < $countfiles;$i++) {
            if (!empty($_FILES['image_files']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['image_files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['image_files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['image_files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['image_files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['image_files']['size'][$i];
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['image_files']['name'][$i];
                $product_array['image_name'] = $_FILES['image_files']['name'][$i];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $product_array['img_url'] = 'uploads/' . $filename;
                    $product_array['status'] = '1';
                    $product_id = $this->model->insertData('top_banner', $product_array);
                }
            }
        }
        $this->session->set_flashdata('msg', 'The new banner has been uploaded successfully.');
        redirect('Admin/add_banner');
    }
    function product_list() {
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] = 'product';
        $sql = "SELECT ct.category_name,ct.category_name_ar,sct.sub_category_name,sct.sub_category_name_ar,cct.child_category_name, cct.child_category_name_ar,pu.unit_name,pr.* FROM `product` as pr LEFT join category as ct on pr.category_id = ct.category_id LEFT JOIN subcategory as sct on pr.sub_category_id = sct.sub_category_id left JOIN childcategory as cct on pr.child_category_id = cct.child_category_id left join product_unit as pu on pr.unit_id = pu.unit_id WHERE pr.status= 1";
        $data['product_list'] = $this->model->getSqlData($sql);
        $data['main_content'] = 'admin/product_list'; //dashboard
        $this->load->view('admin/includes/template', $data);
    }
    function get_product_list() {
        $requestData = $_REQUEST;
        $totalData = $this->model->getAllData('product');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM product WHERE status = '1' ";
        if (!empty($requestData['search']['value'])) {
            $sql.= "  AND ( product_name LIKE '%" . $requestData['search']['value'] . "%' ) ";
        }
        $totalFiltered = $this->model->count_by_query($sql);
        $sql.= " ORDER BY product_name " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        $product_details = $this->model->getSqlData($sql);
        $data = array();
        $pack_wise_product_data = array();
        foreach ($product_details as $key => $value) {
            if (!empty($value['pack_size'])) {
                $packs = explode(',', $value['pack_size']);
                $price = explode(',', $value['price']);
                $vendor_sku = explode(',', $value['vendor_sku']);
                $sku2 = explode(',', $value['sku2']);
                foreach ($packs as $key1 => $value1) {
                    $value['pack_size'] = $value1;
                    $value['price'] = isset($price[$key1]) ? $price[$key1] : '';
                    $value['vendor_sku'] = isset($vendor_sku[$key1]) ? $vendor_sku[$key1] : '';
                    $value['sku2'] = isset($sku2[$key1]) ? $sku2[$key1] : '';
                    $pack_wise_product_data[] = $value;
                }
            } else {
                $pack_wise_product_data[] = $value;
            }
        }
        foreach ($pack_wise_product_data as $key => $value) {
            $category_data = $this->model->getData('category', array('category_id' => $value['category_id']));
            $sub_category_data = $this->model->getData('subcategory', array('sub_category_id' => $value['sub_category_id']));
            $stock_status = '';
            $nestedData = array();
            $nestedData[] = $value['product_id'];
            $nestedData[] = strtoupper($value['product_name']);
            $nestedData[] = $value['pack_size'];
            $nestedData[] = $value['vendor_sku'];
            $nestedData[] = $value['sku2'];
            $nestedData[] = strtoupper($category_data[0]['category_name']);
            $nestedData[] = strtoupper($sub_category_data[0]['sub_category_name']);
            $nestedData[] = "<i class='fa fa-rupee'></i> " . $value['price'];
            /*   $nestedData[] = "<i class='fa fa-rupee'></i> ".$value['old_price'];*/
            if ($value['status'] == '0') {
                $update_active = access('product_list', 'update_access') ? "onclick='update_product_status(this,1," . $value['product_id'] . ")'" : "";
                $nestedData[] = "<a href='javascript:void(0);'" . $update_active . " >DE-ACTIVE</a>";
            } else {
                $update_deactive = access('product_list', 'update_access') ? "onclick='update_product_status(this,0," . $value['product_id'] . ")'" : "";
                $nestedData[] = "<a href='javascript:void(0);'" . $update_deactive . ">ACTIVE</a>";
            }
            if ($value['stock_status'] == '0') {
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_stock_status(this,1," . $value['product_id'] . ")'>Out of Stock</a>";
            } else {
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_stock_status(this,0," . $value['product_id'] . ")'>In Stock</a>";
            }
            $edit = "<span><a href=" . base_url() . "admin/edit_product?product_id=" . $value['product_id'] . "><i class='fa fa-pencil'></i></a></span>&nbsp;&nbsp;";
            $delete = "<span><a href='#' onclick='delete_product(this," . $value['product_id'] . ")'><i class='fa fa-trash'></i></a></span>";
            $nestedData[] = "<ul class='table-options'>" . $edit . $delete . "</ul>";
            $data[] = $nestedData;
        }
        $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data,);
        echo json_encode($json_data);
    }
    function get_product_details() {
        $product_id = $this->input->post('product_id');
        $data['product'] = $this->model->getData('product', array('status' => '1', 'product_id' => $product_id)) [0];
        $data['product_unit'] = $this->model->getData('product_unit', array('status' => '1', 'unit_id' => $data['product']['unit_id'])) [0];
        echo json_encode($data);
    }
    function update_product_status() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        $session_id = $this->session->userdata('session_id');
        if (isset($array_entity) && !empty($array_entity) && $session_id != "") {
            $product_id = $array_entity['product_id'];
            $stock_status = $array_entity['stock_status'];
            $this->model->updateData('product', array('stock_status' => $stock_status), array('product_id' => $product_id));
            $data['status'] = '1';
            $data['msg'] = 'Product stock status has been updated';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Your session has been expired';
        }
        echo json_encode($data);
    }
    function update_product_active_deactive_status() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        $session_id = $this->session->userdata('session_id');
        if (isset($array_entity) && !empty($array_entity) && $session_id != "") {
            $product_id = $array_entity['product_id'];
            $stock_status = $array_entity['status'];
            $this->model->updateData('product', array('stock_status' => $stock_status), array('product_id' => $product_id));
            $data['status'] = '1';
            $data['msg'] = 'Product status has been updated';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Your session has been expired';
        }
        echo json_encode($data);
    }
    //Done by mansi
    function delete_user() {
        $user_id = $_GET['op_user_id'];
        $this->model->deleteData('op_user', array('op_user_id' => $user_id));
        $this->session->set_flashdata('msg', 'The Customer Deleted Successfully');
        redirect('Admin/user_list');
    }
    function delete_product() {
        $jsonObj = $_POST['jsonObj'];
        $array_data = json_decode($jsonObj, true);
        $array_entity = $array_data['product'];
        if (isset($array_entity) && !empty($array_entity)) {
            $product_id = $array_entity['product_id'];
            $this->model->updateData('product', array('status' => '0'), array('product_id' => $product_id));
            $data['status'] = '1';
            $data['msg'] = 'product has been deleted successfully.';
        } else {
            $data['status'] = '0';
            $data['msg'] = 'Invalid product details';
        }
        echo json_encode($data);
    }
    function add_banner() {
        $data['menu'] = 'banner';
        $data['product_list'] = $this->model->getData("category", array('status' => '1'));
        $data['lang_name'] = $this->model->selectWhereData('tbl_language', array(), array('id', 'lang_name'), false);
        $data['banner_list'] = $this->model->getDataOrderBy('top_banner', array('status' => '1'), 'bottom_id', 'desc');
        $data['main_content'] = 'admin/add_banner';
        $this->load->view('admin/includes/template', $data);
    }
    function update_banner_image() {
        $array_entity = $_POST;
        if (isset($array_entity) && !empty($array_entity)) {
            $category_id = $array_entity['bottom_id'];
            if ($_FILES['image_file']['name'] != '') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image_file')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('upload_form', $error);
                } else {
                    move_uploaded_file($_FILES['image_file']['tmp_name']);
                    $data = array('file_path' => $this->upload->data());
                    $array_entity['img_url'] = 'uploads/' . $data['file_path']['file_name'];
                }
            }
            $this->model->updateData('top_banner', $array_entity, array('bottom_id' => $category_id));
            $data['class'] = 'success';
            $data['msg'] = 'Banner has been updated successfully.';
        } else {
            $data['class'] = 'danger';
            $data['msg'] = 'Invalid category id.';
        }
        $this->session->set_flashdata($data);
        redirect('Admin/add_banner');
    }
    function edit_banner() {
        $data['menu'] = 'banner';
        $bottom_id = $_GET['bottom_id'];
        $data['banner_data'] = $this->model->getData('top_banner', array('bottom_id' => $bottom_id));
        $this->load->model('superadmin_model');
        $data['lang_id'] = $this->superadmin_model->get_product($data['banner_data'][0]['fk_lang_id']);
        $data['product_list'] = $this->model->getData("product", array('status' => '1'));
        $data['lang_name'] = $this->model->selectWhereData('tbl_language', array(), array('id', 'lang_name'), false);
        $data['main_content'] = 'admin/edit_banner';
        $this->load->view('admin/includes/template', $data);
    }
    function edit_product() {
        $data['menu'] = 'product';
        $product_id = $_GET['product_id'];
        $data['product_data'] = $this->model->getData('product', array('product_id' => $product_id));
        $data['supplier_list'] = $this->model->getData("supplier_list", array('status' => '0'));
        $data['product_gallery'] = $this->model->getData('product_gallery', array('product_id' => $product_id));
        $data['unit_list_by_id'] = $this->model->getData("product_unit", array('status' => '1'));
        $data['subcat_by_id'] = $this->model->getData('subcategory', array('category_id' => $data['product_data'][0]['category_id']));
        $data['category_data'] = $this->model->getData('category', array('fk_lang_id' => $data['product_data'][0]['fk_lang_id']));
        $data['lang_name'] = $this->model->getData('tbl_language', array('id' => $data['product_data'][0]['fk_lang_id']));
        $data['category_list'] = $this->model->getData("category", array('status' => '1','fk_lang_id' => $data['product_data'][0]['fk_lang_id']));
        $data['product_list'] = $this->model->getData("product", array('status' => '1'));
        $data['sub_category_list'] = $this->model->getData('subcategory', array('status' => '1'));
        $data['unit_list'] = $this->model->getData('product_unit', array('status' => '1'));
        $data['main_content'] = 'admin/edit_product';
        $this->load->view('admin/includes/template', $data);
    }
    function company_setting() {
        $data['menu'] = 'setting';
        $data['company_setting'] = $this->model->getData('company_setting', array('comp_sett_id' => '1'));
        $data['state_list'] = $this->model->getData('states');
        $data['main_content'] = 'admin/company_setting';
        $this->load->view('admin/includes/template', $data);
    }
    function save_company_setting() {
        $postData = $_POST;
        if (!empty($_FILES['company_logo'])) {
            $uploaddir = './uploads/';
            $filename = rand() . basename($_FILES['company_logo']['name']);
            $uploadfile = $uploaddir . $filename;
            if (move_uploaded_file($_FILES['company_logo']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
                $postData['company_logo'] = $filename;
            } else {
                echo "Upload failed";
            }
        }
        $this->model->updateData('company_setting', $postData, array('comp_sett_id' => '1'));
        $this->session->set_flashdata('msg', 'Company Setting Saved Successfully.');
        redirect('Admin/company_setting');
    }

    function add_supplier(){
        $data['status'] = '';
        $data['msg'] = '';
        $data['menu'] ='supplier';
        $data['categpry_list'] = $this->model->getData('category',array('status'=>'1'));
        $data['sub_category_list'] =$this->model->getData('subcategory',array('status'=>'1'));
        $data['unit_list'] =$this->model->getData('product_unit',array('status'=>'1'));
        $data['product_list'] =$this->model->getData('product',array('status'=>'1'));

        $data['main_content']='admin/add_supplier'; //dashboard
        $this->load->view('admin/includes/template',$data);
    }
    
    function submit_supplier_form(){
        if(empty($_POST))
        {
            redirect('Admin/add_supplier');
        }else{
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
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'pdf';
                        // $config['max_size']='2000';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('gst_file')) {
                            $error = array('error' => $this->upload->display_errors());
                            $data['msg'] = $error['error'];
                            $this->load->view('admin/add_new_product', $data);
                        } else {
                            $data = array('file_path' => $this->upload->data());
                            $filename = rand().basename($_FILES['gst_file']['name']);
                            $uploadfile = 'uploads/' . $filename;
                            if (move_uploaded_file($_FILES['gst_file']['tmp_name'], $uploadfile)) {
                                echo "File is valid, and was successfully uploaded.\n";
                                $gst_file_name = $uploadfile;
                              } else {
                                 echo "Upload failed";
                                 $gst_file_name = "";
                              }
                        }
                        // $uploaddir = './uploads/gst_files/';
                        // $filename = rand().basename($_FILES['gst_file']['name']);
                        // $uploadfile = $uploaddir.$filename;
    
                        // if (move_uploaded_file($_FILES['gst_file']['tmp_name'], $uploadfile)) {
                        //   echo "File is valid, and was successfully uploaded.\n";
                        //   $gst_file_name = $filename;
                        // } else {
                        //    echo "Upload failed";
                        //    $gst_file_name = "";
                        // }
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
                    'account_name'=>$_POST['account_name'],
                    'account_no'=>$_POST['account_no'],
                    'bank_name'=>$_POST['bank_name'],
                    'branch_name'=>$_POST['branch_name'],
                    'ifsc_code'=>$_POST['ifsc_code'],
                    'swift_code'=>$_POST['swift_code'],
                    'created_at'=>date('Y-m-d H:i:s')
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
                redirect('Admin/supplier_list');
            }else{
                $data['status'] = '0';
                $data['msg'] = 'Invalid supplier name.';
            }
            echo json_encode($data); 
        }

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
        $totalData = $this->model->getDataOrderBy('supplier_list',array(),'id','desc');
        $totalFiltered = $totalData;
        $sql = "SELECT * FROM supplier_list  ";
        if( !empty($requestData['search']['value']) ) { 
            $sql.="  WHERE ( supplier_name LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $totalFiltered =$this->model->count_by_query($sql);
        //$sql.=" ORDER BY supplier_name ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $sql.=" ORDER BY supplier_name ";

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
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_supplier_status(this,1,".$value['id'].")'>DE-ACTIVE</a>";
            }else{
                $nestedData[] = "<a href='javascript:void(0);' onclick='update_supplier_status(this,0,".$value['id'].")'>ACTIVE</a>";
            }

            $edit =  "<span><a href=".base_url()."Admin/edit_supplier?supplier_id=".$value['id']."><i class='fa fa-pencil'></i></a></span>";

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
            $sup_id = $array_entity['id'];
            $status = $array_entity['status'];

            $this->model->updateData('supplier_list',array('status'=>$status),array('id'=>$sup_id));

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
            $data['supplier_data'] = $this->model->getData('supplier_list',array('id'=>$supplier_id));
            //$data['product_list'] =$this->model->getData('product',array('status'=>'1','product_type'=>'R'));
            //$supplier_items = $this->model->getData('supplier_items',array('supplier_id'=>$supplier_id));
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

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                // $config['max_size']='2000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gst_file')) {
                    $error = array('error' => $this->upload->display_errors());
                    $data['msg'] = $error['error'];
                    $this->load->view('admin/add_new_product', $data);
                } else {
                    $data = array('file_path' => $this->upload->data());
                    $filename = rand().basename($_FILES['gst_file']['name']);
                    $uploadfile = 'uploads/' . $filename;
                    if (move_uploaded_file($_FILES['gst_file']['tmp_name'], $uploadfile)) {
                        echo "File is valid, and was successfully uploaded.\n";
                        $gst_file_name = $uploadfile;
                      } else {
                         echo "Upload failed";
                         $gst_file_name = "";
                      }
                }
            }
            else{
               $gst_file_name =  $_POST['gst_file_name'];
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
                'account_name'=>$_POST['account_name'],
                'account_no'=>$_POST['account_no'],
                'bank_name'=>$_POST['bank_name'],
                'branch_name'=>$_POST['branch_name'],
                'ifsc_code'=>$_POST['ifsc_code'],
                'swift_code'=>$_POST['swift_code']

            );
            // print_array($update_data);
            $this->model->updateData('supplier_list',$update_data,array('id'=>$sup_id));

            $data['status'] = '1';
            $this->session->set_flashdata('msg','Supplier updated successfully.');
            redirect('Admin/supplier_list');
        }else{
            $data['status'] = '0';
            $data['msg'] = 'Invalid supplier id.';
        }
        echo json_encode($data);
        redirect('Admin/supplier_list');
    }

    public function Order_history()
    {
         $this->load->model('superadmin_model');
         $order_data = $this->superadmin_model->Order_details();
         $data['order_data'] = $order_data;

        $this->load->view('admin/Order_history',$data);
    }

    public function Order_details()
    {
        $id = $_GET['id'];
         $this->load->model('superadmin_model');
         $order_data = $this->superadmin_model->order_history_on_order_id($id);
         $data['order_data'] = $order_data;
         // echo '<pre>'; print_r($data); exit;
        $this->load->view('admin/Order_details',$data);

    }
}
?>