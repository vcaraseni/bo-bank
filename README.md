

## BO Bank

This is very simple example of bank core functionality written using laravel framework 

### How to test the functionality:
- run php artisan migrate
- php artisan serve

Now you can call next available list of routes:

- POST /api/money/deposit/user/{user} - Deposit money into a user’s wallet.
Example:

Payload:
```angular2html
{
    "amount": 150.00
}
```
Success response:
```angular2html
{
    "data": {
        "message": "Deposit successful",
        "balance": 150.00
    }
}
```

- POST /api/money/transfer - Transfer money from one user’s wallet to another.
  Example:

Payload:
```angular2html
{
    "from_user_id": 1,
    "to_user_id": 2,
    "amount": 100.00
}
```
Success response:
```angular2html
{
    "data": {
        "message": "Transfer completed"
    }
}
```

- PUT /api/users/{user} - Update user’s name, email, and age.

Payload:
```angular2html
{
    "name": "Donald Trump",
    "email": "trump@email.com",
    "age": 79
}
```

Success response:
```angular2html
{
    "data": {
        "id": 2,
        "name": "Donald Trump",
        "email": "trump@email.com",
        "age": 79,
        "email_verified_at": null,
        "created_at": "2025-07-16T20:59:29.000000Z",
        "updated_at": "2025-07-16T21:12:44.000000Z"
    }
}
```

## Architecture & Code Structure todo list:
- Extract business logic into dedicated service classes (MoneyService, UserService)
- Create a TransactionController to view transaction history
- Automatically create a wallet when a user is created (observers or events)
- Use DTOs (Data Transfer Objects) to decouple request logic from controller logic
- TESTS!
