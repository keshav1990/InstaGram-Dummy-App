<?php

require_once 'instagram.class.php';

$instagram = new Instagram('3ef63c8f5ba94a23880e1da707dcc71e');
$result = $instagram->getPopularMedia();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - popular photos</title>
    <link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/4.2/video.js"></script>
  </head>
  <body>
    <div class="container">
      <header class="clearfix">
        <img src="assets/instagram.png" alt="Instagram logo">
        <h1>Instagram <span>popular photos</span></h1>
      </header>
      <div class="main">
        <ul class="grid">
        <?php
          foreach ($result->data as $media) {
            $content = "<li>";
            
            // output media
            if ($media->type === 'video') {
              // video
              $poster = $media->images->low_resolution->url;
              $source = $media->videos->standard_resolution->url;
              $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
            } else {
              // image
              $image = $media->images->low_resolution->url;
              $content .= "<img class=\"media\" src=\"{$image}\"/>";
            }
            
            // create meta section
            $avatar = $media->user->profile_picture;
            $username = $media->user->username;
            $comment = $media->caption->text;
            $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>{$username}</p>
                           <div class=\"comment\">{$comment}</div>
                         </div>";
            
            // output media
            echo $content . "</li>";
          }
        ?>
        </ul>
       
      </div>
    </div>
    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        // rollover effect
        $('li').hover(
          function() {
            var $image = $(this).find('.media');
            var height = $image.height();
            $image.stop().animate({ marginTop: -(height - 82) }, 1000);
          }, function() {
            var $image = $(this).find('.media');
            var height = $image.height();
            $image.stop().animate({ marginTop: '0px' }, 1000);
          }
        );
      });
    </script>
  </body>
</html>