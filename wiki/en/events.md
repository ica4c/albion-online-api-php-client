# Kill & Death events 

`Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient::class`  

--- 
### Get kill and death events

###### Method
`getEvents()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _int_ `$limit` - limit response results [default = 10],
 * _int_ `$offset` - skip n first values [default = 0],
 * _string_ `$guildId` - display results for single guild [default = null], 

###### Example

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
### Get events sorted by total guild fame

###### Method
`getTopEventsByGuildFame(Range $range = null, int $limit = 10, int $offset = 0)`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
 * _int_ `$limit` - limit response results [default = 10],
 * _int_ `$offset` - skip n first values [default = 0],

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

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
### Top events by player fame 

###### Method
`getTopEventsByPlayerFame()` 

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
 * _int_ `$limit` - limit response results [default = 10],
 * _int_ `$offset` - skip n first values [default = 0],
 * _string_ `$guildId` - look for this guild only [default = null],

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

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
### Top events by player weapon fame

Not sure what it does.  

###### Method
`getTopEventsByPlayerWeaponFame()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
 * [WeaponClass](weaponClass.md) `$weaponCategory` - one of the [WeaponClass](weaponClass.md) values [default=WeaponClass::ALL].
  * _int_ `$limit` - limit response results [default = 10],
  * _int_ `$offset` - skip n first values [default = 0],  

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

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
### Top events by dropped fame 

###### Method
`getTopEventsByKillFame()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
* [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
 * _int_ `$limit` - limit response amount [default = 10],
 * _int_ `$offset` - skip first n values [default = 0],  

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

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