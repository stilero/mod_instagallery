<?php
/**
 * @version SVN: $Id: mod_#module#.php 96 2011-08-11 06:59:32Z michel $
 * @package    Instagram
 * @subpackage Base
 * @author     Daniel Eliasson Stilero Webdesign
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die('Restricted access'); // no direct access
define('INSTAGALLERY_BASE_PATH', dirname(__FILE__));
define('MODULEURI', JURI::root().'modules/mod_instagallery/');
define('INSTAGRAM_API_PATH', INSTAGALLERY_BASE_PATH.'/includes/insta-api/');
define('INSTAGALLERY_HEPLERS_PATH', INSTAGALLERY_BASE_PATH.'/helpers/');
JLoader::register('InstaMediaHelper', INSTAGALLERY_HEPLERS_PATH.'instamediahelper.php');
$accessToken = $params->get('access_token');
$count = $params->get('image_count');
$displayType = $params->get('display_type', 'user-recent');
$galleryType = 'images-'.$params->get('gallery_type', 'default');
switch ($displayType) {
    case 'user-feed':
        $response = InstaMediaHelper::getRecentUserImages($accessToken, $params->get('user_name', 'self'), $count);
        break;
    case 'user-liked':
        $response = InstaMediaHelper::getUserLikes($accessToken, $count);
        break;
    case 'most-popular':
        $response = InstaMediaHelper::getMostPopular($accessToken);
        break;
    case 'tags-name':
        $response = InstaMediaHelper::getMediaTagged($accessToken, $params->get('tags_name', ''));
        break;
    case 'media-search':
        $response = InstaMediaHelper::getMediaByLocation($accessToken, $params->get('latitude', ''), $params->get('longitude', ''));
        break;
    default:
        $response = InstaMediaHelper::getSelfFeed($accessToken, $count);
        break;
}
/*
foreach ($response as $images) {
    foreach ($images as $image) {
        if(isset($image->images->thumbnail->url)){
            print '<img class="feed_image" src="'.$image->images->thumbnail->url.'" />';
        }
    }
}*/
$images = InstaMediaHelper::responseToArray($response);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_instagallery','default');
?>