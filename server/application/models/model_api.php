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
	
	
	//hitung jumlah item in
	function getAllDataItemInNumber(){
		$query = $this->db->query("select * from tbl_master_item_in order by id_item_in desc");
		if($query->num_rows() > 0) {
        return $query->num_rows();
		} else {
            return $query->num_rows(); //if data is wrong
		}
    }
	
	//hitung jumlah item out
	function getAllDataItemOutNumber(){
		$query = $this->db->query("select * from tbl_master_item_out order by id_item_out desc");
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
		a.no_id_item_in, a.id_item_in , a.date_in, a.id_sender, a.id_receiver,a.note, 
		c.id_delivery_service,c.delivery_service_name, 
		d.id_agen,d.agen_name
			from tbl_master_item_in a left join tbl_master_delivery_service c on a.id_sender=c.id_delivery_service 
			left join tbl_master_agen d on a.id_receiver=d.id_agen
			order by a.id_item_in desc");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	
	//ambil data barang masuk
	function getItemOut()
	{
       $query = $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out , a.date_out, a.id_sender, a.id_receiver, a.note, 
		c.id_delivery_service,c.delivery_service_name, 
		d.id_agen,d.agen_name,d.agen_operational_name
			from tbl_master_item_out a left join tbl_master_delivery_service c on a.id_sender=c.id_delivery_service 
			left join tbl_master_agen d on a.id_receiver=d.id_agen
			order by a.id_item_out desc");
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
		a.no_id_item_in, a.id_item_in , a.date_in, a.id_sender, a.id_receiver,a.note, 
		c.id_delivery_service,c.delivery_service_name, 
		d.id_agen,d.agen_name
			from tbl_master_item_in a left join tbl_master_delivery_service c on a.id_sender=c.id_delivery_service 
			left join tbl_master_agen d on a.id_receiver=d.id_agen 
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
	
	//ambil data header barang masuk
	function getItemOutHeader($id_item_out)
	{	
       $query = $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out , a.date_out, a.id_sender, a.id_receiver,a.note, MAX(RIGHT(id_item_out,6)) as sequence,
		c.id_delivery_service,c.delivery_service_name, 			
	d.id_agen,d.agen_name,d.agen_operational_name,d.agen_operational_address,d.agen_phone_number_1,d.agen_phone_number_2,d.longitude,d.latitude,d.no_unique_agen
			from tbl_master_item_out a left join tbl_master_delivery_service c on a.id_sender=c.id_delivery_service 
			left join tbl_master_agen d on a.id_receiver=d.id_agen 
			where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	 
	//ambil data isi barang masuk
	function getItemOutData($id_item_out)
	{ 
       $query = $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
		from tbl_master_item_out a left join tbl_detail_item e on a.id_item_out=e.id_item_out 
		left join tbl_master_item d on e.id_item=d.id_item 
		left join tbl_master_category f on e.id_category=f.id_category where a.id_item_out='".$id_item_out."' order by a.id_item_out desc
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	// untuk item
	
	//ambil data header barang masuk
	function getItemInItemHeader($id_item_in)
	{	
       $query = $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in , a.date_in, a.id_sender, a.id_receiver,a.note, 
		c.id_delivery_service,c.delivery_service_name, 
		d.id_agen,d.agen_name
			from tbl_master_item_in a left join tbl_master_delivery_service c on a.id_sender=c.id_delivery_service 
			left join tbl_master_agen d on a.id_receiver=d.id_agen 
			where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	 
	//ambil data isi barang masuk
	function getItemInItemData($id_item)
	{ 
       $query = $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_in as id_item_in_detail_item,
		g.id_agen,g.agen_name,g.agen_operational_name,g.agen_operational_address,g.agen_phone_number_1,g.agen_phone_number_2,g.longitude,g.latitude,g.no_unique_agen,
		b.id_delivery_service,b.delivery_service_name	
		 
		from tbl_master_item_in a 
		left join tbl_detail_item e on a.id_item_in=e.id_item_in 
		left join tbl_master_item d on e.id_item=d.id_item 
		left join tbl_master_agen g on a.id_receiver=g.id_agen 
		left join tbl_master_delivery_service b on a.id_sender=b.id_delivery_service 
		where d.id_item='".$id_item."' order by a.id_item_in desc
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	//ambil data isi barang masuk
	function getItemOutItemData($id_item)
	{ 
       $query = $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		g.id_agen,g.agen_name,g.agen_operational_name,g.agen_operational_address,g.agen_phone_number_1,g.agen_phone_number_2,g.longitude,g.latitude,g.no_unique_agen,
		b.id_delivery_service,b.delivery_service_name	
		 
		from tbl_master_item_out a 
		left join tbl_detail_item e on a.id_item_out=e.id_item_out 
		left join tbl_master_item d on e.id_item=d.id_item 
		left join tbl_master_agen g on a.id_receiver=g.id_agen 
		left join tbl_master_delivery_service b on a.id_sender=b.id_delivery_service 
		where d.id_item='".$id_item."' order by a.id_item_out desc
		");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	// untuk item
	
	// Bikin nomor urut item in =================
     function getIDItemIn()
    {
        $query = $this->db->query("select MAX(RIGHT(id_item_in,5)) as kd_max from tbl_master_item_in");
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
			$month = date("m");
			$year = date("Y");
        }
        else
        {
            $kd = "000001";
        }
        return $year."/".$month."/IND/II/".$kd;
    } 
	
	// Bikin nomor urut item out =================
     function getIDItemOut()
    {
        $query = $this->db->query("select MAX(RIGHT(id_item_out,5)) as kd_max from tbl_master_item_out");
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
			$month = date("m");
			$year = date("Y");
        }
        else
        {
            $kd = "000001";
        }
        return $year."/".$month."/IND/IO/".$kd;
    } 
	
	
	// Bikin nomor urut item  =================
     function getIDItem()
    {
        $query = $this->db->query("select MAX(RIGHT(id_item,7)) as kd_max from tbl_master_item");
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%07s", $tmp);
            }
			$month = date("m");
			$year = date("y");
        }
        else
        {
            $kd = "0000001";
        }
        return "IND".$year.$month."i".$kd;
    } 
	
	//ambil data inventory agen
	function getDataInventoryAgen()
	{
       $query = $this->db->query("select a.id_agen,a.agen_name,b.id_agen,b.level,b.status 
	   from tbl_master_agen a left join tbl_master_user b on a.id_agen=b.id_agen
	   where b.level='inventory_admin' order by a.id_agen asc");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	//ambil data dalivery service
	function getDataDeliveryService()
	{
       $query = $this->db->query("select * from tbl_master_delivery_service");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	//ambil data inventory agen
	function getDataAgen()
	{
       $query = $this->db->query("select * from tbl_master_agen where agen_type='Laku' and status='Approve'");
       if($query->num_rows() > 0) {
        return $query->result();
		} else {
            return $query->result(); //if data is wrong
		}
    }
	
	function getDataItemNotOut(){
		return $this->db->query("select
		a.id_item, a.item_name, a.esn, a.sn, a.total, a.status, a.contents, a.note as note_item, a.inputer,
		b.id_category, b.id_item_in, b.id_item_out,
		c.id_item_out,
		d.id_sender, d.id_receiver, d.date_out, d.note,
		e.id_agen, e.agen_name,
		f.id_delivery_service,f.delivery_service_name
		
		from tbl_master_item a 
		left join tbl_detail_item b on a.id_item=b.id_item 
		left join tbl_detail_item_out c on a.id_item=c.id_item 
		left join tbl_master_item_out d on c.id_item_out=d.id_item_out
		left join tbl_master_agen e on d.id_receiver=e.id_agen
		left join tbl_master_delivery_service f on d.id_sender=f.id_delivery_service  
		where c.id_item_out is null
		order by a.id_item desc
"
		)->result();
	}
	
	function getDataAgenNotOut(){
		return $this->db->query("select
		a.id_agen,a.agen_name,a.agen_operational_name, a.agen_type, a.status,
		b.id_receiver
		from  tbl_master_agen a 
		left join tbl_master_item_out b on a.id_agen=b.id_receiver
		where a.agen_type='Laku' and a.status='Approve' and b.id_receiver IS NULL
		 order by a.id_agen desc"
		)->result();
	}
	
	
}
?>
	 
	
	

