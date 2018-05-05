<?php

class DBConnector extends mysqli {

    public function __construct($host, $user, $pass, $db) {
        parent::__construct( $host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            $this->my_die("Error concnecting to $db : errorno: " . mysqli_connect_errno() . ', ' . mysqli_connect_error());
        }
    }

    private function my_die($msg) {
        
        error_log("DBConnector: " . $msg);
         
        error_log($msg, 1, "kooshiar@concertboom.com", 
          "Subject: Urgent!DB Error!\nFrom: notification@concertboom.com\n");
        
        //header("Location: /custom-404-page.php");
        
         die;
    }
}

class ProductionDBConnector extends DBConnector {

    private $dbhost='54.188.245.194';
    //private $dbhost='localhost';
    
    private $dbusername='concertb_concert';
    private $dbuserpass='VqS08FsudGaK';
    private $dbname='concertb_concertboom';

    public function __construct() {
        parent::__construct($this->dbhost, $this->dbusername, $this->dbuserpass, $this->dbname);

    }
}

class LOGDBConnector extends DBConnector {

    //private $dbhost='localhost';
    private $dbhost='54.188.245.194';
    
    
    private $dbusername='concertb_concert';
    private $dbuserpass='VqS08FsudGaK';
    private $dbname='concertb_concertboom';

/*
    private $dbhost='cblogdb.coago2hquyyz.us-west-2.rds.amazonaws.com';
    private $dbusername='CB_LOG_DB_USER';
    private $dbuserpass='5KJ92j5sAm';
    private $dbname='CBLOGDB';
*/
    public function __construct() {
        parent::__construct($this->dbhost, $this->dbusername, $this->dbuserpass, $this->dbname);

    }
}

/*auxilary fucntions */
function my_die($source, $msg) {
        
        error_log("$source: " . $msg);
         
        error_log($msg, 1, "kooshiar@concertboom.com", 
          "Subject: Urgent!DB Error!\nFrom: notification@concertboom.com\n");
        
        //header("Location: /custom-404-page.php");
        
        die;
}

?>
