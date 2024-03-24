import React from 'react';
import { isEqual } from 'lodash';

import { ICONS_MAP, IIcon } from '.';

/**
 * The Icon component is a versatile and reusable React component designed to render different
 * icons based on the specified iconName.
 * Leveraging the power of the react-icons library, it provides a simple and intuitive way to
 * incorporate icons into a React applications.
 *
 * With a straightforward usage, you can easily customize the appearance of the icons by adjusting
 * the color and size props.
 *
 * To enhance flexibility, the Icon component accepts an optional extraStyles prop
 * allowing you to apply additional styling to the icon container. This feature ensures seamless
 * integration into the application's design and layout.
 *
 * To optimize performance, the component is efficiently memoized using React.Memo along with a custom
 * comparison function. This ensures that unnecessary re-renders are minimized, resulting in a smoother
 * and more responsive user experience.
 *
 * ## Usage
 * ```JSX
 *    <Icon iconName="HiMail" color="blue" size={24} />
 * ```
 *
 * @component Icon
 * @param {Object} extraStyles - Additional styles to be applied to the icon container.
 * @param {string} iconName - The name of the icon to be rendered.
 * @param {string} color - The color of the icon. Defaults to "black".
 * @param {number} size - The size of the icon in pixels. Defaults to 16.
 * @returns {JSX.Element} - The rendered icon component.
 *
 */
export function IconBase({
  extraStyles,
  iconName,
  color = 'black',
  size = 16,
  ...rest
}: IIcon) {
  const IconComponent = ICONS_MAP[iconName];

  if (!IconComponent) return null;

  return (
    <div style={{ height: `${size}px`, ...extraStyles }}>
      <IconComponent
        size={size}
        color={color}
        data-testid={`${iconName}-icon`}
        {...rest}
      />
    </div>
  );
}

const Icon = React.memo(IconBase, isEqual);
export default Icon;
