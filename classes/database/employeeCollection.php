<?php

// Create a employees collection class that has the following methods:
// Create a method that will get all employees from the NoSQL database
// Create a method that will get all employees that have a list of requests that are approved from the NoSQL database
// Create a method that will get all employees that have a list of requests that are denied from the NoSQL database
// Create a method that will get all employees that have a list of requests that are pending from the NoSQL database

class EmployeeCollection
{
    private $db_handle;

    public function __construct($db_handle) {
        $this->db_handle = $db_handle->selectDatabase('ExpertTraining')->selectCollection('Employees');
    }



    public function getAllEmployees(){
        // Get all employees from the NoSQL database
        $result = $this->db_handle->find([]);
        // Create an array to store the employee objects with the fields:
        // employeeID, employeeName, employeeEmail, employeePassword, listOfRequests, listOfRequestsPending, listOfRequestsApproved, listOfRequestsDenied 
        $employeeArray= [];
        foreach ( $result as $employee ) {
            $employeeHandler = new Employee(
                $employee['employeeName'], 
                $employee['employeeEmail'], 
                $employee['employeePassword'], 
            );
            $employeeArray[] = $employeeHandler->getThisEmployee(
                $this->db_handle,
                $employee['employeeEmail'], 
                $employee['employeePassword']
            );
        }
        return $employeeArray;
    }

    public function getEmployeeRequests($employeeId) {
        // Find the employee document by the employeeId
        $employeeDocument = $this->db_handle->findOne(['employeeID' => $employeeId]);
    
        // If the employee document is found and the 'listOfRequests' field exists
        if ($employeeDocument !== null && isset($employeeDocument['listOfRequests'])) {
            // Return the 'listOfRequests' array from the employee's document
            return $employeeDocument['listOfRequests'];
        } else {
            // If the employee document is not found or 'listOfRequests' doesn't exist, return an empty array
            return [];
        }
    }
      

    public function getAllEmployeesHaveApprovedRequests(){
        // Get all employees that have a list of requests that are approved from the NoSQL database
        $result = $this->db_handle->find(['listOfRequestsApproved' => ['$ne' => null]], ['sort' => ['employeeID' => 1]]);
        // Create an array to store the employee objects with the fields:
        // employeeID, employeeName, employeeEmail, employeePassword, listOfRequests, listOfRequestsPending, listOfRequestsApproved, listOfRequestsDenied
        foreach ( $result as $employee ) {
            $employeeHandler = new Employee(
                $employee['employeeName'], 
                $employee['employeeEmail'], 
                $employee['employeePassword'], 
            );
            $employeeArray[] = $employeeHandler->getThisEmployee(
                $this->db_handle,
                $employee['employeeEmail'], 
                $employee['employeePassword']
            );
        }
        return $employeeArray;
    }

    public function getAllEmployeesHaveDeniedRequests(){
        // Get all employees that have a list of requests that are denied from the NoSQL database
        $result = $this->db_handle->find(['listOfRequestsDenied' => ['$ne' => null]], ['sort' => ['employeeID' => 1]]);
        // Create an array to store the employee objects with the fields:
        // employeeID, employeeName, employeeEmail, employeePassword, listOfRequests, listOfRequestsPending, listOfRequestsApproved, listOfRequestsDenied
        foreach ( $result as $employee ) {
            $employeeHandler = new Employee(
                $employee['employeeName'], 
                $employee['employeeEmail'], 
                $employee['employeePassword'], 
            );
            $employeeArray[] = $employeeHandler->getThisEmployee(
                $this->db_handle,
                $employee['employeeEmail'], 
                $employee['employeePassword']
            );
        }
        return $employeeArray;
    }

    public function getAllEmployeesHavePendingRequests(){
        // Get all employees that have a list of requests that are pending from the NoSQL database
        $result = $this->db_handle->find(['listOfRequestsPending' => ['$ne' => null]], ['sort' => ['employeeID' => 1]]);
        // Create an array to store the employee objects with the fields:
        // employeeID, employeeName, employeeEmail, employeePassword, listOfRequests, listOfRequestsPending, listOfRequestsApproved, listOfRequestsDenied
        foreach ( $result as $employee ) {
            $employeeHandler = new Employee(
                $employee['employeeName'], 
                $employee['employeeEmail'], 
                $employee['employeePassword'], 
            );
            $employeeArray[] = $employeeHandler->getThisEmployee(
                $this->db_handle,
                $employee['employeeEmail'], 
                $employee['employeePassword']
            );
        }
        return $employeeArray;
    }

    public function updateRequestStatus($userId, $requestId, $newStatus){
        // Select the Clients collection from the ExpertTraining database
        // $collection = $this->db_handle->selectDatabase('ExpertTraining')->selectCollection('Clients');

        // // $collection = $this->db_handle->selectCollection('Clients');
        // var_dump($collection);
        
        // Update the status of the specified request for the specified user
        $updateResult = $this->db_handle->updateOne(
            ['employeeID' => $userId, 'listOfRequests.requestID' => $requestId], // Find the client and request with these IDs
            ['$set' => ['listOfRequests.$.requestStatus' => $newStatus]] // Set the status of the matched request
        );
    
        // // Return whether the update was successful
        return $updateResult->getModifiedCount() > 0;
    }

    public function appendUserRequestToEmployee($userId, $userRequest) {
        // Find the user in the NoSQL database by their userId and append the userRequest
        $result = $this->db_handle
                       ->updateOne(
                           ['employeeID' => $userId],  // Filter condition
                           ['$push' => ['listOfRequests' => $userRequest]]  // Update operation
                       );
    
        // Return result of the update operation
        // It can be used to verify if the operation was successful
        return $result;
    }
}