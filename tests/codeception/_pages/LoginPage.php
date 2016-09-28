<?php

namespace tests\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class LoginPage extends BasePage
{
    public $route = 'site/login';

    public function login(string $username, string $password, bool $rememberMe = false)
    {
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        if ($rememberMe) {
            $this->actor->checkOption('#loginform-rememberme'); // Have to use the ID, because the name is also a hidden field...
        } else {
            $this->actor->uncheckOption('#loginform-rememberme');
        }
        $this->actor->click('button[type=submit]');
    }
}
