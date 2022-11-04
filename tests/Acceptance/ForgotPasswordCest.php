<?php


namespace Tests\Acceptance;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class ForgotPasswordCest
{
    public function whatISee(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->click('Forgot Password');
        $I->seeInTitle('Perfect App Starter');

        $I->expect('to see a Url /forgot');
        $I->seeCurrentUrlEquals('/forgot');

        $I->expect('to see a H3 title that says "Password Reset"');
        $I->see('Password Reset', 'H3');

        $I->expect('to see a label that says "Email');
        $I->seeElement(Locator::contains('label', 'Email'));
        $I->seeElement('label', ['for' => 'inputResetPasswordEmail']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'email']);

        $I->expect('to see the text under the input that says "Password reset instructions will be sent to this email address"');
        $I->seeElement(Locator::contains('span', 'Password reset instructions will be sent to this email address'));

        $I->expect('to see a "Reset" button"');
        $I->see('Reset', '.btn-primary');
    }

    public function resetPassword(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot');

        $I->amGoingTo('submit a properly formatted email address');
        $I->submitForm('#forgot', ['email' => 'calvin99@example.com',]);

        $I->expect('to see the Url be /login');
        $I->seeCurrentUrlEquals('/login');

        $I->expect('to see a message that says "If your email is in our system you will receive reset instructions."');
        $I->see('If your email is in our system you will receive reset instructions.');

        $I->expect('to get an email with a password reset link if the submitted email is in the DB');
    }

    public function submitResetPasswordFormEmptyField(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot');

        $I->amGoingTo('submit reset password form with empty email field');
        $I->click('Reset');

        $I->expect('to see the error message "Email Required"');
        $I->see('Email Required');

        $I->expect('to see the error message "Email Required under the form field"');
        $I->seeElement(Locator::contains('span', 'Email Required'));
    }
}
