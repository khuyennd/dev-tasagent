<body style="background-color:#EBEBEB;">
	<table class="yellow" style="margin-top:0px;">
		<thead>
			<tr>
				<td colspan="2" style="background:#f4f4f4;">{l s='Consecutive nights promotion detail'}</td>
			</tr>
		</thead>
		<tbody>
		<tr>
			<th>{l s='Period'}</th>
			<td>{$roomplan_sales.ConFromTime|date_format:"%-Y-%m-%d"} ~ {$roomplan_sales.ConToTime|date_format:"%-Y-%m-%d"}</td>
		</tr>
		<tr>
			<th>{l s='Nights'}</th>
			<td>{$roomplan_sales.Nights} Nights</td>
		</tr>
		<!--
		<tr>
			<th colspan="2" style="background:#f4f4f4;">Total Price</th>
		</tr>
		<tr>
			<th>All</th>
			<td>{$roomplan_sales.PriceAll}</td>
		</tr>
		<tr>
			<th>Asia</th>
			<td>{$roomplan_sales.PriceAsia}</td>
		</tr>
		<tr>
			<th>Euro</th>
			<td>{$roomplan_sales.PriceEuro}</td>
		</tr>
		-->
		</tbody>
	</table>
</body>