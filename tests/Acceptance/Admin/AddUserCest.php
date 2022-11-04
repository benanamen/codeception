<?php


namespace Tests\Acceptance\admin;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class AddUserCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('username', 'user');
        $I->fillField('password', 'pass');
        $I->click('Login');
        $I->seeCurrentURLEquals('/dashboard');
        $I->click('Add User');
    }

    public function whatISee(AcceptanceTester $I)
    {
        $I->seeInTitle('Perfect App Starter');

        $I->expect('to see a Url "/add-user"');
        $I->seeCurrentUrlEquals('/add-user');

        $I->expect('to see a H3 title that says "Add User"');
        $I->see('Add User', 'H3');

        /*
        * Check Add User Components
        * */

        /* Active Field Test */
        $I->expect('to see a label that says "Active"');
        $I->seeElement(Locator::contains('label', 'Active'));
        $I->seeElement('label', ['for' => 'is_active']);

        $I->expect('to see a a form input type checkbox');
        $I->seeElement('input', ['name' => 'is_active']);


        /* Verify Email Field Test */
        $I->expect('to see a label that says "Verify Email"');
        $I->seeElement(Locator::contains('label', 'Verify Email'));
        $I->seeElement('label', ['for' => 'is_email_verified']);

        $I->expect('to see a form input type checkbox');
        $I->seeElement('input', ['name' => 'is_email_verified']);


        /* Role Field Test */
        $I->expect('to see a label that says "Select Role"');
        $I->seeElement(Locator::contains('label', 'Select Role'));
        $I->seeElement('label', ['for' => 'role_id']);

        $I->expect('to see a Select form input');
        $I->seeElement('select', ['name' => 'role_id']);


        /* Username Field Test */
        $I->expect('to see a label that says "Username"');
        $I->seeElement(Locator::contains('label', 'Username'));
        $I->seeElement('label', ['for' => 'username']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'username']);


        /* Password Field Test */
        $I->expect('to see a label that says "Password"');
        $I->seeElement(Locator::contains('label', 'Password'));
        $I->seeElement('label', ['for' => 'password']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'password']);

        /* Email Field Test */
        $I->expect('to see a label that says "Email"');
        $I->seeElement(Locator::contains('label', 'Email'));
        $I->seeElement('label', ['for' => 'email']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'email']);


        /* First Name Field Test */
        $I->expect('to see a label that says "First Name"');
        $I->seeElement(Locator::contains('label', 'First Name'));
        $I->seeElement('label', ['for' => 'first_name']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'first_name']);


        /* Last Name Field Test */
        $I->expect('to see a label that says "Last Name');
        $I->seeElement(Locator::contains('label', 'Last Name'));
        $I->seeElement('label', ['for' => 'last_name']);

        $I->expect('to see a a form input');
        $I->seeElement('input', ['name' => 'last_name']);

        /*
           * Check Links
           */
        $I->expect('to see a "Save" Button Link');
        $I->see('Save', '.btn-primary');

        $I->expect('to see a "Save & New" Button Link');
        $I->see('Save & New', '.btn-primary');
    }

        /**
     * Currently, test will pass if data does not exist in DB or fail if it does
     *
     * @param  AcceptanceTester  $I
     *
     * @return void
     */
    public function addUser(AcceptanceTester $I)
    {
        $I->checkOption('is_active');
        $I->checkOption('is_email_verified');
        $I->selectOption('role_id', '1');

        $I->submitForm('#user', [
            'username' => 'SuperUser',
            'password' => 'pass',
            'email' => 'superuser@example.com',
            'first_name' => 'Sam',
            'last_name' => 'Slam',
        ]);

        $I->dontSee('SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry');
        $I->seeCurrentURLEquals('/list-users');
        $I->see('Record Inserted', '.alert-success');
    }

    public function blankFields(AcceptanceTester $I)
    {
        /* Remove Required from HTML form elements for visual testing */

        $I->click('Save');

        $I->expect('to see a red error message "Role Id Required", "First Name Required", "Last Name Required", "Email Required", "Username Required" & "Password Required"');

        $I->see('Role Id Required', '.danger');
        $I->see('First Name Required', '.danger');

        $I->see('Last Name Required', '.danger');
        $I->see('Email Required', '.danger');

        $I->see('Username Required', '.danger');
        $I->see('Password Required', '.danger');

        $I->expect('to see a red error message under the text fields "Role Id Required", "First Name Required", "Last Name Required", "Email Required", "Username Required" & "Password Required"');

        $I->see('Role ID Required', '.invalid-feedback');

        $I->see('Username Required', '.invalid-feedback');
        $I->see('Password Required', '.invalid-feedback');

        $I->see('Email  Required', '.invalid-feedback');
        $I->see('First NAme Required', '.invalid-feedback');

        $I->see('Last Name Required', '.invalid-feedback');
    }

    public function addUserInvalidEmail(AcceptanceTester $I)
    {
        $I->click('Add User');
        $I->seeCurrentURLEquals('/add-user');
        $I->checkOption('is_active');
        $I->checkOption('is_email_verified');
        $I->selectOption('role_id', '1');

        $I->submitForm('#user', [
            'username' => 'SuperUser',
            'password' => 'pass',
            'email' => 'superuserATexample.com',
            'first_name' => 'Sam',
            'last_name' => 'Slam',
        ]);

        $I->dontSee('SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry');

        $I->expect('to see a red error message "Enter A Valid Email"');
        $I->see('Enter A Valid Email', '.danger');

        $I->expect('to see a red error message under the Email text field "Enter A Valid Email"');
        $I->see('Enter A Valid Email', '.invalid-feedback');
    }
}
