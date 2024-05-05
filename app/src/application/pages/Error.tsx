import PageTitle from "../../shared-kernel/components/PageTitle/PageTitle";
import Card, {CardTitle} from "../../shared-kernel/components/Card/Card";
import {useNavigate} from "react-router-dom";
import Footer from "../components/footer/Footer";
import React from "react";

const Error = () => {
    const navigate = useNavigate();

    return (
        <div className="flex flex-col justify-between content-between w-full min-h-lvh">
            <div className="container mx-auto p-5">
                <PageTitle text={`Fehler!`}/>
                <Card>
                    <CardTitle>404</CardTitle>
                    <p>Irgendetwas ist schiefgelaufen.</p>

                    <a onClick={() => navigate(-1)}>Hier geht's zurück.</a>
                </Card>
            </div>
            <Footer/>
        </div>
    );
}

export default Error;
