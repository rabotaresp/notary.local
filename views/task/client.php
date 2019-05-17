<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Users */

use app\models\Files;
use app\models\Tasks;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;


$this->title = 'Task client';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <h1><?= Html::encode($this->title).' '. Yii::$app->user->identity->name; ?></h1>
    <p>Please fill out the following fields to add task:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'task-form',
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($task, 'tasks')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'docFile')->fileInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add task', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <table id="tab" class="table" >
        <thead>
        <tr>
            <th scope="col">Task</th>
            <th scope="col">Name Notariuses</th>
            <th scope="col">Status tasks</th>
            <th scope="col">Download file</th>
        </tr>
        </thead>
        <tbody>
        <?
            $count=0;
            foreach ($task_table as $item) {
                $name_notary = $req_names[$count];
        ?>
        <tr>
            <td><?= $item['tasks'] ?></td>
<!--            <td>--><?//= $item['user_check'] ?><!--</td>-->
            <td><?= $name_notary; ?></td>
            <td><?= $status[$item['task_check']] ?></td>
            <td>
                <?= \yii\helpers\Html::a('dowload',
                    ['download','key'=>$item['file_key']],['class' => 'btn btn-primary']);?>
            </td>

        </tr>
        <? $count++;}; ?>

        </tbody>
    </table>
<!--    <a href="reg">--><?//=$err;?><!--</a>-->

</div>