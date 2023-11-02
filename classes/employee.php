<?php

/**
 * > This employee class is an abstraction that represents an employee in the Expert Training system.
 * The class will allow the operations of adding, updating, deleting, and getting an employee from the
 * NoSQL database.
 * 
 * > The class has the following properties:
 * employeeName, employeeEmail, employeePassword, employeeID, listOfRequestsApproved, and listOfRequestsDenied
 *  
 */
class Employee
{
    private $employeeID;
    private $employeeName;
    private $employeeEmail;
    private $employeePassword;
    private $listOfRequests;
    private $listOfRequestsPending;
    private $listOfRequestsApproved;
    private $listOfRequestsDenied;

    
    /**
     * > This is the constructor for the Employee class. It takes in the employeeName, employeeEmail, and employeePassword
     * and initializes the listOfRequestsApproved and listOfRequestsDenied properties to empty arrays.
     * 
     * > This constructor can be used when an employee registers for the first time since they get to provide their name,
     * email address, and password via the registration form. The listOfRequestsApproved and listOfRequestsDenied properties
     * are initialized to empty arrays since the employee has not yet approved or denied any training requests.
     */
    public function __construct(
            $employeeName, 
            $employeeEmail, 
            $employeePassword
        ) {
        $this->employeeID = substr(uniqid(), -12);
        $this->employeeName = $employeeName;
        $this->employeeEmail = $employeeEmail;
        $this->employeePassword = $employeePassword;
        $this->listOfRequests = array();
        $this->listOfRequestsApproved = array();
        $this->listOfRequestsDenied = array();
    }

    /**
     * > This is the constructor for the Employee class. It takes in employeeEmail and employeePassword and initializes every
     * other property to null. This constructor can be used when an employee logs in to the Expert Training website. The employee
     * will only provide their email address and password to log in. This constructor also calls the getEmployee method to get the
     * employee from the NoSQL database and update the properties of the employee object to their correct values.
     */
    public static function atLogIn($db_handle, $employeeEmail, $employeePassword) {
        $instance  = new self(
            "",
            $employeeEmail, 
            $employeePassword
        );
        $instance->employeeID = null;
        $instance->employeeName = null;
        $instance->employeeEmail = $employeeEmail;
        $instance->employeePassword = $employeePassword;
        $instance->listOfRequests = null;
        $instance->listOfRequestsApproved = null;
        $instance->listOfRequestsDenied = null;
        $instance->getThisEmployee($db_handle, $employeeEmail, $employeePassword);
    }

    /**
     * > This method will get an employee from the NoSQL database and update the properties of the employee object to their correct values.
     * 
     * > The method takes in the database handle, employeeEmail, and employeePassword as parameters. It then uses the employeeEmail and employeePassword
     * to get the employee from the NoSQL database. The method then updates the properties of the employee object to their correct values.
     */
    public function getThisEmployee($db_handle, $employeeEmail, $employeePassword) {
        // Get the employee from the NoSQL database
        $employee = $db_handle->findOne(['employeeEmail' => $employeeEmail, 'employeePassword' => $employeePassword]);
        // Update the properties of the employee object to their correct values
        $this->employeeID = $employee['employeeID'];
        $this->employeeName = $employee['employeeName'];
        $this->employeeEmail = $employee['employeeEmail'];
        $this->employeePassword = $employee['employeePassword'];
        $this->listOfRequests = $employee['listOfRequests'];
        $this->listOfRequests = [];

        foreach($employee['listOfRequests'] as $req){
            $reqItem = new Request(
                $req["clientName"],
                $req["trainingProgram"],
                $req["requestDate"],
                $req["requestTime"],
            );
            $this->listOfRequests[] = $reqItem;

        }
        $this->listOfRequestsApproved = $employee['listOfRequestsApproved'];
        $this->listOfRequestsDenied = $employee['listOfRequestsDenied'];

        return $this;

        // var_dump($this->employeeID);
        // var_dump($this->employeeName);
        // var_dump($this->employeeEmail);
        // var_dump($this->employeePassword);
        // echo "<pre>";
        // var_dump(gettype($this->listOfRequests[0]));
        // var_dump($this->listOfRequests[0]->getClientName());
        // print_r($this->listOfRequests);
        // echo "<pre>";
        // var_dump($this->listOfRequestsApproved);
        // var_dump($this->listOfRequestsDenied);
    }

    // Getters and Setters for the employeeName
    public function getEmployeeName() {
        return $this->employeeName;
    }
    
    public function setEmployeeName($employeeName) {
        $this->employeeName = $employeeName;
    }
    
    // Getters and Setters for the employeeEmail
    public function getEmployeeEmail() {
        return $this->employeeEmail;
    }
    
