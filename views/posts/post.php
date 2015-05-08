
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<form class="form-horizontal" action="<?php echo DX_ROOT_URL; ?>posts/post" method="POST">
  <fieldset>
    <legend>New Post</legend>
    <div class="form-group">
        <div class="col-lg-1">
            <label for="inputTitle" class="col-lg-2 control-label">Title</label>
        </div>
      <div class="col-lg-10">
        <input type="text" required class="form-control" name="title" id="inputTitle" placeholder="Title">
      </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1">
            <label for="textArea" class="col-lg-2 control-label">Text</label>
        </div>
      <div class="col-lg-10">
        <textarea required class="form-control" rows="3" name="text" id="textArea"></textarea>
      </div>
    </div>
    <div class="form-group">
        <div class="col-lg-1">
            <label for="tags" class="col-lg-2 control-label">Tags</label>
        </div>
        <div class="col-lg-10">
            <select name='tags[]' id='tags' multiple="multiple">
                <?php
                    foreach ($tags as $tag) {
                        echo '<option value="' . $tag['Id'] . '">' . $tag['Name'] . '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-1">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

