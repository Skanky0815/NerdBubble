import {AuthContext} from "../../../authentication/contexts/AuthContext";
import React, {useContext} from "react";
import BottomNavigation from "../bottom-navigation/BottomNavigation";
import {NavLink} from "react-router-dom";

export default function Footer() {
    const {user} = useContext(AuthContext);

    return (
        <footer className={`border-t-2 border-gray-200 bg-white px-4 py-2`}>

            {!user &&
                <div className={`flex flex-col-reverse md:flex-row items-center justify-between gap-2`}>
                    <div className={`text-xs`}>
                        &copy; {(new Date).getFullYear()}, NerdBubble.de by Rico Schulz
                    </div>
                    <div className={`text-xs`}>
                        <NavLink to={`/imprint`}>
                            Impressum
                        </NavLink>
                    </div>
                </div>
            }

            {user && <BottomNavigation />}
        </footer>
    )
}
