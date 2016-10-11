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
	
	//hitung jumlah item
	function getAllDataItemNumber(){
		$query = $this->db->query("select * from tbl_master_item order by id_item desc");
		if($query->num_rows() > 0) {
        return $query->num_rows();
		} else {
            return $query->num_rows(); //if data is wrong
		}
    }
	
	
	//hitung jumlah item
	function getAllDataItemInNumber(){
		$query = $this->db->query("select * from tbl_master_item_in order by id_item_in desc");
		if($query->num_rows() > 0) {
        return $query->num_rows();
		} else {
            return $query->num_rows(); //if data is wrong
		}
    }
	
	//ambil data barang
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
	
	//ambil data barang masuk
	function getItemIn()
	{
       $query = $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note, 
		b.id_item_in, b.id_delivery_service,b.id_agen as id_agen_detail_item_in, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.id_agen,d.agen_name
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service 
			left join tbl_master_agen d on b.id_agen=d.id_agen
			order by a.id_item_in desc");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	 
	//ambil data header barang masuk
	function getItemInHeader($id_item_in)
	{	
       $query = $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		b.id_item_in, b.id_delivery_service, b.id_user, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type,d.no_unique_agen
		 
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	 
	//ambil data isi barang masuk
	function getItemInData($id_item_in)
	{ 
       $query = $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_in as id_item_in_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
		from tbl_master_item_in a left join tbl_detail_item e on a.id_item_in=e.id_item_in 
		left join tbl_master_item d on e.id_item=d.id_item 
		left join tbl_master_category f on e.id_category=f.id_category where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
	
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
}
?>
	 
	
	

