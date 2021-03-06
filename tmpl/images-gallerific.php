<?php
/**
 * @package	Instagram Module
 * @subpackage	mod_instagram
 * @copyright	Copyright (C) 2012 Stilero Webdesign. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$galleryName = 'gallerific';
$document =& JFactory::getDocument();
//$document->addStyleSheet($modulePath.'css'.DS.'slides.css');
$images = $Instagram->fetchImages('self', $params->get('image_count', '30'), $params->get('display_type', ''));
$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
$document->addScriptDeclaration('jQuery.noConflict();');
$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js');
$document->addScript($modulePath.'js'.DS.$galleryName.DS.'jquery.galleriffic.js');

$script = "jQuery(function($) {
    var gallery = $('#thumbs').galleriffic({
        delay:                     3000, // in milliseconds
        numThumbs:                 20, // The number of thumbnails to show page
        preloadAhead:              40, // Set to -1 to preload all images
        enableTopPager:            false,
        enableBottomPager:         true,
        maxPagesToShow:            7,  // The maximum number of pages to display in either the top or bottom pager
        imageContainerSel:         '', // The CSS selector for the element within which the main slideshow image should be rendered
        controlsContainerSel:      '', // The CSS selector for the element within which the slideshow controls should be rendered
        captionContainerSel:       '', // The CSS selector for the element within which the captions should be rendered
        loadingContainerSel:       '', // The CSS selector for the element within which should be shown when an image is loading
        renderSSControls:          true, // Specifies whether the slideshow's Play and Pause links should be rendered
        renderNavControls:         true, // Specifies whether the slideshow's Next and Previous links should be rendered
        playLinkText:              'Play',
        pauseLinkText:             'Pause',
        prevLinkText:              'Previous',
        nextLinkText:              'Next',
        nextPageLinkText:          'Next &rsaquo;',
        prevPageLinkText:          '&lsaquo; Prev',
        enableHistory:             false, // Specifies whether the url's hash and the browser's history cache should update when the current slideshow image changes
        enableKeyboardNavigation:  true, // Specifies whether keyboard navigation is enabled
        autoStart:                 false, // Specifies whether the slideshow should be playing or paused when the page first loads
        syncTransitions:           false, // Specifies whether the out and in transitions occur simultaneously or distinctly
        defaultTransitionDuration: 1000, // If using the default transitions, specifies the duration of the transitions
        onSlideChange:             undefined, // accepts a delegate like such: function(prevIndex, nextIndex) { ... }
        onTransitionOut:           undefined, // accepts a delegate like such: function(slide, caption, isSync, callback) { ... }
        onTransitionIn:            undefined, // accepts a delegate like such: function(slide, caption, isSync) { ... }
        onPageTransitionOut:       undefined, // accepts a delegate like such: function(callback) { ... }
        onPageTransitionIn:        undefined, // accepts a delegate like such: function() { ... }
        onImageAdded:              undefined, // accepts a delegate like such: function(imageData, $li) { ... }
        onImageRemoved:            undefined  // accepts a delegate like such: function(imageData, $li) { ... }
    });
});";

$document->addScriptDeclaration($script);
?>    
    <div id="controls"></div>
    <div id="loading"></div>
    <div id="slideshow"></div>
    <div id="caption"></div>
    <div id="thumbs">
        <ul class="thumbs noscript">
        <?php foreach ($images as $image) { ?>
            <li>
                <a class="thumb" name="optionalCustomIdentifier" href="<?php echo $image['full'];?>" title="<?php echo $image['caption'];?>">
                    <img src="<?php echo $image['thumb'];?>" alt="<?php echo $image['caption'];?>" />
                </a>
                <div class="caption">
                    (Any html can go here)
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
    
    
    
    
    <div id="slides">
            <div class="slides_container">
                <?php foreach ($images as $image) { ?>
                <div>
                    <img src="<?php echo $image['full'];?>">
                </div>
                <?php } ?>
            </div>
        </div>
    
