<?php
/**
 * GalleryType class, for convieniently selecting and returning MediaTypes
 *
 * @version  1.0
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-aug-17 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class ModInstagalleryGalleryType{
    
    const WIDGETKIT = 'widgetkit';
    const STANDARD = 'default';
    
    /**
     * Returns A list of galleries defined
     * @return Array Defined gallery types
     */
    public static function getTypes(){
        $types = array(
            self::STANDARD => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_DEFAULT'),
            self::WIDGETKIT => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_WIDGETKIT')
        );
        return $types;
    }
        
}
