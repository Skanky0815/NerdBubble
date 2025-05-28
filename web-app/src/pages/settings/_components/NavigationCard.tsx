import {
    Card,
    CardHeader,
    List,
    ListItem,
    ListItemButton,
    ListItemText,
} from "@mui/material";

export default function NavigationCard() {
    return (
        <Card>
            <CardHeader title="Konfiguration" />

            <List>
                <ListItem>
                    <ListItemButton href="/settings/providers">
                        <ListItemText primary="Anbieter" />
                    </ListItemButton>
                </ListItem>
            </List>
        </Card>
    );
}
