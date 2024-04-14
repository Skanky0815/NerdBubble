import React from 'react';
import {render, screen} from "@testing-library/react";
import PageTitle from "./PageTitle";

describe('<PageTitle />', () => {
    test('should render the page title', () => {
        render(<PageTitle text={`My Title`} />);

        expect(screen.getByText('My Title')).toBeInTheDocument();
    });
});
