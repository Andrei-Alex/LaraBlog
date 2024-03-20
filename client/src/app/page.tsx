import { Suspense } from 'react';

import getHomeContent from '@/services/homeService/homeServices';
import { ArticleResponse } from '@/services';
import { Articles } from '@/ui/features';
import { Loading } from '@/ui';

export default async function Home() {
  const { data }: ArticleResponse = await getHomeContent();

  return (
    <main>
      <Suspense fallback={<Loading />}>
        <Articles data={data} />
      </Suspense>
    </main>
  );
}
