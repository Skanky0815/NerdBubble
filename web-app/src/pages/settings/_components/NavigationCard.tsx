import {
    Card,
    CardHeader,
    List,
    ListItem,
    ListItemButton,
    ListItemText,
} from "@mui/material";
import Link from "next/link";

export default function NavigationCard() {
    return (
        <Card>
            <CardHeader title="Konfiguration" />

            <List>
                <ListItem>
                    <ListItemButton href="/settings/providers" component={Link}>
                        <ListItemText primary="Anbieter" />
                    </ListItemButton>
                </ListItem>
            </List>
        </Card>
    );
}
