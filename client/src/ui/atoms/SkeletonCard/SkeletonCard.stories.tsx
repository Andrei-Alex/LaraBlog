import { Meta, StoryObj } from '@storybook/react';

import SkeletonCard from './SkeletonCard';

const meta = {
  title: 'Atoms/SkeletonCard',
  component: SkeletonCard,
  parameters: {
    layout: 'centered',
  },
  tags: ['autodocs'],
  argTypes: {
    width: {
      name: 'Width',
      type: { name: 'string', required: false },
      control: 'text',
      description: 'Component width',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: '200px' },
      },
    },
    height: {
      name: 'Height',
      type: { name: 'string', required: false },
      control: 'text',
      description: 'Component height',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: '135px' },
      },
    },
    vertical: {
      name: 'Vertical',
      type: { name: 'string', required: false },
      control: 'boolean',
      description: 'Change the orientation of the card',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: 'false' },
      },
    },
    testID: {
      name: 'Test ID',
      type: { name: 'string', required: false },
      control: 'text',
      description: 'ID for testing library',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'skeletonCard' },
      },
    },
  },
  args: {
    width: '200px',
    height: '135px',
    vertical: false,
    testID: 'skeletonCard',
  },
} satisfies Meta<typeof SkeletonCard>;

export default meta;
export type Story = StoryObj<typeof meta>;
export const Primary: Story = {
  args: {
    width: '200px',
    height: '135px',
  },
};
