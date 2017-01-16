# clean-code-php

## Table of Contents
  1. [Introduction](#introduction)
  2. [Variables](#variables)

## Introduction

Software engineering principles, from Robert C. Martin's book
[*Clean Code*](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882),
adapted for PHP. This is not a style guide. It's a guide to producing
readable, reusable, and refactorable software in PHP.

Not every principle herein has to be strictly followed, and even fewer will be universally agreed upon. These are guidelines and nothing more, but they are ones codified over many years of collective experience by the authors of *Clean Code*.

Inspired from [clean-code-javascript](https://github.com/ryanmcdermott/clean-code-javascript)

## **Variables**
### Use meaningful and pronounceable variable names

**Bad:**
```php
$ymdstr = $moment->format('y-m-d');
```

**Good**:
```javascript
$currentDate = $moment->format('y-m-d');
```
**[⬆ back to top](#table-of-contents)**

### Use the same vocabulary for the same type of variable

**Bad:**
```php
getUserInfo();
getClientData();
getCustomerRecord();
```

**Good**:
```php
getUser();
```
**[⬆ back to top](#table-of-contents)**

### Use searchable names
We will read more code than we will ever write. It's important that the code we do write is readable and searchable. By *not* naming variables that end up being meaningful for understanding our program, we hurt our readers.
Make your names searchable.

**Bad:**
```php
// What the heck is 86400 for?
addExpireAt(86400);

```

**Good**:
```php
// Declare them as capitalized `const` globals.
interface DateGlobal {
  const SECONDS_IN_A_DAY = 86400;
}

addExpireAt(DateGlobal::SECONDS_IN_A_DAY);
```
**[⬆ back to top](#table-of-contents)**


### Use explanatory variables
**Bad:**
```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,\\]+[,\\\s]+(.+?)\s*(\d{5})?$/';
preg_match($cityZipCodeRegex, $address, $matches);
saveCityZipCode($matches[1], $matches[2]);
```

**Good**:
```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,\\]+[,\\\s]+(.+?)\s*(\d{5})?$/';
preg_match($cityZipCodeRegex, $address, $matches);
list(, $city, $zipCode) = $matchers;
saveCityZipCode(city, zipCode);
```
**[⬆ back to top](#table-of-contents)**

### Avoid Mental Mapping
Explicit is better than implicit.

**Bad:**
```php
$l = ['Austin', 'New York', 'San Francisco'];
foreach($i=0; $i<count($l); $i++) {
  oStuff();
  doSomeOtherStuff();
  // ...
  // ...
  // ...
  // Wait, what is `l` for again?
  dispatch(l);
}
```

**Good**:
```php
$locations = ['Austin', 'New York', 'San Francisco'];
foreach($i=0; $i<count($locations); $i++) {
  $location = $locations[$i];
  
  doStuff();
  doSomeOtherStuff();
  // ...
  // ...
  // ...
  dispatch(location);
});
```
**[⬆ back to top](#table-of-contents)**


### Don't add unneeded context
If your class/object name tells you something, don't repeat that in your
variable name.

**Bad:**
```php
$car = [
  'carMake'  => 'Honda',
  'carModel' => 'Accord',
  'carColor' => 'Blue',
];

function paintCar(&$car) {
  $car['carColor'] = 'Red';
}
```

**Good**:
```php
$car = [
  'make'  => 'Honda',
  'model' => 'Accord',
  'color' => 'Blue',
];

function paintCar(&$car) {
  $car['color'] = 'Red';
}
```
**[⬆ back to top](#table-of-contents)**

### Use default arguments instead of short circuiting or conditionals

**Bad:**
```php
function createMicrobrewery($name = null) {
  $breweryName = $name ?: 'Hipster Brew Co.';
  // ...
}

```

**Good**:
```php
function createMicrobrewery($breweryName = 'Hipster Brew Co.') {
  // ...
}

```
**[⬆ back to top](#table-of-contents)**


