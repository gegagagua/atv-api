import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";

const Blog = () => {
  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main className="py-8">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold text-foreground mb-6">Blog</h1>
          <div className="bg-card border border-border rounded-lg p-8 text-center">
            <h2 className="text-xl font-semibold text-foreground mb-4">ATV News, Tips & Guides</h2>
            <p className="text-muted-foreground">
              Blog articles, ATV guides, news, maintenance tips, and community content will be implemented here.
            </p>
          </div>
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default Blog;