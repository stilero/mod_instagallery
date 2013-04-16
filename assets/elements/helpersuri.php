<?php
/**
* Description of instaModule
*
* @version  1.1
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-11 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license    GPLv2
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

    class JFormFieldHelpersuri extends JFormField {
        protected $type = 'helpersuri';

        protected function getInput(){
            $moduleAbsPath = JURI::root().'modules/mod_instagallery/helpers/';
            $htmlCode = '<input type="hidden" id="'.$this->id.'" name="'.$this->name.'" value="'.$moduleAbsPath.'"/>';
            return $htmlCode;
        }
        
        protected function getLabel(){
            return;
        }
    }//End Class
