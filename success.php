<?php

require_once 'instagram.class.php';
if(!class_exists('Instagram')){
require_once './lib/instagram.class.php';
}
// initialize class
$instagram = new Instagram(array(
  'apiKey'      => '8387e541978142fd9d221a79b01e61bb',
  'apiSecret'   => '20c9cc87010849bc99fcd54daf415ef9',
  'apiCallback' => 'http://neowebsolution.com/ig/success.php' // must point to success.php
));
$user_name = $_POST['username'];
   $json_data = '{"access_token":"1499498862.8387e54.16810e4280a143fb96eee90a04856693","user":{"username":"keshavkalra1990","bio":"","website":"","profile_picture":"https:\/\/igcdn-photos-c-a.akamaihd.net\/hphotos-ak-xaf1\/t51.2885-19\/10731901_1570198736542418_1662853555_a.jpg","full_name":"Keshav Kalra","id":"1499498862"}}';
   $data = json_decode($json_data);
 //  print_r($data);
   $instagram->setAccessToken($data);
   $user_name = ($user_name!='')?$user_name : 'keshavkalra1990';
   $result2 = $instagram->searchUser($user_name,1);

   $user_id = $result2->data[0]->id;
 print_r($result2);
   $result = $instagram->getUserMedia('1499498862',40);

   //print_r($instagram);

if($result->data){
?>
 <?php
 $k = 1;
          // display all user likes
          foreach ($result->data as $media) {


            // output media
            if ($media->type === 'video') {
              $image = $media->images->low_resolution->url;

              $image_link = $media->link;
            } else {
              // image
             $image  = $media->images->low_resolution->url;
             $image_link  = $media->link;
             // $image_link;
            }

            // create meta section
            $avatar = $media->user->profile_picture;
            $username = $media->user->username;
            $comment = $media->caption->text;
            ?>
            <li>
<label>
<a href="<?php echo  $image_link; ?>" target="_blank"><img src="<?php echo $image; ?>" ></a>
<input type="checkbox" <?php if($k==1){ echo "checked"; } ?> name="usr_image[]" style="display: block;" value="<?php echo $image_link;  ?>">
</label>
</li>

<?php

        $k++;
          }
          }
          else{
            ?>
            <li style="width: 100%;">
            <label><p>This username doesn't exist.</p></label>
            </li>
            <?php
          }
        ?>