import React, {FormEvent, useRef} from "react";
import PageTitle from "../components/PageTitle";
import useAlert from "../common/hook/useAlert";
import apiClient from "../service/api";
import {AlertType} from "../common/context/AlertContext";

type LoginFormProps = {
    login: () => void
}

export default function LoginForm({login}: LoginFormProps) {
    const emailRef = useRef<HTMLInputElement>(null);
    const passwordRef = useRef<HTMLInputElement>(null);
    const { setAlert } = useAlert();

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();

        apiClient.get('/sanctum/csrf-cookie').then(() => {
            apiClient.post('/login', {
                email: emailRef.current?.value,
                password: passwordRef.current?.value
            }).then(res => {
                if (200 === res.status) {
                    login();
                }
            }).catch(res => {
                setAlert(res.response.data.message || res.message, AlertType.ERROR);
            });
        });
    }

    return (
        <>
            <PageTitle text={`Anmelden`} />
            <div className="bg-white rounded-xl shadow-lg p-8 mb-5">
                <form className="space-y-6" onSubmit={handleSubmit} data-testid="login-form">
                    <div>
                        <label className="block mb-2 text-sm font-medium text-gray-900">E-Mail-Adresse:</label>
                        <input
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                            type="email"
                            data-testid="email"
                            ref={emailRef}
                        />
                    </div>
                    <div>
                        <label className="block mb-2 text-sm font-medium text-gray-900">Passwort:</label>
                        <input
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                            type="password"
                            data-testid="password"
                            ref={passwordRef}
                            autoComplete="off"
                        />
                    </div>
                    <button
                        className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-300 hover:scale-105"
                        data-testid="login"
                        type="submit"
                    >
                        Anmelden
                    </button>
                    <button
                        className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        type="reset"
                    >
                        Abbrechen
                    </button>
                </form>
            </div>
        </>
    );
}
