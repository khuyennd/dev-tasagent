<?php
/*
	require_once("config.php");
	
	$QUOT_ROOT = DOC_ROOT."/admin_digitalemc/quotation/";
	
	require_once($QUOT_ROOT."lib/php/class.database.php");
	require_once($QUOT_ROOT."lib/php/js.php");
	require_once($QUOT_ROOT."lib/php/func.php");
	require_once("dbcon.php");
*/	
//	require_once($QUOT_ROOT."lib/tfpdf/pdftable.inc.php");
	require_once("../pdftable.inc.php");

	/*--------------------------------------------------------------------------
	 * PDF Template Include
	 *------------------------------------------------------------------------*/
	//$pdf_template = "templates/{$doc_type}_{$doc_lang}_pdf.php";
	$pdf_template = "./Q_kr_pdf.php";
	include_once($pdf_template);

	function _utf8($val)
	{
		$str = '';
		if(function_exists('mb_convert_encoding')) $str = mb_convert_encoding($val, 'utf-8', 'euc-kr');
		else $str = iconv('euc-kr', 'utf-8', $val);
		return (string) $str;
	}	
		
	/*--------------------------------------------------------------------------
	 * PDF 파일 생성
	 *------------------------------------------------------------------------*/
	$pdf = new PDFTable();

	$pdf->SetCreator("DigitalEMC");
	$pdf->SetAuthor($_SESSION["MemID"]);
	$pdf->SetTitle("Quotation/Invoice Form");
	$pdf->SetSubject($entry["doc_num"]);
	
	$pdf->SetMargins(15,15);
	$pdf->AddFont('nanum','','FONT00.TTF',true);

	$pdf->SetDrawColor(0,0,0);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('nanum','',24);
	
	$pdf->AddPage();

	$title_width = 80;
	$pdf->SetX((210-$title_width)/2);
	$pdf->SetLineWidth(.5);
	$pdf->Cell($title_width, 13, _utf8($title), 'B', 1, 'C');
	$pdf->Ln(6);

	$pdf->SetLineWidth(.1);
	$pdf->SetPadding(2);
	$pdf->SetSpacing(2);
	$pdf->SetFont('nanum','',12,true);
	$pdf->htmltable(_utf8($table1));	
	$pdf->Ln(6);

	$pdf->SetFont('nanum','',10,true);
	$pdf->htmltable(_utf8($table2));
	$pdf->htmltable(_utf8($table3));
	$pdf->htmltable(_utf8($table4));
	$pdf->htmltable(_utf8($table5));

	//$pdf->Output("pdf/{$PDF_File}","F");
	$pdf->Output("doc.pdf","I");
?>