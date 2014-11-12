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
                print '<a class="" href="'.$image->images->standard_resolution->url.'" data-lightbox="group:25-4fa6cb3aaf15c" title="'.$image->caption->text.'">';
                print '<div>';
                print '<img src="'.$image->images->thumbnail->url.'" alt="'.$image->caption->text.'" height="150" width="150" />';
                print '<p class="title">'.substr($image->caption->text, 0, 20).'</p>';
                print '</div>';
                print '</a>';
            }
         } 
         ?>
    </div>
    <p class="post-text"><?php echo $postText; ?></p>
</div>