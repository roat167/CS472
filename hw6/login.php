<?php include("top.html"); ?>
<div>
    <?php
    if(isset($_GET['errorMsg'])) {
    ?>
    <p class="error_msg"> <?=$_GET['errorMsg']?></p>
    <?php 
    }
    ?>
    <form action="login-submit.php" method="POST">
        <fieldset>
            <legend>Returning User:</legend>
            <p>
                <label><strong>Name:</strong></label>
            </p>
            <div class="column">
                <input name="name" type="text" size="16">
            </div>
            <br>
            <p>
                <label><strong>Password:</strong></label>
            </p>
            <div class="column">
                <input name="password" type="password" size="16">
            </div> 
            <br>
            <p>
                <input type="submit" value="Login">
            </p>
        </fieldset>        
    </form>
</div>
<?php include("bottom.html"); ?>