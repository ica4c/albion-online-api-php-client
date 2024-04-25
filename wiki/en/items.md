# In-game items 

`Albion\OnlineDataProject\Infrastructure\GameInfo\ItemsClient::class`  

### Get icon

Get item square icon

###### Method
`getItemIcon()`

###### Params
 * _string_ `$itemId` - item identifier.
 * [ItemQuality](itemQuality.md) `$quality` - item quality [default = ItemQuality::NORMAL],
 * _int_ `$enchantment` - item enchantment [default = 0],
 * _int_ `$size` - icon dimension size x size [default = 217]
 * _int_ `$locale` - locale [default = 'en'] 

###### Example

Get outstanding quality shield icon  

```
$client = new ItemClient();

$client->getItemIcon(
    'ITEM_SHIELD',
    ItemQuality::OUTSTANDING,
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
`getItemData()`

###### Params
 * _string_ `$itemId` - item identifier. 

###### Example

```
$client = new ItemClient();

$client->getItemData('ITEM_SHIELD')
    ->then(
        static function($binaryData) {
            // Do something with binary data information
        }
    )
```