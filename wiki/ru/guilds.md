# Гильдии 

`Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient::class`  

### Найти

###### Метод
`searchGuild()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$query` - запрос,
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
$client = new GuildClient();

$client->searchGuild(Realm::AMERICA, 'my_guild')
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```
---
### Получить информацию по идентификатору

###### Метод
`getGuildInfo()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$guildId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->getGuildInfo(Realm::AMERICA, 'guild-uuid')
    ->then(
        static function($guild) {
            // Do something with guild information
        }
    )
```
---
### Get detailed guild information by id

###### Метод
`getGuildData()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$guildId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
$client = new GuildClient();

$client->getGuildData(Realm::AMERICA, 'guild-uuid')
    ->then(
        static function($guild) {
            // Do something with guild information
        }
    )
```
---
### Get guild players top

###### Метод
`getGuildTopMembers()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$guildId` - идентификатор
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],
* [RegionType](regionType.md) `$regionType` - тип региона [default = RegionType::TOTAl],
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
$client = new GuildClient();

$client->getGuildTopMembers(
    Realm::AMERICA,
    'guild-uuid',
    Range::DAY,
    10,
    0,
    RegionType::HELLGATES
)
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Список участников

###### Метод
`getGuildMembers()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$guildId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
$client = new GuildClient();

$client->getGuildMembers(Realm::AMERICA, 'guild-uuid')
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Топ гильдий по атакам

###### Метод
`getGuildTopByAttacks()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так 

###### Пример

```
$client = new GuildClient();

$client->getGuildTopByAttacks(Realm::AMERICA, Range::WEEK, 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```
---
### Топ гильдий по защите

###### Метод
`getGuildTopByDefences()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так 

###### Пример

```
$client = new GuildClient();

$client->getGuildTopByDefences(Realm::AMERICA, Range::WEEK, 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```

---
### Топ убийств гильдии

###### Method
`getGuildTopEvents()`

###### Params
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$guildId` - идентификатор гильдии
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Throws
* _FailedToPerformRequestException_ - если что-то пошло не так

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;

$client = new GuildClient();

$client->getGuildTopEvents(Realm::AMERICA, 'identifier, Range::WEEK, 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```