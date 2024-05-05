import React, {useContext} from "react";
import PageTitle from "shared-kernel/components/PageTitle/PageTitle";
import {AuthContext} from "../authentication/contexts/AuthContext";
import Button from "../shared-kernel/components/Button/Button";
import Card from "../shared-kernel/components/Card/Card";

export default function Setting() {
    const {user, signOut: handleLogout} = useContext(AuthContext);

    return (
        <>
            <PageTitle text={`Account`} />
            <Card>
                <h2 className={`text-gray-500 font-bold mb-3`}>Profil</h2>
                {user && <h2>{user.name}</h2>}

                <Button btnType={'default'} onClick={handleLogout}>
                    Abmelden
                </Button>
            </Card>
        </>
    )
}
