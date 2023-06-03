import { useState } from "react";

const useLoggedIn = () => {
    const isLoggedIn = (): boolean => {
        return sessionStorage.getItem('loggedIn') === 'true' || false
    };

    const [loggedIn, setLoggedIn] = useState(isLoggedIn());

    const login = () => {
        sessionStorage.setItem('loggedIn', 'true');
        setLoggedIn(true);
    };

    const logout = () => {
        sessionStorage.removeItem('loggedIn');
        setLoggedIn(false);
    };

    return {
        loggedIn,
        login,
        logout
    }
}

export default useLoggedIn;
