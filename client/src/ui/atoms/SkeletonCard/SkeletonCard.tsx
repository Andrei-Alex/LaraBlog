import React from 'react';

import { ISkeletonCard, styles } from '.';

/**
 * Renders a customizable skeleton card that can be used as a placeholder while content is loading.
 * This component is highly flexible, allowing for adjustments to its dimensions, orientation, and more
 * through a set of well-defined props. It's ideal for enhancing the user experience during data fetch operations
 * by providing a visual cue that content is on the way.
 *
 * The component leverages inline styling for dynamic customization and supports both horizontal and vertical layouts.
 * Additionally, a `testID` prop is provided to facilitate testing.
 *
 * ## Props
 *
 * - `width` (string): Specifies the overall width of the skeleton card. Defaults to "200px".
 * - `height` (string): Specifies the overall height of the skeleton card. Defaults to "135px".
 * - `avatarWidth` (string): Determines the width of the avatar placeholder within the card. Defaults to "48px".
 * - `avatarHeight` (string): Determines the height of the avatar placeholder within the card. Defaults to "48px".
 * - `vertical` (boolean): When true, adjusts the layout to a vertical orientation. Defaults to false for a horizontal layout.
 * - `testID` (string): Provides a unique identifier for the component, useful in testing environments. Defaults to "skeletonCard".
 *
 * ## Example Usage
 *
 * ```jsx
 * <SkeletonCard
 *   width="250px"
 *   height="150px"
 *   avatarWidth="50px"
 *   avatarHeight="50px"
 *   vertical={true}
 *   testID="mySkeletonCard"
 * />
 * ```
 *
 * @component
 *
 * @param {Partial<ISkeletonCard>} props - Destructured props object including optional width, height, avatarWidth, avatarHeight, vertical, and testID.
 *
 * @returns {JSX.Element} The `SkeletonCard` component rendered with applied styles and attributes based on props.
 */

function SkeletonCard({
  width = '200px',
  height = '135px',
  avatarWidth = '48px',
  avatarHeight = '48px',
  vertical = false,
  testID = 'skeletonCard',
}: Partial<ISkeletonCard>) {
  const style: React.CSSProperties = {
    width,
    height,
    flexDirection: vertical ? 'column' : 'row',
  };
  const AvatarStyle: React.CSSProperties = {
    marginBottom: vertical ? '12px' : '0px',
    minWidth: avatarWidth,
    minHeight: avatarHeight,
  };
  return (
    <div style={style} className={styles.card} data-testid={testID}>
      <div style={AvatarStyle} className={styles.avatar} />
      <div className={styles.content}>
        <div className={styles.line} />
        <div className={styles.line} />
        <div className={styles.line} />
      </div>
    </div>
  );
}
export default SkeletonCard;
