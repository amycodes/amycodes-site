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
                overflow-x: hidden;

            }
            #main {
                height:2000px;
                width:400px;
                background-color: #fff;
                border-left: 2px solid darkslateblue;
                border-right: 2px solid darkslateblue;
                opacity: .95;
                filter: alpha(95);
                margin: 0;
                padding: 0 25px;
                position: absolute;
                left: 50%;
                transform: translate(-200px, -20px);
                -ms-transform: translate(-200px,-20px); /* IE 9 */
                -webkit-transform: translate(-200px, -20px); /* Chrome, Safari, Opera */
            }
            .title {
                font-family: sansita-one, impact;
                font-size: 46pt;
                margin-top: 50px;
            }
            .icons {
                text-align:center;
            }
            li {
                list-style-type: none;
                font-size: 8pt;
            }
            
            @media screen and (max-width: 500px) {
                body {
                }
                #main {
                    width:100%;
                    border: none;
                    transform: none;
                    position: absolute;
                    left: -25px;
                    -ms-transform: none; /* IE 9 */
                    -webkit-transform: none; /* Chrome, Safari, Opera */
                }

            }
            
            @media screen and (max-height: 625px) {
                .title {
                    margin: 10px;
                }
                body {
                    overflow-y: hidden;
                }
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
                width:100%;
                border: 2px solid;
                border-radius: 15px;
                margin-bottom: 30px;
                overflow: hidden;
                
            }
            .social_post .content {
                float:left;
                margin: 5px 15px;
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
        </style>
    </head>
    <body>
        <div id="main">
            <div class="title">It's What I Do</div>
            <?php
                include 'classes/TwitterFeed.php';

                $twitter_feed = new TwitterFeed();
                $posts = $twitter_feed->getFeedPosts();
                foreach ( $posts as $post ) {
                    echo $post->toHTML();
                }
            ?>
        </div>
        
    </body>