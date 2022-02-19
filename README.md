# Clean Code PHP - uz

## Table of Contents

  1. [Kirish](#introduction)
  2. [Oʻzgaruvchilar](#variables)
     * [Ma'noli va talaffuz qilinadigan o'zgaruvchilar nomlaridan foydalaning](#use-meaningful-and-pronounceable-variable-names)
     * [Xuddi shu turdagi o'zgaruvchilar uchun bir xil lug'atdan foydalaning](#use-the-same-vocabulary-for-the-same-type-of-variable)
     * [Qidiriladigan nomlardan foydalaning (1-qism)](#use-searchable-names-part-1)
     * [Qidiriladigan nomlardan foydalaning (2-qism)](#use-searchable-names-part-2)
     * [Tushuntiruvchi o'zgaruvchilardan foydalaning](#use-explanatory-variables)
     * [Juda chuqur joylashdan saqlaning va erta qayting (1-qism)](#avoid-nesting-too-deeply-and-return-early-part-1)
     * [Juda chuqur joylashdan saqlaning va erta qayting (2-qism)](#avoid-nesting-too-deeply-and-return-early-part-2)
     * [Ruhiy xaritalashdan saqlaning](#avoid-mental-mapping)
     * [Keraksiz kontekstni qo'shmang](#dont-add-unneeded-context)
  3. [Taqqoslash](#comparison)
     * [Bir xil taqqoslashdan foydalaning](#use-identical-comparison)
     * [Null birlashtiruvchi operator](#null-coalescing-operator)
  4. [Funksiyalar](#functions)
     * [Qisqa tutashuv yoki shartli shartlar o'rniga standart argumentlardan foydalaning](#use-default-arguments-instead-of-short-circuiting-or-conditionals)
     * [Funktsiya argumentlari (ideal holda 2 yoki undan kam)](#function-arguments-2-or-fewer-ideally)
     * [Funktsiya nomlari nima qilishlarini ko'rsatishi kerak](#function-names-should-say-what-they-do)
     * [Funktsiyalar faqat mavhumlikning bir darajasi bo'lishi kerak](#functions-should-only-be-one-level-of-abstraction)
     * [Bayroqlarni funktsiya parametrlari sifatida ishlatmang](#dont-use-flags-as-function-parameters)
     * [Nojo'ya ta'sirlardan qoching](#avoid-side-effects)
     * [Global funktsiyalarga yozmang](#dont-write-to-global-functions)
     * [Singleton naqshini ishlatmang](#dont-use-a-singleton-pattern)
     * [Shartli gaplarni inkapsulyatsiya qilish](#encapsulate-conditionals)
     * [Salbiy shartlardan saqlaning](#avoid-negative-conditionals)
     * [Shartli shartlardan saqlaning](#avoid-conditionals)
     * [Turni tekshirishdan saqlaning (1-qism)](#avoid-type-checking-part-1)
     * [Turni tekshirishdan saqlaning (2-qism)](#avoid-type-checking-part-2)
     * [O'lik kodni olib tashlang](#remove-dead-code)
  5. [Ob'ektlar va ma'lumotlar tuzilmalari](#objects-and-data-structures)
     * [Ob'ektni inkapsulyatsiya qilishdan foydalaning](#use-object-encapsulation)
     * [Ob'ektlarni shaxsiy/himoyalangan a'zolarga ega qiling](#make-objects-have-privateprotected-members)
  6. [Sinflar](#classes)
     * [Merosdan ko'ra kompozitsiyani afzal ko'ring](#prefer-composition-over-inheritance)
     * [Ravon interfeyslardan saqlaning](#avoid-fluent-interfaces)
     * [Yakuniy darslarni afzal ko'ring](#prefer-final-classes)
  7. [SOLID](#solid)
     * [Yagona javobgarlik printsipi (SRP)](#single-responsibility-principle-srp)
     * [Ochiq/yopiq printsip (OCP)](#openclosed-principle-ocp)
     * [Liskov almashtirish printsipi (LSP)](#liskov-substitution-principle-lsp)
     * [Interfeysni ajratish printsipi (ISP)](#interface-segregation-principle-isp)
     * [Bog'liqlik inversiyasi printsipi (DIP)](#dependency-inversion-principle-dip)
  8. [O'zingizni takrorlamang (DRY)](#dont-repeat-yourself-dry)
  9. [Tarjimalar](#translations)

## Introduction

Robert C. Martinning kitobidan dasturiy ta'minot muhandisligi tamoyillari
[*Clean Code*](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882),
PHP uchun moslashtirilgan. Bu uslublar bo'yicha qo'llanma emas. Bu ishlab chiqarish uchun qo'llanma
PHP da o'qilishi mumkin bo'lgan, qayta ishlatilishi mumkin bo'lgan va qayta tiklanadigan dasturiy ta'minot.

Bu erda har bir tamoyilga qat'iy rioya qilish shart emas, va undan ham ozrog'i universal bo'ladi
kelishilgan. Bu ko'rsatmalar va boshqa hech narsa emas, lekin ular ko'pchilik uchun kodlangan
*Clean Code* mualliflarining ko'p yillik jamoaviy tajribasi.

[clean-code-javascript](https://github.com/ryanmcdermott/clean-code-javascript)dan ilhomlangan.

Garchi ko'pgina ishlab chiquvchilar hali ham PHP 5 dan foydalanishsa ham, ushbu maqoladagi misollarning aksariyati faqat PHP 7.1+ bilan ishlaydi.

## o'zgaruvchilar

### Ma'noli va talaffuz qilinadigan o'zgaruvchilar nomlaridan foydalaning

**Yomon:**

```php
$ymdstr = $moment->format('y-m-d');
```

**Yaxshi:**

```php
$currentDate = $moment->format('y-m-d');
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Use the same vocabulary for the same type of variable

**Yomon:**

```php
getUserInfo();
getUserData();
getUserRecord();
getUserProfile();
```

**Yaxshi:**

```php
getUser();
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Qidiriladigan nomlardan foydalaning (1-qism)

Biz yozganimizdan ko'ra ko'proq kodni o'qiymiz. Muhimi, biz yozadigan kod
o'qish va qidirish mumkin. Ma'noli bo'lgan o'zgaruvchilarni * nomlash orqali
dasturimizni tushunib, biz o'quvchilarimizga zarar yetkazamiz.
Ismlaringizni qidirish mumkin bo'lsin.
**Yomon:**

```php
// What the heck is 448 for?
$result = $serializer->serialize($data, 448);
```

**Yaxshi:**

```php
$json = $serializer->serialize($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

### Use searchable names (part 2)

**Yomon:**

```php
class User
{
    // What the heck is 7 for?
    public $access = 7;
}

// What the heck is 4 for?
if ($user->access & 4) {
    // ...
}

// What's going on here?
$user->access ^= 2;
```

**Yaxshi:**

```php
class User
{
    public const ACCESS_READ = 1;

    public const ACCESS_CREATE = 2;

    public const ACCESS_UPDATE = 4;

    public const ACCESS_DELETE = 8;

    // User as default can read, create and update something
    public $access = self::ACCESS_READ | self::ACCESS_CREATE | self::ACCESS_UPDATE;
}

if ($user->access & User::ACCESS_UPDATE) {
    // do edit ...
}

// Deny access rights to create something
$user->access ^= User::ACCESS_CREATE;
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Use explanatory variables

**Yomon:**

```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches[1], $matches[2]);
```

**Yomon emas:**

Bu yaxshiroq, lekin biz hali ham regexga juda bog'liqmiz.

```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

[, $city, $zipCode] = $matches;
saveCityZipCode($city, $zipCode);
```

**Yaxshi:**

Pastki naqshlarni nomlash orqali regexga bog'liqlikni kamaytiring.

```php
$address = 'Bitta cheksiz pastadir, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(?<city>.+?)\s*(?<zipCode>\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches['city'], $matches['zipCode']);
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Juda chuqur joylashdan saqlaning va erta qayting (1-qism)

Ko'p if-else iboralari kodingizga amal qilishni qiyinlashtirishi mumkin. Aniqroq
yashirindan ko'ra.

**Yomon:**

```php
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
function isShopOpen(string $day): bool
{
    if (empty($day)) {
        return false;
    }

    $openingDays = ['friday', 'saturday', 'sunday'];

    return in_array(strtolower($day), $openingDays, true);
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Avoid nesting too deeply and return early (part 2)

**Yomon:**

```php
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
    return 'Qo\'llab-quvvatlanmaydi';
}
```

**Yaxshi:**

```php
function fibonacci(int $n): int
{
    if ($n === 0 || $n === 1) {
        return $n;
    }

    if ($n >= 50) {
        throw new Exception('Qo\'llab-quvvatlanmaydi');
    }

    return fibonacci($n - 1) + fibonacci($n - 2);
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Ruhiy xaritalashdan saqlaning

Kod o'quvchini o'zgaruvchi nimani anglatishini tarjima qilishga majburlamang.
Yopiqdan ko'ra ochiq-oydin.

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
    // Wait, what is `$li` for again?
    dispatch($li);
}
```

**Yaxshi:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Keraksiz kontekstni qo'shmang

Agar sizning sinfingiz/ob'ekt nomi sizga biror narsa aytsa, buni o'zingizning sinfingizda takrorlamang
o'zgaruvchan nomi.

**Yomon:**

```php
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
class Car
{
    public $make;

    public $model;

    public $color;

    //...
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**
## Taqqoslash

### [bir xil taqqoslash] (http://php.net/manual/en/language.operators.comparison.php)dan foydalaning

**Yaxshi emas:**

Oddiy taqqoslash qatorni butun songa aylantiradi.

```php
$a = '42';
$b = 42;

if ($a != $b) {
    // The expression will always pass
}
```
Taqqoslash `$a != $b` `FALSE`ni qaytaradi, lekin aslida bu `TRUE`!
`42` qatori `42` butun sonidan farq qiladi.

**Yaxshi:**

Xuddi shunday taqqoslash turi va qiymatini taqqoslaydi.

```php
$a = '42';
$b = 42;

if ($a !== $b) {
    // ifoda tasdiqlandi
}
```

`$a !== $b` taqqoslash `TRUE`ni qaytaradi.

**[⬆ Tepaga qaytish](#table-of-contents)**

### Null coalescing operator

Null coalescing - bu yangi operator [PHP 7 da kiritilgan](https://www.php.net/manual/en/migration70.new-features.php). Nol birlashtiruvchi operator `??` `isset()` bilan birgalikda uchlikdan foydalanish zarurati uchun sintaktik shakar sifatida qo`shilgan. Agar u mavjud bo'lsa va "null" bo'lmasa, u o'zining birinchi operandini qaytaradi; aks holda u ikkinchi operandni qaytaradi.

**Yomon:**

```php
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
$name = $_GET['name'] ?? $_POST['name'] ?? 'nobody';
```

**[⬆ Tepaga qaytish](#table-of-contents)**

## Funktsiyalar

### Qisqa tutashuv yoki shartli shartlar o'rniga standart argumentlardan foydalaning

**Yaxshi emas:**

Bu yaxshi emas, chunki `$breweryName` `NULL` bo`lishi mumkin.

```php
function createMicrobrewery($breweryName = 'Hipster Brew Co.'): void
{
    // ...
}
```
**Yomon emas:**

Bu fikr oldingi versiyadan ko'ra tushunarli, ammo u o'zgaruvchining qiymatini yaxshiroq nazorat qiladi.

```php
function createMicrobrewery($name = null): void
{
    $breweryName = $name ?: 'Hipster Brew Co.';
    // ...
}
```

**Yaxshi:**



 Siz [type hinting](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration) dan foydalanishingiz mumkin va `$breweryName` `NULL` bo'lmasligiga ishonch hosil qilishingiz mumkin.

```php
function createMicrobrewery(string $breweryName = 'Hipster Brew Co.'): void
{
    // ...
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Funktsiya argumentlari (ideal holda 2 yoki undan kam)

Funktsiya parametrlarining miqdorini cheklash juda muhim, chunki u qiladi
funktsiyangizni sinab ko'rish osonroq. Uchdan ortiq bo'lsa, kombinat portlashiga olib keladi
bu erda har bir alohida argument bilan tonnalab turli holatlarni sinab ko'rishingiz kerak.

Nol argumentlar ideal holatdir. Bir yoki ikkita argument to'g'ri va uchtadan qochish kerak.
Bundan ko'proq narsa birlashtirilishi kerak. Odatda, agar sizda ikkitadan ortiq bo'lsa
argumentlar bo'lsa, sizning funktsiyangiz juda ko'p narsa qilishga harakat qilmoqda. Bunday bo'lmagan hollarda, ko'pchilik
argument sifatida yuqori darajadagi ob'ekt etarli bo'ladi.

**Yomon:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Function names should say what they do

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
// Bu nima? Xabar uchun tutqich? Endi biz faylga yozyapmizmi?
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
// Aniq va ravshan
$message->send();
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Funksiyalar faqat mavhumlikning bir darajasi bo'lishi kerak

Agar sizda bir nechta mavhumlik darajasi bo'lsa, sizning funksiyangiz odatda bo'ladi
juda ko'p qilish. Funktsiyalarni bo'lish qayta foydalanishga va osonroq foydalanishga olib keladi
sinovdan o'tkazish.

**Yomon:**

```php
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

**Yomon ham:**

Biz baʼzi funksiyalarni bajardik, biroq “parseBetterPHPAalternative()” funksiyasi hali ham juda murakkab va sinovdan oʻtkazilmaydi.

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

Eng yaxshi yechim `parseBetterPHPAalternative()` funksiyasiga bog‘liqliklarni olib tashlashdir.

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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Bayroqlarni funksiya parametrlari sifatida ishlatmang

Bayroqlar foydalanuvchiga bu funksiya bir nechta ishni bajarishini bildiradi. Funktsiyalar kerak
bir narsa qiling. Funktsiyalaringizni turli kod yo'llari bo'yicha bo'lsa, ajrating
booleanga asoslanadi.

**Yomon:**

```php
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
function createFile(string $name): void
{
    touch($name);
}

function createTempFile(string $name): void
{
    touch('./temp/' . $name);
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Nojo'ya ta'sirlardan saqlaning

Funksiya va ichida qiymat olishdan boshqa biror narsa qilsa, yon ta'sir hosil qiladi
boshqa qiymat yoki qiymatlarni qaytaring. Yon ta'sir faylga yozish, o'zgartirish bo'lishi mumkin
ba'zi global o'zgaruvchi, yoki tasodifan barcha pulingizni begonaga ulash.

Endi, vaqti-vaqti bilan dasturda nojo'ya ta'sirlarga ega bo'lishingiz kerak. Oldingi kabi
masalan, faylga yozishingiz kerak bo'lishi mumkin. Siz nima qilmoqchi bo'lsangiz, qaerda markazlashtirish
siz buni qilyapsiz. Muayyanga yozadigan bir nechta funksiya va sinflarga ega bo'lmang
fayl. Buni amalga oshiradigan bitta xizmatga ega bo'ling. Bitta va yagona.

Asosiy nuqta, ob'ektlar orasidagi holatni almashish kabi umumiy tuzoqlardan qochishdir
har qanday tuzilma, har qanday narsa tomonidan yozilishi mumkin bo'lgan o'zgaruvchan ma'lumotlar turlaridan foydalangan holda
nojo'ya ta'sirlaringiz sodir bo'ladigan joyni markazlashtirish. Agar buni qila olsangiz, baxtliroq bo'lasiz
boshqa dasturchilarning aksariyatiga qaraganda.

**Yomon:**

```php
// Global o'zgaruvchiga quyidagi funktsiya tomonidan havola qilingan.
// Agar bizda bu nomdan foydalanadigan boshqa funksiya bo'lsa, endi u massiv bo'lardi va uni buzishi mumkin edi.

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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Global funksiyalarga yozmang

Globallarni ifloslantirish ko'p tillarda yomon amaliyotdir, chunki siz boshqa til bilan to'qnashishingiz mumkin
kutubxona va sizning API foydalanuvchisi istisnoga duch kelmaguncha aqlli bo'lmaydi
ishlab chiqarish. Keling, bir misol haqida o'ylab ko'raylik: agar siz konfiguratsiya qatoriga ega bo'lishni istasangiz nima bo'ladi?
Siz `config()` kabi global funktsiyani yozishingiz mumkin, lekin u boshqa kutubxona bilan to'qnash kelishi mumkin
xuddi shu narsani qilishga harakat qilgan.
**Yomon:**

```php
function config(): array
{
    return [
        'foo' => 'bar',
    ];
}
```

**Yaxshi:**

```php
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

Konfiguratsiyani yuklang va "Configuration" klassining namunasini yarating

```php
$configuration = new Configuration([
    'foo' => 'bar',
]);
```

And now you must use instance of `Configuration` in your application.

**[⬆ Tepaga qaytish](#table-of-contents)**

### Don't use a Singleton pattern

Singleton - bu [naqshga qarshi](https://en.wikipedia.org/wiki/Singleton_pattern). Brayan Buttondan tarjima qilingan:
  1. Ular odatda **global misol** sifatida ishlatiladi, nega bu juda yomon? Chunki **siz ilovangizning bog'liqliklarini** interfeyslar orqali ochish o'rniga, kodingizda yashirasiz. Biror narsani o'tkazib yubormaslik uchun uni global qilish [kod hidi](https://en.wikipedia.org/wiki/Code_smell).
 2. Ular [yagona javobgarlik printsipini](#single-responsibility-principle-srp) buzadilar: **o'z yaratilishi va hayot aylanishini** o'zlari nazorat qilishlari sababli.
 3. Ular tabiatan kodni mahkam bog'lashga olib keladi [juft](https://en.wikipedia.org/wiki/Coupling_%28computer_programming%29). Bu ko'p hollarda ularni **sinov ostida soxtalashtirishni qiyinlashtiradi**.
  4. Ular ilovaning butun umri davomida holatni olib yuradi. Sinov uchun yana bir zarba, chunki **siz sinovlarga buyurtma berish kerak bo'lgan vaziyatga duch kelishingiz mumkin** bu birlik testlari uchun katta yo'q. Nega? Chunki har bir birlik testi boshqasidan mustaqil bo'lishi kerak.

[Misko Hevery](http://misko.hevery.com/about/) tomonidan [muammoning ildizi](http://misko.hevery.com/2008/08/25/root-cause-of-singletons/) haqida juda yaxshi fikrlar ham bor..

**Yomon:**

```php
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
class DBConnection
{
    public function __construct(string $dsn)
    {
        // ...
    }

    // ...
}
```

`DBConnection` klassi namunasini yarating va uni [DSN](http://php.net/manual/en/pdo.construct.php#refsect1-pdo.construct-parameters) bilan sozlang.

```php
$connection = new DBConnection($dsn);
```

Endi siz ilovangizda `DBConnection` misolidan foydalanishingiz kerak.

**[⬆ Tepaga qaytish](#table-of-contents)**

### Shartli gaplarni inkapsulyatsiya qiling

**Yomon:**

```php
if ($article->state === 'published') {
    // ...
}
```

**Yaxshi:**

```php
if ($article->isPublished()) {
    // ...
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Salbiy shartlardan saqlaning

**Yomon:**

```php
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
function isDOMNodePresent(DOMNode $node): bool
{
    // ...
}

if (isDOMNodePresent($node)) {
    // ...
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Shartli so'zlardan saqlaning

Bu imkonsiz vazifaga o'xshaydi. Buni birinchi eshitgan ko'pchilik shunday deyishadi:
"Qanday qilib men "if" iborasisiz biror narsa qilishim kerak?" Javob shunday
ko'p hollarda bir xil vazifaga erishish uchun polimorfizmdan foydalanishingiz mumkin. Ikkinchisi
Odatda savol: "Bu juda zo'r, lekin nega men buni qilishni xohlayman?" The
javob - bu biz o'rgangan oldingi toza kod tushunchasi: funktsiya faqat bajarishi kerak
bir narsa. Agar sizda "if" iboralari mavjud bo'lgan sinflar va funktsiyalar mavjud bo'lsa, siz
foydalanuvchiga sizning funksiyangiz bir nechta narsani qilishini aytmoqda. Eslab qoling,
faqat bitta narsani qiling.


**Yomon:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Turni tekshirishdan saqlaning (1-qism)

PHP yozilmagan, bu sizning funksiyalaringiz har qanday turdagi argumentlarni qabul qilishi mumkinligini anglatadi.
Ba'zida bu erkinlik sizni tishlab oladi va u qilish istagi paydo bo'ladi
funksiyalaringizni turini tekshirish. Buni qilishdan qochishning ko'plab usullari mavjud.
Ko'rib chiqilishi kerak bo'lgan birinchi narsa - izchil API.

**Yomon:**

```php
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
function travelToTexas(Vehicle $vehicle): void
{
    $vehicle->travelTo(new Location('texas'));
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### Turni tekshirishdan saqlaning (2-qism)

Agar siz satrlar, butun sonlar va massivlar kabi asosiy ibtidoiy qiymatlar bilan ishlayotgan bo'lsangiz,
va siz PHP 7+ dan foydalanasiz va siz polimorfizmdan foydalana olmaysiz, lekin siz hali ham bunga ehtiyoj sezasiz turini tekshirish, siz o'ylab ko'rishingiz kerak
[type declaration](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration)
yoki qattiq rejim. U standart PHP sintaksisi ustiga statik yozishni ta'minlaydi.
Turni qo'lda tekshirish bilan bog'liq muammo shundaki, uni bajarish juda ko'p narsani talab qiladi
qo'shimcha so'zlar siz olgan soxta "turi-xavfsizlik" yo'qolgan o'rnini bosmaydi
o'qish qobiliyati. PHP-ni toza tuting, yaxshi testlar yozing va yaxshi kod sharhlariga ega bo'ling.
Aks holda, bularning barchasini PHP qattiq turdagi deklaratsiya yoki qat'iy rejim bilan bajaring.

**Yomon:**

```php
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
function combine(int $val1, int $val2): int
{
    return $val1 + $val2;
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

### O'lik kodni olib tashlang

O'lik kod ikki nusxadagi kod kabi yomon. Uni saqlash uchun hech qanday sabab yo'q
sizning kod bazangiz. Agar u chaqirilmasa, undan qutuling! Bu hali ham xavfsiz bo'ladi
Agar sizga hali ham kerak bo'lsa, versiyalar tarixida.

**Yomon:**

```php
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
function requestModule(string $url): void
{
    // ...
}

$request = requestModule($requestUrl);
inventoryTracker('apples', $request, 'www.inventory-awesome.io');
```

**[⬆ Tepaga qaytish](#table-of-contents)**


## Ob'ektlar va ma'lumotlar tuzilmalari

### Obyekt inkapsulyatsiyasidan foydalaning

PHPda usullar uchun `public`, `protected` va `private` kalit soʻzlarni oʻrnatishingiz mumkin.
Undan foydalanib, siz ob'ektning xususiyatlarini o'zgartirishni boshqarishingiz mumkin.

* Ob'ekt xususiyatini olishdan tashqari ko'proq narsani qilishni xohlasangiz, sizda yo'q
kod bazangizdagi har bir aksessuarni qidirish va o'zgartirish uchun.
* “To‘plam”ni bajarishda tekshirishni qo‘shishni osonlashtiradi.
* Ichki vakillikni qamrab oladi.
* Qabul qilish va sozlashda jurnalni qo'shish va xatolarni boshqarish oson.
* Ushbu sinfni meros qilib olgan holda siz standart funksiyani bekor qilishingiz mumkin.
* Ob'ektingizning xususiyatlarini dangasa yuklashingiz mumkin, aytaylik, uni a dan oling
server.

Bundan tashqari, bu [Open/Closed](#openclosed-principle-ocp) tamoyilining bir qismidir.

**Yomon:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Make objects have private/protected members

* `public` usullar va xususiyatlar o'zgarishlar uchun eng xavflidir, chunki ba'zi tashqi kodlar ularga osongina tayanishi mumkin va siz ularga qanday kod tayanishini nazorat qila olmaysiz. **Sinfdagi o‘zgartirishlar sinfning barcha foydalanuvchilari uchun xavflidir.**
* `protected` modifikatorlar ommaviy kabi xavflidir, chunki ular har qanday bolalar sinfi doirasida mavjud. Bu shuni anglatadiki, ommaviy va himoyalangan o'rtasidagi farq faqat kirish mexanizmida, lekin inkapsulyatsiya kafolati bir xil bo'lib qoladi. **Sinfdagi o‘zgarishlar barcha avlod sinflari uchun xavflidir.**
* `private` modifikator kodni **faqat bitta sinf chegaralarida o'zgartirish xavfli ekanligini kafolatlaydi** (siz o'zgartirishlar uchun xavfsizsiz va sizda [Jenga effekti](http://www.urbandictionary.com/define.php?term=Jengaphobia&defid=2494196) bo'lmaydi).

Shuning uchun, tashqi sinflarga kirishni ta'minlash uchun sukut bo'yicha `private` va `public/protected` dan foydalaning.

For more information you can read the [blog post](http://fabien.potencier.org/pragmatism-over-theory-protected-vs-private.html) on this topic written by [Fabien Potencier](https://github.com/fabpot).

Qo'shimcha ma'lumot olish uchun siz [Fabien Potencier](https://github.com/fabpot) tomonidan yozilgan ushbu mavzu bo'yicha [blog postini](http://fabien.potencier.org/pragmatism-over-theory-protected-vs-private.html) o'qishingiz mumkin .

**Yomon:**

```php
class Employee
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$employee = new Employee('John Doe');
// Xodimning ismi: Jon Doe

echo 'Employee name: ' . $employee->name;
```

**Yaxshi:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

## Darslar

### Merosdan ko'ra kompozitsiyani afzal ko'ring

Gang of Four tomonidan [*Dizayn Naqshlari*](https://en.wikipedia.org/wiki/Design_Patterns) da mashhur bo'lganidek,
iloji bo'lsa, merosdan ko'ra kompozitsiyani afzal ko'rishingiz kerak. Ko'p bor
merosdan foydalanish uchun yaxshi sabablar va kompozitsiyadan foydalanish uchun juda ko'p yaxshi sabablar.
Ushbu maksimning asosiy nuqtasi shundaki, agar sizning fikringiz instinktiv ravishda harakat qilsa
meros, kompozitsiya muammoingizni yaxshiroq modellashtirishi mumkinmi, deb o'ylashga harakat qiling. Ba'zilarida
mumkin bo'lgan hollarda.

O'shanda siz "qachon merosdan foydalanishim kerak?" deb hayron bo'lishingiz mumkin. Bu
Sizning muammoingizga bog'liq, ammo bu meros qachon bo'lganining munosib ro'yxati
kompozitsiyadan ko'ra ko'proq ma'noga ega:

1. Merosingiz "has-a" emas, balki "is-a" munosabatlarini ifodalaydi
munosabatlari (Odam->Hayvon va boshqalar. Foydalanuvchi->UserDetails).
2. Siz asosiy sinflardan kodni qayta ishlatishingiz mumkin (odamlar barcha hayvonlar kabi harakatlanishi mumkin).
3. Asosiy sinfni o'zgartirish orqali olingan sinflarga global o'zgarishlar kiritmoqchisiz.
(Hamma hayvonlar harakatlanayotganda kaloriya sarfini o'zgartiring).
**Yomon:**

```php
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

// Yomon, chunki xodimlar soliq ma'lumotlariga ega.
// EmployeeTaxData xodimning bir turi emas

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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Ravon interfeyslardan saqlaning

[Fluent interfeysi](https://en.wikipedia.org/wiki/Fluent_interface) ob'ektdir.
foydalanish orqali manba kodining o'qilishini yaxshilashga qaratilgan yo'naltirilgan API
[Usul zanjiri](https://en.wikipedia.org/wiki/Method_chaining).

Ba'zi kontekstlar bo'lishi mumkin bo'lsa-da, tez-tez quruvchi ob'ektlar, bu erda
naqsh kodning aniqligini kamaytiradi (masalan, [PHPUnit Mock Builder](https://phpunit.de/manual/current/en/test-doubles.html) yoki [Doctrine Query Builder](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html)), ko'pincha bu ba'zi xarajatlarga to'g'ri keladi:


1. [Encapsulation](https://en.wikipedia.org/wiki/Encapsulation_%28object-oriented_programming%29) buziladi.
2. Tanaffuslar [Dekoratorlar](https://en.wikipedia.org/wiki/Decorator_pattern).
3. Test to'plamida [masxara](https://en.wikipedia.org/wiki/Mock_object) qiyinroq.
4. Farqlarni o‘qishni qiyinlashtiradi.

Qo'shimcha ma'lumot olish uchun to'liq [blog postini](https://ocramius.github.io/blog/fluent-interfaces-are-evil/) o'qishingiz mumkin.
bu mavzuda [Marko Pivetta](https://github.com/Ocramius) tomonidan yozilgan.


**Yomon:**

```php
class Car
{
    private $make = 'Honda';

    private $model = 'Accord';

    private $color = 'white';

    public function setMake(string $make): self
    {
        $this->make = $make;

       // QAYD: Buni zanjirband qilish uchun qaytaring
        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

       // QAYD: Buni zanjirband qilish uchun qaytaring
        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

       // QAYD: Buni zanjirband qilish uchun qaytaring
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Yakuniy darslarni afzal ko'ring

"Yakuniy" kalit so'zidan iloji boricha foydalanish kerak:

1. Nazoratsiz meros zanjirining oldini oladi.
2. [kompozitsiyani] (#prefer-composition-over-meros) rag'batlantiradi.
3. U [Yagona javobgarlik printsipi](#single-responsibility-principle-srp)ni rag'batlantiradi.
4. U ishlab chiquvchilarni himoyalanganlarga kirish uchun sinfni kengaytirish o'rniga sizning umumiy usullaringizdan foydalanishga undaydi.
5. Bu sizning sinfingizdan foydalanadigan ilovalarni buzmasdan kodingizni o'zgartirishga imkon beradi.

Yagona shart shundaki, sizning sinfingiz interfeysni amalga oshirishi kerak va boshqa umumiy usullar aniqlanmagan.

Qo'shimcha ma'lumot olish uchun siz [Marko Pivetta Ocramius](https://ocramius.github.io/) tomonidan yozilgan [blog postini](https://ocramius.github.io/blog/when-to-declare-classes-final/) o'qishingiz mumkin .

**Yomon:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

## SOLID

**SOLID** - bu Robert Martin tomonidan atalgan birinchi besh tamoyil uchun Maykl Feathers tomonidan kiritilgan mnemonik qisqartma bo'lib, u ob'ektga yo'naltirilgan dasturlash va dizaynning beshta asosiy tamoyilini bildiradi.

  * [S: Yagona javobgarlik printsipi (SRP)](#single-responsibility-principle-srp)
  * [O: ochiq/yopiq printsip (OCP)](#openclosed-printsip-ocp)
  * [L: Liskov almashtirish printsipi (LSP)](#liskov-substitution-principle-lsp)
  * [I: Interfeysni ajratish printsipi (ISP)](#interfeys-segregatsiya-prinsipi-isp)
  * [D: Bog'liqlik inversiyasi printsipi (DIP)](#dependency-inversion-principle-dip)

### Yagona javobgarlik printsipi (SRP)

Toza Kodekda aytilganidek, "Sinf uchun hech qachon bir nechta sabab bo'lmasligi kerak
o'zgartirish". Bu kabi ko'plab funksiyalarga ega bo'lgan sinfni jamlash vasvasasi
parvozingizda faqat bitta chamadon olishingiz mumkin bo'lganda. Bu bilan bog'liq masala
Sizning sinfingiz kontseptual jihatdan birlashtirilgan bo'lmaydi va bu unga ko'p sabablarni beradi
tuzatmoq. Sinfni o'zgartirishingiz kerak bo'lgan vaqtni minimallashtirish muhimdir.
Bu juda muhim, chunki bitta sinfda juda ko'p funksiya mavjud bo'lsa va siz uning bir qismini o'zgartirsangiz,
bu boshqa bog'liq modullarga qanday ta'sir qilishini tushunish qiyin bo'lishi mumkin
sizning kod bazangiz.

**Yomon:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Ochiq/yopiq printsip (OCP)

Bertran Meyer ta'kidlaganidek, "dasturiy ta'minot ob'ektlari (sinflar, modullar, funktsiyalar,
va hokazo) kengaytirish uchun ochiq bo'lishi kerak, lekin o'zgartirish uchun yopiq bo'lishi kerak." Bu nima qiladi
degani? Bu tamoyil asosan foydalanuvchilarga ruxsat berish kerakligini bildiradi
mavjud kodni o'zgartirmasdan yangi funksiyalarni qo'shing.

**Yomon:**

```php
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
        // so'rash va qaytarish va'dasi
    }

    private function makeHttpCall(string $url): Promise
    {
        // so'rash va qaytarish va'dasi
    }
}
```

**Yaxshi:**

```php
interface Adapter
{
    public function request(string $url): Promise;
}

class AjaxAdapter implements Adapter
{
    public function request(string $url): Promise
    {
        // so'rash va qaytarish va'dasi
    }
}

class NodeAdapter implements Adapter
{
    public function request(string $url): Promise
    {
        // so'rash va qaytarish va'dasi
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Liskov almashtirish printsipi (LSP)

Bu juda oddiy tushuncha uchun qo'rqinchli atama. Bu rasmiy ravishda "Agar S
T ning kichik turi bo'lsa, u holda T tipidagi ob'ektlar S tipidagi ob'ektlar bilan almashtirilishi mumkin
(ya'ni, S tipidagi ob'ektlar T tipidagi ob'ektlarni almashtirishi mumkin) hech qanday o'zgarmasdan
ushbu dasturning kerakli xususiyatlari (to'g'riligi, bajarilgan vazifa,
va hokazo)." Bu yanada dahshatli ta'rif.

Buning eng yaxshi tushuntirishi, agar sizda ota-onalar sinfi va bolalar sinfi bo'lsa,
u holda asosiy sinf va bola sinfini olinmasdan bir-birining o'rnida ishlatish mumkin
noto'g'ri natijalar. Bu hali ham chalkash bo'lishi mumkin, shuning uchun keling, buni ko'rib chiqaylik
Klassik Kvadrat-To'rtburchak misoli. Matematik jihatdan kvadrat to'rtburchak, lekin
Agar siz uni meros orqali "is-a" munosabatidan foydalanib model qilsangiz, siz tezda
muammoga duch kelish.

**Yomon:**

```php
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

Eng yaxshi usul - to'rtburchaklarni ajratish va ikkala shakl uchun umumiyroq kichik turni ajratish.

Kvadrat va to'rtburchakning ko'rinadigan o'xshashligiga qaramay, ular bir-biridan farq qiladi.
Kvadrat romb va parallelogramm bilan to'rtburchaklar bilan juda ko'p umumiyliklarga ega, ammo ular kichik turlar emas.
Kvadrat, to'rtburchak, romb va parallelogramm o'xshash bo'lsa-da, o'ziga xos xususiyatlarga ega bo'lgan alohida shakllardir.

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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Interfeysni ajratish printsipi (ISP)

ISPning ta'kidlashicha, "mijozlarni interfeyslarga bog'lanishga majburlamaslik kerak
foydalanmaydilar."

Ko'rib chiqish uchun yaxshi misol bu tamoyilni ko'rsatadi
katta sozlamalar ob'ektlarini talab qiladigan sinflar. Mijozlardan sozlashni talab qilmaydi
katta hajmdagi variantlar foydalidir, chunki ko'pincha ularga kerak bo'lmaydi
barcha sozlamalar. Ularni ixtiyoriy qilish "yog'li interfeys" ga ega bo'lishni oldini olishga yordam beradi.


**Yomon:**

```php
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

Har bir ishchi xodim emas, lekin har bir xodim ishchi.

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

### Bog'liqlik inversiyasi printsipi (DIP)

Ushbu tamoyil ikkita muhim narsani belgilaydi:
1. Yuqori darajadagi modullar past darajadagi modullarga bog'liq bo'lmasligi kerak. Ikkalasi ham kerak
abstraksiyalarga bog‘liq.
2. Abstraktsiyalar tafsilotlarga bog'liq bo'lmasligi kerak. Tafsilotlar quyidagilarga bog'liq bo'lishi kerak
abstraktsiyalar.

Avvaliga buni tushunish qiyin bo'lishi mumkin, lekin agar siz PHP ramkalari (masalan, Symfony) bilan ishlagan bo'lsangiz, bu tamoyilning qaramlik ko'rinishida amalga oshirilishini ko'rgansiz.
In'ektsiya (DI). Ular bir xil tushunchalar bo'lmasa-da, DIP yuqori darajada saqlanadi
modullari uning past darajadagi modullari tafsilotlarini bilish va ularni sozlash.
Buni DI orqali amalga oshirishi mumkin. Buning katta foydasi shundaki, u kamayadi
modullar orasidagi ulanish. Bog'lanish juda yomon rivojlanish namunasidir, chunki
bu sizning kodingizni qayta ishlashni qiyinlashtiradi.

**Yomon:**

```php
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

**[⬆ Tepaga qaytish](#table-of-contents)**

## O'zingizni takrorlamang (QURUQ)

[DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) tamoyiliga rioya qilishga harakat qiling.

Ikki nusxadagi kodni oldini olish uchun qo'lingizdan kelganini qiling. Ikki nusxadagi kod yomon, chunki
Agar kerak bo'lsa, biror narsani o'zgartirish uchun bir nechta joy borligini anglatadi
ba'zi mantiqni o'zgartiring.

Tasavvur qiling-a, agar siz restoran ishlasangiz va inventarizatsiyangizni kuzatib borsangiz: hammasi sizning
pomidor, piyoz, sarimsoq, ziravorlar va boshqalar. Agar sizda bir nechta ro'yxat mavjud bo'lsa
Buni davom ettirasiz, keyin taomga xizmat qilganingizda hammasi yangilanishi kerak
ulardagi pomidor. Agar sizda faqat bitta ro'yxat bo'lsa, yangilanish uchun faqat bitta joy bor!

Ko'pincha sizda ikki nusxadagi kod bor, chunki sizda ikkita yoki undan ko'p bir oz
turli xil narsalar, ular juda ko'p umumiyliklarga ega, ammo ularning farqlari sizni majbur qiladi
bir xil ishlarni bajaradigan ikki yoki undan ortiq alohida funktsiyalarga ega bo'lish. O'chirish
dublikat kod bu turli xil to'plamlarni boshqara oladigan abstraktsiyani yaratishni anglatadi
faqat bitta funktsiya/modul/sinfga ega narsalar.

Abstraktsiyani to'g'ri qabul qilish juda muhim, shuning uchun siz amal qilishingiz kerak
SOLID tamoyillari [Sinflar](#class) bo'limida keltirilgan. Yomon abstraktsiyalar bo'lishi mumkin
Ikki nusxadagi koddan ham yomonroq, shuning uchun ehtiyot bo'ling! Buni aytib, agar qila olsangiz
yaxshi abstraksiya, buni qiling! O'zingizni takrorlamang, aks holda siz o'zingizni topasiz
bir narsani o'zgartirmoqchi bo'lgan har qanday vaqtda bir nechta joylarni yangilash.

**Yomon:**

```php
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
function showList(array $employees): void
{
    foreach ($employees as $employee) {
        render([$employee->calculateExpectedSalary(), $employee->getExperience(), $employee->getGithubLink()]);
    }
}
```

**[⬆ Tepaga qaytish](#table-of-contents)**

## translations

Bu boshqa tillarda ham mavjud:

* :cn: **Chinese:**
   * [php-cpm/clean-code-php](https://github.com/php-cpm/clean-code-php)
* :ru: **Russian:**
   * [peter-gribanov/clean-code-php](https://github.com/peter-gribanov/clean-code-php)
* :es: **Spanish:**
   * [fikoborquez/clean-code-php](https://github.com/fikoborquez/clean-code-php)
* :brazil: **Portuguese:**
   * [fabioars/clean-code-php](https://github.com/fabioars/clean-code-php)
   * [jeanjar/clean-code-php](https://github.com/jeanjar/clean-code-php/tree/pt-br)
* :thailand: **Thai:**
   * [panuwizzle/clean-code-php](https://github.com/panuwizzle/clean-code-php)
* :fr: **French:**
   * [errorname/clean-code-php](https://github.com/errorname/clean-code-php)
* :vietnam: **Vietnamese:**
   * [viethuongdev/clean-code-php](https://github.com/viethuongdev/clean-code-php)
* :kr: **Korean:**
   * [yujineeee/clean-code-php](https://github.com/yujineeee/clean-code-php)
* :tr: **Turkish:**
   * [anilozmen/clean-code-php](https://github.com/anilozmen/clean-code-php)
* :iran: **Persian:**
   * [amirshnll/clean-code-php](https://github.com/amirshnll/clean-code-php)
* :bangladesh: **Bangla:**
   * [nayeemdev/clean-code-php](https://github.com/nayeemdev/clean-code-php)
* :egypt: **Arabic:**
   * [ahmedjoda/clean-code-php](https://github.com/ahmedjoda/clean-code-php)
* :jp: **Japanese:**
   * [hayato07/clean-code-php](https://github.com/hayato07/clean-code-php)
* :uz: **Uzbekcha:**
   * [AxlidinovJ/Clean-Code-PHP-uz](https://github.com/AxlidinovJ/Clean-Code-PHP-uz)



**[⬆ Tepaga qaytish](#table-of-contents)**
