<?php
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

}
?>

