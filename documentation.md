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
```json
{
  "title": "Event Title",
  "label": "Event Label",
  "description": "Event Description",
  "event_date": "YYYY-MM-DD",
  "start_time": "HH:MM:SS",
  "end_time": "HH:MM:SS",
  "all_day": 0,
  "url": "https://example.com/event",
  "guests": "Guest1, Guest2",
  "location": "Event Location"
}
```

### Response
```json
{
  "success": true,
  "message": "Event added successfully",
  "data": {...}
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
  "all_day": 0,
  "url": "https://example.com/event",
  "guests": "Guest1, Guest2",
  "location": "Event Location"
}
```


### Response
```json
{
  "success": true,
  "message": "Event added successfully",
  "data": {...}
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
  "all_day": 0,
  "url": "https://example.com/event",
  "guests": "Guest1, Guest2",
  "location": "Event Location"
}
```

### Response
```json
{
  "success": true,
  "message": "Event updated successfully",
  "data": {...}
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



