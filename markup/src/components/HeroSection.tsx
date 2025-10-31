import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Checkbox } from "@/components/ui/checkbox";
import { useLanguage } from "@/contexts/LanguageContext";
import heroBg from "@/assets/atv-hero-bg.jpg";

export const HeroSection = () => {
  const { t } = useLanguage();
  
  return (
    <section 
      className="relative bg-cover bg-center bg-no-repeat py-20"
      style={{ backgroundImage: `url(${heroBg})` }}
    >
      <div className="absolute inset-0 bg-black/40"></div>
      
      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="max-w-lg">
          <div className="bg-atv-beige rounded-lg p-6 shadow-lg">
            <h1 className="text-2xl font-bold text-foreground mb-6">
              {t('hero.title')}
            </h1>
            
            <div className="space-y-4">
              <Input
                type="text"
                placeholder={t('hero.searchPlaceholder')}
                className="w-full"
              />
              
              <div className="flex space-x-4">
                <Input
                  type="text"
                  placeholder={t('hero.zipPlaceholder')}
                  className="flex-1"
                />
                
                <Select defaultValue="150">
                  <SelectTrigger className="w-32">
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="10">10 miles</SelectItem>
                    <SelectItem value="25">25 miles</SelectItem>
                    <SelectItem value="50">50 miles</SelectItem>
                    <SelectItem value="75">75 miles</SelectItem>
                    <SelectItem value="100">100 miles</SelectItem>
                    <SelectItem value="150">150 miles</SelectItem>
                    <SelectItem value="250">250 miles</SelectItem>
                    <SelectItem value="400">400 miles</SelectItem>
                    <SelectItem value="500">500 miles</SelectItem>
                    <SelectItem value="1000">1000 miles</SelectItem>
                    <SelectItem value="nationwide">Nationwide</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              
              <div className="flex items-center space-x-2">
                <Checkbox id="online" />
                <label htmlFor="online" className="text-sm text-foreground">
                  {t('hero.onlineListings')}
                </label>
              </div>
              
              <Button className="w-full bg-atv-orange hover:bg-atv-orange-dark text-white font-semibold py-3">
                {t('hero.searchButton')}
              </Button>
              
              <div className="text-center">
                <a href="#" className="text-sm text-foreground hover:text-atv-orange underline">
                  {t('hero.sellLink')}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};