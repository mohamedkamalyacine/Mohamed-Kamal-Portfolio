<?php
class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $ajax;
    public $message;
  
    public function __construct($to, $from_name, $from_email, $subject, $ajax) {
      $this->to = $to;
      $this->from_name = $from_name;
      $this->from_email = $from_email;
      $this->subject = $subject;
      $this->ajax = $ajax;
      $this->message = "";
    }
  
    public function add_message($message) {
        $this->message .= $message;
    }
  
    public function send_email() {
      $headers = "From: {$this->from_name} <{$this->from_email}>" . "\r\n";
      $headers .= "Reply-To: {$this->from_email}" . "\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion();
      
      if ($this->ajax) {
        header('Content-Type: application/json');
      }
      
      if (mail($this->to, $this->subject, $this->message, $headers)) {
        if ($this->ajax) {
          echo json_encode(array('status' => 'success'));
        } else {
          echo "Message sent successfully.";
        }
      } else {
        if ($this->ajax) {
          echo json_encode(array('status' => 'error'));
        } else {
          echo "Message could not be sent.";
        }
      }
    }
  }  
?>