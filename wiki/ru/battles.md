# Битвы

`Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient::class`  

### Все последние

###### Метод
`getBattles(Range $range, [int $limit, int $offset, BattleSortType $sort, string $guildId = null])`

###### Параметры
 * [Range](range.md) `$range` - одно из [Range](range.md).
 * _int_ `$limit` - ограничить количество возвращаемых записей [default = 10],
 * _int_ `$offset` - пропустить первые n элементов [default = 0],
 * [BattleSortType](battleSort.md) `$sort` - сортировать по [BattleSortType](battleSort.md) [default = BattleSortType::RECENT]
 * _string_ `$guildId` - выбрать только для данной гильдии [default = null]

###### Пример  

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