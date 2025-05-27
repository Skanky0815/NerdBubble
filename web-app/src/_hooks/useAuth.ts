import { useContext } from "react";
import { AuthContext } from "@/_contexts/AuthContext";

export default function useAuth() {
    const context = useContext(AuthContext);

    if (context === undefined) {
        throw new Error("useUser must be used within a UserProvider");
    }

    return context;
}
