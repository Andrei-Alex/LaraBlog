import React from 'react';
import { render, screen } from '@testing-library/react';

import '@testing-library/jest-dom';
import Logo from './Logo';

describe('Logo', () => {
  it('renders correctly and matches snapshot', () => {
    const { asFragment } = render(<Logo />);
    expect(asFragment()).toMatchSnapshot();
  });

  it('renders correctly with default props', () => {
    const { getByAltText } = render(<Logo />);
    const image = getByAltText('Logo');

    expect(image).toBeInTheDocument();
  });

  it('renders with correct width and height', () => {
    const testWidth = '100px';
    const testHeight = '50px';

    render(<Logo width={testWidth} height={testHeight} testID="test-logo" />);
    const logoContainer = screen.getByTestId('test-logo');

    expect(logoContainer).toHaveStyle(`width: ${testWidth}`);
    expect(logoContainer).toHaveStyle(`height: ${testHeight}`);
  });
});
