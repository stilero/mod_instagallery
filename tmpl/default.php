<?php
/**
 * @package	Instagram Module
 * @subpackage	mod_instagram
 * @copyright	Copyright (C) 2012 Stilero Webdesign. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
if(count($list) > 0){
    require JModuleHelper::getLayoutPath('mod_instagallery', 'images-'.$params->get('gallery_type', 'default'));
}


?>