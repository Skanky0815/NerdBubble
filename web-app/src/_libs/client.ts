import { paths } from "@/_libs/client/shema";
import createFetchClient from "openapi-fetch";
import createClient from "openapi-react-query";

function getCookie(name: string): string | undefined {
    const cookieValue = document.cookie
        .split("; ")
        .find((row) => row.startsWith(name + "="))
        ?.split("=")[1];
    return cookieValue ? decodeURIComponent(cookieValue) : undefined;
}

const fetchClient = createFetchClient<paths>({
    baseUrl: "http://localhost/api", // process.env.NEXT_PUBLIC_BACKEND_API_URL
    fetch: (url: string, options: any) => {
        return fetch(url, {
            ...options,
            credentials: "include",
            headers: {
                ...options?.headers,
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-XSRF-TOKEN": getCookie("XSRF-TOKEN") || "",
            },
        });
    },
});

const client = createClient(fetchClient);

export default client;
