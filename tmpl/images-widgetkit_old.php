<?php 
/**
*  Widgetkit templats
*
* @version  1.1
* @author Daniel Eliasson - www.stilero.com
* @copyright  (C) 2012 Stilero Webdesign
* @category library
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*
*
*/

defined('_JEXEC') or die('Restricted access'); 
?>
<div class="wk-gallery wk-gallery-wall clearfix polaroid ">
    <?php foreach ($images as $image) { ?>
        <?php if (!empty($image)){ ?>
        <a class="" href="<?php echo $image['full'];?>" data-lightbox="group:25-4fa6cb3aaf15c" title="<?php echo $image['caption'] ?>">
            <div>
                <img src="<?php echo $image['thumb'] ?>" alt="<?php echo $image['caption'] ?>" height="150" width="150" />
                <p class="title"><?php echo substr($image['caption'], 0, 20) ?></p>
            </div>
        </a>
        <?php } ?>
    <?php } ?>
</div>