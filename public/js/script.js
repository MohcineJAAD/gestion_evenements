// Message management system
const MessageManager = {
    // Initialize the message system
    init: function() {
        // Create message container if it doesn't exist
        if (!document.getElementById('message-container')) {
            const container = document.createElement('div');
            container.id = 'message-container';
            Object.assign(container.style, {
                position: 'fixed',
                top: '20px',
                right: '20px',
                zIndex: '1000'
            });
            document.body.appendChild(container);
        }

        // Add required styles
        if (!document.getElementById('message-styles')) {
            const style = document.createElement('style');
            style.id = 'message-styles';
            style.textContent = `
                .message {
                    padding: 15px 25px;
                    margin-bottom: 10px;
                    border-radius: 5px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    animation: slideIn 0.5s forwards;
                    max-width: 400px;
                }
                .message-success {
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                }
                .message-error {
                    background-color: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                }
                .message-close {
                    float: right;
                    cursor: pointer;
                    font-weight: bold;
                    margin-left: 10px;
                }
                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }
    },

    // Show a message
    show: function(text, type = 'success') {
        // Initialize if not already done
        this.init();

        // Create message element
        const message = document.createElement('div');
        message.className = `message message-${type}`;
        
        // Add close button
        const closeBtn = document.createElement('span');
        closeBtn.className = 'message-close';
        closeBtn.innerHTML = '&times;';
        closeBtn.onclick = () => this.hide(message);
        
        // Add message text
        const messageText = document.createElement('span');
        messageText.textContent = text;
        
        // Assemble message
        message.appendChild(closeBtn);
        message.appendChild(messageText);
        
        // Add to container
        const container = document.getElementById('message-container');
        container.appendChild(message);

        // Auto-hide after 5 seconds
        setTimeout(() => this.hide(message), 5000);
    },

    // Hide a message
    hide: function(messageElement) {
        messageElement.style.animation = 'slideOut 0.5s forwards';
        setTimeout(() => messageElement.remove(), 500);
    },

    // Show success message
    success: function(text) {
        this.show(text, 'success');
    },

    // Show error message
    error: function(text) {
        this.show(text, 'error');
    }
};

// Form Validation
document.addEventListener('DOMContentLoaded', function() {
    // Function to validate forms
    function validateForm(form) {
        let isValid = true;
        
        // Reset previous error styles for all form fields
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.style.borderColor = '';
            const errorSpan = field.nextElementSibling;
            if (errorSpan && errorSpan.className === 'error-text') {
                errorSpan.remove();
            }
        });

        // Get form fields based on form type
        if (form.querySelector('#nom')) {
            // Registration form validation
            const nom = document.getElementById('nom');
            const email = document.getElementById('prenom');
            const event_id = document.getElementById('event_id');

            // Validate Name
            if (!nom.value.trim()) {
                showError(nom, 'Le nom est obligatoire');
                isValid = false;
            }

            // Validate Email
            if (!email.value.trim()) {
                showError(email, 'L\'email est obligatoire');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Veuillez entrer une adresse email valide');
                isValid = false;
            }

            // Validate Event Selection
            if (!event_id.value) {
                showError(event_id, 'Veuillez sélectionner un événement');
                isValid = false;
            }
        } else if (form.querySelector('#title')) {
            // Event creation form validation
            const title = document.getElementById('title');
            const date = document.getElementById('date');
            const description = document.getElementById('description');

            // Validate Title
            if (!title.value.trim()) {
                showError(title, 'Le titre est obligatoire');
                isValid = false;
            }

            // Validate Date
            if (!date.value) {
                showError(date, 'La date est obligatoire');
                isValid = false;
            } else {
                const selectedDate = new Date(date.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    showError(date, 'La date ne peut pas être dans le passé');
                    isValid = false;
                }
            }

            // Validate Description
            if (!description.value.trim()) {
                showError(description, 'La description est obligatoire');
                isValid = false;
            } else if (description.value.trim().length < 10) {
                showError(description, 'La description doit contenir au moins 10 caractères');
                isValid = false;
            }
        }

        return isValid;
    }

    // Helper function to show error messages
    function showError(element, message) {
        element.style.borderColor = '#dc3545';
        
        // Create error message element
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error-text';
        errorSpan.style.color = '#dc3545';
        errorSpan.style.fontSize = '0.875rem';
        errorSpan.style.display = 'block';
        errorSpan.style.marginTop = '0.25rem';
        errorSpan.textContent = message;
        
        // Insert error message after the input
        element.parentNode.insertBefore(errorSpan, element.nextSibling);
        
        // Add input event listener to remove error when user starts typing
        element.addEventListener('input', function() {
            this.style.borderColor = '';
            const errorSpan = this.nextElementSibling;
            if (errorSpan && errorSpan.className === 'error-text') {
                errorSpan.remove();
            }
        });
    }
    
    // Helper function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Add form submit handlers
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            if (validateForm(this)) {
                this.submit();
            }
        });
    });
});

// Handle existing messages when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Only target paragraphs that are direct children of the body or main
    // and not inside feature-card or other content elements
    const messages = document.querySelectorAll('body > p, main > p, form + p');
    
    messages.forEach(message => {
        const text = message.textContent.trim();
        if (text && !message.closest('.feature-card')) { // Don't process if inside feature-card
            if (text.includes('réussie') || text.includes('succès')) {
                MessageManager.success(text);
            } else if (text.includes('Erreur') || text.includes('invalide') || text.includes('échoué')) {
                MessageManager.error(text);
            }
            message.remove();
        }
    });
});