    public function setEmployeeEmail($employeeEmail) {
        $this->employeeEmail = $employeeEmail;
    }
    
    // Getters and Setters for the employeePassword
    public function getEmployeePassword() {
        return $this->employeePassword;
    }
    
    public function setEmployeePassword($employeePassword) {
        $this->employeePassword = $employeePassword;
    }
    
    // Getters and Setters for the employeeID
    public function getEmployeeID() {
        return $this->employeeID;
    }
    
    public function setEmployeeID($employeeID) {
        $this->employeeID = $employeeID;
    }

    //Getters and Setters for the allRequests
    public function getListOfRequests() {
        return $this->listOfRequests;
    }

    public function setListOfRequests($listOfRequests) {
        $this->listOfRequests = $listOfRequests;
    }

    // Getters and Setters for the listOfRequestsApproved
    public function getListOfRequestsApproved() {
        return $this->listOfRequestsApproved;
    }
    
    public function setListOfRequestsApproved($listOfRequestsApproved) {
        $this->listOfRequestsApproved = $listOfRequestsApproved;
    }
    
    // Getters and Setters for the listOfRequestsDenied properties
    public function getListOfRequestsDenied() {
        return $this->listOfRequestsDenied;
    }

    public function setListOfRequestsDenied($listOfRequestsDenied) {
        $this->listOfRequestsDenied = $listOfRequestsDenied;
    }

    /**
     * > This method will add an employee to the NoSQL database.
     * 
     * > The method takes in the database handle as a parameter. It then uses the database handle to add the employee to the NoSQL database.
     * The method uses the employeeID as the primary key for the employee collection in the NoSQL database.
     */
    public function addEmployee($db_handle) {
        // Add employee to NoSQL database
        $db_handle->insert(
            [
                'employeeID' => $this->employeeID, // This is the primary key for the employee collection in the NoSQL database
                'employeeName' => $this->employeeName,
                'employeeEmail' => $this->employeeEmail,
                'employeePassword' => $this->employeePassword,
                'listOfRequestsApproved' => $this->listOfRequestsApproved,
                'listOfRequestsDenied' => $this->listOfRequestsDenied
            ]
            );
    }

    /**
     * > This method will update an employee in the NoSQL database.
     * 
     * > The method takes in the database handle as a parameter. It then uses the database handle to update 
     * the employee in the NoSQL database. The method uses the employeeID as the primary key for the 
     * employee collection in the NoSQL database.
     */
    public function updateEmployee($db_handle) {
        // Update employee in NoSQL database
        $db_handle->update(
            [
                'employeeID' => $this->employeeID, // This is the primary key for the employee collection in the NoSQL database
                'employeeName' => $this->employeeName,
                'employeeEmail' => $this->employeeEmail,
                'employeePassword' => $this->employeePassword,
                'listOfRequestsApproved' => $this->listOfRequestsApproved,
                'listOfRequestsDenied' => $this->listOfRequestsDenied
            ]
            );
    }

    /**
     * > This method will delete an employee from the NoSQL database.
     * 
     * > The method takes in the database handle as a parameter. It then uses the database handle to delete 
     * the employee from the NoSQL database. The method uses the employeeID as the primary key for the 
     * employee collection in the NoSQL database.
     */
    public function deleteEmployee($db_handle) {
        // Delete employee from NoSQL database
        $db_handle->delete(
            [
                'employeeID' => $this->employeeID
            ]
            );
    }

    /**
     * > This method will get an employee from the NoSQL database.
     * 
     * > The method takes in the database handle as a parameter. It then uses the database handle to get 
     * the employee from the NoSQL database. The method uses the employeeID as the primary key for the 
     * employee collection in the NoSQL database.
     */
    public function getEmployee($db_handle) {
        // Get employee from NoSQL database
        $db_handle->find(
            'Employees', 
            array(
                'employeeID' => $this->employeeID)
            );
    }

    /**
     * > This method will get all employees from the NoSQL database.
     * 
     * > The method takes in the database handle as a parameter. It then uses the database handle 
     * to get all employees from the NoSQL database.
     */
    public function approveRequest($db_handle, $requestID) {
        // Add requestID to listOfRequestsApproved
        array_push($this->listOfRequestsApproved, $requestID);
        // Update employee in NoSQL database
        $this->updateEmployee($db_handle);
    }

    /**
     * > This method will get all employees from the NoSQL database.
     * 
     * > The method takes in the database handle as a parameter. It then uses the database handle 
     * to get all employees from the NoSQL database.
     */
    public function denyRequest($db_handle, $requestID) {
        // Add requestID to listOfRequestsDenied
        array_push($this->listOfRequestsDenied, $requestID);
        // Update employee in NoSQL database
        $this->updateEmployee($db_handle);
    }

}