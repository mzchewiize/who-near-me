<?php

require_once('TwitterAPIExchange.php');
$cache = 3600;
$settings = array(
    'oauth_access_token' => "68617230-Ypk5w034wk0jaUmEannAinwmuiQO7hJig7RhgAs04",
    'oauth_access_token_secret' => "8EsEwTf1VMnAznQUqT2unzMwgz5gAUVylSNmIzxvks1Yc",
    'consumer_key' => "0cBPIgVflaNXUR44oz9nfEWq0",
    'consumer_secret' => "7PYnHJcmak6GrSqBioUUIJyGSpoPz36DIuj18qTiKBm6wCqw32"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$requestMethod = 'GET';

$getfield = $_GET['q'];

$m = new Memcache();
$m->addServer('localhost', 11211);

$item = $m->get($getfield);

if ($item) {
	echo $m->get($getfield);
} else {
	$twitter = new TwitterAPIExchange($settings);
	$result = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
	$m->set($getfield, $result, 0, $cache);
	echo $m->get($getfield);
}
?>
