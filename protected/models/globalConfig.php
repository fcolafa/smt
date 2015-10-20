
<?php

/**
 * Reports class.
 * Reports is the data structure for keeping
 * Reports form data. It is used by the 'Sales' action of 'Sales'.
 */
class GlobalConfig extends CFormModel
{
    public $adminEmail;
    public $passwordEmail;
    public $sessionTime;
 
    public function rules()
    {
        return array(
            array('adminEmail,passwordEmail, sessionTime','required'),
            array('sessionTime', 'numerical','min'=>1),
            array('adminEmail','email'),
        );
    }
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'adminEmail'=> Yii::t('database','Email'),
                        'passwordEmail'=>Yii::t('database','Password'),
                        'sessionTime'=>Yii::t('database','Session Time'),
                      
		);
	}
}