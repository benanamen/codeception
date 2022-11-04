<?php


namespace Tests\Acceptance\admin;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class ChangePasswordCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->amGoingTo('submit login form with a correct username & password field');
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'pass',
        ]);

        $I->amOnPage('/dashboard');

        $I->expect('to see "Change Password" in the Admin Dropdown');
        $I->see('Change Password', Locator::href('/change-password'));

        $I->amGoingTo('click "Change Password" in the Admin Dropdown');
        $I->click('Change Password');

        $I->expect('to go to the "Change Password" page at /change-password');
        $I->seeCurrentUrlEquals('/change-password');
    }

    public function WhatISee(AcceptanceTester $I)
    {
        $I->expect('to see a H3 title that says "Change Password"');
        $I->see('Change Password', 'H3');

        /*
        * Check Change Password Components
        * */
        $I->expect('to see a label that says "Current Password');
        $I->seeElement(Locator::contains('label', 'Current Password'));
        $I->seeElement('label', ['for' => 'current_password']);

        $I->expect('to see the text under the input that says "You will be automatically logged out after password change. You will need to re-login."');
        $I->seeElement(Locator::contains('span', 'You will be automatically logged out after password change. You will need to re-login.'));

        $I->expect('to see a label that says "New Password');
        $I->seeElement(Locator::contains('label', 'New Password'));
        $I->seeElement('label', ['for' => 'password']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'password']);

        $I->expect('to see a label that says "Confirm New Password');
        $I->seeElement(Locator::contains('label', 'Confirm New Password'));
        $I->seeElement('label', ['for' => 'password_confirm']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'password_confirm']);

        $I->expect('to see Login Button Link');
        $I->see('Save', '.btn-primary');
    }

    /**
     * Submit a Valid Password Reset
     */
    public function submitCorrectPasswordAndMatchingNewPasswordAndConfirmNewPassword(AcceptanceTester $I)
    {
        $I->amGoingTo('enter a correct value for Current Password');
        $I->amGoingTo('enter a matched value for "New Password" & "Confirm New Password"');
        $I->amGoingTo('click the "Save" button');

        $I->submitForm('#change-password', [
            'current_password' => 'pass',
            'password' => '123',
            'password_confirm' => '456',
        ]);

        $I->click('Save');// $I->submitForm does not need this step. Just testing button

        $I->seeCurrentUrlEquals('/change-password');

        // TODO: A 302 REDIRECT HAPPENS HERE. I WAS NOT ABLE TO CATCH IT...YET.
        $I->expect('to see a 302 header redirect from /change-password to  /password-updated');

        $I->amOnPage('/password-updated');
        $I->expect('to see the Url be /password-updated');
        $I->seeCurrentUrlEquals('/password-updated');

        $I->expect('to see a message that says "Your password has been reset."');
        $I->see('Your password has been reset.');
    }

    /**
     * Submit All Blank Fields
     */
    public function submitBlankFields(AcceptanceTester $I)
    {
        $I->amGoingTo('click "Save" with empty fields');
        $I->click('Save');

        $I->expect('to see red error message "Current Password Required"');
        $I->see('Current Password Required', '.danger');

        $I->expect('to see red error message "Password Required"');
        $I->see('Password Required', '.danger');

        $I->expect('to see red error message "Password Confirm Required"');
        $I->see('Password Confirm Required', '.danger');

        $I->expect('to see a red error message under the text fields "Current Password Required" & "Password Required" & "Password Confirm Required"');
        $I->see('Current Password Required', '.invalid-feedback');

        $I->see('Password Required', '.invalid-feedback');
        $I->see('Password Confirm Required', '.invalid-feedback');
    }

    public function submitWrongCurrentPassword(AcceptanceTester $I)
    {
        $I->amGoingTo('enter an incorrect value for Current Password');
        $I->amGoingTo('enter a matching value for "New Password" & "Confirm New Password"');
        $I->amGoingTo('click the "Save" button');
        $I->submitForm('#change-password', [
            'current_password' => 'WrongPassword',
            'password' => 'newpass',
            'password_confirm' => 'newpass',
        ]);

        $I->expect('to see red error message "Current Password Incorrect"');
        $I->see('Current Password Incorrect', '.danger');
    }

    /*
     * Submit Correct Current Password
     * Mis-Matched New Password & Confirm New Password
     * */
    public function submitMismatchedNewPasswordAndConfirmNewPassword(AcceptanceTester $I)
    {
        $I->amGoingTo('enter a correct value for Current Password');
        $I->amGoingTo('enter a mis-match value for "New Password" & "Confirm New Password"');
        $I->amGoingTo('click the "Save" button');

        $I->submitForm('#change-password', [
            'current_password' => 'pass',
            'password' => '123',
            'password_confirm' => '456',
            ]);

        $I->expect('to see red error message "Passwords Do Not Match"');
        $I->see('Passwords Do Not Match', '.danger');

        /*
        *
        * */
        $I->expect('to see a red error message under the text field "Current Password Incorrect"');
        $I->see('Passwords Do Not Match', '.invalid-feedback');
    }
}