<?php
/**
 * @package	Instagram Module
 * @subpackage	mod_instagram
 * @copyright	Copyright (C) 2012 Stilero Webdesign. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
/*
JHTML::stylesheet('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
JHTML::stylesheet("//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css");
JHTML::script("//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js");
JHTML::script("https://code.jquery.com/jquery.js");
*/
$document = JFactory::getDocument();


$document->addScript("https://code.jquery.com/jquery.js");
$document->addScript("//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js");
$document->addScript("http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js");
$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/bootstrap.css');
$document->addStyleSheet("http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css");
$document->addScript(JUri::base().'modules/mod_instagallery/assets/js/bootstrap-image-gallery.min.js');
//$document->addStyleSheet("//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css");
$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/bootstrap-image-gallery.min.css');
//$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/bootstrap.min.css');

//JHtml::_('behavior.framework');
//JHtml::_('behavior.framework', true);
//JHtml::_('behavior.modal', 'a.instaimage');
$noLikesComments = array('user-followers', 'user-follows');
$showLikesAndComments = $params->get('likes-comments', '0');
$showCaption = $params->get('show-caption', '0');
?>

<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="links">
    <a href="http://localhost/joomla25/images/banners/white.png" title="Banana" data-gallery>
        <img src="http://localhost/joomla25/images/banners/white.png" alt="Banana">
    </a>
    <a href="http://localhost/joomla25/images/banners/white.png" title="Apple" data-gallery>
        <img src="http://localhost/joomla25/images/banners/white.png" alt="Apple">
    </a>
    <a href="http://localhost/joomla25/images/banners/white.png" title="Orange" data-gallery>
        <img src="http://localhost/joomla25/images/banners/white.png" alt="Orange">
    </a>
</div>
