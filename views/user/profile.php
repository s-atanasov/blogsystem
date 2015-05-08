<script>
    $(document).ready(function(){
        renderPosts('<?php echo json_encode($userPosts); ?>');
    });
</script>
<input type='hidden' id='DX_ROOT_URL' value="<?php echo DX_ROOT_URL; ?>" />
<input type='hidden' id='userId' value="<?php echo (isset($this->logged_user['userId'])) ? $this->logged_user['userId'] : '0'; ?>" />
<a href='<?php echo DX_ROOT_URL ?>user/changepassword'>Change password</a>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Text</th>
      <th>Create Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table> 