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
//$document->addScript(JUri::base().'modules/mod_instagallery/assets/js/bootstrap.js');
$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/bootstrap.css');
//$document->addStyleSheet('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
//$document->addStyleSheet("//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css");
//$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/bootstrap-theme.min.css');
//$document->addStyleSheet(JUri::base().'modules/mod_instagallery/assets/css/bootstrap.min.css');

//JHtml::_('behavior.framework');
//JHtml::_('behavior.framework', true);
//JHtml::_('behavior.modal', 'a.instaimage');
$noLikesComments = array('user-followers', 'user-follows');
$showLikesAndComments = $params->get('likes-comments', '0');
$showCaption = $params->get('show-caption', '0');
?>
<div class="instagallery<?php echo $moduleclass_sfx; ?>">
    <p class="pre-text"><?php echo $preText; ?></p>
    <div class="row">
        <?php 
        $i = 1; 
        foreach ($list as $image) {
            if ($i++ > $count){
                break;
            }
            if(!empty($image)){
                require JModuleHelper::getLayoutPath('mod_instagallery', '_bootstrap-image');
            }
        }
        ?>
  </div>
    <p class="post-text"><?php echo $postText; ?></p>
</div>
<?php 

?>