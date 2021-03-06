<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bbslib {

	public $CI = NULL;
	public function __construct() {	
		$this->CI =& get_instance();
	}

	public function getList($from=0, $size=20) {
		$this->CI->db->where('isDelete', 0);
		$this->CI->db->select('bbs.*, users.users_firstname, users.users_lastname');
		$this->CI->db->from('bbs');
		$this->CI->db->join('users', 'bbs.user_id = users.users_id');
		$this->CI->db->order_by("bbs_id", "desc"); 
		$this->CI->db->limit($size, $from);
		
		$query = $this->CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array(); 
		} else {
			return false;
		}					   
	}

	public function getListByKeyword($keyword){
		$this->CI->db->where('isDelete', 0);
		$this->CI->db->like('bbs_title', $keyword); 
		$this->CI->db->select('bbs.*, users.users_firstname, users.users_lastname');
		$this->CI->db->from('bbs');
		$this->CI->db->join('users', 'bbs.user_id = users.users_id');
		$this->CI->db->order_by("bbs_id", "desc"); 
		
		$query = $this->CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array(); 
		} else {
			return false;
		}
	}

	public function getCount() {
		$this->CI->db->where('isDelete',0);
		$this->CI->db->select('count(*) as count');
		$query = $this->CI->db->get('bbs');
		$result = $query->row_array();
		return $result['count'];
	}

	public function getBBSByID($id) {
		$this->CI->db->where('bbs_id', $id);
		$this->CI->db->where('isDelete',0);
		$this->CI->db->select('bbs.*,users.users_firstname, users.users_lastname');
		$this->CI->db->from('bbs');
		$this->CI->db->join('users', 'bbs.user_id = users.users_id');
		$query = $this->CI->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array(); 
		} else {
			return false;
		}					   
		
	}

	public function update($id, $user_id, $dataArray) {
		$this->CI->db->where('bbs_id', $id);
		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->update('bbs', $dataArray);
	}

	public function add($dataArray) {
		$this->CI->db->insert('bbs',$dataArray);
	}

	public function getBBSListByUserID($user_id)
	{
		$this->CI->db->where('user_id', $user_id);
		$query = $this->CI->db->get('bbs');
		if ($query->num_rows() > 0) {
			$result = $query->result(); 
			return $result; 
		} else {
			return false;
		}	
	}
	public function getBBSByTwoID($bbs_id, $user_id)
	{
		$this->CI->db->where('bbs_id', $bbs_id);
		$this->CI->db->where('user_id', $user_id);
		$query = $this->CI->db->get('bbs');
		if ($query->num_rows() > 0) {
			$result = $query->row_array(); 
			return $result; 
		} else {
			return false;
		}	
	}

	public function get_blog_list_with_content($type = "SELL", $from=0, $size=20) {
		$query = $this->CI->db->query("SELECT blogs.*, users_firstname, users_lastname
									   FROM blogs left join users on (blogs.blogs_author = users.users_id) 
									   WHERE blogs.blogs_type = '".$type."' and blogs.blogs_available = 1 
									   limit ".$from.",".$size);
		if ($query->num_rows() > 0) {
			$result = $query->result(); 
			return $result; 
		} else {
			return false;
		}					   
		
	}
	public function get_blog_by_userID($id, $type='SELL')
	{
		$this->CI->db->where('blogs_author', $id);
		$this->CI->db->where('blogs_type', $type);
		$query = $this->CI->db->get('blogs');
		if ($query->num_rows() > 0)
		{
			$result = $query->result(); 
			return $result; 
		}		
		else
		{
			return false;
		}					   
		
	}


	


	public function get_image($dataArray)
	{
		$this->CI->db->where($dataArray);
		$this->CI->db->select('blogs_image_cover');
		$query = $this->CI->db->get('blogs');
		$result = $query->row_array();
		return $result['blogs_image_cover'];
	}

	public function blog_available($whereArray, $dataArray)
	{
		$this->CI->db->where($whereArray);
		$this->CI->db->update('blogs', $dataArray);
	}

}
?>
