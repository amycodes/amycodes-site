<?php
include 'TwitterAPIExchange.php';
include __DIR__ . "/../../classes/TwitterPost.php";

$settings = array(
    'oauth_access_token' => "100556024-cGmD4m7juWI3cisVIWQOLRcZC10eRVvxf432OI39",
    'oauth_access_token_secret' => "K5TV5sOkS4s9qhWpMwIufCBXMnUyW5IVYLGyFAMCPYl4n",
    'consumer_key' => "5D1jnbFmg6ei3FZxhBB2GJew7",
    'consumer_secret' => "y6UZabBosvxKbu9EdynITKYIn9oDxtKzIWxfBdIriwYeJ05SLm"
);

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=nerdypaws';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$tweets = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());
$posts = array();
foreach ($tweets as $tweet) {
    if ( strpos($tweet->source, "tumblr") !== FALSE )
            continue;
    $tweet_url = "http://www.twitter.com/nerdypaws/status/" . $tweet->id;
    $posts[] = new TwitterPost(date_create($tweet->created_at), "Twitter", $tweet_url, $tweet->text );
    //echo $tweet->text;
}
foreach ($posts as $post) {
    echo $post->toHTML();
}
// print_r($tweets);