export interface INavElement {
  href: string;
  title: string;
  id?: string;
}

export interface INav {
  navElements: INavElement[];
}
