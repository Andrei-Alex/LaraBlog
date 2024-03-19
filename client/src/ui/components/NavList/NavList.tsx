import { INav } from '@/ui/components/NavList/types';
import Link from 'next/link';

function NavList({ navElements }: INav) {
  return (
    <ul>
      {navElements.map((element) => (
        <li key={element.id ? element.id : element.title}>
          <Link href={element.href} title={element.title} />
        </li>
      ))}
    </ul>
  );
}

export default NavList;
