<?php

// Create a trainingRoom collection class that has the following methods:
// Create a method that will get all training rooms from the NoSQL database
// Create a method that will get all training rooms that are available from the NoSQL database (takes a date and time as a parameter)
// Create a method that will get all training rooms that are not available from the NoSQL database (takes a date and time as a parameter)

class TrainingRoomCollection
{
    private $db_handle;

    public function __construct($db_handle) {
        $this->db_handle = $db_handle->selectDatabase('ExpertTraining')->selectCollection('TrainingRooms');
    }

    // Getters and setters
    public function getDbHandle() {
        return $this->db_handle;
    }

    public function setDbHandle($db_handle) {
        $this->db_handle = $db_handle;
    }

    public function getAllTrainingRooms(){
        // Get all training rooms from the NoSQL database
        $result = $this->db_handle->find([]);
        // Create an array to store the training room objects
        foreach ( $result as $trainingRoom ) {
            $trainingRoomHandler = new TrainingRoom(
                $trainingRoom['trainingRoomName'], 
                $trainingRoom['trainingRoomImageLink'], 
                $trainingRoom['trainigRoomAvalability'], 
                $trainingRoom['trainingRoomCapacity']
            );
            
            $trainingRoomArray[] = $trainingRoomHandler->retrieveRoom(
                $trainingRoom['trainingRoomName'],
                $this->db_handle
            );
        }
        return $trainingRoomArray;
    }

    public function getAllTrainingRoomsAvailable($date, $time){
        // Get all training rooms that are available from the NoSQL database
        $result = $this->db_handle->TrainingRooms->find(array('trainigRoomAvalability' => $date . ' ' . $time));
        // Create an array to store the training room objects
        foreach ( $result as $trainingRoom ) {
            $trainingRoomHandler = new TrainingRoom(
                $trainingRoom['trainingRoomName'], 
                $trainingRoom['trainingRoomImageLink'],
                $trainingRoom['trainigRoomAvalability'], 
                $trainingRoom['trainingRoomCapacity']
            );
            $trainingRoomArray[] = $trainingRoomHandler->retrieveRoom(
                $trainingRoom['trainingRoomName']
            );
        }
        return $trainingRoomArray;
    }

    public function getAllTrainingRoomsNotAvailable($date, $time){
        // Get all training rooms that are not available from the NoSQL database
        $result = $this->db_handle->TrainingRooms->find(array('trainigRoomAvalability' => array('$ne' => $date . ' ' . $time)));
        // Create an array to store the training room objects
        foreach ( $result as $trainingRoom ) {
            $trainingRoomHandler = new TrainingRoom(
                $trainingRoom['trainingRoomName'], 
                $trainingRoom['trainingRoomImageLink'], 
                $trainingRoom['trainigRoomAvalability'], 
                $trainingRoom['trainingRoomCapacity']
            );
            $trainingRoomArray[] = $trainingRoomHandler->retrieveRoom(
                $trainingRoom['trainingRoomName']
            );
        }

        return $trainingRoomArray;
    }

    public function getTrainingRoomById($id) {
        // Get a training room by id from the NoSQL database
        $result = $this->db_handle->findOne(['trainingRoomID' => $id]);
    
        if ($result) {
            // Create a TrainingRoom object
            $trainingRoom = new TrainingRoom(
                $result['trainingRoomName'], 
                $result['trainingRoomImageLink'], 
                $result['trainigRoomAvalability'], 
                $result['trainingRoomCapacity']
            );
    
            // Assuming that setTrainingRoomID exists in TrainingRoom class
            $trainingRoom->setTrainingRoomID($result['trainingRoomID']);
            
            return $trainingRoom;
        }
    
        return null;
    }    
}

