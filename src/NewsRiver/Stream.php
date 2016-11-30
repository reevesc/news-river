<?php

namespace ReevesC\NewsRiver;

use ReevesC\NewsRiver\QueryAttributes;
use ReevesC\NewsRiver\Request;

class Stream
{

  public $apiRequestUrl = 'https://api.newsriver.io/v2/search/';
  public $apiToken = '';

  public $query;
  public $request;


  /**
   * 
   * @param $token string
   * @param params array()
   *
   * @return void
   *
  **/
  public function __construct($token = NULL, $queryParams = NULL, $apiRequestUrl = NULL)
  {
    $this->setApiToken($token);
    $this->setQuery( $queryParams );
    $this->setApiRequestUrl( $apiRequestUrl );

    $this->request = new Request( $this );

  } //end __construct()


//----------------------------------------------------------


  /**
   * 
   * setApiToken()
   *
   * @param $token string
   *
   * @return void
   *
  **/
  public function setApiToken( $token = NULL )
  {
    $this->apiToken = $token;

  }


//----------------------------------------------------------


  /**
   * 
   * setQuery()
   *
   * @param $queryParams array
   *
   * @return void
   *
  **/
  public function setQuery( $queryParams = array() )
  {
    $this->query = new Query($queryParams);

  }


//----------------------------------------------------------


  /**
   * 
   * setApiRequestUrl()
   *
   * @param $requestUrl string
   *
   * @return void
   *
  **/
  public function setApiRequestUrl( $requestUrl = NULL )
  {
    $this->apiRequestUrl = ( !empty($requestUrl) ) ? $requestUrl : $this->apiRequestUrl;

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
    if( $this->apiRequestUrl == '' || $this->apiToken == '' )
    {
      return false;
    }
    return true;

  }


//----------------------------------------------------------


  /**
   * 
   * request()
   *
   * @param returnType string - return data as array or object
   *
   * @return mixed array or object depending on what user specified
   *
  **/
  public function request( $returnType = 'array' )
  {
    return $this->request->send( $returnType );

  }


//----------------------------------------------------------


} //end class