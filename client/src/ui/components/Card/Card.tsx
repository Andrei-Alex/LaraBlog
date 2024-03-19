import React from 'react';

import { ICard } from '.';

export default async function Card({ data }: ICard) {
  return (
    <div>
      <h2>{data.title}</h2>
      <h3>{data.subtitle}</h3>
      <p>{data.content}</p>
      <div>
        <span>{data.created_at}</span>
        <span>{data.updated_at}</span>
      </div>
    </div>
  );
}
