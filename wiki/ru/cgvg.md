# Кристальная лига и GVG 

`Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient::class`  

--- 
### Предстоящие матчи Кристальной лиги

###### Метод
`getCGVGMatches()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0], 

###### Пример

```
$client = new CGVGClient();

$client->getCGVGMatches(Realm::AMERICA)
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
```
--- 
### Получить информацию о CGVG матче по его id

###### Метод
`getCGVGMatchById()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$id` - идентификатор, 

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
$client = new CGVGClient();

$client->getCGVGMatchById(Realm::AMERICA, 'test1234')
    ->then(
        static function($match) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Продвигаемые гильд матчи

Нуждается в уточнении

###### Метод
`getFeaturedGuildMatches()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
$client = new CGVGClient();

$client->getFeaturedGuildMatches(Realm::AMERICA)
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Предстоящие GVG матчи

Нуждается в уточнении 

###### Метод
`getUpcomingGuildMatches(int $limit = 10, int $offset = 0)`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],  

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getUpcomingGuildMatches(Realm::AMERICA)
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Прошедшие GVG матчи

Нуждается в уточнении 

###### Метод
`getPastGuildMatches()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],  
* _string_ `$guildId` - выбрать только для данной гильдии [default = null]

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Примеры

```
$client = new CGVGClient();

$client->getPastGuildMatches(Realm::AMERICA)
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Получить информацию по идентификатору 

###### Метод
`getGuildMatchById()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$id` - идентификатор матча  

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getGuildMatchById(Realm::AMERICA, 'test1234')
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```