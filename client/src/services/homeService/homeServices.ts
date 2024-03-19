import { AxiosError } from 'axios';

import apiInstance from '@/services/config';
import { ArticleResponse } from './types';

const getHomeContent = async (): Promise<ArticleResponse> => {
  try {
    const response = await apiInstance.get('/home');
    return response.data;
  } catch (error) {
    if (error instanceof AxiosError) {
      throw error;
    } else {
      throw new Error('An unexpected error occurred');
    }
  }
};

export default getHomeContent;
