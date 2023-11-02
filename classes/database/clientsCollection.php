<?php
// Create a clients collection class that has the following methods:
// Create a method that will get all clients from the NoSQL database
// Create a method that will get all clients that need a room from the NoSQL database
// Create a method that will get all clients that do not need a room from the NoSQL database
// Create a method that will get all clients that have a list of requests from the NoSQL database
// Create a method that will get all clients that do not have a list of requests from the NoSQL database
// Create a method that will get all clients that have a list of requests that are approved from the NoSQL database
// Create a method that will get all clients that have a list of requests that are denied from the NoSQL database
// Create a method that will get all clients that have a list of requests that are pending from the NoSQL database
class ClientsCollection
{
    private $db_handle;

    public function __construct($db_handle) {
        $this->db_handle = $db_handle;
    }

    public function getClientByEmailAndPassword($email, $password){
        $collection = $this->db_handle->clients;
        $user = $collection->findOne([
            'emailAddress' => $email,
            'password' => $password
        ]);
        return $user;
    }

    public function getClientByEmail($email) {
        $result = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientEmail' => $email]);
        return $result;
    }

    // Billy, Jonathan
    // public function getAllClients(){
    //     // Get all clients from the NoSQL database
    //     $clientHandler = $this->db_handle->find([]);
    //     $clientHandler = $clientHandler->toArray();
    //     foreach ( $clientHandler as $client ) {
    //         $clientArray[] = new Client(
    //             $client[0]['clientName'], 
    //             $client[0]['clientEmail'], 
    //             $client[0]['clientPassword'], 
    //             $client[0]['needRoom'], 
    //             $client[0]['listOfRequests'], 
    //             $client[0]['listOfRequestsPending'], 
    //             $client[0]['listOfRequestsApproved'], 
    //             $client[0]['listOfRequestsDenied'], 
    //         );
    //     }
    //     return $clientArray;

    // }

    public function getClientByID($clientID) {
        $result = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientID' => $clientID]);
        return $result;
    }

    public function getClientByResetToken($token) {
        $bsonDocument = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientToken' => $token]);
    
        if ($bsonDocument !== null) {
            // Create an instance of Client from the BSONDocument
            $result = Client::fromBSONDocument($bsonDocument);
            return $result;
        } else {
            // No document was found with the provided token
            // Handle this case as appropriate for your application
            // For example, you might want to throw an exception, return null, or handle it in some other way
            return null;
        }
    }
    

    public function getAllClients() {
        // Get all clients from the NoSQL database
        $result = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->find([]);
    
        // Create an array to store the client objects
        foreach ($result as $client) {
            $clientArray[] = new Client(
                $client['clientID'],
                $client['clientName'],
                $client['clientEmail'],
                $client['clientPhone'],
                $client['clientPassword'],
                $client['clientFavRooms'],
                $client['listOfRequests']
            );
        }
        return $clientArray;
    }

    public function saveResetToken($clientEmail, $token){
        // Select the Clients collection from the ExpertTraining database
        $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');
        
        // Update the client's document with the reset token
        $updateResult = $collection->updateOne(
            ['clientEmail' => $clientEmail], // Find the client with this ID
            ['$set' => ['clientToken' => $token]] // Set the clientToken field to the generated token
        );
    
        // Return whether the update was successful
        return $updateResult->getModifiedCount() > 0;
    }
    


    

