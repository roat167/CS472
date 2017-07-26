
<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="assets/css/viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
		<!-- Exercise 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have 10 total songs,
			which is over 1 hours of music!
		</p>

		<!-- Exercise 2: Top Music News (Loops) -->
		<!-- Exercise 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>		
			<ol>
				<?php				
				$page_num = 5;
				if(isset($_GET["newspages"])) {
					$page_num = (int) $_GET["newspages"];
				}
				for ($i = 1; $i <= $page_num ; $i++) { ?>						
					<li><a href="http://music.yahoo.com/news/archive/<?php echo $i ?>.html">Page <?php echo $i ?></a></li>
				<?php
				}
				?>				
			</ol>
		</div>

		<!-- Exercise 4: Favorite Artists (Arrays) -->
		<!-- Exercise 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php 
					$file_path = "favorite.txt";
					$artist_names = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					foreach ($artist_names as$names) {
				?>
					<li><?php echo $names?></li>
				<?php
					}
				?>				
			</ol>
		</div>
		
		<!-- Exercise 6: Music (Multiple Files) -->
		<!-- Exercise 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<!--
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/be-more.mp3">be-more.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/just-because.mp3">just-because.mp3</a>
				</li>

				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/drift-away.mp3">drift-away.mp3</a>
				</li>
				-->
				<!-- Exercise 8: Playlists (Files)
				<li class="playlistitem">472-mix.m3u:
					<ul>
						<li>Hello.mp3</li>
						<li>Be More.mp3</li>
						<li>Drift Away.mp3</li>
						<li>190M Rap.mp3</li>
						<li>Panda Sneeze.mp3</li>
					</ul>
				</li>
 				-->

				<?php 
					$music_items = array_filter(glob('songs/*.mp3'), 'is_file');
					//sort the music based on file size
					usort($music_items,'sort_by_size');
					foreach ($music_items as $item) {
				?>					
						<li class="mp3item">
							<a href="<?php echo $item ?>"><?php echo basename($item) ?></a> 
							(<?php echo (ceil(filesize($item) / 1024))?> KB)							
						</li>					
				<?php
					}
				$m3u_items = array_filter(glob('songs/*.m3u'), 'is_file'); 					
				foreach ($m3u_items as $list) {
				?>
				<li class="playlistitem"> <?php echo basename($list) ?>:				
					<ul>
						<?php
						$mitems = file($list, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);					
						foreach ($mitems as $m3u) {
							if (strpos($m3u, "#") !== 0) {
						?>
								<li><?php echo $m3u ?></li>
						<?php
							}
						}
						?>
					</ul>
				</li>
				<?php
				}
				?>
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
<?php 
	function sort_by_size($a,$b) {		
		return get_file_size($b)-get_file_size($a);
	}
	function get_file_size($item) {
		return ceil(filesize($item) / 1024);
	}
?>

