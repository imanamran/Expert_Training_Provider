<?php

/**
 * > This class is an abstraction that represents a rquest on the Expert Training website. The class will allow
 * the operations of adding, updating, deleting, and getting a request from the NoSQL database. 
 * 
 * > The class has the following properties:
 * requestID, requestStatus, requestDate, and requestTime
 * 
 */
class Request 
{
    private $requestID;
    private $clientName;
    private $trainingProgram;
    private $requestStatus;
    private $requestDate;
    private $requestTime;

    /**
     * > This is the constructor for the Request class. It takes in the requestID, requestStatus, requestDate, and requestTime
     * and initializes the properties of the request object to their correct values.
     * 
     * > This constructor can be used when a user makes a request for a training room or training program. The user will
     * provide the requestID, requestStatus, requestDate, and requestTime via the request form. The requestID is generated
     * by the system and is a unique identifier for the request. The requestStatus is set to pending by default. The requestDate
     * is the date that the request was made. The requestTime is the time that the request was made.
     */
    public function __construct($clientName, $trainingProgram, $requestDate, $requestTime) {
        $this->requestID = substr(uniqid(), -12);
        $this->requestStatus = "Pending";
        $this->clientName = $clientName;
        $this->trainingProgram = $trainingProgram;
        $this->requestDate = $requestDate;
        $this->requestTime = $requestTime;
    }

    // Getters and Setters for the clientName
    public function getClientName() {
        return $this->clientName;
    }

    public function setClientName($clientName) {
        $this->clientName = $clientName;
    }

    // Getters and Setters for the trainingProgram
    public function getTrainingProgram($db_handle) {
        $collection = new TrainingProgramCollection($db_handle);

        $result = $collection->getThisTrainingProgram($this->trainingProgram);

        // echo "<pre>";
        // // var_dump($result);
        // print_r($result);
        // echo "</pre>";
        return $result;
    }

    public function setTrainingProgram($trainingProgram) {
        $this->trainingProgram = $trainingProgram;
    }
    
    // Getters and Setters for the requestStatus
    public function getRequestStatus() {
        return $this->requestStatus;
    }
    
    public function setRequestStatus($requestStatus) {
        $this->requestStatus = $requestStatus;
    }
    
    // Getters and Setters for the requestDate
    public function getRequestDate() {
        return $this->requestDate;
    }
    
    public function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }
    
    // Getters and Setters for the requestTime
    public function getRequestTime() {
        return $this->requestTime;
    }

    public function setRequestTime($requestTime) {
        $this->requestTime = $requestTime;
    }

    /**
     * > This method will add a request to the NoSQL database. The method will take in the NoSQL database handle and
     * insert the request into the Requests collection in the NoSQL database.
     * 
     * > The method will insert the requestID, requestStatus, trainingProgram, requestDate, and requestTime into the Requests collection
     * in the NoSQL database.
     */
    public function addRequest($db_handle) {
        // Add request to NoSQL database
        $db_handle->insert(
            'Requests', 
            array(
                'requestID' => $this->requestID, // This is the primary key for the request collection in the NoSQL database
                'requestStatus' => $this->requestStatus,
                'clientName' => $this->clientName,
                'trainingProgram' => $this->trainingProgram,
                'requestDate' => $this->requestDate,
                'requestTime' => $this->requestTime)
            );
    }

    /**
     * > This method will update a request in the NoSQL database. The method will take in the NoSQL database handle and
     * update the request in the Requests collection in the NoSQL database.
     * 
     * > The method will update the requestID, requestStatus, trainingProgram, requestDate, and requestTime in the Requests collection
     * in the NoSQL database.
     */
    public function updateRequest($db_handle) {
        // Update request in NoSQL database
        $db_handle->update(
            'Requests', 
            array(
                'requestID' => $this->requestID, // This is the primary key for the request collection in the NoSQL database
                'requestStatus' => $this->requestStatus,
                'clientName' => $this->clientName,
                'trainingProgram' => $this->trainingProgram,
                'requestDate' => $this->requestDate,
                'requestTime' => $this->requestTime)
            );
    }

    /**
     * > This method will delete a request from the NoSQL database. The method will take in the NoSQL database handle and
     * delete the request from the Requests collection in the NoSQL database.
     * 
     * > The method will delete the requestID, requestStatus, trainingProgram, requestDate, and requestTime from the Requests collection
     * in the NoSQL database.
     */
    public function deleteRequest($db_handle) {
        // Delete request from NoSQL database
        $db_handle->delete(
            'Requests', 
            array(
                'requestID' => $this->requestID) // This is the primary key for the request collection in the NoSQL database
            );
    }

    /**
     * > This method will get a request from the NoSQL database. The method will take in the NoSQL database handle and
     * get the request from the Requests collection in the NoSQL database.
     * 
     * > The method will get the requestID, requestStatus, trainingProgram, requestDate, and requestTime from the Requests collection
     * in the NoSQL database.
     */
    public function getRequest($db_handle) {
        // Get request from NoSQL database
        $query = $db_handle->query('Requests');
        $query->where('requestID', '=', $this->requestID);
        $result = $query->execute();

        // Convert the result to an array
        // $result = $result->toArray();

        return $result;
    }
}