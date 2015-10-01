<?php
	// Template Begin Q_kr_pdf
	$title = "�������� �Բ�English->Korean";
	$cost_tag = $entry["cost_tag"];
	if($cost_tag == "&yen;") $cost_tag = "��";
	
	$table1 = "
	<table border=0 width=180>
		<tr>
			<td>�� �� : {$entry[doc_company]}</td>
			<td>�� ¥ : " . substr($entry["doc_date"],0,10) . "</td>
		</tr>
		<tr>
			<td>������ : {$entry[doc_client]}</td>
			<td>������ȣ : {$entry[doc_num]}</td>
		</tr>	
	</table>
	";
	
	$table2 = "
	<table border=1 width=180>
		<tr>
			<td rowspan=2 width=30 valign=middle align=center border='.5,.1,.5,.5'>�Ƿ�ǰ��</td>
			<td width=25 align=center border='.5,.1,.1,.1'>��ǰ��</td>
			<td border='.5,.1,.1,.1'>{$entry[item_product]}</td>
			<td width=25 align=center border='.5,.1,.1,.1'>�𵨸�</td>
			<td border='.5,.5,.1,.1'>{$entry[item_model]}</td>
		</tr>
		<tr>
			<td width=25 align=center border='.1,.1,.5,.1'>Ư�̻���</td>
			<td colspan=3 border='.1,.5,.5,.1'>{$entry[item_detail]}</td>
		</tr>
	</table>
	";
	
	$table3 = "
	<table border=1 width=180>
		<tr bgcolor=#cccccc>
			<td align=center border='.5,.1,.1,.5'>�԰�</td>
			<td align=center border='.5,.1,.1,.1'>�׸�</td>
			<td align=center border='.5,.1,.1,.1'>�ܰ�({$cost_tag})</td>
			<td align=center border='.5,.1,.1,.1'>����</td>
			<td align=center border='.5,.1,.1,.1'>�հ�({$cost_tag})</td>
			<td align=center border='.5,.5,.1,.1'>���</td>
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
			<td align=center width=30 border='.1,.1,.5,.5'>�� ��({$cost_tag})</td>
			<td align=right border='.1,.5,.5,.1'>" . number_format($entry[cost_total]) ."</td>
		</tr>
	</table>
	";
	
	$table5 = "
	<table border=1 width=180>
		<tr>
			<td align=center valign=middle width=30 border='.5,.1,.1,.5'>�ŷ� ����</td>
			<td border='.5,.5,.1,.1'>" . nl2br($entry["extra_business"]) . "</td>
		</tr>
		<tr>
			<td align=center valign=middle width=30 border='.1,.1,.1,.5'>���� ����</td>
			<td border='.1,.5,.1,.1'>" . nl2br($entry["extra_payment"]) . "</td>
		</tr>
		<tr>
			<td align=center valign=middle width=30 border='.1,.1,.1,.5'>�÷��� ó��</td>
			<td border='.1,.5,.1,.1'>" . nl2br($entry["extra_sample"]) . "</td>
		</tr>
		<tr>
			<td align=center valign=middle width=30 border='.1,.1,.5,.5'>�����Ƿڼ�</td>
			<td border='.1,.5,.5,.1'>" . nl2br($entry["extra_signature"]) . "</td>
		</tr>
	</table>
	";

?>