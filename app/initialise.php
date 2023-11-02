<?php
// include the config file from the root folder
include ROOT . 'config.php';

// write a test to confirm that the classes are initialised
class testInitialise extends PHPUnit_Framework_TestCase
{
    public function testAllClassesInitialised()
    {
        $this->assertTrue(class_exists('TrainingRoom'));
        $this->assertTrue(class_exists('TrainingProgram'));
        $this->assertTrue(class_exists('Client'));
        $this->assertTrue(class_exists('Employee'));
        $this->assertTrue(class_exists('Request'));

        $this->assertTrue(class_exists('MongoDB'));
        $this->assertTrue(class_exists('TrainingRoomController'));
        $this->assertTrue(class_exists('ClientController'));
        $this->assertTrue(class_exists('MongoDBClientController'));
        $this->assertTrue(class_exists('MongoDBTrainingRoomController'));
        $this->assertTrue(class_exists('MongoDBClientDAO'));
        $this->assertTrue(class_exists('MongoDBTrainingRoomDAO'));
        $this->assertTrue(class_exists('MongoDBClientDAOImpl'));
        $this->assertTrue(class_exists('MongoDBTrainingRoomDAOImpl'));
    }
}

// write a test to confirm that the classes are initialised
class testInitialise extends PHPUnit_Framework_TestCase
{
    public function testAllClassesInitialised()
    {
        $this->assertTrue(class_exists('TrainingRoom'));
        $this->assertTrue(class_exists('Client'));
        $this->assertTrue(class_exists('MongoDB'));
        $this->assertTrue(class_exists('TrainingRoomController'));
        $this->assertTrue(class_exists('ClientController'));
        $this->assertTrue(class_exists('MongoDBClientController'));
        $this->assertTrue(class_exists('MongoDBTrainingRoomController'));
        $this->assertTrue(class_exists('MongoDBClientDAO'));
        $this->assertTrue(class_exists('MongoDBTrainingRoomDAO'));
        $this->assertTrue(class_exists('MongoDBClientDAOImpl'));
        $this->assertTrue(class_exists('MongoDBTrainingRoomDAOImpl'));
    }
}
