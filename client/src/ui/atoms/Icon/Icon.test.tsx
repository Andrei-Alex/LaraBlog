import React from 'react';
import { render, screen } from '@testing-library/react';
import Icon from './Icon';

describe('Icon', () => {
  it('renders correctly', () => {
    const { asFragment } = render(<Icon iconName="HiMail" />);
    expect(asFragment()).toMatchSnapshot();
  });
  it('should display correct icon', () => {
    render(<Icon iconName="HiMail" />);
    expect(screen.getByTestId('HiMail-icon')).toBeInTheDocument();
    expect(
      screen.queryByTestId('MdOutlinePassword-icon')
    ).not.toBeInTheDocument();
  });
  it('should display correct icon', () => {
    render(<Icon iconName="MdOutlinePassword" />);
    expect(screen.getByTestId('MdOutlinePassword-icon')).toBeInTheDocument();
    expect(screen.queryByTestId('HiMail-icon')).not.toBeInTheDocument();
  });
  it('should display correct icon', () => {
    render(<Icon iconName="RxHamburgerMenu" />);
    expect(screen.getByTestId('RxHamburgerMenu-icon')).toBeInTheDocument();
  });
  it('should display correct icon', () => {
    render(<Icon iconName="IoIosArrowDown" />);
    expect(screen.getByTestId('IoIosArrowDown-icon')).toBeInTheDocument();
  });
});
