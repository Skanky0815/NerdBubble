import createClient from "openapi-fetch";
import {paths} from "@/_libs/client/shema";

const client = createClient<paths>({
    baseUrl: process.env.NEXT_PUBLIC_BACKEND_API_URL,
    headers: {
        "Content-Type": "application/json",
    },
});

export default client;
