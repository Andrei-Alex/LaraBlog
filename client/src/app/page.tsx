import getHomeContent from '@/services/homeService/homeServices';
import { ArticleResponse } from '@/services';
import { Articles } from '@/ui/features';

export default async function Home() {
  const { data }: ArticleResponse = await getHomeContent();

  return (
    <main>
      <Articles data={data} />
    </main>
  );
}
