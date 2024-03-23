'use client';

import { BurgerButton, Icon, Logo, NavList } from '@/ui';
import { useWindowSize } from '../../../../hooks';
import { navItems, styles } from '.';

function Header() {
  const isMobile = useWindowSize();
  return (
    <header className={styles.container}>
      <div>
        <a href="/">
          <Logo width="3rem" height="1rem" style={styles.logo} />
        </a>
        <nav>
          {isMobile ? <BurgerButton /> : <NavList navElements={navItems} />}
        </nav>
      </div>
      <div className={styles.settingAndSearch}>
        <Icon iconName="IoSearchOutline" size={20} />
        <Icon iconName="IoSunnyOutline" size={20} />
      </div>
    </header>
  );
}

export default Header;
