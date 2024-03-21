'use client';

import { BurgerButton, Logo, NavList } from '@/ui';
import { useWindowSize } from '@/ui/layouts/Header/hook';
import { navItems } from '.';

function Header() {
  const isMobile = useWindowSize();
  return (
    <header>
      <Logo />
      <nav>
        {isMobile && <BurgerButton />}
        <NavList navElements={navItems} />
      </nav>
    </header>
  );
}

export default Header;
