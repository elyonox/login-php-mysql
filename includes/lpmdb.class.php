<?php 
/*-------------------------------------------------------+
| Login PHP MYSQL
| https://github.com/elyonox/login-php-mysql
+--------------------------------------------------------+
| Author: Ionut Manole (Yonox)
| Email: yonutyonox@gmail.com
| Author URL: https://github.com/elyonox
+--------------------------------------------------------+*/

class lpmDB
{
    private $link = null;
    public $filter;
	public $connError;
    static $inst = null;
    public static $counter = 0;
    
    
    public function __construct()
    {
        mb_internal_encoding( 'UTF-8' );
        mb_regex_encoding( 'UTF-8' );
        mysqli_report( MYSQLI_REPORT_STRICT );
        try {
			$this->link = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
            $this->link->set_charset( "utf8" );
        } catch ( Exception $e ) {
            $this->connError = 'Error';
        }
    }

    public function __destruct()
    {
        if( $this->link)
        {
            $this->disconnect();
        }
    }
	
	
	/**
     * Check Database connection
     *
     * Example usage:
     * $dbconnection = $database->checkDBconnection();
     *
     * @access public
     * @param none
     * @return bool
     */
	public function checkDBconnection()
	{
		if ( $this->connError === 'Error' )
		{
			return false;
		} else {
			return true;
		}
	}


    /**
     * Sanitize user data
     *
     * Example usage:
     * $user_name = $database->filter( $_POST['user_name'] );
     * 
     * Or to filter an entire array:
     * $data = array( 'name' => $_POST['name'], 'email' => 'email@address.com' );
     * $data = $database->filter( $data );
     *
     * @access public
     * @param mixed $data
     * @return mixed $data
     */
     public function filter( $data )
     {
         if( !is_array( $data ) )
         {
             $data = $this->link->real_escape_string( $data );
             $data = trim( htmlentities( $data, ENT_QUOTES, 'UTF-8', false ) );
         }
         else
         {
             //Self call function to sanitize array data
             $data = array_map( array( $this, 'filter' ), $data );
         }
         return $data;
     }
     
     
     /**
      * Extra function to filter when only mysqli_real_escape_string is needed
      * @access public
      * @param mixed $data
      * @return mixed $data
      */
     public function escape( $data )
     {
         if( !is_array( $data ) )
         {
             $data = $this->link->real_escape_string( $data );
         }
         else
         {
             //Self call function to sanitize array data
             $data = array_map( array( $this, 'escape' ), $data );
         }
         return $data;
     }
    
    
    /**
     * Perform queries
     * All following functions run through this function
     *
     * @access public
     * @param string
     * @return string
     * @return array
     * @return bool
     *
     */
    public function query( $query )
    {
        $full_query = $this->link->query( $query );
        if( $this->link->error )
        {
            return false; 
        }
        else
        {
            return true;
        }
    }
	
	/**
     * Determine if database table exists
     * Example usage:
     * if( !$database->table_exists( 'checkingfortable' ) )
     * {
     *      //Install your table or throw error
     * }
     *
     * @access public
     * @param string
     * @return bool
     *
     */
	public function table_exists( $name )
	{
		self::$counter++;
		$check = $this->link->query( "SELECT * FROM $name" );
		if( $check !== false )
		{
			return true;
		} else {
			return false;
		}
	}
    
    
    /**
     * Perform query to retrieve array of associated results
     *
     * Example usage:
     * $users = $database->get_results( "SELECT name, email FROM users ORDER BY name ASC" );
     * foreach( $users as $user )
     * {
     *      echo $user['name'] . ': '. $user['email'] .'<br />';
     * }
     *
     * @access public
     * @param string
     * @param bool $object (true returns object)
     * @return array
     *
     */
    public function get_results( $query, $object = false )
    {
        self::$counter++;
        //Overwrite the $row var to null
        $row = null;
        
        $results = $this->link->query( $query );
        if( $this->link->error )
        {
            return false;
        }
        else
        {
            $row = array();
            while( $r = ( !$object ) ? $results->fetch_assoc() : $results->fetch_object() )
            {
                $row[] = $r;
            }
            return $row;   
        }
    }
    
    
    /**
     * Insert data into database table
     *
     * Example usage:
     * $user_data = array(
     *      'name' => 'Yonox',
     *      'email' => 'email@address.com',
     *      'active' => 1
     * );
     * $database->insert( 'users_table', $user_data );
     *
     * @access public
     * @param string table name
     * @param array table column => column value
     * @return bool
     *
     */
    public function insert( $table, $variables = array() )
    {
        self::$counter++;
        //Make sure the array isn't empty
        if( empty( $variables ) )
        {
            return false;
        }
        
        $sql = "INSERT INTO ". $table;
        $fields = array();
        $values = array();
        foreach( $variables as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        
        $sql .= $fields .' VALUES '. $values;

        $query = $this->link->query( $sql );
        
        if( $this->link->error )
        {
            return false;
        }
        else
        {
            return true;
        }
    }
	
	public function createExampleTable()
	{
		$sql = "
		CREATE TABLE IF NOT EXISTS `lpm_users` (
		  `ID` bigint(20) UNSIGNED NOT NULL,
		  `user_login` varchar(60) NOT NULL DEFAULT '',
		  `user_pass` varchar(255) NOT NULL DEFAULT '',
		  `user_email` varchar(100) NOT NULL DEFAULT '',
		  `user_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `user_status` int(11) NOT NULL DEFAULT 0,
		  PRIMARY KEY (`ID`),
		  KEY `user_login` (`user_login`),
		  KEY `user_email` (`user_email`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
		
		$query = $this->link->query( $sql );
		
		if( $this->link->error )
        {
            return false;
        }
        else
        {
            return true;
        }
	}
	
	
	/**
     * Perform query to retrieve user information from database
     *
     * Example usage:
     * echo $database->lpm_user("username");
     *
     * @access public
     * @param string user login id
     * @return array or false if user not exists
     */
	public function lpm_user( $user )
    {
		$userQuery = $this->get_results( "SELECT user_login,user_pass FROM lpm_users WHERE user_login = '".$user."'" );
		
		if ( $userQuery )
		{
			$userInfo = array( 'user' => $userQuery[0]['user_login'], 'password' => $userQuery[0]['user_pass'] );
		} else {
			$userInfo = false;
		}
		return $userInfo;
    }
    
    
    /**
     * Get last auto-incrementing ID associated with an insertion
     *
     * Example usage:
     * $database->insert( 'users_table', $user );
     * $last = $database->lastid();
     *
     * @access public
     * @param none
     * @return int
     *
     */
    public function lastid()
    {
        self::$counter++;
        return $this->link->insert_id;
    }
    
    
    /**
     * Singleton function
     *
     * Example usage:
     * $database = lpmDB::getInstance();
     *
     * @access private
     * @return self
     */
    static function getInstance()
    {
        if( self::$inst == null )
        {
            self::$inst = new lpmDB();
        }
        return self::$inst;
    }
    
    
    /**
     * Disconnect from db server
     * Called automatically from __destruct function
     */
    public function disconnect()
    {
        $this->link->close();
    }

} //end class lpmDB

$database = new lpmDB;
