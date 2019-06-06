<?php $this->start('body')?>
       <div class="row">
              <div class="col-md-12">
                <div class="card p-3">
                  <div class="card-header">
                    <h5 class="title">Customer</h5>
                  </div>
                  <div class="card-body">
						<form action="" type="GET">
							<input type="text" name="action" value="view" hidden>
							<div class="form-group row">
						        <label for="customer_number" class="col-form-label col-md-2">Customer Number</label>
						        <input type="text" name="customer_number" id="customer_number" class="form-control col-md-2">
						        <input type="text" id="customer_name" class="form-control col-md-6" readonly="true">
						        <button id="view" type="submit" class="btn-primary btn-sm">Go</button>
						    </div>
					    </form>
						<a href="<?=PROOT?>customer/create" class="btn btn-primary">Create new customer</a>

                  </div>
              </div>
          </div>
      </div>
<?php $this->end()?>
<?php $this->start('script')?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#view').on('click',function(e){
			e.preventDefault();
			let customer_number = $('#customer_number').val();
	       	$(location).attr('href',`<?=PROOT?>customer/view/${customer_number}`);

		})

		$('#customer_number').on('change',function(){
			let customer_number = $('#customer_number').val();
			let dataNumber = {'customer_number' : customer_number};
			$.ajax({
				type:'GET',
				url: '<?=PROOT?>customer/info',
				datatype: 'json',
				data: dataNumber,
				success:function(customer_info){
					$('#customer_name').val(customer_info.customer_name);
				}
			})
		})

	})	



</script>

<?php $this->end();