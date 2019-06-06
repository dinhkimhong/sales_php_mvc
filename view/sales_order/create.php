<?php use Core\Input;?>
<?php $this->start('body')?>
      <div class="row">
              <div class="col-md-12">
                <div class="card p-3">
                  <div class="card-header">
                    <h5 class="title">Sales Order / Create</h5>
                  </div>
                  <div class="card-body">
				    <form action="<?=PROOT?>sales/new" method="POST">
				    	<?=Input::csrfInput()?>
				    <ul class="nav nav-tabs" id="myTab" role="tablist">
				      <li class="nav-item">
				        <a class="nav-link active" id="customer-data-tab" data-toggle="tab" href="#customer-data" role="tab" aria-controls="customer-data" aria-selected="true">Customer Data</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" id="accounting-tab" data-toggle="tab" href="#accounting" role="tab" aria-controls="accounting" aria-selected="false">Accounting</a>
				      </li>
				        <li class="nav-item">
				        <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false">Delivery</a>
				      </li>
				    </ul>
				    <div class="tab-content" id="myTabContent">
				        <div class="tab-pane fade show active p-3" id="customer-data" role="tabpanel" aria-labelledby="customer-data-tab">
				            <div class="form-group row">
				                <label for="so_number" class="col-form-label col-md-2">Order number</label>
				                <input type="text" name="so_number" id="so_number" class="form-control col-md-2" readonly="true">
				                <label for="currency" class="col-form-label col-md-2">Currency</label>
				                <select name="currency" id="currency" class="form-control col-md-2 custom-select">
				                    <?php foreach ($this->currencies as $currency):?>
				                    <option value="<?=$currency->currency?>" <?php if($this->_oldInput && $this->_oldInput['currency'] == $currency->currency):?> selected="true" <?php endif;?> ><?=$currency->currency?></option>  
				                    <?php endforeach;?>  
				                </select> 
				                <label for="payment_term" class="col-form-label col-md-2">Payment Term</label>
				                <input type="text" name="payment_term" id="payment_term" class="form-control col-md-2" value="<?php if($this->_oldInput){ echo($this->_oldInput['payment_term']);}?>">
				            </div>

				            <div class="form-group row">
				                <label for="delivery_date" class="col-form-label col-md-2">Delivery Date</label>
				                <input type="text" name="delivery_date" id="delivery_date" class="form-control col-md-2" placeholder="yyyy-mm-dd" value="<?php if($this->_oldInput){ echo($this->_oldInput['delivery_date']);}?>">
				               
				                <label for="delivery_term" class="col-form-label col-md-2">Delivery Term</label>
				                <select name="delivery_term" id="delivery_term" class="form-control col-md-1 custom-select">
				                    <option value=""></option>
				                    <?php foreach ($this->delivery_terms as $delivery_term):?>
				                    <option value="<?=$delivery_term->delivery_term?>" <?php if($this->_oldInput && $this->_oldInput['delivery_term'] == $delivery_term->delivery_term):?> selected="true" <?php endif;?>><?=$delivery_term->delivery_term?></option>
				                    <?php endforeach;?>
				                </select>
				                <input type="text" name="delivery_place" id="delivery_place" class="form-control col-md-3" placeholder="place.." value="<?php if($this->_oldInput){ echo($this->_oldInput['delivery_place']);}?>">
				            </div>  
				        <div class="form-group row">
				            <label for="customer_number" class="col-form-label col-md-2">Customer Number</label>
				            <div class="col-md-2 pl-0 pr-0">
				                <div class="input-group">
				                    <input type="text" name="customer_number" id="customer_number" class="form-control" value="<?php if($this->_oldInput){ echo($this->_oldInput['customer_number']);}?>">
				                    <div class="input-group-addon">
				                        <span class="fa fa-search" id="find_customer"></span>
				                    </div>
				                </div>
				            </div>

				            <label for="customer_name" class="col-form-label col-md-2">Name (*)</label>
				            <input type="text" name="customer_name" id="customer_name" class="form-control col-md-6" readonly="true" value="<?php if($this->_oldInput){ echo($this->_oldInput['customer_name']);}?>">
				        </div>

				            <div class="form-group row">
				                <label for="contact" class="col-form-label col-md-2">Contact</label>
				                <input type="text" name="contact" id="contact" class="form-control col-md-2" value="<?php if($this->_oldInput){ echo($this->_oldInput['contact']);}?>">
				               
				                <label for="tel" class="col-form-label col-md-2">Tel number</label>
				                <input type="text" name="tel" id="tel" class="form-control col-md-3" value="<?php if($this->_oldInput){ echo($this->_oldInput['tel']);}?>">
				            </div> 
				        </div>
				        
				        <div class="tab-pane fade p-3" id="accounting" role="tabpanel" aria-labelledby="accounting-tab">
				            <div class="form-group row">
				                <label for="total_amount" class="col-form-label col-md-3">Total Amount</label>
				                <input type="text" name="total_amount" id="total_amount" class="form-control col-md-3" readonly="true">
				            </div>    
				            <div class="form-group row">
				                <label for="total_cost" class="col-form-label col-md-3">Total Cost</label>
				                <input type="text" name="total_cost" id="total_cost" class="form-control col-md-3" readonly="true">
				            </div>
				            <div class="form-group row">
				                <label for="total_margin" class="col-form-label col-md-3">Total Margin</label>
				                <input type="text" name="total_margin" id="total_margin" class="form-control col-md-3" readonly="true">
				            </div>            
				            <div class="form-group row">
				                <label for="gross_margin" class="col-form-label col-md-3">Gross Margin</label>
				                <input type="text" name="gross_margin" id="gross_margin" class="form-control col-md-3" readonly="true">
				            </div>
				        </div>

				        <div class="tab-pane fade p-3" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
				            <div class="form-group">
				                <label for="delivery_instruction"><u>Delivery Instruction:</u></label>
				                <textarea name="delivery_instruction" class="form-control" id="delivery_instruction" rows="5"><?php if($this->_oldInput) echo $this->_oldInput['delivery_instruction']?></textarea>
				            </div>
				        </div>
				      
				    </div>
				    <div class="p-3 table-responsive-sm">
				        <table class="table table-bordered form-group">
				            <thead>
				                <tr>
				                    <th scope="col">Material Number</th>
				                    <th scope="col">Material Name</th>
				                    <th scope="col">Unit</th>
				                    <th scope="col">Quantity</th>
				                    <th scope="col">Unit Price</th>
				                    <th scope="col">Amount</th>
				                    <th scope="col"><a href="#" class="addRow">Add</a></th>
				                </tr>
				            </thead>
				            <?php if($this->_oldInput):?>
				            <tbody>

				                	<!-- foreach($this->_oldInput) -->
				                	<?php foreach($this->_oldInput['material_number'] as $key => $value):?>
				                    <tr>
				                        <td>
				                        <div class="input-group">
				                            <input type="text" name="material_number[]" class="form-control material_number" value="<?=$value?>">
				                                <div class="input-group-addon">
				                                    <span class="fa fa-search find_material"></span>
				                                </div>
				                        </div>
				                        </td>
				                        <td><input type="text" name="material_description[]" class="form-control material_description" readonly="true" value="<?=$this->_oldInput['material_description'][$key]?>"></td>
				                        <td><input type="text" name="unit[]" class="form-control unit" readonly="true" value="<?=$this->_oldInput['unit'][$key]?>"></td>
				                        <td><input type="text" name="quantity[]" class="form-control quantity" value="<?=$this->_oldInput['quantity'][$key]?>"></td>
				                        <td><input type="text" name="unit_price[]" class="form-control unit_price" value="<?=$this->_oldInput['unit_price'][$key]?>"></td>
				                        <td><input type="text" name="amount[]" class="form-control amount" readonly="true"></td>
				                        <td><a href="#" class="accordion-toggle" data-toggle="collapse" data-target="#_<?=$value?>">Detail</a><a href="#" class="removeRow">Remove</a>
				                        </td>
				                    </tr>

				                    <tr>
				                        <td colspan="7">
				                            <div class="accordion-body collapse" id="_<?=$value?>">
				                                <div class="form-group row">
				                                    <label for="moving_price" class="col-form-label col-md-2">Moving price</label>
				                                    <input type="text" name="moving_price[]" class="form-control col-md-2 moving_price" readonly="true" value="<?=$this->_oldInput['moving_price'][$key]?>">
				                                   
				                                    <label for="margin" class="col-form-label col-md-2">Margin</label>
				                                    <input type="text"class="form-control col-md-2 margin" readonly="true">
				                                </div>                         
				                            </div>
				                        </td>
				                    </tr>
				                </tbody>
				                	<?php endforeach?>
				                <?php else:?>	
				                <tbody>			            	
				                    <tr>
				                        <td>
				                        <div class="input-group">
				                            <input type="text" name="material_number[]" class="form-control material_number">
				                                <div class="input-group-addon">
				                                    <span class="fa fa-search find_material"></span>
				                                </div>
				                        </div>
				                        </td>
				                        <td><input type="text" name="material_description[]" class="form-control material_description" readonly="true"></td>
				                        <td><input type="text" name="unit[]" class="form-control unit" readonly="true"></td>
				                        <td><input type="text" name="quantity[]" class="form-control quantity"></td>
				                        <td><input type="text" name="unit_price[]" class="form-control unit_price"></td>
				                        <td><input type="text" name="amount[]" class="form-control amount" readonly="true"></td>
				                        <td><a href="#" class="accordion-toggle" data-toggle="collapse" data-target="">Detail</a><a href="#" class="removeRow">Remove</a>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td colspan="7">
				                            <div class="accordion-body collapse" id="">
				                                <div class="form-group row">
				                                    <label for="moving_price" class="col-form-label col-md-2">Moving price</label>
				                                    <input type="text" name="moving_price[]" class="form-control col-md-2 moving_price" readonly="true">
				                                   
				                                    <label for="margin" class="col-form-label col-md-2">Margin</label>
				                                    <input type="text" class="form-control col-md-2 margin" readonly="true">
				                                </div>                         
				                            </div>
				                        </td>
				                    </tr>
				            </tbody>

				                <?php endif;?>				                

				        </table> 
				        <button type="submit" class="btn btn-primary">Save</button>
				        <button id="back" class="btn btn-secondary">Cancel</button>
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
		amount();
		totalAmount();
        margin();
        totalCost();
        totalMargin();
        grossMargin();
	    $('#delivery_date').datepicker({
	        changeMonth:true,
	        changeYear:true,
	        dateFormat: "yy-mm-dd",
    	})	


        $('thead').on('click','.addRow',function(){
		// $('.addRow').on('click',function(){// this order didn't work
			var addRow ='<tbody>'+
                        '<tr>'+
                    	'<td>'+
                    	'<div class="input-group">'+
	                        '<input type="text" name="material_number[]" class="form-control material_number">'+
	                        '<input type="text" name="number[]" class="form-control number" readonly="true" hidden>'+
	                            '<div class="input-group-addon">'+
	                                '<span class="fa fa-search find_material"></span>'+
	                            '</div>'+
		                    '</div>'+
	                    '</td>'+
	                    '<td><input type="text" name="material_description[]" class="form-control material_description" readonly="true"></td>'+
	                    '<td><input type="text" name="unit[]" class="form-control unit" readonly="true"></td>'+
	                    '<td><input type="text" name="quantity[]" class="form-control quantity"></td>'+
	                    '<td><input type="text" name="unit_price[]" class="form-control unit_price"></td>'+
	                    '<td><input type="text" name="amount[]" class="form-control amount" readonly="true"></td>'+
	                    '<td><a href="#" class="accordion-toggle" data-toggle="collapse" data-target="#detail">Detail</a><a href="#" class="removeRow">Remove</a></td>'+
                	'</tr>'+
                    '<tr>'+
                    '<td colspan="7">'+
                        '<div class="accordion-body collapse" id="detail">'+
                            '<div class="form-group row">'+
                                '<label for="moving_price" class="col-form-label col-md-2">Moving price</label>'+
                                '<input type="text" name="moving_price[]" class="form-control col-md-2 moving_price" readonly="true">'+
                               
                                '<label for="margin" class="col-form-label col-md-2">Margin</label>'+
                                '<input type="text" name="margin[]" class="form-control col-md-2 margin" readonly="true">'+
                            '</div>'+
                        '</div>'+
                    '</td>'+
                    '</tr>'+
                    '</tbody>';
            $('table').append(addRow);
            amount();
			totalAmount();
            margin();
            totalCost();
            totalMargin();
            grossMargin();
            
		})
		$('table').on('click','.removeRow',function(){
			var l = $('tbody').length;
			if(l == 1){
				alert('You can not remove last row.');
			} else {
				$(this).parents('tbody').remove();
				            amount();
					totalAmount();
		            margin();
		            totalCost();
		            totalMargin();
		            grossMargin();
			}
		})

		$('#customer_number').on('change',function(){
			var number = $('#customer_number').val();
			var dataNumber = {'customer_number': number};
			$.ajax({
				type:'GET',
				url: '<?=PROOT?>customer/info',
				dataType: 'json',
				data: dataNumber,
				success: function(data){
					$('#customer_name').val(data.customer_name);
				}
			})
		})	

    $('table').delegate('.material_number', 'change',function(){
        var tbody = $(this).closest('tbody');
        var number = tbody.find('.material_number').val();
        var dataNumber = {'material_number':number};
        $.ajax({
            type: 'GET',
            url: '<?=PROOT?>material/info',
            dataType: 'json',
            data: dataNumber,
            success: function (data){
                tbody.find('.material_description').val(data.material_description);
                tbody.find('.unit').val(data.unit);
                tbody.find('.moving_price').val(data.moving_price);
                tbody.find('.accordion-toggle').attr('data-target',"#_"+number);
                tbody.find('.accordion-body').attr('id','_'+number);
                }
            })
        margin();
        totalCost();
        totalMargin();
        grossMargin();
    })

    $('table').on('change','.quantity',function(){
    	amount();
    	totalAmount();
        margin();
        totalCost();
        totalMargin();
        grossMargin();        
    })

     $('table').on('change','.unit_price',function(){
    	amount();
    	totalAmount();
        margin();
        totalCost();
        totalMargin();
        grossMargin();
    })
    $("#edit"). on('click',function(e){
	        e.preventDefault();
	        $('input').attr('readonly',false);
	        $('select').attr('disabled',false);
	        $('#so_number').attr('readonly',true);
	        $('#customer_name').attr('readonly',true);
	        $('#total_amount').attr('readonly',true);
	        $('#total_cost').attr('readonly',true);
            $('#total_margin').attr('readonly',true);
	        $('#gross_margin').attr('readonly',true);
	        $('.material_description').attr('readonly',true);
	        $('.unit').attr('readonly',true);
	        $('.amount').attr('readonly',true);
            $('.moving_price').attr('readonly',true);  
            $('.margin').attr('readonly',true);            		        	        	        
	        $(this).attr('hidden',true);
	        $('#save').attr('hidden',false);
       	 	$('thead tr').append('<th><a href="#" class="addRow">Add</a></th>');
        	$('tbody tr').append('<td><a href="#" class="removeRow">Remove</a></td>');	        
	})

    $("#delete").on('click',function(e){
    	e.preventDefault();
    	// alert("Hello");
    	$("#action").val("delete");
    	$('form').submit();
    })

