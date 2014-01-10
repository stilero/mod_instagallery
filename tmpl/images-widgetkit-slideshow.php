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
define('WIDGETKIT_SLIDESHOW_SCREEN_PATH', JURI::root().'media/widgetkit/widgets/slideshow/styles/screen/');
define('WIDGETKIT_SLIDESHOW_JS_PATH', JURI::root().'media/widgetkit/widgets/slideshow/js/');
define('WIDGETKIT_CSS_PATH', JURI::root().'media/widgetkit/css/');
define('WIDGETKIT_SLIDESHOW_CSS_PATH', JURI::root().'media/widgetkit/widgets/slideshow/styles/screen/');
JHtml::script(WIDGETKIT_SLIDESHOW_JS_PATH.'slideshow.js');
JHtml::script(WIDGETKIT_SLIDESHOW_JS_PATH.'lazyload.js');
JHTML::stylesheet(WIDGETKIT_CSS_PATH.'widgetkit.css');
JHTML::stylesheet(WIDGETKIT_SLIDESHOW_CSS_PATH.'style.css');
$cssShadowFix = '.wk-slideshow-screen > div:before {
	content: "";
	position: absolute;
	bottom: -40px;
	left: -10px;
	right:-10px;
	height: 76px;
	background: url('.WIDGETKIT_SLIDESHOW_SCREEN_PATH.'images/shadow.png) 0 0 no-repeat;
	background-size: 100% 100%;
}';
$cssButtonFix = '.wk-slideshow-screen .nav span {
	width: 13px;
	height: 13px;
	background: url('.WIDGETKIT_SLIDESHOW_SCREEN_PATH.'images/nav.png) 0 0 no-repeat;
	overflow: hidden;
}';
$cssNavFix = '.wk-slideshow-screen > div:hover .prev {
	top: 50%;
	width: 40px;
	height: 40px;
	margin-top: -20px;
	background: url('.WIDGETKIT_SLIDESHOW_SCREEN_PATH.'images/buttons.png) 0 40px no-repeat;
}';
$document = JFactory::getDocument();
$document->addStyleDeclaration($cssShadowFix);
$document->addStyleDeclaration($cssButtonFix);
$document->addStyleDeclaration($cssNavFix);
$galleryID = uniqid();
$imageSize = $params->get('image_thumb_size', '150') > 600 ? 600 : $params->get('image_thumb_size', '150');
$fullWidth = $imageSize + 140;
?>
<div id="slideshow-<?php echo $galleryID; ?>" class="wk-slideshow wk-slideshow-screen" data-widgetkit="slideshow" data-options="{&quot;style&quot;:&quot;screen&quot;,&quot;autoplay&quot;:1,&quot;interval&quot;:10000,&quot;width&quot;:600,&quot;height&quot;:300,&quot;duration&quot;:1000,&quot;index&quot;:0,&quot;order&quot;:&quot;default&quot;,&quot;navigation&quot;:1,&quot;buttons&quot;:1,&quot;slices&quot;:15,&quot;animated&quot;:&quot;kenburns&quot;,&quot;caption_animation_duration&quot;:500}" style="visibility: visible; position: relative; width: 600px;">
    <div>
        <ul class="slides" style="width: 100%; overflow: hidden; position: relative; z-index: 4; height: <?php echo $imageSize; ?>px;">
            <?php 
            $i = 1; 
            foreach ($list as $image) : 
                if ($i++ > $count){
                    break;
                }   
            if(!empty($image)):
                if(isset($image->images->standard_resolution->url)){
                    $fullImage = $image->images->standard_resolution->url;
                }
                ?>
                <li style="top: 0px; left: 0px; position: absolute; display: none; z-index: 1; visibility: visible; opacity: 1; height: <?php echo $fullWidth; ?>px; width: <?php echo $fullWidth; ?>px;">
                    <article class="wk-content clearfix">
                        <a href="#"><img src="<?php echo $fullImage; ?>" width="<?php echo $imageSize; ?>" height="<?php echo $imageSize; ?>" alt="Image 01" style="display: none;">
                            <canvas class="tmp" width="<?php echo $imageSize; ?>" height="<?php echo $imageSize; ?>" style="width: <?php echo $imageSize; ?>px; height: <?php echo $imageSize; ?>px; opacity: 1;"></canvas>
                        </a>
                    </article>
                </li>
                <?php endif; ?>
            <?php endforeach;?>
        </ul>
        <div class="next"></div>
        <div class="prev"></div>
        <?php
        if(isset($list[0]->caption->text)){
                    $firstImageCaption = $image->caption->text;
        } ?>
        <div class="caption" style="display: none;"><?php echo $firstImageCaption; ?></div>
        <ul class="captions" style="display: none;">
            <?php foreach ($list as $image) :
                if(isset($image->caption->text)){
                    $imageCaption = $image->caption->text;
                } ?>
                <li><?php echo $imageCaption; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <ul class="nav">
        <?php $x=0;$navclass='active'; ?>
        <?php foreach ($list as $image) : ?>
        <?php if ($x != 0) $navclass = '';  ?>
            <li class=""><span></span></li>
        <?php $x++; ?>
        <?php endforeach;?>
    </ul>
</div>