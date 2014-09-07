<?php

include_once 'iSocialFeed.php';
include_once 'GitHubPost.php';

class GitHubFeed implements iSocialFeed {
    
    private function readXML() {
        $json_url = "https://github.com/amycodes.atom";
        //echo "[json_url] $json_url \n";
        $ch = curl_init( $json_url );
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
        );
        curl_setopt_array( $ch, $options );
        $result = curl_exec($ch);
        curl_close($ch);
        
        $p = xml_parser_create();
        xml_parse_into_struct($p, $result, $vals, $index);
        xml_parser_free($p);

        return $vals;
    }

    public function getFeedPosts() {
        $xml_arr = $this->readXML();
        $posts = array();
        foreach ( $xml_arr as $key => $value ) {
            if ( $value["tag"] == "CONTENT")
                $posts[] = GitHubPost::create_from_html ($value["value"]);
        }
        return $posts;
    }

}