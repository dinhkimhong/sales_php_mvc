<?php use Core\Input;?>

<?php $this->start('body')?>
        <div class="row">
              <div class="col-md-12">
                <div class="card p-3">
                  <div class="card-header">
                    <h5 class="title">Outbound / Create</h5>
                  </div>
                  <div class="card-body">
					<form action="<?=PROOT?>outbound/new" method="POST">
						<?=Input::csrfInput()?>
					    <div class="form-group row">
					        <label for="so_number" class="col-form-label col-md-2">Order number</label>
					        <input type="text" name="so_number" id="so_number" class="form-control col-md-2" readonly="true" value="<?=$this->sales_order->so_number?>">
					       	<label for="customer_name" class="col-form-label col-md-2">Customer Name</label>
					        <input type="text" name="customer_name" id="customer_name" class="form-control col-md-4" value="<?=$this->sales_order->customer_name?>" readonly="true" >
					    </div>
					    <div class="form-group row">
					        <label for="delivery_date" class="col-form-label col-md-2">Delivery Date</label>
					        <input type="text" name="delivery_date" id="delivery_date" class="form-control col-md-2" value="<?=$this->sales_order->delivery_date?>" readonly="true" >
					        <label for="delivery_term" class="col-form-label col-md-2">Delivery Term</label>
					        <input type="text" name="delivery_term" id="delivery_term" class="form-control col-md-1" value="<?=$this->sales_order->delivery_term?>" readonly="true" >	 
					        <input type="text" name="delivery_place" id="delivery_place" value="<?=$this->sales_order->delivery_place?>" class="form-control col-md-3" readonly="true" >
					    </div>	    

					    <table class="table table-responsive-md table-bordered form-group">
					        <thead>
					        <tr>
					            <th scope="col">Material Number</th>
					            <th scope="col">Material Name</th>
					            <th scope="col">Unit</th>
					            <th scope="col">Quantity</th>
					            <th scope="col">Delivery Quantity </th>
					            <th></th>
					        </tr>
					        <thead>
							<?php foreach($this->sales_order_details as $detail):?>
					        <tbody>
					            <tr>
					                <td><input type="text" class="form-control material_number"  readonly="true" value="<?=$detail->material_number?>">
					                </td>
					                <td><input type="text" name="material_description[]" class="form-control material_description"   readonly="true" value="<?=$detail->material_description?>"></td>
					                <td><input type="text" name="unit[]" class="form-control unit"  readonly="true" value="<?=$detail->material_number?>"></td>
					                <td>
					                    <input type="text" name="order_quantity[]" class="form-control order_quantity"  readonly="true" style="text-align: right;" value="<?=$detail->quantity?>">   
					                </td>
					                <td><input type="text" class="form-control" id="total_delivery_quantity" style="text-align: right;" readonly="true"></td>
					                <td><a href="#" class="accordion-toggle" data-toggle="collapse" data-target="#_<?=$detail->number?>">Pick</a></td>
					            </tr>
				                <tr>
				                        <td colspan="6">
				                            <div class="accordion-body collapse" id="_<?=$detail->number?>">
				                            	<?php foreach($detail->batch_number as $batch):?>
				                                <div class="form-group row">
				                                	<input type="text" name="sod_number[]" class="form-control sod_number"  hidden="true" value="<?=$detail->number?>">
				                                    <label for="batch_number" class="col-form-label col-md-2">Batch Number</label>
				                                    <input type="text" name="batch_number[]" class="form-control col-md-2 batch_number" readonly="true" value="<?=$batch->batch_number?>">
				                                    <label for="quantity" class="col-form-label col-md-2">Stock availability</label>
				                                    <input type="text" name="quantity[]" class="form-control col-md-2 quantity" readonly="true" value="<?=$batch->receipt_quantity?>" >
				                                    <input type="text" name="delivery_quantity[]" class="form-control col-md-2 delivery_quantity" placeholder="Input pick quantity...">                             
				                                </div>       
				                                <?php endforeach?>              
				                            </div>
				                        </td>
				                    </tr>

					        </tbody>
					    <?php endforeach?>
					    </table>        
					    <button id="save" type="submit" class="btn btn-primary">Save</button>
					    <button id="cancel" class="btn btn-secondary">Cancel</button>
					</form>

                  </div>
              </div>
          </div>
      </div>

<?php $this->end()?>

<?php $this->start('script')?>
<script type="text/javascript">
	$(document).ready(function(){
		$('tbody').on('change','.delivery_quantity',function(){
			var tr = $(this).parents('tr');
			var tbody = tr.parents('tbody');
			var total_delivery_quantity = 0;
			tr.find('.delivery_quantity').each(function(i,e){
				var delivery_quantity = $(this).val()-0;
				total_delivery_quantity += delivery_quantity;
				// alert(delivery_quantity);
			})
			tbody.find('#total_delivery_quantity').val(total_delivery_quantity);
		})
	})   	
</script>
<?php $this->end();