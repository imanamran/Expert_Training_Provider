<?php

/**
 * > This class represents the abstraction of a client/customer who is to access 
 * the Expert Training website. The class will allow the operstions like to adding, updating,
 * deleting, and getting a client from the NoSQL database.
 * 
 * > The class has the following properties:
 * clientName, clientEmail, clientPhone, clientPassword, needRoom, listOfRequests, and clientID
 * 
 */
class Client
{
    private $clientID;
    private $clientToken;
    private $clientName;
    private $clientEmail;
    private $clientPhone;
    private $clientPassword;
    private $clientFavRooms;
    private $listOfRequests;

    /**
     * > This is the constructor for the Client class. 
     * It takes in the clientName, clientEmail, clientPhone, clientPassword
     * and initializes the needRoom and listOfRequests properties to empty arrays.
     * 
     * > This constructor can be used when a user registers for the first time since 
     * they get to provide their name, email address, phone number, and password via the 
     * registration form. The needRoom and listOfRequests properties are initialized to
     * empty arrays since the user has not yet requested for a training room or training
     * program.
     * 
     */
    public function __construct(
            $clientName, 
            $clientEmail, 
            $clientPhone, 
            $clientPassword
        ) {
        $this->clientID = substr(uniqid(), -12);
        $this->clientToken = bin2hex(random_bytes(50));
        $this->clientName = $clientName;
        $this->clientEmail = $clientEmail;
        $this->clientPhone = $clientPhone;
        $this->clientPassword = $clientPassword;
        $this->clientFavRooms = array();
        $this->listOfRequests = array();
    }

    /**
     * > This is the constructor for the Client class. It takes in clientEmail and clientPassword 
     * and initializes every other property to null. This constructor can be used when a user
     * logs in to the Expert Training website. The user will only provide their email address
     * and password to log in. This constructor also calls the getClient method to get the
     * client from the NoSQL database and update the properties of the client object to their 
     * correct values.
     * 
     */
    public static function atLogIn($clientEmail, $clientPassword) {
        $instance = new self();
        $instance->clientID = null;
        $instance->clientName = null;
        $instance->clientEmail = $clientEmail;
        $instance->clientPhone = null;
        $instance->clientPassword = $clientPassword;
        $instance->clientFavRooms = null;
        $instance->listOfRequests = null;
        // Call the getClient method to get the client from the NoSQL database and update the 
        // properties of the client object to their correct values
        $instance->getThisClient($clientEmail, $clientPassword);
    }

    /**
     * This method gets a client from the NoSQL database by checking if the clientEmail and clientPassword
     * match the clientEmail and clientPassword of a client in the NoSQL Mongo database. If the clientEmail and
     * clientPassword match, the client object is updated with the correct values of the client's properties.
     * The fields are updated using noSQL's updateOne method.
     */
    public function getThisClient($db_handle, $clientEmail, $clientPassword) {
        $filter = array('clientEmail' => $clientEmail, 'clientPassword' => $clientPassword);
        $options = array('projection' => array('_id' => 0));
        $query = new MongoDB\Driver\Query($filter, $options);
        $rows = $db_handle->executeQuery('ExpertTraining.Clients', $query);
        foreach ($rows as $row) {
            $this->clientID = $row->clientID;
            $this->clientName = $row->clientName;
            $this->clientEmail = $row->clientEmail;
            $this->clientPhone = $row->clientPhone;
            $this->clientPassword = $row->clientPassword;
            $this->clientFavRooms = $row->clientFavRooms;
            $this->listOfRequests = $row->listOfRequests;
        }
    }

    // Getters and Setters for the clientPhone
    public function getClientToken() {
        return $this->clientToken;
    }
    
    public function setClientToken() {
        $this->clientToken = bin2hex(random_bytes(50));
    }

    // Getters and Setters for the clientName
    public function getClientName() {
        return $this->clientName;
    }
    
    public function setClientName($clientName) {
        $this->clientName = $clientName;
    }
    
    // Getters and Setters for the clientEmail
    public function getClientEmail() {
        return $this->clientEmail;
    }
    
    public function setClientEmail($clientEmail) {
        $this->clientEmail = $clientEmail;
    }
    
    // Getters and Setters for the clientPhone
    public function getClientPhone() {
        return $this->clientPhone;
    }
    
    public function setClientPhone($clientPhone) {
        $this->clientPhone = $clientPhone;
    }
    
    // Getters and Setters for the clientPassword
    public function getClientPassword() {
        return $this->clientPassword;
    }
    
    public function setClientPassword($clientPassword) {
        $this->clientPassword = $clientPassword;
    }
    
