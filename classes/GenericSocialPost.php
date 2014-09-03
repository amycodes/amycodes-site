<?php
/**
 * GenericSocialPost
 *
 * @author amynegrette
 */
class GenericSocialPost {
    private $date;
    private $network;
    private $url;
    
    public function __construct($date, $network, $url) {
        $this->date = $date;
        $this->network = $network;
        $this->url = $url;
    }
    
    public function toHTML($text = NULL) {
        
        $html = "<div class='social_post_network'><a href=\"" . $this->url . "\">" . strtolower($this->network) . "</a></div>";
        $html .= "<div class='social_post_date'>" . date_format($this->date, "Y/m/d g:i a") . "</div>";
        //$html .= "<div class='social_post'>$text <a href='$this->url'>" . date_format($this->date, "Y-m-d") . " on " . $this->network . "</a></div>";
        
        $html .= "<div class = \"social_post\">"; 
        if ( $text ) $html .= "<div class = \"content\">" . $text . "</div>";
        $html .= "</div>";
        // $html .= "<div class=\"stats\"><div class=\"date\">" . date_format($this->date, "Y-m-d") . "</div><div class=\"link\"><a href=\"" . $this->url . "\">See on " . $this->network. "</a></div></div></div>";
        
        return $html;
        
    }
    
}
