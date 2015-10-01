<?php	
	$table1 = "
	<table border=0 width=190>
		<tr>
			<td width=20>★수 신 : </td>
			<td width=70>" . $estinfo['CR_ESTM_CNAME']."</td>
			<td width=20>회사명 : </td>
			<td>" . $company['CR_COMP_NAME']."</td>
		</tr>
		<tr>
			<td>★참 조 : </td>
			<td>" . $estinfo['CR_ESTM_NAMES']."</td>
			<td>회사주소 : </td>
			<td valign=top>" . $company['CR_COMP_ADDR']."</td>
		</tr>
		<tr>
			<td>★전 화 : </td>
			<td family=Arial>" . $estinfo['CR_ESTM_TEL']."</td>
			<td>대표전화 : </td>
			<td family=Arial>" . $company['CR_COMP_ETEL']."</td>
		</tr>
		<tr>
			<td>★팩 스 : </td>
			<td family=Arial>" . $estinfo['CR_ESTM_FAX']."</td>
			<td>팩스 : </td>
			<td family=Arial>" . $company['CR_COMP_FAX']."</td>
		</tr>
		<tr>
			<td> </td> 
			<td> </td>
			<td family=Arial>E-mail :</td> 
			<td family=Arial>" . $company['CR_COMP_MAIL']."</td>
		</tr>	
		<tr>
			<td>관리번호 : </td> 
			<td family=Arial>" . $estinfo['CR_CONT_SEQ'] . "-" . str_pad($estinfo['CR_ESTM_SEQ'], 2, '0', STR_PAD_LEFT) . "</td>		
			<td family=Arial>Web : </td>
			<td family=Arial>" . $company['CR_COMP_SITE']."</td>
		</tr>											
	</table>
	";
	
	$table2 = "
	<table border=0 width=190>
		<tr>
			<td align=center family=malgunbd>아래와 같이 견적합니다.</td>
		</tr>";
	
	$table3 = "
	<table border=1 width=190>
		<tr bgcolor=#E46D09>
			<td align=center family=malgunbd border='.1,.1,.1,.1' width=40>제목</td>
			<td align=center family=malgunbd border='.1,.1,.1,.1' width=60>작업형태</td>
			<td align=center family=malgunbd border='.1,.1,.1,.1'>단위</td>
			<td align=center family=malgunbd border='.1,.1,.1,.1'>수량</td>
			<td align=center family=malgunbd border='.1,.1,.1,.1'>단가(".$COMMON_CODE['C083'][$estinfo['CR_CONT_CURR']]['CODE_DESC'].")</td>
			<td align=center family=malgunbd border='.1,.1,.1,.1'>금액(".$COMMON_CODE['C083'][$estinfo['CR_CONT_CURR']]['CODE_DESC'].")</td>
		</tr>
	";
		
		$total  = 0;
		foreach($esdlist as $esd) {
			$table3 .= "
			<tr>
				<td border='.1,.1,.1,.1' align=center>" . $esd['CR_ESDL_TITLE']."</td>
				<td border='.1,.1,.1,.1' align=center>" . $esd['CR_ESDL_TYPE']."</td>
				<td border='.1,.1,.1,.1' align=center>" . $esd['CR_ESDL_UNIT']."</td>
				<td border='.1,.1,.1,.1' align=right>" . setCommas($esd['CR_ESDL_QUANTITY'], '01')."</td>
				<td border='.1,.1,.1,.1' align=right>" . setCommas($esd['CR_ESDL_PRICE'], $estinfo['CR_CONT_CURR'])."</td>
				<td border='.1,.1,.1,.1' align=right>" . setCommas($esd['CR_ESDL_AMOUNT'], $estinfo['CR_CONT_CURR'])."</td>
			</tr>
			";
			$total += $esd['CR_ESDL_AMOUNT'];
		}

	$table3 .= "<tr bgcolor=#E46D09>
					<td border='.1,.1,.1,.1' align=left colspan=5 family=malgunbd>합계</td>
					<td border='.2,.1,.1,.1' align=right>" . $cur_symbs[$COMMON_CODE['C083'][$estinfo['CR_CONT_CURR']]['CODE_VAL']] . setCommas($total, $estinfo['CR_CONT_CURR']) . "</td>
				</tr></table>";
	
	$table4 = "
	<table border=0 width=180>
		<tr>
			<td align=left border=0 height=15 valign=bottom>계약조건</td>
		</tr></table>";
	
	$table5 = "
	<table border=0 width=180>
		<tr>
			<td align=left border=0>" . str_replace("\r\n", "<br>", $company['CR_COMP_E_COND']) ." <br></td>
		</tr></table>";
?>