    // Getters and Setters for the needRoom
    // public function getNeedRoom() {
    //     return $this->needRoom;
    // }
    
    // public function setNeedRoom($needRoom) {
    //     $this->needRoom = $needRoom;
    // }
    
    // Getters and Setters for the listOfRequests
    public function getListOfRequests() {
        return $this->listOfRequests;
    }
    
    public function setListOfRequests($listOfRequests) {
        $this->listOfRequests = $listOfRequests;
    }
    
    // Getters and Setters for the clientID properties
    public function getClientID() {
        return $this->clientID;
    }

    public function setClientID($clientID) {
        $this->clientID = $clientID;
    }


    /**
     * > This method adds a client to the NoSQL database. After a user registers for the first time,
     * the client object is created and the addClient method is called to add the client to the
     * NoSQL database.
     * 
     * > The method takes in the $db_handle parameter which is the database handle. The method
     * then calls the insert method on the database handle to add the client to the NoSQL database.
     */
    public function addClient($db_handle) {
        // Add client to NoSQL database
        $db_handle->insert(
            'Clients', 
            array(
                'clientID' => $this->clientID, // This is the primary key for the client collection in the NoSQL database
                'clientName' => $this->clientName,
                'clientEmail' => $this->clientEmail,
                'clientPassword' => $this->clientPassword,
                'listOfRequests' => $this->listOfRequests)
            );
    }

    /**
     * > This method updates a client in the NoSQL database. After a user updates their profile,
     * the client object is updated and the updateClient method is called to update the client in the
     * NoSQL database.
     * 
     * > The method takes in the $db_handle parameter which is the database handle. The method
     * then calls the update method on the database handle to update the client in the NoSQL database.
     */
    public function updateClient($db_handle) {
        // Update client in NoSQL database
        $db_handle->update(
            'Clients', 
            array(
                'clientID' => $this->clientID, // This is the primary key for the client collection in the NoSQL database
                'clientName' => $this->clientName,
                'clientEmail' => $this->clientEmail,
                'clientPassword' => $this->clientPassword,
                'listOfRequests' => $this->listOfRequests)
            );
    }

    /**
     * > This method deletes a client from the NoSQL database. After a user deletes their profile,
     * the client object is deleted and the deleteClient method is called to delete the client from the
     * NoSQL database.
     * 
     * > The method takes in the $db_handle parameter which is the database handle. The method
     * then calls the delete method on the database handle to delete the client from the NoSQL database.
     */
    public function deleteClient($db_handle) {
        // Delete client from NoSQL database
        $db_handle->delete(
            'Clients', 
            array(
                'clientID' => $this->clientID, // This is the primary key for the client collection in the NoSQL database
                'clientName' => $this->clientName,
                'clientEmail' => $this->clientEmail,
                'clientPassword' => $this->clientPassword,
                'listOfRequests' => $this->listOfRequests)
            );
    }

    /**
     * > This method gets a client from the NoSQL database. After a user logs in, the client object is
     * created and the getClient method is called to get the client from the NoSQL database.
     * 
     * > The method takes in the $db_handle parameter which is the database handle. The method
     * then calls the find method on the database handle to get the client from the NoSQL database.
     */
    public function getClient($db_handle) {
        // Get client from NoSQL database
        $db_handle->find(
            'Clients', 
            array(
                'clientID' => $this->clientID, // This is the primary key for the client collection in the NoSQL database
                'clientName' => $this->clientName,
                'clientEmail' => $this->clientEmail,
                'clientPassword' => $this->clientPassword,
                'listOfRequests' => $this->listOfRequests)
            );
    }

    public static function fromBSONDocument($document) {
        $instance = new self(
            $document['clientName'],
            $document['clientEmail'],
            $document['clientPhone'],
            $document['clientPassword']
        );
        
        $instance->setClientID($document['clientID']);
        
        // Set listOfRequests if it exists in the document
        if (isset($document['listOfRequests'])) {
            $instance->setListOfRequests($document['listOfRequests']);
        }
    
        return $instance;
    }

    
    public function updateUserInDatabase($db_handle) {
        $db_handle
            ->Clients  // Access the 'Clients' collection
            ->updateOne(
                ['clientID' => $this->getClientID()],  // Filter
                ['$set' => [  // Update
                    'clientName' => $this->getClientName(),
                    'clientEmail' => $this->getClientEmail(),
                    'clientPhone' => $this->getClientPhone(),
                    'clientPassword' => $this->getClientPassword(),
                    'listOfRequests' => $this->getListOfRequests(),
                    // Add other fields as needed
                ]]
            );
    }
    
    

}