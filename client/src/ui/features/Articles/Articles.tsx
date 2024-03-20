import { ArticleResponse } from '@/services';
import { Card } from '@/ui/components';

export default function Articles({ data }: ArticleResponse) {
  return (
    <>
      {data.map((article) => (
        <Card data={article} key={article.id} />
      ))}
    </>
  );
}
