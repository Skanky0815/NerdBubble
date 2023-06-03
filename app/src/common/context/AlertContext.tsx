import React, {createContext, PropsWithChildren, useCallback, useState} from "react";

const ALERT_TIME = 5000;
export enum AlertType {
    SUCCESS = 'success',
    ERROR = 'error',
    WARNING = 'waning',
    INFO = 'info'
}
const initialState: AlertStatus = {
    text: null,
    type: null,
};

type AlertStatus = {
    type: AlertType|null,
    text: string|null,
}

const AlertContext = createContext({
    ...initialState,
    setAlert: (_text: string, _type: AlertType) => {},
});

export const AlertProvider = ({ children }: PropsWithChildren) => {
    const [text, setText] = useState<string|null>(null);
    const [type, setType] = useState<AlertType|null>(null);

    const contextValue = {
        text,
        type,
        setAlert: useCallback((text: string, type: AlertType) => {
            setText(text);
            setType(type);

            setTimeout(() => {
                setText(null);
                setType(null);
            }, ALERT_TIME);
        }, [setText, setType])
    }

    return (
        <AlertContext.Provider value={contextValue}>
            {children}
        </AlertContext.Provider>
    );
};

export default AlertContext;

