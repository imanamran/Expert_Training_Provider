<?php

/**
 * > This class is an abstraction that represents a training program on the Expert Training website. The class will allow
 * the operations of adding, updating, deleting, and getting a training program from the NoSQL database.
 * 
 * > The class has the following properties:
 * trainingProgramID, trainingProgramName, trainingProgramDescription, trainingProgramDate, trainingProgramTime, trainingProgramDuration, and trainingTutorName
 */
class TrainingProgram 
{
    private $trainingProgramID;
    private $trainingProgramName;
    private $trainingProgramDescription;
    private $trainingProgramImagePath;
    private $trainingProgramPrice;
    private $trainingProgramDate;
    private $trainingProgramTime;
    private $trainingProgramDuration;
    private $trainingTutorName;
    private $trainingEmployeeId;

    /**
     * > This is the constructor for the TrainingProgram class. It takes in the trainingProgramID, trainingProgramName, 
     * trainingProgramDescription, trainingProgramDate, trainingProgramTime, trainingProgramDuration, and trainingTutorName
     * and initializes the properties of the training program object to their correct values.
     * 
     * > This constructor can be used when a user adds a training program to the Expert Training website. The user will
     * provide the trainingProgramID, trainingProgramName, trainingProgramDescription, trainingProgramDate, trainingProgramTime, 
     * trainingProgramDuration, and trainingTutorName via the training program form. The trainingProgramID is generated
     * by the system and is a unique identifier for the training program. The trainingProgramName is the name of the training 
     * program. The trainingProgramDescription is a description of the training program. The trainingProgramDate is the date 
     * that the training program will be held. The trainingProgramTime is the time that the training program will be held. The 
     * trainingProgramDuration is the duration of the training program. The trainingTutorName is the name of the tutor that will 
     * be conducting the training program.
     */
    public function __construct(
            $trainingProgramID,
            $trainingProgramName,
            $trainingProgramDescription,
            $trainingProgramImagePath,
            $trainingProgramDate,
            $trainingProgramPrice,
            $trainingProgramTime,
            $trainingProgramDuration,
            $trainingTutorName,
            $trainingEmployeeId
        ) {
        $this->trainingProgramID = $trainingProgramID;
        $this->trainingProgramName = $trainingProgramName;
        $this->trainingProgramDescription = $trainingProgramDescription;
        $this->trainingProgramImagePath = $trainingProgramImagePath;
        $this->trainingProgramPrice = $trainingProgramPrice;
        $this->trainingProgramDate = $trainingProgramDate;
        $this->trainingProgramTime = $trainingProgramTime;
        $this->trainingProgramDuration = $trainingProgramDuration;
        $this->trainingTutorName = $trainingTutorName;
        $this->trainingEmployeeId = $trainingEmployeeId;
    }

    public function fromLoad(
        $trainingProgramID,
        $trainingProgramName,
        $trainingProgramDescription,
        $trainingProgramImagePath,
        $trainingProgramDate,
        $trainingProgramPrice,
        $trainingProgramTime,
        $trainingProgramDuration,
        $trainingTutorName,
        $trainingEmployeeId
    ) {
        $instance = new self(
            $trainingProgramName,
            $trainingProgramDescription,
            $trainingProgramImagePath,
            $trainingProgramDate,
            $trainingProgramPrice,
            $trainingProgramTime,
            $trainingProgramDuration,
            $trainingTutorName,
            $trainingEmployeeId
        );
        $instance->trainingProgramID = $trainingProgramID;

    }
    

    // Getters and Setters for the trainingProgramImagePath
    public function getTrainingProgramImagePath() {
        return $this->trainingProgramImagePath;
    }

    public function setTrainingProgramImagePath($trainingProgramImagePath) {
        $this->trainingProgramImagePath = $trainingProgramImagePath;
    }

    // Getters and Setters for the trainingProgramID
    public function getTrainingProgramID() {
        return $this->trainingProgramID;
    }
    
    public function setTrainingProgramID($trainingProgramID) {
        $this->trainingProgramID = $trainingProgramID;
    }
    
    // Getters and Setters for the trainingProgramName
    public function getTrainingProgramName() {
        return $this->trainingProgramName;
    }
    
    public function setTrainingProgramName($trainingProgramName) {
        $this->trainingProgramName = $trainingProgramName;
    }
    
    // Getters and Setters for the trainingProgramDescription
    public function getTrainingProgramDescription() {
        return $this->trainingProgramDescription;
    }
    
    public function setTrainingProgramDescription($trainingProgramDescription) {
        $this->trainingProgramDescription = $trainingProgramDescription;
    }
    
    // Getters and Setters for the trainingProgramPrice
    public function getTrainingProgramPrice() {
        return $this->trainingProgramPrice;
    }

