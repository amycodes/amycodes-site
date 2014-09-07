<?php

include_once 'GenericSocialPost.php';

class GitHubPost extends GenericSocialPost {
    
    private $post;
    
    function __construct($date, $network, $url, $post) {
        parent::__construct($date, $network, $url);

        $this->post = $post;
    }
    
    public static function create_from_html($html_post) {
        $date = GitHubPost::scrape_date($html_post);
        $network = "GitHub";
        $url = GitHubPost::scrape_url($html_post);
        $post = GitHubPost::format_post($html_post);
        return new GitHubPost($date, $network, $url, $post);
    }
    
    private function scrape_date($html) {
        $pos = strpos($html, "datetime") + 10;
        return date_create(substr($html, $pos, 20));
    }
    
    private function scrape_url($html) {
        if (strpos($html, "starred") !== FALSE) {
            $starred_pos = strpos($html, "starred");
            $start = strpos($html, "href", $starred_pos) + 6;
            $end = strpos($html, "\"", $start);
            $length = $end - $start;
            return substr($html, $start, $length);
        } else if (strpos($html, "created") != FALSE || strpos($html, "pushed")) {
            $tree_pos = strpos($html, "/amycodes/amycodes-site/tree/");
            $end_pos = strpos($html, "\"", $tree_pos);
            $length = $end_pos - $tree_pos;
            return "https://github.com" . substr($html, $tree_pos, $length);
        } else {
            return "https://github.com/amycodes";
        }
    }
    
    private function format_post($html) {
        $post = $html;
        if ( strpos($html , "class=\"gravatar\"") !== FALSE ) {
            $start = strpos($html , "class=\"details\"");
            $start = strpos($html, "<a" , $start);
            $end = strpos($html,"a>",$start) + 2;
            $post = substr($html, 0, $start);
            $post .= substr($html, $end);
        }
        // strip out date
        $post_with_date = $post;
        $start = strpos($post_with_date , "<div class=\"time\"");
        $end = strpos($post_with_date,"div>",$start) + 4;
        $post = substr($post_with_date, 0, $start);
        $post .= substr($post_with_date, $end);
        return $post;
    }
            
    function toHTML() {
        return parent::toHTML($this->post);
    }
}