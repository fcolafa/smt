<?php

/**
 * This is the model class for table "manifest".
 *
 * The followings are the available columns in table 'manifest':
 * @property integer $id_manifest
 * @property string $manifest_date
 *  * @property integer $id_embarkation
 * @property string $manifest_charge_date
 * @property integer $id_headquarter
 * @property string $manifest_observation
 * @property string $manifest_sailing
 * @property string $manifest_return
 *
 * The followings are the available model relations:
 * @property Guide[] $guides
 */
class Manifest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_guide;
        public $_guides=array();    
          public $_weights=array();
	public function tableName()
	{
		return 'manifest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        
			array('manifest_date', 'safe'),
                    array('id_embarkation, id_headquarter','required'),
                        array('_guides','validGuides'),
                        array('_guides','uniqueGuide'),
                      array('_weights','reloadSelect'),
                        array('id_embarkation, id_headquarter', 'numerical', 'integerOnly'=>true),
			array('manifest_sailing, manifest_return', 'length', 'max'=>45),
			array('manifest_date, manifest_charge_date, manifest_observation', 'safe'),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_guide, _guides, id_manifest, manifest_date, id_embarkation, manifest_charge_date, id_headquarter, manifest_observation, manifest_sailing, manifest_return', 'safe', 'on'=>'search'),
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
			'guides' => array(self::HAS_MANY, 'Guide', 'id_manifest'),
                        'idEmbarkation' => array(self::BELONGS_TO, 'Embarkation', 'id_embarkation'),
			'idHeadquarter' => array(self::BELONGS_TO, 'Headquarter', 'id_headquarter'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_manifest' => Yii::t('database','Id Manifest'),
			'manifest_date' => Yii::t('database','Manifest Date'),
                        'manifest_charge_date' => Yii::t('database','Manifest Charge Date'),
                        '_guide' => Yii::t('database','Ingresar guias (tipee)'),
                        '_guides' => Yii::t('database','Guides'),
                        'id_headquarter' => Yii::t('database','Centro'),
                        'id_embarkation' => Yii::t('database','Nave'),
			'manifest_observation' => Yii::t('database','Manifest Observation'),
			'manifest_sailing' => Yii::t('database','Manifest Sailing'),
			'manifest_return' => Yii::t('database','Manifest Return'),
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

		$criteria->compare('id_manifest',$this->id_manifest);
		$criteria->compare('manifest_date',$this->manifest_date,true);
                $criteria->compare('id_embarkation',$this->id_embarkation);
		$criteria->compare('manifest_charge_date',$this->manifest_charge_date,true);
		$criteria->compare('id_headquarter',$this->id_headquarter);
		$criteria->compare('manifest_observation',$this->manifest_observation,true);
		$criteria->compare('manifest_sailing',$this->manifest_sailing,true);
		$criteria->compare('manifest_return',$this->manifest_return,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
         public function reloadSelect($attribute,$params)
        {
            $newfile=array();
            if(!empty($this->$attribute)){
                foreach($this->$attribute as $key => $value){
                    $newfile[$value]=$value;
                }
                $this->$attribute=$newfile;
            
             }
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Manifest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
            public function validGuides($model,$attribute)
        {
            $newfile=array();
            if(!empty($this->_guides)){
                foreach($this->_guides as $key => $value){
                    $newfile[$value]=$value;
                }
            $this->_guides=$newfile;
            
             }else
                 if(empty ($this->_guides)){
                     $this->addError('_guide', 'Debe existir al menos una guia asociada');
                 }
        }
       
        public function uniqueGuide($model,$attribute){
           
                foreach($this->_guides as $key => $value){
                $criteria=new CDbCriteria();
                if($this->isNewRecord)
                    $criteria->condition="id_manifest IS NOT NULL  AND id_guide='".$value."'";
                else
                    $criteria->condition="id_manifest <>".$this->id_manifest."  AND id_guide='".$value."'";
                $guides=  Guide::model()->findAll($criteria);
                $guide=  Guide::model()->findByPk($value);
                if(!empty($guides)){
                        $this->addError('_guide', "la guia ".$guide->num_guide.' Ya ha sido ingresado en otro manifiesto');
                    }
                }
                    
        }
       
}
