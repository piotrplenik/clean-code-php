# PHP Temiz Kod

## İçindekiler

  1. [Giriş](#giriş)
  2. [Değişkenler](#değişkenler)
     * [Anlamlı ve telaffuz edilebilir değişken isimleri kullanın](#anlamlı-ve-telaffuz-edilebilir-değişken-isimleri-kullanın)
     * [Aynı türden değişkenler için aynı kelimeleri kullanın](#aynı-türden-değişkenler-için-aynı-kelimeleri-kullanın)
     * [Aranabilir isimler kullanın (bölüm 1)](#aranabilir-isimler-kullanın-bölüm-1)
     * [Aranabilir isimler kullanın (bölüm 2)](#aranabilir-isimler-kullanın-bölüm-2)
     * [Açıklayıcı değişkenler kullanın](#açıklayıcı-değişkenler-kullanın)
     * [Çok fazla iç içe kullanımdan ve geri döndürmeden kaçının (bölüm 1)](#Çok-fazla-iç-içe-kullanımdan-ve-geri-döndürmeden-kaçının-bölüm-1)
     * [Çok fazla iç içe kullanımdan ve geri döndürmeden kaçının (bolum 2)](#Çok-fazla-iç-içe-kullanımdan-ve-geri-döndürmeden-kaçının-bölüm-1)
     * [Zihin Haritasından Kaçının](#zihin-haritasından-kaçının)
     * [Gereksiz bağlam eklemeyin](#gereksiz-bağlam-eklemeyin)
     * [Kısaltmalar veya şartlılar yerine varsayılan argümanları kullanın](#kısaltmalar-veya-şartlılar-yerine-varsayılan-argümanları-kullanın)
  3. [Karşılaştırma](#karşılaştırma)
     * [Aynı karşılaştırmayı kullanın](#aynı-karşılaştırmayı-kullanın)
  4. [Fonksiyonlar](#fonksiyonlar)
     * [Fonksiyon Parametreleri (2 veya daha az ideal)](#fonksiyon-parametreleri-2-veya-daha-az-ideal)
     * [Fonksiyonlar bir şey yapmalı](#fonksiyonlar-bir-şey-yapmalı)
     * [Fonksiyon isimleri ne yaptıklarını söylemeli](#fonksiyon-isimleri-ne-yaptıklarını-söylemeli)
     * [Fonksiyonlar sadece bir seviye soyutlama olmalıdır](#fonksiyonlar-sadece-bir-seviye-soyutlama-olmalıdır)
     * [Bayrakları, fonksiyon parametreleri olarak kullanmayın](#bayrakları-fonksiyon-parametreleri-olarak-kullanmayın)
     * [Yan Etkilerden Kaçının](#yan-etkilerden-kaçının)
     * [Global Fonksiyonlar yazmayın](#global-fonksiyonlar-yazmayın)
     * [Singleton desenini kullanmayın](#singleton-desenini-kullanmayın)
     * [Koşulları kapsülleyin](#koşulları-kapsülleyin)
     * [Olumsuz koşullardan kaçının](#olumsuz-koşullardan-kaçının)
     * [Koşullardan kaçının](#koşullardan-kaçının)
     * [Tür kontrolünden kaçının (bölüm 1)](#tür-kontrolünden-kaçının-bölüm-1)
     * [Tür kontrolünden kaçının (bölüm 2)](#tür-kontrolünden-kaçının-bölüm-2)
     * [Ölü Kodu kaldırın](#Ölü-kodu-kaldırın)
  5. [Nesneler ve Veri Yapıları](#nesneler-ve-veri-yapıları)
     * [Nesne kapsülleme kullanın](#nesne-kapsülleme-kullanın)
     * [Nesnelerin `private/protected` üyelere sahip olmasını sağlayın](#nesnelerin-privateprotected-üyelere-sahip-olmasını-sağlayın)
  6. [Sınıflar](#sınıflar)
     * [Kalıtım üzerinden birleşimi tercih edin](#kalıtım-üzerinden-birleşimi-tercih-edin)
     * [Akıcı (`Fluent`) arayüzlerden kaçının](#akıcı-fluent-arayüzlerden-kaçının)
     * [`final` sınıflarını tercih edin](#final-sınıflarını-tercih-edin)
  7. [SOLID](#solid)
     * [Tek Sorumluluk Prensibi (SRP)](#tek-sorumluluk-prensibi-srp)
     * [Açık/Kapalı Prensibi (OCP)](#açıkkapalı-prensibi-ocp)
     * [Liskov'un Yerine Geçme Prensibi (LSP)](#liskovun-yerine-geçme-prensibi-lsp)
     * [Arayüz Ayırma Prensibi (ISP)](#arayüz-ayırma-prensibi-isp)
     * [Bağlılığı Tersine Çevirme Prensibi (DIP)](#bağlılığı-tersine-Çevirme-prensibi-dip)
  8. [Kendinizi Tekrar Etmeyin (DRY)](#kendinizi-tekrar-etmeyin-dry)
  9. [Çeviriler](#Çeviriler)

## Giriş

Yazılım mühendisliği prensipleri,Robert C. Martin'in [*Temiz Kod*](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882) kitabından, PHP için uyarlanmıştır. Bu bir stil kılavuzu değildir. PHP’de okunabilir, yeniden kullanılabilir ve düzenlenebilir yazılımlar üretmek için bir kılavuzdur.

Buradaki her prensibe tamamen uyulmamalıdır, ve evrensel olarak daha az kabul edilecek. Bunlar ilke ve başka birşey değildir, ama bunlar *Temiz Kod* yazarlarının uzun yıllara dayanan kolektif deneyimlerine göre kodlanmıştır. 

 [temiz-kod-javascript](https://github.com/ryanmcdermott/clean-code-javascript) den ilham alınmıştır.

Çoğu geliştirici hala PHP 5 kullanıyor olsa da, bu makaledeki örneklerin çoğu sadece PHP 7.1+ ile çalışmaktadır.

## Değişkenler

### Anlamlı ve telaffuz edilebilir değişken isimleri kullanın

**Kötü:**

```php
$ymdstr = $moment->format('y-m-d');
```

**İyi:**

```php
$currentDate = $moment->format('y-m-d');
```

**[⬆ yukarı çık](#İçindekiler)**

### Aynı türden değişkenler için aynı kelimeleri kullanın

**Kötü:**

```php
getUserInfo();
getUserData();
getUserRecord();
getUserProfile();
```

**İyi:**

```php
getUser();
```

**[⬆ yukarı çık](#İçindekiler)**

### Aranabilir isimler kullanın (bölüm 1)

Yazacağımızdan daha fazla kod okuyacağız. Önemli olan okunabilir ve aranabilir kod yazmamızdır. Değişkenleri anlamlı *isimlendirmezsek* programımızı anlamaya çalışan okuyucularımıza zarar verebiliriz.
İsimleri aranabilir yapın.

**Kötü:**

```php
// 448 ne için ?
$result = $serializer->serialize($data, 448);
```

**İyi:**

```php
$json = $serializer->serialize($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

### Aranabilir isimler kullanın (bölüm 2)

**Kötü:**

```php
// 4 ne için?
if ($user->access & 4) {
    // ...
}
```

**İyi:**

```php
class User
{
    const ACCESS_READ = 1;
    const ACCESS_CREATE = 2;
    const ACCESS_UPDATE = 4;
    const ACCESS_DELETE = 8;
}

if ($user->access & User::ACCESS_UPDATE) {
    // düzenle ...
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Açıklayıcı değişkenler kullanın

**Kötü:**

```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches[1], $matches[2]);
```

**Fena Değil:**

Daha iyi ama hala regex'e son derece bağlıyız.

```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

[, $city, $zipCode] = $matches;
saveCityZipCode($city, $zipCode);
```

**İyi:**

Alt şablonlara ad vererek regex bağımlılığını azaltın.

```php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(?<city>.+?)\s*(?<zipCode>\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches['city'], $matches['zipCode']);
```

**[⬆ yukarı çık](#İçindekiler)**

### Çok fazla iç içe kullanımdan ve geri döndürmeden kaçının (bölüm 1)

Çok fazla if-else ifadeleri kodun takip edilmesini zorlaştırır. Direkt olmak, dolaylı olmaktan iyidir. 

**Kötü:**

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
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}
```

**İyi:**

```php
function isShopOpen(string $day): bool
{
    if (empty($day)) {
        return false;
    }

    $openingDays = [
        'friday', 'saturday', 'sunday'
    ];

    return in_array(strtolower($day), $openingDays, true);
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Çok fazla iç içe kullanımdan ve geri döndürmeden kaçının (bölüm 2)

**Kötü:**

```php
function fibonacci(int $n)
{
    if ($n < 50) {
        if ($n !== 0) {
            if ($n !== 1) {
                return fibonacci($n - 1) + fibonacci($n - 2);
            } else {
                return 1;
            }
        } else {
            return 0;
        }
    } else {
        return 'Not supported';
    }
}
```

**İyi:**

```php
function fibonacci(int $n): int
{
    if ($n === 0 || $n === 1) {
        return $n;
    }

    if ($n > 50) {
        throw new \Exception('Not supported');
    }

    return fibonacci($n - 1) + fibonacci($n - 2);
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Zihin Haritasından Kaçının

Okuyucuyu, kodunuzdaki değişkenin ne demek olduğunu tercüme etmek için zorlamayın. Direkt olmak, dolaylı olmaktan iyidir.

**Kötü:**

```php
$l = ['Austin', 'New York', 'San Francisco'];

for ($i = 0; $i < count($l); $i++) {
    $li = $l[$i];
    doStuff();
    doSomeOtherStuff();
    // ...
    // ...
    // ...
    // Bekle, yeniden `$li` ne için?
    dispatch($li);
}
```

**İyi:**

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

**[⬆ yukarı çık](#İçindekiler)**

### Gereksiz bağlam eklemeyin

Sınıf/Nesne isimleriniz bir şey anlatıyorsa, bunu değişken adınızda tekrarlamayın. 

**Kötü:**

```php
class Car
{
    public $carMake;
    public $carModel;
    public $carColor;

    //...
}
```

**İyi:**

```php
class Car
{
    public $make;
    public $model;
    public $color;

    //...
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Kısaltmalar veya şartlılar yerine varsayılan argümanları kullanın

**İyi Değil:**

Bu iyi değil çünkü `$breweryName`, `NULL` olabilir.

```php
function createMicrobrewery($breweryName = 'Hipster Brew Co.'): void
{
    // ...
}
```

**Fena Değil:**

Bu düşünce bir önceki versiyondan daha anlaşılır ama değişkenin değerini kontrol etse daha iyi olur.

```php
function createMicrobrewery($name = null): void
{
    $breweryName = $name ?: 'Hipster Brew Co.';
    // ...
}
```

**İyi:**

 
 [tür ipucu](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration) kullanabilirsiniz ve  `$breweryName` öğesinin `NULL` olmadığından emin olun. 


```php
function createMicrobrewery(string $breweryName = 'Hipster Brew Co.'): void
{
    // ...
}
```

**[⬆ yukarı çık](#İçindekiler)**

## Karşılaştırma

### [Aynı karşılaştırmayı](http://php.net/manual/en/language.operators.comparison.php) kullanın.

**İyi Değil:**

Basit karşılaştırma harf dizinleri bir ifadeyi tam sayıya döndürür.

```php
$a = '42';
$b = 42;

if ($a != $b) {
   // İfade her zaman geçer.
}
```
`$a != $b` karşılaştırması `FALSE` değerini döndürüyor ama aslında `TRUE`! 
Harf dizini `42`, tam sayı olan `42` den farklıdır.

**İyi:**

Aynı karşılaştırma türü ve değeri karşılaştırır.

```php
$a = '42';
$b = 42;

if ($a !== $b) {
    // İfade doğrulandı.
}
```

`$a !== $b` karşılaştırması `TRUE` değerini döndürür.

**[⬆ yukarı çık](#İçindekiler)**


## Fonksiyonlar

### Fonksiyon Parametreleri (2 veya daha az ideal)

Fonksiyon parametrelerinin miktarını sınırlamak inanılmaz derecede önemlidir çünkü fonksiyonunuzu test etmeyi kolaylaştırır. Üç *leads* ten fazlasının olması, her bir ayrı argümana sahip tonlarca farklı durumu test etmeniz gereken bir kombinatoryal patlamaya yol açar.


Sıfır argümanlar ideal durumdur. Bir veya iki argüman iyidir fakat üç argümandan kaçınılmalıdır. Bundan daha fazlası birleştirilmelidir. Genellikle iki argümandan fazlası varsa fonksiyonunuz çok fazlasını yapmaya çalışır.
Olmadığı durumlarda çoğu zaman yüksek seviye bir nesne bir argüman olarak yeterli olacaktır. 

**Kötü:**

```php
function createMenu(string $title, string $body, string $buttonText, bool $cancellable): void
{
    // ...
}
```

**İyi:**

```php
class MenuConfig
{
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

function createMenu(MenuConfig $config): void
{
    // ...
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Fonksiyonlar bir şey yapmalı

Bu, yazılım mühendisliğinde açık ara en önemli kuraldır. Fonksiyonlar bir şeyden fazlasını yaptığında bunları oluşturmak, test etmek ve akıl yürütmek daha zordur. Bir fonksiyonu sadece bir eyleme ayırdığında, kolayca düzenlenebilir ve kodunuz daha temiz okunacaktır. Eğer bu kılavuzdan bunda başka bir şey almazsanız bile, birçok geliştiriciden önde olacaksınız.


**Kötü:**
```php
function emailClients(array $clients): void
{
    foreach ($clients as $client) {
        $clientRecord = $db->find($client);
        if ($clientRecord->isActive()) {
            email($client);
        }
    }
}
```

**İyi:**

```php
function emailClients(array $clients): void
{
    $activeClients = activeClients($clients);
    array_walk($activeClients, 'email');
}

function activeClients(array $clients): array
{
    return array_filter($clients, 'isClientActive');
}

function isClientActive(int $client): bool
{
    $clientRecord = $db->find($client);

    return $clientRecord->isActive();
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Fonksiyon isimleri ne yaptıklarını söylemeli

**Kötü:**

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
// Bu nedir? Mesaj için `handle` ? Şimdi bir dosyaya mı yazıyoruz ?
$message->handle();
```

**İyi:**

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
// Temiz ve açık
$message->send();
```

**[⬆ yukarı çık](#İçindekiler)**

### Fonksiyonlar sadece bir seviye soyutlama olmalıdır

Birden fazla soyutlama seviyeniz olduğu zaman fonksiyonunuz genellikle çok fazla şey yapıyordur. Fonksiyonları ayırmak tekrar kullanılabilirlik ve daha kolay test edilebilirlik sağlar.


**Kötü:**

```php
function parseBetterJSAlternative(string $code): void
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

**Çok Kötü:**

Bazı fonksiyonellikleri gerçekleştirdik ama  `parseBetterJSAlternative()` fonksiyonu hala çok karmaşık ve test edilebilir değil.

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

function parseBetterJSAlternative(string $code): void
{
    $tokens = tokenize($code);
    $ast = lexer($tokens);
    foreach ($ast as $node) {
        // parse...
    }
}
```

**İyi:**

En iyi çözüm `parseBetterJSAlternative()` fonksiyonundaki bağımlılıkları ortadan kaldırmaktır.

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

class BetterJSAlternative
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

**[⬆ yukarı çık](#İçindekiler)**

### Bayrakları, fonksiyon parametreleri olarak kullanmayın.


Bayraklar, kullanıcılarınıza bu fonksiyonun birden fazla şey yapacağını söyler.
Fonksiyonlar bir şey yapmalıdır. Eğer bir `boolean` tabanlı farklı kod yollarını takip ediyorsanız, fonksiyonlarınızı bölün.


**Kötü:**

```php
function createFile(string $name, bool $temp = false): void
{
    if ($temp) {
        touch('./temp/'.$name);
    } else {
        touch($name);
    }
}
```

**İyi:**

```php
function createFile(string $name): void
{
    touch($name);
}

function createTempFile(string $name): void
{
    touch('./temp/'.$name);
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Yan Etkilerden Kaçının

Bir fonksiyon, bir değeri almak ve başka değer veya değerleri geri döndürmek dışında bir şey yaparsa bir yan etki üretir.
Bir yan etki bir dosyaya yazılabilir, global değişkenleri değiştirebilir veya bir yabancıya bütün paranızı yanlışlıkla bağlayabilir.

Şimdi, bir sebeple programında yan etkilere ihtiyacınız var. Önceki örnekteki gibi, belki bir dosyaya yazmanız gerekebilir.
Yapmak istediğiniz şey, yaptığınızı merkezileştirmektir. Belirli bir dosyaya birkaç fonksiyon ve sınıflar yazılmasına gerek yoktur. Bunu yapan bir servis var. Bir ve sadece bir tane.

Ana nokta, herhangi bir yapıya sahip olmayan nesneler arasındaki paylaşım durumu gibi ortak tuzaklardan kaçınmaktır. Herhangi bir şeye göre yazılabilen ve yan etkilerin meydana geldiği yeri merkezileştirmeyen değişebilen veri türleri kullanılmalıdır. Eğer bunu yapabiliyorsanız diğer programcıların büyük çoğunluğundan daha mutlu olacaksınız.

**Kötü:**

```php
// Global değişkenler, aşağıdaki fonksiyonları referans alır.
// Bu ismi kullanan başka fonksiyonumuz olsaydı, şimdi bir dizi olurdu ve bozulurdu.
$name = 'Ryan McDermott';

function splitIntoFirstAndLastName(): void
{
    global $name;

    $name = explode(' ', $name);
}

splitIntoFirstAndLastName();

var_dump($name); // ['Ryan', 'McDermott'];
```

**İyi:**

```php
function splitIntoFirstAndLastName(string $name): array
{
    return explode(' ', $name);
}

$name = 'Ryan McDermott';
$newName = splitIntoFirstAndLastName($name);

var_dump($name); // 'Ryan McDermott';
var_dump($newName); // ['Ryan', 'McDermott'];
```

**[⬆ yukarı çık](#İçindekiler)**

### Global Fonksiyonlar yazmayın

Global kirletme birçok dilde kötü bir uygulama yöntemidir. Çünkü başka bir kütüphane ile çakışabilir ve API'nızın kullanıcısı ürününüzden istisna elde edene kadar bilemezdiniz. Hadi bir örnek düşünelim: Eğer konfigürasyon dizisine sahip olmak isteseniz ne olurdu?
`config()` gibi global fonksiyon yazabilirsiniz ama  aynı şeyi yapmaya çalışan başka bir kütüphaneyle çakışabilir.

**Kötü:**

```php
function config(): array
{
    return  [
        'foo' => 'bar',
    ]
}
```

**İyi:**

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
        return isset($this->configuration[$key]) ? $this->configuration[$key] : null;
    }
}
```

Yapılandırmayı yükleyin ve `Configuration` sınıfının örneğini oluşturun.

```php
$configuration = new Configuration([
    'foo' => 'bar',
]);
```

Ve şimdi uygulamanızda `Configuration` örneğini kullanmalısınız.

**[⬆ yukarı çık](#İçindekiler)**

### Singleton desenini kullanmayın

Singeton bir [anti-pattern'dir](https://en.wikipedia.org/wiki/Singleton_pattern). Brian Button'un yorumuyla:
 1. Genellikle **global örnek** kullanırlar, neden bu kadar kötü ki?  Çünkü bunları arayüzlerde göstermek yerine uygulamanızın kodlarında **bağımlılıkları saklıyorsunuz**. Global bir şeyler yapmak, [kod kokusu](https://en.wikipedia.org/wiki/Code_smell) etrafında dolaşmamaktır.
 2. [Tek Sorumluluk Prensibi (SRP)](#single-responsibility-principle-srp)'ni ihlal ediyorlar : 
 **kendi kreasyonlarını ve yaşam döngülerini kontrol ettikleri** gerçeğiyle.
 3. Bunlar doğal olarak kodun sıkı sıkıya [bağlanmış](https://en.wikipedia.org/wiki/Coupling_%28computer_programming%29) olmasına neden olurlar. Birçok durumda testi zorlaştırmak için onları kandırır.
 4. Uygulamanın yaşam süresi kadar durum taşıyorlar. Başka bir test yaptıktan sonra birim testleri için büyük bir hiç olan **testlerin sıralı olması gereken bir durumla karşılaşabilirsiniz.** Neden? Çünkü her birim testi diğerlerinden bağımsız olmalıdır.


[Problemin kökü](http://misko.hevery.com/2008/08/25/root-cause-of-singletons/) hakkında [Misko Hevery](http://misko.hevery.com/about/) 'in çok güzel düşünceleri var.

**Kötü:**

```php
class DBConnection
{
    private static $instance;

    private function __construct(string $dsn)
    {
        // ...
    }

    public static function getInstance(): DBConnection
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

**İyi:**

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

`DBConnection` sınıfının örneğini oluşturun ve [DSN](http://php.net/manual/en/pdo.construct.php#refsect1-pdo.construct-parameters) ile yapılandırın.


```php
$connection = new DBConnection($dsn);
```

Ve şimdi uygulamanızda `DBConnection` örneğini kullanmalısınız.

**[⬆ yukarı çık](#İçindekiler)**

### Koşulları kapsülleyin

**Kötü:**

```php
if ($article->state === 'published') {
    // ...
}
```

**İyi:**

```php
if ($article->isPublished()) {
    // ...
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Olumsuz koşullardan kaçının

**Kötü:**

```php
function isDOMNodeNotPresent(\DOMNode $node): bool
{
    // ...
}

if (!isDOMNodeNotPresent($node))
{
    // ...
}
```

**İyi:**

```php
function isDOMNodePresent(\DOMNode $node): bool
{
    // ...
}

if (isDOMNodePresent($node)) {
    // ...
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Koşullardan kaçının

Bu imkansız bir iş gibi görünüyor. Bunu ilk duyduğunda, birçok insan şöyle der; 
"Bir `if` koşulu olmadan nasıl bir şey yapayım ki?" Bunun cevabı ise çoğu durumda aynı işi gerçekleştirmek için polimorfizm(`polymorphism`) kullanabilmenizdir. Genellikle ikinci soru ise; "tamam bu harika ama neden bunu yapmak isterdim?" Bunun cevabı öğrendiğimiz bir önceki temiz kod kavramıdır: bir fonksiyon sadece bir şey yapmalı. `if` koşuluna sahip sınıflar ve fonksiyonlarınız olduğu zaman, kullanıcılarınıza fonksiyonunuzun birden fazla şey yaptığınız söylersiniz. Unutmayın, sadece bir şey yapın.

**Kötü:**

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

**İyi:**

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

**[⬆ yukarı çık](#İçindekiler)**

### Tür kontrolünden kaçının (bölüm 1)

PHP türlendirilmemiş, bu da fonksiyonlarınızın herhangi bir türde argümanı alabileceğini anlamına geliyor.
Bu özgürlük bazen sizi zora sokabilir ve fonksiyonlarınızda tür kontrolü yapmak cazip hale gelir. Bunu yapmaktan kaçınmanın bir çok yolu vardır. Dikkate alınacak ilk şey tutarlı API'lardır. 

**Kötü:**

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

**İyi:**

```php
function travelToTexas(Traveler $vehicle): void
{
    $vehicle->travelTo(new Location('texas'));
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Tür kontrolünden kaçının (bölüm 2)

Dizeler, tamsayılar ve diziler gibi basit ilkel değerler ile çalışıyorsanız ve PHP 7+ kullanıyorsanız ve polimorfizmi kullanamıyorsanız ama yine de tür kontrolü yapmanız gerektiğini düşünüyorsanız, [tür beyanı](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration) veya strict(katı) modunu dikkate almalısınız. Standart PHP sözdiziminin üstünde size statik yazım sağlar. Manuel tür kontrolü ile ilgili problem, aldığınız sahte "tür-güvenliği" nin kaybolan okunabilirliği telafi etmemesi için ekstra gereksiz kelime gerektirmesidir.
PHP'nizi temiz tutun, iyi testler yazın ve iyi bir kod incelemesine sahip olun. Aksi taktirde, tüm bunları katı tür beyanı yada katı(strict) mod ile yapın.


**Kötü:**

```php
function combine($val1, $val2): int
{
    if (!is_numeric($val1) || !is_numeric($val2)) {
        throw new \Exception('Must be of type Number');
    }

    return $val1 + $val2;
}
```

**İyi:**

```php
function combine(int $val1, int $val2): int
{
    return $val1 + $val2;
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Ölü kodu kaldırın

Ölü kod, tekrarlanan kod kadar kötüdür. Kod tabanınızda tutmak için bir sebep yok. Eğer çağrılmıyorsa ondan kurtulun! Hala ihtiyacınız varsa versiyon geçmişinizde hala güvende olacak.

**Kötü:**

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

**İyi:**

```php
function requestModule(string $url): void
{
    // ...
}

$request = requestModule($requestUrl);
inventoryTracker('apples', $request, 'www.inventory-awesome.io');
```

**[⬆ yukarı çık](#İçindekiler)**


## Nesneler ve Veri Yapıları

### Nesne kapsülleme kullanın

PHP'de, metodlar için `public`, `protected` ve `private` anahtar kelimeler ayarlayabilirsiniz. Bunu kullanarak bir nesne üzerinde özellik değişikliklerini kontrol edebilirsiniz.

* Nesne özelliği elde etmenin ötesinde daha fazlasını yapmak istediğinizde, kod tabanınızdaki her erişimciyi aramanıza ve değiştirmenize gerek yoktur.
* Bir `set` yaparken doğrulama ekleyerek basitleştirir.
* İçsel temsili dahil eder.
* Alma ve ayarlama yapılırken kaydetme(loglama) ve hata işlemeyi eklemek kolaydır.
* Bu sınıfı miras olarak alırken, varsayılan fonksiyonelliği geçersiz kılabilirsiniz. 
* Nesnenin özelliklerini ağır yükletebilirsiniz, bir sunucudan almayı söyleyelim. ([Lazy Load](https://en.wikipedia.org/wiki/Lazy_loading)) 


Ek olarak, bu [Açık/Kapalı](#openclosed-principle-ocp) prensibinin bir parçasıdır.

**Kötü:**

```php
class BankAccount
{
    public $balance = 1000;
}

$bankAccount = new BankAccount();

// Ayakkabı al...
$bankAccount->balance -= 100;
```

**İyi:**

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

// Ayakkabı al...
$bankAccount->withdraw($shoesPrice);

// Bakiyeyi al
$balance = $bankAccount->getBalance();
```

**[⬆ yukarı çık](#İçindekiler)**

### Nesnelerin private/protected üyelere sahip olmasını sağlayın

* `public` metodları ve özellikleri değişiklikler için çok tehlikelidir çünkü bazı dış kodlar bunlara kolaylıkla güvenebilir ve hangi kodun onlara bağlı olduğunu kontrol edemezsiniz. **Sınıftaki değişiklikler, sınıfın tüm kullanıcıları için tehlikelidir.**
* `protected` değiştiricileri, `public` kadar tehlikelidir çünkü herhangi bir çocuk sınıfı kapsamındadırlar.
Bu public ve protected arasındaki farkın yalnızca erişim mekanizmasında olduğunu ama kapsülleme garantisinin aynı kaldığı anlamına gelir. **Sınıftaki değişiklikler tüm alt sınıflar için tehlikelidir.**
* `private` değiştiricileri kodun **sadece tek bir sınıfın sınırları içinde değiştirilmesinin tehlikeli olduğunu** garanti eder (değişiklikler için güvendesiniz ve [Jenga etkisinde](http://www.urbandictionary.com/define.php?term=Jengaphobia&defid=2494196) olmayacaksın).

Bu sebeple, varsayılan olarak `private` kullanın ve harici sınıflara erişim sağlamanız gerektiğinde `public/protected` kullanın.

Daha fazla bilgi için, bu konuda [Fabien Potencier](https://github.com/fabpot)'ın yazdığı [blog yazısını](http://fabien.potencier.org/pragmatism-over-theory-protected-vs-private.html) okuyabilirsiniz.


**Kötü:**

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
echo 'Employee name: '.$employee->name; // Çalışan Adı: John Doe
```

**İyi:**

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
echo 'Employee name: '.$employee->getName(); // Çalışan Adı: John Doe
```

**[⬆ yukarı çık](#İçindekiler)**

## Sınıflar

### Kalıtım üzerinden birleşimi tercih edin

Gang of Four(Dörtlü Çete)'un ünlü [*Tasarım Desenleri*](https://en.wikipedia.org/wiki/Design_Patterns)'nde belirtildiği gibi, yapabileceğiniz yerlerde kompozisyonu kalıtıma tercih etmelisiniz. Kalıtımın kullanılması için pek çok iyi sebep ve kompozisyon kullanmak için birçok iyi sebep vardır. Bu ilkenin ana noktası, eğer aklınız içgüdüsel olarak kalıtıma giderse, kompozisyonun problemini daha iyi modellemeyi düşünmeye çalışın. Bazı durumlarda yapabilir.

O zaman merak ediyor olabilirsiniz, "kalıtımımı ne zaman kullanmalıyım?" Bu senin probleminize bağlı ama kalıtımın kompozisyondan daha anlamlı olduğu zamanın iyi bir listesidir:

1. Kalıtımınız "bir" ilişkiyi temsil eder ve ilişkinin "bir" ilişkisi yoktur (Human->Animal vs. User->UserDetails).
2. Temel sınıflardan kodu tekrar kullanabilirsiniz (İnsanlar tüm hayvanlar gibi hareket edebilir).
3. Bir temel sınıfı değiştirerek türetilmiş sınıflarda global değişiklikler yapmak istersiniz (Hareket ettikleri zaman tüm hayvanların kalori giderlerini değiştirin).


**Kötü:**

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

// Kötü çünkü Employees vergi verileri "var".
// EmployeeTaxData bir Employee türü değil.

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

**İyi:**

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

    public function setTaxData(string $ssn, string $salary)
    {
        $this->taxData = new EmployeeTaxData($ssn, $salary);
    }

    // ...
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Akıcı (Fluent) arayüzlerden kaçının

[Akıcı arayüz](https://en.wikipedia.org/wiki/Fluent_interface), [Metod Zincirleme](https://en.wikipedia.org/wiki/Method_chaining) kullanarak kaynak kodun okunabilirliği arttırmaya çalışan nesne tabanlı bir API'dir.


Bazı bağlamlar olsa da kodun (Örneğin [PHPUnit Mock Builder](https://phpunit.de/manual/current/en/test-doubles.html)
veya [Doctrine Query Builder](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html)) ayrıntılarını azalttığı sıklıkla yapıcı madde olsa da, sıklıkla bir bedeli vardır:


1. [Kapsüllemeyi](https://en.wikipedia.org/wiki/Encapsulation_%28object-oriented_programming%29) bozar.
2. [Dekoratörleri](https://en.wikipedia.org/wiki/Decorator_pattern) bozar.
3. Testte [sahte nesne](https://en.wikipedia.org/wiki/Mock_object) kullanmak daha zordur.
4. Okuması zor olan farklı işlemler yapar.

Daha fazla bilgi için, bu konuda [Marco Pivetta](https://github.com/Ocramius) 'nın yazdığı [blog yazısını](https://ocramius.github.io/blog/fluent-interfaces-are-evil/) okuyabilirsiniz.

**Kötü:**

```php
class Car
{
    private $make = 'Honda';
    private $model = 'Accord';
    private $color = 'white';

    public function setMake(string $make): self
    {
        $this->make = $make;

        // NOT: Bunu zincirleme için döndüyor.
        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        // NOT: Bunu zincirleme için döndüyor.
        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        // NOT: Bunu zincirleme için döndüyor.
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

**İyi:**

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

**[⬆ yukarı çık](#İçindekiler)**

### final sınıflarını tercih edin

`final` mümkün olduğunda kullanılmalıdır:

1. Kontrolsüz kalıtım zincirini önler.
2. [Kompozisyon](#prefer-composition-over-inheritance)u teşvik eder. 
3. [Tek Sorumluluk Desenini](#single-responsibility-principle-srp) teşvik der.
4. Geliştiricilerin, protected metodlara erişmek için sınıfı geliştirmesi yerine public metodlarınızı kullanmasını teşvik eder.
5. Sınıfını kullanmayan uygulamalarda bozulma olmadan kodunu değiştirmene izin verir.

Tek şart sınıfınızın arayüz kullanmasıdır ve başka hiçbir metod tanımlanmamasıdır.

Daha fazla bilgi için, bu konuda [Marco Pivetta (Ocramius)](https://ocramius.github.io/) 'nın yazdığı [blog yazısını](https://ocramius.github.io/blog/when-to-declare-classes-final/) okuyabilirsiniz.


**Kötü:**

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

**İyi:**

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
    
    /**
     * {@inheritdoc}
     */
    public function getColor() 
    {
        return $this->color;
    }
}
```

**[⬆ yukarı çık](#İçindekiler)**

## SOLID

**SOLID**, Robert Martin'in bahsettiği ilk beş prensip için Michael Feathers tarafından ortaya çıkarılmış bir mnemonik kısaltmadır.


 * [S: Tek Sorumluluk Prensibi (SRP)](#single-responsibility-principle-srp)
 * [O: Açık/Kapalı Prensibi (OCP)](#openclosed-principle-ocp)
 * [L: Liskov'un Yerine Geçme Prensibi (LSP)](#liskov-substitution-principle-lsp)
 * [I: Arayüz Ayırma Prensibi (ISP)](#interface-segregation-principle-isp)
 * [D: Bağlılığı Tersine Çevirme Prensibi (DIP)](#dependency-inversion-principle-dip)

### Tek Sorumluluk Prensibi (SRP)

Temiz Kodda belirtildiği gibi, "Bir sınıfın değişmesi için asla birden fazla sebep olmamalıdır". Bir sınıfı, uçuşunuzda sadece bir bavul alabildiğiniz gibi tek fonksiyonellikle sıkıştırmak daha caziptir. Bununla ilgili bir sorun, sınıfınızın kavramsal olarak birleşemeyeceği ve değişmesi için birçok sebep vereceğidir. Bir sınıfı değiştirmek için gereken süreyi en aza indirmek önemlidir. Bu önemlidir çünkü bir sınıfta çok fazla fonksiyonellik varsa ve bir parçasını değiştirirsen, kod tabanınızda bulunan diğer bağımlı modülleri nasıl etkileyeceğini kestirmek zordur.

**Kötü:**

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

**İyi:**

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

**[⬆ yukarı çık](#İçindekiler)**

### Açık/Kapalı Prensibi (OCP)

Bertrand Meyer'in belirttiği gibi, "yazılım varlıkları (sınıflar, modüller, fonksiyonlar vb.) ilaveye açık olmalı ama değişiklik için kapatılmalıdır." Bu ne anlama geliyor? Bu prensip temel olarak kullanıcıların mevcut kodu değiştirmeden yeni fonksiyonlar eklemelerine izin vermeniz gerektiğini belirtir.

**Kötü:**

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
        // request and return promise
    }

    private function makeHttpCall(string $url): Promise
    {
        // request and return promise
    }
}
```

**İyi:**

```php
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

**[⬆ yukarı çık](#İçindekiler)**

### Liskov'un Yerine Geçme Prensibi (LSP)

Bu çok basit bir kavram için korkutucu bir terimdir. "Eğer S, T'nin bir alt türüyse, o zaman T tipi nesneler bu programın istenen özelliklerinden herhangi birini değiştirmeden S tipi (Örneğin, S türündeki nesneler T türündeki nesnelerin yerine geçebilir) nesnelerle değiştirilebilir (uygunluk, yapılan görev, vb.)." Bu daha da korkunç bir açıklamadır.

Bunun için en iyi açıklama, bir ebeveyn ve bir çocuk sınıfınız varsa yanlış sonuçlar almadan, çocuk sınıfı ve temel sınıfı dönüşümlü olarak değiştirilebilir. Bu hala kafa karıştırıcı olabilir. Bu yüzden klasik, Kare-Dikdörtgen örneğine bir bakalım. Matematiksel olarak kare bir dikdörtgendir ama kalıtım aracığıyla ama bunu ilişkiyi kullanarak modelliyorsanız, kısa sürede başınız ağrıyabilir.

**Kötü:**

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
    echo sprintf('%s has area %d.', get_class($rectangle), $rectangle->getArea()).PHP_EOL;
}

$rectangles = [new Rectangle(), new Square()];

foreach ($rectangles as $rectangle) {
    printArea($rectangle);
}
```

**İyi:**

En iyi yöntem dörtgenlerini ayırmak ve iki şekil için de daha genel bir alt türü ayrıştırmaktır.

Kare ve dikdörtgen görüntüde benzer olsa da aslında farklılardır. Bir kare, eşkenar dikdörtgene daha benzerdir, bir dikdörtgen de paralelkenara daha benzerdir ama alt tür değillerdir. Bir kare, bir dikdörtgen bir eşkenar dikdörtgen ve bir paralelkenar kendi özellikleri olan farklı şekillerdir. Fakat benzerlerdir.


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

**[⬆ yukarı çık](#İçindekiler)**

### Arayüz Ayırma Prensibi (ISP)

ISP, "Müşteriler kullanmadıkları arayüzlere bağlı olmaya zorlanmamalıdır." der.

Bu prensibi gösteren iyi bir örneğe bakarsak, büyük ayarlama nesnelerine ihtiyaç duyan sınıflar sınıflar vardır. Müşterinin, çok fazla sayıda seçenek kurmaya ihtiyacı olmaması yararlıdır. Çünkü genelde o ayarlamaların hepsine ihtiyaçları olmayacaktır. Onları opsiyonel yapmak "şişman arayüz" olmasını engeller.

**Kötü:**

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
        // ....çalışıyor
    }

    public function eat(): void
    {
        // ...... öğle arasında yemek yiyor
    }
}

class RobotEmployee implements Employee
{
    public function work(): void
    {
        //.... çok daha fazla çalışıyor
    }

    public function eat(): void
    {
        //.... robot yemek yemez ama bu metodu uygulamak zorundadır
    }
}
```

**İyi:**

Her işçi bir çalışan değil ama her çalışan bir işçidir.

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
        // ....çalışıyor
    }

    public function eat(): void
    {
        //.... öğle arasında yemek yiyor
    }
}

// robot sadece çalışabilir
class RobotEmployee implements Workable
{
    public function work(): void
    {
        // ....çalışıyor
    }
}
```

**[⬆ yukarı çık](#İçindekiler)**

### Bağlılığı Tersine Çevirme Prensibi (DIP)

Bu prensip iki temel öğeyi barındırır:
1. Yüksek seviyeli modüller, düşük seviyeli modüllere bağlı olmamalıdır. İkisi de soyutlamaya bağlı olmalıdır.
2. Soyutlamalar, detaylara bağlı olmamalıdır. Detaylar, soyutlamalara bağlı olmalıdır.

Bunu başta anlamak zordur ama PHP frameworkleri(Symfony gibi) ile çalıştıysanız, Dependency Injection (DI) formunda bu prensibin uygulandığını görmüşsünüzdür. Aynı konseptler olmadıklarında DIP düşük seviyeli modüllerinin detaylarını bilerek yüksek seviyeli modülleri saklar ve ayarlar. Bunu DI üzerinden tamamlayabilir. Bunun en büyük yararlarından biri de modüller arasındaki eşleşmeyi azaltır. Eşleşme çok kötü bir geliştirme desenidir çünkü kodunuzu yeniden düzenlemeyi zorlaştırır.

**Kötü:**

```php
class Employee
{
    public function work(): void
    {
        // ....çalışıyor
    }
}

class Robot extends Employee
{
    public function work(): void
    {
        //.... çok daha fazla çalışıyor
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

**İyi:**

```php
interface Employee
{
    public function work(): void;
}

class Human implements Employee
{
    public function work(): void
    {
        // ....çalışıyor
    }
}

class Robot implements Employee
{
    public function work(): void
    {
        //.... çok daha fazla çalışıyor
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

**[⬆ yukarı çık](#İçindekiler)**

## Kendinizi Tekrar Etmeyin (DRY)

[DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) prensibini gözlemlemeye çalışın.

Tekrarlanan kodlardan kaçınmak için mutlaka en iyisini yapın. Tekrarlanan kod kötüdür çünkü bir mantığı değiştirmek gerekirse bir şeyi değiştirmek için birden fazla yer olduğu anlamına geliyor.

Bir restoran işlettiğinizi düşünün ve malzeme takibini yapıyorsunuz: tüm domates, soğan, sarımsak, baharat, ve benzerlerinin. Bu işte birden çok liste kullanırsanız içinde domates olan bir yemek servis ettiğinizde tüm listeleri güncellemeniz gerekir. Sadece bir listeniz olursa, güncelleyecek sadece bir yer olur. 


Genelde tekrarlanan kod vardır çünkü iki veya daha fazla çok az farklı şey vardır. Birçok ortak yönleri vardır ama farklılıkları, oldukça benzer şeyleri yapan iki veya daha fazla ayrı fonksiyonunuzun olmasına sizi zorlar. Tekrarlayan kodları kaldırmak, bir dizi farklı şeyleri sadece bir fonksiyon/modül/sınıf ile halledebilen soyutlamalar oluşturmak demektir.


Soyutlamayı doğru yapmak çok önemlidir. Bu yüzden [Sınıflar](#classes) bölümündeki SOLID prensiplerini izlemelisiniz. Kötü soyutlamalar, tekrarlanan kodlardan daha kötü olabilir, o yüzden dikkat edin! Söylediğim gibi, iyi bir soyutlama yapabiliyorsanız, yapın! Kendinizi tekrar etmeyin, yoksa bir şeyi değiştirmek istediğiniz zaman kendinizi birçok yeri güncellerken bulursunuz.

**Kötü:**

```php
function showDeveloperList(array $developers): void
{
    foreach ($developers as $developer) {
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

function showManagerList(array $managers): void
{
    foreach ($managers as $manager) {
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

**İyi:**

```php
function showList(array $employees): void
{
    foreach ($employees as $employee) {
        $expectedSalary = $employee->calculateExpectedSalary();
        $experience = $employee->getExperience();
        $githubLink = $employee->getGithubLink();
        $data = [
            $expectedSalary,
            $experience,
            $githubLink
        ];

        render($data);
    }
}
```

**Çok İyi:**

Kodun kompakt bir versiyonunu kullanmak iyidir.

```php
function showList(array $employees): void
{
    foreach ($employees as $employee) {
        render([
            $employee->calculateExpectedSalary(),
            $employee->getExperience(),
            $employee->getGithubLink()
        ]);
    }
}
```

**[⬆ yukarı çık](#İçindekiler)**

## Çeviriler

Başka diller de mevcuttur:

* :cn: **Çince:**
   * [php-cpm/clean-code-php](https://github.com/php-cpm/clean-code-php)
* :ru: **Rusça:**
   * [peter-gribanov/clean-code-php](https://github.com/peter-gribanov/clean-code-php)
* :es: **İspanyolca:**
   * [fikoborquez/clean-code-php](https://github.com/fikoborquez/clean-code-php)
* :brazil: **Portekizce:**
   * [fabioars/clean-code-php](https://github.com/fabioars/clean-code-php)
   * [jeanjar/clean-code-php](https://github.com/jeanjar/clean-code-php/tree/pt-br)
* :thailand: **Tayca:**
   * [panuwizzle/clean-code-php](https://github.com/panuwizzle/clean-code-php)
* :fr: **Fransızca:**
   * [errorname/clean-code-php](https://github.com/errorname/clean-code-php)
* :vietnam: **Vietnamca**
   * [viethuongdev/clean-code-php](https://github.com/viethuongdev/clean-code-php)
* :kr: **Korece:**
   * [yujineeee/clean-code-php](https://github.com/yujineeee/clean-code-php)
* :tr: **Turkish:**
   * [anilozmen/clean-code-php](https://github.com/anilozmen/clean-code-php)
   
**[⬆ yukarı çık](#İçindekiler)**
   
