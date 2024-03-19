export interface IArticle {
  id: number;
  title: string;
  subtitle: string;
  content: string;
  created_at: string;
  updated_at: string;
  deleted_at: null;
}

export type ArticleResponse = {
  data: IArticle[];
};
