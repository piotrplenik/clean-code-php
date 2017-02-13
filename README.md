# clean-code-php

## Table of Contents
  1. [Introduction](#introduction)
  2. [Variables](#variables)
  3. [Functions](#functions)

## Introduction

摘录自 Robert C. Martin的[*Clean Code*](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882)  书中的软件工程师的原则
,适用于PHP。 这不是风格指南。 这是一个关于开发可读、可复用并且可重构的PHP软件指南。

并不是这里所有的原则都得遵循，甚至很少的能被普遍接受。 These are guidelines and nothing more, but they are ones codified over many years of collective experience by the authors of *Clean Code*.

Inspired from [clean-code-javascript](https://github.com/ryanmcdermott/clean-code-javascript)

## **变量**
### 使用有意义且可拼写的变量名

**Bad:**
```php
$ymdstr = $moment->format('y-m-d');
```

**Good**:
```javascript
$currentDate = $moment->format('y-m-d');
```
**[⬆ 返回顶部](#table-of-contents)**

### 同种类型的变量使用相同词汇

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
**[⬆ 返回顶部](#table-of-contents)**

### 使用易检索的名称
我们会读比写要多的代码。通过是命名易搜索，让我们写出可读性和易搜索代码很重要。

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
**[⬆ 返回顶部](#table-of-contents)**


### 使用解释型变量
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
**[⬆ 返回顶部](#table-of-contents)**

### 避免心理映射
明确比隐性好。

**Bad:**
```php
$l = ['Austin', 'New York', 'San Francisco'];
foreach($i=0; $i<count($l); $i++) {
  oStuff();
  doSomeOtherStuff();
  // ...
  // ...
  // ...
  // 等等`$l` 又代表什么?
  dispatch($l);
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
**[⬆ 返回顶部](#table-of-contents)**


### 不要添加不必要上下文
如果你的class/object 名能告诉你什么，不要把它重复在你变量名里。

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
**[⬆ 返回顶部](#table-of-contents)**

###使用参数默认值代替短路或条件语句。
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
**[返回顶部](#table-of-contents)**
## **函数**
### 函数参数最好少于2个
限制函数参数个数极其重要因为它是你函数测试容易点。有超过3个可选参数参数导致一个爆炸式组合增长，你会有成吨独立参数情形要测试。

无参数是理想情况。1个或2个都可以，最好避免3个。再多旧需要加固了。通常如果你的函数有超过两个参数，说明他多做了一些事。 在参数少的情况里，大多数时候一个高级别对象（数组）作为参数就足够应付。

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
**[⬆ 返回顶部](#table-of-contents)**


### 函数应该只做一件事
这是迄今为止软件工程里最重要的一个规则。当函数做超过一件事的时候，他们就难于实现、测试和理解。当你隔离函数只剩一个功能时，他们就容易被重构，然后你的代码读起来就更清晰。如果你光遵循这条规则，你就领先于大多数开发者了。

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
**[⬆ 返回顶部](#table-of-contents)**

### 函数名应当描述他们所做的事

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
**[⬆ 返回顶部](#table-of-contents)**

### 函数应当只为一层抽象，当你超过一层抽象时，函数正在做多件事。拆分功能易达到可重用性和易用性。.

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
**[⬆ 返回顶部](#table-of-contents)**

### 删除重复的代码
尽你最大的努力来避免重复的代码。重复代码不好，因为它意味着如果你修改一些逻辑，那就有不止一处地方要同步修改了。

想象一下如果你经营着一家餐厅并跟踪它的库存: 你全部的西红柿、洋葱、大蒜、香料等。如果你保留有多个列表，当你服务一个有着西红柿的菜，那么所有记录都得更新。如果你只有一个列表，那么只需要修改一个地方！

当你容忍重复代码，因为你有两个或更多差异很少的不同东西。Oftentimes you have duplicate code because you have two or more slightly
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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**


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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

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
**[⬆ 返回顶部](#table-of-contents)**

