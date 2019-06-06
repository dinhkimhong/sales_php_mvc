<?php use Core\Input?>
<?php $this->start('body');?>
	<form class="log_in_form p-3" method="POST" action="<?=PROOT?>auth/login">
                <?=Input::csrfInput()?>
                <h3> Log In</h3>
                  <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" name="email" class="form-control" required>             
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required >                   
                  </div>
                  <button type="submit" class="btn btn-primary">Login</button>
                  <a href="#" class="btn btn-secondary">Sign Up</a>
     </form>
<?php $this->end();?>