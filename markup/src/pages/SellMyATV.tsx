import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Star, Shield, MessageCircle, Camera, Clock, TrendingUp } from "lucide-react";

const SellMyATV = () => {
  return (
    <div className="min-h-screen bg-background">
      <Header />
      
      {/* Hero Section */}
      <section className="relative bg-gradient-to-br from-primary to-primary-foreground text-white py-20">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div>
              <h1 className="text-4xl md:text-5xl font-bold mb-6">
                Sell your ATV online
              </h1>
              <p className="text-xl mb-8 opacity-90">
                List in 5 minutes on our secure marketplace, sell fast and earn thousands more than on dealer trade-in
              </p>
              <div className="flex flex-col sm:flex-row gap-4">
                <Button size="lg" className="bg-white text-primary hover:bg-gray-100">
                  Get Started
                </Button>
                <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-primary">
                  Have a listing? Sign In
                </Button>
              </div>
            </div>
            <div className="hidden lg:block">
              <div className="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                <h3 className="text-lg font-semibold mb-4">Quick and easy to list</h3>
                <p className="opacity-90">Largest marketplace for private buyers and sellers</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-16 bg-secondary/30">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-foreground mb-4">
              Quick steps to list securely and with dedicated support
            </h2>
            <p className="text-xl text-muted-foreground">Sell today, hassle-free</p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8">
            <Card>
              <CardHeader className="text-center">
                <Camera className="w-12 h-12 text-primary mx-auto mb-4" />
                <CardTitle>Easy to list in 5 minutes</CardTitle>
              </CardHeader>
              <CardContent className="text-center">
                <CardDescription>
                  4 simple steps and your ATV is listed for sale. Our dedicated Support team is here to help.
                </CardDescription>
              </CardContent>
            </Card>
            
            <Card>
              <CardHeader className="text-center">
                <Shield className="w-12 h-12 text-primary mx-auto mb-4" />
                <CardTitle>Fraud protection</CardTitle>
              </CardHeader>
              <CardContent className="text-center">
                <CardDescription>
                  We work hard to detect and reduce fraud — giving you smarter tools to stay safe.
                </CardDescription>
              </CardContent>
            </Card>
            
            <Card>
              <CardHeader className="text-center">
                <MessageCircle className="w-12 h-12 text-primary mx-auto mb-4" />
                <CardTitle>Interested buyers</CardTitle>
              </CardHeader>
              <CardContent className="text-center">
                <CardDescription>
                  Chat with buyers in our message center — built with features to help keep your conversations safer.
                </CardDescription>
              </CardContent>
            </Card>
          </div>
        </div>
      </section>

      {/* Package Selection */}
      <section className="py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-foreground mb-4">
              Package selection
            </h2>
            <p className="text-xl text-muted-foreground">Get quality leads with our packages</p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8">
            {/* Basic Package */}
            <Card>
              <CardHeader>
                <CardTitle className="text-center">Basic</CardTitle>
                <CardDescription className="text-center">Standard listing package</CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <ul className="space-y-2">
                  <li className="flex items-center gap-2">
                    <Camera className="w-4 h-4 text-primary" />
                    Upload up to 4 photos
                  </li>
                  <li className="flex items-center gap-2">
                    <Clock className="w-4 h-4 text-primary" />
                    Listing is live for 2 weeks
                  </li>
                </ul>
                <Button className="w-full">Choose Basic</Button>
              </CardContent>
            </Card>
            
            {/* Enhanced Package */}
            <Card className="border-primary">
              <CardHeader>
                <div className="flex items-center justify-between">
                  <div>
                    <CardTitle className="text-center">Enhanced</CardTitle>
                    <CardDescription className="text-center">Elevate your listing</CardDescription>
                  </div>
                  <Badge variant="secondary">Popular</Badge>
                </div>
              </CardHeader>
              <CardContent className="space-y-4">
                <ul className="space-y-2">
                  <li className="flex items-center gap-2">
                    <Camera className="w-4 h-4 text-primary" />
                    Upload up to 20 photos
                  </li>
                  <li className="flex items-center gap-2">
                    <Clock className="w-4 h-4 text-primary" />
                    Listing is live for 6 weeks
                  </li>
                  <li className="flex items-center gap-2">
                    <TrendingUp className="w-4 h-4 text-primary" />
                    Add a video
                  </li>
                  <li className="flex items-center gap-2">
                    <Star className="w-4 h-4 text-primary" />
                    3x the buyers of basic
                  </li>
                </ul>
                <Button className="w-full">Choose Enhanced</Button>
              </CardContent>
            </Card>
            
            {/* Best Package */}
            <Card>
              <CardHeader>
                <div className="flex items-center justify-between">
                  <div>
                    <CardTitle className="text-center">Best</CardTitle>
                    <CardDescription className="text-center">Best value</CardDescription>
                  </div>
                  <Badge>Best Value</Badge>
                </div>
              </CardHeader>
              <CardContent className="space-y-4">
                <ul className="space-y-2">
                  <li className="flex items-center gap-2">
                    <Star className="w-4 h-4 text-primary" />
                    Highlighted on homepage
                  </li>
                  <li className="flex items-center gap-2">
                    <Camera className="w-4 h-4 text-primary" />
                    50 photos
                  </li>
                  <li className="flex items-center gap-2">
                    <TrendingUp className="w-4 h-4 text-primary" />
                    Add a video
                  </li>
                  <li className="flex items-center gap-2">
                    <Star className="w-4 h-4 text-primary" />
                    Highlighted in search results
                  </li>
                  <li className="flex items-center gap-2">
                    <Clock className="w-4 h-4 text-primary" />
                    Runs for 12 weeks
                  </li>
                </ul>
                <Button className="w-full">Choose Best</Button>
              </CardContent>
            </Card>
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="py-16 bg-secondary/30">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-foreground mb-4">
              See what other sellers are saying
            </h2>
            <p className="text-xl text-muted-foreground">Customer testimonials</p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8">
            <Card>
              <CardContent className="pt-6">
                <div className="flex items-center mb-4">
                  {[...Array(5)].map((_, i) => (
                    <Star key={i} className="w-4 h-4 fill-yellow-400 text-yellow-400" />
                  ))}
                  <span className="ml-2 font-semibold">5.0</span>
                </div>
                <p className="text-muted-foreground mb-4">
                  "Easy to post add; easy to communicate with prospective buyers, sold my golf car in less than 24 hrs."
                </p>
                <div className="font-semibold">Douglas</div>
                <div className="text-sm text-muted-foreground">July 2023</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="pt-6">
                <div className="flex items-center mb-4">
                  {[...Array(5)].map((_, i) => (
                    <Star key={i} className="w-4 h-4 fill-yellow-400 text-yellow-400" />
                  ))}
                  <span className="ml-2 font-semibold">5.0</span>
                </div>
                <p className="text-muted-foreground mb-4">
                  "Making my ad and the listing was easy and reasonably priced. Sold my SxS within a day, I'd do it again."
                </p>
                <div className="font-semibold">Mike</div>
                <div className="text-sm text-muted-foreground">May 2023</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="pt-6">
                <div className="flex items-center mb-4">
                  {[...Array(5)].map((_, i) => (
                    <Star key={i} className="w-4 h-4 fill-yellow-400 text-yellow-400" />
                  ))}
                  <span className="ml-2 font-semibold">5.0</span>
                </div>
                <p className="text-muted-foreground mb-4">
                  "Lots of visibility and lots of inquiries."
                </p>
                <div className="font-semibold">Sarah</div>
                <div className="text-sm text-muted-foreground">June 2023</div>
              </CardContent>
            </Card>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 bg-primary text-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-3xl font-bold mb-4">
            Sell fast with the largest marketplace online
          </h2>
          <p className="text-xl mb-8 opacity-90">
            Thousands of shoppers and counting
          </p>
          <Button size="lg" className="bg-white text-primary hover:bg-gray-100">
            List on ATV Trader
          </Button>
        </div>
      </section>

      <Footer />
    </div>
  );
};

export default SellMyATV;