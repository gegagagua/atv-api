import { Search, User, Menu } from "lucide-react";
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { useLanguage } from "@/contexts/LanguageContext";
import { LanguageSwitcher } from "@/components/LanguageSwitcher";
import { useAuthStore } from "@/store/auth";

export const Header = () => {
  const { t } = useLanguage();
  const { user } = useAuthStore();

  console.log(user);

  return (
    <header className="bg-background border-b border-atv-gray">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <div className="flex items-center">
            <Link to="/" className="flex items-center space-x-2">
              <div className="w-8 h-8 bg-atv-orange rounded flex items-center justify-center">
                <span className="text-white font-bold text-sm">ATV</span>
              </div>
              <span className="text-xl font-bold text-foreground">Trader</span>
            </Link>
          </div>

          {/* Navigation */}
          <nav className="hidden md:flex space-x-8">
            <Link to="/find-atvs" className="text-foreground hover:text-atv-orange font-medium">
              {t('nav.findATVs')}
            </Link>
            {/* <Link to="/sell-my-atv" className="text-foreground hover:text-atv-orange font-medium">
              {t('nav.sellMyATV')}
            </Link> */}
            {/* <Link to="/research" className="text-foreground hover:text-atv-orange font-medium">
              {t('nav.research')}
            </Link> */}
            <Link to="/atv-dealers" className="text-foreground hover:text-atv-orange font-medium">
              {t('nav.atvDealers')}
            </Link>
            <Link to="/blog" className="text-foreground hover:text-atv-orange font-medium">
              {t('nav.blog')}
            </Link>
          </nav>

          {/* Search and User */}
          <div className="flex items-center space-x-4">
            <div className="hidden lg:flex items-center space-x-2">
              <Input
                type="text"
                placeholder={t('nav.search')}
                className="w-64"
              />
              <Button size="sm" className="bg-atv-orange hover:bg-atv-orange-dark">
                <Search className="h-4 w-4" />
              </Button>
            </div>

            <LanguageSwitcher />

            <Button variant="ghost" size="sm" className="flex items-center space-x-1" asChild>
              {user?.email ? <Link to="/login">
                <User className="h-4 w-4" />
                <span className="hidden sm:inline">{user?.email}</span>
              </Link>
                : <Link to="/login">
                  <User className="h-4 w-4" />
                  <span className="hidden sm:inline">{t('nav.login')}</span>
                </Link>
              }
            </Button>

            <Button variant="ghost" size="sm" className="md:hidden">
              <Menu className="h-5 w-5" />
            </Button>
          </div>
        </div>
      </div>
    </header>
  );
};