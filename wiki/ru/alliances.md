# Альянсы

`Albion\OnlineDataProject\Infrastructure\GameInfo\AllianceClient::class`

К сожалению, API предоставляет доступ лишь к получению информации по идентификатору, поиск не доступен  

### Информация об альянсе

###### Метод
`getAllianceInfo()`

###### Параметры
* [Realm](realm.md) `$realm` - одно из [Realm](realm.md).
* _string_ `$allianceId` - alliance identifier 

###### Пример

```
// Можно получить например из информации о пользователе или гильдии 
$allianceId = 'AllianceId';
$realm = Realm::AMERICA;

$client = new AllianceClient();

$client->getAllianceInfo($realm, $allianceId)
    ->then(
        static function($data) {
            // Do something with data
        }
    );
```