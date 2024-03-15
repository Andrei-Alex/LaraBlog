import Image from 'next/image';

import { LogoContainer, ILogo } from '.';

/**
 *
 * The Logo component is a React functional component utilized for displaying a logo within a user interface.
 * It leverages the `next/image` component for optimized image handling and the styled-component `LogoContainer` for styling.
 * This component accepts several optional props to customize the logo's appearance and accessibility features.
 *
 * ## Usage
 * ```jsx
 *   <Logo src="/custom-logo.png" alt="Custom Logo" width="100px" height="50px" />
 * ```
 *
 * @component Logo
 * @param {Object} props - The props object containing the following properties:
 * @param {string} [props.src='/logo.png'] - The source URL of the logo image. Defaults to '/logo.png'.
 * @param {string} [props.alt='Logo'] - The alt text for the logo image, enhancing accessibility. Defaults to 'Logo'.
 * @param {string} [props.width] - The width of the logo. This is passed to the `LogoContainer` for styling.
 * @param {string} [props.height] - The height of the logo. This is also passed to the `LogoContainer` for styling.
 * @param {string} [props.testID='logo'] - An identifier for testing purposes. Defaults to 'logo'.
 *
 * @returns {JSX.Element} - Returns a JSX element of the `LogoContainer` wrapping the `Image` component from `next/image`.
 *
 */

function Logo({
  src = '/logo.png',
  alt = 'Logo',
  width,
  height,
  testID = 'logo',
}: ILogo) {
  return (
    <LogoContainer width={width} height={height} data-testid={testID}>
      <Image src={src} alt={alt} layout="fill" />
    </LogoContainer>
  );
}

export default Logo;
