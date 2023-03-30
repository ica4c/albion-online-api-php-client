<?php

namespace Albion\API\Infrastructure\GameInfo\Builders;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\AllianceClient;
use Albion\API\Infrastructure\GameInfo\BattleClient;
use Albion\API\Infrastructure\GameInfo\CGVGClient;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException;
use Albion\API\Infrastructure\GameInfo\GuildClient;
use Albion\API\Infrastructure\GameInfo\ItemDataClient;
use Albion\API\Infrastructure\GameInfo\PlayerClient;
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmHostResolver;

class ClientBuilder
{
    protected Realm $realm;
    protected RealmHostResolver $resolver;

    private AllianceClient $allianceClient;
    private BattleClient $battleClient;
    private CGVGClient $cgvgClient;
    private PlayerClient $playerClient;
    private EventClient $eventClient;
    private GuildClient $guildClient;
    private ItemDataClient $itemClient;

    /**
     * @param Realm $realm
     */
    public function __construct(Realm $realm)
    {
        $this->realm = $realm;
        $this->resolver = new RealmHostResolver;
    }

    /**
     * @return AllianceClient
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function alliances(): AllianceClient
    {
        if (empty($this->allianceClient)) {
            $this->allianceClient = new AllianceClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->allianceClient;
    }

    /**
     * @return BattleClient
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function battles(): BattleClient
    {
        if (empty($this->battleClient)) {
            $this->battleClient = new BattleClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->battleClient;
    }

    /**
     * @return CGVGClient
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function cgvg(): CGVGClient
    {
        if (empty($this->cgvgClient)) {
            $this->cgvgClient = new CGVGClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->cgvgClient;
    }

    /**
     * @return EventClient
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function events(): EventClient
    {
        if (empty($this->eventClient)) {
            $this->eventClient = new EventClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->eventClient;
    }

    /**
     * @return GuildClient
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function guilds(): GuildClient
    {
        if (empty($this->guildClient)) {
            $this->guildClient = new GuildClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->guildClient;
    }

    /**
     * @return ItemDataClient
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function items(): ItemDataClient
    {
        if (empty($this->itemClient)) {
            $this->itemClient = new ItemDataClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->itemClient;
    }

    /**
     * @return PlayerClient
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     * @throws UnknownRealmProvidedException
     */
    public function players(): PlayerClient
    {
        if (empty($this->playerClient)) {
            $this->playerClient = new PlayerClient($this->resolver->resolveByRealm($this->realm));
        }

        return $this->playerClient;
    }
}