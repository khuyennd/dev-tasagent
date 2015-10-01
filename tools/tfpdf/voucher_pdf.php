<?php

		
	require_once("./pdftable.inc.php");

	
	$title = "Voucher";
		
		
	$defFont = 'MyFont';	
	$pdf = new PDFTable();
	//...Japan
	/*
	$pdf->AddFont($defFont,'','MSGOTHIC.TTF',true);
	$pdf->AddFont($defFont.'B','','MSGOTHICB.TTF',true);
	*/
	//...China(GB2312)
	/*
	$pdf->AddFont($defFont,'','SIMSUN.TTF',true);
	$pdf->AddFont($defFont.'B','','SIMSUNB.TTF',true);
	*/
	//...China(GBK)
	/*
	$pdf->AddFont($defFont,'','MINGLIU.TTF',true);
	$pdf->AddFont($defFont.'B','','MINGLIUB.TTF',true);
	*/
	//...English
	
	$pdf->AddFont($defFont,'','ARIALUNI.TTF',true);
	//...$pdf->AddFont($defFont.'B','','ARIALUNI.TTF',true);
	$pdf->AddFont($defFont.'B','','ARIALUNI.TTF',true);
	
	
	
	$pdf->SetCreator("Hotel");
	$pdf->SetAuthor("Hotel");
	$pdf->SetTitle("Hotel");
	$pdf->SetSubject("Hotel", true);
	
	$pdf->SetMargins(10,2);
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetPadding(0);
	$pdf->SetSpacing(0,0);

	$pdf->AddPage();
	$pdf->SetFont($defFont,'',20);
		
	$pdf->Image("../../themes/default/img/logo.png",135,10,60);	
	$pdf->htmltable("<table width=190>
			<tr><td size=30 width=30>Hotel </td><td color=#FF6600 size=30> Voucher</td></tr>
			<tr><td size=9 colspan=2>Please present either an electronic or paper copy of your hotel voucher upon check-in</td></tr>
		</table>");
	$pdf->Line(0, $pdf->y, 220, $pdf->y);
    $pdf->Ln(3);		
	$pdf->SetFont($defFont,'',10,true);
	$pdf->htmltable("
    	<table width=190>
			<tr><td width=40>Hotel:</td>				<td>Keio Plaza Hotel</td></tr>
			<tr><td width=40>Address:</td>				<td></td></tr>
			<tr><td width=40>Hotel Contact No:</td>		<td>+81XXXXXXXXX</td></tr>
		</table>");	
	$pdf->Ln(5);	
	
	$pdf->SetFont($defFont,'',8,true);
	$pdf->htmltable("
    	<table  width=190>
    		<tr><td size=10 family={$defFont}B>1. Customer Information(お客様情報)</td></tr>    		    		
			<tr><td width=80>Booking ID(予約番号): XXXXXXXX</td>				<td>Guest Name(お客様　氏名): XXXXXXX</td></tr>
			<tr><td colspan=2>Nationality(国籍): Japan</td></tr>
		</table>");
	$pdf->Ln(5);
	
	$pdf->htmltable("
    	<table  width=190>
    		<tr><td size=10 family={$defFont}B>2. Booking Information(予約情報）</td></tr>
			<tr><td width=80>Check In (MM/DD/YY): 12/2/2012</td>				<td>Check Out (MM/DD/YY): 12/6/2012</td></tr>
			<tr><td colspan=2>Total No or rooms:  2 Executive TWN Plan & 1 Standard SGL Plan</td></tr>
		</table>");
	$pdf->Ln(3);
	$pdf->htmltable("<font size=9 family={$defFont}B>Rooming Details</font><br>");
		
  for($i=1; $i<=3; $i++){
	$pdf->htmltable("
    	<table  width=190>
    		<tr><td size=8 family={$defFont}B>- Room {$i}</td></tr>
    		<tr><td>Room Plan(宿泊プラン）: Executive TWN Package</td></tr>
			<tr><td width=80>Room Type(ルームタイプ）: TWN</td>				<td>no of pax stay at room: 2</td></tr>
			<tr><td colspan=2>Guest Name: Michael Li, Michelle Li</td></tr>
			<tr><td width=80>Breakfast(朝食): None included</td>			<td>Dinner(夕食): Not included</td></tr>
			<tr><td colspan=2>Special Request(特別リクエスト）:</td></tr>
			<tr><td size=7>* All Special request are subjects to availability</td></tr>
		</table>");
	$pdf->Ln(2);
  }	
	
	$pdf->htmltable("
    	<table width=190>
    		<tr><td size=10 family={$defFont}B>3. Agent Information</td></tr>
    		<tr><td>Name: TASTAS Co.,Ltd,  Mr.TTTT</td></tr>
			<tr><td width=80>Phone no:  XXXXXXXXXXXXXX</td>				<td>Email: XXXXXXXXXX@XXXXXXXXX</td></tr>
		</table>");
	$pdf->Ln(2);
	$pdf->htmltable("<table width=190><tr><td> Note: <br>
		-This voucher must be presented during check in. Failure to　do so may result in the reservation not being honored.<br> 
		-Hotel has right a right to request credit card or deposit upon arrival to cover and guaranteed any incidental cost that maybe incurred during the stay.<br>
		-If you expect to arrive after 21:00, please inform the hotel your arrival time to avoid being released. In the event of No show or Early check-out, the hotel reserves right to charge a full cancellation fee.<br> 
		-In case where Breakfast is included with the room rate, please note that certain hotels may charge extra for children travelling with their parents. If applicable, the hotel will bill you directly. Upon arrival, if you have any question, please verify with hotel.<br>
	</td></tr></table>");
	
	$pdf->Line(0, $pdf->y, 220, $pdf->y);
	$pdf->Ln(1);
	$pdf->Image("../../themes/default/img/bottom_logo.jpg",12,$pdf->y+2,20);
	$pdf->SetLeftMargin(35);
	$pdf->htmltable("<table width=90><tr><td size=10>TAS Agent / TAS Co.Ltd<br>TEL +81-3-5565-5850</td></tr></table>");
	
	

	$pdf->Output("voucher.pdf","I");
?>