<input type='text' id='search' name='search' />
<button name='DoSearch' id='searchButton' onClick='DoSearch(0)' >Search by Tags</button>
<div id='searchStatus'></div>
<script>
    $(document).ready(function(){
        
        if(sessionStorage.Posts != ''){
            renderPosts(sessionStorage.Posts);
            $('#searchStatus').append('Search for <b>' + sessionStorage.Search + '</b> <a href="javascript:DoSearch(1)" >Clear</a>');
        }else{
            renderPosts('<?php echo json_encode($posts); ?>');
        }
        
    });
</script>
<input type='hidden' id='DX_ROOT_URL' value="<?php echo DX_ROOT_URL; ?>" />
<input type='hidden' id='userId' value="<?php echo (isset($this->logged_user['userId'])) ? $this->logged_user['userId'] : '0'; ?>" />
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
