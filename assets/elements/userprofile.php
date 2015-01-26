<?php
/**
* Description of mod_instagallery
*
* @version  1.0
* @author Daniel Eliasson <daniel at stilero.com>
* @copyright  (C) 2013-sep-26 Stilero Webdesign (http://www.stilero.com)
* @category Custom Form field
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*
*
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

    class JFormFieldUserprofile extends JFormField {
        protected $type = 'userprofile';
        
        
        
        protected function getInput(){
            $htmlCode = '<img id="profilepic" src="" />';
            return $htmlCode;
        }
        
        protected function getLabel(){
            $toolTip = JText::_($this->element['description']);
            $text = JText::_($this->element['label']);
            $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
            return $labelHTML;
        }
        
    }//End Class
