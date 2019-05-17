<?php

namespace app\controllers;

use app\controllers\base\SecuredController;
use app\models\Files;
use app\models\Tasks;
use Yii;
use yii\web\UploadedFile;

class NotaryController extends SecuredController
{
    public function actionNotary()
    {
        $model = new Files();
        $task = new Tasks();
        if(Yii::$app->user->identity->role !=2) {
            return $this->redirect(['auth/login']);
        }
        if (Yii::$app->request->isPost) {
            $model->docFile = UploadedFile::getInstance($model, 'docFile');
            $name = md5(time().rand(1,99).$model->docFile->baseName);
            $path = './uploads/'.$name[0].'/'.$name[1];
            $model->file_lock = md5(time().rand(1,9));
            $model->user_id = Yii::$app->user->identity->id;
            $model->link = $path.'/'. $name. '.' . $model->docFile->extension;
            $model->save();
            if(!$model->save()){
                echo'<pre>';
                print_r($model->errors);
                exit();
            }
            if ($model->upload($path, $name)) {
                return $this->redirect('/notary/notary');
            }
        }
        $model->docFile = null;
        $task_table = $task->findTaskNotary();
        foreach ($task_table as $item) {
            $req_names[] = $task->findName($item['user_id']);

        }
        return $this->render('/task/notar', ['model' => $model, 'task' => $task, 'task_table'=>$task_table, 'req_names'=> $req_names,]);
    }

    public function actionWorking($id)
    {
        $task = Tasks::findOne($id);
        $task->task_check = Tasks::STATUS_INWORKING;
        $task->user_check = Yii::$app->user->id;
        if($task->save()){
            return $this->redirect(['notary/notary']);
        }
    }

    public function actionDownload($id)
    {
        $file_download = new Files();
        $file_download->dowload($id);
    }
}

