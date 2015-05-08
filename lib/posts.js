
function DoSearch(type){

    if(type == 1){
        $('#search').val('');
    }
    var rootPath = $("#DX_ROOT_URL").val();
    sessionStorage.Posts = '';
    sessionStorage.Search = '';
    $('#searchStatus').empty();
    $.ajax({
        type: "POST", 
        url: rootPath + "posts/search/",
        data: "search="+$('#search').val(),
        success: function(html) {
            //console.log(html);
            renderPosts(html);
            if($('#search').val() != ''){
                sessionStorage.Posts = html;
                sessionStorage.Search = $('#search').val();
                $('#searchStatus').append('Search for <b>' + $('#search').val() + '</b> <a href="javascript:DoSearch(1)" >Clear</a>');
            }

        }
    });
}
    
function renderPosts(posts){

    posts = JSON.parse(posts);

    var count = posts.length;
    var html = '';
    $('.table tbody').empty();
    var rootPath = $("#DX_ROOT_URL").val();
    var userId = $("#userId").val();
    for(var i = 0; i < posts.length; i++){
        html = '';
        html += '<tr>';
        html += '<td>' + count + '</td>';
        html += '<td><a href="' + rootPath + 'posts/view/' + posts[i].Id + '" >' + posts[i].Title + '</a></td>';

        var currText = posts[i].Text;
        if(currText.length > 18){
          currText = currText.substring(0,15) + '...';
        }
        html += '<td>' + currText + '</td>';
        html += '<td>' + posts[i].CreateDate + '</td>';
        
        html += getAction(posts[i].UserId,userId,rootPath,posts[i].Id);
        html += '</tr>';
        count--;
        $('.table tbody').append(html);
    }
}

function getAction(postUserId,userId,rootPath,postId){
    var html = '';
    if(postUserId == userId ){
        html += '<td><a href="' + rootPath + 'posts/edit/' + postId + '">Edit</a> | <a href="' + rootPath + 'posts/delete/' + postId + '">Delete</a></td>';
    }else{
        html += '<td>No Action</td>';
    }
    return html;
}
    
    