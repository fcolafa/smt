<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id_user
 * @property string $user_name
 * @property string $password
 * @property string $session
 * @property string $role
 * @property string $date_create
 * @property string $email
 * @property string $user_names
 * @property string $user_lastnames
 * @property string $user_rut
 *
 * The followings are the available model relations:
 * @property Headquarter[] $headquarters
 * @property Labor[] $labors
 * @property Route[] $routes
 * @property Session[] $sessions
 * @property Company $idCompany
 */

class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        
        public $password_repeat;
        public $_company_name;
        public $_oldpassword;
        public $id_user_receptor;

	public function tableName()
	{
		return 'users';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, password,_oldpassword,, password_repeat,email', 'required'),
                        array('user_name,email, user_rut','unique'),
			array('user_name, password, session, role, email,user_names, user_lastnames, user_rut', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user,user_name, password, session, role, date_create, email, user_names, user_lastnames, user_rut', 'safe', 'on'=>'search'),
                        array('email','email'),
                        array('id_company,user_phone, first_time', 'numerical', 'integerOnly'=>true),
                        array('user_rut','validateRut','allowEmpty'=>'false'),
                        array('role','atleastone','on'=>'update'),
                        array('id_user','requiredNames','on'=>'update'),
                        array('password', 'compare'),
                        array('password_repeat, password,_oldpassword', 'safe'),
                        array('_oldpassword','updatePassword','on'=>'update'),
                        array('_company_name','safe','on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'guides' => array(self::MANY_MANY, 'Guide', 'send(id_user_emisor, id_guide)'),
                    'headquarters' => array(self::HAS_MANY, 'Headquarter', 'id_user'),	
                    'labors' => array(self::HAS_MANY, 'Labor', 'id_user'),
                    'sessions' => array(self::HAS_MANY, 'Session', 'id_user'),
                    'idCompany' => array(self::BELONGS_TO, 'Company', 'id_company'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => Yii::t('database','Id User'),
			'user_name' => Yii::t('database','User Name'),
			'password' => Yii::t('database','Password'),
			'session' => Yii::t('database','Session'),
			'role' => Yii::t('database','Role'),
			'date_create' => Yii::t('database','Date Create'),
			'email' => Yii::t('database','Email'),
                        'password_repeat'=>Yii::t('database','Repeat Password'),
                        'user_names' => Yii::t('database','User Names'),
			'user_lastnames' => Yii::t('database','User Lastnames'),
			'user_rut' => Yii::t('database','User Rut'),
                        '_oldpassword'=>  Yii::t('database','Old Password'),
                        'id_company' => Yii::t('database','Id Company'),
                        '_complete_name'=>Yii::t('database','Complete Name'),
                        'user_phone'=>Yii::t('database','User Phone'),
                        'first_time'=>Yii::t('database','First Time'),
                        
		);
	}
        public function validatePassword($password)
        {
            return $this->hashPassword($password,$this->session)===$this->password;
        }
        public function hashPassword($password,$salt){
            return md5($salt.$password);
        } 
        public function generateSalt(){
            return uniqid('',true);
        }
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('idCompany');
                $criteria->together=true;
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('date_Create',$this->date_create,true);
		$criteria->compare('email',$this->email,true);
                $criteria->compare('role',$this->role,true);
                
                $criteria->compare('user_names',$this->user_names,true);
		$criteria->compare('user_lastnames',$this->user_lastnames,true);
		$criteria->compare('user_rut',$this->user_rut,true);
                $criteria->compare('id_company',$this->id_company);
                $criteria->compare('user_phone',$this->user_phone);
                $criteria->compare('idCompany.company_name',$this->_company_name, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function searchAdmin()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('idCompany');
                $criteria->together=true;
                $criteria->condition = 'role<>"Control Total" and role <> "Supervisor"';
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('date_Create',$this->date_create,true);
		$criteria->compare('email',$this->email,true);
                $criteria->compare('role',$this->role,true);
                $criteria->compare('user_names',$this->user_names,true);
		$criteria->compare('user_lastnames',$this->user_lastnames,true);
		$criteria->compare('user_rut',$this->user_rut,true);
                $criteria->compare('id_company',$this->id_company);
                $criteria->compare('user_phone',$this->user_phone);
                $criteria->compare('idCompany.company_name',$this->_company_name, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function updatePassword($attribute, $params) {
           $user=  Users::model()->findByPk($this->id_user);
           if($this->id_user!=Yii::app()->user->id){
               if ($this->_oldpassword!=$user->password)
                     $this->addError($attribute, Yii::t('validation','Wrong Password'));
           }
           else{
                if (md5($this->_oldpassword)!=$user->password)
                     $this->addError($attribute, Yii::t('validation','Wrong Password'));
                }
           
	}
         public function validateRut($attribute, $params) {
            
            $data = explode('-', $this->user_rut);
            $dataout = ereg_replace("[.]", "", $data[0]);
          
            $evaluate = strrev($dataout);
            $multiply = 2;
            $store = 0;
            for ($i = 0; $i < strlen($evaluate); $i++) {
                $store += $evaluate[$i] * $multiply;
                $multiply++;
                if ($multiply > 7)
                    $multiply = 2;
            }
 
            isset($data[1]) ? $verifyCode = strtolower($data[1]) : $verifyCode = '';
            $result = 11 - ($store % 11);
            if ($result == 10)
                $result = 'k';
            if ($result == 11)
                $result = 0;
            if ($verifyCode != $result ||!is_numeric($dataout))
                $this->addError('client_rut', Yii::t('validation','Invalid Rut'));
        }
        /**
         * validate that cant modifi the only one user with 'Administrator' permissions
          * @param type $attribute
         * @param type $params
         */
         public function atleastone($attribute, $params) {
             $users=  Users::model()->findAll('role="Administrador"' );
             $u=  Users::findByPk($this->id_user);
             if(count($users)<2&&$u->role=="Administrador" && $u->role!=$this->role)
                $this->addError ($attribute , 'No puede modificar el tipo de usuario, ya que es el unico usuario con permisos de Administrador');
         }
         public function requiredNames($attribute, $params){
             
             if(!Yii::app()->user->checkAccess('Administrador')){
                if(empty($this->user_names))
                $this->addError ('user_names' ,  Yii::t('yii','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel('user_names'))));
                if(empty($this->user_lastnames))
                     $this->addError ('user_lastnames' ,  Yii::t('yii','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel('user_lastnames'))));
            }
         }

}
