import api from './api';

export const getBlogs = (params = {}) => {
  const queryString = new URLSearchParams(params).toString();
  return api.get(`/blogs${queryString ? '?' + queryString : ''}`).then((res) => {
    return res.data;
  });
};

export const getBlog = (id) => {
  return api.get(`/blogs/${id}`).then((res) => {
    return res.data;
  });
};

export const createBlog = (data) => {
  return api.post('/blogs', data).then((res) => {
    return res.data;
  });
};

export const updateBlog = (id, data) => {
  return api.put(`/blogs/${id}`, data).then((res) => {
    return res.data;
  });
};

export const deleteBlog = (id) => {
  return api.delete(`/blogs/${id}`).then((res) => {
    return res.data;
  });
};

