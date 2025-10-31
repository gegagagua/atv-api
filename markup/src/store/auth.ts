"use client";

import { create } from "zustand";

export type AuthStatus = "idle" | "loading" | "authenticated" | "unauthenticated";

type User = {
  id: number;
  email: string;
  name: string;
  phone: string;
  role?: string;
};

type AuthState = {
  user: User | null;
  status: AuthStatus;
  setUser: (u: User | null) => void;
  setStatus: (s: AuthStatus) => void;
  fetchMe: () => Promise<void>;
  logoutLocal: () => void;
};

export const useAuthStore = create<AuthState>((set) => ({
  user: null,
  status: "idle",
  setUser: (u) => set({ user: u }),
  setStatus: (s) => set({ status: s }),
  fetchMe: async () => {
    set({ status: "loading" });
    try {
      const res = await fetch("/api/auth/me", { credentials: "include" });
      if (!res.ok) throw new Error("Not authenticated");
      const user = (await res.json()) as User;
      set({ user, status: "authenticated" });
    } catch {
      set({ user: null, status: "unauthenticated" });
    }
  },
  logoutLocal: () => set({ user: null, status: "unauthenticated" }),
}));
