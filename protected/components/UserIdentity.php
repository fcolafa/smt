<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private  $_id;
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
                $user= Users::model()->find('LOWER(user_name)=?',array(strtolower($this->username)));
                if( $user===null)
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
                    else if( !$user->validatePassword($this->password) )  
                            $this->errorCode=self::ERROR_PASSWORD_INVALID;
                        else
                        {
                            $this->_id=$user->id_user;
                            $this->setState('role', $user->role);
                            $this->username=$user->user_name;
                            $this->errorCode=self::ERROR_NONE;
                            $info_usuario = Users::model()->find('LOWER(user_name)=?', array($user->user_name));        
                            $sql = "INSERT INTO session (`id_user`,`login`) VALUES (".$user->id_user." , now() )";
                            $connection = Yii::app() -> db;
                            $command = $connection -> createCommand($sql);
                            $command -> execute();
                        }
                        return $this->errorCode==self::ERROR_NONE;
	}
        public function getId() {
            return $this->_id;
        }

}