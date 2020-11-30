<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_kpdn extends CI_Model
{
    function __construct()
	{
		parent::__construct();
	}

    public function get_kpdn()
	{
		$query =  $this->db->query("call kpdn_stock");

        return $query->getResultArray();
    }

    public function get_sale_items($sale_id)
	{
		$this->db->from('sales_items');
		$this->db->where('sale_id', $sale_id);

		return $this->db->get();
	}
}