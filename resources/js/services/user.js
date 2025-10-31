import api from './api';

export const signIn = (email, password) => {
  return api.post('/auth/login', {
    email,
    password,
  }).then((res) => {
    if (res.data.token) {
      localStorage.setItem('token', res.data.token);
    }
    return res.data;
  });
};

export const signUp = (name, email, password, phone) => {
  return api.post('/auth/register', {
    name,
    email,
    password,
    phone,
  }).then((res) => {
    if (res.data.token) {
      localStorage.setItem('token', res.data.token);
    }
    return res.data;
  });
};

export const getMe = () => {
  return api.get('/auth/me').then((res) => {
    return res.data;
  });
};

