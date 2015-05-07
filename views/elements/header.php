<!DOCTYPE html>
<html>
    <head>
        <title>Blog System</title>
        <link rel="stylesheet" href="/blogsystem/lib/bootstrap.css">
    </head>
    <body>
        <div id="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo DX_ROOT_URL; ?>">Blog System</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo DX_ROOT_URL; ?>posts/index" >Posts</a></li>
                            <?php if(!empty($this->logged_user)): ?>
                                <li><a href="<?php echo DX_ROOT_URL; ?>posts/post" >New Post</a></li>
                                <li><a href="<?php echo DX_ROOT_URL; ?>login/logout" >Logout</a></li>
                                <li>Hi <?php echo $this->logged_user['username']; ?></li>
                            <?php else : ?>
                                <li><a href="<?php echo DX_ROOT_URL; ?>login/index" >Login</a></li>
                                <li><a href="<?php echo DX_ROOT_URL; ?>login/register" >Register</a></li>
                            <?php endif; ?>
                            
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div id="main">