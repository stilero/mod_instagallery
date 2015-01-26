<?php
/**
 * MediaType class, for convieniently selecting and returning MediaTypes
 *
 * @version  1.0
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-aug-17 Stilero Webdesign (http://www.stilero.com)
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class ModInstaGalleryMediaType{
    
    const USER_RECENT = 'user-recent';
    const USER_FEED = 'user-feed';
    const USER_LIKED = 'user-liked';
    const USER_FOLLOWERS = 'user-followers';
    const USER_FOLLOWS = 'user-follows';
    const MOST_POPULAR = 'most-popular';
    const TAGS_NAME = 'tags-name';
    const MEDIA_SEARCH = 'media-search';
    
    /**
     * Returns all the media types configured
     * @return Array Media Types
     */
    public static function getMediaTypes(){
        $mediaTypes = array(
            self::USER_RECENT => JText::_('MOD_INSTAGALLERY_TYPE_USER_RECENT'),
            self::USER_FEED => JText::_('MOD_INSTAGALLERY_TYPE_USER_FEED'),
            self::USER_LIKED => JText::_('MOD_INSTAGALLERY_TYPE_USER_LIKED'),
            self::USER_FOLLOWERS => JText::_('MOD_INSTAGALLERY_TYPE_FOLLOWERS'),
            self::USER_FOLLOWS => JText::_('MOD_INSTAGALLERY_TYPE_FOLLOWS'),
            self::MOST_POPULAR => JText::_('MOD_INSTAGALLERY_TYPE_MOST_POPULAR'),
            self::TAGS_NAME => JText::_('MOD_INSTAGALLERY_TYPE_TAGS_NAME'),
            self::MEDIA_SEARCH => JText::_('MOD_INSTAGALLERY_TYPE_MEDIA_SEARCH')
        );
        return $mediaTypes;
    }
    /**
     * Returns an array with all media types that displays images
     * @return array an array with all image media types
     */
    public static function imageMedias(){
        $imageMedias = array(
            self::MEDIA_SEARCH,
            self::MOST_POPULAR,
            self::TAGS_NAME,
            self::USER_FEED,
            self::USER_LIKED,
            self::USER_RECENT
        ); 
        return $imageMedias;
    }
    
    /**
     * Returns an array with all media types that displays users
     * @return array media types
     */
    public static function userMedias(){
        $userMedias = array(
            self::USER_FOLLOWERS,
            self::USER_FOLLOWS
        );
        return $userMedias;
    }
    
    /**
     * Checks if a media type displays users
     * @param string $mediaType Media types as defined by constants
     * @return boolean true if media type displays users
     */
    public static function isUserMedia($mediaType){
        $userMedias = self::userMedias();
        if(in_array($mediaType, $userMedias)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Checks if a media type displays images
     * @param string $mediaType Media types as defined by constants
     * @return boolean true if image media
     */
    public static function isImageMedia($mediaType){
        $imageMedias = self::imageMedias();
        if(in_array($mediaType, $imageMedias)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
