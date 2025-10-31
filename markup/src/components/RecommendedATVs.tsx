import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Star } from "lucide-react";

const recommendedATVs = [
  {
    id: 1,
    title: "2024 Kawasaki Brute Force 750",
    price: "$9,999",
    originalPrice: "$11,499",
    location: "Miami, FL",
    mileage: "New",
    image: "🟢",
    dealer: "Miami Motorsports",
    rating: 4.8,
    reviews: 127,
    features: ["4x4", "EPS", "V-Force"]
  },
  {
    id: 2,
    title: "2023 CFMoto CForce 500 HO",
    price: "$6,799",
    location: "Las Vegas, NV",
    mileage: "250 miles", 
    image: "⚫",
    dealer: "Vegas ATV Center",
    rating: 4.6,
    reviews: 89,
    features: ["CVT", "4WD", "EPS"]
  },
  {
    id: 3,
    title: "2024 Suzuki KingQuad 750AXi",
    price: "$8,799",
    location: "Seattle, WA",
    mileage: "New",
    image: "🟡", 
    dealer: "Northwest ATVs",
    rating: 4.7,
    reviews: 156,
    features: ["Independent Suspension", "4x4", "EFI"]
  },
  {
    id: 4,
    title: "2023 Polaris Sportsman 570",
    price: "$7,999",
    location: "Chicago, IL",
    mileage: "75 miles",
    image: "🏁",
    dealer: "Windy City ATVs", 
    rating: 4.9,
    reviews: 203,
    features: ["All-Terrain", "On-Demand AWD", "Digital Display"]
  }
];

export const RecommendedATVs = () => {
  return (
    <section className="py-16 bg-muted/30">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between mb-8">
          <h2 className="text-3xl font-bold text-foreground">Recommended ATVs</h2>
          <Button variant="outline" className="border-atv-orange text-atv-orange hover:bg-atv-orange hover:text-white">
            View All Recommendations
          </Button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {recommendedATVs.map((atv) => (
            <Card key={atv.id} className="hover:shadow-lg transition-shadow cursor-pointer bg-white">
              <CardContent className="p-0">
                <div className="relative">
                  <div className="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl">
                    {atv.image}
                  </div>
                  {atv.originalPrice && (
                    <Badge className="absolute top-2 right-2 bg-atv-orange text-white">
                      Save ${parseInt(atv.originalPrice.replace(/[$,]/g, '')) - parseInt(atv.price.replace(/[$,]/g, ''))}
                    </Badge>
                  )}
                </div>
                <div className="p-4">
                  <div className="flex items-start justify-between mb-2">
                    <h3 className="font-semibold text-foreground text-sm line-clamp-2">
                      {atv.title}
                    </h3>
                  </div>
                  <div className="flex items-center gap-2 mb-2">
                    <div className="text-2xl font-bold text-atv-orange">
                      {atv.price}
                    </div>
                    {atv.originalPrice && (
                      <div className="text-sm text-muted-foreground line-through">
                        {atv.originalPrice}
                      </div>
                    )}
                  </div>
                  <div className="flex items-center gap-1 mb-2">
                    <Star className="h-4 w-4 fill-yellow-400 text-yellow-400" />
                    <span className="text-sm font-medium">{atv.rating}</span>
                    <span className="text-sm text-muted-foreground">({atv.reviews})</span>
                  </div>
                  <div className="text-sm text-muted-foreground mb-2">
                    {atv.mileage} • {atv.location}
                  </div>
                  <div className="text-sm text-muted-foreground mb-3">
                    {atv.dealer}
                  </div>
                  <div className="flex flex-wrap gap-1">
                    {atv.features.slice(0, 2).map((feature) => (
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