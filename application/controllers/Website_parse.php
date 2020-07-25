<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_parse extends CI_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_category_model');
		$this->load->model('company_list_model');
		$this->load->model('company_details_model');
		$this->cpage_limit = 5;		
	}
	public function parse()
	{
		 echo "================Company Category Fetching......================ <br><br><br>" ;
		$html = file_get_contents('http://www.mycorporateinfo.com');
		$dom = new DOMDocument;
		@$dom->loadHTML($html);

		$links = $dom->getElementsByTagName('a');

		$insarray=array();
		foreach ($links as $link)
		{

			$elink =  $link->getAttribute('href') ;

			if(strpos($elink,'/industry/')  !== false )
			{

				$var1=   $elink ;
				$var2 =   $link->nodeValue;
				$insarray['field1']	=	"<a href='http://www.mycorporateinfo.com".$var1."' target='_blank'>http://www.mycorporateinfo.com".$var1."</a>";
				$insarray['field2']	=	$var2;
				$insarray['cat_id']	=    basename($var1);

				$insert = $this->company_category_model->insert($insarray);
			}

		} 		

		  echo "================Company Category Inserted================ <br><br><br>" ;
 		 echo "================Company List Fetching......================ <br><br><br>" ;
		  
		$company_clist = $this->company_category_model->select_category_list();
		foreach($company_clist as $clist)
		{

			for($i=1;$i<$this->cpage_limit;$i++)
			{
				$html = file_get_contents('http://www.mycorporateinfo.com/industry/section/A');//.$clist->cat_id."/page/".$i);


				$dom = new domDocument; 
				libxml_use_internal_errors(true);

				$dom->loadHTML($html); 

				$dom->preserveWhiteSpace = false; 

				$tables = $dom->getElementsByTagName('table'); 

				$rows = $tables->item(0)->getElementsByTagName('tr'); 

				foreach ($rows as $row) 
				{
					$cinsarray=array();

					$cols = $row->getElementsByTagName('td'); 
					$colsaa = $row->getElementsByTagName('a'); 
					foreach ($colsaa as $linkss)
					{
						   
						$elink =  $linkss->getAttribute('href');
						$eurl= "http://www.mycorporateinfo.com".$elink;
					}

					if($cols->length >= 3)
					{
						$ccin     = $cols->item(0)->nodeValue; 
						$ccompany = $cols->item(1)->nodeValue; 
						$cclass   = $cols->item(2)->nodeValue; 
						$cstatus  = $cols->item(3)->nodeValue; 
						$cinsarray['field1']	=	$clist->cat_id;
						$cinsarray['field2']	=    $ccompany;
						$cinsarray['field3']	=    $cclass;
						$cinsarray['field4']	=    $cstatus;
						$cinsarray['field5']	=    $eurl;
						$cinsarray['field6']	=    $elink;


						$insert = $this->company_list_model->insert($cinsarray);

					}
				}
			}
		}		
		   
		echo "=====================Company List Inserted================<br><br>" ;
		echo "=====================Company Details Fetching...........=======<br><br>" ;
		$companyd_clist = $this->company_list_model->select_company_list();
		foreach($companyd_clist as $cdlist)
		{
			$html = file_get_contents('http://www.mycorporateinfo.com'.$cdlist->field6);

			$dom = new domDocument; 
			libxml_use_internal_errors(true);   
			$dom->loadHTML($html); 

			$dom->preserveWhiteSpace = false; 

			$tables = $dom->getElementsByTagName('table'); 

			foreach($tables as $table12)
			{
				$rows = $table12->getElementsByTagName('tr'); 
				foreach ($rows as $row) 
				{

					$cols = $row->getElementsByTagName('td'); 
					$colsaa = $row->getElementsByTagName('a'); 
					foreach ($colsaa as $linkss)
					{
					   
					  $cdelink =  $linkss->getAttribute('href');
					}
					if($cols->length )
					{
						$cdtype = $cols->item(0)->nodeValue; 
						$cddet = $cols->item(1)->nodeValue;  
						$cdinsarray['field1']	=    $cdtype;
						$cdinsarray['field2']	=    $cddet;
						$cdinsarray['field3']	=    $cdelink;
						$cdinsarray['field4']	=    $cdlist->field6;
						$insert = $this->company_details_model->insert($cdinsarray);
					}
				}
			}
		}
	}


	public function index()
	{
		$this->load->view('index');
	}
	public function company_category()
	{
		$this->load->view('company_category');
	}
	public function company_list()
	{
		$company_cat = $this->uri->segment(3);
		$this->load->view('company_list');
	}

	public function company_details()
	{
		$this->load->view('company_details');
	}


	public function ajax_company_category()
	{
		$list = $this->company_category_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->cat_id;
			$row[] = "<a target= '_blank' href='".base_url()."/website_parse/company_list/$customers->cat_id' >$customers->field2</a>";
			$row[] = $customers->field1;
			$row[] = $customers->field3;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->company_category_model->count_all(),
						"recordsFiltered" => $this->company_category_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_company_list()
	{
		$company_cat = $this->uri->segment(3);
		$list = $this->company_list_model->get_datatables($company_cat);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $this->company_category_model->select_category_name($customers->field1);
			$row[] = "<a href='".base_url()."/website_parse/company_details$customers->field6' >$customers->field2</a>";
			$row[] = $customers->field3;
			$row[] = $customers->field4;
			$row[] = "<a href='$customers->field5' >$customers->field5</a>";

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->company_list_model->count_all($company_cat),
						"recordsFiltered" => $this->company_list_model->count_filtered($company_cat),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_company_details()
	{
		$company_cat = $this->uri->segment(3);
		$company_cat1 = $this->uri->segment(4);
		$company_cata       = "/".$company_cat."/".$company_cat1;
		$list = $this->company_details_model->get_datatables($company_cata);;
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->field1;
			$row[] = $customers->field2;
			$row[] = "<a href='http://www.mycorporateinfo.com$customers->field3'>http://www.mycorporateinfo.com$customers->field3</a>";
				

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->company_details_model->count_all($company_cata),
						"recordsFiltered" => $this->company_details_model->count_filtered($company_cata),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}
