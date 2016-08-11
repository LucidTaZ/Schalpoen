<?php

namespace app\components;

use Yii;
use yii\filters\AccessRule;

/**
 * Access rule that allows filtering on "real" password logins
 *
 * This class adds an access rule "@!" that only provides access when the user
 * is logged in to this session via a password entry. If the user logged in via
 * a cookie, access is denied. It is therefore a stricter version of "@".
 */
class GenuineLoginAccessRule extends AccessRule
{
    protected function matchRole($user)
    {
        if (parent::matchRole($user)) {
            return true;
        }

        if (!($user instanceof BlogUser)) {
            // We cannot type-hint this argument since the parent method is not type hinted.
            Yii::warning('Using app\components\GenuineLoginAccessRule with incompatible yii\web\User', __METHOD__);
            return false;
        }

        foreach ($this->roles as $role) {
            if ($role == '@!') {
                if (!$user->isGuest && $user->isLoginGenuine) {
                    return true;
                }
            }
        }

        return false;
    }
}
