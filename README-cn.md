# clean-code-php

## Table of Contents
  1. [介绍](#介绍)
  2. [变量](#变量)
  3. [函数](#函数)

## 介绍
本文由 yangweijie 翻译自[clen php code](https://github.com/jupeter/clean-code-php)，团建用，欢迎大家指正。

摘录自 Robert C. Martin的[*Clean Code*](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882)  书中的软件工程师的原则
,适用于PHP。 这不是风格指南。 这是一个关于开发可读、可复用并且可重构的PHP软件指南。

并不是这里所有的原则都得遵循，甚至很少的能被普遍接受。 这些虽然只是指导，但是都是*Clean Code*作者多年总结出来的。

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
saveCityZipCode($city, $zipCode);
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

**[⬆ 返回顶部](#table-of-contents)**

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

经常你容忍重复代码，因为你有两个或更多有共同部分但是少许差异的东西强制你用两个或更多独立的函数来做相同的事。移除重复代码意味着创造一个处理这组不同事物的一个抽象，只需要一个函数/模块/类。

抽象正确非常重要，这也是为什么你应当遵循SOLID原则（奠定*Class*基础的原则）。坏的抽象可能比重复代码还要糟，因为要小心。在这个前提下，如果你可以抽象好，那就开始做把！不要重复你自己，否则任何你想改变一件事的时候你都发现在即在更新维护多处。

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

### 通过对象赋值设置默认值

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


### 不要用标志作为函数的参数，标志告诉你的用户函数做很多事了。函数应当只做一件事。 根据布尔值区别的路径来拆分你的复杂函数。

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

### 避免副作用
一个函数做了比获取一个值然后返回另外一个值或值们会产生副作用如果。副作用可能是写入一个文件，修改某些全局变量或者偶然的把你全部的钱给了陌生人。

现在，你的确需要在一个程序或者场合里要有副作用，像之前的例子，你也许需要写一个文件。你想要做的是把你做这些的地方集中起来。不要用几个函数和类来写入一个特定的文件。用一个服务来做它，一个只有一个。

重点是避免常见陷阱比如对象间共享无结构的数据，使用可以写入任何的可变数据类型，不集中处理副作用发生的地方。如果你做了这些你就会比大多数程序员快乐。

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

### 不要写全局函数
在大多数语言中污染全局变量是一个坏的实践，因为你可能和其他类库冲突并且你api的用户不明白为什么直到他们获得产品的一个异常。让我们看一个例子：如果你想配置一个数组，你可能会写一个全局函数像`config()`，但是可能和试着做同样事的其他类库冲突。这就是为什么单例设计模式和简单配置会更好的原因。

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

### 封装条件语句

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

### 避免消极条件

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

### 避免条件声明
这看起来像一个不可能任务。当人们第一次听到这句话是都会这么说。
"没有一个`if声明`" 答案是你可以使用多态来达到许多case语句里的任务。第二个问题很常见， “那么为什么我要那么做？” 答案是前面我们学过的一个整洁代码原则：一个函数应当只做一件事。当你有类和函数有很多`if`声明,你自己知道你的函数做了不止一件事。记住，只做一件事。

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

### Avoid 避免类型检查 (part 1)
PHP是弱类型的,这意味着你的函数可以接收任何类型的参数。
有时候你为这自由所痛苦并且在你的函数渐渐尝试类型检查。有很多方法去避免这么做。第一种是考虑API的一致性。

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

### 避免类型检查 (part 2)
如果你正使用基本原始值比如字符串、整形和数组，你不能用多态，你仍然感觉需要类型检测，你应当考虑类型声明或者严格模式。 这给你了基于标准PHP语法的静态类型。 手动检查类型的问题是做好了需要好多的废话，好像为了安全就可以不顾损失可读性。保持你的PHP 整洁，写好测试，做好代码回顾。做不到就用PHP严格类型声明和严格模式来确保安全。

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

### 移除僵尸代码
僵尸代码和重复代码一样坏。没有理由保留在你的代码库中。如果从来被调用过，见鬼去！在你的版本库里是如果你仍然需要他的话，因此这么做很安全。

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


##有问题反馈
在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

* 邮件(yangweijiest#gmail.com, 把#换成@)
* QQ: 917647288
* weibo: [@黑白世界4648](http://weibo.com/1342658313)
* 人人: [@杨维杰](http://www.renren.com/247050624)
