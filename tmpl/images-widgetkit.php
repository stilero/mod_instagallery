<?php defined('_JEXEC') or die('Restricted access'); ?>
<div class="instagallery<?php echo $moduleclass_sfx; ?>">
    <p class="pre-text"><?php echo $preText; ?></p>
<div class="wk-gallery wk-gallery-wall clearfix polaroid ">
    <?php 
        $i = 1; 
        foreach ($list as $image) {
            if ($i++ > $count){
                break;
            }
            if(!empty($image)){
                print '<a class="" href="'.$image['full'].'" data-lightbox="group:25-4fa6cb3aaf15c" title="'.$image['caption'].'">';
                print '<div>';
                print '<img src="'.$image['thumb'].'" alt="'.$image['caption'].'" height="150" width="150" />';
                print '<p class="title">'.substr($image['caption'], 0, 20).'</p>';
                print '</div>';
                print '</a>';
            }
         } 
         ?>
    </div>
    <p class="post-text"><?php echo $postText; ?></p>
</div>