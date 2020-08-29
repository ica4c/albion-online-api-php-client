# Alliances

`Albion\OnlineDataProject\Infrastructure\GameInfo\AllianceClient::class`

Unfortunately API only allows to get information. Search is unavailable at the moment  

### Get alliance information

###### Method
`getAllianceInfo(string $allianceId)`

###### Params
* _string_ `$allianceId` - alliance identifier 

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\AllianceClient;

// Can be retrieved from i.e user or guild info 
$allianceId = 'AllianceId';

$client = new AllianceClient();

$client->getAllianceInfo($allianceId)
    ->then(
        static function($data) {
            // Do something with data
        }
    );
```