<?php


namespace Tests\Acceptance;

use Codeception\Util\Locator;
use Codeception\Attribute\Skip;
use Tests\Support\AcceptanceTester;

class RegisterCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/register');
    }

    public function whatISee(AcceptanceTester $I)
    {
        $I->seeInTitle('Perfect App Starter');

        $I->expect('to see a Url "/register"');
        $I->seeCurrentUrlEquals('/register');

        $I->expect('to see a H3 title that says "Register"');
        $I->see('Register', 'H3');

        /*
         *
         * */
        $I->expect('to see a label that says "First Name');
        $I->seeElement(Locator::contains('label', 'First Name'));
        $I->seeElement('label', ['for' => 'first_name']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'first_name']);

        /*
         *
         * */
        $I->expect('to see a label that says "Last Name');
        $I->seeElement(Locator::contains('label', 'Last Name'));
        $I->seeElement('label', ['for' => 'last_name']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'last_name']);

        /*
        *
        * */
        $I->expect('to see a label that says "Email');
        $I->seeElement(Locator::contains('label', 'Email'));
        $I->seeElement('label', ['for' => 'email']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'email']);

        /*
        *
        * */
        $I->expect('to see a label that says "Username');
        $I->seeElement(Locator::contains('label', 'Username'));
        $I->seeElement('label', ['for' => 'username']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'username']);

        /*
        *
        * */
        $I->expect('to see a label that says "Password');
        $I->seeElement(Locator::contains('label', 'Password'));
        $I->seeElement('label', ['for' => 'password']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'password']);

        /*
        *
        * */
        $I->expect('to see a label that says "Confirm Password');
        $I->seeElement(Locator::contains('label', 'Confirm Password'));
        $I->seeElement('label', ['for' => 'password_confirm']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'password_confirm']);

        /*
        *
        * */
        $I->expect('to see Submit Button Link');
        $I->see('Submit', '.btn-primary');
    }

    #[Skip('Test will fail if there is email or username already in the DB')]
    public function registerNewUser(AcceptanceTester $I)
    {
        /* !IMPORTANT! This test will fail if DB email or username matches test data. Duplicate data not allowed */
        $I->amGoingTo('submit register form with correct data');
        $I->expect('data to be entered into database');
        $I->expect('to see a red error message "Registration Failed" & "Invalid Username or Email" if the username or password is already in the db');
        $I->submitForm('#register', [
            'first_name' => 'Calbin',
            'last_name' => 'Bigs',
            'email' => 'calvin99@example.com',
            'username' => 'calvin99',
            'password' => 'calvin99',
            'password_confirm' => 'calvin99',
        ]);

        $I->expect('to see the message "Email confirmation instructions have been sent. Check your spam folder."');
        $I->see('Email confirmation instructions have been sent. Check your spam folder.');
        $I->expect('email sent to registered email with link to activate account');
    }

    public function registerUserWithDuplicateEmailOrUsernameFailure(AcceptanceTester $I)
    {
        $I->amGoingTo('submit register form with duplicate email and duplicate username data');
        $I->submitForm('#register', [
            'first_name' => 'Calbin',
            'last_name' => 'Bigs',
            'email' => 'calvin99@example.com',
            'username' => 'calvin99',
            'password' => 'calvin99',
            'password_confirm' => 'calvin99',
        ]);

        $I->expect('to see a red error message "Registration Failed" & "Invalid Username or Email"');
        $I->see('Registration Failed');
        $I->see('Invalid Username or Email');
    }

    public function registerInvalidEmailAddress(AcceptanceTester $I)
    {
        $I->amGoingTo('submit register form with an invalid email');
        $I->submitForm('#register', [
            'email' => 'emailMissingAtSymbol#example.com'
        ]);
        $I->expect('to see red error message "Enter A Valid Email"');
        $I->see('Enter A Valid Email', '.danger');

        $I->expect('to see a red error message under the Email text field "Enter A Valid Email"');
        $I->see('Enter A Valid Email', '.invalid-feedback');
    }

    public function registerMismatchedPaswordAndPasswordConfirm(AcceptanceTester $I)
    {
        $I->amGoingTo('submit register form with mis-matched password & password confirm');
        $I->submitForm('#register', [
            'password' => '123',
            'password_confirm' => '456'
        ]);

        $I->expect('to see red error message "Enter A Valid Email"');
        $I->see('Passwords Do Not Match', '.danger');

        $I->expect('to see a red error message under the Email text field "Enter A Valid Email"');
        $I->see('Passwords Do Not Match', '.invalid-feedback');
    }

    public function registerBlankFields(AcceptanceTester $I)
    {
        $I->amGoingTo('submit register form with all the fields empty');
        $I->click('Submit');

        $I->expect('to see red error message "First Name Required"');
        $I->see('First Name Required', '.danger');

        $I->expect('to see red error message "Last Name Required"');
        $I->see('Last Name Required', '.danger');

        $I->expect('to see red error message "Email Required"');
        $I->see('Email Required', '.danger');

        $I->expect('to see red error message "Username Required"');
        $I->see('Username Required', '.danger');

        $I->expect('to see red error message "Password Required"');
        $I->see('Password Required', '.danger');

        $I->expect('to see red error message "Password Confirm Required"');
        $I->see('Password Confirm Required', '.danger');

        /*
        *
        * */
        $I->expect('to see a red error message under the text fields "Username Required" & "Password Required"');
        $I->see('First Name Required', '.invalid-feedback');
        $I->see('Last Name Required', '.invalid-feedback');

        $I->see('Email Required', '.invalid-feedback');
        $I->see('Username Required', '.invalid-feedback');

        $I->see('Password Required', '.invalid-feedback');
        $I->see('Password Confirm Required', '.invalid-feedback');

    }
}
