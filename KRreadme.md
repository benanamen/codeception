[Run It](command:php vendor/bin/codecept run)

### Third Party Reporting 
https://app.testomat.io/users/sign_up

### Commands
https://codeception.com/docs/reference/Commands

### Create New Cest
```shell
php vendor/bin/codecept generate:cest Acceptance DevTesting
```

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

### Run Specific Tests

```shell
php vendor/bin/codecept run Acceptance LoginCest --html
```

```shell
php vendor/bin/codecept run Acceptance ForgotPasswordCest --html
```

```shell
php vendor/bin/codecept run Acceptance DevTestingCest --html
```





### Run Specific Method
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

