<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property int $user_check
 * @property string $file_key
 *
 * @property Files $fileKey
 * @property Users $user
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status', 'user_check'], 'integer'],
            [['file_key'], 'string', 'max' => 150],
            [['file_key'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_key' => 'file_lock']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'user_check' => 'User Check',
            'file_key' => 'File Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileKey()
    {
        return $this->hasOne(Files::className(), ['file_lock' => 'file_key']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
