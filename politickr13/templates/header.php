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
	<nav class="navbar navbar-inverse navbar-static-top container" style="margin-top:10px;" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="http://www.politickr.us">Politickr</a>
			</div>
	
		<div class="collapse navbar-collapse navbar-ex1-collapse">
                        
        <ul class="nav navbar-nav pull-right">
			 <?php if(isset($_SESSION["user"])):?>
			 <!-- Single button -->
			 <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION["user"]['username']?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22">
                    	<a href="my_reps.php">My Representatives</a></li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22">
                    	<a>Account Settings</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
			<?php elseif(!empty($_POST['address'])):?>
			  	<ul class="nav pull-right">
          			<li class="dropdown" id="menuLogin">
            			<a class="navbar-brand" href="#" data-toggle="dropdown" id="navLogin">Login</a>
            			<div class="dropdown-menu" style="padding:17px;">
              			<form action="login.php" method="post"> 
                			<input name="username" id="username" type="text" placeholder="Username"> 
                			<input name="password" id="password" type="password" placeholder="Password"><br>
                			<br></br>
                			<button type="submit" id="btnLogin" class="btn btn-large btn-primary">Login</button>
              			</form>
            			</div>
          			</li>
        		</ul>
			<?php endif ?>
		</ul>
		</div>
	</nav>
</header>