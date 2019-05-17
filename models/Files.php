<?php
namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Files extends \app\models\generated\Files
{
    public $docFile;

    public function rules()
    {
        return array_merge(
            parent::rules(),[

            ]
        );
    }
    public function upload()
    {
        $this->docFile = UploadedFile::getInstance($this, 'docFile');
        $name = md5(time().rand(1,99).$this->docFile->baseName);
        $path = './uploads/'.$name[0].'/'.$name[1];
        $this->file_lock = md5(time().rand(1,9));
        $this->user_id = Yii::$app->user->identity->id;
        $this->link = $path.'/'. $name. '.' . $this->docFile->extension;
        $this->save();
        if(!$this->save()){
            echo'<pre>';
            print_r($this->errors);
            exit();
        }
        if ($this->validate()) {
            if(!file_exists($path)){
                mkdir($path, 0777,true);
            }
            $this->docFile->saveAs($path.'/'. $name. '.' . $this->docFile->extension);
            return true;
        } else {
            return false;
        }
    }
    public function dowload($key)
    {

        $user = Yii::$app->user->identity->id;
        $file_path = self::find()->andWhere(['filename' => $key])->one();
        $file = $_SERVER['DOCUMENT_ROOT'].Yii::getAlias('@web') . trim($file_path['fileway'],'.');

        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }
}
