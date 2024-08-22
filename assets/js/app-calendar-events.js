function formatEvents(events) {
    return events.map(event => ({
        id: event.id,
        url: event.url || "",
        title: event.title || "",
        start: new Date(event.start_date),
        end: new Date(event.end_date),
        allDay: Boolean(event.all_day),
        extendedProps: {
            calendar: event.label || "",
            guests: event.guests || "",
            location: event.location || "",
            description: event.description || ""
        }
    }));
}

function fetchEvents() {
    $.ajax({
        url: "api/events.php",
        method: "GET",
        dataType: "json",
        success: function(response) {
            console.log("Raw response:", response);
            try {
                if (response.status === 'success' && Array.isArray(response.data)) {
                    window.events = formatEvents(response.data);
                    console.log("Formatted events:", window.events);
                    // Attach app-calendar-events.js now that window.events is available
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src = "assets/js/app-calendar.js";
                    $("body").append(s);
                } else {
                    console.error("Invalid response format. Expected an array.");
                }
            } catch (e) {
                console.error("Failed to format events:", e);
            }
        },
        error: function(xhr, status, error) {
            console.error("Failed to fetch events:", error);
            console.log("Response text:", xhr.responseText);
        }
    });
}

function createEvent(eventData) {
    $.ajax({
        url: "api/create_event.php",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify(eventData),
        success: function(response) {
            console.log("Event created:", response);
            fetchEvents(); // Refresh events
        },
        error: function(xhr, status, error) {
            console.error("Failed to create event:", error);
            console.log("Response text:", xhr.responseText);
        }
    });
}

function updateEvent(eventData) {
    $.ajax({
        url: "api/update_event.php",
        method: "PUT",
        contentType: "application/json",
        data: JSON.stringify(eventData),
        success: function(response) {
            console.log("Event updated:", response);
            fetchEvents(); // Refresh events
        },
        error: function(xhr, status, error) {
            console.error("Failed to update event:", error);
            console.log("Response text:", xhr.responseText);
        }
    });
}

function deleteEvent(eventId) {
    $.ajax({
        url: "api/delete_event.php",
        method: "DELETE",
        contentType: "application/json",
        data: JSON.stringify({ id: eventId }),
        success: function(response) {
            console.log("Event deleted:", response);
            fetchEvents(); // Refresh events
        },
        error: function(xhr, status, error) {
            console.error("Failed to delete event:", error);
            console.log("Response text:", xhr.responseText);
        }
    });
}

fetchEvents();