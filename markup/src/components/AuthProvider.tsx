"use client";

import { useAuthStore } from "@/store/auth";
import { ReactNode, useEffect } from "react";

type Props = {
  initialUser: {
    id: number;
    email: string;
    name: string;
    phone: string;
    role?: string;
  } | null;
};

export default function AuthProvider({ initialUser }: Props & { children: ReactNode }) {
  const setUser = useAuthStore((s) => s.setUser);
  const setStatus = useAuthStore((s) => s.setStatus);

  useEffect(() => {
    if (initialUser) {
      setUser(initialUser);
      setStatus("authenticated");
    } else {
      setUser(null);
      setStatus("unauthenticated");
    }
  }, [initialUser, setUser, setStatus]);

  return <>{arguments[0].children}</>;
}