    public function getAllClientsNeedRoom(){
        // Get all clients that need a room from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'needRoom' => true
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function getAllClientsNoRoom(){
        // Get all clients that do not need a room from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'needRoom' => false
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function getClientRequests($clientID) {
        // Query the Clients collection to find a client with the matching ID
        $client = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientID' => $clientID]);
    
        if ($client) {
            // If a client with the given ID exists, return their list of requests
            return $client['listOfRequests'];
        } else {
            // If no such client exists, return null or an empty array
            return null;
        }
    }

    // Get a specific client request
    public function getClientSpecificRequest($clientID, $requestID) {
        // Find the client
        $client = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientID' => $clientID]);
    
        if ($client) {
            // Find the specific request
            foreach($client['listOfRequests'] as $request) {
                if ($request['requestID'] == $requestID) {
                    return $request;
                }
            }
        }
    
        // If no such client or request exists, return null
        return null;
    }
    

    public function getTrainingProgramDetails($programID) {
        // Find the training program with the given ID
        $result = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('TrainingPrograms')->findOne(['trainingProgramID' => $programID]);
        // Return the program name and image path
        return ['trainingProgramName' => $result['trainingProgramName'], 'trainingProgramImagePath' => $result['trainingProgramImagePath'], 'trainingEmployeeId' => $result['trainingEmployeeId']];
    }


    

    public function getAllClientsHaveRequests(){
        // Get all clients that have a list of requests from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'listOfRequests' => [
                '$ne' => null
            ]
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function getAllClientsNoRequests(){
        // Get all clients that do not have a list of requests from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'listOfRequests' => null
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function getAllClientsHaveApprovedRequests(){
        // Get all clients that have a list of requests that are approved from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'listOfRequests' => [
                '$ne' => 'approved'
            ]
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function getAllClientsHaveDeniedRequests(){
        // Get all clients that have a list of requests that are denied from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'listOfRequests' => [
                '$ne' => 'denied'
            ]
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function getAllClientsHavePendingRequests(){
        // Get all clients that have a list of requests that are pending from the NoSQL database
        $clientHandler = $this->db_handle->find([
            'listOfRequests' => [
                '$eq' => 'pending',
                '$ne' => null
            ]
        ]);
        $clientHandler = $clientHandler->toArray();
        foreach ( $clientHandler as $client ) {
            $clientArray[] = new Client(
                $client[0]['clientName'], 
                $client[0]['clientEmail'], 
                $client[0]['clientPassword'], 
                $client[0]['needRoom'], 
                $client[0]['listOfRequests'], 
                $client[0]['listOfRequestsPending'], 
                $client[0]['listOfRequestsApproved'], 
                $client[0]['listOfRequestsDenied'], 
            );
        }
        return $clientArray;
    }

    public function addClient($client){
        // Add a client to the NoSQL database
        $client->addClient($this->db_handle);
    }

    public function updateClient($client){
        // Update a client in the NoSQL database
        $client->updateClient($this->db_handle);
    }

    public function deleteClient($client){
        // Delete a client from the NoSQL database
        $client->deleteClient($this->db_handle);
    }

    public function deleteAllClients(){
        // Delete all clients from the NoSQL database
        $this->db_handle->deleteMany([]);
    }

    public function appendUserRequestToList($clientID, $userRequest) {
        // Select the Clients collection from the ExpertTraining database
        $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');
    
        // Update the client's document by pushing the new request into listOfRequests array
        $updateResult = $collection->updateOne(
            ['clientID' => $clientID], // Find the client with this ID
            ['$push' => ['listOfRequests' => $userRequest]] // Push the new request into listOfRequests
        );
    
        // Return whether the update was successful
        return $updateResult->getModifiedCount() > 0;
    }

    // Append room name to clientFavRooms

    public function appendRoomToFavList($clientID, $roomName) {
        // Select the Clients collection from the ExpertTraining database
        $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');
    
        // Update the client's document by pushing the new request into listOfRequests array
        $updateResult = $collection->updateOne(
            ['clientID' => $clientID], // Find the client with this ID
            ['$push' => ['clientFavRooms' => $roomName]] // Push the new request into listOfRequests
        );
    
        // Return whether the update was successful
        return $updateResult->getModifiedCount() > 0;
    }

    public function removeRoomFromFavList($clientID, $roomName) {
        // Select the Clients collection from the ExpertTraining database
        $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');
    
        // Update the client's document by pushing the new request into listOfRequests array
        $updateResult = $collection->updateOne(
            ['clientID' => $clientID], // Find the client with this ID
            ['$pull' => ['clientFavRooms' => $roomName]] // Push the new request into listOfRequests
        );
    
        // Return whether the update was successful
        return $updateResult->getModifiedCount() > 0;
    }
    
    public function isRoomSaved($userId, $roomId) {
        // Get the client's document from the database
        $clientDocument = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientID' => $userId]);
    
        // If the client document is not null and the 'savedRooms' field exists in the document
        if ($clientDocument !== null && isset($clientDocument['clientFavRooms'])) {
            // Check if the room id exists in the 'savedRooms' array
            if (in_array($roomId, $clientDocument['clientFavRooms'])) {
                return true;
            } 
        } 
        return false;
    }

    public function getSavedRooms($userId) {
        // Get the client's document from the database
        $clientDocument = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients')->findOne(['clientID' => $userId]);
    
        // If the client document is not null and the 'savedRooms' field exists in the document
        if ($clientDocument !== null && isset($clientDocument['clientFavRooms'])) {
            // Return the 'savedRooms' array from the client's document
            return $clientDocument['clientFavRooms'];
        } else {
            // If the client document is null or 'savedRooms' doesn't exist, return an empty array
            return [];
        }
    }

    public function appendUserRequest($userId, $userRequest) {
        // Find the user in the NoSQL database by their userId and append the userRequest
        $result = $this->db_handle
                       ->selectDatabase('ExpertTraining')
                       ->selectCollection('Clients')
                       ->updateOne(
                           ['clientID' => $userId],  // Filter condition
                           ['$push' => ['listOfRequests' => $userRequest]]  // Update operation
                       );
    
        // Return result of the update operation
        // It can be used to verify if the operation was successful
        return $result;
    }
    
    public function updateRequestStatus($userId, $requestId, $newStatus){
        // Select the Clients collection from the ExpertTraining database
        $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');
        
        // Update the status of the specified request for the specified user
        $updateResult = $collection->updateOne(
            ['clientID' => $userId, 'listOfRequests.requestID' => $requestId], // Find the client and request with these IDs
            ['$set' => ['listOfRequests.$.requestStatus' => $newStatus]] // Set the status of the matched request
        );
    
        // Return whether the update was successful
        return $updateResult->getModifiedCount() > 0;
    }

    public function getClientByRequestID($requestID) {
        $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');
        
        // MongoDB provides the $elemMatch operator to search within an array
        $result = $collection->findOne(['listOfRequests' => ['$elemMatch' => ['requestID' => $requestID]]]);
        
        if ($result) {
            return $result;
        } else {
            // Handle the case when no client is found with this requestId
            return null;
        }
    }
    
}