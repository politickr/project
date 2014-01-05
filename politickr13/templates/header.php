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
		<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
        
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
			 <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION["user"]['username']?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="my_reps.php">My Representatives</a></li>
					<li><a href="display.php?id=<?php echo $_SESSION['user']['senator2id']?>">Account Settings</a></li>
					<li><a href="display.php?id=<?php echo $_SESSION['user']['repid']?>">Votefeed</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
			<?php else:?>
				
			<?php endif ?>
			</li>
			</ul>
		</div><!-- /.navbar-collapse -->
</nav>
</div>
</header>