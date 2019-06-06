<?php use Core\Input;?>

<?php $this->start('body')?>
        <div class="row">
              <div class="col-md-12">
                <div class="card p-3">
                  <div class="card-header">
                    <h5 class="title">Outbound</h5>
                  </div>
                  <div class="card-body">
					<form action="<?=PROOT?>outbound/create" method="POST">
						<?= Input::csrfInput()?>
						<div class="form-group row p-3">
					        <label for="so_number" class="col-form-label col-md-2">Sales Order no.</label>
					        <input type="text" name="so_number" id="so_number" class="form-control col-md-2">
					        <button type="submit" class="btn-sm btn-primary">Create Outbound</button>
					    </div>
					</form>

                  </div>
              </div>
          </div>
      </div>
<?php $this->end()?>


