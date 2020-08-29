# Игроки 

`Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient::class`  

### Поиск

###### Метод
`searchPlayer(string $query)`

###### Параметры
 * _string_ `$query` - запрос,
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _PlayerNotFoundException_ - если пользователь не найден 

###### Пример

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
### Информация о пользователе по его id

###### Метод
`getPlayerInfo(string $playerId)`

###### Параметры
 * _string_ `$playerId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _PlayerNotFoundException_ - если пользователь не найден 

###### Пример

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
### Последние смерти игрока

###### Метод
`getPlayerDeaths(string $playerID)`

###### Параметры
 * _string_ `$playerID` - идентификатор игрока
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _PlayerNotFoundException_ - если пользователь не найден 

###### Пример

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
### Общая статистика пользователей

Использовать для построение топов по собирательству. Нуждается в уточнении!

###### Метод
`getPlayerStatistics(Range $range = null, int $limit = 10, int $offset = 0, PlayerStatType $type = null, PlayerStatSubType $subType = null, RegionType $region = null, string $guildId = null, string $allianceId = null)`

###### Параметры
 * [Range](range.md) `$range` - одно из [Range](range.md) [default=Range::DAY].
 * _int_ `$limit` - ограничить число результатов [default = 10],
 * _int_ `$offset` - пропустить n результатов [default = 0],
* [PlayerStatType](playerStatType.md) `$type` - тип статистики [default = PlayerStatType::PVE],
* [PlayerStatSubType](playerStatType.md#Player statistics subtype) `$subType` - подкласс статистики [default = PlayerStatSubType::ALL],
* [RegionType](regionType.md) `$regionType` - регион [default = RegionType::TOTAl], 
 * _string_ `$guildId` - идентификатор гильдии [default = null]
 * _string_ `$allianceId` - идентификатор альянса [default = null]
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так 

###### Пример

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