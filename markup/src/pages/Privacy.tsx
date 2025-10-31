import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";

const Privacy = () => {
  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main className="py-16">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 className="text-4xl font-bold text-foreground mb-8">Privacy Policy</h1>
          
          <div className="prose prose-lg max-w-none text-muted-foreground space-y-8">
            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">1. Information We Collect</h2>
              <p>
                We collect information you provide directly to us, such as when you create an account, 
                make a purchase, or contact us for support. This may include:
              </p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Name, email address, and contact information</li>
                <li>Account credentials and profile information</li>
                <li>Payment information (processed securely through third-party providers)</li>
                <li>Communications with us</li>
                <li>Information about ATVs you list or inquire about</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">2. Automatically Collected Information</h2>
              <p>
                When you use our service, we automatically collect certain information about your device 
                and usage patterns, including:
              </p>
              <ul className="list-disc pl-6 space-y-2">
                <li>IP address and location information</li>
                <li>Browser type and version</li>
                <li>Pages visited and time spent on our site</li>
                <li>Referring websites</li>
                <li>Device information and operating system</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">3. How We Use Your Information</h2>
              <p>We use the information we collect to:</p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Provide, maintain, and improve our services</li>
                <li>Process transactions and send related information</li>
                <li>Send you technical notices and support messages</li>
                <li>Communicate with you about products, services, and promotions</li>
                <li>Monitor and analyze trends and usage</li>
                <li>Detect and prevent fraudulent transactions</li>
                <li>Comply with legal obligations</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">4. Information Sharing</h2>
              <p>
                We do not sell, trade, or otherwise transfer your personal information to third parties 
                except in the following circumstances:
              </p>
              <ul className="list-disc pl-6 space-y-2">
                <li>With your consent</li>
                <li>To service providers who assist us in operating our website</li>
                <li>To comply with legal requirements</li>
                <li>To protect our rights and safety</li>
                <li>In connection with a business transfer or acquisition</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">5. Cookies and Tracking</h2>
              <p>
                We use cookies and similar tracking technologies to collect and use personal information 
                about you. You can control cookies through your browser settings, but disabling cookies 
                may affect your ability to use certain features of our service.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">6. Data Security</h2>
              <p>
                We implement appropriate technical and organizational measures to protect your personal 
                information against unauthorized access, alteration, disclosure, or destruction. However, 
                no internet transmission is completely secure, and we cannot guarantee absolute security.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">7. Data Retention</h2>
              <p>
                We retain your personal information for as long as necessary to provide our services, 
                comply with legal obligations, resolve disputes, and enforce our agreements. When we 
                no longer need your information, we will securely delete or anonymize it.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">8. Your Rights</h2>
              <p>Depending on your location, you may have certain rights regarding your personal information:</p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Access to your personal information</li>
                <li>Correction of inaccurate information</li>
                <li>Deletion of your personal information</li>
                <li>Restriction of processing</li>
                <li>Data portability</li>
                <li>Objection to processing</li>
              </ul>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">9. Children's Privacy</h2>
              <p>
                Our service is not intended for children under 13 years of age. We do not knowingly 
                collect personal information from children under 13. If we learn that we have collected 
                information from a child under 13, we will delete that information promptly.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">10. Changes to This Policy</h2>
              <p>
                We may update this privacy policy from time to time. We will notify you of any changes 
                by posting the new policy on this page and updating the "Last updated" date below.
              </p>
            </section>

            <section>
              <h2 className="text-2xl font-bold text-foreground mb-4">11. Contact Us</h2>
              <p>
                If you have any questions about this privacy policy or our privacy practices, please 
                contact us at privacy@atvtrader.com or call 1-800-ATV-TRADE.
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

export default Privacy;