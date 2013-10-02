<?php
/**
 * User Object
 *
 * @version  1.0
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-sep-29 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class InstaObjectUser{
    
    public $username;
    public $fullName;
    public $profilePicture;
    public $id;
    
    public function setUser($user){
        $this->fullName = $user->full_name;
        $this->id = $user->id;
        $this->profilePicture = $user->profile_picture;
        $this->username = $user->username;
    }
}
