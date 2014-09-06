<?php

class FeedUtils {
    
    public function sort_by_day($a, $b) {
        return $b->date->getTimestamp() - $a->date->getTimestamp();
    }
    
    public static function sort_feed_by_day( &$feed ) {
        usort($feed, array( "FeedUtils" , "sort_by_day" ));
    }
}
