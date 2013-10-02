<?php
/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

//No direct access
defined('_JEXEC) or die;');
//$document = JFactory::getDocument();
//$document->addScript($modulePath.'js'.DS.'imageloader.js');
$imageThumbSize = $params->get('image_thumb_size', '150') > 600 ? 600 : $params->get('image_thumb_size', '150');
//var_dump($image->caption->text);exit;
$link = '';
$caption = '';
$thumbnail = '';
$fullImage = '';
if(isset($image->link)){
    $link = $image->link;
}
if(isset($image->caption->text)){
    $caption = $image->caption->text;
}
if(isset($image->images->thumbnail->url)){
    $thumbnail = $image->images->thumbnail->url;
}
if(isset($image->images->standard_resolution->url)){
    $fullImage = $image->images->standard_resolution->url;
}
if($imageThumbSize > 150 && $fullImage != ''){
    $thumbnail = $fullImage;
}
if(isset($image->id)){ 
    ?>
    <a class="instalink" href="<?php echo $link;?>" title="<?php echo $caption ?>" target="_blank"><img src="<?php echo $thumbnail ?>" alt="image1" height="<?php echo $imageThumbSize; ?>" width="<?php echo $imageThumbSize; ?>" /></a>
<?php  } ?>