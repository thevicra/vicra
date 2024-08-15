<?php
class PHP_Email_Form {
    public $to = '';
    public $from_name = '';
    public $from_email = '';
    public $subject = '';
    public $smtp = [];
    public $ajax = false;
    private $messages = [];

    // Method to add message to the email body
    public function add_message($content, $label, $order = 0) {
        $this->messages[] = [$content, $label, $order];
    }

    // Method to send the email
    public function send() {
        // Build email headers
        $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
        $headers .= "Reply-To: " . $this->from_email . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Build email body
        $email_body = "<h2>You have a new message from your contact form</h2>";
        foreach ($this->messages as $msg) {
            $email_body .= "<p><strong>{$msg[1]}:</strong> {$msg[0]}</p>";
        }

        // Use mail() function to send the email
        if (mail($this->to, $this->subject, $email_body, $headers)) {
            return "Your message has been sent successfully!";
        } else {
            return "There was an error sending your message. Please try again later.";
        }
    }
}
?>
