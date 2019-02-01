<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clock extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Clk_model');
	}

	public function index()
	{
		date_default_timezone_set("America/Los_Angeles");
	        $todate = date("Y-m-d",time());	
                $thisWeekClk['weekclks'] = $this->Clk_model->clk_weeklist($todate);
		$this->load->view('/template/header');
		$this->load->view('/clock/clock_info',$thisWeekClk);
		$this->load->view('/template/footer');
	}

	public function clk_check()
	{
		$this->load->view('/template/header');
		$clk_todaylist = $this->mem_toclklist();
		$this->load->view('/clock/clock_check', $clk_todaylist);
		$this->load->view('/template/footer');
	}

	public function clkin_add()
	{
		$clk_username = $this->session->userdata('USER_NAME');
		$clk_memberid = $this->session->userdata('MEMBER_ID');
		$this->load->model('Clk_model');
		$this->Clk_model->clk_in(array('MEMBER_ID'=>$clk_memberid, 'USER_NAME'=>$clk_username));

		$this->load->helper('url');
		redirect('/clock/clk_check');
	}

        public function clkout_add()
        {
                $clk_username = $this->session->userdata('USER_NAME');
                $clk_memberid = $this->session->userdata('MEMBER_ID');
                $this->load->model('Clk_model');
                $this->Clk_model->clk_out(array('MEMBER_ID'=>$clk_memberid, 'USER_NAME'=>$clk_username));
                $this->load->helper('url');
                redirect('/clock/clk_check');
        }

	public function clk_mgr()
	{

		$this->load->view('/template/header');
		$clk_mgrtolist = $this->mgr_list(); 
		$this->load->view('/clock/clock_mgr', $clk_mgrtolist);
		$this->load->view('/template/footer');
	}

	public function clk_weekmgr()
	{
		date_default_timezone_set("America/Los_Angeles");
	        $todate = date("Y-m-d",time());	
                $allmgrclks = $this->Clk_model->total_list($todate);
		$clkdates = $this->Clk_model->clk_yearlist();
		$this->load->model('Member_model');
		$allmembers = $this->Member_model->ListMembers();
		$this->load->view('/template/header');
		$this->load->view('/clock/clock_weekmgr', array('allmgrclks' => $allmgrclks, 'clkdates'=>$clkdates, 'allmembers' => $allmembers));
		$this->load->view('/template/footer');
	}

	public function sw_weekmgr()
	{
		$clkmgrWeek = $_POST['pickeddate'];
		$allmgrclks = $this->Clk_model->total_list($clkmgrWeek);
		$clkdates = $this->Clk_model->clk_yearlist();
		$this->load->model('Member_model');
		$allmembers = $this->Member_model->ListMembers();
                $this->load->view('/template/header');
                $this->load->view('/clock/clock_weekmgr', array('allmgrclks' => $allmgrclks, 'clkdates'=>$clkdates, 'allmembers' => $allmembers));
                $this->load->view('/template/footer');

	}

	public function clk_pay()
	{
		$this->load->library('pagination');

		$config['base_url']='/clock/clk_pay/';
		$config['total_rows']=$this->Clk_model->clk_limitlist($this->uri->segment(3), 'count');
		$config['per_page']=8;
		$config['uri_segment']=3;

		$this->pagination->initialize($config);
		$pagination=$this->pagination->create_links();

		$page=$this->uri->segment(3,1);
		
		if($page>1){
			$start=(($page/$config['per_page']))*$config['per_page'];
		}else{
			$start=($page-1)*$config['per_page'];
		}
		$limit=$config['per_page'];


		$paylists=$this->Clk_model->clk_limitlist($this->uri->segment(3),'',$start,$limit);
		$allpays=$this->Clk_model->clk_paylist();
		$this->load->model('Member_model');
		$memlists = $this->Member_model->ListMembers();
		$this->load->view('/template/header');
		$this->load->view('/clock/clock_pay', array('pagination'=>$pagination,'paylists'=>$paylists, 'allpays'=>$allpays, 'memlists'=>$memlists));
		$this->load->view('/template/footer');

	}

	public function sw_clk_pay()
	{
		$this->load->view('/template/header');
		$this->load->view('/clock/clock_pay');
		$this->load->view('/template/footer');

	}

	public function clk_utd()
	{
		$up_show['pick_clk']=$this->Clk_model->update_show($_GET['id_clk']);
		$this->load->view('/clock/clock_update',$up_show);
	}

	public function clk_create()
	{
		$this->load->model('Member_model');
		$data['creates'] = $this->Member_model->ListMembers();
		$this->load->view('/clock/clock_create', $data);
	}

	public function make_clk()
	{
		$clock_out=$this->input->post('clk_out');
		if($clock_out==null){
			$clock_out='23:59';
		}	
		$this->load->model('Clk_model');
		$this->Clk_model->clk_create(array('USER_NAME'=>$this->input->post('USER_NAME'), 'datepicker'=>$this->input->post('datepicker'), 'CLK_IN'=>$this->input->post('CLK_IN'), 'CLK_OUT'=>$clock_out));
?>              <script>
                window.close();
                opener.parent.location.reload();
                </script>
<?php

	}

	public function clk_change()
	{
		$this->Clk_model->clk_update(array('CLK_DATE'=>$this->input->post('CLK_DATE'), 'CLK_ID'=>$this->input->post('CLK_ID'), 'CLK_IN'=>$this->input->post('CLK_IN'), 'CLK_OUT'=>$this->input->post('CLK_OUT'), 'PAYING'=>$this->input->post('PAYING'), 'Approved'=>$this->input->post('Approved')));

?>		<script>
		window.close();
		opener.parent.location.reload();
		</script>
<?php	
	}

	public function delete_()
	{
		$clkdel = $_GET['id_clk'];
		$this->Clk_model->clk_delete($clkdel);
?>		<script>
		window.close();
		opener.parent.location.reload();
		</script>
<?php
	}

	public function sw_date()
	{

		$clkWeek = $_POST['pickeddate'];	
		$thisWeekClk['weekclks'] = $this->Clk_model->clk_weeklist($clkWeek);
		$this->load->view('/template/header');
		$this->load->view('/clock/clock_info', $thisWeekClk);
		$this->load->view('/template/footer');
	}

	private function mem_toclklist()
	{
		$memClkId = $this->session->userdata('USER_NAME');
		$memToDataList['memclks'] = $this->Clk_model->clk_tolist($memClkId);
		return $memToDataList;
	}

	private function mgr_list()
	{
		$allclks = $this->Clk_model->clk_mglist();
		$this->load->model('Member_model');
		$allmembers = $this->Member_model->ListMembers();
		return array(
			'allclks' => $allclks,
			'allmembers' => $allmembers
		);
	}


}
