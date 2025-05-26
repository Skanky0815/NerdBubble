import { Fab } from "@mui/material";
import { useEffect, useState } from "react";
import { KeyboardArrowUp as KeyboardArrowUpIcon } from "@mui/icons-material";

export default function ScrollTopButton() {
    const [isVisible, setIsVisible] = useState(false);

    const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    };

    const toggleVisibility = () => {
        if (window.scrollY > window.innerHeight) {
            setIsVisible(true);
        } else {
            setIsVisible(false);
        }
    };

    useEffect(() => {
        window.addEventListener("scroll", toggleVisibility);
        return () => {
            window.removeEventListener("scroll", toggleVisibility);
        };
    }, []);

    return (
        <>
            {isVisible && (
                <Fab
                    color="primary"
                    onClick={scrollToTop}
                    style={{
                        position: "fixed",
                        bottom: "20px",
                        right: "20px",
                        zIndex: 1000,
                    }}
                >
                    <KeyboardArrowUpIcon />
                </Fab>
            )}
        </>
    );
}
