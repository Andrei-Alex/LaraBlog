import Image from 'next/image';

import { LogoContainer, ILogo } from '.';

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
