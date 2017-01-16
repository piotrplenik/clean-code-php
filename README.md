# clean-code-php

## Table of Contents
  1. [Introduction](#introduction)
  2. [Variables](#variables)
  3. [Functions](#functions)

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
## **Functions**
### Function arguments (2 or fewer ideally)
Limiting the amount of function parameters is incredibly important because it makes testing your function easier. Having more than three leads to a combinatorial explosion where you have to test tons of different cases with each separate argument.

Zero arguments is the ideal case. One or two arguments is ok, and three should be avoided. Anything more than that should be consolidated. Usually, if you have more than two arguments then your function is trying to do too much. In cases where it's not, most of the time a higher-level object will suffice as an argument.

**Bad:**
```php
function createMenu($title, $body, $buttonText, $cancellable) {
  // ...
}
```

**Good**:
```php
class menuConfig() {
  public $title;
  public $body;
  public $buttonText;
  public $cancellable = false;
}

$config = new MenuConfig();
$config->title = 'Foo';
$config->body = 'Bar';
$config->buttonText = 'Baz';
$config->cancellable = true;

function createMenu(MenuConfig $config) {
  // ...
}

```
**[⬆ back to top](#table-of-contents)**


### Functions should do one thing
This is by far the most important rule in software engineering. When functions do more than one thing, they are harder to compose, test, and reason about. When you can isolate a function to just one action, they can be refactored easily and your code will read much cleaner. If you take nothing else away from this guide other than this, you'll be ahead of many developers.

**Bad:**
```php
function emailClients($clients) {
  foreach ($clients as $client) {
    $clientRecord = $db->find($client);
    if($clientRecord->isActive()) {
       email($client);
    }
  }
}
```

**Good**:
```php
function emailClients($clients) {
  $activeClients = activeClients($clients);
  array_walk($activeClients, 'email');
}

function activeClients($clients) {
  return array_filter($clients, 'isClientActive');
}

function isClientActive($client) {
  $clientRecord = $db->find($client);
  return $clientRecord->isActive();
}
```
**[⬆ back to top](#table-of-contents)**

### Function names should say what they do

**Bad:**
```php
function addToDate($date, $month) {
  // ...
}

$date = new \DateTime();

// It's hard to to tell from the function name what is added
addToDate($date, 1);
```

**Good**:
```php
function addMonthToDate($month, $date) {
  // ...
}

$date = new \DateTime();
addMonthToDate(1, $date);
```
**[⬆ back to top](#table-of-contents)**

### Functions should only be one level of abstraction
When you have more than one level of abstraction your function is usually
doing too much. Splitting up functions leads to reusability and easier
testing.

**Bad:**
```php
function parseBetterJSAlternative($code) {
  $regexes = [
    // ...
  ];

  $statements = split(' ', $code);
  $tokens = [];
  foreach($regexes as $regex) {
    foreach($statements as $statement) {
      // ...
    }
  }
  
  $ast = [];
  foreach($tokens as $token) {
     // lex...
  }

  foreach($ast as $node) {
   // parse...
  }
}
```

**Good**:
```php
function tokenize($code) {
  $regexes = [
    // ...
  ];

  $statements = split(' ', $code);
  $tokens = [];
  foreach($regexes as $regex) {
    foreach($statements as $statement) {
      $tokens[] = /* ... */;
    });
  });

  return tokens;
}

function lexer($tokens) {
  $ast = [];
  foreach($tokens as $token) {
    $ast[] = /* ... */;
  });

  return ast;
}

function parseBetterJSAlternative($code) {
  $tokens = tokenize($code);
  $ast = lexer($tokens);
  foreach($ast as $node) {
    // parse...
  });
}
```
**[⬆ back to top](#table-of-contents)**

### Remove duplicate code
Do your absolute best to avoid duplicate code. Duplicate code is bad because it means that there's more than one place to alter something if you need to change some logic.

Imagine if you run a restaurant and you keep track of your inventory: all your tomatoes, onions, garlic, spices, etc. If you have multiple lists that
you keep this on, then all have to be updated when you serve a dish with
tomatoes in them. If you only have one list, there's only one place to update!

Oftentimes you have duplicate code because you have two or more slightly
different things, that share a lot in common, but their differences force you
to have two or more separate functions that do much of the same things. Removing duplicate code means creating an abstraction that can handle this set of different things with just one function/module/class.

Getting the abstraction right is critical, that's why you should follow the
SOLID principles laid out in the *Classes* section. Bad abstractions can be
worse than duplicate code, so be careful! Having said this, if you can make
a good abstraction, do it! Don't repeat yourself, otherwise you'll find yourself updating multiple places anytime you want to change one thing.

**Bad:**
```php
function showDeveloperList($developers) {
  foreach($developers as $developer) {
    $expectedSalary = $developer->calculateExpectedSalary();
    $experience = $developer->getExperience();
    $githubLink = $developer->getGithubLink();
    $data = [
      $expectedSalary,
      $experience,
      $githubLink
    ];

    render($data);
  }
}

function showManagerList($managers) {
  foreach($managers as $manager) {
    $expectedSalary = $manager->calculateExpectedSalary();
    $experience = $manager->getExperience();
    $githubLink = $manager->getGithubLink();
    $data = [
      $expectedSalary,
      $experience,
      $githubLink
    ];

    render($data);
  }
}
```

**Good**:
```php
function showList($employees) {
  foreach($employees as $employe) {
    $expectedSalary = $employe->calculateExpectedSalary();
    $experience = $employe->getExperience();
    $githubLink = $employe->getGithubLink();
    $data = [
      $expectedSalary,
      $experience,
      $githubLink
    ];

    render($data);
  }
}
```
**[⬆ back to top](#table-of-contents)**

### Set default objects with Object.assign

**Bad:**
```php
$menuConfig = [
  'title'       => null,
  'body'        => 'Bar',
  'buttonText'  => null,
  'cancellable' => true,
];

function createMenu(&$config) {
  $config['title']       = $config['title'] ?: 'Foo';
  $config['body']        = $config['body'] ?: 'Bar';
  $config['buttonText']  = $config['buttonText'] ?: 'Baz';
  $config['cancellable'] = $config['cancellable'] ?: true;
}

createMenu($menuConfig);
```

**Good**:
```php
$menuConfig = [
  'title'       => 'Order',
  // User did not include 'body' key
  'buttonText'  => 'Send',
  'cancellable' => true,
];

function createMenu(&$config) {
  $config = array_merge([
    'title'       => 'Foo',
    'body'        => 'Bar',
    'buttonText'  => 'Baz',
    'cancellable' => true,
  ], $config);

  // config now equals: {title: "Order", body: "Bar", buttonText: "Send", cancellable: true}
  // ...
}

createMenu($menuConfig);
```
**[⬆ back to top](#table-of-contents)**


### Don't use flags as function parameters
Flags tell your user that this function does more than one thing. Functions should do one thing. Split out your functions if they are following different code paths based on a boolean.

**Bad:**
```php
function createFile(name, temp = false) {
  if (temp) {
    touch('./temp/'.$name);
  } else {
    touch($name);
  }
}
```

**Good**:
```php
function createFile($name) {
  touch(name);
}

function createTempFile($name) {
  touch('./temp/'.$name);
}
```
**[⬆ back to top](#table-of-contents)**

### Avoid Side Effects
A function produces a side effect if it does anything other than take a value in and return another value or values. A side effect could be writing to a file, modifying some global variable, or accidentally wiring all your money to a stranger.

Now, you do need to have side effects in a program on occasion. Like the previous example, you might need to write to a file. What you want to do is to centralize where you are doing this. Don't have several functions and classes that write to a particular file. Have one service that does it. One and only one.

The main point is to avoid common pitfalls like sharing state between objects without any structure, using mutable data types that can be written to by anything, and not centralizing where your side effects occur. If you can do this, you will be happier than the vast majority of other programmers.

**Bad:**
```php
// Global variable referenced by following function.
// If we had another function that used this name, now it'd be an array and it could break it.
$name = 'Ryan McDermott';

function splitIntoFirstAndLastName() {
  $name = preg_split('/ /', $name);
}

splitIntoFirstAndLastName();

var_dump($name); // ['Ryan', 'McDermott'];
```

**Good**:
```php
$name = 'Ryan McDermott';

function splitIntoFirstAndLastName($name) {
  return preg_split('/ /', $name);
}

$name = 'Ryan McDermott';
$newName = splitIntoFirstAndLastName(name);

var_export($name); // 'Ryan McDermott';
var_export($newName); // ['Ryan', 'McDermott'];
```
**[⬆ back to top](#table-of-contents)**

### Don't write to global functions
Polluting globals is a bad practice in very languages because you could clash with another library and the user of your API would be none-the-wiser until they get an exception in production. Let's think about an example: what if you wanted to have configuration array. You could write global function like `config()`, but it could clash with another library that tried to do the same thing. This is why it
would be much better to use singleton design pattern and simple set configuration.

**Bad:**
```php
function config() {
  return  [
    'foo': 'bar',
  ]
};
```

**Good:**
```php
class Configuration {
  private static $instance;
  private function __construct($configuration) {/* */}
  public static function getInstance() {
     if(self::$instance === null) {
         self::$instance = new Configuration();
     }
     return self::$instance;
 }
 public function get($key) {/* */}
 public function getAll() {/* */}
}

$singleton = Configuration::getInstance();
```
**[⬆ back to top](#table-of-contents)**

### Encapsulate conditionals

**Bad:**
```php
if ($fsm->state === 'fetching' && is_empty($listNode)) {
  // ...
}
```

**Good**:
```php
function shouldShowSpinner($fsm, $listNode) {
  return $fsm->state === 'fetching' && is_empty(listNode);
}

if (shouldShowSpinner($fsmInstance, $listNodeInstance)) {
  // ...
}
```
**[⬆ back to top](#table-of-contents)**

### Avoid negative conditionals

**Bad:**
```php
function isDOMNodeNotPresent($node) {
  // ...
}

if (!isDOMNodeNotPresent($node)) {
  // ...
}
```

**Good**:
```php
function isDOMNodePresent($node) {
  // ...
}

if (isDOMNodePresent($node)) {
  // ...
}
```
**[⬆ back to top](#table-of-contents)**

### Avoid conditionals
This seems like an impossible task. Upon first hearing this, most people say,
"how am I supposed to do anything without an `if` statement?" The answer is that
you can use polymorphism to achieve the same task in many cases. The second
question is usually, "well that's great but why would I want to do that?" The
answer is a previous clean code concept we learned: a function should only do
one thing. When you have classes and functions that have `if` statements, you
are telling your user that your function does more than one thing. Remember,
just do one thing.

**Bad:**
```php
class Airplane {
  // ...
  public function getCruisingAltitude() {
    switch (this.type) {
      case '777':
        return $this->getMaxAltitude() - $this->getPassengerCount();
      case 'Air Force One':
        return $this->getMaxAltitude();
      case 'Cessna':
        return $this->getMaxAltitude() - $this->getFuelExpenditure();
    }
  }
}
```

**Good**:
```php
class Airplane {
  // ...
}

class Boeing777 extends Airplane {
  // ...
  public function getCruisingAltitude() {
    return $this->getMaxAltitude() - $this->getPassengerCount();
  }
}

class AirForceOne extends Airplane {
  // ...
  public function getCruisingAltitude() {
    return $this->getMaxAltitude();
  }
}

class Cessna extends Airplane {
  // ...
  public function getCruisingAltitude() {
    return $this->getMaxAltitude() - $this->getFuelExpenditure();
  }
}
```
**[⬆ back to top](#table-of-contents)**

### Avoid type-checking (part 1)
PHP is untyped, which means your functions can take any type of argument.
Sometimes you are bitten by this freedom and it becomes tempting to do
type-checking in your functions. There are many ways to avoid having to do this.
The first thing to consider is consistent APIs.

**Bad:**
```php
function travelToTexas($vehicle) {
  if ($vehicle instanceof Bicycle) {
    $vehicle->peddle($this->currentLocation, new Location('texas'));
  } else if ($vehicle instanceof Car) {
    $vehicle->drive($this->currentLocation, new Location('texas'));
  }
}
```

**Good**:
```php
function travelToTexas($vehicle) {
  $vehicle->move($this->currentLocation, new Location('texas'));
}
```
**[⬆ back to top](#table-of-contents)**

### Avoid type-checking (part 2)
If you are working with basic primitive values like strings, integers, and arrays,
and you can't use polymorphism but you still feel the need to type-check,
you should consider type declaration or strict mode. It provides you with static typing on top of standard PHP syntax. The problem with manually type-checking is that doing it well requires so much extra verbiage that the faux "type-safety" you get doesn't make up for the lost readability. Keep your PHP clean, write good tests, and have good code reviews. Otherwise, do all of that but with PHP strict type declaration or strict mode.

**Bad:**
```php
function combine($val1, $val2) {
  if (is_numeric($val1) && is_numeric(val2)) {
    return val1 + val2;
  }

  throw new \Exception('Must be of type Number');
}
```

**Good**:
```php
function combine(int $val1, int $val2) {
  return $val1 + $val2;
}
```
**[⬆ back to top](#table-of-contents)**

### Remove dead code
Dead code is just as bad as duplicate code. There's no reason to keep it in
your codebase. If it's not being called, get rid of it! It will still be safe
in your version history if you still need it.

**Bad:**
```php
function oldRequestModule($url) {
  // ...
}

function newRequestModule($url) {
  // ...
}

$req = new newRequestModule();
inventoryTracker('apples', $req, 'www.inventory-awesome.io');

```

**Good**:
```php
function newRequestModule($url) {
  // ...
}

$req = new newRequestModule();
inventoryTracker('apples', $req, 'www.inventory-awesome.io');
```
**[⬆ back to top](#table-of-contents)**

