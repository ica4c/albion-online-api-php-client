# Убийства и смерти 

`Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient::class`  

--- 
### Последние убийства и смерти

###### Метод
`getEvents()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],
* _string_ `$guildId` - ограничить гильдией [default = null], 

###### Пример

```
$client = new EventClient();

$client->getEvents(Realm::AMERICA, 10, 0, 'test1234')
    ->then(
        static function($events) {
            // Do something with event information
        }
    )
```
--- 
### Смерти и убийства по общему фейму гильдии

###### Метод
`getTopEventsByGuildFame()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
$client = new EventClient();

$client->getTopEventsByGuildFame(Realm::AMERICA)
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
`getTopEventsByPlayerFame()` 

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
$client = new EventClient();

$client->getTopEventsByPlayerFame(Realm::AMERICA)
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
`getTopEventsByPlayerWeaponFame()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* [WeaponClass](weaponClass.md) `$weaponCategory` - одно из [WeaponClass](weaponClass.md) [default=WeaponClass::ALL].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
$client = new EventClient();

$client->getTopEventsByPlayerWeaponFame(Realm::AMERICA, Range::WEEK, WeaponClass::AXE)
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
`getTopEventsByKillFame()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
* _int_ `$limit` - ограничить число результатов [default = 10],
* _int_ `$offset` - пропустить n результатов [default = 0],

###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так

###### Пример

```
$client = new EventClient();

$client->getTopEventsByKillFame(Realm::AMERICA)
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