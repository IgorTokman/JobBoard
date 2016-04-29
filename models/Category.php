<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * Gets the class table name
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
    }

    /**
     * Provides the validation rules
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * Fetches the category jobs
     * @return \yii\db\ActiveQuery
     */
    public function getJob(){
        return $this->hasMany(Job::className(), ['category_id' => 'id']);
    }
}
