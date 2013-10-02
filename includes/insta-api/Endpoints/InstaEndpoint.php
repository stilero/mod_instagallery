<?php
/**
 * Class_Instagram_API
 *
 * @version  1.0
 * @package Stilero
 * @subpackage Class_Instagram_API
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-okt-20 Stilero Webdesign, Stilero AB
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class InstaEndpoint{
    
    protected $requestUrl = 'https://api.instagram.com/v1/';
    protected $accessToken;
    protected $params;
    public $count;
    protected $next_url;
    protected $response;
    protected $nextUrl;
    
    public function __construct($accessToken, $params = array()) {
        $this->accessToken = $accessToken;
        $this->params = $params;
        $this->response = array();
    }
    
    /**
     * Sends the query and returns the result
     * @param string $reqType Request type to use, for example "GET", "POST"
     * @return string JSON Response
     */
    public function query($reqType='', $count=30){
        $url = $this->requestUrl;
        $Communicator = new Communicator($url, $this->params);
        if($reqType!=''){
            $Communicator->setCustomRequest($reqType);
        }
        $Communicator->query();
        $json = $Communicator->getResponse();
        $this->processResponse($json);
        $this->responseWalk();

        return $this->response;
        //$json2 = json_encode($this->response);
        //var_dump($json2);exit;
        return $json;
    }
    
    /**
     * Processes the JSON Response and merges new response with old one.
     * @param string $json JSON Response
     */
    protected function processResponse($json){
        $response = json_decode($json);
        $this->nextUrl = '';
        if(isset($response->pagination->next_url)){
            $this->nextUrl = $response->pagination->next_url;
        }
        if(isset($response->data)){
            $this->response = array_merge($this->response, $response->data);
        }
    }
    
    /**
     * Handles recalls for getting more than 
     */
    protected function responseWalk(){
        if($this->nextUrl != ''){
            $respCount = count($this->response); 
            if($respCount < $this->count){
                $this->requestUrl = $this->nextUrl;
                $this->params = '';
                $this->query();
            }
        }
    }
    
}
