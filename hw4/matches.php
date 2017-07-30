<?php include("top.html"); ?>
<div>
    <form action="matches-submit.php" method="GET">
        <fieldset>
            <legend>Returning User:</legend>
            <p>
                <label><strong>Name:</strong></label>
            </p>
            <div class="column">
                <input name="name" type="text" size="16">
            </div>
            <p></p>   
            <br>
            <p>
                <input type="submit" value="View My Matches">
            </p>
        </fieldset>        
    </form>
</div>
<?php include("bottom.html"); ?>