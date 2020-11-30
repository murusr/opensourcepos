<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Stock_reports extends CI_Controller 
{
	function __construct()
	{
		parent::__construct('sales');
	}

	public function index()
	{		
		$cat = "All";
		$si = 'All';
		$dateenable = true;
		$df = date("Y-m-d");
		$dt = date("Y-m-d");
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
        {
			$cat = $_REQUEST['cat'];      
			$si = $_REQUEST['si']; 
			$dateenable =  ($_REQUEST['de'] == 'dateincluded'); 
			$df = $_REQUEST['datepickerfrom']; 
			$dt = $_REQUEST['datepickerto']; 
		}
		$resq = $this->Sale->get_control_items($cat);
		//echo 'cat:'.$cat;
		//echo 'de'.$_REQUEST['de'].$df;//$dateenable ? 'true' : 'false';
		$res = $this->Sale->get_kpdn($cat,$si,$df,$dt);
		$result = ['transactions' => $res,'ci'=>$resq,'cat' => $cat,'si'=> $si,'dateenable' => $dateenable, 'df' => $df, 'dt'=> $dt, ];
		$this->load->view('stock_reports/kpdn', $result) ;
	}

	
}
?>
