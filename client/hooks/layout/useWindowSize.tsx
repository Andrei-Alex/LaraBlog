import { useState, useEffect } from 'react';

export function useWindowSize() {
  const isClient = typeof window === 'object';

  const [windowSize, setWindowSize] = useState({
    width: isClient ? window.innerWidth : 0,
  });

  function handleResize() {
    if (isClient) {
      setWindowSize({
        width: window.innerWidth,
      });
    }
  }

  useEffect(() => {
    if (!isClient) {
      return () => {};
    }

    window.addEventListener('resize', handleResize);
    handleResize();

    return () => window.removeEventListener('resize', handleResize);
  }, [isClient]);

  return windowSize;
}
