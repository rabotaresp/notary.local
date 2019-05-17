<?php
namespace app\models;

class Tasks extends \app\models\generated\Tasks
{
    const TASKS_WAITING = 1;
    const TASKS_INWORK = 2;
    const TASKS_DONE = 3;

    public function rules()
    {
        return array_merge(
            parent::rules(),[

            ]
        );
    }
    public function findTaskNotary()
    {
        $task_table = self::find()->andWhere(['user_check'=> 0])->all();
        return $task_table;
    }
    public function findTaskClient()
    {
        $task_table = self::find()->andWhere(['user_id'=> Yii::$app->user->identity->id])->all();
        return $task_table;
    }
    public function findName($id)
    {
        $req_name = Users::findOne(['id'=>$id]);
        return $req_name['name'];
    }
}
