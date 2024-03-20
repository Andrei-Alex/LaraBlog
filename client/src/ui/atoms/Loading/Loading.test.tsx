import { render, screen } from '@testing-library/react';

import Loading from './Loading';
import { styles } from '.';

describe('LoadingAnimation opacity changes', () => {
  it('renders correctly and matches snapshot', () => {
    const { asFragment } = render(<Loading />);
    expect(asFragment()).toMatchSnapshot();
  });
  it('renders and applies correct classes', () => {
    render(<Loading />);
    const loadingElement = screen.getByText(/Loading.../i);
    expect(loadingElement.parentElement).toHaveClass(styles.container);
  });
});
