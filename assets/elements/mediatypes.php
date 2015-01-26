<?php
/**
* Custom Element class for Media types
*
* @version  1.0
* @author Daniel Eliasson <daniel at stilero.com>
* @copyright  (C) 2013-aug-17 Stilero Webdesign (http://www.stilero.com)
* @category Custom Form field
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
if(!defined('INSTAGALLERY_HELPERS')){
    define('INSTAGALLERY_HELPERS', JPATH_ROOT.DS.'modules'.DS.'mod_instagallery'.DS.'helpers'.DS);
}
JLoader::register('ModInstaGalleryMediaType', INSTAGALLERY_HELPERS.'modInstaGalleryMediaType.php');
class JFormFieldMediatypes extends JFormField {
    
    protected $type = 'mediatypes';
    
    /**
     * Returns the HTML for the input
     * @return string HTML-Code for the input
     */
    protected function getInput(){
        $mediaTypes = ModInstaGalleryMediaType::getMediaTypes();
        $htmlCode = '<select id="'.$this->id.'" name="'.$this->name.'" class="inputbox">';
        foreach ($mediaTypes as $key => $value) {
            $selected = $this->value == $key ? ' selected="selected"' : '';
            $htmlCode .= '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
        }
        $htmlCode .= '</select>';
        return $htmlCode;
    }
    
    /**
     * Returns HTML for the Label
     * @return string HTML
     */
    protected function getLabel(){
        $toolTip = JText::_($this->element['description']);
        $text = JText::_($this->element['label']);
        $labelHTML = '<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
        return $labelHTML;
    }

}//End Class