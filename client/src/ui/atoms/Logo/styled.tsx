import styled from 'styled-components';

export const LogoContainer = styled.div<{ height?: string; width?: string }>`
  height: ${({ height }) => height || '60px'};
  width: ${({ width }) => width || '120px'};
  cursor: pointer;
  position: relative;
  display: inline-block;
`;
