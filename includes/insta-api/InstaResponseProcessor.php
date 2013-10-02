<?php
/**
 * Class for processing responses
 *
 * @version  1.0
 * @package Stilero
 * @subpackage mod_instagallery
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-sep-29 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class InstaResponseProcessor{
    
    protected $response;
    protected $nextUrl;
    protected $metaCode;
    
    public function __construct($response) {
        $this->response = $response;
        $this->process();
    }
    

    protected function process(){
        $decodedResponse = json_decode($this->response);
        if(isset($decodedResponse->pagination->next_url)){
            $this->nextUrl = $decodedResponse->pagination->next_url;
        }
        if(isset($decodedResponse->meta->code)){
            $this->metaCode = $decodedResponse->meta->code;
        }
        if(isset($decodedResponse->data)){
            $medias = array();
            foreach ($decodedResponse->data as $data) {
                $media = new InstaObjectMedia();
                $media->tags = $this->tags($data);
                $media->type = $this->type($data);
                $location = new InstaObjectLocation();
                $location->setLocation($data);
                $media->location = $location;
                $media->comments = $this->comments($data);
                $media->filter = $data->filter;
                $media->created_time = $data->created_time;
                $media->link = $data->link;
                $media->likes = $data->likes->count;
                $media->images = $this->images($data);
                $media->id = $data->id;
                $media->caption = $data->caption;
                $medias[] = $media;
            }
        }
        print "<pre>";
        var_dump($medias);
        print "</pre>";
        exit;
    }
    
    /**
     * Processes and extracts tags
     * @param stdObject $data
     * @return array Array with tags
     */
    protected function tags($data){
        $tags = array();
        if(isset($data->tags)){
            $tags = $data->tags;
        }
        return $tags;
    }
    
    protected function type($data){
        $type = '';
        if(isset($data->type)){
            $type = $data->type;
        }
        return $type;
    }
    
    protected function comments($data){
        $comments = array();
        if(isset($data->comments)){
            foreach ($data->comments as $comment) {
                $CommentObject = new InstaObjectComment();
                $CommentObject->setComment($comment);
                $User = new InstaObjectUser();
                $User->setUser($comment->from);
                $CommentObject->from = $User;
                $comments[] = $CommentObject;
            }
        }
        return $comments;
    }
    
    protected function image($image){
        $theImage = new InstaObjectImage();
        $theImage->height = $image->height;
        $theImage->width = $image->width;
        $theImage->url = $image->url;
        return $theImage;
    }
    
    protected function images($data){
        $images = array();
        $images['low_resolution'] = $this->image($data->images->low_resolution);
        $images['thumbnail'] = $this->image($data->images->thumbnail);
        $images['standard_resolution'] = $this->image($data->images->standard_resolution);
    }
    
    
}
