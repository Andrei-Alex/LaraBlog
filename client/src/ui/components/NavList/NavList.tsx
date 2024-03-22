import { INav } from '@/ui/components/NavList/types';
import Link from 'next/link';

function NavList({ navElements }: INav) {
  return (
    <ul className="hidden md:flex justify-between items-center px-4 ">
      {navElements.map((element) => (
        <li className="mr-2" key={element.id ? element.id : element.title}>
          <Link
            href={element.href}
            className="text-black hover:text-blue transition-colors duration-200 ease-in-out "
          >
            {element.title}
          </Link>
        </li>
      ))}
    </ul>
  );
}

export default NavList;