//amount of each row
    function amount(){
        var amount = 0;
        $('.amount').each(function(i,e){
            var tbody = $(this).parents('tbody');
            var quantity = tbody.find('.quantity').val();
            var unit_price = tbody.find('.unit_price').val();
            var amount = (quantity * unit_price);
            tbody.find('.amount').val(amount.toFixed(2));
        })   
    }
// margin of each row
    function margin(){
        var margin = 0;
        $('.margin').each(function(i,e){
            var tbody = $(this).parents('tbody');
            var unit_price = tbody.find('.unit_price').val();
            var moving_price = tbody.find('.moving_price').val();
            var margin = ((unit_price - moving_price)/moving_price)*100;
            tbody.find('.margin').val(margin.toFixed(2) + ' %');
        })
    }

//total amount of whole order
    function totalAmount(){
        var total = 0;
        $('.amount').each(function(i,e){
            var amount = $(this).val()-0;
            total += amount; 
        })
        $('#total_amount').val(total);
   	}
//total cost of whole order
    function totalCost(){
        var total_cost = 0;
        $('.moving_price').each(function(i,e){
            var tbody = $(this).parents('tbody');
            var moving_price = $(this).val();
            var quantity = tbody.find('.quantity').val();
            var cost = moving_price*quantity;
            total_cost += cost;
        })
        $('#total_cost').val(total_cost);
    }

