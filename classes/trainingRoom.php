<?php

/**
 * > This class is an abstraction that represents a training room on the Expert Training website. The class will allow
 * the operations of adding, updating, deleting, and getting a training room from the NoSQL database.
 * 
 * > The class has the following properties:
 * trainingRoomID, trainingRoomName, trainingRoomImageLink, trainigRoomAvalability, and trainingRoomCapacity
 */
class TrainingRoom 
{
    private $trainingRoomID;
    private $trainingRoomName;
    private $trainingRoomImageLink;
    private $trainigRoomAvalability;
    private $trainingRoomCapacity;

    /**
     * > This is the constructor for the TrainingRoom class. It takes in the trainingRoomID, trainingRoomName, trainigRoomAvalability, and trainingRoomCapacity
     * and initializes the properties of the training room object to their correct values.
     * 
     * > This constructor can be used when a user adds a training room to the Expert Training website. The user will
     * provide the trainingRoomID, trainingRoomName,trainingRoomImageLink, trainigRoomAvalability, and trainingRoomCapacity via the training room form. The trainingRoomID is generated
     * by the system and is a unique identifier for the training room. The trainingRoomName is the name of the training room. The trainigRoomAvalability is the
     * availability of the training room. The trainingRoomCapacity is the capacity of the training room.
     */
    public function __construct(
            $trainingRoomName, 
            $trainingRoomImageLink,
            $trainigRoomAvalability, 
            $trainingRoomCapacity
        ) {
        $this->trainingRoomID = substr(uniqid(), -12);
        $this->trainingRoomName = $trainingRoomName;
        $this->trainingRoomImageLink = $trainingRoomImageLink;
        $this->trainigRoomAvalability = $trainigRoomAvalability;
        $this->trainingRoomCapacity = $trainingRoomCapacity;
    }

    // Getters and Setters for the trainingRoomImageLink
    public function getTrainingRoomImageLink() {
        return $this->trainingRoomImageLink;
    }
    
    public function setTrainingRoomImageLink($trainingRoomImageLink) {
        $this->trainingRoomImageLink = $trainingRoomImageLink;
    }

    // Getters and Setters for the trainingRoomID 
    public function getTrainingRoomID() {
        return $this->trainingRoomID;
    }
    
    public function setTrainingRoomID($trainingRoomID) {
        $this->trainingRoomID = $trainingRoomID;
    }
    
    // Getters and Setters for the trainingRoomName
    public function getTrainingRoomName() {
        return $this->trainingRoomName;
    }
    
    public function setTrainingRoomName($trainingRoomName) {
        $this->trainingRoomName = $trainingRoomName;
    }
    
    // Getters and Setters for the trainigRoomAvalability
    public function getTrainigRoomAvalability() {
        return $this->trainigRoomAvalability;
    }
    
    public function setTrainigRoomAvalability($trainigRoomAvalability) {
        $this->trainigRoomAvalability = $trainigRoomAvalability;
    }
    
    // Getters and Setters for the trainingRoomCapacity
    public function getTrainingRoomCapacity() {
        return $this->trainingRoomCapacity;
    }
    
    public function setTrainingRoomCapacity($trainingRoomCapacity) {
        $this->trainingRoomCapacity = $trainingRoomCapacity;
    }

    /**
     * > This method is used in updating the objects when retrieved from the 
     * NoSQL database.
     */
    public function retrieveRoom($trainingRoomName, $db_handle){
        // Retrieve training room with the name trainingName from NoSQL Database
        $roomHandler = $db_handle->find(
            [
                'trainingRoomName' => $trainingRoomName
            ]
        );
        $roomHandler = $roomHandler->toArray();
        $this->trainingRoomID = $roomHandler[0]['trainingRoomID'];
        $this->trainingRoomImageLink = $roomHandler[0]['trainingRoomImageLink'];
        $this->trainigRoomAvalability = $roomHandler[0]['trainigRoomAvalability'];
        $this->trainingRoomCapacity = $roomHandler[0]['trainingRoomCapacity'];
        
        $instance = new self(
            $trainingRoomName, 
            $this->trainingRoomImageLink,
            $this->trainingRoomCapacity, 
            $this->trainigRoomAvalability
        );
        $instance->setTrainingRoomID($this->trainingRoomID );
        return $instance;
    }

    /**
     * > This method adds a training room to the NoSQL database. The method takes in the NoSQL database handle as a parameter and
     * inserts the training room into the NoSQL database.
     * 
     * > The method uses the insert() method of the NoSQL database handle to insert the training room into the NoSQL database.
     */
    public function addTrainingRoom($db_handle) {
        // Add training room to NoSQL database
        $db_handle->insert(
            'TrainingRooms', 
            array(
                'trainingRoomID' => $this->trainingRoomID, // This is the primary key for the training room collection in the NoSQL database
                'trainingRoomName' => $this->trainingRoomName,
                'trainingRoomImageLink' => $this->trainingRoomImageLink,
                'trainigRoomAvalability' => $this->trainigRoomAvalability,
                'trainingRoomCapacity' => $this->trainingRoomCapacity)
            );
    }

    /**
     * > This method updates a training room in the NoSQL database. The method takes in the NoSQL database handle as a parameter and
     * updates the training room in the NoSQL database.
     * 
     * > The method uses the update() method of the NoSQL database handle to update the training room in the NoSQL database.
     */
    public function updateTrainingRoom($db_handle) {
        // Update training room in NoSQL database
        $db_handle->update(
            'TrainingRooms', 
            array(
                'trainingRoomID' => $this->trainingRoomID, // This is the primary key for the training room collection in the NoSQL database
                'trainingRoomName' => $this->trainingRoomName,
                'trainingRoomImageLink' => $this->trainingRoomImageLink,
                'trainigRoomAvalability' => $this->trainigRoomAvalability,
                'trainingRoomCapacity' => $this->trainingRoomCapacity)
            );
    }

    /**
     * > This method deletes a training room from the NoSQL database. The method takes in the NoSQL database handle as a parameter and
     * deletes the training room from the NoSQL database.
     * 
     * > The method uses the delete() method of the NoSQL database handle to delete the training room from the NoSQL database.
     */
    public function deleteTrainingRoom($db_handle) {
        // Delete training room from NoSQL database
        $db_handle->delete(
            'TrainingRooms', 
            array(
                'trainingRoomID' => $this->trainingRoomID) // This is the primary key for the training room collection in the NoSQL database
            );
    }

    /**
     * > This method gets a training room from the NoSQL database. The method takes in the NoSQL database handle as a parameter and
     * gets the training room from the NoSQL database.
     * 
     * > The method uses the get() method of the NoSQL database handle to get the training room from the NoSQL database.
     */
    public function getTrainingRoom($db_handle) {
        // Get training room from NoSQL database
        $db_handle->get(
            'TrainingRooms', 
            array(
                'trainingRoomID' => $this->trainingRoomID) // This is the primary key for the training room collection in the NoSQL database
            );
    }
}