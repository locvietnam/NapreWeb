<?php

/**
 * Controllers Backend login
 * Last update 23 June 2017
 * 
 * @package backend
 * @copyright AirTrippy
 * @author 
 * @author position: PHP Developer
 * @since 23 June 2017
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Knp\Snappy\Pdf;
class Reportchecklist extends MY_Controller {

    private $_data;

    public function __construct() {
        parent::__construct();

        $this->_data['admin_cpanel_title'] = $this->lable['admin_cpanel_title'];
        $this->_data['base_url'] = $this->config->item("base_url");
        $this->_data['base_tlp_admin'] = $this->config->item("base_tlp_admin");
        $this->_data['base_url_admin'] = $this->config->item("base_url_admin");
        $this->_data['current_control'] = $this->router->class;
        $this->_action = $this->router->method;
        $this->_data['current_method'] = $this->_action;
        $this->_data['lable'] = $this->lable;
        $this->_data['user_data'] = $this->session->userdata('login');

        //lchung add
        $this->_data['path_upload'] = $this->config->item('path_upload');
        $this->load->model('department_model');
        $this->load->model('users_model');
        $this->load->model('usermanagerdept_model');
        $this->load->model('userassigndept_model');
        $this->load->model('checklistresults_model');
        $this->load->model('checklist_model');
        $this->load->model('hospital_model');
        $this->load->model('reportchecklist_model');
    }

    public function index() {

        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->_data['task'] = '';
        $this->_data['breadcrumb'] = '';
        $this->_data['alert'] = '';
        $this->_data['title_page'] = $this->lable['report_check_list_title'];
        $finddate = ( $this->input->get('finddate') != '' ) ? $this->input->get('finddate') : date('Y-m-d');
        $this->_data['finddate'] = $finddate;

        $userLoging = $this->_data['user_data'];
        $department_id = (int)$this->input->get('department_id');
        $yearValue = (int)$this->input->get('year');
        $monthValue = $this->input->get('month');
        $hospital_id = (int)$this->input->get('hospital_id');
        
        $listCountChecklist = $this->reportchecklist_model->getTotalChecklist( $department_id, $hospital_id );
        $listCountSubmitChecklist = $this->reportchecklist_model->getTotalSubmitChecklist($department_id, $yearValue, $monthValue);
        
        $dataTotalCheckList = array();
        foreach ( $listCountChecklist as $item ){
            $dataTotalCheckList[$item->parent_category_id] = $item->c;
        }
        $dataTotalCheckListSubmit = array();
		$days = array();
        foreach ( $listCountSubmitChecklist as $item ){
            $parent_category_id = $item->parent_category_id;
            $c1 = $dataTotalCheckList[$item->parent_category_id];
            $c2 = $item->c;
            
            $item->totalchecklist = $c1;
            $item->percent = round( $c2 * 100 / $c1 );            
            $item->users = $this->reportchecklist_model->getUserSubmit($parent_category_id, $item->date_add);
			$item->daycount = 1;
			if(!isset($days[$item->vday])){
				$days[$item->vday] = $item;
			}
			else {
				$days[$item->vday]->percent += $item->percent;
				$days[$item->vday]->daycount += 1;
			}
        }
		$sum_percent = 0;
		$total_day = 0;
		foreach ($days as $items){
			$total_day++;
			$items->percent =round( $items->percent/$items->daycount );
			$dataTotalCheckListSubmit[] = $items;
			$sum_percent += $items->percent;
			$date = date_create($items->date_add);
			//$items->fdate_add = date_format($date, 'g:ia \o\n l jS F Y');
			$items->fdate_add = date_format($date, 'l jS M');
			//date("w", strtotime($item->date_add));
		}
       // print_r($days);
		//print_r($dataTotalCheckListSubmit);
		//die;
        $cond = " Where a.avail = 1";
        $hospitalData = $this->hospital_model->getItems($cond);        
        $this->_data['hospitalData'] = $hospitalData;
        
        $departmentData = array();
        
        if( $monthValue == '' )
            $monthValue = date('m');
        
        if( $department_id != '' ) {
            $cond = " Where a.hospital_id = $hospital_id ";
            $departmentData = $this->department_model->getAll($cond);  
        }
        $this->_data['departmentData'] = $departmentData;
        
        $yearData = array();
        $strY = '';
        $y = date('Y');
        $yE = $y - 9;//10 nam
        for( $i = $y; $i >= $yE; $i--){
            $selected = '';
            if( $yearValue == $i ){
                $selected = 'selected';
            }
            $strY .= '<option ' . $selected . ' value="' . $i . '">' . $i . '</option>';
        }
        $strM = '';
        for( $i = 1; $i <= 12; $i++){
            $selected = '';
            $iStr = ($i < 10 ) ? '0' . $i : $i;            
            if( $monthValue == $iStr ){
                $selected = 'selected';
            }            
            $strM .= '<option ' . $selected . ' value="' . $iStr . '">' . $iStr . '</option>';
        }
        $this->_data['yearData'] = $strY;
        $this->_data['monthData'] = $strM;
        $this->_data['list'] = $dataTotalCheckListSubmit;
		$this->_data['sum_percent'] = round($sum_percent/$total_day);
        
        $this->_data['content'] = 'reportchecklist/index';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }
    
	public function exportpdf(){
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->_data['task'] = '';
        $this->_data['breadcrumb'] = '';
        $this->_data['alert'] = '';
        $this->_data['title_page'] = $this->lable['report_check_list_title'];
        
        $userLoging = $this->_data['user_data'];
        $department_id = (int)$this->input->post('department_id');
        $yearValue = (int)$this->input->post('year');
        $monthValue = $this->input->post('month');
        $hospital_id = (int)$this->input->post('hospital_id');
		$report_comment = $this->input->post('report_comment');
		$staff_report = $this->input->post('staff_report');
        
        $listCountChecklist = $this->reportchecklist_model->getTotalChecklist( $department_id, $hospital_id );
        $listCountSubmitChecklist = $this->reportchecklist_model->getTotalSubmitChecklist($department_id, $yearValue, $monthValue);
        
        $dataTotalCheckList = array();
        foreach ( $listCountChecklist as $item ){
            $dataTotalCheckList[$item->parent_category_id] = $item->c;
        }
        $dataTotalCheckListSubmit = array();
		$days = array();
        foreach ( $listCountSubmitChecklist as $item ){
            $parent_category_id = $item->parent_category_id;
            $c1 = $dataTotalCheckList[$item->parent_category_id];
            $c2 = $item->c;
            
            $item->totalchecklist = $c1;
            $item->percent = round( $c2 * 100 / $c1 );            
            $item->users = $this->reportchecklist_model->getUserSubmit($parent_category_id, $item->date_add);
			$item->daycount = 1;
			if(!isset($days[$item->vday])){
				$days[$item->vday] = $item;
			}
			else {
				$days[$item->vday]->percent += $item->percent;
				$days[$item->vday]->daycount += 1;
			}
        }
		$sum_percent = 0;
		$total_day = 0;
		foreach ($days as $items){
			$total_day++;
			$items->percent =round( $items->percent/$items->daycount );
			$dataTotalCheckListSubmit[] = $items;
			$sum_percent += $items->percent;
			$date = date_create($items->date_add);
			//$items->fdate_add = date_format($date, 'g:ia \o\n l jS F Y');
			$items->fdate_add = date_format($date, 'l jS M');
			//date("w", strtotime($item->date_add));
		}
       
		$this->_data['report_comment'] = $report_comment;
		$this->_data['staff_report'] = $staff_report;
		
        $this->_data['list'] = $dataTotalCheckListSubmit;
		$this->_data['sum_percent'] = round($sum_percent/$total_day);
		$datereport = date('Y jS M');
		$this->_data['datereport'] = $datereport;
		$datDep = $this->department_model->getById($department_id);
		$this->_data['department_name'] = '';
		if( $datDep )
		$this->_data['department_name'] = $datDep[0]['department_name'];
		$this->_data['user_fullname'] = $userLoging->user_fullname;
		
		//$snappy = new Pdf(FCPATH . 'snappy/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386');
		
		//$snappy = new Pdf(FCPATH . 'wkhtmltox-0.13.0-alpha-7b36694_linux-trusty-amd64.deb');
		//$snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', FCPATH . 'pdf/bill-123.pdf');
		//die;
		//print_r( $snappy );die;
		// or you can do it in two steps
		//$snappy = new Pdf();
		//$snappy->setBinary('/usr/local/bin/wkhtmltopdf');

        $str = $this->parser->parse("reportchecklist/report.tpl", $this->_data, true);
		///echo FCPATH;die;
		$sum_percent = round($sum_percent/$total_day);
		$this->writerpdf( $sum_percent, $report_comment, $staff_report, $str );
		
		echo $str;die;
	}
	
	public  function writerpdf( $sum_percent, $report_comment, $staff_report, $str ){
		define ('K_PATH_IMAGES', FCPATH );
		define ('PDF_HEADER_LOGO', 'assets/admin/darkgreen/img/logo-dark.png');
		require_once( FCPATH . 'TCPDF/tcpdf.php');
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		//$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle( $this->lable['title_page'] );
		//$pdf->SetSubject('TCPDF Tutorial');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$PDF_HEADER_TITLE = $this->lable['title_page'];
		$PDF_HEADER_STRING = '';
		//$PDF_HEADER_LOGO = 'assets/admin/darkgreen/img/logo-dark.png';
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING, array(0,0,0), array(255,255,255) );

		
		$fontname = \TCPDF_FONTS::addTTFfont(FCPATH . 'TCPDF/fonts/arialuni.ttf', 'TrueTypeUnicode', '', 32);
		$PDF_FONT_NAME_MAIN = $fontname;
		$PDF_FONT_NAME_DATA = $fontname;
		// set header and footer fonts
		$pdf->setHeaderFont(Array($PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array($PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$PDF_MARGIN_TOP = 5;
		$PDF_MARGIN_LEFT = 0;
		$PDF_MARGIN_RIGHT = 0;
		$pdf->SetMargins($PDF_MARGIN_LEFT, $PDF_MARGIN_TOP, $PDF_MARGIN_RIGHT);
		$PDF_MARGIN_HEADER = 0;
		$pdf->SetHeaderMargin($PDF_MARGIN_HEADER);
		$PDF_MARGIN_FOOTER = 0;
		$pdf->SetFooterMargin($PDF_MARGIN_FOOTER);

		// set auto page breaks
		$PDF_MARGIN_BOTTOM = 0;
		$pdf->SetAutoPageBreak(false, $PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->SetPrintHeader(false);//not use line border
		$pdf->SetPrintFooter(false);//not use line border
		//$pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont($fontname, '', 12);//arialbd
		// add a page
		$pdf->AddPage();		
	$footer_image_file = FCPATH . 'assets/admin/darkgreen/img/logo-dark.png';
	//$footer_logo_html = '<div style="width:70px !important;"><img width:"70px;" src="' . $footer_image_file . '" /></div>';
$htmlFooter = <<<EOF
<style>
	.text-c{
		text-align: center;
	}
	.text-l{
		text-align: left;
	}
	.text-r{
		text-align: right;
	}
	.text-md{
		vertical-align: middle;
	}
	.h40{
		height: 40px;
	}
	.h30{
		height: 30px;
	}
	.h25{
		height: 25px;
	}
	.h20{
		height: 20px;
	}
	.ptop10{
		padding-top: 10px;
	}
	.w5{
		min-width: 5%;
		width: 5%;
	}
	.w10{
		min-width: 10%;
		width: 10%;
	}
	.w20{
		min-width: 20%;
		width: 20%;
	}
	.w30{
		min-width: 30%;
		width: 30%;
	}	
	.w50{
		min-width: 50%;
		width: 50%;
	}
	.w60{
		min-width: 60%;
		width: 60%;
	}
	.w80{
		width: 80%;
	}
	.w90{
		width: 90%;
	}
	.w100{
		width: 100%;
	}
	.bA72529{
		background-color: #A72529;
		background: #A72529;
	}
	.wcorlor{
		color: #fff;
	}
	.hline20{
		line-height: 20px;
	}
	.hline25{
		line-height: 25px;
	}
	.hline30{
		line-height: 30px;
	}
	.hline33{
		line-height: 35px;
	}
	.hline35{
		line-height: 33px;
	}
	.hline40{
		line-height: 40px;
	}
	.hline45{
		line-height: 45px;
	}
	.bw{
		background-color: #fff;
	}
</style>
EOF;
		$htmlFooter .= '<div style="background-color: #A72529;">
		<table style="width: 100%;" class="wcorlor">
			<tr>
				<td class="w30 text-c" style="background-color:#A72529;">
					<img class="h40" src="' . $footer_image_file . '" alt="A-Line">
				</td>
				<td class="w60 text-r" style="background-color:#A72529;">
					<div class="hline25">
						4-5-1 Ginza, Chuo-ku, Tokyo 104-0061<br/>
					TEL: 03-5159-1212 FAX: 03-5159-1211
					</div>

				</td>
				<td class="w10" style="background-color:#A72529;">&nbsp;</td>
			</tr>
		</table>
		<div style="height: 2px; border-bottom: 1px solid #CC8082;" ></div>	
		<div class="text-c wcorlor h25" style="background-color:#A72529;">
					Copyright ©, 2015 A-LINE. All rights reserved.
		</div>
	</div>';
		
		$pdf->writeHTML($str, true, false, false, false, '');
		$pdf->writeHTMLCell(0, '', $PDF_MARGIN_LEFT, 265, $htmlFooter, 0, 0, false, true, 'L', false);
		//Close and output PDF document
		ob_end_clean();
		$pdf->Output('report' . date('y-m-d') . '.pdf', 'I');
		//$pdf->Output('example_030.pdf', 'D');

	}

    public function getHospitalAjx() {
        
        $hospital_name = $this->input->post('hospital_name');
        $term = $hospital_name['term'];
        $cond = " Where a.hospital_name LIKE '%$term%' AND a.avail = 1";
        $hospitalData = $this->hospital_model->getItems($cond);  
        
        echo json_encode( array('data' => $hospitalData ) );
        die;
    }
    
    public function getDepartmentAjx() {
        $departmentData = array();
        $hospital_id = $this->input->get('hospital_id');
        if( $hospital_id != '' ) {
            $cond = " Where a.hospital_id = $hospital_id ";
            $departmentData = $this->department_model->getAll($cond);  
        }
        $str = "";
        foreach( $departmentData as $item ){
           $str .= '<option value="' . $item->department_id . '">' . $item->department_name . '</option>'; 
        }        
        echo json_encode( array('data' => $str ) );
        die;
    }
    
    public function listnotice() {

        $this->_data['title_page'] = $this->lable['list_notice'];
        $checklistcategoryid = $this->input->get('checklistcategoryid');
        $finddate = ( $this->input->get('finddate') != '' ) ? $this->input->get('finddate') : date('Y-m-d');
        $this->_data['finddate'] = $finddate;

        //lay cap tra
        $cond = ' WHERE checklist_category_id IN(' . $checklistcategoryid . ') AND parent_category_id = 0 ';
        $listArr = $this->checklist_model->getallCate($cond);
        $list = array();
        foreach ($listArr as $itemP) {

            $id1 = $itemP->checklist_category_id;
            $cond = 'Where a.parent_category_id = ' . $id1 . ' AND a.avail = 1 ';
            $listArrS = $this->checklist_model->getallCate($cond);
            $itemP->subcate = array();
            $list[$id1] = (array) $itemP;
            foreach ($listArrS as $item) {
                $id2 = $item->checklist_category_id;
                $cond = ' WHERE a.checklist_category_id = ' . (int) $id2;
                ///$cond .= " AND DATE(c.date_add) = DATE('" . $finddate . "') ";
                $item->checklist = $this->checklistresults_model->getStatusSituationListNotice($cond, $finddate);
                $list[$id1]['subcate'][] = (array) $item;
            }
            //khi khg co parent_category_id thi lay theo duoi nay
            ///$cond = ' WHERE a.checklist_category_id = ' . (int)$item->checklist_category_id;
            ///$item->checklist = $this->checklistresults_model->getStatusSituationListNotice( $cond );
            ///$list[] = (array)$item;
        }
        ///print_r( $list );die;
        $this->_data['list'] = $list;
        $this->_data['content'] = 'checklistresults/list-notice';
        $this->parser->parse("layout/index.tpl", $this->_data);
    }

}
