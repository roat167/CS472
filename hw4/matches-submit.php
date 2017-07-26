<?php include("top.html"); ?>
<div>
    <h2>Matches for <?=$_GET['name']?>  </h2>
    <div id="content">
        <?php 
            $lines = file('singles.txt');
            $name = $_GET['name'];
            $user = get_user($name, $lines);  
            //Assume that the given name always exist in File           
            foreach($lines as $line) {
                $u = get_match_user($line);
                if (is_matched($u, $user)) {            
        ?>
        <div class ="match">     
            <p><img src = "./images/user.jpg" /> <?=$u[0] ?></p>            
            <ul>
                <li><strong>gender:</strong> <span class="columns"><?=$u[1] ?></span></li>
                <li><strong>age:</strong> <span class="columns"><?=$u[2] ?></span></li>
                <li><strong>type:</strong> <span class="columns"><?=$u[3] ?></span></li>
                <li><strong>OS:</strong> <span class="columns"><?=$u[4] ?></span></li>
            </ul>            
        </div>
        <?php 
                }
            }
        ?>
    </div>    
</div>
<?php include("bottom.html"); ?>

<?php 
    function get_user($name, $lines) {
        //match letter at the start of line
        $pattern = "/^.*$name./";        
        $res = preg_grep($pattern, $lines);
        if (count($res) > 0) {
            return explode(",", end($res));
        }
        return null;
    }

    function get_match_user ($data) {
        return explode ("," , $data);
    }

    /** This function compare if user is matches based on following criteria
    Opposite gender
    Compatible age: $cur age should between $user min and max age
    Have the same favorite OS
    Share at least one personality type, which in the same index eg: ISTP and ESFJ
    */
    function is_matched($cur, $user) {
        //ensure not match with themselve
        if ($user[0] == $cur[0] && $user[1] == $cur[1]) {
            return false;
        }

        if ($cur[1] != $user[1] && age_matched($cur[2], $user[5], $user[6])
            && $cur[4] == $user[4] && type_matched($cur[3], $user[3])) {
                return true;
        }
        return false;      
    }

    function age_matched($age, $min, $max) {
        return $age >= $min && $age <= $max;
    }

    //Assume that the input data is always correct, means personality type string have the same length = 4
    function type_matched($ctype, $utype) {
        for ($i = 0; $i < strlen($ctype) ; $i++) {
            if ($ctype[$i] == $utype[$i]) {
                return true;
            }
        }
        return false;
    }    
?>