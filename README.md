# PHP Toza Kod

## Mundarija

1. [Kirish](#kirish)
2. [O'zgaruvchilar](#o`zgaruvchilar)
   - [Ma'noli va tushunarli nomlardan foydalaning](#manoli-va-tushunarli-nomlardan-foydalaning)
   - [Bir xil turdagi o'zgaruvchilar uchun xuddi shunday nomdan foydalaning](#bir-xil-turdagi-ozgaruvchilar-uchun-xuddi-shunday-nomdan-foydalaning)
   - [Izlashga qulay bo'lgan nomlardan foydalaning (1-qism)](#izlashga-qulay-bolgan-nomlardan-foydalaning-1-qism)
   - [Izlashga qulay bo'lgan nomlardan foydalaning (2-qism)](#izlashga-qulay-bolgan-nomlardan-foydalaning-2-qism)
   - [Mantiqni izohlaydigan o'zgaruvchilardan foydalaning](#mantiqni-izohlaydigan-ozgaruvchilardan-foydalaning)
   - [Shart operatorlarini bir birini ichiga chuqur joylashtirishni va qiymatlarni erta qaytarishni oldini oling (1-qism)](#shart-operatorlarini-bir-birini-ichiga-chuqur-joylashtirishni-va-qiymatlarni-erta-qaytarishni-oldini-oling-1-qism)
   - [Shart operatorlarini bir birini ichiga chuqur joylashtirishni va qiymatlarni erta qaytarishni oldini oling (2-qism)](#shart-operatorlarini-bir-birini-ichiga-chuqur-joylashtirishni-va-qiymatlarni-erta-qaytarishni-oldini-oling-2-qism)
   - [O'zgaruvchilarni nomlashda Aqliy Xaritalamang](#ozgaruvchilarni-nomlashda-aqliy-xaritalamang)
   - [Keraksiz kontekst qo'shmang](#keraksiz-kontekst-qoshmang)
   - [Qisqa formalar yoki shartlar o'rniga standart argumentlardan foydalaning](#qisqa-formalar-yoki-shartlar-orniga-standart-argumentlardan-foydalaning)
3. [Taqqsolash](#taqqoslash)
   - [Toifa bilan taqqoslash'dan foydalaning](#toifa-bilan-taqqoslashdan-foydalaning)
   - [Null birlashma operatori](#null-birlashma-operatori)
4. [Funksiyalar](#funksiyalar)
   - [Funksiya argumentlari (2 yoki kamrog'i ideal)](#funksiya-argumentlari-2-yoki-kamrogi-ideal)
   - [Funksiya nomlari qanday amal bajarilayotganini aytishlari kerak](#funksiya-nomlari-qanday-amal-bajarilayotganini-aytishlari-kerak)
   - [Funksiyalar bir darajada abstrakt bo'lishi kerak](#funksiyalar-bir-darajada-abstrakt-bo'lishi-kerak)
   - [Don't use flags as function parameters](#dont-use-flags-as-function-parameters)
   - [Avoid Side Effects](#avoid-side-effects)
   - [Don't write to global functions](#dont-write-to-global-functions)
   - [Don't use a Singleton pattern](#dont-use-a-singleton-pattern)
   - [Encapsulate conditionals](#encapsulate-conditionals)
   - [Avoid negative conditionals](#avoid-negative-conditionals)
   - [Avoid conditionals](#avoid-conditionals)
   - [Avoid type-checking (part 1)](#avoid-type-checking-part-1)
   - [Avoid type-checking (part 2)](#avoid-type-checking-part-2)
   - [Remove dead code](#remove-dead-code)
5. [Objects and Data Structures](#objects-and-data-structures)
   - [Use object encapsulation](#use-object-encapsulation)
   - [Make objects have private/protected members](#make-objects-have-privateprotected-members)
6. [Classes](#classes)
   - [Prefer composition over inheritance](#prefer-composition-over-inheritance)
   - [Avoid fluent interfaces](#avoid-fluent-interfaces)
   - [Prefer final classes](#prefer-final-classes)
7. [SOLID](#solid)
   - [Single Responsibility Principle (SRP)](#single-responsibility-principle-srp)
   - [Open/Closed Principle (OCP)](#openclosed-principle-ocp)
   - [Liskov Substitution Principle (LSP)](#liskov-substitution-principle-lsp)
   - [Interface Segregation Principle (ISP)](#interface-segregation-principle-isp)
   - [Dependency Inversion Principle (DIP)](#dependency-inversion-principle-dip)
8. [Don’t repeat yourself (DRY)](#dont-repeat-yourself-dry)
9. [Translations](#translations)

## Kirish

Software engineering principles, from Robert C. Martin's book
[_Clean Code_](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882),
adapted for PHP. This is not a style guide. It's a guide to producing
readable, reusable, and refactorable software in PHP.

Not every principle herein has to be strictly followed, and even fewer will be universally
agreed upon. These are guidelines and nothing more, but they are ones codified over many
years of collective experience by the authors of _Clean Code_.

Inspired from [clean-code-javascript](https://github.com/ryanmcdermott/clean-code-javascript).

Although many developers still use PHP 5, most of the examples in this article only work with PHP 7.1+.

## O'zgaruvchilar

### Ma'noli va tushunarli nomlardan foydalaning

**Yomon:**

```php
declare(strict_types=1);

$ymdstr = $moment->format('y-m-d');
```

**Yaxshi:**

```php
declare(strict_types=1);

$currentDate = $moment->format('y-m-d');
```

**[⬆ boshiga qaytish](#mundarija)**

### Bir xil turdagi o'zgaruvchilar uchun xuddi shunday nomdan foydalaning

**Yomon:**

```php
declare(strict_types=1);

getUserInfo();
getUserData();
getUserRecord();
getUserProfile();
```

**Yaxshi:**

```php
declare(strict_types=1);

getUser();
```

**[⬆ boshiga qaytish](#mundarija)**

### Izlashga qulay bo'lgan nomlardan foydalaning (1-qism)

Biz kod yozishdan ko'ra ko'proq ularni o'qiymiz. Shuning uchun biz yozadigan kod izlashga va o'qishga qulay bo'lishi muhimdir. Dasturimizni tushunishda ahamaiyatga ega bo'lgan o'zgaruvchilarni ma'noli qilib nomlamaslik, kodni o'qiyotgan dasturchiga qiyinchilik tug'diradi. O'zgaruvchilarni izlashga qulay qilib nomlang.

**Yomon:**

```php
declare(strict_types=1);

// 448 nimani anglatadi?
$result = $serializer->serialize($data, 448);
```

**Yaxshi:**

```php
declare(strict_types=1);

$json = $serializer->serialize($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

### Izlashga qulay bo'lgan nomlardan foydalaning (2-qism)

**Yomon:**

```php
declare(strict_types=1);

class User
{
    // 7 nimani anglatadi ?
    public $access = 7;
}

// 4 nimani anglatadi?
if ($user->access & 4) {
    // ...
}

// By yerda qanday mantiq ketayorgani vaqti kelib o'zingizni ham yodingizdan ko'tariladi
$user->access ^= 2;
```

**Yaxshi:**

```php
declare(strict_types=1);

class User
{
    public const ACCESS_READ = 1;

    public const ACCESS_CREATE = 2;

    public const ACCESS_UPDATE = 4;

    public const ACCESS_DELETE = 8;

    // Bu yerda esa hammasi tushunarli. Boshlang'ich holatda `$access`ga o'qish, tahrirlash va yaratish huquqlari o'zlashtirilmoqda.
    public $access = self::ACCESS_READ | self::ACCESS_CREATE | self::ACCESS_UPDATE;
}

if ($user->access & User::ACCESS_UPDATE) {
    // tahrirlash ...
}

// Nimadir yaratishga bo'lgan huquqni cheklash
$user->access ^= User::ACCESS_CREATE;
```

**[⬆ boshiga qaytish](#mundarija)**

### Mantiqni izohlaydigan o'zgaruvchilardan foydalaning

**Yomon:**

```php
declare(strict_types=1);

$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches[1], $matches[2]);
```

**Yomon emas:**

Bu yaxshiroq, lekin biz haliham to'liq mantiqni tushunish uchun regex'ga bog'liqmiz.

```php
declare(strict_types=1);

$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

[, $city, $zipCode] = $matches;
saveCityZipCode($city, $zipCode);
```

**Yaxshi:**

Subpattern'larni nomlash orqali regex'ga bog'liqligimizni kamaytirdik.

```php
declare(strict_types=1);

$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(?<city>.+?)\s*(?<zipCode>\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches['city'], $matches['zipCode']);
```

**[⬆ boshiga qaytish](#mundarija)**

### Shart operatorlarini bir birini ichiga chuqur joylashtirishni va qiymatlarni erta qaytarishni oldini oling (1-qism)

Juda ham ko'p if-else operatorlari kodingizni tushunishni qiyinlashtiradi. Aniqlik mujmallikdan ko'ra yaxshiroq.

**Yomon:**

```php
declare(strict_types=1);

function isShopOpen($day): bool
{
    if ($day) {
        if (is_string($day)) {
            $day = strtolower($day);
            if ($day === 'friday') {
                return true;
            } elseif ($day === 'saturday') {
                return true;
            } elseif ($day === 'sunday') {
                return true;
            }
            return false;
        }
        return false;
    }
    return false;
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function isShopOpen(string $day): bool
{
    if (empty($day)) {
        return false;
    }

    $openingDays = ['friday', 'saturday', 'sunday'];

    return in_array(strtolower($day), $openingDays, true);
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Shart operatorlarini bir birini ichiga chuqur joylashtirishni va qiymatlarni erta qaytarishni oldini oling (2-qism)

**Yomon:**

```php
declare(strict_types=1);

function fibonacci(int $n)
{
    if ($n < 50) {
        if ($n !== 0) {
            if ($n !== 1) {
                return fibonacci($n - 1) + fibonacci($n - 2);
            }
            return 1;
        }
        return 0;
    }
    return 'Not supported';
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function fibonacci(int $n): int
{
    if ($n === 0 || $n === 1) {
        return $n;
    }

    if ($n >= 50) {
        throw new Exception('Not supported');
    }

    return fibonacci($n - 1) + fibonacci($n - 2);
}
```

**[⬆ boshiga qaytish](#mundarija)**

### O'zgaruvchilarni nomlashda Aqliy Xaritalamang

Kodingiz o'quvchisini o'zgaruvchi nimani anglatishini tarjima qilishiga majburlamang. Aniqlik mujmallikdan ko'ra yaxshiroq.

**Yomon:**

```php
$l = ['Austin', 'New York', 'San Francisco'];

for ($i = 0; $i < count($l); $i++) {
    $li = $l[$i];
    doStuff();
    doSomeOtherStuff();
    // ...
    // ...
    // ...
    // Shoshmang, `$li` nima bo'ldi bu yana?
    dispatch($li);
}
```

**Yaxshi:**

```php
declare(strict_types=1);

$locations = ['Austin', 'New York', 'San Francisco'];

foreach ($locations as $location) {
    doStuff();
    doSomeOtherStuff();
    // ...
    // ...
    // ...
    dispatch($location);
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Keraksiz kontekst qo'shmang

Agar class/obyekt'ingizni nomi nimanidir anglatib turgan bo'lsa, o'zgaruvchingizni nomida uni takrorlamang

**Yomon:**

```php
declare(strict_types=1);

class Car
{
    public $carMake;

    public $carModel;

    public $carColor;

    //...
}
```

**Yaxshi:**

```php
declare(strict_types=1);

class Car
{
    public $make;

    public $model;

    public $color;

    //...
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Qisqa formalar yoki shartlar o'rniga standart argumentlardan foydalaning

**Yaxshi emas:**

Bu yaxshi emas chunki `$breweryName` ning qiymati `NULL` bo'lishi mumkin.

```php
function createMicrobrewery($breweryName = 'Hipster Brew Co.'): void
{
    // ...
}
```

**Yomon emas:**

Bu variant oldingisiga qaraganda ancha tushunarli, ammo u o'zgaruvchining qiymatini yaxshiroq boshqaradi.

```php
function createMicrobrewery($name = null): void
{
    $breweryName = $name ?: 'Hipster Brew Co.';
    // ...
}
```

**Yaxshi:**

[Toifalarni boshqarish](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration) dan foydalanishingiz mumkin va `$breweryName` ning qiymati `NULL` ga teng bo'lmasligiga ishonchingiz komil bo'ladi.

```php
function createMicrobrewery(string $breweryName = 'Hipster Brew Co.'): void
{
    // ...
}
```

**[⬆ boshiga qaytish](#mundarija)**

## Taqqoslash

### [Toifa bilan taqqoslash](http://php.net/manual/en/language.operators.comparison.php)dan foydalaning

**Yaxshi emas:**

Oddiy taqqoslash satrni butun songa aylantiradi.

```php
declare(strict_types=1);

$a = '42';
$b = 42;

if ($a != $b) {
    // Ifoda bajarilmaydi
}
```

`$a != $b` ifodasi `FALSE` (yolg'on) qiymat qaytaradi, aslide esa `TRUE` (rost) qaytarishi kerak. Chunki, satr toifasidagi `42` butun toifadagi `42` dan farq qiladi.

**Yaxshi:**

Toifa bilan taqqoslaganda o'zgaruvchilarning qiymati bilan birgalikda toifasi ham solishtiriladi.

```php
declare(strict_types=1);

$a = '42';
$b = 42;

if ($a !== $b) {
    // Ifoda bajariladi
}
```

`$a !== $b` taqqosi `TRUE` (rost) qiymat qaytaradi.

**[⬆ boshiga qaytish](#mundarija)**

### Null birlashma operatori

Null birlashma operatori [PHP 7](https://www.php.net/manual/en/migration70.new-features.php) versiyadan boshlab joriy qilingan yangi operator hisoblanadi. Bu operator ternar `isset ()` bilan birgalikda ishlatish kerak bo'lgan oddiy holat uchun sintaktik qisqartma sifatida qo'shilgan. Bu operator dastlabki operanda mavjud bo'lsa va u `null` ga teng bo'lmasa shu operandani qaytaradi, aks holda keyingi operandani qaytaradi;

**Yomon:**

```php
declare(strict_types=1);

if (isset($_GET['name'])) {
    $name = $_GET['name'];
} elseif (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = 'nobody';
}
```

**Yaxshi:**

```php
declare(strict_types=1);

$name = $_GET['name'] ?? $_POST['name'] ?? 'nobody';
```

**[⬆ boshiga qaytish](#mundarija)**

## Funksiyalar

### Funksiya argumentlari (2 yoki kamrog'i ideal)

Funksiya qabul qiluvchi parametrlarini cheklash juda muhimdir, chunki bu testlash jarayonini osonlashtiradi. Uchtadan ortiq parametrlarni qabul qilish har bir holatni testlayotgan paytingizda ko'plab qiyinchiliklarni yuzaga keltiradi.

Argumentsiz funksiyalar bu ideal holatdir. Bir yoki ikkita argument qabul qilish yaxshi, uchtadan esa qochgan ma'qul. Bundan boshqa holatlarda esa imkon qadar birlashtirish kerak. Odatda, agar sizda 2 tadan ortiq argument bo'lsa u holda sizning funksiyangiz juda ko'p amalni bajarishga harakat qiladi. Bunday bo'lmagan hollarda esa argumentlarni obyektlarga joylashtiring.

**Yomon:**

```php
declare(strict_types=1);

class Questionnaire
{
    public function __construct(
        string $firstname,
        string $lastname,
        string $patronymic,
        string $region,
        string $district,
        string $city,
        string $phone,
        string $email
    ) {
        // ...
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

class Name
{
    private $firstname;

    private $lastname;

    private $patronymic;

    public function __construct(string $firstname, string $lastname, string $patronymic)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->patronymic = $patronymic;
    }

    // getters ...
}

class City
{
    private $region;

    private $district;

    private $city;

    public function __construct(string $region, string $district, string $city)
    {
        $this->region = $region;
        $this->district = $district;
        $this->city = $city;
    }

    // getters ...
}

class Contact
{
    private $phone;

    private $email;

    public function __construct(string $phone, string $email)
    {
        $this->phone = $phone;
        $this->email = $email;
    }

    // getters ...
}

class Questionnaire
{
    public function __construct(Name $name, City $city, Contact $contact)
    {
        // ...
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Funksiya nomlari qanday amal bajarilayotganini aytishlari kerak

**Yomon:**

```php
class Email
{
    //...

    public function handle(): void
    {
        mail($this->to, $this->subject, $this->body);
    }
}

$message = new Email(...);
// Nima bu ? Hozir biz faylga yozayapmizmi ?
$message->handle();
```

**Yaxshi:**

```php
class Email
{
    //...

    public function send(): void
    {
        mail($this->to, $this->subject, $this->body);
    }
}

$message = new Email(...);
// Tushunarli va aniq
$message->send();
```

**[⬆ boshiga qaytish](#mundarija)**

### Funksiyalar bir darajada abstrakt bo'lishi kerak

Sizda bir darajadan ortiq abstraktsiya bo'lganida funksiyangiz odatada ko'p ishlaydi. Funksiyalarni ajratish qayta foydalanuvchanlikni yaxshilaydi va testlashni osonlashtiradi.

**Yomon:**

```php
declare(strict_types=1);

function parseBetterPHPAlternative(string $code): void
{
    $regexes = [
        // ...
    ];

    $statements = explode(' ', $code);
    $tokens = [];
    foreach ($regexes as $regex) {
        foreach ($statements as $statement) {
            // ...
        }
    }

    $ast = [];
    foreach ($tokens as $token) {
        // lex...
    }

    foreach ($ast as $node) {
        // parse...
    }
}
```

**Yaxshi emas:**

Biz biroz funksionnalikni amalga oshirdik, lekin `parseBetterPHPAlternative()` funksiyasi haliham testlab bo'lmaydigan darajada juda murakkab.

```php
function tokenize(string $code): array
{
    $regexes = [
        // ...
    ];

    $statements = explode(' ', $code);
    $tokens = [];
    foreach ($regexes as $regex) {
        foreach ($statements as $statement) {
            $tokens[] = /* ... */;
        }
    }

    return $tokens;
}

function lexer(array $tokens): array
{
    $ast = [];
    foreach ($tokens as $token) {
        $ast[] = /* ... */;
    }

    return $ast;
}

function parseBetterPHPAlternative(string $code): void
{
    $tokens = tokenize($code);
    $ast = lexer($tokens);
    foreach ($ast as $node) {
        // parse...
    }
}
```

**Yaxshi:**

Eng yaxshi yechim bu `parseBetterPHPAlternative()` funksiyasini bog'liqligini ko'chirish.

```php
class Tokenizer
{
    public function tokenize(string $code): array
    {
        $regexes = [
            // ...
        ];

        $statements = explode(' ', $code);
        $tokens = [];
        foreach ($regexes as $regex) {
            foreach ($statements as $statement) {
                $tokens[] = /* ... */;
            }
        }

        return $tokens;
    }
}

class Lexer
{
    public function lexify(array $tokens): array
    {
        $ast = [];
        foreach ($tokens as $token) {
            $ast[] = /* ... */;
        }

        return $ast;
    }
}

class BetterPHPAlternative
{
    private $tokenizer;
    private $lexer;

    public function __construct(Tokenizer $tokenizer, Lexer $lexer)
    {
        $this->tokenizer = $tokenizer;
        $this->lexer = $lexer;
    }

    public function parse(string $code): void
    {
        $tokens = $this->tokenizer->tokenize($code);
        $ast = $this->lexer->lexify($tokens);
        foreach ($ast as $node) {
            // parse...
        }
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Don't use flags as function parameters

Flags tell your user that this function does more than one thing. Functions should
do one thing. Split out your functions if they are following different code paths
based on a boolean.

**Yomon:**

```php
declare(strict_types=1);

function createFile(string $name, bool $temp = false): void
{
    if ($temp) {
        touch('./temp/' . $name);
    } else {
        touch($name);
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function createFile(string $name): void
{
    touch($name);
}

function createTempFile(string $name): void
{
    touch('./temp/' . $name);
}
```

**[⬆ boshiga qaytish](#mundarija)**

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

**Yomon:**

```php
declare(strict_types=1);

// Global variable referenced by following function.
// If we had another function that used this name, now it'd be an array and it could break it.
$name = 'Ryan McDermott';

function splitIntoFirstAndLastName(): void
{
    global $name;

    $name = explode(' ', $name);
}

splitIntoFirstAndLastName();

var_dump($name);
// ['Ryan', 'McDermott'];
```

**Yaxshi:**

```php
declare(strict_types=1);

function splitIntoFirstAndLastName(string $name): array
{
    return explode(' ', $name);
}

$name = 'Ryan McDermott';
$newName = splitIntoFirstAndLastName($name);

var_dump($name);
// 'Ryan McDermott';

var_dump($newName);
// ['Ryan', 'McDermott'];
```

**[⬆ boshiga qaytish](#mundarija)**

### Don't write to global functions

Polluting globals is a bad practice in many languages because you could clash with another
library and the user of your API would be none-the-wiser until they get an exception in
production. Let's think about an example: what if you wanted to have configuration array?
You could write global function like `config()`, but it could clash with another library
that tried to do the same thing.

**Yomon:**

```php
declare(strict_types=1);

function config(): array
{
    return [
        'foo' => 'bar',
    ];
}
```

**Yaxshi:**

```php
declare(strict_types=1);

class Configuration
{
    private $configuration = [];

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function get(string $key): ?string
    {
        // null coalescing operator
        return $this->configuration[$key] ?? null;
    }
}
```

Load configuration and create instance of `Configuration` class

```php
declare(strict_types=1);

$configuration = new Configuration([
    'foo' => 'bar',
]);
```

And now you must use instance of `Configuration` in your application.

**[⬆ boshiga qaytish](#mundarija)**

### Don't use a Singleton pattern

Singleton is an [anti-pattern](https://en.wikipedia.org/wiki/Singleton_pattern). Paraphrased from Brian Button:

1.  They are generally used as a **global instance**, why is that so bad? Because **you hide the dependencies** of your application in your code, instead of exposing them through the interfaces. Making something global to avoid passing it around is a [code smell](https://en.wikipedia.org/wiki/Code_smell).
2.  They violate the [single responsibility principle](#single-responsibility-principle-srp): by virtue of the fact that **they control their own creation and lifecycle**.
3.  They inherently cause code to be tightly [coupled](https://en.wikipedia.org/wiki/Coupling_%28computer_programming%29). This makes faking them out under **test rather difficult** in many cases.
4.  They carry state around for the lifetime of the application. Another hit to testing since **you can end up with a situation where tests need to be ordered** which is a big no for unit tests. Why? Because each unit test should be independent from the other.

There is also very good thoughts by [Misko Hevery](http://misko.hevery.com/about/) about the [root of problem](http://misko.hevery.com/2008/08/25/root-cause-of-singletons/).

**Yomon:**

```php
declare(strict_types=1);

class DBConnection
{
    private static $instance;

    private function __construct(string $dsn)
    {
        // ...
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // ...
}

$singleton = DBConnection::getInstance();
```

**Yaxshi:**

```php
declare(strict_types=1);

class DBConnection
{
    public function __construct(string $dsn)
    {
        // ...
    }

    // ...
}
```

Create instance of `DBConnection` class and configure it with [DSN](http://php.net/manual/en/pdo.construct.php#refsect1-pdo.construct-parameters).

```php
declare(strict_types=1);

$connection = new DBConnection($dsn);
```

And now you must use instance of `DBConnection` in your application.

**[⬆ boshiga qaytish](#mundarija)**

### Encapsulate conditionals

**Yomon:**

```php
declare(strict_types=1);

if ($article->state === 'published') {
    // ...
}
```

**Yaxshi:**

```php
declare(strict_types=1);

if ($article->isPublished()) {
    // ...
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Avoid negative conditionals

**Yomon:**

```php
declare(strict_types=1);

function isDOMNodeNotPresent(DOMNode $node): bool
{
    // ...
}

if (! isDOMNodeNotPresent($node)) {
    // ...
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function isDOMNodePresent(DOMNode $node): bool
{
    // ...
}

if (isDOMNodePresent($node)) {
    // ...
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Avoid conditionals

This seems like an impossible task. Upon first hearing this, most people say,
"how am I supposed to do anything without an `if` statement?" The answer is that
you can use polymorphism to achieve the same task in many cases. The second
question is usually, "well that's great but why would I want to do that?" The
answer is a previous clean code concept we learned: a function should only do
one thing. When you have classes and functions that have `if` statements, you
are telling your user that your function does more than one thing. Remember,
just do one thing.

**Yomon:**

```php
declare(strict_types=1);

class Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
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

**Yaxshi:**

```php
declare(strict_types=1);

interface Airplane
{
    // ...

    public function getCruisingAltitude(): int;
}

class Boeing777 implements Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
        return $this->getMaxAltitude() - $this->getPassengerCount();
    }
}

class AirForceOne implements Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
        return $this->getMaxAltitude();
    }
}

class Cessna implements Airplane
{
    // ...

    public function getCruisingAltitude(): int
    {
        return $this->getMaxAltitude() - $this->getFuelExpenditure();
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Avoid type-checking (part 1)

PHP is untyped, which means your functions can take any type of argument.
Sometimes you are bitten by this freedom and it becomes tempting to do
type-checking in your functions. There are many ways to avoid having to do this.
The first thing to consider is consistent APIs.

**Yomon:**

```php
declare(strict_types=1);

function travelToTexas($vehicle): void
{
    if ($vehicle instanceof Bicycle) {
        $vehicle->pedalTo(new Location('texas'));
    } elseif ($vehicle instanceof Car) {
        $vehicle->driveTo(new Location('texas'));
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function travelToTexas(Vehicle $vehicle): void
{
    $vehicle->travelTo(new Location('texas'));
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Avoid type-checking (part 2)

If you are working with basic primitive values like strings, integers, and arrays,
and you use PHP 7+ and you can't use polymorphism but you still feel the need to
type-check, you should consider
[type declaration](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration)
or strict mode. It provides you with static typing on top of standard PHP syntax.
The problem with manually type-checking is that doing it will require so much
extra verbiage that the faux "type-safety" you get doesn't make up for the lost
readability. Keep your PHP clean, write good tests, and have good code reviews.
Otherwise, do all of that but with PHP strict type declaration or strict mode.

**Yomon:**

```php
declare(strict_types=1);

function combine($val1, $val2): int
{
    if (! is_numeric($val1) || ! is_numeric($val2)) {
        throw new Exception('Must be of type Number');
    }

    return $val1 + $val2;
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function combine(int $val1, int $val2): int
{
    return $val1 + $val2;
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Remove dead code

Dead code is just as bad as duplicate code. There's no reason to keep it in
your codebase. If it's not being called, get rid of it! It will still be safe
in your version history if you still need it.

**Yomon:**

```php
declare(strict_types=1);

function oldRequestModule(string $url): void
{
    // ...
}

function newRequestModule(string $url): void
{
    // ...
}

$request = newRequestModule($requestUrl);
inventoryTracker('apples', $request, 'www.inventory-awesome.io');
```

**Yaxshi:**

```php
declare(strict_types=1);

function requestModule(string $url): void
{
    // ...
}

$request = requestModule($requestUrl);
inventoryTracker('apples', $request, 'www.inventory-awesome.io');
```

**[⬆ boshiga qaytish](#mundarija)**

## Objects and Data Structures

### Use object encapsulation

In PHP you can set `public`, `protected` and `private` keywords for methods.
Using it, you can control properties modification on an object.

- When you want to do more beyond getting an object property, you don't have
  to look up and change every accessor in your codebase.
- Makes adding validation simple when doing a `set`.
- Encapsulates the internal representation.
- Easy to add logging and error handling when getting and setting.
- Inheriting this class, you can override default functionality.
- You can lazy load your object's properties, let's say getting it from a
  server.

Additionally, this is part of [Open/Closed](#openclosed-principle-ocp) principle.

**Yomon:**

```php
declare(strict_types=1);

class BankAccount
{
    public $balance = 1000;
}

$bankAccount = new BankAccount();

// Buy shoes...
$bankAccount->balance -= 100;
```

**Yaxshi:**

```php
class BankAccount
{
    private $balance;

    public function __construct(int $balance = 1000)
    {
      $this->balance = $balance;
    }

    public function withdraw(int $amount): void
    {
        if ($amount > $this->balance) {
            throw new \Exception('Amount greater than available balance.');
        }

        $this->balance -= $amount;
    }

    public function deposit(int $amount): void
    {
        $this->balance += $amount;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }
}

$bankAccount = new BankAccount();

// Buy shoes...
$bankAccount->withdraw($shoesPrice);

// Get balance
$balance = $bankAccount->getBalance();
```

**[⬆ boshiga qaytish](#mundarija)**

### Make objects have private/protected members

- `public` methods and properties are most dangerous for changes, because some outside code may easily rely on them and you can't control what code relies on them. **Modifications in class are dangerous for all users of class.**
- `protected` modifier are as dangerous as public, because they are available in scope of any child class. This effectively means that difference between public and protected is only in access mechanism, but encapsulation guarantee remains the same. **Modifications in class are dangerous for all descendant classes.**
- `private` modifier guarantees that code is **dangerous to modify only in boundaries of single class** (you are safe for modifications and you won't have [Jenga effect](http://www.urbandictionary.com/define.php?term=Jengaphobia&defid=2494196)).

Therefore, use `private` by default and `public/protected` when you need to provide access for external classes.

For more informations you can read the [blog post](http://fabien.potencier.org/pragmatism-over-theory-protected-vs-private.html) on this topic written by [Fabien Potencier](https://github.com/fabpot).

**Yomon:**

```php
declare(strict_types=1);

class Employee
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$employee = new Employee('John Doe');
// Employee name: John Doe
echo 'Employee name: ' . $employee->name;
```

**Yaxshi:**

```php
declare(strict_types=1);

class Employee
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

$employee = new Employee('John Doe');
// Employee name: John Doe
echo 'Employee name: ' . $employee->getName();
```

**[⬆ boshiga qaytish](#mundarija)**

## Classes

### Prefer composition over inheritance

As stated famously in [_Design Patterns_](https://en.wikipedia.org/wiki/Design_Patterns) by the Gang of Four,
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

**Yomon:**

```php
declare(strict_types=1);

class Employee
{
    private $name;

    private $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    // ...
}

// Bad because Employees "have" tax data.
// EmployeeTaxData is not a type of Employee

class EmployeeTaxData extends Employee
{
    private $ssn;

    private $salary;

    public function __construct(string $name, string $email, string $ssn, string $salary)
    {
        parent::__construct($name, $email);

        $this->ssn = $ssn;
        $this->salary = $salary;
    }

    // ...
}
```

**Yaxshi:**

```php
declare(strict_types=1);

class EmployeeTaxData
{
    private $ssn;

    private $salary;

    public function __construct(string $ssn, string $salary)
    {
        $this->ssn = $ssn;
        $this->salary = $salary;
    }

    // ...
}

class Employee
{
    private $name;

    private $email;

    private $taxData;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function setTaxData(EmployeeTaxData $taxData): void
    {
        $this->taxData = $taxData;
    }

    // ...
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Avoid fluent interfaces

A [Fluent interface](https://en.wikipedia.org/wiki/Fluent_interface) is an object
oriented API that aims to improve the readability of the source code by using
[Method chaining](https://en.wikipedia.org/wiki/Method_chaining).

While there can be some contexts, frequently builder objects, where this
pattern reduces the verbosity of the code (for example the [PHPUnit Mock Builder](https://phpunit.de/manual/current/en/test-doubles.html)
or the [Doctrine Query Builder](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html)),
more often it comes at some costs:

1. Breaks [Encapsulation](https://en.wikipedia.org/wiki/Encapsulation_%28object-oriented_programming%29).
2. Breaks [Decorators](https://en.wikipedia.org/wiki/Decorator_pattern).
3. Is harder to [mock](https://en.wikipedia.org/wiki/Mock_object) in a test suite.
4. Makes diffs of commits harder to read.

For more informations you can read the full [blog post](https://ocramius.github.io/blog/fluent-interfaces-are-evil/)
on this topic written by [Marco Pivetta](https://github.com/Ocramius).

**Yomon:**

```php
declare(strict_types=1);

class Car
{
    private $make = 'Honda';

    private $model = 'Accord';

    private $color = 'white';

    public function setMake(string $make): self
    {
        $this->make = $make;

        // NOTE: Returning this for chaining
        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        // NOTE: Returning this for chaining
        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        // NOTE: Returning this for chaining
        return $this;
    }

    public function dump(): void
    {
        var_dump($this->make, $this->model, $this->color);
    }
}

$car = (new Car())
    ->setColor('pink')
    ->setMake('Ford')
    ->setModel('F-150')
    ->dump();
```

**Yaxshi:**

```php
declare(strict_types=1);

class Car
{
    private $make = 'Honda';

    private $model = 'Accord';

    private $color = 'white';

    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function dump(): void
    {
        var_dump($this->make, $this->model, $this->color);
    }
}

$car = new Car();
$car->setColor('pink');
$car->setMake('Ford');
$car->setModel('F-150');
$car->dump();
```

**[⬆ boshiga qaytish](#mundarija)**

### Prefer final classes

The `final` should be used whenever possible:

1. It prevents uncontrolled inheritance chain.
2. It encourages [composition](#prefer-composition-over-inheritance).
3. It encourages the [Single Responsibility Pattern](#single-responsibility-principle-srp).
4. It encourages developers to use your public methods instead of extending the class to get access on protected ones.
5. It allows you to change your code without any break of applications that use your class.

The only condition is that your class should implement an interface and no other public methods are defined.

For more informations you can read [the blog post](https://ocramius.github.io/blog/when-to-declare-classes-final/) on this topic written by [Marco Pivetta (Ocramius)](https://ocramius.github.io/).

**Yomon:**

```php
declare(strict_types=1);

final class Car
{
    private $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    /**
     * @return string The color of the vehicle
     */
    public function getColor()
    {
        return $this->color;
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

interface Vehicle
{
    /**
     * @return string The color of the vehicle
     */
    public function getColor();
}

final class Car implements Vehicle
{
    private $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

## SOLID

**SOLID** is the mnemonic acronym introduced by Michael Feathers for the first five principles named by Robert Martin, which meant five basic principles of object-oriented programming and design.

- [S: Single Responsibility Principle (SRP)](#single-responsibility-principle-srp)
- [O: Open/Closed Principle (OCP)](#openclosed-principle-ocp)
- [L: Liskov Substitution Principle (LSP)](#liskov-substitution-principle-lsp)
- [I: Interface Segregation Principle (ISP)](#interface-segregation-principle-isp)
- [D: Dependency Inversion Principle (DIP)](#dependency-inversion-principle-dip)

### Single Responsibility Principle (SRP)

As stated in Clean Code, "There should never be more than one reason for a class
to change". It's tempting to jam-pack a class with a lot of functionality, like
when you can only take one suitcase on your flight. The issue with this is
that your class won't be conceptually cohesive and it will give it many reasons
to change. Minimizing the amount of times you need to change a class is important.
It's important because if too much functionality is in one class and you modify a piece of it,
it can be difficult to understand how that will affect other dependent modules in
your codebase.

**Yomon:**

```php
declare(strict_types=1);

class UserSettings
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function changeSettings(array $settings): void
    {
        if ($this->verifyCredentials()) {
            // ...
        }
    }

    private function verifyCredentials(): bool
    {
        // ...
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

class UserAuth
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function verifyCredentials(): bool
    {
        // ...
    }
}

class UserSettings
{
    private $user;

    private $auth;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->auth = new UserAuth($user);
    }

    public function changeSettings(array $settings): void
    {
        if ($this->auth->verifyCredentials()) {
            // ...
        }
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Open/Closed Principle (OCP)

As stated by Bertrand Meyer, "software entities (classes, modules, functions,
etc.) should be open for extension, but closed for modification." What does that
mean though? This principle basically states that you should allow users to
add new functionalities without changing existing code.

**Yomon:**

```php
declare(strict_types=1);

abstract class Adapter
{
    protected $name;

    public function getName(): string
    {
        return $this->name;
    }
}

class AjaxAdapter extends Adapter
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'ajaxAdapter';
    }
}

class NodeAdapter extends Adapter
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'nodeAdapter';
    }
}

class HttpRequester
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function fetch(string $url): Promise
    {
        $adapterName = $this->adapter->getName();

        if ($adapterName === 'ajaxAdapter') {
            return $this->makeAjaxCall($url);
        } elseif ($adapterName === 'httpNodeAdapter') {
            return $this->makeHttpCall($url);
        }
    }

    private function makeAjaxCall(string $url): Promise
    {
        // request and return promise
    }

    private function makeHttpCall(string $url): Promise
    {
        // request and return promise
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

interface Adapter
{
    public function request(string $url): Promise;
}

class AjaxAdapter implements Adapter
{
    public function request(string $url): Promise
    {
        // request and return promise
    }
}

class NodeAdapter implements Adapter
{
    public function request(string $url): Promise
    {
        // request and return promise
    }
}

class HttpRequester
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function fetch(string $url): Promise
    {
        return $this->adapter->request($url);
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

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

**Yomon:**

```php
declare(strict_types=1);

class Rectangle
{
    protected $width = 0;

    protected $height = 0;

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getArea(): int
    {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle
{
    public function setWidth(int $width): void
    {
        $this->width = $this->height = $width;
    }

    public function setHeight(int $height): void
    {
        $this->width = $this->height = $height;
    }
}

function printArea(Rectangle $rectangle): void
{
    $rectangle->setWidth(4);
    $rectangle->setHeight(5);

    // BAD: Will return 25 for Square. Should be 20.
    echo sprintf('%s has area %d.', get_class($rectangle), $rectangle->getArea()) . PHP_EOL;
}

$rectangles = [new Rectangle(), new Square()];

foreach ($rectangles as $rectangle) {
    printArea($rectangle);
}
```

**Yaxshi:**

The best way is separate the quadrangles and allocation of a more general subtype for both shapes.

Despite the apparent similarity of the square and the rectangle, they are different.
A square has much in common with a rhombus, and a rectangle with a parallelogram, but they are not subtype.
A square, a rectangle, a rhombus and a parallelogram are separate shapes with their own properties, albeit similar.

```php
interface Shape
{
    public function getArea(): int;
}

class Rectangle implements Shape
{
    private $width = 0;
    private $height = 0;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea(): int
    {
        return $this->width * $this->height;
    }
}

class Square implements Shape
{
    private $length = 0;

    public function __construct(int $length)
    {
        $this->length = $length;
    }

    public function getArea(): int
    {
        return $this->length ** 2;
    }
}

function printArea(Shape $shape): void
{
    echo sprintf('%s has area %d.', get_class($shape), $shape->getArea()).PHP_EOL;
}

$shapes = [new Rectangle(4, 5), new Square(5)];

foreach ($shapes as $shape) {
    printArea($shape);
}
```

**[⬆ boshiga qaytish](#mundarija)**

### Interface Segregation Principle (ISP)

ISP states that "Clients should not be forced to depend upon interfaces that
they do not use."

A good example to look at that demonstrates this principle is for
classes that require large settings objects. Not requiring clients to set up
huge amounts of options is beneficial, because most of the time they won't need
all of the settings. Making them optional helps prevent having a "fat interface".

**Yomon:**

```php
declare(strict_types=1);

interface Employee
{
    public function work(): void;

    public function eat(): void;
}

class HumanEmployee implements Employee
{
    public function work(): void
    {
        // ....working
    }

    public function eat(): void
    {
        // ...... eating in lunch break
    }
}

class RobotEmployee implements Employee
{
    public function work(): void
    {
        //.... working much more
    }

    public function eat(): void
    {
        //.... robot can't eat, but it must implement this method
    }
}
```

**Yaxshi:**

Not every worker is an employee, but every employee is a worker.

```php
declare(strict_types=1);

interface Workable
{
    public function work(): void;
}

interface Feedable
{
    public function eat(): void;
}

interface Employee extends Feedable, Workable
{
}

class HumanEmployee implements Employee
{
    public function work(): void
    {
        // ....working
    }

    public function eat(): void
    {
        //.... eating in lunch break
    }
}

// robot can only work
class RobotEmployee implements Workable
{
    public function work(): void
    {
        // ....working
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

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

**Yomon:**

```php
declare(strict_types=1);

class Employee
{
    public function work(): void
    {
        // ....working
    }
}

class Robot extends Employee
{
    public function work(): void
    {
        //.... working much more
    }
}

class Manager
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function manage(): void
    {
        $this->employee->work();
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

interface Employee
{
    public function work(): void;
}

class Human implements Employee
{
    public function work(): void
    {
        // ....working
    }
}

class Robot implements Employee
{
    public function work(): void
    {
        //.... working much more
    }
}

class Manager
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function manage(): void
    {
        $this->employee->work();
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

## Don’t repeat yourself (DRY)

Try to observe the [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) principle.

Do your absolute best to avoid duplicate code. Duplicate code is bad because
it means that there's more than one place to alter something if you need to
change some logic.

Imagine if you run a restaurant and you keep track of your inventory: all your
tomatoes, onions, garlic, spices, etc. If you have multiple lists that
you keep this on, then all have to be updated when you serve a dish with
tomatoes in them. If you only have one list, there's only one place to update!

Often you have duplicate code because you have two or more slightly
different things, that share a lot in common, but their differences force you
to have two or more separate functions that do much of the same things. Removing
duplicate code means creating an abstraction that can handle this set of different
things with just one function/module/class.

Getting the abstraction right is critical, that's why you should follow the
SOLID principles laid out in the [Classes](#classes) section. Bad abstractions can be
worse than duplicate code, so be careful! Having said this, if you can make
a good abstraction, do it! Don't repeat yourself, otherwise you'll find yourself
updating multiple places any time you want to change one thing.

**Yomon:**

```php
declare(strict_types=1);

function showDeveloperList(array $developers): void
{
    foreach ($developers as $developer) {
        $expectedSalary = $developer->calculateExpectedSalary();
        $experience = $developer->getExperience();
        $githubLink = $developer->getGithubLink();
        $data = [$expectedSalary, $experience, $githubLink];

        render($data);
    }
}

function showManagerList(array $managers): void
{
    foreach ($managers as $manager) {
        $expectedSalary = $manager->calculateExpectedSalary();
        $experience = $manager->getExperience();
        $githubLink = $manager->getGithubLink();
        $data = [$expectedSalary, $experience, $githubLink];

        render($data);
    }
}
```

**Yaxshi:**

```php
declare(strict_types=1);

function showList(array $employees): void
{
    foreach ($employees as $employee) {
        $expectedSalary = $employee->calculateExpectedSalary();
        $experience = $employee->getExperience();
        $githubLink = $employee->getGithubLink();
        $data = [$expectedSalary, $experience, $githubLink];

        render($data);
    }
}
```

**Very good:**

It is better to use a compact version of the code.

```php
declare(strict_types=1);

function showList(array $employees): void
{
    foreach ($employees as $employee) {
        render([$employee->calculateExpectedSalary(), $employee->getExperience(), $employee->getGithubLink()]);
    }
}
```

**[⬆ boshiga qaytish](#mundarija)**

## Translations

This is also available in other languages:

- :cn: **Chinese:**
  - [php-cpm/clean-code-php](https://github.com/php-cpm/clean-code-php)
- :ru: **Russian:**
  - [peter-gribanov/clean-code-php](https://github.com/peter-gribanov/clean-code-php)
- :es: **Spanish:**
  - [fikoborquez/clean-code-php](https://github.com/fikoborquez/clean-code-php)
- :brazil: **Portuguese:**
  - [fabioars/clean-code-php](https://github.com/fabioars/clean-code-php)
  - [jeanjar/clean-code-php](https://github.com/jeanjar/clean-code-php/tree/pt-br)
- :thailand: **Thai:**
  - [panuwizzle/clean-code-php](https://github.com/panuwizzle/clean-code-php)
- :fr: **French:**
  - [errorname/clean-code-php](https://github.com/errorname/clean-code-php)
- :vietnam: **Vietnamese**
  - [viethuongdev/clean-code-php](https://github.com/viethuongdev/clean-code-php)
- :kr: **Korean:**
  - [yujineeee/clean-code-php](https://github.com/yujineeee/clean-code-php)
- :tr: **Turkish:**
  - [anilozmen/clean-code-php](https://github.com/anilozmen/clean-code-php)

**[⬆ boshiga qaytish](#mundarija)**
