<?php
	#########################################################################
	# 견적서 출력 파일    	                                                    #
	# @date 2012.11.09                                                      #
	# @author CNH                                                           #
	# @file estform_pdf.php                                                 #
	#########################################################################
	include_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
	
	if(defined('__TBSECMS__') === false){
		echo '<p>잘못된 접근입니다.</p>';
		exit;
	}
		
	require_once("./pdftable.inc.php");

	/*--------------------------------------------------------------------------
	 * Data from DB
	 *------------------------------------------------------------------------*/
	
	$cseq = $_GET['cseq'] == ''? '':$_GET['cseq'];
	$id = $_GET['id'] == ''? '':$_GET['id'];

	$sql = "select e.*,c.CR_CONT_CURR from " . $af_config['table']['estpublish'] . " e left join {$af_config['table']['cont']} c on e.CR_CONT_SEQ = c.CR_CONT_SEQ left join {$af_config['table']['customer']} u on c.CUST_COM_SEQ = u.CUST_COM_SEQ where e.CR_CONT_SEQ = '" . $cseq . "' and e.CR_ESTM_SEQ = " . $id;
	$estinfo = db_fetch_item($sql); 
	if ($estinfo['CR_ESTM_SEQ']=='') exit;
	// EST 세부항목
	$sql = "select * from " . $af_config['table']['esdlist'] . " where CR_CONT_SEQ = '" . $cseq . "' and CR_ESTM_SEQ = " . $id;
	$esdlist = db_fetch($sql);
	
	// 회사 및 PO 양식정보 
	$sql = "select * from " .$af_config['table']['company'] . " limit 1";
	$company = db_fetch_item($sql);
	//...print__r($company);
	
	// 고객측 다운시
	if (isset($_GET['cust']) && $_GET['cust'] == 1){
		$sql = "update " . $af_config['table']['estpublish'] . " set CR_ESTM_RCV = '" . $COMMON_CODE['C090']['02']['CODE_VAL'] . "', CR_ESTM_RCVDT=Now() where CR_CONT_SEQ='" . $cseq . "' and CR_ESTM_SEQ=" . $id;
		db_query($sql); 
	}
	
	$title = "견        적         서";
		
	/*--------------------------------------------------------------------------
	 * PDF Template Include
	 *------------------------------------------------------------------------*/
	
	$pdf_template = "./templates/est_template.php";
	include_once($pdf_template);
		
	/*--------------------------------------------------------------------------
	 * PDF 파일 생성
	 *------------------------------------------------------------------------*/
	//... 기정 폰트
	$defFont = 'Tahoma';
	
	$pdf = new PDFTable();
	/*
	$pdf->AddFont($defFont,'','malgun.ttf',true);
	$pdf->AddFont('malgunbd','','malgunbd.ttf',true);
	*/
	
	$pdf->SetCreator("DigitalEMC");
	$pdf->SetAuthor($company['CR_COMP_ECEO']);
	$pdf->SetTitle("Quotation/Invoice Form");
	$pdf->SetSubject($estinfo["CR_ESTM_SEQ"]);
	
	$pdf->SetMargins(10,10);
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetTextColor(0,0,0);

	$pdf->AddPage();

	$pdf->Image(($homedir . 'data' . $company['CR_COMP_E_LOGO']),10,6,30);
	$pdf->SetFont($defFont,'',15);
    $pdf->Cell(180,10,$company['CR_COMP_E_TAGLINE'],0,0,'R');
    $pdf->Ln(20);		

    $pdf->SetFont('malgunbd','',24);
	$title_width = 180;
	$pdf->SetX((210-$title_width)/2);
	$pdf->SetLineWidth(.4);
	$pdf->Cell($title_width, 18, $title, 'TRBL', 1, 'C');
	$pdf->Ln(6);

	$pdf->SetLineWidth(.4);
	$pdf->SetPadding(2);
	$pdf->SetSpacing(2);
	$pdf->SetFont($defFont,'',10,true);	
	$pdf->htmltable($table1);	
	$pdf->Ln(6);

	
	
	
	
	$pdf->SetFont($defFont,'',12,true);
	$pdf->htmltable($table2);
	$pdf->SetFont($defFont,'',10,true);
	$pdf->htmltable($table3);
	$pdf->SetFont($defFont,'',12,true);
	$pdf->htmltable($table4);
	$pdf->SetFont($defFont,'',10,true);
	$pdf->htmltable($table5);

	$pdf->Ln(6);	
	$pdf->SetFont($defFont,'',12,true);
	$pdf->Cell(190,10,$company['CR_COMP_NAME'],0,0,'R');
	$pdf->lasth = 5;
	$pdf->Ln();	
	$pdf->Cell(190,10,$company['CR_COMP_CEO'],0,0,'R');
	$pdf->lasth = 5;
	$pdf->Ln(12);	
	//$pdf->Image(($homedir . 'data' . $company['CR_COMP_E_STAMP']),170, null, 30);
	$pdf->Image($homedir . 'data' . $company['CR_COMP_E_STAMP'],170, $pdf->y-2, 30); 		

	//$pdf->Output("pdf/{$PDF_File}","F");
	$pdf->Output("estform.pdf","I");
?>