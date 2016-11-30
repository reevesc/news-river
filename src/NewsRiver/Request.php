<?php


namespace ReevesC\NewsRiver;

use ReevesC\NewsRiver\Query;

class Request 
{

  public $stream;

  /**
   * 
   * @param $token string
   * @param params array()
   *
   * @return void
   *
  **/
  public function __construct($stream = null)
  {
    $this->stream = $stream;

  } 


//----------------------------------------------------------


  /**
   * 
   * isValid()
   *
   * @param none
   *
   * @return boolean
   *
  **/
  public function isValid()
  {
    if( !$this->stream->isValid() || !$this->stream->query->isValid() )
    {
      return false;
    }
    return true;

  }


//----------------------------------------------------------


  /**
   * 
   * send()
   *
   * @param returnType string (array|object) - specify whether data should be returned as array or object
   *
   * @return mixed (false if invalid - array otherwise)
   *
  **/
  public function send( $returnType = 'array' )
  {
    if( !$this->isValid() )
    {
      return false;
    }

    $returnArray = ( $returnType === 'array' ) ? true : false;

    $headers = array(
      "Authorization: {$this->stream->apiToken}"
    );

    /*
      TODO
       Look into curl_multi_* functions here...
    */
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_URL => $this->stream->apiRequestUrl.$this->stream->query->buildQueryString(),
    ));

    $results = curl_exec($ch);
    curl_close($ch);

    return json_decode($results, $returnArray);

  } //end _sendRequest()


//----------------------------------------------------------


}