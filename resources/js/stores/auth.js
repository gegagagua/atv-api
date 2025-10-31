import { defineStore } from 'pinia';
import { ref } from 'vue';
import { getMe } from '../services/user';

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null);
  const status = ref('idle'); // idle | loading | authenticated | unauthenticated

  const setUser = (u) => {
    user.value = u;
  };

  const setStatus = (s) => {
    status.value = s;
  };

  const fetchMe = async () => {
    setStatus('loading');
    try {
      const data = await getMe();
      setUser(data.user || data);
      setStatus('authenticated');
    } catch (error) {
      setUser(null);
      setStatus('unauthenticated');
    }
  };

  const logoutLocal = () => {
    user.value = null;
    status.value = 'unauthenticated';
    localStorage.removeItem('token');
  };

  return {
    user,
    status,
    setUser,
    setStatus,
    fetchMe,
    logoutLocal,
  };
});

