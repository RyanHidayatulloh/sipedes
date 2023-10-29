<?php
namespace app\controllers\api;

use app\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;
}
