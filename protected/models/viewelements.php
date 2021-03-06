<?php

/**
 * This is the model class for table "viewelements".
 *
 * The followings are the available columns in table 'viewelements':
 * @property string $siteid
 * @property string $html
 * @property integer $id
 * @property string $viewname
 * @property string $elemid
 * @property string $elemtype
 * @property string $elemparameters
 * @property string $elemcode
 */
class Viewelements extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'viewelements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('siteid, html, viewname, elemid, elemtype, elemparameters, elemcode', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('siteid, html, id, viewname, elemid, elemtype, elemparameters, elemcode', 'safe', 'on'=>'search'),
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
			'siteid' => 'Siteid',
			'html' => 'Html',
			'id' => 'ID',
			'viewname' => 'Viewname',
			'elemid' => 'Elemid',
			'elemtype' => 'Elemtype',
			'elemparameters' => 'Elemparameters',
			'elemcode' => 'Elemcode',
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

		$criteria->compare('siteid',$this->siteid,true);
		$criteria->compare('html',$this->html,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('viewname',$this->viewname,true);
		$criteria->compare('elemid',$this->elemid,true);
		$criteria->compare('elemtype',$this->elemtype,true);
		$criteria->compare('elemparameters',$this->elemparameters,true);
		$criteria->compare('elemcode',$this->elemcode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Viewelements the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function listViewElementsAsOption($viewid)
                
        {
            $view=  view::model()->findByPk($viewid);
        
            $models=Viewelements::model()->findAllByAttributes(array('siteid'=>$view->site_id,'viewname'=>$view->name));
            $str='';
            foreach($models as $model)
            {
                $str.='<option value="'.$model->id.'">'.$model->elemtype.'</option>'."\n";
            }
            return $str;
        }
}
