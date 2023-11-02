<?php

// Create a message class that has the following properties:
// messageID, messageSender, messageReceiver, messageSubject, messageBody, messageDate, messageTime
// Create a message class that has the following methods:
// Create a method that will this message from the NoSQL database
class Message {
    private $messageID;
    private $messageSender;
    private $messageReceiver;
    private $messageSubject;
    private $messageBody;
    private $messageDate;
    private $messageTime;

    public function __construct($messageSender, $messageReceiver, $messageBody, $messageDate, $messageTime) {
        $this->messageID = substr(uniqid(), -12);;
        $this->messageSender = $messageSender;
        $this->messageReceiver = $messageReceiver;
        $this->messageBody = $messageBody;
        $this->messageDate = $messageDate;
        $this->messageTime = $messageTime;
    }

    // Create a getter for the messageID property
    public function getMessageID() {
        return $this->messageID;
    }

    // Create a getter for the messageSender property
    public function getMessageSender() {
        return $this->messageSender;
    }

    // Create a getter for the messageReceiver property
    public function getMessageReceiver() {
        return $this->messageReceiver;
    }

    // Create a getter for the messageSubject property
    public function getMessageBody() {
        return $this->messageBody;
    }

    // Create a getter for the messageDate property
    public function getMessageDate() {
        return $this->messageDate;
    }

    // Create a getter for the messageTime property
    public function getMessageTime() {
        return $this->messageTime;
    }

    // Create a method that will get all messages from the NoSQL database
    public function getThisMessage($messageSender, $messageReceiver, $db_handle) {
        $result = $db_handle->Messages->findOne(['messageSender' => $messageSender, 'messageReceiver' => $messageReceiver]);
        $messageHandler = new Message(
            $result['messageSender'], 
            $result['messageReceiver'], 
            $result['messageBody'], 
            $result['messageDate'], 
            $result['messageTime']
        );
        return $messageHandler;
    }
}