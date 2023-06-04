import React from 'react';
import { render, screen } from '@testing-library/react';
import Alert from './Alert';
import { AlertType } from '../common/context/AlertContext';
import useAlert from '../common/hook/useAlert';

jest.mock('../common/hook/useAlert');
describe('<Alert />', () => {
    test('renders nothing when no alert is present', () => {
        (useAlert as jest.Mock).mockReturnValue({ text: '', type: '' });

        render(<Alert />);

        expect(screen.queryByTestId('alert')).not.toBeInTheDocument();
    });

    test('renders alert with correct text and color when alert is present', () => {
        (useAlert as jest.Mock).mockReturnValue({ text: 'Test alert', type: AlertType.SUCCESS });

        render(<Alert />);

        const alertElement = screen.getByTestId('alert');
        expect(alertElement).toBeInTheDocument();
        expect(alertElement).toHaveTextContent('Test alert');
        expect(alertElement).toHaveClass('bg-green-100');
    });
});
