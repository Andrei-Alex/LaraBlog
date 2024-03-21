import { INav } from '@/ui/components/NavList/types';
import Link from 'next/link';

function NavList({ navElements }: INav) {
  return (
    <ul className="hidden md:flex justify-between items-center px-4 py-2">
      {navElements.map((element) => (
        <li className="my-2" key={element.id ? element.id : element.title}>
          <Link
            href={element.href}
            className="text-blue-500 hover:text-blue-600 transition-colors duration-200 ease-in-out"
          >
            {element.title}
          </Link>
        </li>
      ))}
    </ul>
  );
}

export default NavList;
