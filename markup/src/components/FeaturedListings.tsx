import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { useLanguage } from "@/contexts/LanguageContext";

const featuredListings = [
  {
    id: 1,
    title: "2024 Polaris RZR XP 1000",
    price: "$21,999",
    location: "Dallas, TX",
    mileage: "New",
    image: "🏁",
    dealer: "Dallas ATV",
    features: ["4WD", "Sport", "Side by Side"]
  },
  {
    id: 2,
    title: "2023 Can-Am Defender HD8",
    price: "$18,499",
    location: "Phoenix, AZ", 
    mileage: "125 miles",
    image: "🔴",
    dealer: "Desert ATVs",
    features: ["Utility", "Work Ready", "HD Series"]
  },
  {
    id: 3,
    title: "2024 Honda Pioneer 1000",
    price: "$19,999",
    location: "Denver, CO",
    mileage: "New",
    image: "🔴",
    dealer: "Rocky Mountain Honda",
    features: ["6-Speed", "3-Seater", "Trail Ready"]
  },
  {
    id: 4,
    title: "2023 Yamaha YXZ1000R SS",
    price: "$22,799", 
    location: "Atlanta, GA",
    mileage: "50 miles",
    image: "🔵",
    dealer: "Southern ATVs",
    features: ["Sport", "Manual Trans", "Turbocharged"]
  }
];

export const FeaturedListings = () => {
  const { t } = useLanguage();
  
  return (
    <section className="py-16 bg-background">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between mb-8">
          <h2 className="text-3xl font-bold text-foreground">{t('featured.title')}</h2>
          <Button variant="outline" className="border-atv-orange text-atv-orange hover:bg-atv-orange hover:text-white">
            {t('featured.viewAll')}
          </Button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {featuredListings.map((listing) => (
            <Card key={listing.id} className="hover:shadow-lg transition-shadow cursor-pointer">
              <CardContent className="p-0">
                <div className="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl">
                  {listing.image}
                </div>
                <div className="p-4">
                  <div className="flex items-start justify-between mb-2">
                    <h3 className="font-semibold text-foreground text-sm line-clamp-2">
                      {listing.title}
                    </h3>
                  </div>
                  <div className="text-2xl font-bold text-atv-orange mb-2">
                    {listing.price}
                  </div>
                  <div className="text-sm text-muted-foreground mb-2">
                    {listing.mileage} • {listing.location}
                  </div>
                  <div className="text-sm text-muted-foreground mb-3">
                    {listing.dealer}
                  </div>
                  <div className="flex flex-wrap gap-1">
                    {listing.features.slice(0, 2).map((feature) => (
                      <Badge key={feature} variant="secondary" className="text-xs">
                        {feature}
                      </Badge>
                    ))}
                  </div>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </section>
  );
};