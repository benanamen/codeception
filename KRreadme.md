### Third Party Reporting 
https://app.testomat.io/users/sign_up

---

### Commands
https://codeception.com/docs/reference/Commands

---

### Create New Cest
```shell
php vendor/bin/codecept generate:cest Acceptance admin/Settings
```
---

### Run All Tests
```shell
php vendor/bin/codecept run
```

```shell
php vendor/bin/codecept run --steps
```

```shell
php vendor/bin/codecept run --html
```

```shell
php vendor/bin/codecept run Acceptance  -v --html
```

---

### Run Specific Tests

* List Users
```shell
php vendor/bin/codecept run Acceptance Admin:ListUsersCest --html
```

* Add User
```shell
php vendor/bin/codecept run Acceptance Admin:AddUserCest --html
```

* Change Password
```shell
php vendor/bin/codecept run Acceptance Admin:ChangePasswordCest --html
```

* Login
```shell
php vendor/bin/codecept run Acceptance LoginCest --html
```

* Forgot Password
```shell
php vendor/bin/codecept run Acceptance ForgotPasswordCest --html
```

* Dev Testing
```shell
php vendor/bin/codecept run Acceptance DevTestingCest --html
```

---

### Run Specific Method

* Login Empty Field Method
```shell
php vendor/bin/codecept run Acceptance LoginCest:loginEmptyFields
```

### Delete (Clean) everything in _output directory
```shell
php vendor/bin/codecept clean
```

### Generate Scenarios - Output ins Support/Data/scenarios/Acceptance
```shell
php vendor/bin/codecept g:scenarios Acceptance
```

