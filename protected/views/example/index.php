<?php
/* @var $this ExampleController */

$this->breadcrumbs=array(
		'Example',
);
?>
<h1>例子</h1>

<h2>已完成</h2>
<p>
	PHPExcel:<?php echo CHtml::link("export excel example",array('excel'),array('target'=>'_blank'));?>
	<br/> 
	tcpdf:<?php echo CHtml::link("export pdf example",array('pdf'),array('target'=>'_blank'));?>
</p>
<hr />
<h2>未完成</h2>
<p>
	mail:<?php echo CHtml::link("mail example",array('mail'),array('target'=>'_blank'))?>
	<br/>
	swfupload:<?php echo CHtml::link("upload image example",array('upload'),array('target'=>'_blank'))?>
	<br/>
	fileUpload:
	<br/>
	imgareaselect<?php echo CHtml::link("upload image and edit example",array('imgareaselect'),array('target'=>'_blank'))?>
	<br/>	
</p>
<hr />
