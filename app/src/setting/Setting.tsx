import React, {useEffect, useState} from "react";
import PageTitle from "../components/PageTitle";
import apiClient from "../service/api";
import useAlert from "../common/hook/useAlert";
import {AlertType} from "../common/context/AlertContext";
import {useNavigate} from "react-router-dom";
import Loading from "../components/Loading";

type SettingProps = {
    logout: () => void
}

type User = {
    id: string
    name: string
    email: string
    created_at: string
    updated_at: string
}

export default function Setting({logout}: SettingProps) {
    const navigate = useNavigate();
    const {setAlert} = useAlert();
    const [user, setUser] = useState<User>();
    const handleLogout = () => {
        apiClient.post('/logout').then(() => {
            logout();
            navigate('/');
        }).catch(res => {
            setAlert(res.response.data.message || res.message, AlertType.ERROR);
        });
    }

    useEffect(() => {
        apiClient.get('api/me').then(res => {
            if (200 === res.status) {
                setUser(res.data);
            }
        }).catch(res => {
            setAlert(res.response.data.message || res.message, AlertType.ERROR);
        });
    }, [setUser, setAlert]);

    return (
        <>
            <PageTitle text={`Einstellungen`} />

            {user ? <h2>{user.name}</h2> : <Loading color={`blue`} />}

            <button
                className={`w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-300 hover:scale-105`}
                onClick={handleLogout}
            >
                Abmelden
            </button>
        </>
    )
}
