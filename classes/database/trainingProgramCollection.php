<?php

// Create a trainingProgram collection class that has the following methods:
// Create a method that will get all training programs from the NoSQL database
// Create a method that will get all training programs that are approved from the NoSQL database
// Create a method that will get all training programs that are denied from the NoSQL database
// Create a method that will get all training programs that are pending from the NoSQL database

class TrainingProgramCollection 
{
    private $db_handle;

    public function __construct($db_handle) {
        $this->db_handle = $db_handle;
    }

    public function getAllTrainingPrograms(){
        // Get all training programs from the NoSQL database
        $result = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('TrainingPrograms')->find([]);
        // Create an array to store the training program objects
        foreach ( $result as $trainingProgram ) {
            $trainingProgramArray[] = new TrainingProgram(
                $trainingProgram['trainingProgramID'],
                $trainingProgram['trainingProgramName'], 
                $trainingProgram['trainingProgramDescription'], 
                $trainingProgram['trainingProgramImagePath'], 
                $trainingProgram['trainingProgramDate'], 
                $trainingProgram['trainingProgramPrice'], 
                $trainingProgram['trainingProgramTime'], 
                $trainingProgram['trainingProgramDuration'], 
                $trainingProgram['trainingTutorName'],
                $trainingProgram['trainingEmployeeId']

            );
        }
        return $trainingProgramArray;
    }

    public function getTrainingProgramById($id){
        // Get a training program by id from the NoSQL database
        $result = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('TrainingPrograms')->findOne(['trainingProgramID' => $id]);
    
        if ($result) {
            // Create a TrainingProgram object
            $trainingProgram = new TrainingProgram(
                $result['trainingProgramID'],
                $result['trainingProgramName'], 
                $result['trainingProgramDescription'], 
                $result['trainingProgramImagePath'], 
                $result['trainingProgramDate'], 
                $result['trainingProgramPrice'], 
                $result['trainingProgramTime'], 
                $result['trainingProgramDuration'], 
                $result['trainingTutorName'],
                $result['trainingEmployeeId']
            );
    
            // Set the ID for the training program
            $trainingProgram->setTrainingProgramID($result['trainingProgramID']);
            
            return $trainingProgram;
        }
    
        return null;
    }
    

    public function getAllTrainingProgramsApproved(){
        // Get all training programs that are approved from the NoSQL database
        $result = $this->db_handle->TrainingPrograms->find(
            array('trainingProgramStatus' => 'Approved'), ['sort' => ['trainingProgramDate' => 1]]
        );
        // Create an array to store the training program objects
        foreach ( $result as $trainingProgram ) {
            $trainingProgramArray[] = new TrainingProgram(
                $trainingProgram['trainingProgramID'],
                $trainingProgram['trainingProgramName'], 
                $trainingProgram['trainingProgramDescription'], 
                $trainingProgram['trainingProgramImagePath'], 
                $trainingProgram['trainingProgramDate'], 
                $trainingProgram['trainingProgramPrice'], 
                $trainingProgram['trainingProgramTime'], 
                $trainingProgram['trainingProgramDuration'], 
                $trainingProgram['trainingTutorName'],
                $trainingProgram['trainingEmployeeId']
                
            );
        }
        return $trainingProgramArray;
    }

    public function getAllTrainingProgramsDenied(){
        // Get all training programs that are denied from the NoSQL database
        $result = $this->db_handle->TrainingPrograms->find(array('trainingProgramStatus' => 'Denied'), ['sort' => ['trainingProgramDate' => 1]]);
        // Create an array to store the training program objects
        foreach ( $result as $trainingProgram ) {
            $trainingProgramArray[] = new TrainingProgram(
                $trainingProgram['trainingProgramID'],
                $trainingProgram['trainingProgramName'], 
                $trainingProgram['trainingProgramDescription'], 
                $trainingProgram['trainingProgramImagePath'], 
                $trainingProgram['trainingProgramDate'], 
                $trainingProgram['trainingProgramPrice'], 
                $trainingProgram['trainingProgramTime'], 
                $trainingProgram['trainingProgramDuration'], 
                $trainingProgram['trainingTutorName'],
                $trainingProgram['trainingEmployeeId']
            );
        }
        return $trainingProgramArray;
    }

    public function getAllTrainingProgramsPending(){
        // Get all training programs that are pending from the NoSQL database
        $result = $this->db_handle->TrainingPrograms->find(array('trainingProgramStatus' => 'Pending'), ['sort' => ['trainingProgramDate' => 1]]);
        // Create an array to store the training program objects
        foreach ( $result as $trainingProgram ) {
            $trainingProgramArray[] = new TrainingProgram(
                $trainingProgram['trainingProgramID'],
                $trainingProgram['trainingProgramName'], 
                $trainingProgram['trainingProgramDescription'], 
                $trainingProgram['trainingProgramImagePath'], 
                $trainingProgram['trainingProgramDate'], 
                $trainingProgram['trainingProgramPrice'], 
                $trainingProgram['trainingProgramTime'], 
                $trainingProgram['trainingProgramDuration'], 
                $trainingProgram['trainingTutorName'],
                $trainingProgram['trainingEmployeeId']
            );
        }
        return $trainingProgramArray;
    }
}