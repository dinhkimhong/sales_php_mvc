<?php $this->start('body')?>
            <div class="row">
              <div class="col-md-12">
                <div class="card p-3">
                  <div class="card-header">
                    <h5 class="title">Customer / Create</h5>
                  </div>
                  <div class="card-body">
                  	<div class="table-responsive">
                  		<table class="table">
                  			<thead>
                  				<tr>
                  					<th>Material number </th>
                  					<th>Material Description</th>
                  					<th>Manufacturer number</th>
                  					<th>Manufacturer</th>
                  					<th>Unit</th>
                  					<th>Inventory Quantity</th>
                  				</tr>
                  			</thead>
                  			<tbody>
                  				<?php foreach($this->materials as $material):?>
                  				<tr>
                  					<td><?=$material->material_number?></td>
                  					<td><?=$material->material_description?></td>
                  					<td><?=$material->mfg_material_number?></td>
                  					<td><?=$material->manufacturer?></td>
                  					<td><?=$material->unit?></td>
                  					<td><?=$material->inventory_quantity?></td>         					
                  				</tr>
                  				<?php endforeach;?>
                  				
                  			</tbody>

                  		</table>

                  </div>
              </div>
          </div>
      </div>

<?php $this->end()?>