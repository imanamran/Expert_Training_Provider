<?php

// Create a message class that has the following properties:
// db_handle.
// Create a messages collection class that has the following methods:
// Create a method that will get all messages that are sent from the NoSQL database
// Create a method that will get all messages that are received from the NoSQL database
// Create a method that will get all messages that are sent and received from the NoSQL database
// Create a method that will get all messages that are sent and received from the NoSQL database and sort them by date and time
// Create a method that will get all messages that are sent and received from the NoSQL database and sort them by date and time and limit the number of messages to 10
class MessageCollection{
    private $db_handle;

    public function __construct($db_handle) {
        $this->db_handle = $db_handle;
    }

    // Create a method that will get all messages that are sent from the NoSQL database
    public function getSentMessages($messageSender) {
        $result = $this->db_handle->Messages->find(['messageSender' => $messageSender]);
        $messageHandler = array();
        foreach($result as $message) {
            $messageHandler[] = new Message(
                $message['messageSender'], 
                $message['messageReceiver'], 
                $message['messageBody'], 
                $message['messageDate'], 
                $message['messageTime']
            );
        }
        return $messageHandler;
    }

    // Create a method that will get all messages that are received from the NoSQL database
    public function getReceivedMessages($messageReceiver) {
        $result = $this->db_handle->Messages->find(['messageReceiver' => $messageReceiver]);
        $messageHandler = array();
        foreach($result as $message) {
            $messageHandler[] = new Message(
                $message['messageSender'], 
                $message['messageReceiver'], 
                $message['messageBody'], 
                $message['messageDate'], 
                $message['messageTime']
            );
        }
        return $messageHandler;
    }

    // Create a method that will get all messages that are sent and received from the NoSQL database
    public function getAllMessages($messageSender, $messageReceiver) {
        $result = $this->db_handle->Messages->find(['messageSender' => $messageSender, 'messageReceiver' => $messageReceiver]);
        $messageHandler = array();
        foreach($result as $message) {
            $messageHandler[] = new Message(
                $message['messageSender'], 
                $message['messageReceiver'], 
                $message['messageBody'], 
                $message['messageDate'], 
                $message['messageTime']
            );
        }
        return $messageHandler;
    }

    // Create a method that will get all messages that are sent and received from the NoSQL database and sort them by date and time
    public function getAllMessagesByDate($messageSender, $messageReceiver) {
        $result = $this->db_handle->Messages->find(['messageSender' => $messageSender, 'messageReceiver' => $messageReceiver])->sort(['messageDate' => -1, 'messageTime' => -1]);
        $messageHandler = array();
        foreach($result as $message) {
            $messageHandler[] = new Message(
                $message['messageSender'], 
                $message['messageReceiver'], 
                $message['messageBody'], 
                $message['messageDate'], 
                $message['messageTime']
            );
        }
        return $messageHandler;
    }

    // Create a method that will get all messages that are sent and received from the NoSQL database and sort them by date and time and limit the number of messages to 10
    public function getAllMessagesByDateLimit($messageSender, $messageReceiver) {
        $result = $this->db_handle->Messages->find(['messageSender' => $messageSender, 'messageReceiver' => $messageReceiver])->sort(['messageDate' => -1, 'messageTime' => -1])->limit(10);
        $messageHandler = array();
        foreach($result as $message) {
            $messageHandler[] = new Message(
                $message['messageSender'], 
                $message['messageReceiver'], 
                $message['messageBody'], 
                $message['messageDate'], 
                $message['messageTime']
            );
        }
        return $messageHandler;
    }
}