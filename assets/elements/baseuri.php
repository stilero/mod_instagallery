<?php
/**
* Description of instaModule
*
* @version  1.2
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-11 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

    class JFormFieldBaseuri extends JFormField {
        protected $type = 'baseuri';

        protected function getInput(){
            $moduleAbsPath = JPATH_SITE.'/modules/mod_instagallery/';
            $htmlCode = '<input type="hidden" id="'.$this->id.'" name="'.$this->name.'" value="'.$moduleAbsPath.'"/>';
            return $htmlCode;
        }
        
        protected function getLabel(){
            return;
        }
    }//End Class
