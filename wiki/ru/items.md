# Внутриигровые предметы

`Albion\OnlineDataProject\Infrastructure\GameInfo\ItemsClient::class`  

### Иконка

Получить бинарные данные квадратной иконки

###### Метод
`getItemIcon(string $itemId, ItemQuality $quality = null, int $enchantment = 0, int $size = 217, string $locale = 'en')`

###### Параметры
 * _string_ `$itemId` - идентификатор предмета.
 * [ItemQuality](itemQuality.md) `$quality` - качество [default = ItemQuality::NORMAL],
 * _int_ `$enchantment` - зачарование [default = 0],
 * _int_ `$size` - разрешение size x size [default = 217]
 * _int_ `$locale` - язык [default = 'en'] 

###### Пример

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
### Информация о предмете

###### Метод
`getItemData(string $itemId)`

###### Параметры
 * _string_ `$itemId` - идентификатор. 

###### Пример

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