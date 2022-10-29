<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        $I->seeInTitle('Perfect App Starter');
        $I->seeCurrentUrlEquals('/login');

        $I->expect('to see a H3 title');
        $I->see('Login', 'H3');

        $I->expect('to see a Username Label');
        //TODO: Find out how to do isee form label xx

        $I->expect('to see a Password Label');
        //TODO: Find out how to do isee form label xx


        /*
         * Check Username Components
         */
        $I->expect('to see a Username Form Field');
        $I->seeElement('input', ['name' => 'username']);
        $I->expect('to see a required in code for Username Form Field'); //TODO: Find out how to see required in code


        /*
         * Check Password Components
         * */
        $I->expect('to see a Password Form Field');
        $I->seeElement('input', ['name' => 'password']);

        /*
         * Check Links
         */

        $I->expect('Login Button Link');
        $I->see('Login', '.btn-primary');

        $I->expect('Register Button Link');
        $I->see('Register', '.btn-secondary');

        $I->expect('Password Link');
        $I->see('Forgot Password', '.btn-link');
    }

    public function loginLogoutWorks(AcceptanceTester $I)
    {
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'pass',
        ]);
        $I->see('The Dashboard');
        $I->click('Log Out');
        $I->see('You have been successfully logged out.');
    }

    public function loginInvalidFails(AcceptanceTester $I)
    {
        $I->amGoingTo('submit login form with incorrect username & password field');
        $I->expect('to see a red error message "Invalid Login"');
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'xxx',
        ]);
        $I->see('Invalid Login');
    }

    public function loginAllEmptyFields(AcceptanceTester $I)
    {
        $I->submitForm('#login', [
            'username' => '',
            'password' => '',
        ]);
        $I->amGoingTo('submit login form with empty username & password field');
        $I->expect('to see a red error message "Username Required" & "Password Required"');
        $I->see('Username Required', '.danger');
        $I->see('Password Required', '.danger');

        $I->expect('to see a red error message under the text fields "Username Required" & "Password Required"');
        $I->see('Username Required', '.invalid-feedback');
        $I->see('Password Required', '.invalid-feedback');
    }

    public function loginEmptyUsername(AcceptanceTester $I)
    {
        /* Testing Blank Username */
        $I->submitForm('#login', [
            'username' => '',
            'password' => 'RandomPass',
        ]);
        $I->amGoingTo('submit login form with empty username & random password');
        $I->expect('to see a red error message "Username Required"');
        $I->see('Username Required', '.danger');

        $I->expect('to see a red error message under the Username field "Username Required"');
        $I->see('Username Required', '.invalid-feedback');
    }

    public function loginEmptyPassword(AcceptanceTester $I)
    {
        /* Testing Blank Password */
        $I->amGoingTo('submit login form with empty password & random username');
        $I->submitForm('#login', [
            'username' => 'Random Username',
            'password' => '',
        ]);

        $I->expect('to see a red error message "Password Required"');
        $I->see('Password Required', '.danger');

        $I->expect('to see a red error message under the Password field "Password Required"');
        $I->see('Password Required', '.invalid-feedback');
    }

    public function loginFormLinks(AcceptanceTester $I)
    {


        $I->amOnPage('/login');
        $I->click('Register');
        $I->expect('to go to the Register form');
        $I->seeCurrentUrlEquals('/register');
        $I->see('Register');

        $I->moveBack();// Moves back in history.

        $I->seeLink('Forgot Password', 'forgot');
        $I->click('Forgot Password');
        $I->expect('to go to the Password Reset form');
        $I->seeCurrentUrlEquals('/forgot');
        $I->see('Password Reset');
    }
}
