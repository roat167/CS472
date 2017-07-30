<?php include("db-connection.php");?>
<?php include("top.html"); ?>
<div>
    <h2>Matches for <?=$_POST['name']?>  </h2>
    <div id="content">
        <?php             
            $name = $_POST['name'];
            $user = get_user($db, $name);
            $lines = get_match_users($db, $user);
            //Assume that the given name always exist in File           
            foreach($lines as $u) {                
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
        <?php                 
            }
        ?>
    </div>    
</div>
<?php include("bottom.html"); ?>

<?php 
    function get_user($db, $name) {
        $rows = $db->prepare("SELECT * FROM singles WHERE name = :name AND pass = :pass_hash");
        $pass_hash = hash("sha256", $_POST['password'] . $_POST['name']);
        $rows->execute(array(':name' => $_POST['name'],
                             ':pass_hash' => $pass_hash
                             )
                        );
        return $rows;
    }

    function get_match_users ($db, $user) {
        $rows = $db->prepare("SELECT * FROM singles WHERE gender <> :gender 
                        AND age >= :min AND age <= :max AND os = :os AND
                        (type1 = :type1 OR type2 = :type2 OR type3 = :type3 OR type4 = :type4)"
                    );
        $data = $user->fetch();        
        $rows->execute(array(':gender' => $data['gender'],                             
                             ':type1' => $data['type1'],
                             ':type2' => $data['type2'],
                             ':type3' => $data['type3'],
                             ':type4' => $data['type4'],
                             ':os' => $data['os'],
                             ':min' => $data['min'],
                             ':max' => $data['max']
                            )
                        );
        return $rows;     
    }    
?>