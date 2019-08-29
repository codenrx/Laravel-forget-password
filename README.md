# Laravel Forget Password 

This is a Laravel Package For Forget Password System where you send link to user's email for reseting password 

**Please read the full docs , before use !**

# Install

```php 
composer require codenrx/forgetpassword
```

add these line in `providers` array of `config/app.php`

```php
codenrx\forgetpassword\ForgetpasswordServiceProvider::class,
```

then ,
use these command to publish package config file (forgetpassword.php) in `config` folder and email template in `views` folder .

```php
php artisan vendor:publish --provider="codenrx\forgetpassword\ForgetpasswordServiceProvider"
```

open to `.env` file on your project & also setup database & mail connection . Then,

```php
php artisan migrate
```

# Usage

add these line on top of your controller

```php
use codenrx\forgetpassword\Model\Password;
```

Then,

```php
Password::send($email);
```

here ,
`$email` content user email . You can pass `$request->email` or anything .

`Password::send($email)` Helps you to send links to user's email .
Note that its also check , if user have or not !!
if user not found . I mean email is not exixts in database . It's return `failed`. Otherwise its return `success`

### this package only return 2 thing

1. failed
2. success

### Other methods are : 
1. `Password::check($token)` : it's help you to check if token exixts in database or not !! 
2. `Password::updatePassword($password, $token)` 
Here `$password` will be user's new password

# example : 

### Route :

```php
// Forget Password page
Route::get('/forget-password', 'forgetController@index');
Route::get('/forget-password', 'forgetController@send');

// reset password page
Route::get('/reset-password/{token}', 'forgetController@check');
Route::post('/reset-password/{token}', 'forgetController@update');
```

### Controller [ Method ] : 

````
    public function index()
    {
        return view('my-view');
    }

    public function send(Request $request)
    {
        $result = Password::send($request->email);
        if ($result != 'failed') {
            return redirect()->back()->with('success','Reset Password link has been sent to your email');
        } else {
            return "User Not Exixts !!";
        }
    }

    public function check($token)
    {
        $check = Password::check($token);
        if ($check != 'failed') {
            return view('test');
        } else {
            return "Invalid Token !!";
        }
    }

    public function update(Request $request,$token)
    {
    	// No need to hash or bcypt your password ...
        $check = Password::updatePassword($request->password,$token);
        if ($check != 'failed') {
            return redirect()->back()->with('success','Password Changed !!');
        } else {
            return "Invalid Token !!";
        }
    }
````

# Customization

go to `config/forgetpassword.php`.
then you see ,

```php
<?php
return [
    'address' => 'mygmail@gmail.com',
    'name' => 'Reset Your Password :: Mysite.com',
    'url' => 'https:url.com/' // It's Very Important . 
];
```

You can customize your email template also .
You need to go `/resources/views/vendor/email`.

---

### For more Links

- [GitHub](https://github.com/IANirab)
- [Facebook](https://web.facebook.com/istiaq.nirab.1)
- [Medium](https://medium.com/@nirab)
- [Website](https://codenrx.com)

**Enjoy!**