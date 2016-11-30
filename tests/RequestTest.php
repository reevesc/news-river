<?php

require __DIR__ . '/../vendor/autoload.php';

use ReevesC\NewsRiver\Request;
use ReevesC\NewsRiver\Query;

class RequestTest extends PHPUnit_Framework_TestCase
{

  //
  //before each test
  //
  public function setUp()
  {
    //storing everything in _test object because its tidy, and should simplify clean up/garabage collection
    $this->_test = new stdClass();
    $this->_test->stream = $this->getMockBuilder('ReevesC\NewsRiver\Stream')
                                ->getMock();

    //TODO - shouldn't need to do this
    $this->_test->stream->query = $this->getMockBuilder('ReevesC\NewsRiver\Query')
                                ->getMock();

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

  public function testIsValid()
  {
    //with invalid stream and invalid query params
    $this->_test->stream->method('isValid')
                        ->willReturn( false );
    $this->_test->stream->query->method('isValid')
                                     ->willReturn( false );

    $this->assertFalse( $this->_test->stream->request->isValid() );

    //TODO
      //Test valid stream/query params

  }

// ------------------------------------------------------------------------

/**

  TODO - we need to be able to test this, but we don't want to be making a live request 
         every single time a test is run...

  public function testSend()
  {

  }

**/

// ------------------------------------------------------------------------



} //end class