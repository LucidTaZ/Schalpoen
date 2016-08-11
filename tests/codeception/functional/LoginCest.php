<?php

namespace app\tests\codeception\functional;

use Codeception\Scenario;
use FunctionalTester;
use tests\codeception\_pages\LoginPage;
use Yii;
use function GuzzleHttp\json_encode;

class LoginCest extends IntegrationTest
{
    public function wrongCredentials(FunctionalTester $I)
    {
        $I->am('the website owner');
        $I->wantTo('block wrong logins');
        $I->lookForwardTo('have security');

        $loginPage = LoginPage::openBy($I);

        $I->see('Inloggen', 'h2');

        $I->amGoingTo('try to login with empty credentials');
        $loginPage->login('', '');
        $I->expectTo('see validations errors');
        $I->see('Gebruikersnaam mag niet leeg zijn.');
        $I->see('Wachtwoord mag niet leeg zijn.');

        $I->amGoingTo('try to login with wrong credentials');
        $loginPage->login('admin', 'wrong');
        $I->expectTo('see validations errors');
        $I->see('Ongeldige gebruikersnaam of wachtwoord.');
    }

    public function correctCredentials(FunctionalTester $I)
    {
        $I->am('a website user');
        $I->wantTo('be admitted with my credentials');
        $I->lookForwardTo('use the authenticated features');

        $user = $this->ensureTestUser();

        $loginPage = LoginPage::openBy($I);

        $I->see('Inloggen', 'h2');

        $I->amGoingTo('try to login with correct credentials');
        $loginPage->login($user->username, $this->plainUserPassword);
        $I->expectTo('see user info');
        $I->see('Uitloggen (' . $user->displayName . ')');
    }

    public function notLoggedInAfterSessionWipe(FunctionalTester $I, Scenario $scenario)
    {
        $scenario->skip('we cannot see the session cookie due to unknown reason, making the test invalid');

        $I->am('the website owner');
        $I->wantTo('logout users that lose their session');
        $I->lookForwardTo('have security');

        $user = $this->ensureTestUser();

        $loginPage = LoginPage::openBy($I);

        $I->see('Inloggen', 'h2');

        $I->amGoingTo('verify that there is no login cookie');
        $I->dontSeeCookie('_identity');

        $I->amGoingTo('try to login with correct credentials');
        $loginPage->login($user->username, $this->plainUserPassword, false);

        $I->expectTo('see the session state of being logged in');
        $I->seeCookie(session_name());

        $I->expectTo('see the user login indication');
        $I->see('Uitloggen (' . $user->displayName . ')');

        $I->expectTo('verify that there is still no login cookie');
        $I->dontSeeCookie('_identity');

        $I->amGoingTo('forget the session');
        $I->resetCookie(session_name());
        $I->amOnPage($loginPage->url);
        $I->expectTo('not see the user login indication anymore');
        $I->dontSee('Uitloggen (' . $user->displayName . ')');
    }

    public function cookieLogin(FunctionalTester $I)
    {
        $I->am('a website user');
        $I->wantTo('login using a cookie');
        $I->lookForwardTo('having ease of use');

        $user = $this->ensureTestUser();

        $loginPage = LoginPage::openBy($I);

        $I->see('Inloggen', 'h2');

        $I->amGoingTo('verify the test precondition');
        $I->dontSeeCookie('_identity');

        $I->expectTo('see no user login indication');
        $I->dontSee('Uitloggen (' . $user->displayName . ')');

        $I->amGoingTo('set the remember-me cookie');
        // We have to jump through some hoops to satisfy the cookie validation. Alternatively we can turn it off in the config, but this works too.
        $secureCookieValue = Yii::$app->getSecurity()->hashData(serialize(['_identity', json_encode([
            $user->getId(),
            $user->getAuthKey(),
            1, // duration
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)]), Yii::$app->request->cookieValidationKey);
        $I->setCookie('_identity', $secureCookieValue);

        $I->amOnPage($loginPage->url);
        $I->expectTo('see the user login indication');
        $I->see('Uitloggen (' . $user->displayName . ')');
    }

    public function genuineLogin(FunctionalTester $I, Scenario $scenario)
    {
        $I->am('the website owner');
        $I->wantTo('distinguish between cookie logins and password logins');
        $I->lookForwardTo('block sensitive functionality when not using a password');

        $scenario->incomplete('TODO: Verify that a user is genuinely logged in only when a password is used');
    }
}
