<?php declare(strict_types=1);

namespace Domains\Article\ValueObjects;

enum Provider: string
{
    case RAIL_SIM = 'rail_sim';
    case ASMODEE = 'asmodee';
    case XBOX_DYNASTY = 'xbox_dynasty';
    case TSW = 'tsw';
    case ULISSES_SPIELE = 'ulisses_spiele';
    case F_SHOP = 'f_shop';
    case BLUE_BRIXX = 'blue_brixx';
    case FANTASY_FLIGHT_GAMES = 'fantasy_flight_games';

    public static function getAllValues(): array
    {
        return array_column(Provider::cases(), 'value');
    }
}
