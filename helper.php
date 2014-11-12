<?php
/**
 * Helper for InstaGallery. Basically helps retrieving images and info from Instagram.
 *
 * @version  1.2
 * @package Stilero
 * @subpackage InstaGallery
 * @author Daniel Eliasson (joomla@stilero.com)
 * @copyright  (C) 2013-apr-24 Stilero Webdesign (www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('INSTAGALLERY_BASE_PATH', dirname(__FILE__));
define('INSTAGRAM_API_PATH', INSTAGALLERY_BASE_PATH.DS.'includes'.DS.'insta-api'.DS);
JLoader::register('InstaEndpoint', INSTAGRAM_API_PATH.'Endpoints'.DS.'InstaEndpoint.php');
JLoader::register('Communicator', INSTAGRAM_API_PATH.'Communicator.php');
JLoader::register('InstaResponseProcessor', INSTAGRAM_API_PATH.'InstaResponseProcessor.php');
JLoader::register('InstaMedia', INSTAGRAM_API_PATH.'Endpoints'.DS.'InstaMedia.php');
JLoader::register('InstaTags', INSTAGRAM_API_PATH.'Endpoints'.DS.'InstaTags.php');
JLoader::register('InstaLocations', INSTAGRAM_API_PATH.'Endpoints'.DS.'InstaLocations.php');
JLoader::register('InstaUsers', INSTAGRAM_API_PATH.'Endpoints'.DS.'InstaUsers.php');
JLoader::register('InstaRelationships', INSTAGRAM_API_PATH.'Endpoints'.DS.'InstaRelationships.php');
//OBJECT
JLoader::register('InstaObjectMedia', INSTAGRAM_API_PATH.'Endpoints'.DS.'Objects'.DS.'InstaObjectMedia.php');
JLoader::register('InstaObjectComment', INSTAGRAM_API_PATH.'Endpoints'.DS.'Objects'.DS.'InstaObjectComment.php');
JLoader::register('InstaObjectImage', INSTAGRAM_API_PATH.'Endpoints'.DS.'Objects'.DS.'InstaObjectImage.php');
JLoader::register('InstaObjectImageTypes', INSTAGRAM_API_PATH.'Endpoints'.DS.'Objects'.DS.'InstaObjectImageTypes.php');
JLoader::register('InstaObjectLocation', INSTAGRAM_API_PATH.'Endpoints'.DS.'Objects'.DS.'InstaObjectLocation.php');
JLoader::register('InstaObjectUser', INSTAGRAM_API_PATH.'Endpoints'.DS.'Objects'.DS.'InstaObjectUser.php');

class modInstagalleryHelper{
    
    /**
     * Convenient static methor to retrive the images and info
     * @param string $mediaType The type of media to retireve. Use constants of this class
     * @param string $accessToken The Accesstoken
     * @param int $count number of rows to return. Max = 30 (usually)
     * @param string $tag Tag name to use, for example "streetphoto_bw"
     * @param string $user User Name to use, for example "streetpeople"
     * @param string $lat Latitude for locations, for example "52.12345"
     * @param string $lng Longitude for locations, for example "54.12345"
     * @param int $authUserId User ID for the authorized user, for example 1234556
     * @return Array Array with the response
     */
    public static function getList($mediaType, $accessToken, $count=20, $tag='', $user='', $lat='', $lng='', $authUderId=''){
        switch ($mediaType) {
            case ModInstaGalleryMediaType::USER_RECENT:
                $response = self::getRecentUserImages($accessToken, $user, $count);
                break;
            case ModInstaGalleryMediaType::USER_FEED :
                $response = self::getSelfFeed($accessToken, $count, $authUderId);
                break;
            case ModInstaGalleryMediaType::USER_LIKED :
                $response = self::getUserLikes($accessToken, $user, $count);
                break;
            case ModInstaGalleryMediaType::USER_FOLLOWERS :
                $response = self::getUserFollowers($accessToken, $user, $count);
                break;
            case ModInstaGalleryMediaType::USER_FOLLOWS :
                $response = self::getUserFollows($accessToken, $user, $count);
                break;
            case ModInstaGalleryMediaType::MOST_POPULAR :
                $response = self::getMostPopular($accessToken, $count);
                break;
            case ModInstaGalleryMediaType::TAGS_NAME :
                $response = self::getMediaTagged($accessToken, $tag, $count);
                break;
            case ModInstaGalleryMediaType::MEDIA_SEARCH :
                $response = self::getMediaByLocation($accessToken, $lat, $lng);
                break;
            default:
                $response = self::getSelfFeed($accessToken, $count);
                break;
        }
        //return self::responseToArray($response);
        return $response;
    }
    
        /**
     * Get the images in the feed of the logged in person
     * @param string $accessToken
     * @param int $count
     * @return Object
     */
    public static function getSelfFeed($accessToken, $count, $authUserId){
        $InstaUsers = new InstaUsers($accessToken);
        //$result = $InstaUsers->getSelfFeed($count);
        $result = $InstaUsers->getUserIdMediaRecent($authUserId, $count);
        return $result;
        $images = json_decode($result);
        return $images;
    }
    
    /**
     * Returns the user ID for the Username provided
     * @param string $accessToken
     * @param string $username
     * @return string User ID
     */
    public static function getUserIdFromUserName($accessToken, $username){
        $InstaUsers = new InstaUsers($accessToken);
        $users = $InstaUsers->search($username);
        $userid = null;
        if(isset($users[0]->id)){
            $userid= $users[0]->id;
        }
        return $userid;
    }
    
    /**
     * Get the latest images from the username
     * @param string $accessToken
     * @param string $username
     * @param int $count
     * @return Object
     */
    public static function getRecentUserImages($accessToken, $username, $count=30) {
        $userid = self::getUserIdFromUserName($accessToken, $username);
        if($userid != null){
            $InstaUsers = new InstaUsers($accessToken);
            $images = $InstaUsers->getUserIdMediaRecent($userid, $count);
            //var_dump($images);exit;
            return $images;
        }else{
            return array();
        }
        //$images = json_decode($InstaUsers->getUserIdMediaRecent($userid, $count));
        //return $images;
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
        $InstaTags->count = $count;
        $response = $InstaTags->getRecentMediaByTag($tagName);
        return $response;
    }
    
    /**
     * Get the lates images that the logged in user has liked
     * @param string $accessToken
     * @param int $count
     * @return Object
     */
    public static function getUserLikes($accessToken, $username, $count=30){
        $userid = self::getUserIdFromUserName($accessToken, $username);
        if($userid != null){
            $InstaUsers = new InstaUsers($accessToken);
            $images = $InstaUsers->getSelfMediaLiked($count);
            return $images;
        }else{
            return array();
        }
    }
    
    /**
     * Get the most popular images
     * @param string $accessToken
     * @return Object
     */
    public static function getMostPopular($accessToken, $count=30){
        $InstaMedia = new InstaMedia($accessToken);
        $InstaMedia->count = $count;
        $response = $InstaMedia->getPopular();
        return $response;
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
        return $response;
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
        $userid = self::getUserIdFromUserName($accessToken, $username);
        if($userid != null){
            $InstaRelation = new InstaRelationships($accessToken);
            $users = $InstaRelation->getUserIdFollows($userid);
            return $users;
        }else{
            return array();
        }
    }
    
     /* Get info of users that the user follows
     * @param string $accessToken
     * @param string $username Username to check
     * @param int $count Number of Images to return
     * @return array Returns an array with the response
     */
    public static function getUserFollowers($accessToken, $username, $count=30){
        $userid = self::getUserIdFromUserName($accessToken, $username);
        if($userid != null){
            $InstaRelation = new InstaRelationships($accessToken);
            $images = $InstaRelation->getUserIdFollowedBy($userid);
            return $images;
        }else{
            return array();
        }
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
