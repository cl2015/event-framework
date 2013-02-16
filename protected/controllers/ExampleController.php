<?php

class ExampleController extends SBaseController
{
	public function actionExcel(){
		//关闭yii的自动装载
		spl_autoload_unregister(array('YiiBase','autoload'));
		
		include_once (dirname(dirname(__FILE__)) . '/extensions/excel/PHPExcel.php');
		include_once (dirname(dirname(__FILE__)) . '/extensions/excel/PHPExcel/IOFactory.php');
		
		$objPHPExcel = new PHPExcel();
		$objectSheet = $objPHPExcel -> getActiveSheet();
        $objectSheet -> setTitle("测试Excel");
       //$objectSheet ->setCellValueByColumnAndRow(1,1,“ddddddd”)这个用起来比较方便        （参数：$column,$row,$value）
        $objectSheet -> setCellValue("A1","ddddddd"); 
        $objectSheet -> setCellValue("A2",26);
        $objectSheet -> setCellValue("A3",true);
        $objectSheet -> setCellValue("A4",'=SUM(A2:A2)');
        
        $objectSheet -> setCellValue("B1","ddddddd");
        $objectSheet -> setCellValue("B2","aaaaaaa");
        $objectSheet -> setCellValue("B3","ccccccccc");
        $objectSheet -> setCellValue("B4","忠厚仁义的放空间的立法的浪费");
       
        //显示指定内容的类型
        $objectSheet -> setCellValueExplicit('A5','444444444444444445',PHPExcel_Cell_DataType::TYPE_STRING);
        //设置宽度
        $objectSheet -> getColumnDimension('A')->setWidth(20);
        $objectSheet -> getColumnDimension('B')->setWidth(40);
         //合并单元格
        $objectSheet -> mergeCells("A6:B6");
        $objectSheet -> mergeCells("A7:B7");
        $objectSheet -> mergeCells("A6:A7");
        
         //分离单元格
         $objectSheet -> unmergeCells('A6:A7');
         //添加图片
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing -> setName('搜索');
        $objDrawing -> setPath(dirname(dirname(dirname(__FILE__))) . '/images/test.png'); 
        $objDrawing -> setHeight(18);
        $objDrawing -> setCoordinates('D7');
        $objDrawing -> setOffsetX(10);
        $objDrawing -> setRotation(15);
        $objDrawing -> setWorksheet($objectSheet);

        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);

        //输出到硬盘
        //$objWriter->save(dirname(dirname(dirname(__FILE__))) . "/xxx.xls");  
        
        //输出到浏览器  
        $outputFileName = "x1.xls";
        header("Content-Type: application/force-download");  
        header("Content-Type: application/octet-stream");  
        header("Content-Type: application/download");  
        header('Content-Disposition:inline;filename="'.$outputFileName.'"');  
        header("Content-Transfer-Encoding: binary");  
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
        header("Pragma: no-cache");  
        $objWriter->save('php://output'); 
        //恢复yii的自动装载
        spl_autoload_register(array('YiiBase','autoload'));
		Yii::app()->end();
	}
	public function actionIndex() {
		$this->render('index');
	}

	public function actionMail() {
		$this->render('mail');
	}

	public function actionPdf() {
		//关闭yii的自动装载
		spl_autoload_unregister(array('YiiBase','autoload'));
		include_once (dirname(dirname(__FILE__)) . '/extensions/pdf/libraries/tcpdf5.9/config/lang/chi.php');
		include_once (dirname(dirname(__FILE__)) . '/extensions/pdf/libraries/tcpdf5.9/tcpdf.php');
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 001');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		//set some language-dependent strings
		$pdf->setLanguageArray($l);
		
		// ---------------------------------------------------------
		
		// set default font subsetting mode
		$pdf->setFontSubsetting(true);
		
		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('stsongstdlight', '', 14, '', true);
		
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();
		
		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		
		// Set some content to print
		$html = '
		<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
		<i>This is the first example of TCPDF library.</i>
		<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
		<p>Please check the source code documentation and other examples for further information.</p>
		<p>你好，窝的。</p>
		<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
		';
		
		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		$pdf->Output('example_001.pdf', 'I');
		
		

		//恢复yii的自动装载
		spl_autoload_register(array('YiiBase','autoload'));
		Yii::app()->end();
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}