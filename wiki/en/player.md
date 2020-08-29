# Players 

`Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient::class`  

### Find player

###### Method
`searchPlayer(string $query)`

###### Params
 * _string_ `$query` - search query,
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _PlayerNotFoundException_ - in case if guild not found 

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient;
 
$client = new PlayerClient();

$client->searchPlayer('Agress0r')
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Get player info by his id

###### Method
`getPlayerInfo(string $playerId)`

###### Params
 * _string_ `$playerId` - player uuid
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _PlayerNotFoundException_ - in case of not found error 

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
 
$client = new PlayerClient();

$client->getPlayerInfo('guild-uuid')
    ->then(
        static function($player) {
            // Do something with player information
        }
    )
```
---
### Get recent player deaths

###### Method
`getPlayerDeaths(string $playerID)`

###### Params
 * _string_ `$playerID` - player id
 
###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong
 * _PlayerNotFoundException_ - in case if guild not found 

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient;
 
$client = new PlayerClient();

// Find player if needed
$client->searchPlayer('Agress0r')
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
`getPlayerStatistics(Range $range = null, int $limit = 10, int $offset = 0, PlayerStatType $type = null, PlayerStatSubType $subType = null, RegionType $region = null, string $guildId = null, string $allianceId = null)`

###### Params
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
use Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient;
use Albion\OnlineDataProject\Domain\RegionType;
use Albion\OnlineDataProject\Domain\Range;
 
$client = new PlayerClient();

$client->getPlayerStatistics(Range::of(Range::DAY), 5, 0, PlayerStatType::of(PlayerStatType::GATHERING). PlayerStatSubType::of(PlayerStatSubType::ORE))
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```