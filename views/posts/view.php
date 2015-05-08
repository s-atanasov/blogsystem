
<div class="row">
    <div class="col-md-2">Title :</div>
    <div class="col-md-10">
        <?php echo $post[0]['Title']; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">Text :</div>
    <div class="col-md-10">
        <?php echo $post[0]['Text']; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">Author :</div>
    <div class="col-md-10">
        <?php echo $username[0]['username']; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">Create Date :</div>
    <div class="col-md-10">
        <?php echo $post[0]['CreateDate']; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">Tags :</div>
    <div class="col-md-10">
        <?php echo (!empty($postTags) ? implode(',',$postTags) : 'No Tags') ; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">Comments :</div>
    <div class="col-md-10">
        <?php
            if(empty($comments)){
                echo 'No Comments yet.';
            }else{
                //echo '<pre>'.print_r($post, true).'</pre>';
                $count = count($comments);
                
                foreach ($comments as $comment) {
                    $deletelink = '';
                    if(!empty($this->logged_user) && $post[0]['UserId'] == $this->logged_user['userId']){
                        $deletelink = '<a href="'. DX_ROOT_URL .'posts/deleteComment/' . $comment['Id'] . '/'.$post[0]['Id'].'">Delete</a>';
                    }
                    echo '<div>---------------------------</div>';
                    echo '<div><b>Comment #' . $count . '</b> '.$deletelink.'</div>';
                    echo '<div><b>Name:</b> '.$comment['AuthorName'].'</div>';
                    $email = 'No Email';
                    if(!empty($comment['AuthorEmail'])){
                       $email =  $comment['AuthorEmail'];
                    }
                    echo '<div><b>Email:</b> '.$email.'</div>';
                    echo '<div><b>Text:</b> '.$comment['Text'].'</div>';
                    $count--;
                }
            }
        
        ?>
    </div>
</div>

    <form class="form-horizontal" action="<?php echo DX_ROOT_URL; ?>posts/view/<?php echo $post[0]['Id']; ?>" method="POST">
        <div class="row">
            <div class="col-md-2">Name :</div>
            <div class="col-md-10">
                <input type="text" required class="form-control" name="name" placeholder="Name">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">Email :</div>
            <div class="col-md-10">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">Comment text :</div>
            <div class="col-md-10">
                <textarea required class="form-control" rows="3" name="text"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <input type="hidden" name="id" value="<?php echo $post[0]['Id']; ?>" />
                <input type="submit" name="Submit" value="Submit" class="btn btn-primary" />
            </div>
        </div>
    </form>
<?php
    if(isset($commentStatus)){
        echo $commentStatus;
    }
?>

