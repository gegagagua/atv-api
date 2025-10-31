import api from './api';

export const getAtvs = (params = {}) => {
  const queryString = new URLSearchParams(params).toString();
  return api.get(`/atvs${queryString ? '?' + queryString : ''}`).then((res) => {
    return res.data;
  });
};

export const getAtv = (id) => {
  return api.get(`/atvs/${id}`).then((res) => {
    return res.data;
  });
};

export const getBrands = () => {
  return api.get('/brands').then((res) => {
    return res.data;
  });
};

export const getCities = () => {
  return api.get('/locations?georgian_only=true&international_only=false&active_only=true&country=Georgia&type=city&per_page=45').then((res) => {
    return res.data;
  });
};

export const createAtv = (data) => {
  return api.post('/atvs', data).then((res) => {
    return res.data;
  });
};

export const updateAtv = (id, data) => {
  return api.put(`/atvs/${id}`, data).then((res) => {
    return res.data;
  });
};

export const deleteAtv = (id) => {
  return api.delete(`/atvs/${id}`).then((res) => {
    return res.data;
  });
};

