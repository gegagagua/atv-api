# ATV API - Location Management

## Overview
The ATV API now includes comprehensive location management functionality with POST/GET endpoints for choosing locations everywhere in the application.

## Available Endpoints

### Public Endpoints (No Authentication Required)

#### 1. Get All Locations
```
GET /api/locations
```

**Query Parameters:**
- `georgian_only` (boolean): Show only Georgian locations
- `international_only` (boolean): Show only international locations  
- `active_only` (boolean): Show only active locations
- `country` (string): Filter by country name
- `type` (string): Filter by type (city, region, country)
- `search` (string): Search locations by name, country, or region
- `per_page` (integer): Number of items per page (default: 15)

**Example:**
```
GET /api/locations?search=Tbilisi&type=city&georgian_only=true
```

#### 2. Get Specific Location
```
GET /api/locations/{id}
```

#### 3. Get Georgian Cities
```
GET /api/locations/georgian/cities
```

#### 4. Get All Countries
```
GET /api/locations/countries
```

#### 5. Search Locations
```
GET /api/locations/search?q={query}&type={type}&limit={limit}
```

**Parameters:**
- `q` (required): Search query
- `type` (optional): Filter by type (city, region, country)
- `limit` (optional): Limit results (default: 10)

#### 6. Get Popular Locations
```
GET /api/locations/popular?georgian_only={boolean}&limit={integer}
```

**Parameters:**
- `georgian_only` (optional): Show only Georgian locations (default: false)
- `limit` (optional): Limit results (default: 20)

### Protected Endpoints (Authentication Required)

#### 7. Create Location
```
POST /api/locations
```

**Request Body:**
```json
{
    "name": "Tbilisi",
    "country": "Georgia",
    "region": "Tbilisi Region",
    "type": "city",
    "is_georgian": true,
    "is_active": true,
    "latitude": 41.7151,
    "longitude": 44.8271
}
```

#### 8. Update Location
```
PUT /api/locations/{id}
```

**Request Body:** Same as create

#### 9. Delete Location
```
DELETE /api/locations/{id}
```

## Location Model Structure

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

## Location Types

- **city**: Individual cities
- **region**: States, provinces, or regions within countries
- **country**: Countries

## Features

### 1. Comprehensive Search
- Search by location name, country, or region
- Case-insensitive partial matching
- Filter by location type
- Limit results for performance

### 2. Filtering Options
- Georgian vs International locations
- Active vs Inactive locations
- By country
- By location type

### 3. Location Selection
- Popular locations endpoint for quick selection
- Georgian cities for local focus
- All countries for international selection

### 4. Validation
- Required fields: name, country, type
- Optional fields: region, latitude, longitude, is_georgian, is_active
- Latitude: -90 to 90
- Longitude: -180 to 180
- Type: city, region, country

### 5. OpenAPI Documentation
- Complete Swagger/OpenAPI documentation
- Request/response examples
- Error handling documentation
- Authentication requirements

## Sample Data

The API comes pre-populated with:
- 10 Georgian cities (Tbilisi, Batumi, Kutaisi, etc.)
- 10 International cities (New York, London, Paris, etc.)
- 11 Countries (Georgia, United States, UK, etc.)

## Usage Examples

### Get all Georgian cities
```bash
curl -X GET "http://127.0.0.1:8000/api/locations/georgian/cities"
```

### Search for locations containing "Tbilisi"
```bash
curl -X GET "http://127.0.0.1:8000/api/locations/search?q=Tbilisi"
```

### Get popular locations (cities only)
```bash
curl -X GET "http://127.0.0.1:8000/api/locations/popular?georgian_only=true&limit=5"
```

### Create a new location (requires authentication)
```bash
curl -X POST "http://127.0.0.1:8000/api/locations" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New City",
    "country": "Georgia",
    "type": "city",
    "is_georgian": true
  }'
```

## Error Handling

All endpoints return consistent JSON responses:

**Success:**
```json
{
    "status": "success",
    "data": {...}
}
```

**Error:**
```json
{
    "status": "error",
    "message": "Error description"
}
```

**Validation Error:**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field_name": ["Error message"]
    }
}
```

This comprehensive location API provides everything needed for location selection throughout the ATV application, with both public read access and protected management endpoints.

