<?php
/**
 * Class for easy access to media
 *
 * @version  1.0
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-sep-29 Stilero Webdesign (http://www.stilero.com)
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class InstaObjectMedia{
    
    public $location;
    public $comments;
    public $caption;
    public $link;
    public $likes;
    public $created_time;
    public $images;
    public $type;
    public $userInPhoto;
    public $filter;
    public $tags;
    public $id;
    public $user;
    
}
