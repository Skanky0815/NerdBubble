import React, {PropsWithChildren} from "react";
import {NavLink} from "react-router-dom";

type BottomNavigationItemProps = {
    to: string
    color: string
}

export default function BottomNavigationItem({to, color, children}: PropsWithChildren<BottomNavigationItemProps>) {
    const classes = ({ isActive, isPending }: {isActive: boolean, isPending: boolean}) =>
        isPending ? `text-sm text-${color}-800` :
            isActive ? `text-sm text-${color}-800` :
                `text-sm text-gray-500 group-hover:text-${color}-800`

    return (
        <>
            <div className={`inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group`}>
                <NavLink to={to} className={classes}>
                    {children}
                </NavLink>
            </div>
        </>
    );
}
