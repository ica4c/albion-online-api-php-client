# Убийства и смерти 

`Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient::class`  

--- 
### Последние убийства и смерти

###### Метод
`getEvents([int $limit = 10, int $offset = 0, string $guildId = null, string $guildId = null])`

###### Параметры
 * _int_ `$limit` - ограничить число результатов [default = 10],
 * _int_ `$offset` - пропустить n результатов [default = 0],
 * _string_ `$guildId` - ограничить гильдией [default = null], 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient;
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
  
$client = new EventClient();

$client->getEvents(10, 0, 'test1234')
    ->then(
        static function($events) {
            // Do something with event information
        }
    )
```
--- 
### Смерти и убийства по общему фейму гильдии

###### Метод
`getTopEventsByGuildFame(Range $range = null, int $limit = 10, int $offset = 0)`

###### Параметры
 * [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
 * _int_ `$limit` - ограничить число результатов [default = 10],
 * _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient;
 
$client = new EventClient();

$client->getTopEventsByGuildFame()
    ->then(
        static function($events) {
            // Do something with event information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Топ по фейму игроков 

###### Метод
`getTopEventsByPlayerFame(Range $range = null, int $limit = 10, int $offset = 0)` 

###### Параметры
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient;
 
$client = new EventClient();

$client->getTopEventsByPlayerFame()
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
### Топ по фейму с ограничение по оружию

Нуждается в уточнении

###### Метод
`getTopEventsByPlayerWeaponFame(Range $range = null, WeaponClass $weaponCategory = null, int $limit = 10, int $offset = 0)`

###### Параметры
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* [WeaponClass](weaponClass.md) `$weaponCategory` - одно из [WeaponClass](weaponClass.md) [default=WeaponClass::ALL].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient;
 
$client = new EventClient();

$client->getTopEventsByPlayerWeaponFame(Range::of(Range::WEEK), WeaponClass::of(WeaponClass::AXE))
    ->then(
        static function($events) {
            // Do something with event information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Топ по общему дропу фейма

###### Метод
`getTopEventsByKillFame(Range $range = null, int $limit = 10, int $offset = 0)`

###### Параметры
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient;
 
$client = new EventClient();

$client->getTopEventsByKillFame()
    ->then(
        static function($events) {
            // Do something with events information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```