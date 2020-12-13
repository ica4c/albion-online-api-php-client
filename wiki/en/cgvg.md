# A crystal league and guild matches 

`Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient::class`  

--- 
### Upcoming crystal league events

###### Method
`getCGVGMatches(int $limit = 10, int $offset = 0)`

###### Params
 * _int_ `$limit` - limit response results [default = 10],
 * _int_ `$offset` - skip n first values [default = 0], 

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getCGVGMatches()
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
```
--- 
### Crystal league event by id

###### Method
`getCGVGMatchById(string $id)`

###### Params
 * _string_ `$id` - event id, 

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getCGVGMatchById('test1234')
    ->then(
        static function($match) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Featured guild matches

Not sure what it does. Might be legacy endpoint. 

###### Method
`getFeaturedGuildMatches()` 

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getFeaturedGuildMatches()
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Upcoming guild matches

Not sure what it does. Might be legacy endpoint. 

###### Method
`getUpcomingGuildMatches(int $limit = 10, int $offset = 0)`

###### Params
 * _int_ `$limit` - limit response amount [default = 10],
 * _int_ `$offset` - skip first n values [default = 0],  

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getUpcomingGuildMatches()
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Past guild matches

Not sure what it does. Might be legacy endpoint. 

###### Method
`getPastGuildMatches([int $limit = 10, int $offset = 0, string $guildId = null])`

###### Params
 * _int_ `$limit` - limit response amount [default = 10],
 * _int_ `$offset` - skip first n values [default = 0],  
 * _string_ `$guildId` - look for this guild only [default = null]

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getPastGuildMatches()
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```
--- 
### Guild match by id

Not sure what it does. Might be legacy endpoint. 

###### Method
`getGuildMatchById(string $id)`

###### Params
 * _string_ `$id` - match uuid  

###### Throws
 * _FailedToPerformRequestException_ - in case if something went wrong

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;
 
$client = new CGVGClient();

$client->getGuildMatchById('test1234')
    ->then(
        static function($matches) {
            // Do something with battles information
        }
    )
    ->catch(
        static function($exception) {
            // Do something with exception
        }
    )
```