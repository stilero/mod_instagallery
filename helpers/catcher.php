<?php
/**
 * Small class to authorize the oauth
 * 
 * The images will be contained as follows:
 * $response[][]->image->images->thumbnail->url
 *
 * @version  1.0
 * @author Daniel Eliasson (joomla@stilero.com)
 * @copyright  (C) 2013-apr-16 Stilero Webdesign (www.stilero.com)
 * @category Module Helper
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('_JEXEC', 1); 

// no direct access
defined('_JEXEC') or die('Restricted access'); 

?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js" type="text/javascript"></script>
        <script type="text/javascript">
            window.addEvent('domready', function(){
                var code = $('catchcode').get('text');
                window.opener.$('jform_params_auth_code').value = code;
                window.opener.$('jform_params_auth_code').fireEvent('change');
                window.close();
            });
        </script>
    </head>
    <body bgcolor="#FFFFFF">
        <div id="catchcode"><?php echo $_GET['code']; ?></div>
    </body>
</html>

