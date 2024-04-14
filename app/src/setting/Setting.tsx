import React, {useContext} from "react";
import Loading from "shared-kernel/components/Loading/Loading";
import PageTitle from "shared-kernel/components/PageTitle/PageTitle";
import {AuthContext} from "../authentication/contexts/AuthContext";
import Button from "../shared-kernel/components/Button/Button";
import Card from "../shared-kernel/components/Card/Card";

export default function Setting() {
    const {user, signOut: handleLogout} = useContext(AuthContext);

    return (
        <Card>
            <PageTitle text={`Einstellungen`} />

            {user ? <h2>{user.name}</h2> : <Loading color={`blue`} />}

            <Button btnType={'default'} onClick={handleLogout}>
                Abmelden
            </Button>
        </Card>
    )
}
