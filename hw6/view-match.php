<?php include("db-connection.php");?>
<?php include("top.html"); ?>
<div>
    <?php 
            session_start();
            if (!isset($_SESSION['username'])) {
                header('Location: login.php?errorMsg=Please login first');
            }
    ?>
    <h2>Matches for <?=$_SESSION['username']?> 
    <a class="button" href="logout.php">Logout</a>
     </h2>
    <div id="content">
        <?php 
        $matches = $_SESSION['matches'];
        $mtc = 0;
        $len = count($matches);
        if ($len > 0) {
            //Check if parameter match exists and valid(value smaller than total number of matches)        
            if (isset($_GET['match']) && $_GET['match'] < $len) {
                $mtc = $_GET['match'];
            }   
            
            $u = $matches[$mtc];
            ?>
            <div class ="match">     
                <p><img src = "./images/user.jpg" /> <?=$u['name'] ?></p>            
                <ul>
                    <li><strong>gender:</strong> <span class="columns"><?=$u['gender'] ?></span></li>
                    <li><strong>age:</strong> <span class="columns"><?=$u['age'] ?></span></li>
                    <li><strong>type:</strong> <span class="columns"><?=$u['type1'].$u['type2'].$u['type3'].$u['type4'] ?></span></li>
                    <li><strong>OS:</strong> <span class="columns"><?=$u['os'] ?></span></li>
                </ul>           
            </div>
            <div class="nav-match">
                <?php
                if($mtc > 0) {
                ?>
                <a href="view-match.php?match=<?=$mtc-1?>">Previous Match </a>
                <span> </span>      
                <?php 
                }
                if($mtc < $len - 1) {
                ?>
                    <a href="view-match.php?match=<?=$mtc+1?>">Next Match </a>       
                <?php 
                }
            }
            ?>
        </div>     
    </div>    
</div>
<?php include("bottom.html"); ?>
    