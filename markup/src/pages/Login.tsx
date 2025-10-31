import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { useLanguage } from "@/contexts/LanguageContext";
import { SignIn } from "@/services";
import { useAuthStore } from "@/store/auth";

const Login = () => {
  const setUser = useAuthStore((s) => s.setUser);
  const { t } = useLanguage();
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!email || !password) {
      return;
    }
    SignIn(email, password).then((res) => {
      if (res?.data) {
        console.log(res.data);
        setUser(res.data.user);
        navigate("/");
      }
    });
  };

  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main className="py-16">
        <div className="max-w-md mx-auto px-4">
          <Card>
            <CardHeader className="text-center">
              <CardTitle className="text-2xl font-bold">{t('login.title')}</CardTitle>
              <CardDescription>
                {t('login.title')}
              </CardDescription>
            </CardHeader>
            <CardContent>
              <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                  <Label htmlFor="email">{t('login.email')}</Label>
                  <Input
                    id="email"
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    placeholder={t('login.email')}
                    required
                  />
                </div>
                <div>
                  <Label htmlFor="password">{t('login.password')}</Label>
                  <Input
                    id="password"
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    placeholder={t('login.password')}
                    required
                  />
                </div>
                <Button type="submit" className="w-full bg-atv-orange hover:bg-atv-orange-dark">
                  {t('login.button')}
                </Button>
              </form>
              
              <div className="mt-6 text-center space-y-2">
                <Link to="/forgot-password" className="text-sm text-atv-orange hover:underline">
                  {t('login.forgotPassword')}
                </Link>
                <div className="text-sm text-muted-foreground">
                  {t('login.noAccount')}{" "}
                  <Link to="/signup" className="text-atv-orange hover:underline">
                    {t('login.signUp')}
                  </Link>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default Login;