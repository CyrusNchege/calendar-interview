
# 📅 Calendar CRUD Operations

Welcome to the Calendar CRUD Operations task! This task is designed to assess your ability to understand existing code and modify it to include CRUD (Create, Read, Update, Delete) operations with a database. You will be working on the backend implementation and ensuring seamless integration with the calendar frontend.

## 📝 Task Overview

Your objective is to:
- Create a fork of the codebase
- Understand the given codebase.
- Modify the relevant files to add CRUD operations for handling calendar events.
- Ensure proper database connection and interaction.
- Implement the backend file structure and APIs.
- Ensure the calendar frontend interacts smoothly with the backend.

## 🔍 Assessment Criteria

Your task will be assessed based on:
1. **Database Connection**: Efficient and secure connection to the database.
2. **Backend Implementation**: Clean and organized file structure.
3. **API Development**: Robust and well-documented APIs for CRUD operations.
4. **Frontend Integration**: Smooth and functional integration of the calendar with the backend.

## 📂 Project Structure

```
calendar-crud-operations/
├── assets/
│   ├── css/
│   ├── img/
│   ├── js/
│   ├── json/
│   ├── vendor/
├── includes/
│   ├── scripts.php
│   ├── search_bar.php
│   ├── sidebar.php
├── .gitignore
├── header.php
├── footer.php
├── index.php
├── README.md

```

## 📖 API Documentation

### Add Event
- **URL**: ``
- **Method**: `POST`

### Fetch Events
- **URL**: ``
- **Method**: `GET`

### Update Event
- **URL**: ``
- **Method**: `PUT`

### Delete Event
- **URL**: ``
- **Method**: `DELETE`

## 💡 Tips for Success

- Ensure your database connection is secure and handles errors gracefully.
- Keep your code modular and organized for scalability.
- Write clear and concise API documentation.
- Test your API endpoints thoroughly.

## 📬 Contact

For any questions or clarifications, feel free to reach out via [fiona@vesencomputing.com](mailto:fiona@vesencomputing.com).

# Solution

# Calendar API Documentation

This API allows you to manage calendar events, including creating, retrieving, updating, and deleting events.

## Fetch All Events

### URL
`/api/events.php`

### Method
`GET`

### Description
This API endpoint allows you to fetch all events from the database.

### Request Body
No request body is required for this endpoint.

### Response
```json

{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "Event Title",
      "label": "Event Label",
      "description": "Event Description",
      "event_date": "YYYY-MM-DD",
      "start_time": "HH:MM:SS",
      "end_time": "HH:MM:SS",
      "all_day": false,
      "url": "https://example.com/event",
      "guests": "Guest1, Guest2",
      "location": "Event Location",
      "created_at": "YYYY-MM-DD HH:MM:SS",
      "updated_at": "YYYY-MM-DD HH:MM:SS"
    }
  ],
  "message": "Events retrieved successfully"

}
```

## Add Event

### URL
`/api/create_event.php`

### Method
`POST`

### Description
This API endpoint allows you to add a new event to the calendar.

### Request Body
```json

  {
  "title": "Event Title",
  "label": "Event Label",
  "description": "Event Description",
  "event_date": "YYYY-MM-DD",
  "start_time": "HH:MM:SS",
  "end_time": "HH:MM:SS",
  "all_day": false,
  "url": "https://example.com/event",
  "guests": "Guest1, Guest2",
  "location": "Event Location"
}


```


### Response
```json
{
  "status": "success",
  "message": "Event created successfully"     
}
```

## Update Event

### URL
`/api/update_event.php`

### Method
`PUT`

### Description
This API endpoint allows you to update an existing event in the calendar.

### Request Body
```json

{
  "id": 1,
  "title": "Updated Event Title",
  "label": "Updated Event Label",
  "description": "Updated Event Description",
  "event_date": "YYYY-MM-DD",
  "start_time": "HH:MM:SS",
  "end_time": "HH:MM:SS",
  "all_day": false,
  "url": "https://example.com/event",
  "guests": "Guest1, Guest2",
  "location": "Updated Event Location"
}

```

### Response
```json
{
  "status":"success",
  "message":"Event updated successfully"
}
```

## Delete Event

### URL
`/api/delete_event.php`

### Method
`DELETE`

### Description
This API endpoint allows you to delete an existing event from the calendar.

### Request Body
```json
{
  "id": 1
}
```

### Response
```json
{
  "success": true,
  "message": "Event deleted successfully"
}
```



