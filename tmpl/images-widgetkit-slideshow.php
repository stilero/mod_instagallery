<?php
/**
 * Widgetkit slideshow
 *
 * @version  1.0
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-nov-14 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
$galleryID = uniqid();
$imageSize = $params->get('image_thumb_size', '150') > 600 ? 600 : $params->get('image_thumb_size', '150');
$fullWidth = $imageSize + 140;
?>
<div 
    id="gallery-<?php echo $galleryID; ?>" 
     class="wk-slideshow wk-slideshow-default" 
     data-widgetkit="slideshow" 
     data-options="{&quot;style&quot;:&quot;default&quot;,&quot;width&quot;:&quot;auto&quot;,&quot;height&quot;:&quot;auto&quot;,&quot;autoplay&quot;:1,&quot;order&quot;:&quot;default&quot;,&quot;interval&quot;:5000,&quot;duration&quot;:500,&quot;index&quot;:0,&quot;navigation&quot;:1,&quot;buttons&quot;:1,&quot;slices&quot;:20,&quot;animated&quot;:&quot;fade&quot;,&quot;caption_animation_duration&quot;:500,&quot;lightbox&quot;:0}" 
     style="visibility: visible; 
     position: relative; 
     width: <?php echo $fullWidth; ?>px;"
     >
        <div>
            <ul 
                class="slides" 
                style="
                width: 100%; 
                overflow: hidden; 
                position: relative;
                height: <?php echo $imageSize; ?>px;
                "
            >
                <?php 
                $i = 1; 
                foreach ($list as $image) {
                    if ($i++ > $count){
                        break;
                    }
                    if(!empty($image)){ ?>
                        <?php
                            if(isset($image->images->standard_resolution->url)){
                                $fullImage = $image->images->standard_resolution->url;
                            }
                            if(isset($image->caption->text)){
                                $imageCaption = $image->caption->text;
                            }
                        ?>
                        <li 
                            style="top: 0px; left: 0px; 
                            position: absolute; 
                            <?php if ($i == 1){ ?>
                                display: list-item;
                            <?php }else{ ?>
                                display: none; 
                            <?php } ?>
                            z-index: <?php echo $i; ?>; 
                            opacity: 1; 
                            width: <?php echo $imageSize; ?>px; 
                            height: <?php echo $imageSize; ?>px;"
                        >
                            <img 
                                src="<?php echo $fullImage; ?>" 
                            <?php if($i!=1){ ?>
                                data-src="<?php echo $fullImage; ?>"
                            <?php }?>
                                width="<?php echo $imageSize; ?>" 
                                height="<?php echo $imageSize; ?>" 
                                alt="<?php echo $imageCaption; ?>"
                           >
                        </li>
                    <?php }
                }?>
            </ul>
        <div class="next"></div>
        <div class="prev"></div>		
        <div class="caption" style="display: none;"></div>
            <ul class="captions" style="display: none;">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
	</div>
	<ul class="nav">
            <li class="active"><span></span></li>
            <li class=""><span></span></li>
            <li class=""><span></span></li>
            <li class=""><span></span></li>
            <li class=""><span></span></li>
        </ul>
</div>