<?php
	//Fill here your account settings:
	$partnerId = 0; //taken from KMC>Settings>Integration Settings
	$adminAPISecretKey = '-----'; //taken from KMC>Settings>Integration Settings
	$playerUiConf = '----'; //taken from KMC>Studio
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Category based page playlist</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!-- include the player library -->
	<script type="text/javascript" src="http://www.kaltura.com/p/<?php echo $partnerId; ?>/sp/<?php echo $partnerId; ?>00/embedIframeJs/uiconf_id/<?php echo $playerUiConf; ?>/partner_id/<?php echo $partnerId; ?>"></script>
	<link rel="stylesheet" href="style.css">
<head>
<body>
	<h1>Click on a thumbnail to load the video</h1>
	<div id="kaltura_player" style="width:560px;height:330px;"></div>
	<div style="clear:both;margin-bottom: 30px;"></div>
	
	<?php 
		include_once('getKalturaPlaylist.php');
		$playlist = getKalturaPlaylist( $partnerId, $_GET['kmsuser'], $_GET['kmscategory'], $adminAPISecretKey );
	?>
	<ul class="thumbnails">
	<?php 
		foreach( $playlist as $key => $entry ) :
			$entry =  (array)$entry;
	?>
			<li itemscope itemtype="http://schema.org/VideoObject" class="kaltura-video span2">
				<meta itemprop="duration" content="<?php echo $entry['duration'] ?>"
				<meta itemprop="thumbnailURL" content="<?php echo $entry['thumbnailUrl'] ?>">
				<a data-entryid="<?php echo $entry['id'] ?>" href="#" class="thumbnail" title="<?php echo $entry['name'] ?>">
					<img alt="<?php echo htmlspecialchars( $entry['name'] )?>"  style="width: 160px; max-height: 120px;" 
					src="<?php echo $entry['thumbnailUrl'] ?>/width/160" >
				</a>
				<span itemprop="description"><?php echo htmlspecialchars( $entry['name'] )?></span>
			</li>
	<?php 
		endforeach;
	?>
	</ul>
	
	<script>
		kWidget.embed({
			'targetId': 'kaltura_player',
			'wid': '_<?php echo $partnerId; ?>',
			'uiconf_id' : '<?php echo $playerUiConf; ?>',
			'readyCallback': function( playerId ){
				var kdp = $( '#' + playerId ).get(0);
				$('li.kaltura-video').click(function(){
					var entryId = $(this).find('a').attr('data-entryid');
					kdp.sendNotification('changeMedia', {'entryId': entryId } );
				})
			}
		});
	</script>
</body>
</html>
