<?php
include("lib/function.php");
date_default_timezone_set('Asia/Calcutta');
$filename = "Purchase Remainig Amount List".date('d.m.Y H:i:s a').".xls";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Calcutta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("VISION MARKETING SALES & SERVICES")
							 ->setLastModifiedBy("VISION MARKETING SALES & SERVICES")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("VISION MARKETING SALES & SERVICES document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("FORM file");



// Add some data

			
			$sql=0;
			 
			
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Date')
			->setCellValue('C1', 'Bill No')
			->setCellValue('D1', 'Party Name')
			->setCellValue('E1', 'Mobile No')
			->setCellValue('F1', 'Paid Amount')
			->setCellValue('G1', 'Remaining Amount')
			->setCellValue('H1', 'Total');
			
			
			        
							
							$qry1="SELECT a.id AS soID,a.purchase_id,a.grand_tot,SUM(a.paid_amt) AS paid,b.id,b.bill_no,b.date,b.payamt,b.balamt,c.company_nm,c.mobile,c.email
									FROM purchase_outstanding AS a
									LEFT JOIN purchase_entry AS b ON a.purchase_id=b.id 
									LEFT JOIN purchase_party_details AS c ON b.party_id=c.id
									GROUP BY a.purchase_id,a.grand_tot";
							$stmt=$conn->prepare($qry1);
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							$stmt->execute();
							$count=1;
							$i=2;
							
							set_time_limit(0);	
							while($row = $stmt->fetch())
							{
								$id=$row['purchase_id'];
								$grand=$row['grand_tot'];
								$paid=$row['paid'];
								$remaining=$grand-$paid;
								if($remaining != '0')
								{
								$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$i, $count)
								->setCellValue('B'.$i, date('d-m-Y',strtotime($row['date'])))
								->setCellValue('C'.$i, $row['bill_no'])
								->setCellValue('D'.$i, $row['company_nm'])
								->setCellValue('E'.$i, $row['mobile'])
								->setCellValue('F'.$i, $paid)
								->setCellValue('G'.$i, $remaining)
								->setCellValue('H'.$i, $grand);	
								$count++;
								$i++;	
								}
							}
							$mysql=null;
									   
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Vision');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>