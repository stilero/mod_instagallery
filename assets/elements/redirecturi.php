<?php
/**
* Description of instaModule
*
* @version  1.1
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-11 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

    class JFormFieldRedirecturi extends JFormField {
        protected $type = 'redirecturi';

        protected function getInput(){
            $moduleAbsPath = JURI::root().'modules/mod_instagallery/helpers/catcher.php';
            $htmlCode = '<input type="text" id="'.$this->id.'" name="'.$this->name.'" value="'.$moduleAbsPath.'" size="50" />';
            return $htmlCode;
        }
        
        protected function getLabel(){
            $toolTip = JText::_('MOD_INSTAGALLERY_REDIRECT_URI_DESC');
            $text = JText::_('MOD_INSTAGALLERY_REDIRECT_URI');
            $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.' <small>('.JTEXT::_('MOD_INSTAGALLERY_REDIRECT_URI_SMALL').')</small></label>';
            return $labelHTML;        }
    }//End Class
