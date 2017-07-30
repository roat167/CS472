<?php include("db-connection.php");?>
<?php include("top.html");?>
<div>
    <?php
        if (validate_form()) {
            save_record($db);
            header('Location: result.php?name='.$_POST["name"].'');    
        } 
        else {
    ?>
            <h2> Failed </h2>
    <?php
        }
    ?>
</div>
<?php include("bottom.html"); ?>

<?php
 /*
    This function used for saving post data and save it to database singles
    @param $data post data form submit
    */	
    function save_record($db) {        
        $query = "INSERT INTO singles VALUES (NULL, :name, :pass_hash, :gender, :age, :type1,
                    :type2, :type3, :type4, :os, :min, :max)";        
        $rows = $db->prepare($query);
        $ptype = $_POST['ptype'];
        $pass_hash = hash("sha256", $_POST['password'] . $_POST['name']);

        $rows->execute(array(':name' => $_POST['name'],
                             ':pass_hash' => $pass_hash,
                             ':gender' => $_POST['gender'],
                             ':age' => $_POST['age'],
                             ':type1' => $ptype[0],
                             ':type2' => $ptype[1],
                             ':type3' => $ptype[2],
                             ':type4' => $ptype[3],
                             ':os' => $_POST['favos'],
                             ':min' => $_POST['min'],
                             ':max' => $_POST['max']
                            )
                        );
    }

    function validate_form() {
        return isset($_POST['name'], $_POST['password'], $_POST['gender'], $_POST['age'], $_POST['ptype'],
                 $_POST['favos'], $_POST['min'], $_POST['max']);        
    }
    
	function read_records() {
		return file_get_contents("singles.txt");
	}
?>
