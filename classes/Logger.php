<?php
/* TODO: Alter WriteLog as recursive, or add another function so we can move through arrays passed as messages */


class Logger {
    private $fh = NULL;
    private $log_delimiter = NULL;

    public function __construct($filename, $delimiter = '|'){
        // if we can't access the file, we have
        // to kill the class
        if(!$this->fh = fopen($filename)){
            $this->__destruct();
        }else{
            $this->log_delimiter = $delimiter;
        }
    }

    public function __destruct(){
        if($this->fh !== FALSE){
            fclose($this->fh);
        }
    }

    private function WriteLog($title, $message, $type = 'error'){
        $log_date = date('Y-m-d H:i:s');

        fwrite($this->fh, $log_date . $this->log_delimiter . $type . $this->log_delimiter . $title . $this->log_delimiter);

        // consider we might have been passed an
        // array as a message...if so, parse it
        if(is_array($message)){
            foreach($message as $key => $value){
                fwrite($this->fh, $key . '=' . $value . $this->log_delimiter);
            }

            // add a newline after parsing the array
            fwrite($this->fh, "\n");
        }else{
            fwrite($this->fh, $message . "\n");
        }
    }

    public function LogAccess($title, $message){
        $this->WriteLog('access', $title, $message);
    }

    public function LogComment($title, $message){
        $this->WriteLog('comment', $title, $message);
    }

    public function LogError($title, $message){
        $this->WriteLog('error', $title, $message);
    }
}

?>