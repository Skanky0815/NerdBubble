package me.ricoschulz.valueObject

import kotlin.reflect.KSuspendFunction1
import kotlinx.coroutines.Deferred
import kotlinx.coroutines.DelicateCoroutinesApi
import me.ricoschulz.crawler.asmodee
import me.ricoschulz.crawler.blueBrixx
import me.ricoschulz.crawler.fShop
import me.ricoschulz.crawler.fantasyFlightGames
import me.ricoschulz.crawler.railSim
import me.ricoschulz.crawler.tsw3
import me.ricoschulz.crawler.ulissesSpiele
import me.ricoschulz.crawler.xboxDynasty

@DelicateCoroutinesApi
enum class Provider(
    val crawler: KSuspendFunction1<(News) -> Unit, Deferred<Unit>>,
) {
    ASMODEE(::asmodee), // change for hash
    FANTASY_FLIGHT_GAMES(::fantasyFlightGames),
    ULISSES_SPIELE(::ulissesSpiele),
    F_SHOP(::fShop),
    // DMD_WIZAR("https://dnd.wizards.com/news", dndWizard)
    TSW3(::tsw3),
    BLUE_BRIXX(::blueBrixx),
    XBOX_DYNASTY(::xboxDynasty),
    RAIL_SIM(::railSim)
    // youtube api
}
