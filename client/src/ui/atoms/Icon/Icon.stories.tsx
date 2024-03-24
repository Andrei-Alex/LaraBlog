import { Meta, StoryObj } from '@storybook/react';
import { IconBase } from './Icon';

const meta = {
  title: 'Atoms/Icon',
  component: IconBase,
  parameters: {
    layout: 'centered',
  },
  tags: ['autodocs'],
} satisfies Meta<typeof IconBase>;

export default meta;
export type Story = StoryObj<typeof meta>;
export function Default() {
  return <IconBase iconName="HiMail" />;
}
