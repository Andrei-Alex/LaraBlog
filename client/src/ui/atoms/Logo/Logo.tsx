import Image from 'next/image';

import { LogoContainer, ILogo } from '.';

function Logo({ src = '/logo.png', alt = 'Logo', width, height }: ILogo) {
  return (
    <LogoContainer width={width} height={height}>
      <Image src={src} alt={alt} layout="fill" objectFit="contain" />
    </LogoContainer>
  );
}

export default Logo;
