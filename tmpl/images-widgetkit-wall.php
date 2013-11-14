<?php
/**
 * mod_instagallery
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
<div class="wk-gallery wk-gallery-wall clearfix margin">
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
            <a 
                class="spotlight" 
                href="<?php echo $fullImage; ?>" 
                data-lightbox="group:<?php echo $galleryID; ?>" 
                title="<?php echo $imageCaption; ?>" 
                data-spotlight="on" 
                style="position: relative; 
                overflow: hidden;"
            >
                <img 
                    src="<?php echo $fullImage; ?>" 
                    width="<?php echo $imageSize; ?>" 
                    height="<?php echo $imageSize; ?>" 
                    alt="<?php echo $imageCaption; ?>"
                >
                <div 
                    class="overlay-default" 
                    style="
                        position: absolute; 
                        visibility: visible; 
                        display: none; 
                        width: <?php echo $imageSize; ?>px; 
                        height: <?php echo $imageSize; ?>px; 
                        opacity: 0; 
                        top: 0px; 
                        left: 0px;
                    "
                >
                    <div></div>
                </div>
            </a>
                
        <?php }
    }
    ?>
    </div>