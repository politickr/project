<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46444257-1', 'politickr.us');
  ga('send', 'pageview');
</script> 
<body>
<div class="container" style="min-height:90%">
	<div class="row">
		<div class="col-lg-3 something"></div>
        
		<div class="col-lg-6 text-center">
        		<div class="something text-center v-center" style="position:relative; min-height:300px; width:40%">
        					<img id="main0" src="img/main.svg" style="position:absolute;"/>
                            <form action="search.php" method="post" class="form-signin" id="main1" style="position:absolute; display:none">
        						<input type="text" name="address" class="input-block-level" placeholder="Street Address">
        						<button class="btn btn-large btn-primary" type="submit">S</button>
      						</form>
                            <form action="login.php" method="post" class="form-signin" id="main2" style="position:absolute; display:none">
        						<input type="text" name="username" class="input-block-level" placeholder="Username">
        						<input type="password" name="password" class="input-block-level" placeholder="Password">
        						<button class="btn btn-large btn-primary" type="submit">S</button>
      						</form>
                             <form action="register.php" method="post" class="form-signin" id="main3" style="position:absolute; display:none">
        						<input type="text" name="username" class="input-block-level" placeholder="Username">
        						<input type="text" name="email" class="input-block-level" placeholder="Email address">
                                <input type="text" name="address" class="input-block-level" placeholder="Street address">
                                <input type="password" name="password" class="input-block-level" placeholder="Password">
        						<button class="btn btn-large btn-primary" type="submit">S</button>
      						</form>
                </div>
                <div class="row">
                	<div class="col-sm-3"></div>
                	<div class="col-sm-2">
                    	<button class="main-btn" onClick="changeMain(1)">Search</button>
                    </div>
                    <div class="col-sm-2">
                    	<button class="main-btn" onClick="changeMain(2)">Log In</button>
                    </div>
                    <div class="col-sm-2">
                    	<button class="main-btn" onClick="changeMain(3)">Register</button>
                    </div>
                    <div class="col-sm-3"></div>
            	</div>
            
        </div>
        
        <div class="col-lg-3"></div>
        
    </div>
    </div>
  	
    <script>
	var currMain = 0;
	
	function changeMain(next) {
		$('#main' + currMain).fadeTo('slow', 0);
		$('#main' + currMain).hide();
		$('#main' + next).fadeTo('slow', 1);
		currMain = next;
	}
	
	</script>
	
</body>
