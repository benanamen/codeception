<?php


namespace Tests\Acceptance\admin;

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
    }

    /**
     * Currently, test will pass if data does not exist in DB or fail if it does
     *
     * @param  AcceptanceTester  $I
     *
     * @return void
     */
    public function AddUser(AcceptanceTester $I)
    {
        $I->click('Add User');
        $I->seeCurrentURLEquals('/add-user');
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
}
