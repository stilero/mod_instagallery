<?php
/**
* Description of mod_instagallery
*
* @version  1.0
* @author Daniel Eliasson <daniel at stilero.com>
* @copyright  (C) 2013-sep-27 Stilero Webdesign (http://www.stilero.com)
* @category Custom Form field
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*
*
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

    class JFormFieldInstauser extends JFormField {
        protected $type = 'instauser';
        
        protected static function searchButton(){
            $buttonHtml = '<div class="button2-left">';
            $buttonHtml .= '<div class="blank">';
            $buttonHtml .= '<a class="" href="#" title="Search">Search</a>';
            $buttonHtml .= '</div>';
            $buttonHtml .= '</div>';
            return $buttonHtml;
        }
        
        /**
         * Static class for returnning selectlists.
         */
        protected static function getSelectInput(){
            $options = array('key' => JText::_('Translated value'));
            $htmlCode = '<select id="'.$this->id.'" name="'.$this->name.'" class="inputbox">';
            foreach ($options as $key => $value) {
                $selected = $this->value == $key ? ' selected="selected"' : '';
                $htmlCode .= '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            }
            $htmlCode .= '</select>';
            return $htmlCode;
        }
        
        protected function getInput(){
//            $jsFile = instauser::assetsURI.'js/jscript.js';
//            $cssFile= instauser::assetsURI.'css/cssfile.css';
//            $document =& JFactory::getDocument();
//            $document->addScript($jsFile);
//            $document->addStyleSheet($cssFile);
            $htmlCode = '<div class="fltlft">';
            $htmlCode .= '<input id="'.$this->id.'" name="'.$this->name.'" type="text" class="text_area" size="9" value="'.$this->value.'"/>';
            $htmlCode .= '</div>';
            $htmlCode .= self::searchButton();
            return $htmlCode;
        }
        
        protected function getLabel(){
            $toolTip = JText::_($this->element['description']);
            $text = JText::_($this->element['label']);
            $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
            return $labelHTML;
        }
        
    }//End Class
