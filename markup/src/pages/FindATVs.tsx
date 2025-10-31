import { useState, useMemo, useEffect } from "react";
import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";
import { ATVFilters } from "@/components/ATVFilters";
import { ATVListingCard } from "@/components/ATVListingCard";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Badge } from "@/components/ui/badge";
import { Search, Grid, List, Filter } from "lucide-react";
import { useLanguage } from "@/contexts/LanguageContext";
import { getAtvs } from "@/services";

// Sample ATV listings data
const atvListings = [
  {
    id: "1",
    title: "2023 Yamaha Raptor 700R",
    price: 12500,
    originalPrice: 14000,
    year: 2023,
    mileage: 1200,
    location: "Tbilisi",
    condition: "Excellent",
    engineSize: "686cc",
    make: "yamaha",
    model: "Raptor 700R",
    image: "/placeholder.svg",
    dealer: "Yamaha Georgia",
    isDealer: true,
    phone: "+995 555 123 456",
    features: ["Electric Starter", "Reverse", "Assist System", "LED Lights"],
    description: "High quality sports quad...",
    postedDate: "2 days ago"
  },
  {
    id: "2",
    title: "2022 Honda TRX 450R",
    price: 9800,
    year: 2022,
    mileage: 2500,
    location: "Batumi",
    condition: "Good",
    engineSize: "449cc",
    make: "honda",
    model: "TRX 450R",
    image: "/placeholder.svg",
    dealer: "Giorgi M.",
    isDealer: false,
    phone: "+995 555 987 654",
    features: ["Manual Transmission", "Front/Rear Disc Brakes", "Shock Absorbers"],
    description: "Quad in good condition...",
    postedDate: "1 week ago"
  },
  {
    id: "3",
    title: "2021 Polaris Sportsman 570",
    price: 15200,
    year: 2021,
    mileage: 800,
    location: "Kutaisi",
    condition: "New",
    engineSize: "567cc",
    make: "polaris",
    model: "Sportsman 570",
    image: "/placeholder.svg",
    dealer: "Polaris Dealer Georgia",
    isDealer: true,
    phone: "+995 555 456 789",
    features: ["4WD", "Automatic Transmission", "Cargo Platform", "Open Cargo Box"],
    description: "Latest model at the best price...",
    postedDate: "3 days ago"
  },
  {
    id: "4",
    title: "2020 Kawasaki Brute Force 750",
    price: 11500,
    originalPrice: 13000,
    year: 2020,
    mileage: 3200,
    location: "Rustavi",
    condition: "Good",
    engineSize: "749cc",
    make: "kawasaki",
    model: "Brute Force 750",
    image: "/placeholder.svg",
    dealer: "Aleksandre S.",
    isDealer: false,
    phone: "+995 555 321 654",
    features: ["V-Twin Engine", "Quad Automatic Transmission", "4WD System"],
    description: "Powerful and reliable quad...",
    postedDate: "5 days ago"
  },
  {
    id: "5",
    title: "2023 Can-Am Outlander 650",
    price: 18500,
    year: 2023,
    mileage: 450,
    location: "Tbilisi",
    condition: "New",
    engineSize: "650cc",
    make: "can-am",
    model: "Outlander 650",
    image: "/placeholder.svg",
    dealer: "BRP Georgia",
    isDealer: true,
    phone: "+995 555 789 123",
    features: ["DPS Suspension", "Intelligent 4WD", "Digital Express Dashboard"],
    description: "Latest generation quad with innovative technologies...",
    postedDate: "1 day ago"
  },
  {
    id: "6",
    title: "2019 Suzuki KingQuad 750",
    price: 8900,
    year: 2019,
    mileage: 4500,
    location: "Gori",
    condition: "Good",
    engineSize: "722cc",
    make: "suzuki",
    model: "KingQuad 750",
    image: "/placeholder.svg",
    dealer: "Mikheil J.",
    isDealer: false,
    phone: "+995 555 654 321",
    features: ["Locking Differential", "Powerful Engine", "High Ground Clearance"],
    description: "Durable and reliable quad for all terrains...",
    postedDate: "1 week ago"
  }
];

