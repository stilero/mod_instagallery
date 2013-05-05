<?php
/**
 * modInstagalleryHelper
 *
 * @version  1.0
 * @package Stilero
 * @subpackage InstaGallery
 * @author Daniel Eliasson (joomla@stilero.com)
 * @copyright  (C) 2013-apr-24 Stilero Webdesign (www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
define('INSTAGALLERY_BASE_PATH', dirname(__FILE__));
define('INSTAGRAM_API_PATH', INSTAGALLERY_BASE_PATH.'/includes/insta-api/');
JLoader::register('InstaEndpoint', INSTAGRAM_API_PATH.'Endpoints/InstaEndpoint.php');
JLoader::register('Communicator', INSTAGRAM_API_PATH.'Communicator.php');
JLoader::register('InstaMedia', INSTAGRAM_API_PATH.'Endpoints/InstaMedia.php');
JLoader::register('InstaTags', INSTAGRAM_API_PATH.'Endpoints/InstaTags.php');
JLoader::register('InstaLocations', INSTAGRAM_API_PATH.'Endpoints/InstaLocations.php');
JLoader::register('InstaUsers', INSTAGRAM_API_PATH.'Endpoints/InstaUsers.php');

class modInstagalleryHelper{
    
    public static function getList($mediaType, $accessToken, $count=20, $tag='', $user='', $lat='', $lng=''){
        switch ($mediaType) {
            case 'user-recent':
                $response = self::getRecentUserImages($accessToken, $user, $count);
                break;
            case 'user-feed':
                $response = self::getSelfFeed($accessToken, $count);;
                break;
            case 'user-liked':
                $response = self::getUserLikes($accessToken, $count);
                break;
            case 'most-popular':
                $response = self::getMostPopular($accessToken);
                break;
            case 'tags-name':
                $response = self::getMediaTagged($accessToken, $tag);
                break;
            case 'media-search':
                $response = self::getMediaByLocation($accessToken, $lat, $lng);
                break;
            default:
                $response = self::getSelfFeed($accessToken, $count);
                break;
        }
        return self::responseToArray($response);
    }
    
        /**
     * Get the images in the feed of the logged in person
     * @param string $accessToken
     * @param int $count
     * @return Object
     */
    public static function getSelfFeed($accessToken, $count){
        $InstaUsers = new InstaUsers($accessToken);
        $result = $InstaUsers->getSelfFeed($count);
        $images = json_decode($result);
        return $images;
    }

    /**
     * Get the latest images from the username
     * @param string $accessToken
     * @param string $username
     * @param int $count
     * @return Object
     */
    public static function getRecentUserImages($accessToken, $username, $count=30) {
        $InstaUsers = new InstaUsers($accessToken);
        $result = json_decode($InstaUsers->search($username));
        $userid= $result->data[0]->id;
        $images = json_decode($InstaUsers->getUserIdMediaRecent($userid, $count));
        return $images;
    }
    
    /**
     * Get the latest images based on the tag
     * @param string $accessToken
     * @param string $tagName
     * @param int $count
     * @return Object
     */
    public static function getMediaTagged($accessToken, $tagName, $count = 30){
        $InstaTags = new InstaTags($accessToken);
        $response = $InstaTags->getRecentMediaByTag($tagName);
        $images = json_decode($response);
        return $images;
    }
    
    /**
     * Get the lates images that the logged in user has liked
     * @param string $accessToken
     * @param int $count
     * @return Object
     */
    public static function getUserLikes($accessToken, $count=30){
        $InstaUsers = new InstaUsers($accessToken);
        $response = $InstaUsers->getSelfMediaLiked($count);
        $images = json_decode($response);
        return $images;
    }
    
    /**
     * Get the most popular images
     * @param string $accessToken
     * @return Object
     */
    public static function getMostPopular($accessToken){
        $InstaMedia = new InstaMedia($accessToken);
        $response = $InstaMedia->getPopular();
        $images = json_decode($response);
        return $images;
    }
    
    /**
     * Get images from based on a location
     * @param string $accessToken
     * @param string $lat
     * @param string $long
     * @return Object
     */
    public static function getMediaByLocation($accessToken, $lat, $long){
        $InstaMedia = new InstaMedia($accessToken);
        $response = $InstaMedia->search($lat, $long);
        $images = json_decode($response);
        return $images;
    }
    
    public static function responseToArray($response){
        if(!isset($response->data)){
            return false;
        }
        $data = $response->data;
        $images = array();
        if(isset($data)){
            foreach ($data as $value) {
                $image['thumb'] = $value->images->thumbnail->url;
                $image['full'] = $value->images->standard_resolution->url;
                $image['created'] = $value->created_time;
                $image['caption'] = isset($value->caption->text) ? $value->caption->text : '';
                $image['tags'] = $value->tags;
                $image['latitude'] = isset($value->location->latitude) ? $value->location->latitude : '';
                $image['longitude'] = isset($value->location->longitude) ? $value->location->longitude : '';
                $image['id'] = $value->id;
                $image['likes'] = $value->likes->count;
                $image['comments'] = $value->comments->count;
                $image['link'] = $value->link;
                $image['user-name'] = $value->user->username;
                $image['user-profilepic'] = $value->user->profile_picture;
                $image['user-fullname'] = $value->user->full_name;
                $images[] = $image;
            }
        }
        $images['nextpage'] = '';
        if(isset($response->pagination->next_url)){
            $images['nextpage'] = $response->pagination->next_url;
        }
        return $images;
    }
}
