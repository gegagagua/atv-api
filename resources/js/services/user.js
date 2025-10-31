import api from './api';

export const signIn = (email, password) => {
  return api.post('/login', {
    email,
    password,
  }).then((res) => {
    if (res.data?.data?.token) {
      localStorage.setItem('token', res.data.data.token);
    }
    return res.data;
  });
};

export const signUp = (name, email, password, phone) => {
  return api.post('/register', {
    name,
    email,
    password,
    password_confirmation: password,
    phone,
  }).then((res) => {
    if (res.data?.data?.token) {
      localStorage.setItem('token', res.data.data.token);
    }
    return res.data;
  });
};

export const getMe = () => {
  return api.get('/user').then((res) => {
    return res.data;
  });
};

export const logout = () => {
  return api.post('/logout').then((res) => {
    localStorage.removeItem('token');
    return res.data;
  });
};

