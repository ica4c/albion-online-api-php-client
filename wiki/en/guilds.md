# Guilds 

`Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient::class`  

### Find guild

###### Method
`searchGuild(string $query)`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$query` - search query,
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

```
$client = new GuildClient();

$client->searchGuild(Realm::AMERICA, 'my-guild-name')
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```
---
### Get basic guild information by id

###### Method
`getGuildInfo()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$guildId` - guild id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

```
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

###### Method
`getGuildData()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$guildId` - guild id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

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

###### Method
`getGuildTopMembers()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$guildId` - guild id
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
 * _int_ `$limit` - limit response amount [default = 10],
 * _int_ `$offset` - skip first n values [default = 0],
 * [RegionType](regionType.md) `$regionType` - region type [default = RegionType::TOTAl],
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

```
$client = new GuildClient();

$client->getGuildTopMembers(Realm::AMERICA, 'guild-uuid', Range::of(Range::DAY), 10, 0, RegionType::of(RegionType::HELLGATES))
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Get all guild members

###### Method
`getGuildMembers(string $guildId)`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$guildId` - guild id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

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
### Get guilds top by attacks

###### Method
`getGuildTopByAttacks()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
  * _int_ `$limit` - limit response amount [default = 10],
  * _int_ `$offset` - skip first n values [default = 0],
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong 

###### Example

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
### Get guilds top by defence

###### Method
`getGuildTopByDefences()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
  * _int_ `$limit` - limit response amount [default = 10],
  * _int_ `$offset` - skip first n values [default = 0],
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong 

###### Example

```
$client = new GuildClient();

$client->getGuildTopByDefences(Realm::AMERICA, Range::of(Range::WEEK), 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```

---
### Get guilds top events

###### Method
`getGuildTopEvents()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
* _string_ `$guildId` - guild identifier
* [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
* _int_ `$limit` - limit response amount [default = 10],
* _int_ `$offset` - skip first n values [default = 0],

###### Throws
* _FailedToPerformRequestException_ - in case if something went wrong

###### Example

```
$client = new GuildClient();

$client->getGuildTopEvents(Realm::AMERICA, 'identifier', Range::of(Range::WEEK), 15, 0)
    ->then(
        static function($guilds) {
            // Do something with guilds information
        }
    )
```