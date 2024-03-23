'use client';

import { useState, useEffect } from 'react';

export function useWindowSize() {
  const isClient = typeof window === 'object';

  const [isMobile, setIsMobile] = useState<boolean>(
    isClient ? window.innerWidth < 768 : false
  );

  function handleResize() {
    if (isClient) {
      setIsMobile(window.innerWidth < 768);
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

  return isMobile;
}
