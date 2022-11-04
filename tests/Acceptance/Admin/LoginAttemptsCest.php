<?php


namespace Tests\Acceptance\admin;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class LoginAttemptsCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->amGoingTo('submit login form with a correct username & password field');
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'pass',
        ]);

        /*
        * Dashboard
        * */
        $I->amOnPage('/dashboard');

        $I->expect('to see the text "The Dashboard"');
        $I->see('The Dashboard');
    }

    public function listLogins(AcceptanceTester $I)
    {
        $I->expect('to see "Login Attempts" in the Admin Dropdown');
        $I->see('Login Attempts', Locator::href('/list-logins'));

        $I->amGoingTo('click "Login Attempts" in the Admin Dropdown');
        $I->click('Login Attempts');

        $I->expect('to go to the "Login Attempts" page');
        $I->seeCurrentUrlEquals('/list-logins');
    }
}
