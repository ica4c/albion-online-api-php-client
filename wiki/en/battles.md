# Battles

`Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient::class`  

### Get battle list

###### Method
`getBattles(Range $range, int $limit, int $offset, BattleSortType $sort, string $guildId)`

###### Params
 * [Range](range.md) `$range` - one of the [Range](range.md) values.
 * _int_ `$limit` - limit response results [default = 10],
 * _int_ `$offset` - skip n first values [default = 0],
 * [BattleSortType](battleSort.md) `$sort` - sort battles by [BattleSortType](battleSort.md) [default = BattleSortType::RECENT]
 * _string_ `$guildId` - look for this guild only

###### Example

Get the current day most famous battles  

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient;
 
$client = new BattleClient();

$client->getBattles(
    Range::of(Range::DAY),
    1,
    0,
    BattleSortType::of(BattleSortType::TOTAL_FAME)
)
    ->then(
        static function($battles) {
            // Do something with battles information
        }
    )
```