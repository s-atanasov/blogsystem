<div class="row">
    <div class="col-lg-4">
        <form class="form-horizontal" action="<?php echo DX_ROOT_URL; ?>register/register" method="POST">
            <fieldset>
              <legend>Register</legend>
              <div class="form-group">
                <label for="inputUsername" class="col-lg-3 control-label">Username</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" name="Username" id="inputUsername" placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                <div class="col-lg-9">
                  <input type="password" class="form-control" name="Password" id="inputPassword" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputConfirmPassword" class="col-lg-3 control-label">Confirm Password</label>
                <div class="col-lg-9">
                  <input type="password" class="form-control" name="ConfirmPassword" id="inputConfirmPassword" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-9 col-lg-offset-1">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        <?php
            if(isset($login_text)){
               echo $login_text; 
            }
        ?>
    </div>
</div>