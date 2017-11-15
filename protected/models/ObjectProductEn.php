<?php

/**
 * This is the model class for table "object_product_en".
 *
 * The followings are the available columns in table 'object_product_en':
 * @property string $id
 * @property string $name
 * @property string $category_id
 * @property string $category
 * @property double $price
 * @property string $prod_place
 * @property string $description
 * @property string $last_modified
 * @property string $status
 * @property string $prod_count
 * @property string $image_url
 */
class ObjectProductEn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'object_product_en';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price', 'numerical'),
			array('name, category', 'length', 'max'=>255),
			array('category_id, prod_count', 'length', 'max'=>10),
			array('prod_place', 'length', 'max'=>45),
			array('status', 'length', 'max'=>8),
			array('image_url', 'length', 'max'=>200),
			array('description, last_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, category_id, category, price, prod_place, description, last_modified, status, prod_count, image_url', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'category_id' => 'Category',
			'category' => 'Category',
			'price' => 'Price',
			'prod_place' => 'Prod Place',
			'description' => 'Description',
			'last_modified' => 'Last Modified',
			'status' => 'Status',
			'prod_count' => 'Prod Count',
			'image_url' => 'Image Url',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('prod_place',$this->prod_place,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('prod_count',$this->prod_count,true);
		$criteria->compare('image_url',$this->image_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ObjectProductEn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
