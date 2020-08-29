# Альянсы

`Albion\OnlineDataProject\Infrastructure\GameInfo\AllianceClient::class`

К сожалению, API предоставляет доступ лишь к получению информации по идентификатору, поиск не доступен  

### Информация об альянсе

###### Метод
`getAllianceInfo(string $allianceId)`

###### Параметры
* _string_ `$allianceId` - alliance identifier 

###### Пример

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\AllianceClient;

// Можно получить например из информации о пользователе или гильдии 
$allianceId = 'AllianceId';

$client = new AllianceClient();

$client->getAllianceInfo($allianceId)
    ->then(
        static function($data) {
            // Do something with data
        }
    );
```