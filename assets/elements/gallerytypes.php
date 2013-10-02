<?php
/**
* Elements for Gallery types
*
* @version  1.0
* @author Daniel Eliasson <daniel at stilero.com>
* @copyright  (C) 2013-aug-17 Stilero Webdesign (http://www.stilero.com)
* @category Custom Form field
* @license    GPLv2
*
*
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');
if(!defined('INSTAGALLERY_HELPERS')){
    define('INSTAGALLERY_HELPERS', JPATH_ROOT.DS.'modules'.DS.'mod_instagallery'.DS.'helpers'.DS);
}
JLoader::register('ModInstagalleryGalleryType', INSTAGALLERY_HELPERS.'modInstagalleryGalleryType.php');

class JFormFieldGallerytypes extends JFormField {
    protected $type = 'gallerytypes';

    /**
     * Returns the HTML for the input
     * @return string HTML-Code for the input
     */
    protected function getInput(){
        $mediaTypes = ModInstagalleryGalleryType::getTypes();
        $htmlCode = '<select id="'.$this->id.'" name="'.$this->name.'" class="inputbox">';
        foreach ($mediaTypes as $key => $value) {
            $selected = $this->value == $key ? ' selected="selected"' : '';
            $htmlCode .= '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
        }
        $htmlCode .= '</select>';
        return $htmlCode;
    }

    protected function getLabel(){
        $toolTip = JText::_($this->element['description']);
        $text = JText::_($this->element['label']);
        $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
        return $labelHTML;
    }

}//End Class