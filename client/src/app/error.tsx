'use client';

export default function Error({
  error,
}: {
  error: Error & { digest?: string };
}) {
  return (
    <main>
      <h1>{error.digest}</h1>
    </main>
  );
}
