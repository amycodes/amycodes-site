<?php

include_once 'GenericSocialPost.php';
/**
 * Description of TwitterPost
 *
 * @author amynegrette
 */
class TwitterPost extends GenericSocialPost {
    
    private $tweet;
    function __construct($date, $network, $url, $tweet) {
        parent::__construct($date, $network, $url);

        $this->tweet = $tweet;
    }
    
    function toHTML() {
        return parent::toHTML($this->tweet);
    }
}
