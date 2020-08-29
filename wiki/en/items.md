# In-game items 

`Albion\OnlineDataProject\Infrastructure\GameInfo\ItemsClient::class`  

### Get icon

Get item square icon

###### Method
`getItemIcon(string $itemId, ItemQuality $quality = null, int $enchantment = 0, int $size = 217, string $locale = 'en')`

###### Params
 * _string_ `$itemId` - item identifier.
 * [ItemQuality](itemQuality.md) `$quality` - item quality [default = ItemQuality::NORMAL],
 * _int_ `$enchantment` - item enchantment [default = 0],
 * _int_ `$size` - icon dimension size x size [default = 217]
 * _int_ `$locale` - locale [default = 'en'] 

###### Example

Get outstanding quality shield icon  

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient;
 
$client = new ItemClient();

$client->getItemIcon(
    'ITEM_SHIELD',
    ItemQuality::of(ItemQuality::OUTSTANDING),
    (int) rand(0, 3),
)
    ->then(
        static function($binaryData) {
            // Do something with binary data information
        }
    )
```
---
### Get item data

###### Method
`getItemData(string $itemId)`

###### Params
 * _string_ `$itemId` - item identifier. 

###### Example

```
use Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient;
 
$client = new ItemClient();

$client->getItemData('ITEM_SHIELD')
    ->then(
        static function($binaryData) {
            // Do something with binary data information
        }
    )
```