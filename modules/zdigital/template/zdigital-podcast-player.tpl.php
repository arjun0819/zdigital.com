<!DOCTYPE html>
    <head>
        <title>Your page title</title>

        <!-- Player dimensions -->
        <style type="text/css">

            html {

                height: 100%;
                overflow: hidden; 

            }

            body {

                height: 100%;
                margin: 0;
                padding: 0; 

            }

            #td_player {

                width: 100%;
                height: 100%; 

            }

        </style>
        <!-- End Player dimensions -->

        <!-- Open graph metadata -->
        <meta property="og:title" content="PAGE_TITLE"/>
        <meta property="og:url" content="PLAYER_URL"/>
        <meta property="og:image" content="IMAGE_URL"/>
        <meta property="og:description" content="PAGE_DESCRIPTION"/>
        <!-- End Open graph metadata -->

    </head>
    <body>

    <!-- Triton Digital Player Embed -->
    <div id="td_player"></div>
    <script src="http://player.tritondigital.com/<?php echo $embid; ?>?rendering=js"></script>
    <!-- End Triton Digital Player Embed -->

    </body>

</html> 