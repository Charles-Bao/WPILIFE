<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faqlib
{

	public $CI = NULL;
	public function __construct()
	{	
		$this->CI =& get_instance();
		$this->CI->load->helper('security');
	}

	public function get_faq()
	{
		$query = $this->CI->db->get('faq');
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

	public function get_faq_type()
	{
		$query = $this->CI->db->get('faq_type');
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

	public function faq_type_update($id, $dataArray)
	{
		$this->CI->db->where('id', $id);
		$this->CI->db->update('faq_type', $dataArray);
	}
	
	public function faq_type_add($dataArray)
	{
		$this->CI->db->insert('faq_type', $dataArray);
	}

	public function get_faq_by_ID($id)
	{
		$this->CI->db->where('faq_id', $id);
		$query = $this->CI->db->get('faq');
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array(); 
			return $result; 
		}		
		else
		{
			return false;
		}					   
		
	}
	
	public function faq_update($id, $dataArray)
	{
		$this->CI->db->where('faq_id', $id);
		$this->CI->db->update('faq', $dataArray);
	}

	public function faq_add($dataArray)
	{
		$this->CI->db->insert('faq',$dataArray);
	}

	public function get_faq_by_type($type)
	{
		$type =  $this->CI->security->xss_clean($type);
		$this->CI->db->where('faq_type', $type);
		$query = $this->CI->db->get('faq');
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
}
?>
