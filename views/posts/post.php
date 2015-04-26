<form class="form-horizontal" action="<?php echo DX_ROOT_URL; ?>posts/post" method="POST">
  <fieldset>
    <legend>New Post</legend>
    <div class="form-group">
      <label for="inputTitle" class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Title">
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Text</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" name="text" id="textArea">Text</textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

