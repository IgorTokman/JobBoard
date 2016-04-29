<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password_repeat;

    /**
     * Gets the class table name
     * @return string
     */
    public static function tableName()
    {
        return '{{%tbl_user}}';
    }

    /**
     * Provides the validation rules
     * @return array
     */
    public function rules()
    {
        return [
            [['full_name', 'username', 'email', 'password', 'password_repeat'], 'required'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Gets the user id
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the user authKey
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Checks the user authKey
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Determines the action before the saving
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            if ($this->isNewRecord)
                $this->auth_key = \Yii::$app->security->generateRandomString();

            if(isset($this->password)) {
                $this->password = md5($this->password);
                parent::beforeSave($insert);
            }
        }

        return true;
    }

    /**
     * Validates the password.
     * @param $password
     * @return bool
     */
    public function validatePassword($password){
        return $this->password === md5($password);
    }

    /**
     * Performs the search by username
     * @param $username
     * @return null|static
     */
    public function findByUsername($username){
        return User::findOne(['username' => $username]);
    }

    /** Fetches the user jobs
     * @return \yii\db\ActiveQuery
     */
    public function getJob(){
        return $this->hasMany(Job::className(), ['user_id' => 'id']);
    }
}