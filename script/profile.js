// Profile page tab functionality

document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            const activeContent = document.getElementById(tabName);
            if (activeContent) {
                activeContent.classList.add('active');
            }
        });
    });

    // Handle form submissions
    const profileForm = document.querySelector('.profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Profielgegevens zijn opgeslagen!');
            // Here you would send data to the server
        });
    }

    const settingsForm = document.querySelector('.settings-form');
    if (settingsForm) {
        settingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Instellingen zijn opgeslagen!');
            // Here you would send data to the server
        });
    }

    // Handle danger zone buttons
    const deleteBtn = document.querySelector('.btn--danger');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if (confirm('Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan gemaakt worden.')) {
                alert('Account verwijdering gestart...');
                // Here you would send a delete request to the server
            }
        });
    }

    const changePasswordBtn = document.querySelectorAll('.btn--secondary')[0];
    if (changePasswordBtn) {
        changePasswordBtn.addEventListener('click', function() {
            alert('Wachtwoord wijzigen formulier zou hier openen.');
            // Here you would open a modal or navigate to a password change page
        });
    }
});
