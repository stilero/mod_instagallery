<?php
/**
 * @package	Instagram Module
 * @subpackage	mod_instagram
 * @copyright	Copyright (C) 2012 Stilero Webdesign. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/style.css');
JHtml::_('behavior.framework');
JHtml::_('behavior.framework', true);
JHtml::_('behavior.modal', 'a.instaimage');
$noLikesComments = array('user-followers', 'user-follows');
?>
<div class="instagallery<?php echo $moduleclass_sfx; ?>">
    <p class="pre-text"><?php echo $preText; ?></p>
    <div class="instaimages">
        <?php 
        $i = 1; 
        foreach ($list as $image) {
            if ($i++ > $count){
                break;
            }
            if(!empty($image)){
                print '<div class="instaimagecont">';
                if($params->get('link_type', '0') == '0' || in_array($mediaType, $noLikesComments)){
                    require JModuleHelper::getLayoutPath('mod_instagallery', '_image');
                }else if($params->get('link_type', '0') == '1'){
                    require JModuleHelper::getLayoutPath('mod_instagallery', '_instagram');
                }
                if($params->get('likes-comments', '0') == '1' && !in_array($mediaType, $noLikesComments)){
                    require JModuleHelper::getLayoutPath('mod_instagallery', '_likes-comments');
                }
                print '</div>';
            }
         } 
         ?>
    </div>
    <p class="post-text"><?php echo $postText; ?></p>
</div>
