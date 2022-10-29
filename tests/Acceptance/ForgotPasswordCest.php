<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class ForgotPasswordCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('Forgot Password');
        $I->seeInTitle('Perfect App Starter');
        $I->seeCurrentUrlEquals('/forgot');
        $I->see('Password Reset', 'H3');
        $I->seeElement('input', ['name' => 'email']);


        //TODO: Find out how to do isee form label xx
        $I->see('Reset', '.btn-primary');
    }

    public function forgotPassword(AcceptanceTester $I)
    {
        $I->submitForm('#forgot', [
            'email' => 'calvin99@example.com',
        ]);
        $I->see('If your email is in our system you will receive reset instructions.');
    }

    public function forgotPasswordBlankForm(AcceptanceTester $I)
    {
        $I->amGoingTo('submit forgot password form with empty email field');
        $I->click('Reset');
        $I->expect('to see the error message "Email Required"');
        $I->see('Email Required');
    }
}
