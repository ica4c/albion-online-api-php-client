# Игроки 

`Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient::class`  

### Поиск

###### Метод
`searchPlayer()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$query` - запрос,
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _PlayerNotFoundException_ - если пользователь не найден 

###### Пример

```
$client = new PlayerClient();

$client->searchPlayer(Realm::AMERICA, 'my_name')
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```
---
### Информация о пользователе по его id

###### Метод
`getPlayerInfo()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$playerId` - идентификатор
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _PlayerNotFoundException_ - если пользователь не найден 

###### Пример

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
### Последние смерти игрока

###### Метод
`getPlayerDeaths(string $playerID)`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$playerID` - идентификатор игрока
 
###### Ошибки
 * _FailedToPerformRequestException_ - если что-то пошло не так
 * _PlayerNotFoundException_ - если пользователь не найден 

###### Пример

```
$client = new PlayerClient();

// Find player if needed
$client->searchPlayer(Realm::AMERICA, 'my_name')
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
`getPlayerStatistics()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
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
$client = new PlayerClient();

$client->getPlayerStatistics(Realm::AMERICA, Range::DAY, 5, 0, PlayerStatType::GATHERING, PlayerStatSubType::ORE)
    ->then(
        static function($players) {
            // Do something with player information
        }
    )
```