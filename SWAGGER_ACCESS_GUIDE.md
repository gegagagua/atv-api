# ATV API - Swagger Documentation Access Guide

## 🚀 Swagger Documentation is Now Available!

The ATV API now includes comprehensive Swagger/OpenAPI documentation with all location endpoints properly documented.

## 📍 How to Access Swagger Documentation

### 1. **Start the Development Server**
```bash
php artisan serve
```
The server will start at `http://127.0.0.1:8000`

### 2. **Access Swagger UI**
Open your browser and navigate to:
```
http://127.0.0.1:8000/api/documentation
```

### 3. **Alternative: Direct JSON Documentation**
For programmatic access to the API specification:
```
http://127.0.0.1:8000/docs/api-docs.json
```

## 📋 Available Location Endpoints in Swagger

### Public Endpoints (No Authentication Required)

1. **GET /api/locations** - Get all locations with filtering options
   - Query parameters: `georgian_only`, `international_only`, `active_only`, `country`, `type`, `search`, `per_page`
   - Returns paginated list of locations

2. **GET /api/locations/{id}** - Get specific location
   - Path parameter: `id` (location ID)
   - Returns single location details

3. **GET /api/locations/georgian/cities** - Get all Georgian cities
   - Returns list of Georgian cities only

4. **GET /api/locations/countries** - Get all countries
   - Returns list of countries only

5. **GET /api/locations/search** - Search locations
   - Query parameters: `q` (required), `type`, `limit`
   - Returns search results

6. **GET /api/locations/popular** - Get popular locations
   - Query parameters: `georgian_only`, `limit`
   - Returns popular cities for selection

### Protected Endpoints (Authentication Required)

7. **POST /api/locations** - Create new location
   - Requires Bearer token authentication
   - Request body with location details

8. **PUT /api/locations/{id}** - Update location
   - Requires Bearer token authentication
   - Path parameter: `id` (location ID)
   - Request body with updated location details

9. **DELETE /api/locations/{id}** - Delete location
   - Requires Bearer token authentication
   - Path parameter: `id` (location ID)

## 🔧 Swagger Features

### Interactive API Testing
- **Try it out** buttons for each endpoint
- **Execute** requests directly from the browser
- **View responses** with real data
- **Authentication** support with Bearer tokens

### Comprehensive Documentation
- **Request/Response examples** for all endpoints
- **Parameter descriptions** and validation rules
- **Error responses** with status codes
- **Schema definitions** for all data models

### Authentication Support
- **Bearer Token** authentication for protected endpoints
- **Authorization** button in Swagger UI
- **Token persistence** across requests

## 🎯 Location Schema in Swagger

The Location schema includes all properties:
```json
{
  "id": 1,
  "name": "Tbilisi",
  "country": "Georgia", 
  "region": "Tbilisi Region",
  "type": "city",
  "is_georgian": true,
  "is_active": true,
  "latitude": 41.7151,
  "longitude": 44.8271,
  "full_name": "Tbilisi, Georgia",
  "display_name": "Tbilisi, Georgia",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

## 🧪 Testing the API

### 1. **Test Public Endpoints**
- Navigate to any GET endpoint in Swagger
- Click "Try it out"
- Click "Execute"
- View the response

### 2. **Test Protected Endpoints**
- First, get an authentication token from `/api/login`
- Click the "Authorize" button in Swagger UI
- Enter: `Bearer YOUR_TOKEN_HERE`
- Test POST/PUT/DELETE endpoints

### 3. **Test Search Functionality**
- Use `/api/locations/search?q=Tbilisi`
- Try different search terms
- Test with filters like `type=city`

## 📊 Sample Data Available

The API comes pre-populated with:
- **10 Georgian cities** (Tbilisi, Batumi, Kutaisi, etc.)
- **10 International cities** (New York, London, Paris, etc.)
- **11 Countries** (Georgia, United States, UK, etc.)

## 🔄 Regenerating Documentation

If you make changes to the API annotations, regenerate the documentation:
```bash
php artisan l5-swagger:generate
```

## 🌐 Production Considerations

For production deployment:
1. Update the server URL in `app/Http/Controllers/Api/Controller.php`
2. Set `L5_SWAGGER_GENERATE_ALWAYS=false` in production
3. Consider restricting access to documentation in production

## 📱 Mobile/App Integration

The Swagger documentation provides:
- **Complete API specification** for mobile app development
- **Request/response examples** for easy integration
- **Authentication flows** for secure access
- **Error handling** patterns

---

**🎉 Your ATV API now has complete Swagger documentation with all location endpoints ready for testing and integration!**

