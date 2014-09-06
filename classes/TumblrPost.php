<?php

include_once 'GenericSocialPost.php';
/**
 * Description of TwitterPost
 *
 * @author amynegrette
 */
class TumblrPost extends GenericSocialPost {
    
    private $content;
    private $type;
    
    function __construct($date, $network, $url, $type, $content) {
        parent::__construct($date, $network, $url);
        $this->type = $type;
        $this->content = $content;
    }
    
    function toHTML() {
        if ( $this->type == "photo" ) {
            $content = "";
            foreach ( $this->content["photos"] as $photo ) {
                $content .= "<img src='" . $photo->url ."'/>";
            }
            $content .= $this->content["caption"];
        } else if ( $this->type == "quote" ) {
            $content = $this->content["text"];
            $content .= " -- " . $this->content["source"];
        } else if (isset($this->content["body"])) {
            $content = $this->content["body"];
        } else { 
           print_r($this);
        }
        if ( isset($content) )
        return parent::toHTML($content);
    }
}
