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
?>
<div class="instagallery<?php echo $moduleclass_sfx; ?>">
    <p class="pre-text"><?php echo $preText; ?></p>
    <div class="instaimages">
        <?php 
        $i = 1; 
        //var_dump($list);exit;
        foreach ($list as $user) {
            if ($i++ > $count){
                break;
            }
            if(!empty($user)){
                print '<div class="instaimagecont">';
                require JModuleHelper::getLayoutPath('mod_instagallery', '_user');
                print '</div>';
            }
         } 
         ?>
    </div>
    <p class="post-text"><?php echo $postText; ?></p>
</div>
