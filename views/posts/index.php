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
    <?php
      foreach ($posts as $post) {
          echo '<tr>';
          echo '<td>' . $post['Id']. '</td>';
          echo '<td><a href="'. DX_ROOT_URL .'posts/view/' . $post['Id'] . '" >' . $post['Title']. '</a></td>';
          $currText = $post['Text'];
          if(strlen($currText) > 18){
              $currText = substr($currText, 0,15) . '...';
          }
          echo '<td>' . $currText . '</td>';
          echo '<td>' . $post['CreateDate']. '</td>';
          if(!empty($this->logged_user) && $post['UserId'] == $this->logged_user['userId']){
              echo '<td><a href="'. DX_ROOT_URL .'posts/edit/' . $post['Id'] . '">Edit</a> | <a href="'. DX_ROOT_URL .'posts/delete/' . $post['Id'] . '">Delete</a></td>';
          }else{
              echo '<td>No Action</td>';
          }
          echo '</tr>';
      }
    ?>
  </tbody>
</table> 
