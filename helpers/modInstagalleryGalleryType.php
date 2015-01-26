<?php
/**
 * GalleryType class, for convieniently selecting and returning MediaTypes
 *
 * @version  1.1
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-aug-17 Stilero Webdesign (http://www.stilero.com)
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class ModInstagalleryGalleryType{
    
    const WIDGETKIT = 'widgetkit';
    const WIDGETKIT_WALL = 'widgetkit-wall';
    const WIDGETKIT_SLIDESHOW = 'widgetkit-slideshow';
    const STANDARD = 'default';
    const RESPONSIVE = 'bootstrap-simple';
    const RESPONSIVE_GALLERY = 'bootstrap-gallery';
    
    /**
     * Returns A list of galleries defined
     * @return Array Defined gallery types
     */
    public static function getTypes(){
        $types = array(
            self::STANDARD => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_DEFAULT'),
            //self::RESPONSIVE => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_RESPONSIVE'),
            self::RESPONSIVE_GALLERY => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_RESPONSIVE_GALLERY'),
            self::WIDGETKIT => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_WIDGETKIT'),
            self::WIDGETKIT_WALL => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_WIDGETKIT_WALL'),
            self::WIDGETKIT_SLIDESHOW => JText::_('MOD_INSTAGALLERY_GALLERY_TYPE_WIDGETKIT_SLIDESHOW')
        );
        return $types;
    }
        
}
