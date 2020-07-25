<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		//Load the HTML page
		 $html = file_get_contents('http://www.mycorporateinfo.com');
		//Create a new DOM document
		$dom = new DOMDocument;
		 
		//Parse the HTML. The @ is used to suppress any parsing errors
		//that will be thrown if the $html string isn't valid XHTML.
		@$dom->loadHTML($html);
		 
		//Get all links. You could also use any other tag name here,
		//like 'img' or 'table', to extract other tags.
		echo "<pre>";
		//print_r($dom);
		$links = $dom->getElementsByTagName('a');
		 
		//Iterate over the extracted links and display their URLs
		foreach ($links as $link){
			//Extract and show the "href" attribute. 
			  $elink =  $link->getAttribute('href') ;
			
			if(strpos($elink,'/industry/')  !== false )
			{
				echo     "<br>".$elink ;
				echo      $link->nodeValue;
			}
		} 

		  echo "======================================================================= <br><br><br>" ;
		  
		//Load the HTML page
		// $html = file_get_contents('http://www.mycorporateinfo.com/industry/section/A');
		 $html = file_get_contents('http://www.mycorporateinfo.com/industry/section/A');
		//Create a new DOM document
		 $dom = new domDocument; 
		   libxml_use_internal_errors(true);

		   /*** load the html into the object ***/
		//libxml_use_internal_errors(true);   
		   $dom->loadHTML($html); 
		   
		   /*** discard white space ***/ 
		   $dom->preserveWhiteSpace = false; 
		   
		   /*** the table by its tag name ***/ 
		   $tables = $dom->getElementsByTagName('table'); 
		   
		   /*** get all rows from the table ***/ 
		   $rows = $tables->item(0)->getElementsByTagName('tr'); 
		   
		   /*** loop over the table rows ***/ 
		   foreach ($rows as $row) {

			  /*** get each column by tag name ***/ 
			  $cols = $row->getElementsByTagName('td'); 
			   $colsaa = $row->getElementsByTagName('a'); 
			   foreach ($colsaa as $linkss)
			   {
					   
					  echo "URL :"  .$elink =  $linkss->getAttribute('href') .'<br />';
			   }

			// $colsaa->getAttribute('href') ;
			


			  /*** echo the values ***/ 
			  if($cols->length >= 3)
			  {
			  echo 'CIN: '.$cols->item(0)->nodeValue.'<br />'; 
			  echo 'Company: '.$cols->item(1)->nodeValue.'<br />'; 
			  echo 'Class: '.$cols->item(2)->nodeValue.'<br />'; 
			  echo 'Status: '.$cols->item(3)->nodeValue; 
			  echo '<hr />'; 
			  }
		   }
		   
		  echo "=======================================================================<br><br>" ;
		   
		   
		   //Load the HTML page
		// $html = file_get_contents('http://www.mycorporateinfo.com/industry/section/A');
		 $html = file_get_contents('http://www.mycorporateinfo.com/business/kamdhenu-engineering-industries-ltd');
		//Create a new DOM document
		 $dom = new domDocument; 
		   libxml_use_internal_errors(true);

		   /*** load the html into the object ***/
		//libxml_use_internal_errors(true);   
		   $dom->loadHTML($html); 
		   
		   /*** discard white space ***/ 
		   $dom->preserveWhiteSpace = false; 
		   
		   /*** the table by its tag name ***/ 
		   $tables = $dom->getElementsByTagName('table'); 
		   
		   foreach($tables as $table12)
		   {
		   /*** get all rows from the table ***/ 
		   $rows = $table12->getElementsByTagName('tr'); 
		   
		   /*** loop over the table rows ***/ 
		   foreach ($rows as $row) {

			  /*** get each column by tag name ***/ 
			  $cols = $row->getElementsByTagName('td'); 
			   $colsaa = $row->getElementsByTagName('a'); 
			   foreach ($colsaa as $linkss)
			   {
					   
					  echo "URL :"  .$elink =  $linkss->getAttribute('href') .'<br />';
			   }

			// $colsaa->getAttribute('href') ;
			


			  /*** echo the values ***/ 
			  if($cols->length )
			  {
			  echo 'CIN: '.$cols->item(0)->nodeValue.'<br />'; 
			  echo 'Company: '.$cols->item(1)->nodeValue.'<br />'; 
			 // echo 'Class: '.$cols->item(2)->nodeValue.'<br />'; 
			//  echo 'Status: '.$cols->item(3)->nodeValue; 
			  echo '<hr />'; 
			  }
		   }
		   }
	}
}
