import { Card } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Heart, MapPin, Calendar, Gauge, Phone, MessageSquare } from "lucide-react";
import { useState } from "react";
import { dateToLocale } from "@/lib/utils";
import { useLanguage } from "@/contexts/LanguageContext";

interface ATVListing {
  id: number;
  active_images: any[];
  name: string;
  price: string; // stored as string, not number
  year: number;
  clearance: string; // e.g. "8.5 inches"
  mileage: number;
  transmission: string;
  fuel: string;
  isActive: boolean;
  isVip: boolean;
  engine: string;
  description: string;
  created_at: string; // ISO timestamp
  updated_at: string; // ISO timestamp
  location_id: number | null;
  location?: {
    name: string;
  };
}

interface ATVListingCardProps {
  listing: ATVListing;
}

export const ATVListingCard = ({ listing }: ATVListingCardProps) => {
  const { t } = useLanguage();
  const [isFavorited, setIsFavorited] = useState(false);

  const formatPrice = (price: number) => {
    return `₾${price.toLocaleString()}`;
  };

  const getConditionColor = (condition: string) => {
    switch (condition.toLowerCase()) {
      case 'new':
      case 'ახალი':
        return 'bg-green-100 text-green-800 border-green-200';
      case 'excellent':
      case 'ძალიან კარგი':
        return 'bg-blue-100 text-blue-800 border-blue-200';
      case 'good':
      case 'კარგი':
        return 'bg-yellow-100 text-yellow-800 border-yellow-200';
      case 'fair':
      case 'საშუალო':
        return 'bg-orange-100 text-orange-800 border-orange-200';
      default:
        return 'bg-gray-100 text-gray-800 border-gray-200';
    }
  };

  return (
    <Card className="group hover:shadow-lg transition-all duration-300 overflow-hidden cursor-pointer">
      <div className="relative">
        {listing?.active_images.length > 0 && <img 
          src={listing?.active_images[0].url} 
          alt={listing.name}
          className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
        />}
        <Button
          variant="ghost"
          size="icon"
          className={`absolute top-2 right-2 h-8 w-8 rounded-full ${isFavorited
            ? 'bg-red-500 text-white hover:bg-red-600'
            : 'bg-white/80 text-gray-600 hover:bg-white'
            }`}
          onClick={(e) => {
            e.stopPropagation();
            setIsFavorited(!isFavorited);
          }}
        >
          <Heart className={`h-4 w-4 ${isFavorited ? 'fill-current' : ''}`} />
        </Button>
        {/* {listing.originalPrice && listing.originalPrice > listing.price && (
          <Badge className="absolute bottom-2 left-2 bg-red-500 text-white">
            ფასდაკლება {Math.round(((listing.originalPrice - listing.price) / listing.originalPrice) * 100)}%
          </Badge>
        )} */}
        <Badge
          className={`absolute top-2 left-2 border bg-green-100 text-green-800 border-green-200`}
          variant="outline"
        >
          {listing.year}
        </Badge>
      </div>

      <div className="p-4">
        <div className="flex justify-between items-start mb-2">
          <h4 className="font-semibold text-md text-foreground group-hover:text-primary transition-colors">
            {listing.name}
          </h4>
          <div className="text-right">
            <div className="text-xl font-bold text-primary">
              {formatPrice(Number(listing.price))}
            </div>
            {/* {listing.originalPrice && listing.originalPrice > listing.price && (
              <div className="text-sm text-muted-foreground line-through">
                {formatPrice(listing.originalPrice)}
              </div>
            )} */}
          </div>
        </div>

        <div className="grid grid-cols-2 gap-2 mb-3 text-sm text-muted-foreground">
          <div className="flex items-center gap-1">
            <Calendar className="h-4 w-4" />
            <span>{listing.year} {t('listing.year')}</span>
          </div>
          <div className="flex items-center gap-1" style={{ justifyContent: 'end' }}>
            <Gauge className="h-4 w-4" />
            <span>{listing.mileage.toLocaleString()} {t('listing.mileage')}</span>
          </div>
          {listing?.location && <div className="flex items-center gap-1">
            <MapPin className="h-4 w-4" />
            <span>{listing?.location?.name}</span>
          </div>}
          <div className="flex items-center gap-1" style={{ justifyContent: 'end' }}>
            <span className="font-medium">{listing.engine.replace('Engine', '')}</span>
          </div>
        </div>

        <div className="flex flex-wrap gap-1 mb-3">
          <Badge variant="secondary" className="text-xs">
            {listing.transmission}
          </Badge>
          {/* {listing.features.slice(0, 3).map((feature, index) => (
            <Badge key={index} variant="secondary" className="text-xs">
              {feature}
            </Badge>
          ))}
          {listing.features.length > 3 && (
            <Badge variant="outline" className="text-xs">
              +{listing.features.length - 3} მეტი
            </Badge>
          )} */}
        </div>

        <div className="flex items-center justify-between text-sm text-muted-foreground mb-3">
          <div className="flex items-center gap-2">
            <span className="text-blue-600 font-medium">
              {listing.fuel}
            </span>
          </div>
          <span>{dateToLocale(listing.created_at)}</span>
        </div>

        <div className="flex gap-2">
          <Button size="sm" className="flex-1">
            <Phone className="h-4 w-4 mr-1" />
{t('listing.call')}
          </Button>
        </div>
      </div>
    </Card>
  );
};