import React from "react";
import BottomNavigationItem from "./BottomNavigationItem";

export default function BottomNavigation() {
    return(
        <>
            <nav
                className={`fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200`}
                data-testid="bottom-navigation"
            >
                <div className={`grid h-full max-w-lg grid-cols-2 mx-auto`}>
                    <BottomNavigationItem to={`/`} color={`red`}>
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
        </>
    );
}
