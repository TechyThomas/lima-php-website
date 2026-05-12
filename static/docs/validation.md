# Validation

### Contents

- [Creating a validator](#creating-a-validator)
- [Rule format](#rule-format)
- [Supported types](#supported-types)
- [Supported options](#supported-options)
- [Matching fields](#matching-fields)
- [Returning validation errors](#returning-validation-errors)
- [A complete controller example](#a-complete-controller-example)

<a id="creating-a-validator"></a>
### Creating a validator

Lima includes a small input validator for request data. To use it, extend `Lima\Requests\Validator`, define your rules, and pass the input into the constructor.

```php
use Lima\Requests\Validator;

class ContactValidator extends Validator
{
    protected $rules = [
        'name' => 'text|required,min:2,max:80',
        'email' => 'email|required',
        'message' => 'text|required,min:10',
    ];
}
```

Then use the validator from your controller.

```php
$validator = new ContactValidator($_POST);
$input = $validator->getInput();
$errors = $validator->getErrors();

if (!empty($errors)) {
    $this->view('contact', [
        'errors' => $errors,
    ]);
    return;
}
```

`getInput()` returns the validated and sanitized input. `getErrors()` returns an array of validation errors keyed by input name.

<a id="rule-format"></a>
### Rule format

Rules use the following format:

```text
type|option,option:value
```

The type comes first. Additional options are added after the pipe and separated with commas.

```php
protected $rules = [
    'username' => 'text|required,min:3,max:30',
];
```

<a id="supported-types"></a>
### Supported types

| Type          | Description                                      |
| ------------- | ------------------------------------------------ |
| text, string  | Validates a string and escapes HTML characters   |
| int           | Validates numeric input and returns an integer   |
| float         | Validates a float value                          |
| array         | Validates an array                               |
| email         | Validates and sanitizes an email address         |

<a id="supported-options"></a>
### Supported options

| Option        | Description                                                        |
| ------------- | ------------------------------------------------------------------ |
| required      | The input must not be empty                                        |
| min           | Minimum length for text, minimum value for numbers, or item count for arrays |
| max           | Maximum length for text, maximum value for numbers, or item count for arrays |
| match         | The input must match another input value                           |

<a id="matching-fields"></a>
### Matching fields

The `match` option is useful for confirmation fields.

```php
protected $rules = [
    'password' => 'text|required,min:8',
    'confirm_password' => 'text|required,match:password',
];
```

If the values don't match, an error will be added to the confirmation field.

<a id="returning-validation-errors"></a>
### Returning validation errors

Errors are plain strings, which makes them easy to pass into a template.

```php
if (!empty($errors['email'])) {
    echo '<p>' . $errors['email'] . '</p>';
}
```

For larger applications, you may want to wrap validation errors in your own form helper so every form renders messages consistently.

<a id="a-complete-controller-example"></a>
### A complete controller example

```php
class Contact extends \Lima\Core\Controller
{
    public function submit(): void
    {
        $validator = new ContactValidator($_POST);
        $input = $validator->getInput();
        $errors = $validator->getErrors();

        if (!empty($errors)) {
            $this->view('contact/index', [
                'errors' => $errors,
                'input' => $_POST,
            ]);
            return;
        }

        // Use $input here to send an email, create a model, or call a service.
        $this->view('contact/success');
    }
}
```

### What to read next

Validation usually sits between your [Controllers and Views](/docs/controllers-and-views) and [Models and Database](/docs/models-and-database), so those are the best places to go next.
