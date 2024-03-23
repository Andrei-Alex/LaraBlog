import { HiMail } from 'react-icons/hi';
import { MdOutlinePassword } from 'react-icons/md';
import { RxHamburgerMenu } from 'react-icons/rx';
import { IoIosArrowDown } from 'react-icons/io';
import { AiOutlineCloseCircle } from 'react-icons/ai';
import { IoSearchOutline, IoSunnyOutline } from 'react-icons/io5';

export type Icons =
  | 'HiMail'
  | 'MdOutlinePassword'
  | 'RxHamburgerMenu'
  | 'IoIosArrowDown'
  | 'IoSearchOutline'
  | 'IoSunnyOutline'
  | 'AiOutlineCloseCircle';

export type IconTypes =
  | typeof HiMail
  | typeof MdOutlinePassword
  | typeof RxHamburgerMenu
  | typeof IoIosArrowDown
  | typeof AiOutlineCloseCircle
  | typeof IoSearchOutline
  | typeof IoSunnyOutline;

export interface IIcon {
  extraStyles?: React.CSSProperties;
  iconName: Icons;
  size?: number;
  color?: string;
}
