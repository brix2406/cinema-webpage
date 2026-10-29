document.addEventListener("DOMContentLoaded", function () {
    const dateSelect = document.getElementById("booking-date");
    const timeOptions = document.querySelectorAll(".time-option");
    const screeningIdInput = document.getElementById("screeningId");
    const datePrompt = document.getElementById("select-date-prompt");

    function updateTimeOptions() {
        if (!dateSelect) return;
        const selectedDate = dateSelect.value;

        screeningIdInput.value = "";
        document.querySelectorAll('input[name="selectedTime"]').forEach(radio => {
            radio.checked = false;
        });

        let visibleCount = 0;
        timeOptions.forEach(option => {
            if (selectedDate && option.dataset.date === selectedDate) {
                option.style.display = "inline-block";
                visibleCount++;
            } else {
                option.style.display = "none";
            }
        });

        if (datePrompt) {
            if (!selectedDate) {
                datePrompt.style.display = "block";
                datePrompt.textContent = "Please select a date above to view showtimes.";
            } else if (visibleCount === 0) {
                datePrompt.style.display = "block";
                datePrompt.textContent = "No showtimes available for this date.";
            } else {
                datePrompt.style.display = "none";
            }
        }
    }

    if (dateSelect) {
        dateSelect.addEventListener("change", updateTimeOptions);
    }

    document.querySelectorAll('input[name="selectedTime"]').forEach(radio => {
        radio.addEventListener("change", function () {
            screeningIdInput.value = this.value;
        });
    });

    const bookingForm = document.getElementById("booking-form");
    if (bookingForm) {
        bookingForm.addEventListener("submit", function (event) {
            if (!screeningIdInput.value) {
                alert("Please select a date and showtime.");
                event.preventDefault();
            }
        });
    }

    updateTimeOptions();
});
