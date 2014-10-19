<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $comment
 */
class Users extends CActiveRecord
{
	public $rpassword;
	public $identity;
	/**
	 * @return string the associated database table name
	 */
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
			array('firstname, lastname, email, password, rpassword, comment', 'required', 'on'=>'register'),
			array('email', 'unique', 'on' => 'register'),
			array('email, password', 'required', 'on'=>'login'),
			array('firstname, lastname, email, password', 'length', 'max'=>32),
			array('email', 'match', 'pattern'=> '/^([a-z0-9_\.-]+)@(somaiya)\.(edu)$/',  'message' => 'Please use somaiya.edu email',),
			array('rpassword', 'compare', 'compareAttribute'=>'password', 'on'=>'register'),
			array('password','authenticate','on'=>'login'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstname, lastname, email, password, comment', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'password' => 'Password',
			'rpassword' => 'Retype Password',
			'comment' => 'Comment',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('comment',$this->comment,true);

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

	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new UserIdentity($this->email,$this->password);
			$identity->authenticate();
			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					Yii::app()->users->login($identity);
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('email','Email address is incorrect.');
					break;
				default: // UserIdentity::ERROR_PASSWORD_INVALID
					$this->addError('password','Password is incorrect.');
					break;
			}
		}
	}
	 
	public function login()
	{
		if($identity==null)
		{
			$identity=new UserIdentity($this->username,$this->password);
			$identity->authenticate();
		}
		if($identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->users->login($identity,$duration);
			return true;
		}
		else
			return false;
	}

	// public function pdf()
	// {
	// 	// $users=Users::model()->findByAttributes(array('email'=>$username));
	// 	// echo '<pre>', var_dump($users), '</pre>' ;

	// 	// $criteria=new CDbCriteria;
	// 	// $criteria->compare('id',$this->id,true);
	// 	// $criteria->compare('firstname',$this->firstname,true);
	// 	// $criteria->compare('lastname',$this->lastname,true);
	// 	// $criteria->compare('email',$this->email,true);
	// 	// $criteria->compare('password',$this->password,true);
	// 	// $criteria->compare('comment',$this->comment,true);

	// 	// return new CActiveDataProvider($this, array(
	// 	// 	'criteria'=>$criteria,
	// 	// ));

		
	// }
}