const FindATVs = () => {
  const { t } = useLanguage();
  const [sortBy, setSortBy] = useState("newest");
  const [viewMode, setViewMode] = useState<"grid" | "list">("grid");
  const [showFilters, setShowFilters] = useState(true);
  const [filters, setFilters] = useState<any>({});
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 12;


  const totalPages = 2;
  const [data, setData] = useState([])

  const handleFiltersChange = (newFilters: any) => {
    setFilters(newFilters);
    setCurrentPage(1);
  };

  useEffect(() => {
    getAtvs('').then((res) => {
      if (res.data) {
        setData(res.data?.data || [])
      }
      console.log('res', res.data.data)
    })
  }, [])

  return (
    <div className="min-h-screen bg-background">
      <Header />
    
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="flex gap-6">
          {/* Filters Sidebar */}
          {showFilters && (
            <div className="w-80 flex-shrink-0">
              <ATVFilters onFiltersChange={handleFiltersChange} />
            </div>
          )}

          {/* Main Content */}
          <div className="flex-1">
            {/* Results Header */}
            <div className="flex items-center justify-between mb-6">
              <div className="flex items-center gap-4">
                <Button
                  variant="outline"
                  size="sm"
                  onClick={() => setShowFilters(!showFilters)}
                  className="lg:hidden"
                >
                  <Filter className="h-4 w-4 mr-1" />
                  {t('filters.applyFilters')}
                </Button>
              </div>

              <div className="flex items-center gap-4">
                {/* Sort Options */}
                <Select value={sortBy} onValueChange={setSortBy}>
                  <SelectTrigger className="w-48">
                    <SelectValue placeholder="Sort by" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="newest">Newest First</SelectItem>
                    <SelectItem value="price-low">Price: Low to High</SelectItem>
                    <SelectItem value="price-high">Price: High to Low</SelectItem>
                    <SelectItem value="year-new">Year: New to Old</SelectItem>
                    <SelectItem value="year-old">Year: Old to New</SelectItem>
                    <SelectItem value="mileage-low">Mileage: Low to High</SelectItem>
                  </SelectContent>
                </Select>

                {/* View Mode Toggle */}
                <div className="flex border border-border rounded-lg">
                  <Button
                    variant={viewMode === "grid" ? "default" : "ghost"}
                    size="sm"
                    onClick={() => setViewMode("grid")}
                    className="rounded-r-none"
                  >
                    <Grid className="h-4 w-4" />
                  </Button>
                  <Button
                    variant={viewMode === "list" ? "default" : "ghost"}
                    size="sm"
                    onClick={() => setViewMode("list")}
                    className="rounded-l-none"
                  >
                    <List className="h-4 w-4" />
                  </Button>
                </div>
              </div>
            </div>

            {/* Listings Grid */}
            {data.length > 0 ? (
              <>
                <div className={
                  viewMode === "grid" 
                    ? "grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4" 
                    : "space-y-4"
                }>
                  {data.map((listing) => (
                    <ATVListingCard key={listing.id} listing={listing} />
                  ))}
                </div>

                {/* Pagination */}
                {totalPages > 1 && (
                  <div className="flex justify-center items-center gap-2 mt-8">
                    <Button
                      variant="outline"
                      onClick={() => setCurrentPage(Math.max(1, currentPage - 1))}
                      disabled={currentPage === 1}
                    >
                      Previous
                    </Button>
                    
                    {Array.from({ length: totalPages }, (_, i) => i + 1).map((page) => (
                      <Button
                        key={page}
                        variant={page === currentPage ? "default" : "outline"}
                        size="sm"
                        onClick={() => setCurrentPage(page)}
                      >
                        {page}
                      </Button>
                    ))}
                    
                    <Button
                      variant="outline"
                      onClick={() => setCurrentPage(Math.min(totalPages, currentPage + 1))}
                      disabled={currentPage === totalPages}
                    >
                      Next
                    </Button>
                  </div>
                )}
              </>
            ) : (
              <div className="text-center py-12">
                <h3 className="text-lg font-semibold text-foreground mb-2">No ATVs Found</h3>
                <p className="text-muted-foreground">
                  Try changing your search criteria or clearing the filters.
                </p>
              </div>
            )}
          </div>
        </div>
      </div>

      <Footer />
    </div>
  );
};

export default FindATVs;