<?php
/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

//No direct access
defined('_JEXEC) or die;');
$document = JFactory::getDocument();
//$document->addScript(MODULEURI.'assets/js/imageloader.js');
$imageThumbSize = $params->get('image_thumb_size', '150') > 150 ? 150 : $params->get('image_thumb_size', '150');
$fullName = "";
$profilePic = '';
if(isset($user->profile_picture)){
    $profilePic = $user->profile_picture;
}
if(isset($user->full_name)){
    $fullName = $user->full_name;
}
if($profilePic != ''){?>
        <img class="instaimage" src="<?php echo $profilePic ?>" alt="<?php echo $fullName; ?>" height="<?php echo $imageThumbSize; ?>" width="<?php echo $imageThumbSize; ?>" />
<?php } ?>

