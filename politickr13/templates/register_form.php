<form action="register.php" method="post">
    <fieldset>
        <div class="form-group" style="color:blue;">
            <label for="username">Username</label>
            <br>
            <input autofocus class="form-control" name="username" placeholder="Enter Username" type="text"/>
        </div>
        <div class="form-group" style="color:blue;">
            <label for="email">Email</label>
            <br>
            <input class="form-control" name="email" placeholder="Enter Email" type="email"/>
        </div>
        <div class="form-group" style="color:blue;">
            <label for="address">Optional: Address (e.g. 123 Potter Road, Hogwarts, MA, 02138), so that you don't have to put it in every time. We will not save this address, only your representatives.</label>
            <br>
            <input class="form-control" name="address" placeholder="Enter Full Address" type="text"/>
        </div>
		<div class="form-group" style="color:blue;">
            <label for="updatefreq"> Email Updates: After how many new votes by one of your representatives do you wish to be notified?</label>
            <br>
            <input class="form-control" name="updatefreq" placeholder="Number of Votes" type="text"/>
        </div>
        <div class="form-group" style="color:blue;">
            <label for="password" >Password</label>
            <br>
            <input class="form-control" name="password" placeholder="Enter Password" type="password"/>
        </div>
        <div class="form-group" style="color:blue;">
            <label for="confirmation">Re-enter Password</label>
            <br>
            <input class="form-control" name="confirmation" placeholder="Confirm Password" type="password"/>
        </div>
        <div class="form-group" style="color:blue;">
            <button type="submit" class="btn btn-success btn-lg">Register</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">log in</a>
</div>
