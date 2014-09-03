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
include 'iSocialFeed.php';
include 'lib/Twitter-API/TwitterAPIExchange.php';
include 'classes/TwitterPost.php';

class TwitterFeed implements iSocialFeed {

    private $settings;

    public function __construct() {
        $this->settings = array(
            'oauth_access_token' => "",
            'oauth_access_token_secret' => "",
            'consumer_key' => "",
            'consumer_secret' => "");
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
