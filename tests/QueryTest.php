<?php

require __DIR__ . '/../vendor/autoload.php';

use ReevesC\NewsRiver\Query;

class QueryTest extends PHPUnit_Framework_TestCase
{

  //
  //before each test
  //
  public function setUp()
  {
    $this->_test = new stdClass();

    $this->_test->sampleParams = array(
      'params' => array(
        'limit' => 15,
      ),
      'fields' => array(
        'title' => 'Apollo',
        'text' => 'Rackspace',
        'website.domainName' => '',
        'metadata.readTime.seconds' => '70',
      )
    );
    $this->_test->query = new Query();

  }


// ------------------------------------------------------------------------


  //
  //after each test
  //
  protected function tearDown()
  {
    //clean up
    unset($this->_test);

  }


// ------------------------------------------------------------------------


  public function testHasParams()
  {
    //without
      $this->assertFalse( $this->_test->query->hasParams() );

    //with
      $this->_test->query->setAttributes( $this->_test->sampleParams );
      $this->assertTrue( $this->_test->query->hasParams() );
  }


// ------------------------------------------------------------------------


  public function testHasFields()
  {
    //without
      $this->assertFalse( $this->_test->query->hasFields() );

    //with
      $this->_test->query->setAttributes( $this->_test->sampleParams );
      $this->assertTrue( $this->_test->query->hasFields() );

  }


// ------------------------------------------------------------------------


  public function isValid()
  {
    //without fields
      $this->assertFalse( $this->_test->query->isValid() );

    //with fields/without params
      unset($this->_test->sampleParams['params']);
      $this->_test->query->setAttributes( $this->_test->sampleParams );
      $this->assertTrue( $this->_test->query->isValid() );
  }

// ------------------------------------------------------------------------


  public function testSetAttributes()
  {
    //make sure that params and attributes are empty
    $this->assertFalse( $this->_test->query->hasParams() );
    $this->assertFalse( $this->_test->query->hasFields() );

    $this->_test->query->setAttributes( $this->_test->sampleParams );
    $this->assertTrue( $this->_test->query->hasParams() );
    $this->assertTrue( $this->_test->query->hasFields() );

    //TODO
      //cross check with count on number of params/fields set?

  }


// ------------------------------------------------------------------------


  public function testAdd()
  {
    //test fields
      //make sure its empty
      $this->assertFalse( $this->_test->query->hasFields() );

      //add a test field
      $this->_test->query->add( 'fields', 'test_name', 'test value' );
      $this->assertTrue( $this->_test->query->hasFields() );
      $this->assertEquals( count($this->_test->query->fields), 1 );

    //test params
      //make sure params are empty
      $this->assertFalse( $this->_test->query->hasParams() );

      //add a test param
      $this->_test->query->add( 'params', 'test_name', 'test value' );
      $this->assertTrue( $this->_test->query->hasParams() );
      $this->assertEquals( count($this->_test->query->params), 1 );

  }


// ------------------------------------------------------------------------


  public function testBuildQueryString()
  {

    //add a test field
    $this->_test->query->add( 'fields', 'test_name', 'test value' );
    
    //add a test param
    $this->_test->query->add( 'params', 'test_name', 'test value' );


    //TODO - lets make this a bit more dynamic if possible - don't want to deal with
    //having to change that text base query string every time we make a change to the attributes
    $this->assertEquals( $this->_test->query->buildQueryString(), '?query=test_name%3Atest+value&test_name=test+value' );

  }


// ------------------------------------------------------------------------


} //end class