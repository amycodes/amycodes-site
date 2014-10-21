<?php

/**
 * Description of StackExchangeFeed
 *
 * @author amynegrette
 */
include_once 'iSocialFeed.php';
include_once 'StackExchangePost.php';

class StackExchangeFeed implements iSocialFeed {

    private $stackexchange_id = 4620852;
    
    public function getFeedPosts() {
        $url = "http://api.stackexchange.com/2.2/users/" . $this->stackexchange_id . "/network-activity";
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
            CURLOPT_ENCODING => 'identity'
        );
        curl_setopt_array( $ch, $options );

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        
        $posts = array();
        foreach ( $results["items"] as $se_post ) {
            if ( !in_array($se_post["api_site_parameter"], array("stackoverflow", "programmers", "meta.stackoverflow", "serverfault", "webapps"))) continue;
            $date = new DateTime();
            $date = date_timestamp_set($date, $se_post["creation_date"]);
            $network = "StackExchange";
            $type = $se_post["activity_type"];
            $post = $se_post["title"];
            $url = "http://stackexchange.com/users/" . $this->stackexchange_id;
            if ( $se_post["activity_type"] == "badge_earned" ) {
                if ( strpos($se_post["api_site_parameter"], "stackoverflow") !== FALSE ||
                        strpos($se_post["api_site_parameter"], "serverfault") !== FALSE) {
                    $link = "http://" . $se_post["api_site_parameter"] . ".com";
                }
                else 
                    $link = "http://" . $se_post["api_site_parameter"] . ".stackexchange.com";
                $post = "Earned " . $se_post["title"] . " Badge on <a href='$link'>$link</a>!";
            } else if ( $se_post["activity_type"] == "answer_posted" ) {
                $url = $se_post["link"];
                $post = "Answered the question: " . $se_post["title"];
            }
            $posts[] = new StackExchangePost($date,$network,$url,$type,$post);
        }
        return $posts;
    }

}
