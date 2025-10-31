import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";
import { useLanguage } from "@/contexts/LanguageContext";
import { Card, CardContent } from "@/components/ui/card";
import { Users, Target, Award, Globe } from "lucide-react";

const About = () => {
  const features = [
    {
      icon: Users,
      title: "Community First",
      description: "Built by ATV enthusiasts for ATV enthusiasts. We understand your passion."
    },
    {
      icon: Target,
      title: "Trusted Marketplace",
      description: "Verified dealers and private sellers. Safe and secure transactions."
    },
    {
      icon: Award,
      title: "Quality Guaranteed",
      description: "Every listing is reviewed. Only quality ATVs make it to our platform."
    },
    {
      icon: Globe,
      title: "Nationwide Reach",
      description: "Find ATVs anywhere in the country. Local and nationwide shipping options."
    }
  ];

  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main className="py-16">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Hero Section */}
          <div className="text-center mb-16">
            <h1 className="text-4xl font-bold text-foreground mb-6">About ATV Trader</h1>
            <p className="text-xl text-muted-foreground max-w-3xl mx-auto">
              We're the leading marketplace for all-terrain vehicles, connecting buyers and sellers 
              across the nation with the best selection of ATVs, UTVs, and side-by-sides.
            </p>
          </div>

          {/* Story Section */}
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <div>
              <h2 className="text-3xl font-bold text-foreground mb-6">Our Story</h2>
              <div className="space-y-4 text-muted-foreground">
                <p>
                  Founded in 2010 by a group of ATV enthusiasts, ATV Trader was born from the 
                  frustration of not having a dedicated platform to buy and sell all-terrain vehicles.
                </p>
                <p>
                  What started as a small community forum has grown into the largest ATV marketplace 
                  in North America, facilitating thousands of transactions every month.
                </p>
                <p>
                  Today, we're proud to serve both recreational riders and professional dealers, 
                  providing tools and resources that make buying and selling ATVs easier than ever.
                </p>
              </div>
            </div>
            <div>
              <h2 className="text-3xl font-bold text-foreground mb-6">Our Mission</h2>
              <div className="space-y-4 text-muted-foreground">
                <p>
                  To create the most trusted and comprehensive marketplace for ATV enthusiasts, 
                  where every transaction is safe, transparent, and beneficial for all parties involved.
                </p>
                <p>
                  We believe that adventure should be accessible to everyone, and we're committed 
                  to helping people find their perfect ATV at the right price.
                </p>
              </div>
            </div>
          </div>

          {/* Features Grid */}
          <div className="mb-16">
            <h2 className="text-3xl font-bold text-foreground text-center mb-12">Why Choose ATV Trader?</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              {features.map((feature, index) => {
                const IconComponent = feature.icon;
                return (
                  <Card key={index} className="text-center">
                    <CardContent className="pt-6">
                      <div className="flex items-center justify-center w-16 h-16 bg-atv-orange/10 rounded-lg mx-auto mb-4">
                        <IconComponent className="h-8 w-8 text-atv-orange" />
                      </div>
                      <h3 className="text-xl font-semibold text-foreground mb-2">{feature.title}</h3>
                      <p className="text-muted-foreground">{feature.description}</p>
                    </CardContent>
                  </Card>
                );
              })}
            </div>
          </div>

          {/* Stats Section */}
          <div className="bg-atv-orange/5 rounded-lg p-8 mb-16">
            <h2 className="text-3xl font-bold text-foreground text-center mb-12">By the Numbers</h2>
            <div className="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
              <div>
                <div className="text-4xl font-bold text-atv-orange mb-2">50K+</div>
                <div className="text-muted-foreground">Active Listings</div>
              </div>
              <div>
                <div className="text-4xl font-bold text-atv-orange mb-2">1M+</div>
                <div className="text-muted-foreground">Registered Users</div>
              </div>
              <div>
                <div className="text-4xl font-bold text-atv-orange mb-2">500+</div>
                <div className="text-muted-foreground">Verified Dealers</div>
              </div>
              <div>
                <div className="text-4xl font-bold text-atv-orange mb-2">15+</div>
                <div className="text-muted-foreground">Years of Experience</div>
              </div>
            </div>
          </div>

          {/* Team Section */}
          <div className="text-center">
            <h2 className="text-3xl font-bold text-foreground mb-6">Meet Our Team</h2>
            <p className="text-xl text-muted-foreground mb-8">
              We're a passionate team of ATV enthusiasts, developers, and customer service experts 
              dedicated to providing the best experience for our users.
            </p>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              {[
                { name: "Mike Johnson", role: "CEO & Founder", description: "30+ years of ATV experience" },
                { name: "Sarah Chen", role: "Head of Product", description: "Tech leader with racing background" },
                { name: "David Rodriguez", role: "Customer Success", description: "Dedicated to user satisfaction" }
              ].map((member, index) => (
                <Card key={index}>
                  <CardContent className="pt-6 text-center">
                    <div className="w-20 h-20 bg-atv-gray rounded-full mx-auto mb-4"></div>
                    <h3 className="text-xl font-semibold text-foreground mb-1">{member.name}</h3>
                    <p className="text-atv-orange font-medium mb-2">{member.role}</p>
                    <p className="text-muted-foreground text-sm">{member.description}</p>
                  </CardContent>
                </Card>
              ))}
            </div>
          </div>
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default About;