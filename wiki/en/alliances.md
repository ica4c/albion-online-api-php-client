# Alliances

`Albion\OnlineDataProject\Infrastructure\GameInfo\AllianceClient::class`

Unfortunately API only allows to get information. Search is unavailable at the moment  

### Get alliance information

###### Method
`getAllianceInfo()`

###### Params
* [Realm](realm.md) `$realm` - one of [Realm](realm.md).
* _string_ `$allianceId` - alliance identifier 

###### Example

```
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