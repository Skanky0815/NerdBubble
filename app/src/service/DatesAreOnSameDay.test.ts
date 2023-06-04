import datesAreOnSameDay from "./DatesAreOnSameDay";

describe('DatesAreOnSameDay', () => {
    test('when both dates are same day then true will be returned', () => {
        expect(datesAreOnSameDay(new Date('2022-01-01'), new Date('2022-01-01'))).toBeTruthy();
    });

    test('when both dates are not the same day then false will be returned', () => {
        expect(datesAreOnSameDay(new Date('2022-01-01'), new Date('2022-01-02'))).toBeFalsy();
    });

    test('when both dates are not the same month then false will be returned', () => {
        expect(datesAreOnSameDay(new Date('2022-02-01'), new Date('2022-01-01'))).toBeFalsy();
    });

    test('when both dates are not the same year then false will be returned', () => {
        expect(datesAreOnSameDay(new Date('2023-01-01'), new Date('2022-01-01'))).toBeFalsy();
    });
});
