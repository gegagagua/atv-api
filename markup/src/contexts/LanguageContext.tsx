import React, { createContext, useContext, useState } from 'react';

export type Language = 'en' | 'ka';

interface LanguageContextType {
  language: Language;
  setLanguage: (lang: Language) => void;
  t: (key: string) => string;
}

const LanguageContext = createContext<LanguageContextType | undefined>(undefined);

export const useLanguage = () => {
  const context = useContext(LanguageContext);
  if (!context) {
    throw new Error('useLanguage must be used within a LanguageProvider');
  }
  return context;
};

interface LanguageProviderProps {
  children: React.ReactNode;
}

export const LanguageProvider: React.FC<LanguageProviderProps> = ({ children }) => {
  const [language, setLanguage] = useState<Language>('ka');

  const t = (key: string): string => {
    const translations = language === 'en' ? enTranslations : kaTranslations;
    return translations[key] || key;
  };

  return (
    <LanguageContext.Provider value={{ language, setLanguage, t }}>
      {children}
    </LanguageContext.Provider>
  );
};

// English translations
const enTranslations: Record<string, string> = {
  // Header
  'nav.findATVs': 'Find ATVs',
  'nav.sellMyATV': 'Sell my ATV',
  'nav.research': 'Research',
  'nav.atvDealers': 'ATV dealers',
  'nav.blog': 'Blog',
  'nav.login': 'Log in',
  'nav.search': 'Search',
  
  // Hero Section
  'hero.title': 'Find your perfect ATV',
  'hero.subtitle': 'Browse thousands of ATVs for sale from dealers and private sellers',
  'hero.searchPlaceholder': 'Enter keywords (e.g., Honda, Yamaha)',
  'hero.zipPlaceholder': 'Enter ZIP code',
  'hero.radius': 'Radius',
  'hero.onlineListings': 'Include online listings',
  'hero.searchButton': 'Search ATVs',
  'hero.sellLink': 'Sell your ATV',
  
  // Brand Section
  'brands.title': 'ATVs for every outdoor adventure',
  'brands.makes': 'Makes',
  'brands.types': 'Types',
  'brands.seeAll': 'See all makes',
  
  // Featured Listings
  'featured.title': 'Featured listings',
  'featured.viewAll': 'View All Featured',
  'featured.miles': 'miles',
  
  // Content Sections
  'sell.title': 'Sell your ATV',
  'sell.description': 'List your ATV for free and reach thousands of potential buyers',
  'sell.button': 'List Your ATV',
  'sell.today': 'List your ATV today',
  
  'buyOnline.title': 'Buy online',
  'buyOnline.description': 'Purchase ATVs from verified dealers with secure transactions',
  'buyOnline.button': 'Buy Now',
  
  'info.title': 'Find ATVs for Sale on ATV Trader',
  'info.description': 'ATV Trader is the leading marketplace for buying and selling all-terrain vehicles. Whether you\'re looking for a sport ATV, utility ATV, or side-by-side, we have thousands of listings from dealers and private sellers across the country.',
  
  // Footer
  'footer.makes': 'Top Four Wheeler Makes',
  'footer.models': 'Top Four Wheeler Make/Models',
  'footer.types': 'Top Four Wheeler Types',
  'footer.copyright': '© 2025 ATV Trader. All rights reserved.',
  
  // Find ATVs Page
  'findATVs.title': 'Find ATVs',
  'findATVs.results': 'ATVs for sale',
  'findATVs.noResults': 'No ATVs found matching your criteria',
  'findATVs.sortBy': 'Sort by',
  'findATVs.sortPrice': 'Price: Low to High',
  'findATVs.sortPriceDesc': 'Price: High to Low',
  'findATVs.sortYear': 'Year: Newest First',
  'findATVs.sortMileage': 'Mileage: Low to High',
  
  // Filters
  'filters.price': 'Price',
  'filters.minPrice': 'Min Price',
  'filters.maxPrice': 'Max Price',
  'filters.year': 'Year',
  'filters.minYear': 'Min Year',
  'filters.maxYear': 'Max Year',
  'filters.mileage': 'Mileage',
  'filters.maxMileage': 'Max Mileage',
  'filters.condition': 'Condition',
  'filters.new': 'New',
  'filters.used': 'Used',
  'filters.engineSize': 'Engine Size (cc)',
  'filters.location': 'Location',
  'filters.zipCode': 'ZIP Code',
  'filters.applyFilters': 'Apply Filters',
  'filters.clearFilters': 'Clear Filters',
  'filters.manufacturer': 'Manufacturer',
  'filters.selectManufacturer': 'Select manufacturer',
  'filters.model': 'Model',
  'filters.modelName': 'Model name',
  'filters.priceGEL': 'Price (GEL)',
  'filters.yearOfManufacture': 'Year of Manufacture',
  'filters.mileageKm': 'Mileage (km)',
  'filters.condition': 'Condition',
  'filters.selectCondition': 'Select condition',
  'filters.new': 'New',
  'filters.excellent': 'Excellent',
  'filters.good': 'Good',
  'filters.fair': 'Fair',
  'filters.needsRepair': 'Needs Repair',
  'filters.engineSize': 'Engine Size',
  'filters.selectEngineSize': 'Select engine size',
  'filters.location': 'Location',
  'filters.selectCity': 'Select city',
  'filters.category': 'Category',
  'filters.selectCategory': 'Select category',
  'filters.sport': 'Sport',
  'filters.utility': 'Utility',
  'filters.youth': 'Youth',
  'filters.touring': 'Touring',
  'filters.racing': 'Racing',
  'filters.recreational': 'Recreational',
  
  // ATV Listing Card
  'listing.call': 'Call',
  'listing.year': 'year',
  'listing.mileage': 'km',
  
  // Sell My ATV Page
  'sellMyATV.hero.title': 'Sell Your ATV',
  'sellMyATV.hero.subtitle': 'Reach thousands of buyers nationwide',
  'sellMyATV.hero.button': 'Start Selling',
  
  // Login Page
  'login.title': 'Log in to your account',
  'login.email': 'Email',
  'login.password': 'Password',
  'login.button': 'Sign in',
  'login.forgotPassword': 'Forgot your password?',
  'login.noAccount': "Don't have an account?",
  'login.signUp': 'Sign up',
  
  // Other pages
  'contact.title': 'Contact Us',
  'about.title': 'About ATV Trader',
  'terms.title': 'Terms of Service',
  'privacy.title': 'Privacy Policy',
  'signup.title': 'Create your account',
  'blog.title': 'Blog',
  'research.title': 'Research',
  'dealers.title': 'ATV Dealers',
};

