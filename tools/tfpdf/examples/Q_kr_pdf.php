<?php
	// Template Begin Q_kr_pdf
	$title = "견적서도 함께English->Korean";
	$cost_tag = $entry["cost_tag"];
	if($cost_tag == "&yen;") $cost_tag = "￥";
	
	$table1 = "
	<table border=0 width=180>
		<tr>
			<td>수 신 : {$entry[doc_company]}</td>
			<td>날 짜 : " . substr($entry["doc_date"],0,10) . "</td>
		</tr>
		<tr>
			<td>수신인 : {$entry[doc_client]}</td>
			<td>문서번호 : {$entry[doc_num]}</td>
		</tr>	
	</table>
	";
	
	$table2 = "
	<table border=1 width=180>
		<tr>
			<td rowspan=2 width=30 valign=middle align=center border='.5,.1,.5,.5'>의뢰품목</td>
			<td width=25 align=center border='.5,.1,.1,.1'>제품명</td>
			<td border='.5,.1,.1,.1'>{$entry[item_product]}</td>
			<td width=25 align=center border='.5,.1,.1,.1'>모델명</td>
			<td border='.5,.5,.1,.1'>{$entry[item_model]}</td>
		</tr>
		<tr>
			<td width=25 align=center border='.1,.1,.5,.1'>특이사항</td>
			<td colspan=3 border='.1,.5,.5,.1'>{$entry[item_detail]}</td>
		</tr>
	</table>
	";
	
	$table3 = "
	<table border=1 width=180>
		<tr bgcolor=#cccccc>
			<td align=center border='.5,.1,.1,.5'>규격</td>
			<td align=center border='.5,.1,.1,.1'>항목</td>
			<td align=center border='.5,.1,.1,.1'>단가({$cost_tag})</td>
			<td align=center border='.5,.1,.1,.1'>수량</td>
			<td align=center border='.5,.1,.1,.1'>합계({$cost_tag})</td>
			<td align=center border='.5,.5,.1,.1'>비고</td>
		</tr>
	";
	if(isset($items)) {
		foreach($items as $itm) {
			$table3 .= "
			<tr>
				<td border='.1,.1,.1,.5'>{$itm[standard]}</td>
				<td>{$itm[item]}</td>
				<td align=right>" . number_format($itm["price"]) . "</td>
				<td align=right>" . number_format($itm["qty"]) . "</td>
				<td align=right>" . number_format($itm["amount"]) ."</td>
				<td border='.1,.5,.1,.1'>{$itm[note]}</td>
			</tr>
			";
		}
	}
	$table3 .= "</table>";
	
	$table4 = "
	<table border=1 width=180>";
	if(intval($entry["cost_nego"])) {	
		$table4 .= "
		<tr>
			<td align=center width=30 border='.5,.1,.1,.5'>Special Nego.</td>
			<td align=right border='.5,.5,.1,.1'>" . number_format($entry[cost_nego]) . "</td>
		</tr>";
	}
	$table4 .= "
		<tr>
			<td align=center width=30 border='.1,.1,.5,.5'>총 계({$cost_tag})</td>
			<td align=right border='.1,.5,.5,.1'>" . number_format($entry[cost_total]) ."</td>
		</tr>
	</table>
	";
	
	$table5 = "
	<table border=1 width=180>
		<tr>
			<td align=center valign=middle width=30 border='.5,.1,.1,.5'>거래 조건</td>
			<td border='.5,.5,.1,.1'>" . nl2br($entry["extra_business"]) . "</td>
		</tr>
		<tr>
			<td align=center valign=middle width=30 border='.1,.1,.1,.5'>결제 조건</td>
			<td border='.1,.5,.1,.1'>" . nl2br($entry["extra_payment"]) . "</td>
		</tr>
		<tr>
			<td align=center valign=middle width=30 border='.1,.1,.1,.5'>시료의 처리</td>
			<td border='.1,.5,.1,.1'>" . nl2br($entry["extra_sample"]) . "</td>
		</tr>
		<tr>
			<td align=center valign=middle width=30 border='.1,.1,.5,.5'>업무의뢰서</td>
			<td border='.1,.5,.5,.1'>" . nl2br($entry["extra_signature"]) . "</td>
		</tr>
	</table>
	";

?>