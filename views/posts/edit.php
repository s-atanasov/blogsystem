
<form class="form-horizontal" action="<?php echo DX_ROOT_URL; ?>posts/edit/<?php echo $post[0]['Id']; ?>" method="POST">
    <div class="row">
        <div class="col-md-2">Title :</div>
        <div class="col-md-10">
            <input type="text" value="<?php echo $post[0]['Title']; ?>" required class="form-control" name="title" placeholder="Title">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Text :</div>
        <div class="col-md-10">
            <textarea required class="form-control" rows="3" name="text"><?php echo $post[0]['Text']; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Tags :</div>
        <div class="col-md-10">
            <select name='tags[]' id='tags' multiple="multiple">
                <?php
                    foreach ($allTags as $tag) {
                        $selected = '';
                        if(in_array($tag['Name'], $postTags)){
                           $selected = 'selected'; 
                        }
                        echo '<option value="' . $tag['Id'] . '" '. $selected .'>' . $tag['Name'] . '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="hidden" name="Id" value="<?php echo $post[0]['Id']; ?>" />
        <input type="submit" name="Submit" value="Submit" class="btn btn-primary" />
      </div>
    </div>
</form>
<?php
    if(isset($error)){
        echo $error;
    }
?>

