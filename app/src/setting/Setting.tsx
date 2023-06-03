import React from "react";
import PageTitle from "../components/PageTitle";
import apiClient from "../service/api";
import useAlert from "../common/hook/useAlert";
import {AlertType} from "../common/context/AlertContext";
import {useNavigate} from "react-router-dom";

type SettingProps = {
    logout: () => void
}

export default function Setting({logout}: SettingProps) {
    const navigate = useNavigate();
    const {setAlert} = useAlert();
    const handleLogout = () => {
        apiClient.post('/logout').then(() => {
            logout();
            navigate('/');
        }).catch(res => {
            setAlert(res.response.data.message || res.message, AlertType.ERROR);
        });
    }

    return (
        <>
            <PageTitle text={`Coming soon...`} />

            <button
                className={`w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-300 hover:scale-105`}
                onClick={handleLogout}
            >
                Abmelden
            </button>
        </>
    )
}
