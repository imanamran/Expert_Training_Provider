<?php 
$title = "Chat Section";
include_once dirname(__FILE__) . '/../config.php';

include_once VIEWS . "/includes/employeeHeader.php";

?>
<script src="../controllers/chatScript.js"></script>
<link rel="stylesheet" href="../styles.css" />

<div class="pt-2">
    <div class="main-container pt-5">
        <div class="login" id="login-block" >
            <input type="text" id="user-login-input" placeholder="Enter your username (should be unique)" />
        </div>
        <div class="message-container">
            <div class="chat-container">
                <div class="chat-body" id="messages"></div>
                <div class="message-box">
                    <input type="text" id="message-input" placeholder="Enter your message..." />
                </div>
            </div>
        </div>
    </div>
</div>


<?php
// include_once VIEWS . "/includes/employeeFooter.php";
?>