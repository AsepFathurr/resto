<?php 
 
class Query extends CI_Model{	

	function getAllData($table)
    {
		return $this -> db -> get($table);
	}

    function getAllDataOrder($table,$params,$order_type)
    {
        $this -> db -> select('*')
                    -> from($table)
                    -> order_by($params,$order_type);
        return $this -> db -> get();
    }
	
	function inputDataDetail($data,$table){
		$input = $this -> db -> insert($table,$data);
        $error = $this->db->error(); // Has keys 'code' and 'message'
        $return_arr = array('is_query'=>$input,'error'=>$error);
    return $return_arr;
	}

  function inputData($data,$table){
    return $this -> db -> insert($table,$data);
  }

     function inputDataGetLastID($data,$table){
        $insert = $this -> db -> insert($table,$data);
        $get_id = $this-> db ->query('SELECT LAST_INSERT_ID() AS "last_id" ')->row();
        $id = $get_id -> last_id;
        $error = $this->db->error();
        $ret_array = array('id'=>$id,'is_insert'=>$insert,'error'=>$error);
        return $ret_array;
    }

	function delData($where,$table){
		$this -> db -> where($where);
		$delete = $this -> db -> delete($table);
        return $delete;
	}

	function getData($where,$table){
		return $this -> db -> get_where($table,$where);
	}

    function getDataSpecified($field,$table)
    {
        $this -> db -> select($field)
                    -> from($table);
        return $this -> db -> get();
    }

    function getDataSpecifiedWhere($field,$where,$table)
    {
        $this -> db -> select($field)
                    -> from($table)
                    -> where($where);
        return $this -> db -> get();
    }

	function updateData($where,$data,$table){
		$update = $this->db->where($where)
		                   ->update($table,$data);
        return $update;
	}	

  function updateDataDetail($where,$data,$table){
    $update = $this->db->where($where)
                       ->update($table,$data);
    $error = $this->db->error(); // Has keys 'code' and 'message'
    $return_arr = array('is_query'=>$update,'error'=>$error);
    return $return_arr;
  } 

    function aktifasiBiaya($where,$data,$table){
        $update = $this->db->where('id_biaya_spp !=',$where)
                           ->update($table,$data);
        return $update;
    }   

	function getDataJoin($table1,$table2,$field){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        // $this->db->where($where);
        return $this->db->get();
    }

    function getDataJoinOrder($table1,$table2,$field,$order){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order);
        // $this->db->where($where);
        return $this->db->get();
    }

    function getDataJoinOrderWhere($table1,$table2,$field,$order,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order);
        return $this->db->get();
    }

    function getDataTransWait()
    {
        $this->db->select('*')
                 ->from('transaksi')
                 ->join('meja','meja.id_meja = transaksi.id_meja','left')
                 ->where(array('status_trans'=>'wait'))
                 ->order_by("tgl_transaksi DESC");
        return $this -> db -> get();
    }

    function getDataJoinWhere($table1,$table2,$field,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        return $this->db->get();
    }

    function getDataJoinLike($table1,$table2,$field,$like){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->like($like);
        return $this->db->get();
    }


     function getDataJoinWhereDiff($table1,$table2,$field,$field2,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field2);
        $this->db->where($where);
        return $this->db->get();
    }

     function getDataJoinWhereNot($table1,$table2,$field,$where,$wherenot){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->where_not_in($wherenot);
        return $this->db->get();
    }

   function getDataBahanFromMenu($where)
   {
        $this->db->select('*')
                 ->from('menu_has_bahan')
                 ->join('bahan','menu_has_bahan.id_bahan = bahan.id_bahan','left')
                 ->join('satuan','bahan.id_satuan = satuan.id_satuan','left')
                 ->where($where);
        return $this -> db -> get();
   }  


   function getDataMenuFromTrans()
   {
        $this->db-> select('*')
                 -> from('transaksi_detail')
                 -> join('menu','transaksi_detail.id_menu = menu.id_menu','left')
                 -> join('transaksi','transaksi_detail.id_transaksi = transaksi.id_transaksi','left')
                 -> order_by('transaksi.tgl_transaksi','desc');
        return $this -> db -> get(); 
   }

  function getDataMenuFromTransWhere($where)
   {
        $this->db-> select('*')
                 -> from('transaksi_detail')
                 -> join('menu','transaksi_detail.id_menu = menu.id_menu','left')
                 -> join('transaksi','transaksi_detail.id_transaksi = transaksi.id_transaksi','left')
                 -> order_by('transaksi.tgl_transaksi','desc')
                 -> where($where);  
        return $this -> db -> get(); 
   }

   function GetDataTransaksiDetail($where)
   {
        $this->db-> select('*')
                 -> from('transaksi_detail')
                 -> join('menu','transaksi_detail.id_menu = menu.id_menu','left')
                 -> join('transaksi','transaksi_detail.id_transaksi = transaksi.id_transaksi','left')
                 -> order_by('transaksi.tgl_transaksi','desc')
                 -> where($where);  
        return $this -> db -> get(); 
   }

   function getDataTransaksiFilter($tgl_mulai,$tgl_selesai)
   {
        $this->db -> select('*')
                  -> from('transaksi')
                  -> join('meja','transaksi.id_meja = meja.id_meja','left')
                  -> order_by('transaksi.tgl_transaksi','desc')
                  -> where('tgl_transaksi BETWEEN "'.$tgl_mulai. '" AND "'.$tgl_selesai.'"');
        return $this -> db -> get(); 
   }

}