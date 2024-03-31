import React from 'react';
import { render, screen } from '@testing-library/react';
import SkeletonCard from './SkeletonCard';

describe('SkeletonCard', () => {
  it('renders correctly', () => {
    const { asFragment } = render(<SkeletonCard />);
    expect(asFragment()).toMatchSnapshot();
  });
  it('renders correctly', () => {
    render(<SkeletonCard />);
    const skeleton = screen.getByTestId('skeletonCard');
    expect(skeleton).toBeInTheDocument();
  });
  it('should apply given width from props', () => {
    const { container } = render(<SkeletonCard width="200px" />);
    expect(container.firstChild).toHaveStyle('width: 200px');
  });
  it('should apply given height from props', () => {
    const { container } = render(<SkeletonCard height="200px" />);
    expect(container.firstChild).toHaveStyle('height: 200px');
  });
  it('should have flex-direction column when vertical is true', () => {
    const { container } = render(<SkeletonCard vertical />);
    expect(container.firstChild).toHaveStyle('flex-direction: column');
  });

  it('should have flex-direction row when vertical is false', () => {
    const { container } = render(<SkeletonCard vertical={false} />);
    expect(container.firstChild).toHaveStyle('flex-direction: row');
  });
});
