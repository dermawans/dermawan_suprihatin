<?php 

class Model_api extends CI_Model{
    
	function __construct(){
        parent::__construct();
    }
	
	//-----------------login------------------//
	//cek apakah email ada atau tidak
	function cekEmail($email)
	{
       $query = $this->db->query("select * from tbl_master_user where email='".$email."' ");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	//cek apakah email sudah diaktifasi atau belum
	function cekAktifasi($email)
	{  
        $query = $this->db->query("select * from tbl_master_user where email='".$email."' and status='Y'");
        if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
    	}
	}
	//cek password benar atau tidak
	function cekPassword($email, $password) {
        $query = $this->db->query("select * from tbl_master_user where email='".$email."' and password='".md5($password)."'");
        if($query->num_rows() > 0) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    
    }
	//-----------------Register------------------//
	
	//cek apakah email ada atau tidak
	function cekEmailDB($email)
	{
       $query = $this->db->query("select * from tbl_master_user where email<>'".$email."' ");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	
	//-----------------Ambil data barang------------------//
	
	//cek apakah email ada atau tidak
	function getAllDataItemNumber(){
		$query = $this->db->query("select * from tbl_master_item order by id_item desc");
		if($query->num_rows() > 0) {
        return $query->num_rows();
		} else {
            return $query->num_rows(); //if data is wrong
		}
    }
	
	function getItem()
	{
       $query = $this->db->query("select distinct
		a.no_id_item,a.id_item,a.item_name,a.esn,a.sn,a.total,a.status,a.contents,a.note,
		b.no_id_detail_item,b.id_item as id_item_detail_item,b.id_category,b.id_item_in as id_item_in_detail_item,
		c.id_category as id_category_master_category,c.category_name
		 
			from tbl_master_item a left join tbl_detail_item b on a.id_item=b.id_item 
			left join tbl_master_category c on b.id_category=c.id_category order by a.no_id_item asc");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
}
?>
	 
	
	

