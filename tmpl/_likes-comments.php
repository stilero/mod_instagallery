<?php
/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

//No direct access
defined('_JEXEC) or die;');
$comments = 0;
$likes = 0;
$likeHeart = JUri::base().'modules/mod_instagallery/assets/images/likeheart.png';
$commentBubble = JUri::base().'modules/mod_instagallery/assets/images/comments.png';
$profilePic = 'http://images.ak.instagram.com/profiles/anonymousUser.jpg';
if(isset($image->likes)){
    $likes = $image->likes->count > 1000 ? substr($image->likes->count, -3, 3).'K+' : $image->likes->count;
}
if(isset($image->comments)){
    $comments = $image->comments->count > 1000 ? substr($$image->comments->count, -3, 3).'K+' : $image->comments->count;
}
//$userProfile = '<span class="username">'.substr($image['user-name'], 0, 12).'*</span>';
if(isset($image->user->profile_picture)){
    $profilePic = $image->user->profile_picture;
}
?>
<div class="likes-comments">
    <span class="userimg">
        <img class="usericon" src="<?php print $profilePic ?>" />
    </span>
    <span class="likes">
        <img class="instaicon" src="<?php print $likeHeart ?>" />
        <?php print $likes; ?>
    </span><span class="comments">
        <img class="instaicon" src="<?php print $commentBubble ?>" />
        <?php print $comments; ?>
    </span>
</div>