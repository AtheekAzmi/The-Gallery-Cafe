// Get modal elements
const modal = document.getElementById('booking-modal');
const closeBtn = document.querySelector('.close-btn');

// Function to open the modal
function bookEvent(eventId, eventName, availableTickets) {
    document.getElementById('event-id').value = eventId;
    document.getElementById('available-tickets').value = availableTickets;
    modal.style.display = 'block';
}

// Close modal when clicking close button
closeBtn.onclick = function() {
    modal.style.display = 'none';
}

// Close modal when clicking outside of the modal content
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Validate tickets on form submit
document.getElementById('booking-form').addEventListener('submit', function(e) {
    const availableTickets = parseInt(document.getElementById('available-tickets').value);
    const requestedTickets = parseInt(document.getElementById('tickets').value);

    if (requestedTickets > availableTickets) {
        alert('You cannot book more tickets than available.');
        e.preventDefault(); // Prevent form submission
    }
});
