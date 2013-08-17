<?php
/**
 * Helper for InstaGallery. Basically helps retrieving images and info from Instagram.
 *
 * @version  1.1
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
    
    const MEDIA_TYPE_USER_RECENT = 'user-recent';
    const MEDIA_TYPE_USER_FEED = 'user-feed';
    const MEDIA_TYPE_USER_LIKED = 'user-liked';
    const MEDIA_TYPE_USER_FOLLOWERS = 'user-followers';
    const MEDIA_TYPE_USER_FOLLOWS = 'user-follows';
    const MEDIA_TYPE_MOST_POPULAR = 'most-popular';
    const MEDIA_TYPE_TAGS_NAME = 'tags-name';
    const MEDIA_TYPE_MEDIA_SEARCH = 'media-search';
    
    /**
     * Convenient static methor to retrive the images and info
     * @param string $mediaType The type of media to retireve. Use constants of this class
     * @param string $accessToken The Accesstoken
     * @param int $count number of rows to return. Max = 30 (usually)
     * @param string $tag Tag name to use, for example "streetphoto_bw"
     * @param string $user User Name to use, for example "streetpeople"
     * @param string $lat Latitude for locations, for example "52.12345"
     * @param string $lng Longitude for locations, for example "54.12345"
     * @return Array Array with the response
     */
    public static function getList($mediaType, $accessToken, $count=20, $tag='', $user='', $lat='', $lng=''){
        switch ($mediaType) {
            case self::MEDIA_TYPE_USER_RECENT:
                $response = self::getRecentUserImages($accessToken, $user, $count);
                break;
            case self::MEDIA_TYPE_USER_FEED:
                $response = self::getSelfFeed($accessToken, $count);;
                break;
            case self::MEDIA_TYPE_USER_LIKED :
                $response = self::getUserLikes($accessToken, $count);
                break;
            case self::MEDIA_TYPE_USER_FOLLOWERS :
                $response = self::getUserFollowers($accessToken, $user, $count);
                break;
            case self::MEDIA_TYPE_USER_FOLLOWS :
                $response = self::getUserFollows($accessToken, $user, $count);
                break;
            case self::MEDIA_TYPE_MOST_POPULAR :
                $response = self::getMostPopular($accessToken);
                break;
            case self::MEDIA_TYPE_TAGS_NAME :
                $response = self::getMediaTagged($accessToken, $tag);
                break;
            case self::MEDIA_TYPE_MEDIA_SEARCH :
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
    
    /**
     * Get info of users that the user follows
     * @param string $accessToken
     * @param string $username Username to check
     * @param int $count Number of Images to return
     * @return array Returns an array with the response
     */
    public static function getUserFollows($accessToken, $username, $count=30){
        $InstaUsers = new InstaUsers($accessToken);
        $usersResponse = json_decode($InstaUsers->search($username));
        $userID= $usersResponse->data[0]->id;
        $InstaRelation = new InstaRelationships($accessToken);
        $jsonResponse = $InstaRelation->getUserIdFollows($userID);
        $responses = json_decode($jsonResponse);
        return $responses;
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
