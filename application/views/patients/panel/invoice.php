
<div class="tab-pane" id="invoice" style="padding-top: 10px;">
	<div id='drugGroup1' class="responsive-table form-group">
		<h2>Today's Invoice</h2>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Expiry date</th>
					<th style="width= 20">QTY</th>
					<th>Cost</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$totalcost = 0;
				if($invoice){
					$i=0;
					foreach($invoice as $pat){
						if(date('d/m/Y',$pat->assign_date) == date('d/m/Y')){
						$this->model_pharmacy->load($pat->med_id);
						echo '<tr id="dpi'.$pat->med_patient_id.'"><td class="id">'.++$i.'</td>'.
							'<td>'.$this->model_pharmacy->medicine_name.'</td>'.
							'<td>'.$this->model_pharmacy->expire_date.'</td>'.
							'<td>'.$pat->quantity.'</td>'.
							'<td>'.number_format($pat->total_cost).'</td>';
							$totalcost += $pat->total_cost;

						}
					}
				}
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<th>Consultant fees :</th>
					<td><?php  echo number_format($user_data['c_fees']) ?> </td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<th>TotalCost :</th>
					<td><?php echo number_format($totalcost +  $user_data['c_fees']) ?></td>
				</tr>
			</tbody>
		</table>
		<legend>+ All Invoices </legend>

		<div style="display: none;">
			<div class="form-group">
				<div class="col-md-12">
					<?php
	if($invoice){	
					 
							$i = 0;
							$count = 1;
		foreach($invoice as $pat){
								if($i> 1){
									$count++;
									if($count < $i--) continue;
								}
								
								else
								{	$i = 0;
								 
									if(date('d/m/Y',$pat->assign_date) != date('d/m/Y')){?>
								
										<h2><?php echo date('d/m/Y',$pat->assign_date)?>'s Invoice</h2>
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>Expiry date</th>
													<th style="width= 20">QTY</th>
													<th>Cost</th>
												</tr>
											</thead>
										<tbody>			
										<?php
										$j=0;
										$total_cost =0;
												foreach($invoice as $mpat){
										
											if(date('d/m/Y', $pat->assign_date) == date('d/m/Y', $mpat->assign_date)){
												 
												$this->model_pharmacy->load($mpat->med_id);
												echo '<tr id="dpi'.$mpat->med_patient_id.'"><td class="id">'.++$j.'</td>'.
													'<td>'.$this->model_pharmacy->medicine_name.'</td>'.
													'<td>'.$this->model_pharmacy->expire_date.'</td>'.
													'<td>'.$mpat->quantity.'</td>'.
													'<td>'.number_format($mpat->total_cost).'</td>';
												$total_cost += $mpat->total_cost;
												$i = $i+1;
											}//end date compere foreach
										}//end invoice foreach
											?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<th>Consultant fees :</th>
								<td><?php  echo number_format($user_data['c_fees']) ?> </td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<th>TotalCost :</th>
								<td><?php echo number_format($total_cost +  $user_data['c_fees']) ?></td>
							</tr>
						</tbody>
					</table>
				 <?php											 
																						 
										}//end date if
									}//end else
								}//end foreach
							}
 					?>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$('legend').on('click', function() {
		$(this).parent().find('div:first').toggle();
		var fL = $(this).text().substr(0, 1);
		var text = $(this).text().substr(1);
		if (fL == '-')
			$(this).text('+' + text);
		else if (fL == '+')
			$(this).text('-' + text);

	});

</script>
