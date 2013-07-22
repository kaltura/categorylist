<?php 
// Include the kaltura php api, you can get your copy here:
// http://www.kaltura.com/api_v3/testme/client-libs.php
require_once('kalturaClient/KalturaClient.php');

function getKalturaPlaylist( $partnerId, $adminAPISecretKey, $user, $category, $categoryReferenceId) {
	$config = new KalturaConfiguration($partnerId);
	$config->serviceUrl = 'http://www.kaltura.com/';
	$client = new KalturaClient($config);
	$ks = $client->generateSessionV2($adminAPISecretKey, $user, KalturaSessionType::ADMIN, $partnerId, 86400, '');
	$client->setKs($ks);
	$filter = new KalturaMediaEntryFilter();
	//if ($category != '' && $category != null)
		//$filter->categoriesMatchOr = $category;
	if ($categoryReferenceId != '' && $categoryReferenceId != null) {
		$catFilter = new KalturaCategoryFilter();
		$catFilter->referenceIdEqual = $categoryReferenceId;
		$category = $client->category->listAction($catFilter);
		if ($category->totalCount > 0) {
			$filter->categoriesIdsMatchOr = $category->objects[0]->id;
			print $category->id;
		}
	}
	$result = $client->media->listAction($filter);
	return $result->objects;
}

?>