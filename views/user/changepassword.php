<div class="row">
    <div class="col-lg-4">
        <form class="form-horizontal" action="" method="POST">
            <fieldset>
              <legend>Change Password</legend>
              <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Old Password</label>
                <div class="col-lg-9">
                  <input type="password" class="form-control" name="oldPassword" id="inputPassword" placeholder="Old Password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputNewPassword" class="col-lg-3 control-label">New Password</label>
                <div class="col-lg-9">
                  <input type="password" class="form-control" name="newPassword" id="inputNewPassword" placeholder="New Password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputConfirmNewPassword" class="col-lg-3 control-label">Confirm New Password</label>
                <div class="col-lg-9">
                  <input type="password" class="form-control" name="confirmNewPassword" id="inputConfirmNewPassword" placeholder="Confirm New Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-9 col-lg-offset-1">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" name='Submit' class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        <?php
            if(isset($error_text)){
               echo $error_text; 
            }
        ?>
    </div>
</div>