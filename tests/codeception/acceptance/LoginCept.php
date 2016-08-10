<?php

use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = LoginPage::openBy($I);

$I->see('Inloggen', 'h1');

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('see validations errors');
$I->see('Gebruikersnaam mag niet leeg zijn.');
$I->see('Wachtwoord mag niet leeg zijn.');

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin', 'wrong');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('see validations errors');
$I->see('Ongeldige gebruikersnaam of wachtwoord.');

/*$I->amGoingTo('try to login with correct credentials');
$loginPage->login('admin', 'admin');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('see user info');
$I->see('Logout (admin)');
*/