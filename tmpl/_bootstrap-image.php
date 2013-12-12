<?php
/**
 * @version     $Id$
 * @copyright   Copyright 2011 Stilero AB. All rights re-served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

//No direct access
defined('_JEXEC) or die;');
$imageThumbSize = $params->get('image_thumb_size', '150') > 600 ? 600 : $params->get('image_thumb_size', '150');
$showCaption = $params->get('show-caption', '0');
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
$caption = '';
if($showCaption){
    $caption = '<div class="caption"><p>'.$imageCaption.'</p></div>';
}
?>
<div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
        <img class="img-responsive" data-src="<?php echo $fullImage;?>" src="<?php echo $fullImage;?>" alt="<?php echo $imageCaption; ?>">
    </a>
    <?php echo $caption; ?>
</div>