//total margin of whole order
    function totalMargin(){
        var total_amount = $('#total_amount').val();
        var total_cost = $('#total_cost').val();
        var total_margin = total_amount - total_cost;
        $('#total_margin').val(total_margin);
    }

// gross margin of whole order
    function grossMargin(){
        var total_amount = $('#total_amount').val();
        var total_cost = $('#total_cost').val();
        var gross_margin = ((total_amount - total_cost)/total_amount)*100;
        $('#gross_margin').val(gross_margin.toFixed(2));
    }

//===============number and dot=============
    function number(input){
        $(input).keypress(function(evt){
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[-\d\.]/;
            var objRegex= /^-?\d*[\.]?\d*$/;
            var val = $(evt.target).val();
            if(!regex.test(key) || !objRegex.test(val+key)|| !theEvent.keyCode ==46 || !theEvent.keyCode == 8){
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            };
        })
    }
    //=============number only===================
    function numberOnly(input){
        $(input).keypress(function(evt){
            var e = event || evt;
            var charCode = e.which || e.keyCode;
            if(charCode > 31 && (charCode< 48 || charCode>57))
                return false;
            return true;
        })
    }    
//============find element by row-------===========
    function findRowNum(input)
    {
        $('tbody').delegate(input,'keydown',function(){
            var tr = $(this).parent().parent();
            number(tr.find(input));
        })
    }

    function findRowNumOnly(input)
    {
        $('tbody').delegate(input,'keydown',function(){
            var tr = $(this).parent().parent();
            numberOnly(tr.find(input));
        })
    }

//==========call function number===========


    findRowNum('.quantity');
    findRowNum('.unit_price');
    findRowNumOnly('.material_number');


 //==button Create to direct to form create new sales order====

 	$('#create').on('click',function(e){
 		e.preventDefault();
		$(location).attr('href','<?=PROOT?>sales/create');	
 	})

 //==button Back to direct to index
 	$('#back').on('click',function(e){
 		e.preventDefault();
 		$(location).attr('href','<?=PROOT?>sales');

 	})




})


</script>

<?php $this->end()?>