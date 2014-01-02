<!DOCTYPE html>

<html>

    <head>
	
        <link href="/css/bootstrap-override.css" rel="stylesheet"/>
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>
        

        <?php if (isset($title)): ?>
            <title>Politickr: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Politickr</title>
        <?php endif ?>

        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>

    </head>

    <header>
		<div class="container">
  		<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.php"><img src="img/header-main.svg" style="height:50px;"></img></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
  
			<ul class="nav navbar-nav navbar-right">
			<li>
			 <?php if(isset($_SESSION["user"])):?>
			 <!-- Single button -->
			 <div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
			<?php else:?>
				<form action="login.php" method="post" class="navbar-form navbar-left" role="search">
      
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username">
					</div>
					<div class="form-group">
					<input type="password" name = "password" class="form-control" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-default">Log In</button>
				</form>
	

			<?php endif ?>
			</li>
			</ul>
		</div><!-- /.navbar-collapse -->
</nav>
</div>
</header>