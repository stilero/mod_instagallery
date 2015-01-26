<?php
/**
 * Object Comment
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

class InstaObjectComment{
    public $id;
    public $createdTime;
    public $text;
    public $from;
    
    public function setComment($comment){
        $this->createdTime = $comment->created_time;
        $this->text = $comment->text;
        $this->id = $comment->id;
    }
}
