import api from './api';

export const submitContact = (data) => {
  return api.post('/contact', data).then((res) => {
    return res.data;
  });
};

