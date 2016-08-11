<?php

namespace app\components;

use Yii;
use yii\web\User;

/**
 * @property bool $isLoginGenuine Whether the using logged in using a "proper"
 * method, as opposed to a login cookie.
 */
class BlogUser extends User
{
    public $genuineLoginSessionKey = 'genuine-login';

    protected function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);
        if (!$cookieBased) {
            Yii::$app->session->set($this->genuineLoginSessionKey, true);
        }
    }

    protected function afterLogout($identity)
    {
        Yii::$app->session->remove($this->genuineLoginSessionKey);
        parent::afterLogout($identity);
    }

    public function getIsLoginGenuine()
    {
        return Yii::$app->session->get($this->genuineLoginSessionKey, false);
    }
}
