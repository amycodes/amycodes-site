<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TwitterFeed
 *
 * @author amynegrette
 */
include_once 'iSocialFeed.php';
include_once 'lib/Twitter-API/TwitterAPIExchange.php';
include_once 'classes/TwitterPost.php';

class TwitterFeed implements iSocialFeed {

    private $settings;

    public function __construct() {
        $this->settings = array(
            'oauth_access_token' => "100556024-cGmD4m7juWI3cisVIWQOLRcZC10eRVvxf432OI39",
            'oauth_access_token_secret' => "K5TV5sOkS4s9qhWpMwIufCBXMnUyW5IVYLGyFAMCPYl4n",
            'consumer_key' => "5D1jnbFmg6ei3FZxhBB2GJew7",
            'consumer_secret' => "y6UZabBosvxKbu9EdynITKYIn9oDxtKzIWxfBdIriwYeJ05SLm");
    }

    public function getFeedPosts() {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=nerdypaws';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->settings);
        $tweets = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());
        $posts = array();
        foreach ($tweets as $tweet) {
            if (strpos($tweet->source, "tumblr") !== FALSE)
                continue;
            $tweet_url = "http://www.twitter.com/nerdypaws/status/" . $tweet->id;
            $posts[] = new TwitterPost(date_create($tweet->created_at), "Twitter", $tweet_url, $tweet->text);
            //echo $tweet->text;
        }
        return $posts;
    }

}
