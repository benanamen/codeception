<?php


namespace Tests\Acceptance;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
    }

    public function WhatISee(AcceptanceTester $I)
    {
        $I->seeInTitle('Perfect App Starter');

        $I->expect('to see a Url "/login"');
        $I->seeCurrentUrlEquals('/login');

        $I->expect('to see a H3 title that says "Login"');
        $I->see('Login', 'H3');

        /*
        * Check Username Components
        * */
        $I->expect('to see a label that says "Username');
        $I->seeElement(Locator::contains('label', 'Username'));
        $I->seeElement('label', ['for' => 'username']);

        /*
         * Check Password Components
         * */
        $I->expect('to see a label that says "Password');
        $I->seeElement(Locator::contains('label', 'Password'));
        $I->seeElement('label', ['for' => 'password']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'password']);

        /*
         * Check Links
         */
        $I->expect('to see Login Button Link');
        $I->see('Login', '.btn-primary');

        $I->expect('to see Register Button Link');
        $I->see('Register', '.btn-secondary');

        $I->expect('to see Forgot Password Link');
        $I->see('Forgot Password', '.btn-link');
        $I->seeLink('Forgot Password', 'forgot');
    }

    public function SuccessfulLoginLogout(AcceptanceTester $I)
    {
        $I->amGoingTo('submit login form with a correct username & password field');
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'pass',
        ]);

        $I->expect('to see the text "Dashboard"');
        $I->see('The Dashboard');

        $I->expect('to see "Logout " and click it to logout');
        $I->click('Log Out');

        $I->expect('to see "You have been successfully logged out."');
        $I->see('You have been successfully logged out.');
    }

    public function LoginWithWrongCredentialsFailure(AcceptanceTester $I)
    {
        $I->amGoingTo('submit login form with incorrect username & password field');
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'xxx',
        ]);

        $I->expect('to see a red error message "Invalid Login"');
        $I->see('Invalid Login');
    }

    public function loginWithEmptyUsernameAndEmptyPasswordFailure(AcceptanceTester $I)
    {
        $I->amGoingTo('submit login form with empty username & empty password field');
        $I->submitForm('#login', [
            'username' => '',
            'password' => '',
        ]);

        $I->expect('to see a red error message "Username Required" & "Password Required"');
        $I->see('Username Required', '.danger');
        $I->see('Password Required', '.danger');

        $I->expect('to see a red error message under the text fields "Username Required" & "Password Required"');
        $I->see('Username Required', '.invalid-feedback');
        $I->see('Password Required', '.invalid-feedback');
    }

    public function loginWithEmptyUsernameAndRandomPassword(AcceptanceTester $I)
    {
        $I->amGoingTo('submit login form with empty username & a random password');
        $I->submitForm('#login', [
            'username' => '',
            'password' => 'RandomPass',
        ]);

        $I->expect('to see a red error message "Username Required"');
        $I->see('Username Required', '.danger');

        $I->expect('to see a red error message under the Username field "Username Required"');
        $I->see('Username Required', '.invalid-feedback');
    }

    public function loginWithEmptyPasswordAndRandomUsername(AcceptanceTester $I)
    {
        $I->amGoingTo('submit login form with empty password & a random username');
        $I->submitForm('#login', [
            'username' => 'Random Username',
            'password' => '',
        ]);

        $I->expect('to see a red error message "Password Required"');
        $I->see('Password Required', '.danger');

        $I->expect('to see a red error message under the Password field "Password Required"');
        $I->see('Password Required', '.invalid-feedback');
    }

    public function clickloginFormLinks(AcceptanceTester $I)
    {
        $I->amGoingTo('Click Register');
        $I->click('Register');

        $I->expect('to go to the Register form');
        $I->seeCurrentUrlEquals('/register');
        $I->see('Register');

        $I->moveBack();// Moves back in history.

        $I->amGoingTo('Click Forgot Password');
        $I->click('Forgot Password');

        $I->expect('to go to the Password Reset form');
        $I->seeCurrentUrlEquals('/forgot');
        $I->see('Password Reset');
    }
}
