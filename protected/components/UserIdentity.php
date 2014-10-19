<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
// class UserIdentity extends CUserIdentity
// {
// 	/**
// 	 * Authenticates a user.
// 	 * The example implementation makes sure if the username and password
// 	 * are both 'demo'.
// 	 * In practical applications, this should be changed to authenticate
// 	 * against some persistent user identity storage (e.g. database).
// 	 * @return boolean whether authentication succeeds.
// 	 */
// 	public function authenticate()
// 	{
// 		$users=array(
// 			// username => password
// 			'demo'=>'demo',
// 			'admin'=>'admin',
// 		);
// 		if(!isset($users[$this->username]))
// 			$this->errorCode=self::ERROR_USERNAME_INVALID;
// 		elseif($users[$this->username]!==$this->password)
// 			$this->errorCode=self::ERROR_PASSWORD_INVALID;
// 		else
// 			$this->errorCode=self::ERROR_NONE;
// 		return !$this->errorCode;
// 	}
// }


/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	 private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		$username=$this->username;
		$password=$this->password;
		
		
		// $user=Users::model()->findByAttributes(array('email'=>$username));
		// //$user = Users::model()->findByAttributes(array('email'=>$this->username));

		// if ($user===null) 
		// { // No user found!
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// } 

		// else if ($user->password !== ($this->password) ) 
		// { // Invalid password!
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// } 

		// else 
		// { // Okay!
		// 	$this->errorCode=self::ERROR_NONE;
		// 	// Store the role in a session:
		// //	$this->setState('role', $user->role);
		// //	$this->_id = $user->id;
		// }
		// return !$this->errorCode;

		$users=Users::model()->findByAttributes(array('email'=>$username));
		echo '<pre>', var_dump($users), '</pre>' ;
		if(!empty($users))
		{
			if($password == $users->password)
			{
				//authentication is successful
				die($username);
				$this->errorCode=self::ERROR_NONE;
			}
			else
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
		}
		else
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		return !$this->errorCode;

	}

	public function getId()
	{
		return $this->_id;
	}
}