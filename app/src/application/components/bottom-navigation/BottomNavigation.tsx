import React from "react";
import BottomNavigationItem from "./BottomNavigationItem";

export default function BottomNavigation() {

    return(
        <nav
            className={``}
            data-testid="bottom-navigation"
        >
            <div className={`flex flex-row justify-center gap-4`}>
                <BottomNavigationItem to={`/articles`} color={`red`}>
                    Neues
                </BottomNavigationItem>
                <BottomNavigationItem to={`/marked-products`} color={`green`}>
                    Gemerkte Produkte
                </BottomNavigationItem>
                <BottomNavigationItem to={`/settings`} color={`blue`}>
                    Account
                </BottomNavigationItem>
            </div>
        </nav>
    );
}
