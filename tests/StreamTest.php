<?php

require __DIR__ . '/../vendor/autoload.php';

use ReevesC\NewsRiver\Stream;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{

  //
  //before each test
  //
  public function setUp()
  {
    //storing everything in _test object because its tidy, and should simplify clean up/garbage collection
    $this->_test = new stdClass();
    $this->_test->stream = new Stream();

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


  public function testSetApiToken()
  {
    //without token value
    $this->_test->stream->setApiToken('');
    $this->assertEmpty( $this->_test->stream->apiToken );
    $this->assertFalse( $this->_test->stream->isValid() );     

    //with token
    $token_str = 'fake-token';
    $this->_test->stream->setApiToken( $token_str );
    $this->assertEquals( $this->_test->stream->apiToken, $token_str );
    $this->assertTrue( $this->_test->stream->isValid() );     

  }


// ------------------------------------------------------------------------


  public function testSetQuery()
  {
    //without params
      $this->assertFalse( $this->_test->stream->query->hasParams() );
      $this->assertInstanceOf('ReevesC\NewsRiver\Query', $this->_test->stream->query);

    //with params
      $params = array(
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
      $this->_test->stream->setQuery( $params );
      $this->assertTrue( $this->_test->stream->query->hasParams() );
      $this->assertInstanceOf('ReevesC\NewsRiver\Query', $this->_test->stream->query);  

  }


// ------------------------------------------------------------------------


  public function testSetApiRequestUrl()
  {
    //without value
      $this->_test->stream->setApiRequestUrl('');
      //because we don't allow a blank value
      $this->assertNotEmpty( $this->_test->stream->apiRequestUrl );

    //with value
    $req_url_str = 'fake-request-url-string';
    $this->_test->stream->setApiRequestUrl( $req_url_str );
    $this->assertEquals( $this->_test->stream->apiRequestUrl, $req_url_str );

  }


// ------------------------------------------------------------------------



  public function testIsValid()
  {
    //test false
      //without apiToken
      $this->assertFalse( $this->_test->stream->isValid() );     

    //test true response
        //with apiToken and apiRequestUrl
        $this->_test->stream->setApiRequestUrl('any-non-blank-string-will-do');
        $this->_test->stream->setApiToken('fake-token');
        $this->assertTrue( $this->_test->stream->isValid() );

  }


// ------------------------------------------------------------------------



  public function testRequest()
  {


  }


// ------------------------------------------------------------------------




} //end class