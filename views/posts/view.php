
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
<?php
//echo '<pre>'.print_r($post, true).'</pre>';
?>

