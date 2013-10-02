<?php
/**
 * Object Location
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

class InstaObjectLocation{
    
    public $id;
    public $latitude;
    public $longitude;
    public $name;
    
    public function setLocation($data){
        if(isset($data->location->id)){
            $this->id = $data->location->id;
            $this->latitude = $data->location->latitude;
            $this->longitude = $data->location->longitude;
            $this->name = $data->location->name;
        }
    }
}
