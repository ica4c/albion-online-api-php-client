# Guilds 

`Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient::class`  

### Find guild

###### Method
`searchGuild(string $query)`

###### Params
 * _string_ `$query` - search query,
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

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
### Get basic guild information by id

###### Method
`getGuildInfo(string $guildId)`

###### Params
 * _string_ `$guildId` - guild id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

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

###### Method
`getGuildData(string $guildId)`

###### Params
 * _string_ `$guildId` - guild id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

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

###### Method
`getGuildTopMembers(string $guildId, Range $range = null, int $limit = 10, int $offset = 0, RegionType $region = null)`

###### Params
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
### Get all guild members

###### Method
`getGuildMembers(string $guildId)`

###### Params
 * _string_ `$guildId` - guild id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _GuildNotFoundException_ - in case if guild not found 

###### Example

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
### Get guilds top by attacks

###### Method
`getGuildTopByAttacks(Range $range = null, int $limit = 10, int $offset = 0)`

###### Params
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
  * _int_ `$limit` - limit response amount [default = 10],
  * _int_ `$offset` - skip first n values [default = 0],
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong 

###### Example

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
### Get guilds top by defence

###### Method
`getGuildTopByDefences(Range $range = null, int $limit = 10, int $offset = 0)`

###### Params
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
  * _int_ `$limit` - limit response amount [default = 10],
  * _int_ `$offset` - skip first n values [default = 0],
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong 

###### Example

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
### Get guilds top events

###### Method
`getGuildTopEvents(string $guildId, [Range $range = null, int $limit = 10, int $offset = 0])`

###### Params
* _string_ `$guildId` - guild identifier
* [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
* _int_ `$limit` - limit response amount [default = 10],
* _int_ `$offset` - skip first n values [default = 0],

###### Throws
* _FailedToPerformRequestException_ - in case if something went wrong

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