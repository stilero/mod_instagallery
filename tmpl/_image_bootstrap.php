<?php
/**
 * Bootstrap Image template
 * @version     1.0
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

//No direct access
defined('_JEXEC) or die;');
$document = JFactory::getDocument();
$imageThumbSize = $params->get('image_thumb_size', '150') > 600 ? 600 : $params->get('image_thumb_size', '150');
$imageCaption = "";
$thumbImage = '';
$fullImage = '';
if(isset($image->id)){
    $thumbImage = $image->images->thumbnail->url;
}
if(isset($image->images->standard_resolution->url)){
    $fullImage = $image->images->standard_resolution->url;
}
if($imageThumbSize > 150 && $fullImage != ''){
    $thumbImage = $fullImage;
}
if(isset($image->caption->text)){
    $imageCaption = $image->caption->text;
}
?>
<a href="<?php print $fullImage; ?>" title="<?php echo $imageCaption ?>" data-gallery>
    <img src="<?php echo $thumbImage ?>" alt="<?php echo $imageCaption ?>" width="<?php echo $imageThumbSize; ?>">
</a>
