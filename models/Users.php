<?php
namespace app\models;

class Users extends \app\models\generated\Users
{
    const ROLE_CLIENT = 1;
    const ROLE_NOTARY = 2;
    public function rules()
    {
        return array_merge(
            parent::rules(),[

            ]
        );

    }
}
