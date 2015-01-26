<?php
/**
* Description of instaModule
*
* @version  1.1
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-12 Stilero Webdesign http://www.stilero.com
* @category Custom Form field
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldInstructions extends JFormField {
    protected $type = 'instructions';

    protected function getInput(){
        //JHTML::_('behavior.modal', 'a.modal');
        $linktext = JText::_('MOD_INSTAGALLERY_INSTRUCTIONS');
        $instagramURI = 'http://instagram.com/developer/clients/register/';
        //$handler = ' rel="'. "{handler: 'iframe', size:{ x:800, y:650}}".'"';
        //$class = ' class="modal"';
        $htmlCode = '<a id="'.$this->id.'" target="_blank" href="'.$instagramURI.'" title="'.$linktext.'">'.$linktext.'</a>';
        return $htmlCode;
    }

    protected function getLabel(){
        $toolTip = JText::_('MOD_INSTAGALLERY_INSTRUCTIONS_DESC');
        $text = JText::_('MOD_INSTAGALLERY_INSTRUCTIONS_LABEL');
        $labelHTML = '<span class="readonly">'.
                //'<label id="'.$this->id.'-lbl" for="'.$this->id.'" class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
                '<label class="hasTip" title="'.$text.'::'.$toolTip.'">'.$text.'</label>';
            '</span>';
        return $labelHTML;
    }
}//End Class