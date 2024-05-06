import Card, {CardTitle} from "../../../shared-kernel/components/Card/Card";

export default function ProviderCard() {
    return(
        <Card>
            <CardTitle>Provider</CardTitle>

            <p>Hier wirst du bald auswählen können, welche Provider für dich relevant sind und von wem du Neuigkeiten angezeigt bekommt.</p>
            <p>Später soll es auch möglich sein, frei neue Provider anzulegen von denen Daten aggregiert werden.</p>
        </Card>
    );
}
