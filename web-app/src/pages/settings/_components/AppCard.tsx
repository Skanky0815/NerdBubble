import { Card, CardHeader } from "@mui/material";

export default function AppCard() {
    return (
        <Card>
            <CardHeader
                title="NerdBubble"
                subheader={`Version: ${process.env.NEXT_PUBLIC_VERSION}`}
            />
        </Card>
    );
}
