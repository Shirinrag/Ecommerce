<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Superadmin_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	public function get_category($id='')
	{
		$this->db->select('category.*,tbl_language.lang_name');
		$this->db->from('category');
		$this->db->join('tbl_language','category.fk_lang_id=tbl_language.id','left');
		$this->db->where('category.category_id',$id);
		 $query=$this->db->get();
        return $query->result_array();
	}

	public function get_subcategory($id='')
	{
		$this->db->select('subcategory.*,tbl_language.lang_name');
		$this->db->from('subcategory');
		$this->db->join('tbl_language','subcategory.fk_lang_id=tbl_language.id','left');
		$this->db->where('subcategory.sub_category_id',$id);
		 $query=$this->db->get();
        return $query->result_array();
	}

	public function get_child_category($id='')
	{
		$this->db->select('childcategory.*,tbl_language.lang_name');
		$this->db->from('childcategory');
		$this->db->join('tbl_language','childcategory.fk_lang_id=tbl_language.id','left');
		$this->db->where('childcategory.child_category_id',$id);
		 $query=$this->db->get();
        return $query->result_array();
	}

	public function get_product($id='')
	{
		$this->db->select('product.*,tbl_language.lang_name');
		$this->db->from('product');
		$this->db->join('tbl_language','product.fk_lang_id=tbl_language.id','left');
		$this->db->where('product.product_id',$id);
		 $query=$this->db->get();
        return $query->result_array();
	}

	public function Order_details()
	{
		$this->db->select('order_data.*,product.product_name,product.image_name,user_delivery_address.roomno,user_delivery_address.building,user_delivery_address.street,user_delivery_address.zone,tbl_payment.payment_type,op_user.user_name');
        $this->db->from('order_data');
        $this->db->join('product','order_data.fk_product_id=product.product_id','left');
        $this->db->join('tbl_payment','order_data.order_number=tbl_payment.order_id','left');
        $this->db->join('op_user','order_data.fk_user_id=op_user.op_user_id','left');
        $this->db->join('user_delivery_address','order_data.fk_address_id=user_delivery_address.id','left');
        // $this->db->where('order_data.id',$id);   
      
        $this->db->order_by('order_data.id','DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}
	public function order_history_on_order_id($id='')
    {
    	$this->db->simple_query('SET SESSION group_concat_max_len = 10000000000000000');
        $this->db->select('order_data.*,product.product_name,product.image_name,GROUP_CONCAT(tbl_order_status.status) as status,GROUP_CONCAT(tbl_order_status_master.order_status) as order_status,user_delivery_address.roomno,user_delivery_address.building,user_delivery_address.street,user_delivery_address.zone,tbl_payment.payment_type,op_user.user_name');
        $this->db->from('order_data');
        $this->db->join('product','order_data.fk_product_id=product.product_id','left');
        $this->db->join('tbl_payment','order_data.order_number=tbl_payment.order_id','left');
        $this->db->join('op_user','order_data.fk_user_id=op_user.op_user_id','left');
        $this->db->join('tbl_order_status','order_data.id=tbl_order_status.fk_order_id','left');
        $this->db->join('tbl_order_status_master','tbl_order_status.status=tbl_order_status_master.id','left');
      
        $this->db->join('user_delivery_address','order_data.fk_address_id=user_delivery_address.id','left');
        $this->db->where('order_data.id',$id);   
       $this->db->group_by('order_data.id'); 
        $this->db->order_by('order_data.id','DESC');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function display_inventory_data()
    {
    	$this->db->select('product.product_name,GROUP_CONCAT(inventory.add_qty) as add_qty,GROUP_CONCAT(inventory.qty) as qty,GROUP_CONCAT(inventory.deduct_qty) as deduct_qty, GROUP_CONCAT(inventory.id) as id, GROUP_CONCAT(inventory.date) as date');
    	$this->db->from('inventory');
    	$this->db->join('product','product.product_id=inventory.product_id','left');
    	 $this->db->group_by('product.product_id'); 
        $this->db->order_by('inventory.id','DESC');
    	  $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

  // public function display_inventory_data()
  // {
  //  $this->db->select('product.product_name,GROUP_CONCAT(inventory.add_qty) as add_qty,GROUP_CONCAT(if(inventory.qty IS NULL or inventory.qty='','0',inventory.qty)) as qty,GROUP_CONCAT(if(inventory.deduct_qty IS NULL or inventory.deduct_qty='','0',inventory.deduct_qty)) as deduct_qty, GROUP_CONCAT(inventory.id) as id, GROUP_CONCAT(inventory.date) as date');
  //  $this->db->from('inventory');
  //  $this->db->join('product','product.product_id=inventory.product_id','left');
  //  $this->db->group_by('product.product_id');
  //     $this->db->order_by('inventory.id','DESC');
  //   $query = $this->db->get();
  //     $result = $query->result_array();
  //     return $result;
  // }
}
?>

