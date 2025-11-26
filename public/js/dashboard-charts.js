// Dashboard Charts Configuration
// Uses Chart.js for data visualization

document.addEventListener('DOMContentLoaded', function() {
    // Chart colors from Webflow design system
    const primaryColor = '#146EF5';
    const primaryDark = '#0056CC';
    const successColor = '#28A745';
    const warningColor = '#FFC107';
    
    // Occupancy Trend Chart
    const occupancyCtx = document.getElementById('occupancyChart');
    if (occupancyCtx) {
        new Chart(occupancyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Occupancy Rate (%)',
                    data: [75, 82, 88, 85, 90, 89],
                    borderColor: primaryColor,
                    backgroundColor: 'rgba(20, 110, 245, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Revenue Overview Chart
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue (KSh)',
                    data: [3200000, 3450000, 3600000, 3500000, 3750000, 3600000],
                    backgroundColor: primaryColor,
                    borderColor: primaryDark,
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'KSh ' + (value / 1000000).toFixed(1) + 'M';
                            }
                        }
                    }
                }
            }
        });
    }
});

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    const inputs = form.querySelectorAll('.form-control[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Email validation
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Phone validation (Kenya format)
function validatePhone(phone) {
    const re = /^(\+254|0)[17]\d{8}$/;
    return re.test(phone);
}

// Toast Notification
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type}`;
    toast.textContent = message;
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    toast.style.minWidth = '300px';
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Confirm Dialog
function confirmAction(message, callback) {
    if (confirm(message)) {
        callback();
    }
}

// AJAX Helper
async function fetchData(url, options = {}) {
    try {
        const response = await fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            ...options
        });
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        return await response.json();
    } catch (error) {
        console.error('Fetch error:', error);
        showToast('An error occurred. Please try again.', 'danger');
        return null;
    }
}

// Table Search Filter
function filterTable(searchInput, tableId) {
    const input = document.getElementById(searchInput);
    const table = document.getElementById(tableId);
    
    if (!input || !table) return;
    
    input.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = table.getElementsByTagName('tr');
        
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            
            rows[i].style.display = found ? '' : 'none';
        }
    });
}

// Real-time form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('.form-control');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateInput(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateInput(this);
                }
            });
        });
        
        form.addEventListener('submit', function(e) {
            if (!validateFormComplete(this)) {
                e.preventDefault();
                showToast('Please fill in all required fields correctly.', 'warning');
            }
        });
    });
});

function validateInput(input) {
    const type = input.type;
    const value = input.value.trim();
    let isValid = true;
    
    if (input.required && !value) {
        isValid = false;
    }
    
    if (type === 'email' && value && !validateEmail(value)) {
        isValid = false;
    }
    
    if (input.dataset.phone && value && !validatePhone(value)) {
        isValid = false;
    }
    
    if (input.min && parseFloat(value) < parseFloat(input.min)) {
        isValid = false;
    }
    
    if (input.max && parseFloat(value) > parseFloat(input.max)) {
        isValid = false;
    }
    
    if (isValid) {
        input.classList.remove('is-invalid');
    } else {
        input.classList.add('is-invalid');
    }
    
    return isValid;
}

function validateFormComplete(form) {
    const inputs = form.querySelectorAll('.form-control[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateInput(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}
