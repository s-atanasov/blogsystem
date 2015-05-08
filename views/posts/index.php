<input type='text' id='search' name='search' />
<button name='DoSearch' id='searchButton' onClick='DoSearch()' >Search by Tags</button>
<div id='searchStatus'></div>
<script>
    
    function DoSearch(){
        
        sessionStorage.Posts = '';
        sessionStorage.Search = '';
        $('#searchStatus').empty();
        $.ajax({
            type: "POST", 
            url: "<?php echo DX_ROOT_URL ?>posts/search/",
            data: "search="+$('#search').val(),
            success: function(html) {
                //console.log(html);
                renderPosts(html);
                if($('#search').val() != ''){
                    sessionStorage.Posts = html;
                    sessionStorage.Search = $('#search').val();
                    $('#searchStatus').append('Search for <b>' + $('#search').val() + '</b>');
                }
                
            }
        });
    }
    
    function renderPosts(posts){

        posts = JSON.parse(posts);

        var count = posts.length;
        var html = '';
        $('.table tbody').empty();
        for(var i = 0; i < posts.length; i++){
            html = '';
            html += '<tr>';
            html += '<td>' + count + '</td>';
            html += '<td><a href="<?php echo DX_ROOT_URL ?>posts/view/' + posts[i].Id + '" >' + posts[i].Title + '</a></td>';
            
            var currText = posts[i].Text;
            if(currText.length > 18){
              currText = currText.substring(0,15) + '...';
            }
            html += '<td>' + currText + '</td>';
            html += '<td>' + posts[i].CreateDate + '</td>';
            
            if(posts[i].UserId == "<?php echo (isset($this->logged_user['userId'])) ? $this->logged_user['userId'] : '0'; ?>" ){
                html += '<td><a href="<?php echo DX_ROOT_URL; ?>posts/edit/' + posts[i].Id + '">Edit</a> | <a href="<?php echo DX_ROOT_URL; ?>posts/delete/' + posts[i].Id + '">Delete</a></td>';
            }else{
                html += '<td>No Action</td>';
            }
            html += '</tr>';
            count--;
            $('.table tbody').append(html);
        }
    }
    
    $(document).ready(function(){
        
        if(sessionStorage.Posts != ''){
            renderPosts(sessionStorage.Posts);
            $('#searchStatus').append('Search for <b>' + sessionStorage.Search + '</b>');
        }else{
            renderPosts('<?php echo json_encode($posts); ?>');
        }
        
    });
</script>
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
