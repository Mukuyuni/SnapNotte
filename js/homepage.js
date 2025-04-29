document.addEventListener("DOMContentLoaded", () => {
    const notesContainer = document.getElementById("notesContainer");
    const editNoteSection = document.getElementById("editNoteSection");
    const editNoteForm = document.getElementById("editNoteForm");
    const cancelEditButton = document.getElementById("cancelEdit");

    // Event listener for viewing notes
    document.getElementById("viewNotesButton").addEventListener("click", () => {
        fetch("read_notes.php")
            .then((response) => response.text())
            .then((data) => {
                notesContainer.innerHTML = data;
            })
            .catch((error) => {
                notesContainer.innerHTML = `<p>Error: ${error.message}</p>`;
            });
    });

    // Show the edit form when an "Edit" button is clicked
    notesContainer.addEventListener("click", (e) => {
        if (e.target.classList.contains("edit-button")) {
            const noteId = e.target.getAttribute("data-id");
            const noteTitle = e.target.getAttribute("data-title");
            const noteContent = e.target.getAttribute("data-content");

            // Populate the form with the existing note details
            document.getElementById("noteId").value = noteId;
            document.getElementById("editTitle").value = noteTitle;
            document.getElementById("editContent").value = noteContent;

            // Show the edit form
            editNoteSection.style.display = "block";
        }
    });

    // Hide the edit form when the "Cancel" button is clicked
    cancelEditButton.addEventListener("click", () => {
        editNoteSection.style.display = "none";
    });

    // Handle the update form submission for editing a note
    editNoteForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const noteId = document.getElementById("noteId").value;
        const title = document.getElementById("editTitle").value.trim();
        const content = document.getElementById("editContent").value.trim();

        if (title && content) {
            fetch("update_note.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${noteId}&title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}`,
            })
                .then((response) => response.text())
                .then((data) => {
                    alert(data); // Show success or error message
                    location.reload(); // Reload the page to show updated notes
                })
                .catch((error) => {
                    alert("Failed to update note: " + error.message);
                });
        } else {
            alert("Both title and content are required.");
        }
    });

    // Handle deleting a note
    notesContainer.addEventListener("click", (e) => {
        if (e.target.classList.contains("delete-button")) {
            const noteId = e.target.getAttribute("data-id");
            const confirmDelete = confirm("Are you sure you want to delete this note?");
            if (confirmDelete) {
                fetch("delete_note.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${noteId}`,
                })
                    .then((response) => response.text())
                    .then((data) => {
                        alert(data); // Show success or error message
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch((error) => {
                        alert("Failed to delete note: " + error.message);
                    });
            }
        }
    });
});
