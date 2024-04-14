import React from "react";
import {render, screen, waitFor} from "@testing-library/react";
import Button from "./Button";

describe('<Button>', () => {
   test('When button is clicked then the clickHandle should be called.', () => {
       const clickHandler = jest.fn();

       render(<Button btnType={'default'} onClick={clickHandler}>Push Me!</Button>);

       const buttonElement = screen.getByText('Push Me!');

       expect(buttonElement).toBeInTheDocument();
       buttonElement.click();

       waitFor(() => {
          expect(clickHandler).toHaveBeenCalled();
       });
   });
});
