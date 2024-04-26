# Players 

`Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient::class`  

### Find player

###### Method
`searchPlayer()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$query` - search query,
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _PlayerNotFoundException_ - in case if guild not found 

###### Example

```
$client = new PlayerClient();

$client->searchPlayer(Realm::AMERICA, 'my-nickname')
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Get player info by his id

###### Method
`getPlayerInfo()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$playerId` - player uuid
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _PlayerNotFoundException_ - in case of not found error 

###### Example

```
$client = new PlayerClient();

$client->getPlayerInfo(Realm::AMERICA, 'guild-uuid')
    ->then(
        static function($player) {
            // Do something with player information
        }
    )
```
---
### Get recent player deaths

###### Method
`getPlayerDeaths()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * _string_ `$playerID` - player id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _PlayerNotFoundException_ - in case if guild not found 

###### Example

```
$client = new PlayerClient();

// Find player if needed
$client->searchPlayer(Realm::AMERICA, 'my_nickname')
    ->then(
        static function($players) use ($client) {
            // Get his deaths
            $client->getPlayerDeaths($players[0]['Id'])
                ->then(
                    static function($deaths) {
                        // Do something with deaths info
                    }
                )
        }
    )
```
---
### Get player statistics

Used for building gathering tops, I guess

###### Method
`getPlayerStatistics()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
 * [Range](range.md) `$range` - one of the [Range](range.md) values [default=Range::DAY].
 * _int_ `$limit` - limit response amount [default = 10],
  * _int_ `$offset` - skip first n values [default = 0],
  * [PlayerStatType](playerStatType.md) `$type` - region type [default = PlayerStatType::PVE],
  * [PlayerStatSubType](playerStatType.md#Player statistics subtype) `$subType` - region type [default = PlayerStatSubType::ALL],
  * [RegionType](regionType.md) `$regionType` - region type [default = RegionType::TOTAl], 
 * _string_ `$guildId` - guild id [default = null]
 * _string_ `$allianceId` - alliance id [default = null]
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong 

###### Example

```
$client = new PlayerClient();

$client->getPlayerStatistics(Realm::AMERICA, Range::DAY, 5, 0, PlayerStatType::GATHERING, PlayerStatSubType::ORE)
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```