import React, {useContext} from "react";
import PageTitle from "shared-kernel/components/PageTitle/PageTitle";
import {AuthContext} from "../../authentication/contexts/AuthContext";
import Card, {CardTitle} from "../../shared-kernel/components/Card/Card";
import {ArrowRightOnRectangleIcon} from "@heroicons/react/20/solid";

export default function Setting() {
    const {user, signOut: handleLogout} = useContext(AuthContext);

    return (
        <>
            <PageTitle text={`Einstellungen`}>
                <button className="h-8 w-8" data-testid={`singout-button`} onClick={handleLogout}>
                    <ArrowRightOnRectangleIcon className="h-6 w-6 text-gray-500 hover:text-black"  />
                </button>
            </PageTitle>
            <Card>
                <CardTitle>Profil</CardTitle>
                {user &&
                    <>
                        <p>{user.name}</p>
                        <p>{user.email}</p>
                    </>
                }
            </Card>
        </>
    )
}
