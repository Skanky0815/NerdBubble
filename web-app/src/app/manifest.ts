import {MetadataRoute} from "next";

export default function manifest(): MetadataRoute.Manifest {
    return {
        name: 'Nerd-Bubble App',
        short_name: 'NerdBubble',
        start_url: '/',
        display: 'standalone',
        background_color: '#ffffff',
        theme_color: '#000000',
        icons: [
            {
                src: "favicon.svg",
                sizes: "64x64 32x32 24x24 16x16",
                type: "image/x-icon"
            },
            {
                src: "d20_logo192.png",
                type: "image/png",
                sizes: "192x192"
            },
            {
                src: "d20_logo512.png",
                type: "image/png",
                sizes: "512x512"
            }
        ]
    }
}
