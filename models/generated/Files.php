<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $user_id
 * @property string $link
 * @property string $file_lock
 *
 * @property Users $user
 * @property Tasks[] $tasks
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'link', 'file_lock'], 'required'],
            [['user_id'], 'integer'],
            [['link'], 'string', 'max' => 150],
            [['file_lock'], 'string', 'max' => 70],
            [['file_lock'], 'unique'],
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
            'link' => 'Link',
            'file_lock' => 'File Lock',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['file_key' => 'file_lock']);
    }
}
