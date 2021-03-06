<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_job}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $requirements
 * @property string $type
 * @property string $salary_renge
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $contact_email
 * @property string $contact_phone
 * @property integer $is_published
 * @property string $create_date
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * Gets the class table name
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_job}}';
    }

    /**
     * Provides the validation rules
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'description', 'requirements', 'type', 'salary_renge', 'city', 'state', 'zipcode', 'contact_email', 'contact_phone'], 'required'],
            [['category_id', 'is_published'], 'integer'],
            [['description'], 'string'],
            [['create_date'], 'safe'],
            [['title', 'requirements', 'type', 'salary_renge', 'city', 'state', 'zipcode', 'contact_email', 'contact_phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'requirements' => 'Requirements',
            'type' => 'Type',
            'salary_renge' => 'Salary Renge',
            'city' => 'City',
            'state' => 'State',
            'zipcode' => 'Zipcode',
            'contact_email' => 'Contact Email',
            'contact_phone' => 'Contact Phone',
            'is_published' => 'Is Published',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * Fetches the job category
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Fetches the job author
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Determines the action before the saving
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->user_id = \Yii::$app->user->identity->id;
        return parent::beforeSave($insert);
    }
}
