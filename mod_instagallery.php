<?php
/**
 * @version SVN: $Id: mod_#module#.php 96 2011-08-11 06:59:32Z michel $
 * @package    Instagram
 * @subpackage Base
 * @author     Daniel Eliasson Stilero Webdesign
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access'); // no direct access
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('INSTAGALLERY_HELPERS', JPATH_ROOT.DS.'modules'.DS.'mod_instagallery'.DS.'helpers'.DS);
JLoader::register('ModInstaGalleryMediaType', INSTAGALLERY_HELPERS.'modInstaGalleryMediaType.php');
JLoader::register('ModInstagalleryGalleryType', INSTAGALLERY_HELPERS.'modInstagalleryGalleryType.php');
require_once dirname(__FILE__) . '/helper.php';
$accessToken = $params->get('access_token');
$count = $params->get('image_count');
$mediaType = $params->get('display_type', ModInstaGalleryMediaType::USER_RECENT);
$galleryPrefix = 'images-';
if(ModInstaGalleryMediaType::isUserMedia($mediaType)){
    $galleryPrefix = 'users-';
}
$galleryType = $galleryPrefix.$params->get('gallery_type', ModInstagalleryGalleryType::STANDARD);
$tag = $params->get('tags_name', '');
$user = $params->get('user_name', 'self');
$authUserID = $params->get('authuser_id', '');
$lat = $params->get('latitude', '');
$lng = $params->get('longitude', '');
$preText = $params->get('pre_text', '');
$postText = $params->get('post_text', '');
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$layout = $params->get('layout', 'default');
$list = modInstagalleryHelper::getList($mediaType, $accessToken, $count, $tag, $user, $lat, $lng, $authUserID);
//var_dump($list);exit;
if(isset($list) && count($list) > 0){
    require JModuleHelper::getLayoutPath('mod_instagallery',$layout);
}
/** TODO: Insert checks to see if the user is authorised before continuing */
?>