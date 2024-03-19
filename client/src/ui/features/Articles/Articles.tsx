import { ArticleResponse } from '@/services';
import { Card } from '@/ui/components';

export default async function Articles({ data }: ArticleResponse) {
  return (
    <>
      {data.map((article) => (
        <Card data={article} key={article.id} />
      ))}
    </>
  );
}
