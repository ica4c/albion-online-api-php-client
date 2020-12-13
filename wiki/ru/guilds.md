# Гильдии 

`Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient::class`  

### Найти

###### Метод
`searchGuild(string $query)`

###### Параметры
 * _string_ `$query` - запрос,
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->searchGuild('W0rld Eaters')
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```
---
### Получить информацию по идентификатору

###### Метод
`getGuildInfo(string $guildId)`

###### Параметры
 * _string_ `$guildId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->getGuildInfo('guild-uuid')
    ->then(
        static function($guild) {
            // Do something with guild information
        }
    )
```
---
### Get detailed guild information by id

###### Метод
`getGuildData(string $guildId)`

###### Параметры
 * _string_ `$guildId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->getGuildData('guild-uuid')
    ->then(
        static function($guild) {
            // Do something with guild information
        }
    )
```
---
### Get guild players top

###### Метод
`getGuildTopMembers(string $guildId, Range $range = null, int $limit = 10, int $offset = 0, RegionType $region = null)`

###### Параметры
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
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
use Albion\OnlineDataProject\Domain\RegionType;
use Albion\OnlineDataProject\Domain\Range;
 
$client = new GuildClient();

$client->getGuildTopMembers('guild-uuid', Range::of(Range::DAY), 10, 0, RegionType::of(RegionType::HELLGATES))
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Список участников

###### Метод
`getGuildMembers(string $guildId)`

###### Параметры
 * _string_ `$guildId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _GuildNotFoundException_ - если гильдия не найдена 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->getGuildMembers('guild-uuid')
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Топ гильдий по атакам

###### Метод
`getGuildTopByAttacks(Range $range = null, int $limit = 10, int $offset = 0)`

###### Параметры
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->getGuildTopByAttacks(Range::of(Range::WEEK), 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```
---
### Топ гильдий по защите

###### Метод
`getGuildTopByDefences(Range $range = null, int $limit = 10, int $offset = 0)`

###### Параметры
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient();

$client->getGuildTopByDefences(Range::of(Range::WEEK), 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```

---
### Топ убийств гильдии

###### Method
`getGuildTopEvents(string $guildId, [Range $range = null, int $limit = 10, int $offset = 0])`

###### Params
* _string_ `$guildId` - идентификатор гильдии
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Throws
* _FailedToPerformRequestException_ - если что-то пошло не так

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new GuildClient('identifier');

$client->getGuildTopEvents(Range::of(Range::WEEK), 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```