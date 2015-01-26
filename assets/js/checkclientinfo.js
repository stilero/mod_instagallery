/**
* Script for authorising with InstaGram
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category MooTools script
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
window.addEvent('domready', function(){

    var clientIdInput = $('jform_params_client_id');
    var clientID = clientIdInput.value;
    var clientSecretInput = $('jform_params_client_secret');
    var clientSecret = clientSecretInput.value;
    var redirectURIInput = $('jform_params_redirect_uri');
    var redirectURI = redirectURIInput.value;
    var authCode = $('jform_params_auth_code').value;
    var authCodeInput = $('jform_params_auth_code');
    var accessTokenInput = $('jform_params_access_token');
    var authuserIdInput = $('jform_params_authuser_id');
    var authuserPicInput = $('jform_params_authuser_profile');
    var authuserPicUrlInput = $('jform_params_authuser_profile_url');
    var authuserNameInput = $('jform_params_authuser_name');
    var accessToken = accessTokenInput.value;
    //var catcherURI = $('jform_params_helpers_uri').value + 'catcher.php';
    var catcherURI = redirectURI;
    var authButton = $('jform_params_authorize');

    var sendVars;
    
    
    /**
     * Sets the correck auth link based on the client id and cather uri
     */
    var setLinkHref = function(){
        var link = 'https://api.instagram.com/oauth/authorize/' + 
            '?client_id=' + clientID +
            '&redirect_uri=' + catcherURI +
            '&response_type=code';
        $( 'jform_params_authorize').href = link;
    };
    
    /**
     * Controls displaying of the connect button. If client ID and secret is set
     * the button is visible
     */
    var buttonDisplay = function(){
        if(clientID == '' || clientSecret == '' || redirectURI == ''){
            authButton.setStyle( 'display', 'none');
        }else{
             setLinkHref();
             authButton.setStyle( 'opacity', '0');
             authButton.setStyle( 'display', 'block');
             authButton.fade('in');
        }
    };
    
    /**
     * Displays the profile picture
     * @param string src URL to the profile image
     */
    var createImage = function(src){
        if(src !== ""){
            $('profilepic').set('src', src);
        }
    };
    
    /**
     * Handles the response from the ajax call
     * @param JSON response the ajax response
     */
    var handleResponse = function(response){
        if((response.access_token == undefined)){
            var errormsg = '(' + response.code + ')' +
                response.error_type + '\n' +
                response.error_message;
                alert(errormsg);
        }else{
            accessTokenInput.value = response.access_token;
            authuserNameInput.value = response.user['username'];
            authuserIdInput.value = response.user['id'];
            authuserPicUrlInput.value = response.user['profile_picture'];
            createImage(response.user['profile_picture']);
            accessTokenInput.value = response.access_token;
            authCodeInput.value = '';        
            alert(MOD_INSTAGALLERY_JS_SUCCESS);
        }
    };
    
    /**
     * AJAX call for requesting the accesstoken
     */
    var requestAccessToken = function(){
        //authCode = authCode;
        var reqUrl = $('jform_params_helpers_uri').value + 'authorizer.php';
        sendVars = 'client_id=' + clientID +
            '&client_secret=' + clientSecret +
            '&grant_type=authorization_code' +
            '&code=' + authCode +
            '&redirect_uri=' + catcherURI;
        var myRequest = new Request.JSON({
            url: reqUrl,
            method: 'post',
            data:{'client_id': clientID,
                'client_secret': clientSecret,
                'grant_type': 'authorization_code',
                'code': authCode,
                'redirect_uri': catcherURI
            },
            onSuccess: function(responseText){
                handleResponse(responseText);
            },
            onError: function(responseText){
                handleResponse(responseText);
                alert('onError');
                alert(MOD_INSTAGALLERY_JS_FAILURE + responseText.status);
            },
            onFailure: function(responseText){
                handleResponse(responseText);
                alert('onFailure');
                alert(MOD_INSTAGALLERY_JS_FAILURE + responseText.status);
            }
        });
        
        myRequest.send();    
    };
    
    buttonDisplay();
    createImage(authuserPicUrlInput.value);

    $('jform_params_client_id').addEvent('keyup', function(){
        clientID = $('jform_params_client_id').value;
        buttonDisplay();
    });
    
    $('jform_params_client_secret').addEvent('keyup', function(){
        clientSecret = $('jform_params_client_secret').value;
        buttonDisplay();
    });
    
    $('jform_params_redirect_uri').addEvent('change', function(){
        redirectURI = $('jform_params_redirect_uri').value;
        setLinkHref();
        buttonDisplay();
    });
    
    $('jform_params_auth_code').addEvent('change', function(){
        authCode = $('jform_params_auth_code').value;
        requestAccessToken();
    });
        
});