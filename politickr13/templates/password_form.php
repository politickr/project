<form action="password.php" method="post">
    <fieldset>
        <div>
        <?php
            printf("Want to change your password? Follow steps below.");
        ?>
        </div>
        <div class="form-group">
            <input class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="newpassword" placeholder="New Password" type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </fieldset>
</form>
