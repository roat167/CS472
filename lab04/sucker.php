<!DOCTYPE html>
<html>
	<head>
		<title>Buy Your Way to a Better Education!</title>
		<meta charset="utf-8" />
		<link href="./assets/css/buyagrade.css" type="text/css" rel="stylesheet" />
	</head>
	<?php 
		$name;
		$section;
		$cnum;
		$ctype;		
		//default error
		$err_msg = "";
		if (!isset($_POST["name"]) || !isset($_POST["section"]) 
			|| !isset($_POST["creditnumber"]) || !isset($_POST["credittype"])) {		
			$err_msg = "You didn't fill out the form completely. ";
		} else {
			$name = $_POST["name"];
			$section = $_POST["section"];
			$cnum = $_POST["creditnumber"];
			$ctype = $_POST["credittype"];
			$err_msg = validate_credit_card($cnum, $ctype);
		}		
	?>
	<body>
		<?php 
		if (!empty($err_msg)) {
		?>
			<h1>Sorry</h1>
			<p> <?= $err_msg; ?>
				<a href="./buyagrade.html">Try again?</a>
			</p>
		<?php
		} 
		else {		
		?>
			<h1>Thanks, sucker!</h1>
			<p>Your information has been recorded.</p>
			<dl>
				<dt>Name</dt>
				<dd>
				<?= $name; ?>
				</dd>

				<dt>Section</dt>
				<dd>
				<?= $section?>
				</dd>

				<dt>Credit Card</dt>
				<dd>
					<?= $cnum." (".$ctype.")"; ?>
				</dd>
			</dl>
		<?php
			save_sucker_record($name, $section, $cnum, $ctype); 
		?>
			<p>Here are all the suckers who have submitted here</p>
			<pre><?=read_sucker_records(); ?></pre>
		<?php			
			unset($_POST);
		}
		?>
	</body>
</html> 

<?php 
    /*
    This function used for saving post data and save it to text file
    @param $name student/sucker's name
    @param $section section type 
    @param $cn  credit number
    @param $ctype  credit type (ex: visa, mastercard)
    */	
    function save_sucker_record($name, $section, $cn, $ctype) {
        //sample format to be written is 'Ryan;MA;1234123412341234;visa''        
        $data = $name.";".$section.";".$cn.";".$ctype."\n";
        file_put_contents("sucker.txt", $data, FILE_APPEND);
    }

	function read_sucker_records() {
		return file_get_contents("sucker.txt");
	}

	/*
	The length of credit card is exactly 16
	if credittype is visa it should start by 4
	and 5 for master card
	*/
	function validate_credit_card($cnum, $ctype) {
		if (strlen($cnum) != 16 || ($ctype === "visa"  && strpos($cnum, "4") !== 0)
			|| ($ctype === "mastercard"  && strpos($cnum, "5") !== 0
			|| !check_luhn($cnum))) {
			return "You didn't provide a valid card number";
		}
		return "";
	}

	/*
	Using Luhn Checksum algorithm :
	to check if the given credit card number is valid 
	*/
	function check_luhn($cnum) {
		$sum = 0;		
		$digits = $cnum;
		
		for ($i = 15 ; $i >= 0; $i--) {
			$dig = floor(fmod($digits, 10));
			$digits /= 10;
			
			if ($i % 2 == 0) {
				$dig *= 2;
				if ($dig < 10) {
					$sum += $dig;	
				} 
				else {
					while ($dig !=0) {
						$tmp = $dig % 10;
						$dig /= 10;
						$sum += $tmp;
					}
				}
			}
			 else { // index odd add digit to sum
				$sum += $dig;
			}			
		}
		return ($sum % 10 == 0);
	}
?>
