<?php
//require_once "../vendor/autoload.php";
require_once "../include/User.php";

class User_Test extends PHPUnit_Framework_TestCase {
    protected $user;

    protected function setUp() {
        $this->user = new User();
        $this->user->setName("Tom");
    }

    protected function tearDown() {
        unset($this->user);
    }

    public function testTalk() {
        $expected = "Hello world!";
        $actual = $this->user->talk();
        $this->assertEquals($expected, $actual);
    }
}
