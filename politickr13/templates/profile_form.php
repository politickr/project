<form action="display.php" method="post">
    <fieldset>
        <div>
           <?php
               echo("$Congressmen["person"]["firstname"] $Congressmen["person"]["lastname"]");   
            ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Retrieve</button>
        </div>
    </fieldset>
</form>
