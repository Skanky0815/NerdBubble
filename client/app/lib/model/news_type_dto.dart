enum NewsTypeDto {
  asmodee,
  fantasyFlightGames,
  ulissesSpiele,
  fShop,
  dmdWizar,
  tsw3,
  blueBrixx,
  xboxDynasty,
  railSim,
}

NewsTypeDto newsTypeFromString(String value) {
  switch(value) {
    case 'ASMODEE':
      return NewsTypeDto.asmodee;
    case 'FANTASY_FLIGHT_GAMES':
      return NewsTypeDto.fantasyFlightGames;
    case 'ULISSES_SPIELE':
      return NewsTypeDto.ulissesSpiele;
    case 'F_SHOP':
      return NewsTypeDto.fShop;
    case 'TSW3':
      return NewsTypeDto.tsw3;
    case 'BLUE_BRIXX':
      return NewsTypeDto.blueBrixx;
    case 'XBOX_DYNASTY':
      return NewsTypeDto.xboxDynasty;
    case 'RAIL_SIM':
      return NewsTypeDto.railSim;
    default:
      throw Exception('missing NewType');
  }
}