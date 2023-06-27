import React from "react";
import {render, screen} from "@testing-library/react";
import Loading from "./Loading";

describe('<Loading>', () => {
   test('should render the loading', () => {
      render(<Loading color={'red'} />);

      expect(screen.getByText('Loading...')).toBeInTheDocument();
   });
});
