import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";

const Terms = () => {
  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main className="py-16">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 className="text-4xl font-bold text-foreground mb-8">Terms of Service</h1>
          
          <div className="prose prose-lg max-w-none text-muted-foreground space-y-8">
            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">1. Acceptance of Terms</h2>
              <p>
                By accessing and using ATV Trader, you accept and agree to be bound by the terms 
                and provision of this agreement. These Terms of Service apply to all visitors, 
                users, and others who access or use the service.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">2. Use License</h2>
              <p>
                Permission is granted to temporarily download one copy of the materials on ATV Trader's 
                website for personal, non-commercial transitory viewing only. This is the grant of a 
                license, not a transfer of title, and under this license you may not:
              </p>
              <ul className="list-disc pl-6 space-y-2">
                <li>modify or copy the materials</li>
                <li>use the materials for any commercial purpose or for any public display</li>
                <li>attempt to reverse engineer any software contained on the website</li>
                <li>remove any copyright or other proprietary notations from the materials</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">3. User Accounts</h2>
              <p>
                When you create an account with us, you must provide information that is accurate, 
                complete, and current at all times. You are responsible for safeguarding the password 
                and for all activities that occur under your account.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">4. Listing Guidelines</h2>
              <p>
                Users who list ATVs for sale must provide accurate information about their vehicles. 
                Misleading or fraudulent listings will result in immediate account suspension. All 
                listings must comply with local, state, and federal laws.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">5. Payment and Transactions</h2>
              <p>
                ATV Trader facilitates connections between buyers and sellers but is not responsible 
                for the actual transactions. All payments and transfers of ownership are between the 
                buyer and seller directly.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">6. Prohibited Uses</h2>
              <p>You may not use our service:</p>
              <ul className="list-disc pl-6 space-y-2">
                <li>For any unlawful purpose or to solicit others to perform unlawful acts</li>
                <li>To violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances</li>
                <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                <li>To harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate</li>
                <li>To submit false or misleading information</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">7. Disclaimer</h2>
              <p>
                The information on this website is provided on an 'as is' basis. To the fullest extent 
                permitted by law, ATV Trader excludes all representations, warranties, conditions, and 
                terms whether express or implied.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">8. Limitations</h2>
              <p>
                In no event shall ATV Trader or its suppliers be liable for any damages (including, 
                without limitation, damages for loss of data or profit, or due to business interruption) 
                arising out of the use or inability to use the materials on ATV Trader's website.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">9. Changes to Terms</h2>
              <p>
                ATV Trader may revise these terms of service at any time without notice. By using this 
                website, you are agreeing to be bound by the then current version of these terms of service.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">10. Contact Information</h2>
              <p>
                If you have any questions about these Terms of Service, please contact us at 
                legal@atvtrader.com or call 1-800-ATV-TRADE.
              </p>
            </section>

            <div className="text-sm text-muted-foreground mt-12 pt-8 border-t border-border">
              Last updated: January 2024
            </div>
          </div>
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default Terms;