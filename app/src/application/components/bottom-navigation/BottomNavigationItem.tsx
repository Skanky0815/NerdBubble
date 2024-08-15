import React, {PropsWithChildren} from "react";
import {NavLink} from "react-router-dom";
import classNames from "classnames";

type BottomNavigationItemProps = {
    to: string
    color: string
}

export default function BottomNavigationItem({to, color, children}: PropsWithChildren<BottomNavigationItemProps>) {
    const classes = ({ isActive, isPending }: {isActive: boolean, isPending: boolean}) =>
        isPending || isActive ? `p-2 border-b-2 border-${color}-500 text-sm text-white bg-gray-500` : `p-2 pb-4 text-sm text-gray-500 group-hover:text-${color}-800`;

    return (
        <NavLink to={to} className={classes}>
            {children}
        </NavLink>
    );
}
