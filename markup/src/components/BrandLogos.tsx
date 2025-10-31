import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { ChevronLeft, ChevronRight } from "lucide-react";
import { useLanguage } from "@/contexts/LanguageContext";

const brands = [
  { name: "Polaris", logo: "🏁" },
  { name: "Can-Am", logo: "🔴" },
  { name: "Honda", logo: "🔴" },
  { name: "Kawasaki", logo: "🟢" },
  { name: "Yamaha", logo: "🔵" },
  { name: "CFMoto", logo: "⚫" },
  { name: "Suzuki", logo: "🟡" },
  { name: "Kayo USA", logo: "🟠" },
  { name: "Segway", logo: "⚪" },
  { name: "Club Car", logo: "🔵" },
];

export const BrandLogos = () => {
  const { t } = useLanguage();
  
  return (
    <section className="py-16 bg-background">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between mb-8">
          <h2 className="text-2xl font-bold text-foreground">
            {t('brands.title')}
          </h2>
          <div className="flex space-x-2">
            <Badge variant="secondary" className="bg-foreground text-background">
              {t('brands.makes')}
            </Badge>
            <Badge variant="outline">
              {t('brands.types')}
            </Badge>
          </div>
        </div>
        
        <div className="flex items-center justify-between mb-6">
          <Button variant="ghost" size="sm">
            <ChevronLeft className="h-5 w-5" />
          </Button>
          
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 flex-1 mx-4">
            {brands.slice(0, 6).map((brand) => (
              <div
                key={brand.name}
                className="bg-card border border-border rounded-lg p-6 hover:shadow-md transition-shadow cursor-pointer text-center"
              >
                <div className="text-4xl mb-3">{brand.logo}</div>
                <h3 className="font-semibold text-foreground">{brand.name}</h3>
              </div>
            ))}
          </div>
          
          <Button variant="ghost" size="sm">
            <ChevronRight className="h-5 w-5" />
          </Button>
        </div>
        
        <div className="text-center">
          <a href="#" className="text-atv-orange hover:text-atv-orange-dark font-medium">
            {t('brands.seeAll')}
          </a>
        </div>
      </div>
    </section>
  );
};