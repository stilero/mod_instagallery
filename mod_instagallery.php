<?php
/**
 * @version SVN: $Id: mod_#module#.php 96 2011-08-11 06:59:32Z michel $
 * @package    Instagram
 * @subpackage Base
 * @author     Daniel Eliasson Stilero Webdesign
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die('Restricted access'); // no direct access
require_once dirname(__FILE__) . '/helper.php';
$accessToken = $params->get('access_token');
$count = $params->get('image_count');
$mediaType = $params->get('display_type', 'user-recent');
$galleryType = 'images-'.$params->get('gallery_type', 'default');
$tag = $params->get('tags_name', '');
$user = $params->get('user_name', 'self');
$lat = $params->get('latitude', '');
$lng = $params->get('longitude', '');
$preText = $params->get('pre_text', '');
$postText = $params->get('post_text', '');
$list = modInstagalleryHelper::getList($mediaType, $accessToken, $count, $tag, $user, $lat, $lng);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
if(isset($list) && count($list) > 0){
    require JModuleHelper::getLayoutPath('mod_instagallery',$params->get('layout', 'default'));
}
?>