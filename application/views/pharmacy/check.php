<div>
	<div class="modal fade" id="modalCheckDrug" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Products Details</h4>
				</div>
				<div class="modal-body">
					<?php foreach ($product as $pro ): ?>

					<div class="table-responsive">
						<table class="table table-boredered">
							<tr>
								<td>Medicine Name</td>
								<td><?php echo $pro["medicine_name"]?></td>

							</tr>
							<tr>
								<td>Registered Quantity</td>
								<td><?php echo $pro['quantity']?></td>

							</tr>
							<tr>
								<td>Used Quantity</td>
								<td><?php echo $pro['used_quantity']?></td>

							</tr>
							<tr>
								<td>Remain Quantity</td>
								<td><?php echo $pro['remain_quantity']." <span class='label label-warning'>".$pro['sell_type']."</span> ";
									if($pro['tab_quantity'] != 0){
									$r_tab_qty = $pro['remain_tab_quantity']%$pro['tab_quantity'];
									if( $r_tab_qty != 0){
										echo $r_tab_qty."<span class='label label-success'>Tabs</span>";
									}
									}
									?></td>

							</tr>
							<tr>
								<td>Registered date</td>
								<td><?php echo $pro['register_date']?></td>

							</tr>
							<tr>
								<td>Expired date</td>
								<td><?php echo  $pro['expire_date']?></td>

							</tr>
							<tr>
								<td>Unit</td>
								<td><?php echo $pro['sell_type']?></td>

							</tr>
							<tr>
								<td>Actual Price</td>
								<td><?php echo $pro['actual_price']?></td>

							</tr>
							<tr>
								<td>Selling Price</td>
								<td><?php echo $pro['selling_price']?></td>

							</tr>
							<tr>
								<td>Profit </td>
								<td><?php echo $pro['profit_price']?></td>

							</tr>

							<tr>
								<td>Description</td>
								<td><?php echo $pro['description']?></td>

							</tr>
							<tr>
								<td>Status</td>
								<?php

							if($pro['status'] == 1) {
							$product_status = '<span class="label label-success">Active</span>'; 
								}
							else {
							$product_status = '<span class="label label-warning">Inactive</span>';
								}
								?>
								<td><?php echo $product_status;?></td>

							</tr>
						</table>
					</div>
					<?php endforeach ?>
				</div>
				<div class="modal-footer">   
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('#modalCheckDrug').modal('show');
		});
	</script>
</div>