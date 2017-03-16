<html lang="en-US">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width"/>
	<!-- Powered by E. Zachary Knight and Divine Knight Gaming's Simple Game Site Maker -->
<?PHP

$game_info = simplexml_load_file('game_info.xml');

?>
	<title><?php echo($game_info->title); ?> by <?php echo($game_info->company->name); ?></title>
	<link rel="stylesheet" href="style.css">
	<style>
		body {
			background-color: <?php echo($game_info->css->bodycolor); ?>;
		}
		.content {
			background-color: <?php echo($game_info->css->contentcolor); ?>;
			color: <?php echo($game_info->css->fontcolor); ?>;
		}
		hr {
			<?php echo($game_info->hrs); 
				$hr = "";
				if($game_info->hrs["visible"] == "yes")
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
	<?php echo($game_info->analytics); ?>
</head>
<body>
	<div class="content">
		<div class="title">
			<?php
				if($game_info->title["visible"] == "yes"){
			?>
			<h1><?php echo($game_info->title); ?></h1>
			<?php } ?>
			<img src="images/<?php echo($game_info->logo); ?>" alt="<?php echo($game_info->title); ?> by <?php echo($game_info->company->name); ?>" />
			<p><?php echo($game_info->pitch); ?></p>
			<?php
				if($game_info->buylink['link'] == "no"){
					echo("<div class=\"buyembed\">".$game_info->buylink."</div>");
				}
				else {
					echo("<div class=\"buynow\"><p><a href=\"".$game_info->buylink."\">Buy Now!</a></p></div>");
				}
			?>
		</div>
		<?php echo($hr); ?>
		<div class="trailer">
			<?php echo($game_info->trailer); ?>
		</div>
		<?php echo($hr); ?>
		<div class="info">
			<div class="rightimg">
				<img src="images/<?php echo($game_info->splashart); ?>" />
			</div>
			<div class="leftinfo">
				<h2><?php echo($game_info->subhead); ?></h2>
				<p><?php echo($game_info->description); ?></p>
				<ul>
					<?php
						foreach($game_info->features->feature as $feature){
							echo("<li>".$feature."</li>");
						}
					?>
				</ul>
			</div>
		</div>
		<?php echo($hr); ?>
		<div class="screenshots">
			<div class="imgcol1">
				<?php
					$col1 = floor(count($game_info->screenshots->screenshot)/2);
				for($i = 0;$i < $col1;$i++){
					echo("<img src=\"images/".$game_info->screenshots->screenshot[$i]."\" />");
				}
				?>
			</div>
			<div class="imgcol2">
				<?php
					$col2 = $col1*2;
				for($j = $i;$j < $col2;$j++){
					echo("<img src=\"images/".$game_info->screenshots->screenshot[$j]."\" />");
				}
				?>
			</div>
			<?php
				if(count($game_info->screenshots->screenshot)%2 == 1)
				{
					echo("<div class=\"imglast\">");
					echo("<img src=\"images/".$game_info->screenshots->screenshot[count($game_info->screenshots->screenshot)-1]."\" />");
					echo("</div>");
				}
			?>
		</div>
		<?php echo($hr); ?>
		<div class="subscribe">
			<div class="leftimg">
				<img src="images/<?php echo($game_info->subscription->image); ?>" />
			</div>
			<div class="rightsubscribe">
				<h2><?php echo($game_info->subscription->header); ?></h2>
				<p><?php echo($game_info->subscription->description); ?></p>
				<div>
					<?php 
						if($game_info->subscription->subscribe["link"] == "no"){
							echo($game_info->subscription->subscribe);
						}
						else
						{
							echo("<div class=\"subscribenow\"><p><a href=\"".$game_info->subscription->subscribe."\">Subscribe Now!</a></p></div>");
						}
					 ?>
				</div>
			</div>
		</div>
		<?php echo($hr); ?>
		<div class="social">
			<ul>
				<?php if(isset($game_info->sociallinks->facebook) && $game_info->sociallinks->facebook != ""){?>
				<li><a href="<?php echo($game_info->sociallinks->facebook); ?>"><img src="images/facebook.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->twitter) && $game_info->sociallinks->twitter != ""){?>
				<li><a href="<?php echo($game_info->sociallinks->twitter); ?>"><img src="images/twitter.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->imgur) && $game_info->sociallinks->imgur != ""){?>
				<li><a href="<?php echo($game_info->sociallinks->imgur); ?>"><img src="images/imgur.png" /></a></li>
				<?php } ?>
				<?php if(isset($game_info->sociallinks->youtube) && $game_info->sociallinks->youtube != ""){?>
				<li><a href="<?php echo($game_info->sociallinks->youtube); ?>"><img src="images/youtube.png" /></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php echo($hr); ?>
		<div class="companyinfo">
			<div class="logo">
				<a href="<?php echo($game_info->company->link); ?>"><img src="images/<?php echo($game_info->company->logo); ?>" alt="<?php echo($game_info->company->name); ?>" /></a>
			</div>
			<div class="presskit">
				<a href="<?php echo($game_info->presskit); ?>">Press kit</a>
			</div>
		</div>
	</div>
</body>
</html>
