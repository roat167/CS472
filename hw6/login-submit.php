<?php include("db-connection.php");?>
<?php     
    $user = login($db, $_POST['name'], $_POST['password']);
    if ($user->rowCount() == 0) { // result doesn't match redirect back to login
        header('Location: login.php?errorMsg=Invalid username or password');
    } else {
        $user = $user->fetch();
        session_start();
        $_SESSION['username'] = $user["name"];

        $matches = get_match_users($db, $user);
        $_SESSION['matches'] = $matches->fetchAll();
        header('Location: view-match.php');
    }

    function login($db, $name, $pass) {
        $rows = $db->prepare("SELECT * FROM singles WHERE name = :name AND pass = :pass_hash");
        $pass_hash = hash("sha256", $pass . $name);
        $rows->execute(array(':name' => $name,
                             ':pass_hash' => $pass_hash
                             )
                        );
        return $rows;
    }

    /*
    * query all matched users 
    */
    function get_match_users ($db, $data) {
        $rows = $db->prepare("SELECT * FROM singles WHERE gender <> :gender 
                        AND age >= :min AND age <= :max AND os = :os AND
                        (type1 = :type1 OR type2 = :type2 OR type3 = :type3 OR type4 = :type4)"
                    );        
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