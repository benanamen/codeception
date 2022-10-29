<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class RegisterCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('Register');
        $I->seeInTitle('Perfect App Starter');
        $I->seeCurrentUrlEquals('/register');
        $I->see('Register', 'H3');


        $I->seeElement('input', ['name' => 'first_name']);
        $I->seeElement('input', ['name' => 'last_name']);
        $I->seeElement('input', ['name' => 'email']);
        $I->seeElement('input', ['name' => 'username']);
        $I->seeElement('input', ['name' => 'password']);
        $I->seeElement('input', ['name' => 'password_confirm']);

        $I->see('Submit', '.btn-primary');



    }

    public function registerUser(AcceptanceTester $I)
    {
        /* !IMPORTANT! This test will fail if DB data generated from this test is not deleted */
        $I->submitForm('#register', [
            'first_name' => 'Calbin',
            'last_name' => 'Bigs',
            'email' => 'calvin99@example.com',
            'username' => 'calvin99',
            'password' => 'calvin99',
            'password_confirm' => 'calvin99',
        ]);
        $I->see('Email confirmation instructions have been sent. Check your spam folder.');
    }

    public function registerUserDuplicateUserEmailFail(AcceptanceTester $I)
    {
        $I->submitForm('#register', [
            'first_name' => 'Calbin',
            'last_name' => 'Bigs',
            'email' => 'calvin99@example.com',
            'username' => 'calvin99',
            'password' => 'calvin99',
            'password_confirm' => 'calvin99',
        ]);
        $I->see('Registration Failed');
        $I->see('Invalid Username or Email');
    }

    public function registerBlankFields(AcceptanceTester $I)
    {
        /* TODO: Add All variations of emtpy fields*/
    }
}
