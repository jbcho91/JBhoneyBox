<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clk_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	private function dbconn(){
		$this->load->database();
	}

	public function clk_in($clk_info){
		$this->dbconn();
		$this->db->query("set time_zone='US/Pacific'");
		$this->db->query("INSERT INTO CLKS(MEMBER_ID, USER_NAME, CLK_DATE, CLK_IN) VALUES($clk_info[MEMBER_ID], '$clk_info[USER_NAME]', DATE(NOW()), TIME(NOW()))");
	}

	public function clk_out($clk_info){
		$this->dbconn();
		$this->db->query("set time_zone='US/Pacific'");
		$this->db->query("UPDATE CLKS SET CLK_OUT=TIME(NOW()) WHERE MEMBER_ID=$clk_info[MEMBER_ID] AND USER_NAME='$clk_info[USER_NAME]' AND CLK_DATE=DATE(NOW()) AND CLK_OUT IS NULL");
	}

	public function clk_total(){
		$this->dbconn();
		$this->db->query("set time_zone='US/Pacific'");
		$this->db->query("INSERT INTO TOTAL_CLK(MEMBER_ID, CLK_DATE,)");	
	}

	public function clk_overtime(){
		$avg_time = 8.00;

	}

	public function clk_tolist($findclk){
		date_default_timezone_set("America/Los_Angeles");
		$todate = date("Y-m-d",time());
		$this->dbconn();
		$resClk = $this->db->query("SELECT * FROM CLKS WHERE USER_NAME = '$findclk' and CLK_DATE = '$todate'")->result();

		return $resClk;
	}

	public function clk_weeklist($findwkclk){
		$clk_memberid=$this->session->userdata('MEMBER_ID');	
		$reswkClk = $this->db->query("SELECT DATE_FORMAT(CLK_DATE, '%w') as WEEKNUM, CLK_DATE, DATE_FORMAT(CLK_IN, '%H:%i') as CLKIN, DATE_FORMAT(CLK_OUT, '%H:%i') as CLKOUT FROM CLKS WHERE MEMBER_ID=$clk_memberid AND weekofyear(CLK_DATE) = weekofyear('$findwkclk')")->result();

		return $reswkClk;
	}


	public function clk_mglist(){
		date_default_timezone_set("America/Los_Angeles");
		$todate = date("Y-m-d",time());
		$this->dbconn();
		$mgr_tolist = $this->db->query("SELECT USER_NAME, DATE_FORMAT(CLK_IN, '%H,%i') as CLKINGP, DATE_FORMAT(CLK_OUT, '%H,%i') as CLKOUTGP FROM CLKS WHERE CLK_DATE = '$todate'")->result();

		return $mgr_tolist;
	}

	public function total_list($findtotal){
		$restotal = $this->db->query("SELECT CLK_ID, USER_NAME, CLK_IN, CLK_OUT, DATE_FORMAT(CLK_IN, '%H,%i') as CLKINGP, DATE_FORMAT(CLK_OUT, '%H,%i') as CLKOUTGP, APPROVED FROM CLKS WHERE CLK_DATE = '$findtotal' ORDER BY USER_NAME")->result();
		return $restotal;

	}

	public function clk_create($clk_info){
		$this->dbconn();
		$resclk=$this->db->query("INSERT INTO CLKS(MEMBER_ID,USER_NAME,CLK_DATE,CLK_IN,CLK_OUT) VALUES((SELECT MEMBER_ID FROM MEMBERS WHERE USER_NAME='$clk_info[USER_NAME]'),'$clk_info[USER_NAME]','$clk_info[datepicker]','$clk_info[CLK_IN]','$clk_info[CLK_OUT]')");
	}

	public function update_show($clk_info){
		$this->dbconn();
		$resclk=$this->db->query("SELECT * FROM CLKS WHERE CLK_ID=$clk_info")->result();
		return $resclk;
	}

	public function clk_update($clk_info){

		$this->dbconn();
		if($clk_info[Approved]!=null){
			$this->db->query("UPDATE CLKS SET CLK_IN='$clk_info[CLK_IN]', CLK_OUT='$clk_info[CLK_OUT]', APPROVED=$clk_info[Approved] WHERE CLK_ID=$clk_info[CLK_ID]");
		}else{
			$this->db->query("UPDATE CLKS SET CLK_IN='$clk_info[CLK_IN]', CLK_OUT='$clk_info[CLK_OUT]' WHERE CLK_ID=$clk_info[CLK_ID]");
		}

		$to_time=strtotime($clk_info[CLK_OUT]);
		$from_time=strtotime($clk_info[CLK_IN]);
		$clkhour=round(abs($to_time - $from_time)/3600,2);
		$paying=$clk_info[PAYING];
		if($clkhour>8){
			$clkovertime=$clkhour-8;
			$overpay=$clkovertime*$paying*1.5;
			$normalpay=$paying*8;
			$pay=$overpay+$normalpay;
		}else{
			$clkovertime=0;
			$pay=$clkhour*$paying;
		}
		$existDate = $this->db->query("SELECT * FROM TOTAL_CLK WHERE CLK_DATE='$clk_info[CLK_DATE]' and MEMBER_ID=(SELECT MEMBER_ID FROM CLKS WHERE CLK_ID=$clk_info[CLK_ID])")->result();

		if($clk_info[Approved]==1 && $existDate == NULL){
			$this->db->query("INSERT INTO TOTAL_CLK(MEMBER_ID, USER_NAME, CLK_DATE, CLK_TOTAL, CLK_OVERTIME, PAY) VALUES((SELECT MEMBER_ID FROM CLKS WHERE CLK_ID=$clk_info[CLK_ID]), (SELECT USER_NAME FROM CLKS WHERE CLK_ID=$clk_info[CLK_ID]),'$clk_info[CLK_DATE]', $clkhour, $clkovertime, $pay)");
		}

		if($clk_info[Approved]==1 && $existDate != NULL){
			$tempRes=$this->db->query("SELECT * FROM TOTAL_CLK WHERE CLK_DATE='$clk_info[CLK_DATE]' and MEMBER_ID=(SELECT MEMBER_ID FROM CLKS WHERE CLK_ID=$clk_info[CLK_ID])")->result();
			foreach($tempRes as $temp){
			$clkhour=$temp->CLK_TOTAL+$clkhour;
			}
			if($clkhour>8){
				$clkovertime=$clkhour-8;
				$overpay=$clkovertime*$paying*1.5;
				$normalpay=$paying*8;
				$pay=$overpay+$normalpay;
			}else{
				$clkovertime=0;
				$pay=$clkhour*$paying;
			}

			$this->db->query("UPDATE TOTAL_CLK SET CLK_TOTAL=$clkhour, CLK_OVERTIME=$clkovertime, PAY=$pay WHERE CLK_DATE='$clk_info[CLK_DATE]' and MEMBER_ID=(SELECT MEMBER_ID FROM CLKS WHERE CLK_ID=$clk_info[CLK_ID])"); 

		}
	}


	public function clk_delete($clk_info){

		$this->dbconn();
		$this->db->query("DELETE FROM CLKS WHERE CLK_ID=$clk_info" );
	}

	public function clk_yearlist(){
		$this->dbconn();
		$this->db->query("set time_zone='US/Pacific'");
		$tempRes=$this->db->query("SELECT DISTINCT DATE_FORMAT(CLK_DATE, '%Y, %m, %d') as YEAR_DATE FROM CLKS WHERE YEAR(CLK_DATE)=YEAR(NOW())")->result();
		return $tempRes;
	}

	public function clk_paylist(){

		$this->dbconn();
		$this->db->query("set time_zone='US/Pacific'");
		$tempRes=$this->db->query("SELECT USER_NAME, CLK_DATE, CLK_TOTAL, CLK_OVERTIME, PAY, DATE_FORMAT(CLK_DATE, '%Y/%m') as CLK_MON FROM TOTAL_CLK WHERE CLK_DATE>(NOW()-INTERVAL 6 MONTH) ORDER BY CLK_DATE DESC")->result();
		return $tempRes;
	}

	public function clk_limitlist($tb='', $type='', $offset='', $limit=''){
		$limit_query='';
		if($limit!='' || $offset!=''){
			$limit_query='LIMIT '.$offset.','.$limit;
		}

		$this->dbconn();
		$this->db->query("set time_zone='US/Pacific'");
	        $tempRes=$this->db->query("SELECT USER_NAME, CLK_DATE, CLK_TOTAL, CLK_OVERTIME, PAY, DATE_FORMAT(CLK_DATE, '%Y/%m') as CLK_MON FROM TOTAL_CLK WHERE CLK_DATE>LAST_DAY(NOW()-INTERVAL 6 MONTH) ORDER BY CLK_DATE DESC ".$limit_query);
		
		if($type=='count'){
			$result=$tempRes->num_rows();
		}else{
			$result=$tempRes->result();
		}

		return $result;
	
	}


	public function clk_picpaylist($clk_info){

		$this->dbconn();
		$tempRes=$this->db->query("SELECT * FROM TOTAL_CLK ORDER BY CLKDATE DESC WHERE USER_NAME='$clk_info'")->result();
		return $tempRes;	
	}
}
