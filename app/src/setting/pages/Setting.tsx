import React, {useContext} from "react";
import PageTitle from "shared-kernel/components/PageTitle/PageTitle";
import {AuthContext} from "../../authentication/contexts/AuthContext";
import Card, {CardTitle} from "../../shared-kernel/components/Card/Card";
import {ArrowRightOnRectangleIcon} from "@heroicons/react/20/solid";
import KeywordCard from "../components/KeywordCard/KeywordCard";
import ProviderCard from "../components/ProviderCard/ProviderCard";
import {NavLink} from "react-router-dom";

export default function Setting() {
    const {user, signOut: handleLogout} = useContext(AuthContext);

    return (
        <>
            <PageTitle text={`Einstellungen`}>
                <button className="h-8 w-8" data-testid={`singout-button`} onClick={handleLogout}>
                    <ArrowRightOnRectangleIcon className="h-6 w-6 text-gray-500 hover:text-black" />
                </button>
            </PageTitle>
            <div className={`flex flex-col gap-4`}>
                <Card>
                    <CardTitle>Profil</CardTitle>
                    {user &&
                        <>
                            <p>{user.name}</p>
                            <p>{user.email}</p>
                        </>
                    }
                </Card>

                <ProviderCard />

                <Card>
                    <CardTitle>Admin</CardTitle>

                    <ul>
                        <li>
                            <NavLink to='/admin/provider'>Provider verwaltung</NavLink>
                        </li>
                    </ul>
                </Card>
            </div>
        </>
    )
}
