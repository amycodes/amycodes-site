<?php

include_once 'GenericSocialPost.php';

class StackExchangePost extends GenericSocialPost {
    
    private $type;
    private $post;
    
    function __construct($date, $network, $url, $type, $post) {
        parent::__construct($date, $network, $url);
        $this->type = $type;
        $this->post = $post;
    }

    function toHTML() {
        return parent::toHTML($this->post);
    }

}
