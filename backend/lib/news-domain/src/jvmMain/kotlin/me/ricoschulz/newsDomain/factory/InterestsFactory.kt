package me.ricoschulz.newsDomain.factory

import me.ricoschulz.newsDomain.repository.Interests

abstract class InterestsFactory {
    abstract fun build(): Interests
}