    public function setTrainingProgramPrice($trainingProgramPrice) {
        $this->trainingProgramPrice = $trainingProgramPrice;
    }

    // Getters and Setters for the trainingProgramDate 
    public function getTrainingProgramDate() {
        return $this->trainingProgramDate;
    }
    
    public function setTrainingProgramDate($trainingProgramDate) {
        $this->trainingProgramDate = $trainingProgramDate;
    }
    
    // Getters and Setters for the trainingProgramTime
    public function getTrainingProgramTime() {
        return $this->trainingProgramTime;
    }
    
    public function setTrainingProgramTime($trainingProgramTime) {
        $this->trainingProgramTime = $trainingProgramTime;
    }
    
    // Getters and Setters for the trainingProgramDuration
    public function getTrainingProgramDuration() {
        return $this->trainingProgramDuration;
    }
    
    public function setTrainingProgramDuration($trainingProgramDuration) {
        $this->trainingProgramDuration = $trainingProgramDuration;
    }
    
    // Getters and Setters for the strainingTutorName
    public function getTrainingTutorName() {
        return $this->trainingTutorName;
    }
    
    public function setTrainingTutorName($trainingTutorName) {
        $this->trainingTutorName = $trainingTutorName;
    }
    
    public function getTrainingEmployeeId() {
        return $this->trainingEmployeeId;
    }
    
    public function setTrainingEmployeeId($trainingEmployeeId) {
        $this->trainingEmployeeId = $trainingEmployeeId;
    }

    /**
     * > This method adds a training program to the NoSQL database. It takes in the database handle as a parameter and
     * inserts the training program into the TrainingPrograms collection in the NoSQL database.
     * 
     * > The method uses the MongoDB PHP library to insert the training program into the TrainingPrograms collection in the
     * NoSQL database.
     */
    public function addTrainingProgram($db_handle) {
        // Add training program to NoSQL database
        $db_handle->insert(
            [
                'trainingProgramID' => $this->trainingProgramID, // This is the primary key for the training program collection in the NoSQL database
                'trainingProgramName' => $this->trainingProgramName,
                'trainingProgramDescription' => $this->trainingProgramDescription,
                'trainingProgramImagePath' => $this->trainingProgramImagePath,
                'trainingProgramDate' => $this->trainingProgramDate,
                'trainingProgramTime' => $this->trainingProgramTime,
                'trainingProgramDuration' => $this->trainingProgramDuration,
                'trainingTutorName' => $this->trainingTutorName
                ]
            );
    }

    /**
     * > This method gets a training program from the NoSQL database. It takes in the database handle as a parameter and
     * retrieves the training program from the TrainingPrograms collection in the NoSQL database.
     * 
     * > The method uses the MongoDB PHP library to retrieve the training program from the TrainingPrograms collection in the
     * NoSQL database.
     */
    public function updateTrainingProgram($db_handle) {
        // Update training program in NoSQL database
        $db_handle->update(
            [
                'trainingProgramID' => $this->trainingProgramID, // This is the primary key for the training program collection in the NoSQL database
                'trainingProgramName' => $this->trainingProgramName,
                'trainingProgramDescription' => $this->trainingProgramDescription,
                'trainingProgramImagePath' => $this->trainingProgramImagePath,
                'trainingProgramDate' => $this->trainingProgramDate,
                'trainingProgramTime' => $this->trainingProgramTime,
                'trainingProgramDuration' => $this->trainingProgramDuration,
                'trainingTutorName' => $this->trainingTutorName
            ]
            );
    }

    /**
     * > This method deletes a training program from the NoSQL database. It takes in the database handle as a parameter and
     * deletes the training program from the TrainingPrograms collection in the NoSQL database.
     * 
     * > The method uses the MongoDB PHP library to delete the training program from the TrainingPrograms collection in the
     * NoSQL database.
     */
    public function deleteTrainingProgram($db_handle) {
        // Delete training program from NoSQL database
        $db_handle->delete(
            'TrainingPrograms', 
            array(
                'trainingProgramID' => $this->trainingProgramID) // This is the primary key for the training program collection in the NoSQL database
            );
    }

    /**
     * > This method gets a training program from the NoSQL database. It takes in the database handle as a parameter and
     * retrieves the training program from the TrainingPrograms collection in the NoSQL database.
     * 
     * > The method uses the MongoDB PHP library to retrieve the training program from the TrainingPrograms collection in the
     * NoSQL database.
     */
    public function getTrainingProgram($db_handle) {
        // Get training program from NoSQL database
        $query = $db_handle->query('TrainingPrograms');
        $query->where('trainingProgramID', $this->trainingProgramID); // This is the primary key for the training program collection in the NoSQL database
        $result = $query->get();
        return $result;
    }

}