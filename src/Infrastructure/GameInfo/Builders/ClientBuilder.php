<?php

declare(strict_types=1);

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
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;
use GuzzleHttp\Client;

class ClientBuilder
{
    private AllianceClient $allianceClient;
    private BattleClient $battleClient;
    private CGVGClient $cgvgClient;
    private PlayerClient $playerClient;
    private EventClient $eventClient;
    private GuildClient $guildClient;
    private ItemDataClient $itemClient;

    public function __construct(
        protected Client $http,
        protected RealmEndpointResolver $resolver
    ) {
    }

    public function alliances(): AllianceClient
    {
        if (empty($this->allianceClient)) {
            $this->allianceClient = new AllianceClient($this->http, $this->resolver);
        }

        return $this->allianceClient;
    }

    public function battles(): BattleClient
    {
        if (empty($this->battleClient)) {
            $this->battleClient = new BattleClient($this->http, $this->resolver);
        }

        return $this->battleClient;
    }

    public function cgvg(): CGVGClient
    {
        if (empty($this->cgvgClient)) {
            $this->cgvgClient = new CGVGClient($this->http, $this->resolver);
        }

        return $this->cgvgClient;
    }

    public function events(): EventClient
    {
        if (empty($this->eventClient)) {
            $this->eventClient = new EventClient($this->http, $this->resolver);
        }

        return $this->eventClient;
    }

    public function guilds(): GuildClient
    {
        if (empty($this->guildClient)) {
            $this->guildClient = new GuildClient($this->http, $this->resolver);
        }

        return $this->guildClient;
    }

    public function items(): ItemDataClient
    {
        if (empty($this->itemClient)) {
            $this->itemClient = new ItemDataClient($this->http, $this->resolver);
        }

        return $this->itemClient;
    }

    public function players(): PlayerClient
    {
        if (empty($this->playerClient)) {
            $this->playerClient = new PlayerClient($this->http, $this->resolver);
        }

        return $this->playerClient;
    }
}
