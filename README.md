# clean-code-php

## Table of Contents
  1. [Introduction](#introduction)
  2. [Variables](#variables)
  3. [Functions](#functions)
  4. [Objects and Data Structures](#objects-and-data-structures)
  5. [Classes](#classes)
     1. [S: Single Responsibility Principle (SRP)](#single-responsibility-principle-srp)
     2. [O: Open/Closed Principle (OCP)](#openclosed-principle-ocp)
     3. [L: Liskov Substitution Principle (LSP)](#liskov-substitution-principle-lsp)
     4. [I: Interface Segregation Principle (ISP)](#interface-segregation-principle-isp)
     5. [D: Dependency Inversion Principle (DIP)](#dependency-inversion-principle-dip)

## Introduction

Software engineering principles, from Robert C. Martin's book
[*Clean Code*](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882),
adapted for PHP. This is not a style guide. It's a guide to producing
readable, reusable, and refactorable software in PHP.

Not every principle herein has to be strictly followed, and even fewer will be universally 
agreed upon. These are guidelines and nothing more, but they are ones codified over many 
years of collective experience by the authors of *Clean Code*.

Inspired from [clean-code-javascript](https://github.com/ryanmcdermott/clean-code-javascript)

## **Variables**
### Use meaningful and pronounceable variable names

**Bad:**
```php
$ymdstr = $moment->format('y-m-d');
```

**Good**:
```php
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
We will read more code than we will ever write. It's important that the code we do write is 
readable and searchable. By *not* naming variables that end up being meaningful for 
understanding our program, we hurt our readers.
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
saveCityZipCode($city, $zipCode);
```
**[⬆ back to top](#table-of-contents)**

### Avoid Mental Mapping
Don’t force the reader of your code to translate what the variable means.
Explicit is better than implicit.

**Bad:**
```php
$l = ['Austin', 'New York', 'San Francisco'];

foreach($i=0; $i<count($l); $i++) {
    $li = $l[$i];
    oStuff();
    doSomeOtherStuff();
    // ...
    // ...
    // ...
    // Wait, what is `$li` for again?
    dispatch($li);
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
    dispatch($location);
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
Limiting the amount of function parameters is incredibly important because it makes 
testing your function easier. Having more than three leads to a combinatorial explosion 
where you have to test tons of different cases with each separate argument.

Zero arguments is the ideal case. One or two arguments is ok, and three should be avoided. 
Anything more than that should be consolidated. Usually, if you have more than two 
arguments then your function is trying to do too much. In cases where it's not, most 
of the time a higher-level object will suffice as an argument.

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
This is by far the most important rule in software engineering. When functions do more 
than one thing, they are harder to compose, test, and reason about. When you can isolate 
a function to just one action, they can be refactored easily and your code will read much 
cleaner. If you take nothing else away from this guide other than this, you'll be ahead 
of many developers.

**Bad:**
```php
function emailClients($clients) {
    foreach ($clients as $client) {
        $clientRecord = $db->find($client);
        if ($clientRecord->isActive()) {
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
    
    return $tokens;
}

function lexer($tokens) {
    $ast = [];
    foreach($tokens as $token) {
        $ast[] = /* ... */;
    });
    
    return $ast;
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
Do your absolute best to avoid duplicate code. Duplicate code is bad because 
it means that there's more than one place to alter something if you need to 
change some logic.

Imagine if you run a restaurant and you keep track of your inventory: all your 
tomatoes, onions, garlic, spices, etc. If you have multiple lists that
you keep this on, then all have to be updated when you serve a dish with
tomatoes in them. If you only have one list, there's only one place to update!

Oftentimes you have duplicate code because you have two or more slightly
different things, that share a lot in common, but their differences force you
to have two or more separate functions that do much of the same things. Removing 
duplicate code means creating an abstraction that can handle this set of different 
things with just one function/module/class.

Getting the abstraction right is critical, that's why you should follow the
SOLID principles laid out in the *Classes* section. Bad abstractions can be
worse than duplicate code, so be careful! Having said this, if you can make
a good abstraction, do it! Don't repeat yourself, otherwise you'll find yourself 
updating multiple places anytime you want to change one thing.

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
Flags tell your user that this function does more than one thing. Functions should 
do one thing. Split out your functions if they are following different code paths 
based on a boolean.

**Bad:**
```php
function createFile($name, $temp = false) {
    if ($temp) {
        touch('./temp/'.$name);
    } else {
        touch($name);
    }
}
```

**Good**:
```php
function createFile($name) {
    touch($name);
}

function createTempFile($name) {
    touch('./temp/'.$name);
}
```
**[⬆ back to top](#table-of-contents)**

### Avoid Side Effects
A function produces a side effect if it does anything other than take a value in and 
return another value or values. A side effect could be writing to a file, modifying 
some global variable, or accidentally wiring all your money to a stranger.

Now, you do need to have side effects in a program on occasion. Like the previous 
example, you might need to write to a file. What you want to do is to centralize where 
you are doing this. Don't have several functions and classes that write to a particular 
file. Have one service that does it. One and only one.

The main point is to avoid common pitfalls like sharing state between objects without
any structure, using mutable data types that can be written to by anything, and not 
centralizing where your side effects occur. If you can do this, you will be happier 
than the vast majority of other programmers.

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
$newName = splitIntoFirstAndLastName($name);

var_dump($name); // 'Ryan McDermott';
var_dump($newName); // ['Ryan', 'McDermott'];
```
**[⬆ back to top](#table-of-contents)**

### Don't write to global functions
Polluting globals is a bad practice in very languages because you could clash with another 
library and the user of your API would be none-the-wiser until they get an exception in 
production. Let's think about an example: what if you wanted to have configuration array. 
You could write global function like `config()`, but it could clash with another library 
that tried to do the same thing. This is why it
would be much better to use singleton design pattern and simple set configuration.

**Bad:**
```php
function config() {
    return  [
        'foo': 'bar',
    ]
}
```

**Good:**
```php
class Configuration {
    private static $instance;
    private function __construct($configuration) {/* */}
    public static function getInstance() {
        if (self::$instance === null) {
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
    return $fsm->state === 'fetching' && is_empty($listNode);
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
        switch ($this->type) {
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
you should consider type declaration or strict mode. It provides you with static 
typing on top of standard PHP syntax. The problem with manually type-checking is 
that doing it well requires so much extra verbiage that the faux "type-safety" 
you get doesn't make up for the lost readability. Keep your PHP clean, write good 
tests, and have good code reviews. Otherwise, do all of that but with PHP strict 
type declaration or strict mode.

**Bad:**
```php
function combine($val1, $val2) {
    if (is_numeric($val1) && is_numeric($val2)) {
        return $val1 + $val2;
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


## **Objects and Data Structures**
### Use getters and setters
In PHP you can set `public`, `protected` and `private` keywords for methods. 
Using it, you can control properties modification on an object. 

* When you want to do more beyond getting an object property, you don't have
to look up and change every accessor in your codebase.
* Makes adding validation simple when doing a `set`.
* Encapsulates the internal representation.
* Easy to add logging and error handling when getting and setting.
* Inheriting this class, you can override default functionality.
* You can lazy load your object's properties, let's say getting it from a
server.

Additionally, this is part of Open/Closed principle, from object-oriented 
design principles.

**Bad:**
```php
class BankAccount {
    public $balance = 1000;
}

$bankAccount = new BankAccount();

// Buy shoes...
$bankAccount->balance -= 100;
```

**Good**:
```php
class BankAccount {
    private $balance;
    
    public function __construct($balance = 1000) {
      $this->balance = $balance;
    }
    
    public function withdrawBalance($amount) {
        if ($amount > $this->balance) {
            throw new \Exception('Amount greater than available balance.');
        }
        $this->balance -= $amount;
    }
    
    public function depositBalance($amount) {
        $this->balance += $amount;
    }
    
    public function getBalance() {
        return $this->balance;
    }
}

$bankAccount = new BankAccount();

// Buy shoes...
$bankAccount->withdrawBalance(-$shoesPrice);

// Get balance
$balance = $bankAccount->getBalance();

```
**[⬆ back to top](#table-of-contents)**


### Make objects have private/protected members

**Bad:**
```php
class Employee {
    public $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
}

$employee = new Employee('John Doe');
echo 'Employee name: '.$employee->name; // Employee name: John Doe
```

**Good**:
```php
class Employee {
    protected $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
}

$employee = new Employee('John Doe');
echo 'Employee name: '.$employee->getName(); // Employee name: John Doe
```
**[⬆ back to top](#table-of-contents)**


## **Classes**

### Single Responsibility Principle (SRP)
As stated in Clean Code, "There should never be more than one reason for a class
to change". It's tempting to jam-pack a class with a lot of functionality, like
when you can only take one suitcase on your flight. The issue with this is
that your class won't be conceptually cohesive and it will give it many reasons
to change. Minimizing the amount of times you need to change a class is important.
It's important because if too much functionality is in one class and you modify a piece of it,
it can be difficult to understand how that will affect other dependent modules in
your codebase.

**Bad:**
```php
class UserSettings {
    private $user;
    public function __construct($user) {
        $this->user = user;
    }
    
    public function changeSettings($settings) {
        if ($this->verifyCredentials()) {
            // ...
        }
    }
    
    private function verifyCredentials() {
        // ...
    }
}
```

**Good:**
```php
class UserAuth {
    private $user;
    public function __construct($user) {
        $this->user = user;
    }
    
    protected function verifyCredentials() {
        // ...
    }
}


class UserSettings {
    private $user;
    public function __construct($user) {
        $this->user = $user;
        $this->auth = new UserAuth($user);
    }
    
    public function changeSettings($settings) {
        if ($this->auth->verifyCredentials()) {
            // ...
        }
    }
}
```
**[⬆ back to top](#table-of-contents)**

### Open/Closed Principle (OCP)
As stated by Bertrand Meyer, "software entities (classes, modules, functions,
etc.) should be open for extension, but closed for modification." What does that
mean though? This principle basically states that you should allow users to
add new functionalities without changing existing code.

**Bad:**
```php
abstract class Adapter {
    protected $name;
    public function getName() {
        return $this->name;
    }
}

class AjaxAdapter extends Adapter {
    public function __construct() {
    parent::__construct();
        $this->name = 'ajaxAdapter';
    }
}

class NodeAdapter extends Adapter {
    public function __construct() {
        parent::__construct();
        $this->name = 'nodeAdapter';
    }
}

class HttpRequester {
    private $adapter;
    public function __construct($adapter) {
        $this->adapter = $adapter;
    }
    
    public function fetch($url) {
        $adapterName = $this->adapter->getName();
        if ($adapterName === 'ajaxAdapter') {
            return $this->makeAjaxCall($url);
        } else if ($adapterName === 'httpNodeAdapter') {
            return $this->makeHttpCall($url);
        }
    }
    
    protected function makeAjaxCall($url) {
        // request and return promise
    }
    
    protected function makeHttpCall($url) {
        // request and return promise
    }
}
```

**Good:**
```php
abstract class Adapter {
    abstract protected function getName();
    abstract public function request($url);
}

class AjaxAdapter extends Adapter {
    protected function getName() {
        return 'ajaxAdapter';
    }
    
    public function request($url) {
        // request and return promise
    }
}

class NodeAdapter extends Adapter {
    protected function getName() {
        return 'nodeAdapter';
    }
    
    public function request($url) {
        // request and return promise
    }
}

class HttpRequester {
    private $adapter;
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    public function fetch($url) {
        return $this->adapter->request($url);
    }
}

```
**[⬆ back to top](#table-of-contents)**


### Liskov Substitution Principle (LSP)
This is a scary term for a very simple concept. It's formally defined as "If S
is a subtype of T, then objects of type T may be replaced with objects of type S
(i.e., objects of type S may substitute objects of type T) without altering any
of the desirable properties of that program (correctness, task performed,
etc.)." That's an even scarier definition.

The best explanation for this is if you have a parent class and a child class,
then the base class and child class can be used interchangeably without getting
incorrect results. This might still be confusing, so let's take a look at the
classic Square-Rectangle example. Mathematically, a square is a rectangle, but
if you model it using the "is-a" relationship via inheritance, you quickly
get into trouble.

**Bad:**
```php
class Rectangle {
    private $width, $height;
    
    public function __construct() {
        $this->width = 0;
        $this->height = 0;
    }
    
    public function setColor($color) {
        // ...
    }
    
    public function render($area) {
        // ...
    }
    
    public function setWidth($width) {
        $this->width = $width;
    }
    
    public function setHeight($height) {
        $this->height = $height;
    }
    
    public function getArea() {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle {
    public function setWidth($width) {
        $this->width = $this->height = $width;
    }
    
    public function setHeight(height) {
        $this->width = $this->height = $height;
    }
}

function renderLargeRectangles($rectangles) {
    foreach($rectangle in $rectangles) {
        $rectangle->setWidth(4);
        $rectangle->setHeight(5);
        $area = $rectangle->getArea(); // BAD: Will return 25 for Square. Should be 20.
        $rectangle->render($area);
    });
}

$rectangles = [new Rectangle(), new Rectangle(), new Square()];
renderLargeRectangles($rectangles);
```

**Good:**
```php
abstract class Shape {
    private $width, $height;
    
    abstract public function getArea();
    
    public function setColor($color) {
        // ...
    }
    
    public function render($area) {
        // ...
    }
}

class Rectangle extends Shape {
    public function __construct {
    parent::__construct();
        $this->width = 0;
        $this->height = 0;
    }
    
    public function setWidth($width) {
        $this->width = $width;
    }
    
    public function setHeight($height) {
        $this->height = $height;
    }
    
    public function getArea() {
        return $this->width * $this->height;
    }
}

class Square extends Shape {
    public function __construct {
        parent::__construct();
        $this->length = 0;
    }
    
    public function setLength($length) {
        $this->length = $length;
    }
    
    public function getArea() {
        return $this->length * $this->length;
    }
}

function renderLargeRectangles($rectangles) {
    foreach($rectangle in $rectangles) {
        if ($rectangle instanceof Square) {
            $rectangle->setLength(5);
        } else if ($rectangle instanceof Rectangle) {
            $rectangle->setWidth(4);
            $rectangle->setHeight(5);
        }
        
        $area = $rectangle->getArea(); 
        $rectangle->render($area);
    });
}

$shapes = [new Rectangle(), new Rectangle(), new Square()];
renderLargeRectangles($shapes);
```
**[⬆ back to top](#table-of-contents)**

### Interface Segregation Principle (ISP)
ISP states that "Clients should not be forced to depend upon interfaces that
they do not use." 

A good example to look at that demonstrates this principle is for
classes that require large settings objects. Not requiring clients to setup
huge amounts of options is beneficial, because most of the time they won't need
all of the settings. Making them optional helps prevent having a "fat interface".

**Bad:**
```php
interface WorkerInterface {
    public function work();
    public function eat();
}

class Worker implements WorkerInterface {
    public function work() {
        // ....working
    }
    public function eat() {
        // ...... eating in launch break
    }
}

class SuperWorker implements WorkerInterface {
    public function work() {
        //.... working much more
    }

    public function eat() {
        //.... eating in launch break
    }
}

class Manager {
  /** @var WorkerInterface $worker **/
  private $worker;
  
  public void setWorker(WorkerInterface $worker) {
        $this->worker = $worker;
    }

    public function manage() {
        $this->worker->work();
    }
}
```

**Good:**
```php
interface WorkerInterface extends FeedableInterface, WorkableInterface {
}

interface WorkableInterface {
    public function work();
}

interface FeedableInterface {
    public function eat();
}

class Worker implements WorkableInterface, FeedableInterface {
    public function work() {
        // ....working
    }

    public function eat() {
        //.... eating in launch break
    }
}

class Robot implements WorkableInterface {
    public void work() {
        // ....working
    }
}

class SuperWorker implements WorkerInterface  {
    public function work() {
        //.... working much more
    }

    public function eat() {
        //.... eating in launch break
    }
}

class Manager {
  /** @var $worker WorkableInterface **/
    private $worker;

    public function setWorker(WorkableInterface $w) {
      $this->worker = $w;
    }

    public function manage() {
        $this->worker->work();
    }
}
```
**[⬆ back to top](#table-of-contents)**

### Dependency Inversion Principle (DIP)
This principle states two essential things:
1. High-level modules should not depend on low-level modules. Both should
depend on abstractions.
2. Abstractions should not depend upon details. Details should depend on
abstractions.

This can be hard to understand at first, but if you've worked with PHP frameworks (like Symfony), you've seen an implementation of this principle in the form of Dependency
Injection (DI). While they are not identical concepts, DIP keeps high-level
modules from knowing the details of its low-level modules and setting them up.
It can accomplish this through DI. A huge benefit of this is that it reduces
the coupling between modules. Coupling is a very bad development pattern because
it makes your code hard to refactor.

**Bad:**
```php
class Worker {
  public function work() {
    // ....working
  }
}

class Manager {
    /** @var Worker $worker **/
    private $worker;
    
    public function __construct(Worker $worker) {
        $this->worker = $worker;
    }
    
    public function manage() {
        $this->worker->work();
    }
}

class SuperWorker extends Worker {
    public function work() {
        //.... working much more
    }
}
```

**Good:**
```php
interface WorkerInterface {
    public function work();
}

class Worker implements WorkerInterface {
    public function work() {
        // ....working
    }
}

class SuperWorker implements WorkerInterface {
    public function work() {
        //.... working much more
    }
}

class Manager {
    /** @var Worker $worker **/
    private $worker;
    
    public void __construct(WorkerInterface $worker) {
        $this->worker = $worker;
    }
    
    public void manage() {
        $this->worker->work();
    }
}

```
**[⬆ back to top](#table-of-contents)**

### Use method chaining
This pattern is very useful and commonly used it many libraries such
as PHPUnit and Doctrine. It allows your code to be expressive, and less verbose.
For that reason, I say, use method chaining and take a look at how clean your code
will be. In your class functions, simply return `this` at the end of every function,
and you can chain further class methods onto it.

**Bad:**
```php
class Car {
    private $make, $model, $color;
    
    public function __construct() {
        $this->make = 'Honda';
        $this->model = 'Accord';
        $this->color = 'white';
    }
    
    public function setMake($make) {
        $this->make = $make;
    }
    
    public function setModel($model) {
        $this->model = $model;
    }
    
    public function setColor($color) {
        $this->color = $color;
    }
    
    public function dump() {
        var_dump($this->make, $this->model, $this->color);
    }
}

$car = new Car();
$car->setColor('pink');
$car->setMake('Ford');
$car->setModel('F-150');
$car->dump();
```

**Good:**
```php
class Car {
    private $make, $model, $color;
    
    public function __construct() {
        $this->make = 'Honda';
        $this->model = 'Accord';
        $this->color = 'white';
    }
    
    public function setMake($make) {
        $this->make = $make;
        
        // NOTE: Returning this for chaining
        return $this;
    }
    
    public function setModel($model) {
        $this->model = $model;
        
        // NOTE: Returning this for chaining
        return $this;
    }
    
    public function setColor($color) {
        $this->color = $color;
        
        // NOTE: Returning this for chaining
        return $this;
    }
    
    public function dump() {
        var_dump($this->make, $this->model, $this->color);
    }
}

$car = (new Car())
  ->setColor('pink')
  ->setMake('Ford')
  ->setModel('F-150')
  ->dump();
```
**[⬆ back to top](#table-of-contents)**

### Prefer composition over inheritance
As stated famously in [*Design Patterns*](https://en.wikipedia.org/wiki/Design_Patterns) by the Gang of Four,
you should prefer composition over inheritance where you can. There are lots of
good reasons to use inheritance and lots of good reasons to use composition.
The main point for this maxim is that if your mind instinctively goes for
inheritance, try to think if composition could model your problem better. In some
cases it can.

You might be wondering then, "when should I use inheritance?" It
depends on your problem at hand, but this is a decent list of when inheritance
makes more sense than composition:

1. Your inheritance represents an "is-a" relationship and not a "has-a"
relationship (Human->Animal vs. User->UserDetails).
2. You can reuse code from the base classes (Humans can move like all animals).
3. You want to make global changes to derived classes by changing a base class.
(Change the caloric expenditure of all animals when they move).

**Bad:**
```php
class Employee {
    private $name, $email;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }
    
    // ...
}

// Bad because Employees "have" tax data. 
// EmployeeTaxData is not a type of Employee

class EmployeeTaxData extends Employee {
    private $ssn, $salary;
    
    public function __construct($ssn, $salary) {
        parent::__construct();
        $this->ssn = $ssn;
        $this->salary = $salary;
    }
    
    // ...
}
```

**Good:**
```php
class EmployeeTaxData {
    private $ssn, $salary;
    
    public function __construct($ssn, $salary) {
        $this->ssn = $ssn;
        $this->salary = $salary;
    }
    
    // ...
}

class Employee {
    private $name, $email, $taxData;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }
    
    public function setTaxData($ssn, $salary) {
        $this->taxData = new EmployeeTaxData($ssn, $salary);
    }
    // ...
}
```
**[⬆ back to top](#table-of-contents)**
