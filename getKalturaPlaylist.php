<?php 
// Include the kaltura php api, you can get your copy here:
// http://www.kaltura.com/api_v3/testme/client-libs.php
require_once('kalturaClient/KalturaClient.php');

function getKalturaPlaylist( $partnerId, $mediaspaceUser, $mediaspaceCategory, $adminAPISecretKey ) {
	$config = new KalturaConfiguration($partnerId);
	$config->serviceUrl = 'http://www.kaltura.com/';
	$client = new KalturaClient($config);
	$ks = $client->generateSessionV2($adminAPISecretKey, $mediaspaceUser, KalturaSessionType::ADMIN, $partnerId, 86400, '');
	$client->setKs($ks);
	$filter = new KalturaMediaEntryFilter();
	$filter->categoriesMatchOr = $mediaspaceCategory;
	$result = $client->media->listAction($filter);
	return $result->objects;
}

?>