<?php include("top.html"); ?>
<div>
    <?php
        if (validate_form()) {
            save_record();
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
    This function used for saving post data and save it to text file
    @param $data post data form submit
    */	
    function save_record() {
        //sample record order to be save: Ada Lovelace,F,96,ISTJ,Linux,24,99
        $record = $_POST['name'].",".$_POST['gender'].",".$_POST['age'].",".$_POST['ptype'].",".
                 $_POST['favos'].",".$_POST['min'].",".$_POST['max']."\r\n";
        file_put_contents("singles.txt", $record, FILE_APPEND);        
    }

    function validate_form() {
        return isset($_POST['name'], $_POST['gender'], $_POST['age'], $_POST['ptype'],
                 $_POST['favos'], $_POST['min'], $_POST['max']);        
    }
    
	function read_records() {
		return file_get_contents("singles.txt");
	}
?>
