<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link href="./assets/css/movie.css" type="text/css" rel="stylesheet">
	</head>

	<body>		
		<div id="banner">			
			<img src="./images/banner.png" alt="Rancid Tomatoes">
		</div>
		<?php 
			/*
			Getting movie name from http request, 
			$movie_name will be use as absolute path for getting movie info, overview and rating,
			assume that the page will always provide with 'film' param, so we don't need to use 'isset'' here
			*/
			$movie_name = $_GET["film"];
			/*$info_arr: read text file from info.txt based on given movie name 
			 it will store in array form 
			 the first index $info_arr[0] is movie titile, $info_arr[1] is year of published
			 and the last index $info_arr[2] represent the movie rating
			 */
			$info_arr = file($movie_name. "/info.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

			$title = $info_arr[0] ." ". $info_arr[1];
			$rating = $info_arr[2];
			
		?>
		<h1><?php echo $title ?></h1>
		<div id="content">
			<div id="content-right">
				<div class="overview-img">
					<img src="./<?php echo $movie_name ?>/overview.png" alt="general overview">
				</div>
				<dl>
					<?php
					/*
					$overview_arr: read file from overview.txt
					Each pair of neighboring lines contains the title and value for one item of information, 
					to be displayed as a definition list term (dt) and its description (dd)
					*/
						$overview_arr = file($movie_name. "/overview.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						foreach ($overview_arr as $overview) {
							$overview_pair = explode(":", $overview); 
					?>		
							<dt><?php echo $overview_pair[0] ?></dt>
							<dd><?php echo $overview_pair[1] ?></dd>
					<?php							
						}
					 ?>					
				</dl>
			</div>
			<div id="content-left">
				<div id="banner-left">
					<?php 
						$tmt_banner = "rottenbig.png";
						if ($rating >= 60) {
							$tmt_banner = "freshbig.png";
						}
					?>
					<img src="./images/<?php echo $tmt_banner ?>" alt="Rotten">
					<?php echo $rating ?>%
				</div>
				<?php 					
					//Get all text file which name start by 'review' and store as array 				
					$review_arr = array_filter(glob($movie_name.'/review*.txt'), 'is_file'); 

					//find the mid value of total review
					$count = count($review_arr);
					$mid = ceil($count / 2);				
			
					//Review on the left
					display_review("section-left", 0, $mid, $review_arr);
					//Review on the right
					display_review("section-right", $mid, $count, $review_arr);
				?>				
			</div>

			<div id="bottom-page">
				<p>(1-<?php echo $count ?>) of <?php echo $count ?></p>
			</div>
			<div id="validation-tool">
				<a href="http://validator.w3.org/check/referer">
					<img src="./images/w3c-html.png" alt="Valid HTML5">
				</a> 
				<br>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img src="./images/w3c-css.png" alt="Valid CSS">
				</a>
			</div>
		</div>
	</body>
</html>
		<?php
		//this function is use for display the review content
		function display_review($section_cls, $start, $end, $reviews) {
		?>
    		<div id="<?php echo $section_cls?>">
				<?php							
				for ($i = $start; $i < $end ; $i++) {							
				/*
				Read content from review text file and store data for the review, person, review img and the publication
				*/
				$review_cont = file($reviews[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);	
				$review_text = $review_cont[0];
				$review_img = "rotten.gif";
				$review_name = $review_cont[2];
				$review_pub = $review_cont[3];

				if (strtolower($review_cont[1]) === 'fresh') {
					$review_img = "fresh.gif";
				}
				?>							
				<div class="container-review">
				<p class="reviews">
					<img src="./images/<?php echo $review_img ?>" alt="Rotten">
					<q><?php echo $review_text ?></q>
				</p>
				<p class="review-person">
					<span class="review-img"><img src="./images/critic.gif" alt="Review Image"></span>
					<span class="critic">
						<?php echo $review_name ?> <br>
						<span class="cls-italic"><?php echo $review_pub ?></span>
					</span>
				</p>
			</div>							
			<?php						
			}
			?>
		</div>
		<?php
		}
		?>