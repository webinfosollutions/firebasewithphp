<?php 

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
/**
 * 
 */
class User
{
	
	protected $db;

	protected $dbname = 'register_users';

	function __construct(){

		$factory = (new Factory())
    					->withDatabaseUri('https://phpwithfirebase-53e56.firebaseio.com/');

		$this->db = $factory->createDatabase();

	}

	public function get( int $userId )
	{
		if(empty($userId) || !isset($userId) ){
			return false;
		}

		if($this->db->getReference($this->dbname)->getSnapShot()->hasChild($userId)){
			return $this->db->getReference($this->dbname)->getChild($userId)->getValue();
		}else{
			return false;
		}
	}

	public function insert( array $data )
	{
		if(empty($data) || !isset($data) ){
			return false;
		}

		foreach ($data as $key => $value) {
			$this->db->getReference()->getChild($this->dbname)->getChild($key)->set($value);
		}

		return TRUE;
	}

	public function delete( int $userId )
	{
		if(empty($userId) || !isset($userId) ){
			return false;
		}

		if($this->db->getReference($this->dbname)->getSnapShot()->hasChild($userId)){
			$this->db->getReference($this->dbname)->getChild($userId)->remove();
			return true;
		}else{
			return false;
		}
	}

}


$users = new User();

$insert = $users->insert([
	'1'	=>	"Alexa v2.0",
	'2'	=>	"Siri v4.6",
	'3'	=>	"Google v 20.3",
]);

//$retrive = $users->get(2);

//$remove = $users->delete(4);

var_dump($insert);
exit;
print_r($retrive);