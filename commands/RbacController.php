<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $staff = $auth->createRole('staff');
        $auth->add($staff);
        $kades = $auth->createRole('kades');
        $auth->add($kades);
        $pemohon = $auth->createRole('pemohon');
        $auth->add($pemohon);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
        $auth->assign($staff, 2);
        $auth->assign($kades, 3);
        $auth->assign($pemohon, 4);
    }
}
