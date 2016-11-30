<?php


namespace ReevesC\NewsRiver;


class Query
{

  public $params = array();
  public $fields = array();


  /**
   * 
   * @param $attributes
   *
   * @return void
   *
  **/
  public function __construct( $attributes = array() )
  {
    $this->setAttributes($attributes);

  } //end __construct()


//----------------------------------------------------------


  /**
   *
   * hasParams()
   * 
   * @param none
   *
   * @return boolean
   *
  **/
  public function hasParams()
  {
    return !empty($this->params);

  } //end hasParams()


//----------------------------------------------------------


  /**
   *
   * hasFields()
   * 
   * @param none
   *
   * @return boolean
   *
  **/
  public function hasFields()
  {
    return !empty($this->fields);

  } //end hasParams()


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
    if( !$this->hasFields() )
    {
      return false;
    }
    return true;

  }


//----------------------------------------------------------


  /**
   * 
   * setAttributes()
   *
   * @param $attributes array - array of query attributes
   *
   * @return void
   *
  **/
  public function setAttributes( $attributes = array() )
  {
    if( empty($attributes) || !is_array($attributes) )
    {
      return;
    }

    foreach( $attributes as $type => $value )
    {
      if( is_array($value) )
      {
        array_map(function($k, $v) use ($type) { return $this->add($type, $k, $v); }, array_keys($value), $value);
      }
    }
  }


//----------------------------------------------------------


  /**
   * 
   * add()
   *
   * @param name string - name of query attribute
   * @param value string - value to search for
   *
   * @return void
   *
  **/
  public function add( $type = 'fields', $name = '', $value = '' )
  {
    if($type == '' || $name == '' || $value == '') return;
    $this->{$type}[$name] = $value;
    return;

  }


//----------------------------------------------------------


  /**
   *  
   * buildQueryString()
   *
   * Concatenates params and fields into query string
   *
   * @param none
   *
   * @return string
   *
  **/
  public function buildQueryString()
  {
    if( !$this->isValid() )
    {
      return;
    }
    $fields = array_map( function($name, $value){ return "{$name}:{$value}"; }, array_keys($this->fields), $this->fields );
    $qs = '?query='.urlencode( implode(' AND ', $fields) );

    if( $this->hasParams() )
    {
      $qs .= '&'.http_build_query($this->params);
    }

    return $qs;

  }


//----------------------------------------------------------


} //end class