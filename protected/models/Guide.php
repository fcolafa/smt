<?php

/**
 * This is the model class for table "guide".
 *
 * The followings are the available columns in table 'guide':
 * @property integer $id_guide
 * @property integer $id_user
 * @property string $num_guide
 * @property string $pdf_guide
 * @property string $xml_guide
 * @property string $date_guide_create
 * @property integer $id_user
 * @property integer $id_manifest
 * @property string $guide_weight_type
 *
 * The followings are the available model relations:
 * @property Manifest $idManifest
 * @property Users $idUser
 * @property Headquarters[] $headquarters
 * @property Embarkation[] $embarkations
 */
class Guide extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $_send;
        public $_company;
        public $_manifestdate;
        public $_headquarterName;
        public $_destinationName;
     
	public function tableName()
	{
		return 'guide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('num_guide, date_guide_create, sended_guide, id_user', 'required'),
			array('id_headquarter,id_user_creator,id_user, sended_guide, id_manifest', 'numerical', 'integerOnly'=>true),
                        array('sended_guide, id_user, manifest_order_guide', 'numerical', 'integerOnly'=>true),
			array('num_guide, guide_status ,guide_weight_type', 'length', 'max'=>45),
			array('pdf_guide, xml_guide', 'length', 'max'=>60),
                    
                        // array('guide', 'length','max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('manifest_order_guide ,guide_weight_type, id_destination,id_headquarter, _manifestdate,id_user_creator,id_manifest,_company,_send, id_guide, id_user, num_guide, pdf_guide, xml_guide, date_guide_create, sended_guide, id_user, id_manifest', 'safe', 'on'=>'search'),
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
                        'idHeadquarter' => array(self::BELONGS_TO, 'Headquarter', 'id_headquarter'),
                        'idDestination' => array(self::BELONGS_TO, 'Headquarter', array('id_destination'=>'id_headquarter')),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
                        'idManifest' => array(self::BELONGS_TO, 'Manifest', 'id_manifest'),
                        'sends' => array(self::HAS_MANY, 'Send', 'id_guide'),
			'weights' => array(self::HAS_MANY, 'Weight', 'id_guide'),
                        'receptions' => array(self::HAS_MANY, 'GuideHasRecepction', 'id_guide'),
                        'idUserc' => array(self::BELONGS_TO, 'Users', array('id_user_creator'=>'id_user')),			
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_guide' => Yii::t('database','Id Guide'),
			'num_guide' => Yii::t('database','Num Guide'),
			'pdf_guide' => Yii::t('database','Pdf Guide'),
			'xml_guide' => Yii::t('database','Xml Guide'),
                        'date_guide_create' => Yii::t('database','Date Guide Create'),
                        'sended_guide' => Yii::t('database','Sended Guide'),
			'id_user' => Yii::t('database','Emisor Guia'),
                        'id_manifest' => Yii::t('database','Id Manifest'),
                        'id_user_creator' => Yii::t('database','Consignatario'),
                        '_manifestdate' => Yii::t('database','Manifest Date'),
                        '_headquarterName' => Yii::t('database','Origen'),
                        '_destinationName' => Yii::t('database','Destino'),
                        'id_headquarter' => Yii::t('database','Origen'),
                        'id_destination' => Yii::t('database','Destino'),
                        'guide_weight_type' => Yii::t('database','Tipo de Carga'),
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
                $criteria->with=array('idUser.idCompany','idManifest','idHeadquarter','idDestination');
                $criteria->together=true;
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('num_guide',$this->num_guide,true);
		$criteria->compare('pdf_guide',$this->pdf_guide,true);
		$criteria->compare('xml_guide',$this->xml_guide,true);
		$criteria->compare('date_guide_create',$this->date_guide_create,true);
                $criteria->compare('sended_guide',$this->sended_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('idCompany.company_name',$this->_company,true);
                $criteria->compare('id_manifest',$this->id_manifest);
                $criteria->compare('id_user_creator',$this->id_user_creator);
                $criteria->compare('guide_weight_type',$this->guide_weight_type,true);
                $criteria->compare('idManifest.manifest_date',$this->_manifestdate,true);     
                $criteria->compare('idHeadquarter.headquarter_name',$this->_headquarterName,true);     
                $criteria->compare('idDestination.headquarter_name',$this->_destinationName,true);     
               //	$criteria->compare('id_headquarter',$this->id_headquarter);             
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
		));
	}
        public function searchGuide()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
                $criteria->with=array('idUser.idCompany',);
                $criteria->together=true;
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('num_guide',$this->num_guide,true);
		$criteria->compare('pdf_guide',$this->pdf_guide,true);
		$criteria->compare('xml_guide',$this->xml_guide,true);
		$criteria->compare('date_guide_create',$this->date_guide_create,true);
                $criteria->compare('sended_guide',$this->sended_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('idCompany.company_name',$this->_company,true);
                $criteria->compare('id_manifest',$this->id_manifest);
                $criteria->compare('id_user_creator',$this->id_user_creator);
                $criteria->compare('id_headquarter',$this->id_headquarter);
                            
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
		));
	}
	public function searchClient()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
                $criteria->with=array('idUser.idCompany','idManifest','idHeadquarter','idDestination');
                $criteria->together=true;
                $user= Users::model()->findByPk(Yii::app()->user->Id);
                $criteria->condition ='idCompany.id_company='.$user->id_company;
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('num_guide',$this->num_guide,true);
		$criteria->compare('pdf_guide',$this->pdf_guide,true);
		$criteria->compare('xml_guide',$this->xml_guide,true);
		$criteria->compare('date_guide_create',$this->date_guide_create,true);
                $criteria->compare('idCompany.company_name',$this->_company,true);
                $criteria->compare('sended_guide',$this->sended_guide);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_manifest',$this->id_manifest);
		$criteria->compare('id_user_creator',$this->id_user_creator);
                $criteria->compare('idManifest.manifest_date',$this->_manifestdate,true);
                $criteria->compare('id_headquarter',$this->id_headquarter); 
                $criteria->compare('idHeadquarter.headquarter_name',$this->_headquarterName,true);     
                $criteria->compare('idDestination.headquarter_name',$this->_destinationName,true);  
                
		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Guide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
           public function uniqueGuide($model,$attribute)
        {
               
            $criteria=new CDbCriteria();
            $criteria->with=array('idUser');
            $criteria->together=true;
            $criteria->condition = 't.num_guide='.$this->num_guide." and idUser.id_company=".$this->idUser->id_company;
            $guide= Guide::model()->findall($criteria);
            if( $count($guide)>=1)
                $this->addError('_guide', 'No pueden existir dos guías de despacho con el mismo numero de guía');
            
        }
         public function comp($model,$attribute)
        {
             if(!Yii::app()->checkAccess('Administrador')){
                 $user=  User::model()->findByPk(Yii::app()->user->Id);
                 if($user)
                     $this->_company=$user->id_company;
             }
         }
         public function distinctHead(){
             if(!empty($this->id_headquarter)&&!empty($this->id_destination))
                 if($this->id_headquarter==$this->id_destination)
                     $this->addError('_guide', 'El Origen y Destino deben ser diferentes');
         }
}