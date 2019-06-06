<?php use Core\Input; ?>
<?php $this->start('body')?>
            <div class="row">
              <div class="col-md-12">
                <div class="card p-3">
                  <div class="card-header">
                    <h5 class="title">Customer / Create</h5>
                  </div>
                  <div class="card-body">
					<form action="<?=PROOT?>customer/new" method="POST">
						<?=Input::csrfInput()?>
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Basic data</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="accounting-tab" data-toggle="tab" href="#accounting" role="tab" aria-controls="accounting" aria-selected="false">Accounting</a>
					  </li>
					</ul>
					<div class="tab-content" id="myTabContent">
					    <div class="tab-pane fade show active p-3" id="data" role="tabpanel" aria-labelledby="data-tab">
					        <div class="form-group row">
					            <label for="customer_number" class="col-form-label col-md-2">Customer Number</label>
					            <input type="text" name="customer_number" id="customer_number" class="form-control col-md-2" readonly="true">
					            <label for="customer_name" class="col-form-label col-md-2">Name (*)</label>
					            <input type="text" name="customer_name" id="customer_name" class="form-control col-md-6">
					        </div>
					        <div class="form-group row">
					            <label for="billing_address" class="col-form-label col-md-2">Billing Address(*)</label>
					            <input type="text" name="billing_address" id="billing_address" class="form-control col-md-6">
					            <label for="billing_province" class="col-form-label col-md-2">Province(*)</label>
					            <input type="text" name="billing_province" id="billing_province" class="form-control col-md-2">
					        </div>
					            <div class="form-group row">
					            <label for="ship_to_address" class="col-form-label col-md-2">Ship To Address</label>
					            <input type="text" name="ship_to_address" id="ship_to_address" class="form-control col-md-6">
					            <label for="ship_to_province" class="col-form-label col-md-2">Province</label>
					            <input type="text" name="ship_to_province" id="ship_to_province" class="form-control col-md-2">
					        </div>
					        <div class="form-group row">
					            <label for="country_code" class="col-form-label col-md-2">Country(*)</label>
					            <select name="country_code" id="country_code" class="form-control col-md-2 custom-select">
									<?php foreach($this->countries as $country):?>
									<option value="<?=$country->country_code?>"><?=$country->country?></option>
									<?php endforeach?>
					            </select>
					            <label for="tel" class="col-form-label col-md-2">Tel no.(*)</label>
					            <input type="text" name="tel" id="tel" class="form-control col-md-2">
					            <label for="fax" class="col-form-label col-md-2">Fax no.</label>
					            <input type="text" name="fax" id="fax" class="form-control col-md-2">
					        </div>
					            <div class="form-group row">
					            <label for="website" class="col-form-label col-md-2">Website</label>
					            <input type="text" name="website" id="website" class="form-control col-md-2">
					            <label for="contact" class="col-form-label col-md-2">Contact person</label>
					            <select name="title" id="title" class="form-control col-md-1 custom-select">
									<?php foreach ($this->titles as $title):?>
									<option value="<?=$title->title?>"><?=$title->title?></option>
									<?php endforeach?>
					            </select> 
					            <input type="text" name="contact" id="contact" class="form-control col-md-1">
					            <label for="email" class="col-form-label col-md-2">Email address</label>
					            <input type="email" name="email" id="email" class="form-control col-md-2">
					        </div>     
					    </div>

					    <div class="tab-pane fade p-3" id="accounting" role="tabpanel" aria-labelledby="accounting-tab">
					        <div class="form-group row">
						        <label for="gst" class="col-form-label col-md-2">GST</label>
						        <label class="switch">
						              <input type="checkbox" name="gst" id="gst">
						              <span class="slider round"></span>
						        </label> 
					            <label for="gst_number" class="col-form-label col-md-2">GST Number</label>
					            <input type="text" name="gst_number" id="gst_number" class="form-control col-md-2">
					        </div>  
					        <div class="form-group row">
						        <label for="pst" class="col-form-label col-md-2">PST</label>
						        <label class="switch">
						              <input type="checkbox" name="pst" id="pst">
						              <span class="slider round"></span>
						        </label> 
					            <label for="pst_number" class="col-form-label col-md-2">PST Number</label>
					            <input type="text" name="pst_number" id="pst_number" class="form-control col-md-2">            
					        </div>
					        <div class="form-group row">
						        <label for="hst" class="col-form-label col-md-2">HST</label>
						        <label class="switch">
						              <input type="checkbox" name="hst" id="hst">
						              <span class="slider round"></span>
						        </label> 
					            <label for="hst_number" class="col-form-label col-md-2">HST Number</label>
					            <input type="text" name="hst_number" id="hst_number" class="form-control col-md-2">
					        </div>        
					        <div class="form-group row">
					            <label for="discount" class="col-form-label col-md-2">Discount(*)</label>
					            <input type="text" name="discount" id="discount" class="form-control col-md-2">
					        </div>
					        <div class="form-group row">
					            <label for="sales_person" class="col-form-label col-md-2">Sales Person</label>
					            <input type="text" name="sales_person" id="sales_person" class="form-control col-md-2">
					            <label for="customer_class" class="col-form-label col-md-2">Customer Class</label>
					            <select name="customer_class" id="customer_class" class="form-control col-md-2 custom-select">
					            	<?php foreach($this->customer_classes as $customer_class):?>
										<option value="<?=$customer_class->customer_class?>"><?=$customer_class->customer_class_description?></option>
					            	<?php endforeach?>
					            </select>
					        </div>

					    </div>  
					</div>
					<div class="p-3">
					    <button type="submit" class="btn btn-primary">Save</button>
					    <button id="cancel" class="btn btn-secondary">Cancel</button>
					</div> 
					</form>

                  </div>
         
               </div>
      </div>
    </div>
<?php $this->end()?>
<?php $this->start('script')?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cancel').on('click',function(e){
			e.preventDefault();
			$(location).attr('href','<?=PROOT?>customer');
		})
	})
</script>
<?php $this->end()?>