// Georgian translations
const kaTranslations: Record<string, string> = {
  // Header
  'nav.findATVs': 'კვადროების ძებნა',
  'nav.sellMyATV': 'ჩემი კვადროს გაყიდვა',
  'nav.research': 'კვლევა',
  'nav.atvDealers': 'კვადროების დილერები',
  'nav.blog': 'ბლოგი',
  'nav.login': 'შესვლა',
  'nav.search': 'ძებნა',
  
  // Hero Section
  'hero.title': 'იპოვეთ თქვენი იდეალური კვადრო',
  'hero.subtitle': 'დაათვალიერეთ ათასობით კვადრო გასაყიდად დილერებისა და კერძო გამყიდველებისგან',
  'hero.searchPlaceholder': 'შეიყვანეთ საძიებო სიტყვები (მაგ., Honda, Yamaha)',
  'hero.zipPlaceholder': 'შეიყვანეთ ZIP კოდი',
  'hero.radius': 'რადიუსი',
  'hero.onlineListings': 'ონლაინ განცხადებების ჩათვლით',
  'hero.searchButton': 'კვადროების ძებნა',
  'hero.sellLink': 'გაყიდეთ თქვენი კვადრო',
  
  // Brand Section
  'brands.title': 'კვადროები ყველა გარე თავგადასავლისთვის',
  'brands.makes': 'მარკები',
  'brands.types': 'ტიპები',
  'brands.seeAll': 'ყველა მარკის ნახვა',
  
  // Featured Listings
  'featured.title': 'გამორჩეული განცხადებები',
  'featured.viewAll': 'ყველა გამორჩეულის ნახვა',
  'featured.miles': 'მილი',
  
  // Content Sections
  'sell.title': 'გაყიდეთ თქვენი კვადრო',
  'sell.description': 'განათავსეთ თქვენი კვადრო უფასოდ და მიაღწიეთ ათასობით პოტენციურ მყიდველს',
  'sell.button': 'განათავსეთ კვადრო',
  'sell.today': 'განათავსეთ თქვენი კვადრო დღესვე',
  
  'buyOnline.title': 'ონლაინ ყიდვა',
  'buyOnline.description': 'შეიძინეთ კვადროები დადასტურებული დილერებისგან უსაფრთხო ტრანზაქციებით',
  'buyOnline.button': 'ახლავე იყიდეთ',
  
  'info.title': 'იპოვეთ კვადროები გასაყიდად ATV Trader-ზე',
  'info.description': 'ATV Trader არის წამყვანი მარკეტპლეისი ყველა ტიპის ტრანსპორტის ყიდვა-გაყიდვისთვის. იქნება ეს სპორტული კვადრო, სამუშაო კვადრო თუ გვერდითი მღვრივი, ჩვენ გვაქვს ათასობით განცხადება დილერებისა და კერძო გამყიდველებისგან მთელი ქვეყნიდან.',
  
  // Footer
  'footer.makes': 'ტოპ ოთხბორბლიანის მარკები',
  'footer.models': 'ტოპ ოთხბორბლიანის მარკა/მოდელები',
  'footer.types': 'ტოპ ოთხბორბლიანის ტიპები',
  'footer.copyright': '© 2025 ATV Trader. ყველა უფლება დაცულია.',
  
  // Find ATVs Page
  'findATVs.title': 'კვადროების ძებნა',
  'findATVs.results': 'კვადროები გასაყიდად',
  'findATVs.noResults': 'თქვენს კრიტერიუმებს შესაბამისი კვადროები ვერ მოიძებნა',
  'findATVs.sortBy': 'დალაგება',
  'findATVs.sortPrice': 'ფასი: დაბალიდან მაღალამდე',
  'findATVs.sortPriceDesc': 'ფასი: მაღალიდან დაბალამდე',
  'findATVs.sortYear': 'წელი: ახალიდან ძველამდე',
  'findATVs.sortMileage': 'გარბენი: დაბალიდან მაღალამდე',
  
  // Filters
  'filters.price': 'ფასი',
  'filters.minPrice': 'მინ. ფასი',
  'filters.maxPrice': 'მაქს. ფასი',
  'filters.year': 'წელი',
  'filters.minYear': 'მინ. წელი',
  'filters.maxYear': 'მაქს. წელი',
  'filters.mileage': 'გარბენი',
  'filters.maxMileage': 'მაქს. გარბენი',
  'filters.condition': 'მდგომარეობა',
  'filters.new': 'ახალი',
  'filters.used': 'გამოყენებული',
  'filters.engineSize': 'ძრავის მოცულობა (cc)',
  'filters.location': 'მდებარეობა',
  'filters.zipCode': 'ZIP კოდი',
  'filters.applyFilters': 'ფილტრების გამოყენება',
  'filters.clearFilters': 'ფილტრების გასუფთავება',
  'filters.manufacturer': 'მწარმოებელი',
  'filters.selectManufacturer': 'აირჩიეთ მწარმოებელი',
  'filters.model': 'მოდელი',
  'filters.modelName': 'მოდელის სახელი',
  'filters.priceGEL': 'ფასი (ლარი)',
  'filters.yearOfManufacture': 'გამოშვების წელი',
  'filters.mileageKm': 'გარბენი (კმ)',
  'filters.condition': 'მდგომარეობა',
  'filters.selectCondition': 'აირჩიეთ მდგომარეობა',
  'filters.new': 'ახალი',
  'filters.excellent': 'ძალიან კარგი',
  'filters.good': 'კარგი',
  'filters.fair': 'საშუალო',
  'filters.needsRepair': 'საჭიროებს შეკეთებას',
  'filters.engineSize': 'ძრავის მოცულობა',
  'filters.selectEngineSize': 'აირჩიეთ მოცულობა',
  'filters.location': 'ლოკაცია',
  'filters.selectCity': 'აირჩიეთ ქალაქი',
  'filters.category': 'კატეგორია',
  'filters.selectCategory': 'აირჩიეთ კატეგორია',
  'filters.sport': 'სპორტული',
  'filters.utility': 'საკომუნალო',
  'filters.youth': 'ახალგაზრდობისთვის',
  'filters.touring': 'ტურისტული',
  'filters.racing': 'რასინგი',
  'filters.recreational': 'გასართობი',
  
  // ATV Listing Card
  'listing.call': 'დარეკვა',
  'listing.year': 'წ.',
  'listing.mileage': 'კმ',
  
  // Sell My ATV Page
  'sellMyATV.hero.title': 'გაყიდეთ თქვენი კვადრო',
  'sellMyATV.hero.subtitle': 'მიაღწიეთ ათასობით მყიდველს მთელ ქვეყანაში',
  'sellMyATV.hero.button': 'გაყიდვის დაწყება',
  
  // Login Page
  'login.title': 'შესვლა თქვენს ანგარიშში',
  'login.email': 'ელ-ფოსტა',
  'login.password': 'პაროლი',
  'login.button': 'შესვლა',
  'login.forgotPassword': 'დაგავიწყდათ პაროლი?',
  'login.noAccount': 'არ გაქვთ ანგარიში?',
  'login.signUp': 'რეგისტრაცია',
  
  // Other pages
  'contact.title': 'დაგვიკავშირდით',
  'about.title': 'ATV Trader-ის შესახებ',
  'terms.title': 'მომსახურების პირობები',
  'privacy.title': 'კონფიდენციალურობის პოლიტიკა',
  'signup.title': 'შექმენით თქვენი ანგარიში',
  'blog.title': 'ბლოგი',
  'research.title': 'კვლევა',
  'dealers.title': 'კვადროების დილერები',
};
