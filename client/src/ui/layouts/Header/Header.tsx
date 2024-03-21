import { Logo } from '@/ui';
import Link from 'next/link';

function Header() {
  return (
    <header>
      <Logo />
      <nav>
        <ul>
          <li>
            <Link href="/blog" />
            <Link href="/contact" />
            <Link href="/about" />
          </li>
        </ul>
      </nav>
    </header>
  );
}

export default Header;
