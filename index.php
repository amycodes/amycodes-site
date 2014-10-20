<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Welcome to AMY-CODES.COM</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/fonts/fonts.css">

        <style>
            body {
                background-image: url("assets/images/WordCloudResume.png");
                background-repeat: no-repeat;
                background-position: center;
                background-attachment: fixed;
                font-family: trebuchet, arial, sans-serif;
                text-align:center;
                margin: 0;
                padding: 0;
                border: none;
                

            }
            #container {
                margin:-5px auto;
                width: 760px;
            }
            #main, #topbar, #sidebar {
                background-color: #fff;
                opacity: .95;
                filter: alpha(95);            }
            #main {
                width: 500px;
                border-left: 2px solid darkslateblue;
                border-right: 2px solid darkslateblue;
                margin: -10px auto 0;
                padding: 25px 25px;
                float: left;
            }
            .title{
                font-family: sansita-one, impact;
                font-size: 40pt;
                margin-top: 50px;
            }
            .icons {
                text-align:center;
            }
            li {
                list-style-type: none;
                font-size: 8pt;
            }
            
            .social_post_network, .social_post_date {
                font-family: sansita-one, impact;
                float: left;
                z-index: -50;
                font-size:16pt;
                margin-left: 15px;
                margin-bottom:-7px;
                
            }
            .social_post_date {
                float:right;
                margin-right:15px;
                font-size:12pt;
                margin-top:3px;
            }
            .social_post_network a {
                text-decoration: none;
            }
            .social_post {
                width:85%;
                border: 2px solid;
                border-radius: 15px;
                margin-bottom: 30px;
                overflow: hidden;
                padding: 25px;
            }
            .social_post .content {
                float:left;
            }
            .social_post .content img {
                width: 100%;
                border-radius: 15px;
            }
            .social_post .stats {
                background-color: azure;
                border: thin solid gray;
                float:left;
                margin: 0 -5px -2px -5px;
                padding: 2px 10px 0px 0px;
                width: 100%;
            }
            .social_post .date {
                float:left;
                margin-left:10px
            }
            .social_post .link {
                float:right;
                margin-right:10px;
            }
            #topbar {
                display:none;
            }
            #sidebar {
                width: 150px;
                float: left;
                background-color: #fff;
                padding: 20px 0 10px;
                border: thin solid black;
                border-radius: 10px;
                margin: 10px 0 0 10px;
            }
            #sidebar img.social_icon {
                width:50px;
                padding:3px;
            }
            #sidebar img.profilepic {
                width: 110px;
            }
            
            .social_post .title {
                font-size: 14pt;
            }
            
            .social_post .commits {
                text-align: left;
            }
            .social_post .commits img {
                width:auto;
            }
            
            blockquote {
                border-left: 2px solid;
                border-radius: 15px;
                border-top: none;
                border-right: 2px solid;
                border-bottom: none;
            }
            
            .commits .message blockquote {
                padding-left:15px;
                font-size:9pt;
            }
            
            @media screen and (max-width: 760px) {
                body {
                    padding: 0;
                }
                #container {
                    width:100%;
                    border: none;
                }
                #main, #topbar{
                    border: 0 none;
                    float: left;
                    margin: 0;
                    padding: 0;
                    display: block;
                    width:100%;
                }
                .title {
                    margin:0;
                }
                #sidebar {
                    display: none;
                }
                
                #topbar img {
                    width:13%;
                }

                .social_post {
                    width:100%;
                    border-top: 2px solid;
                    border-radius: 15px;
                    border-right: none;
                    border-left: none;
                    border-bottom: none;
                    margin-bottom: 30px;
                    overflow: hidden;
                    padding: 15px 0 0 0;
                }
                
                .social_post .content {
                    padding: 0 15px;
                }
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="topbar">
                <img class="profilepic" src="assets/images/profilepic.jpg"/>
                <a href="http://www.twitter.com/nerdypaws"><img class="social_icon" src="assets/images/Twitter.png" alt="Twitter"/></a>
                <a href="http://amycodes.tumblr.com"><img class="social_icon" src="assets/images/Tumblr.png" alt="Tumblr"/></a>
                <a href="https://www.linkedin.com/in/amycodes"><img class="social_icon" src="assets/images/Linkedin.png" alt="LinkedIn"/></a>
                <a href="http://amycodes.wordpress.com/"><img class="social_icon" src="assets/images/Wordpress.png" alt="WordPress"/></a>
                <a href="https://plus.google.com/u/0/+AmyArambuloNegrette/about"><img class="social_icon" src="assets/images/Google-plus.png" alt="Google Plus"/></a>
                <a href="https://github.com/amycodes/amycodes-site"><img class="social_icon" src="assets/images/Github.png" alt="Git Hub"/></a>
            </div>
            <div id="main">
                <div class="title">It's What I Do</div>
                <?php
                    include_once 'classes/TwitterFeed.php';
                    include_once 'classes/TumblrFeed.php';
                    include_once 'classes/GitHubFeed.php';
                    include_once 'classes/StackExchangeFeed.php';

                    include_once 'classes/FeedUtils.php';

                    $twitter_feed = new TwitterFeed();
                    $tumblr_feed = new TumblrFeed();
                    $github_feed = new GitHubFeed();
                    $se_feed = new StackExchangeFeed();
                    $posts = array_merge(
                            $twitter_feed->getFeedPosts(),
                            $tumblr_feed->getFeedPosts(),
                            $github_feed->getFeedPosts(),
                            $se_feed->getFeedPosts()
                            );
                    FeedUtils::sort_feed_by_day($posts);

                    foreach ( $posts as $post ) {
                        echo $post->toHTML();
                    }
                ?>
            </div>
            <div id="sidebar">
                <img class="profilepic" src="assets/images/profilepic.jpg"/>
                <a href="http://www.twitter.com/nerdypaws"><img class="social_icon" src="assets/images/Twitter.png" alt="Twitter"/></a>
                <a href="http://amycodes.tumblr.com"><img class="social_icon" src="assets/images/Tumblr.png" alt="Tumblr"/></a>
                <a href="https://www.linkedin.com/in/amycodes"><img class="social_icon" src="assets/images/Linkedin.png" alt="LinkedIn"/></a>
                <a href="http://amycodes.wordpress.com/"><img class="social_icon" src="assets/images/Wordpress.png" alt="WordPress"/></a>
                <a href="https://plus.google.com/u/0/+AmyArambuloNegrette/about"><img class="social_icon" src="assets/images/Google-plus.png" alt="Google Plus"/></a>
                <a href="https://github.com/amycodes/amycodes-site"><img class="social_icon" src="assets/images/Github.png" alt="Git Hub"/></a>
            </div>
        </div>
    </body>