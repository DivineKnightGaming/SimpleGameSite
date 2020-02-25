<html lang="en-US">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width"/>
	<!-- Powered by E. Zachary Knight and Divine Knight Gaming's Simple Game Site Maker -->
<?php
$game_info = simplexml_load_file('game_info.xml');
?>
	<title><?= $game_info->title ?> by <?= $game_info->company->name ?></title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		body {
			background-color: <?= $game_info->css->bodycolor ?>;
		}
		.content {
			background-color: <?= $game_info->css->contentcolor ?>;
			color: <?= $game_info->css->fontcolor ?>;
		}
		hr {
			<?php echo($game_info->css->hrs); 
				$hr = "";
				if($game_info->css->hrs["visible"] == "yes")
				{
					$hr = "<hr />";
				}
			?>
		}		
		div .info {
			<?php
			list($width, $height, $type, $attr) = getimagesize("images/".$game_info->splashart);
			echo("//height: ".($height+20)."px;");
			?>
		}
	</style>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<?php if($game_info->screenshots["slideshow"] == "no"): ?>
		<script src="js/lightbox/lightbox.js"></script>
		<link href="css/lightbox/lightbox.css" rel="stylesheet">
	<?php else: ?>
		<link  href="css/slider/fotorama.css" rel="stylesheet">
		<script src="js/slider/fotorama.js"></script>
	<?php endif; ?>
	
	<?= $game_info->analytics ?>
</head>
<body>
	<div class="content">
		<div class="title">
			<?php if($game_info->title["visible"] == "yes") { ?>
				<h1><?= $game_info->title ?></h1>
			<?php } ?>
			<img src="images/<?= $game_info->logo ?>" alt="<?= $game_info->title ?> by <?=$game_info->company->name ?>" />
			<p><?= $game_info->pitch ?></p>
			<?php if($game_info->buylink['link'] == "no"){ ?>
				<div class="buyembed"><?= $game_info->buylink ?></div>
			<?php } else { ?>
				<div class="buynow"><p><a href="<?= $game_info->buylink ?>">Buy Now!</a></p></div>
			<?php } ?>
		</div>
		<?= $hr ?>
		<div class="trailer">
			<?= $game_info->trailer ?>
		</div>
		<?= $hr ?>
		<div class="info">
			<div class="rightimg">
				<img src="images/<?= $game_info->splashart ?>" />
			</div>
			<div class="leftinfo">
				<h2><?= $game_info->subhead ?></h2>
				<p><?= $game_info->description ?></p>
				<ul>
				<?php foreach($game_info->features->feature as $feature){ ?>
					<li><?= $feature ?></li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<?= $hr ?>
		<div class="screenshots">
			<?php if($game_info->screenshots["slideshow"] == "no") { ?>
				<div class="imgcol1">
					<?php $col1 = floor(count($game_info->screenshots->screenshot)/2);
					for($i = 0;$i < $col1;$i++){ ?>
						<a href="images/<?= $game_info->screenshots->screenshot[$i] ?>" data-lightbox="screenshot-set" data-title="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>">
							<img src="images/<?= $game_info->screenshots->screenshot[$i] ?>" alt="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>" />
						</a>
					<?php } ?>
				</div>
				<div class="imgcol2">
					<?php $col2 = $col1*2;
					for($j = $i;$j < $col2;$j++){ ?>
						<a href="images/<?= $game_info->screenshots->screenshot[$i] ?>" data-lightbox="screenshot-set" data-title="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>">
							<img src="images/<?= $game_info->screenshots->screenshot[$j] ?>" alt="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>" />
						</a>
					<?php } ?>
				</div>
				<?php if(count($game_info->screenshots->screenshot)%2 == 1) { ?>
						<div class="imglast">
							<a href="images/<?= $game_info->screenshots->screenshot[$i] ?>" data-lightbox="screenshot-set" data-title="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>">
								<img src="images/<?= $game_info->screenshots->screenshot[count($game_info->screenshots->screenshot)-1] ?>" alt="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>" />
							</a>
						</div>
					<?php } 
					
			} else { ?>
				<div class="fotorama"  data-nav="thumbs">
					<?php for($i = 0;$i < count($game_info->screenshots->screenshot);$i++){ ?>
						<img src="images/<?= $game_info->screenshots->screenshot[$i] ?>" alt="<?= $game_info->screenshots->screenshot[$i]["alt"] ?>" />
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?= $hr ?>
		<div class="subscribe">
			<div class="leftimg">
				<img src="images/<?= $game_info->subscription->image ?>" />
			</div>
			<div class="rightsubscribe">
				<h2><?= $game_info->subscription->header ?></h2>
				<p><?= $game_info->subscription->description ?></p>
				<div>
					<?php if($game_info->subscription->subscribe["link"] == "no"){
						echo($game_info->subscription->subscribe);
					} else { ?>
						<div class="subscribenow">
							<p><a href=" <?= $game_info->subscription->subscribe ?>">Subscribe Now!</a></p>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?= $hr ?>
		<div class="social">
			<ul>
				<?php if(isset($game_info->sociallinks->facebook) && $game_info->sociallinks->facebook != ""){?>
					<li><a href="<= $game_info->sociallinks->facebook ?>"><img src="images/facebook.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->twitter) && $game_info->sociallinks->twitter != ""){?>
					<li><a href="<?= $game_info->sociallinks->twitter ?>"><img src="images/twitter.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->googleplus) && $game_info->sociallinks->googleplus != ""){?>
					<li><a href="<?= $game_info->sociallinks->googleplus ?>"><img src="images/google-plus.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->tumblr) && $game_info->sociallinks->tumblr != ""){?>
					<li><a href="<?= $game_info->sociallinks->tumblr ?>"><img src="images/tumblr.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->instagram) && $game_info->sociallinks->instagram != ""){?>
					<li><a href="<?= $game_info->sociallinks->instagram ?>"><img src="images/instagram.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->imgur) && $game_info->sociallinks->imgur != ""){?>
					<li><a href="<?= $game_info->sociallinks->imgur ?>"><img src="images/imgur.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->youtube) && $game_info->sociallinks->youtube != ""){?>
					<li><a href="<?= $game_info->sociallinks->youtube ?>"><img src="images/youtube.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->vimeo) && $game_info->sociallinks->vimeo != ""){?>
					<li><a href="<?= $game_info->sociallinks->vimeo ?>"><img src="images/vimeo.png" /></a></li>
				<?php } ?>
			</ul>
		</div>
		<?= $hr ?>
		<div class="companyinfo">
			<div class="logo">
				<a href="<?= $game_info->company->link ?>"><img src="images/<?= $game_info->company->logo ?>" alt="<?= $game_info->company->name ?>" /></a>
			</div>
			<div class="presskit">
				<a href="<?= $game_info->presskit ?>">Press kit</a>
			</div>
		</div>
	</div>
</body>
</html>
