<?php

/**
 * This is the model class for table "manifest".
 *
 * The followings are the available columns in table 'manifest':
 * @property integer $id_manifest
 * @property string $manifest_date
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
                        array('_guides','validGuides'),
                        array('_guides','uniqueGuide'),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_guide, _guides, id_manifest, manifest_date', 'safe', 'on'=>'search'),
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
                        '_guide' => Yii::t('database','Guide'),
                        '_guides' => Yii::t('database','Guides'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
